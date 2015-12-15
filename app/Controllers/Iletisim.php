<?php
namespace Controllers;

use \Core\View, 
use \Core\Controller as controller;
use Lib\Url;
use Lib\Session;
use \Core\Logger;
use Symfony\Component\HttpFoundation\Request;
    /**
     * iletişim sayfası bilgileri
     * @author Selman TUNÇ <selmantunc@gmail.com>
     * @link https://github.com/stnc/stnc-framework/
     * @license http://www.opensource.org/licenses/mit-license.php The MIT License
     *
     */
class Iletisim extends controller
{


    
    /**
     * genel
     *
     * @var \\Models\Urunler_Model ();
     */
    private $_model;

    /**
     *
     * get ve post paramtreleri buradan geçer
     *
     * @var Symfony\Component\HttpFoundation\Request
     * @uses Symfony\Component\HttpFoundation\Request
     *
     */
    private $request;

    /**
     * footer_view de gorunmesi gerekne data lar burada görülecekdir
     *
     * @var array
     */
    private $footerDatasi = array();

    /**
     * reklam alanları için kullanılacak
     *
     * @var string
     */
    private $reklam_helper;

    public function __construct()
    {
        header('Content-Type: text/html; charset=utf-8');
        
        $this->request = Request::createFromGlobals();

      
    }

    


    /**
     * iletişime ait ilk işlemler buradan başlar
     *
     * @return mixed
     */
    public function index()
    {
        $action = $this->request->get('action');
        $view = 'iletisim/iletisim_view';
        switch ($action) {
            
            case 'gonder':
                $data['baslik'] = 'Mail Gönderimi ';
                $error = $this->Gonder();

                break;
            
            default:
                $data['baslik'] = 'İletişim / Adres Bilgisi';

                break;
        }
        
        $lng = new \Core\Language();
        $lang = $this->request->get('lang');
        
        if ($lang==""){
            $lng->defaultLanguage = "tr"; // dili belirtiyoruz
        } else {
            $lng->defaultLanguage=$lang;
        }
        
        $lng->load('header');
        //menuler
        $data_header['kurumsal']=$lng->get('kurumsal');
        $data_header['hizmetler']=$lng->get('hizmetler');
        $data_header['kurumsal']=$lng->get('kurumsal');
        $data_header['hizmetler']=$lng->get('hizmetler');
        $data_header['urunler']=$lng->get('urunler');
        $data_header['markalar']=$lng->get('markalar');
        $data_header['satis']=$lng->get('satis');
        $data_header['kariyer']=$lng->get('kariyer');
        $data_header['iletisim']=$lng->get('iletisim');
        
        //iletisim alanı
        $lng->load('iletisim');
        $data['lng_uyari'] = $lng->get('uyari');
        $data['lng_ad_soyad'] = $lng->get('ad_soyad');
        View::RenderTemplate('head_view', $data);
        View::RenderTemplate('header_view',$data_header);
        View::Render($view, $data, $error);
        View::RenderTemplate('footer_view');
    }

    /**
     * gonder dediği anda buradan başlar
     *
     * @return mixed
     */
    private function Gonder()
    {
        $send = $this->request->get('send');
        $email = $this->request->get('email');
        $phone = $this->request->get('phone');
        $message = $this->request->get('message');
        
        if ($send == '') {
            $error[] = 'adı alanı boş bırakılamaz'  ;
        }
        if ($phone == '') {
            $error[] = 'phone alanı boş bırakılamaz';
        }
        
        if ($email == '') {
            $error[] = 'email alanı boş bırakılamaz';
        }
        
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error[] = 'lütfen geçerli bir email adresi yazınız ';
        }
        
        if ($message == '') {
            $error[] = 'message alanı boş bırakılamaz ';
        }
        

        
        if (! $error) {
            
            $iletisim_model = new \Models\Iletisim_Model();
            $mail = new \Helpers\Mailler_Helper();
            $subject = "İletişim Formu";
            // gp_sitelerden_message
            $postdata = array(
                'ip' => $_SERVER[REMOTE_ADDR],
                'date' => date('Y.m.d H:i:s'),
                'send' => $send,
                'subject' => $subject,
                'message' => $message,
                'email' => $email,
                'phone' => $phone
            );
            $iletisim_model->ekle($postdata);
            
            $message2 = 'Bekleyen bir <a href="?m=11" target="_blank">MUSTERI messageI</a> var';
            
            // TODO : test edilecek
            // $sonuc = $mail->sendmail("bilgi@idealsanalmarket.com", $email, $send, $subject, $message);
            
            $ok = \Lib\Tools::message_ver('ok', 'Mesajınız Gönderilmiştir. Teşekkür ederiz.');
            \Lib\Session::set('message', $ok);
            \Lib\Url::redirect("iletisim");
        }
        
        return $error;
    }
}