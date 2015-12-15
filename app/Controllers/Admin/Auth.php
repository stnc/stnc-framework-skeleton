<?php
namespace Controllers\Admin;

use \Core\View, \Lib\Request,
// \Models\Sayfalar_Model as pages_ ,
\Core\Controller as controller;
use \Lib\Cart;


/**
 * üyelik sayfası
 *
 * @author Selman TUNÇ <selmantunc@gmail.com>
 * @copyright Copyright (c) 2015 SELMAN TUNÇ
 *
 * @link https://github.com/stnc/stnc-framework/
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 *          @TODO :stok miktarını sepete vermiyor
 *
 */
class Auth extends controller
{

    private $_model;

    /**
     * footer_view de gorunmesi gerekne data lar burada görülecekdir
     *
     * @var array
     */
    private $footerDatasi = array();

    public function __construct()
    {
        // header('Content-Type: text/html; charset=utf-8');
        // $this->_model = new \Models\Uyelik_Model();
        $this->footerDatasi = $data;
    }

    /**
     * index sayfası, site açıldığı anda ilk buradan başlar
     *
     * @return mixed
     */
    public function index()
    {
        $data['baslik'] = 'Üyelik';
        $action = $this->request->get('action');
        $data_head['meta_aciklama'] = 'İdeal Sanal Market  üye olun , kazanın';
        $data_head['meta_image'] = DIR . PUBLIC_PATH . "/img/idealcomtrlogo.png";
        switch ($action) {
            
            case 'yeni_uye':
                $data = $this->Yeni_uye();
                $error = $data["error"];
                $data = $data["post_datasi"];
                $data_head['baslik'] = 'Üye Ol / Üye Girişi';
                $data_head['meta_link'] = \Lib\Tools::currentPageURL();
                $view = 'uye/uyelik_view';
                $data['gonderim'] = 'yeni_uye'; // verinin nereden gideceğini belli eder her yerde hata çıkmaması içindir
                break;
            
            case 'sifremi_unuttum':
                $data_head['baslik'] = 'Şifremi Unuttum';
                $data_head['meta_link'] = \Lib\Tools::currentPageURL();
                $error = $this->SifremiUnuttum();
                $view = 'uye/uye_sifremiunuttum_view';
                $data['gonderim'] = 'unuttum';
                break;
            
            case 'uye_sifremiunuttum_degisiklik':
                $data_head['baslik'] = 'Şifremi Unuttum';
                $data_head['meta_link'] = \Lib\Tools::currentPageURL();
                $error = $this->sifremi_unuttum_sifre_degistir();
                $view = 'uye/uye_sifremiunuttum_degisiklik_view';
                $data['gonderim'] = 'sifremiunuttum_degisiklik';
                break;
            
            case 'cikis':
                $this->logout();
                break;
            
            default:
                $this->Yeni_uye();
                $data = $this->Yeni_uye();
                $error = $data["error"];
                $data = $data["post_datasi"];
                $data_head['baslik'] = 'Üye Ol / Üye Girişi';
                $data_head['meta_aciklama'] = 'İdeal Sanal Market  Üye Olun, Kazanın';
                $data_head['meta_image'] = DIR . PUBLIC_PATH . "/img/idealcomtrlogo.png";
                $data_head['meta_link'] = \Lib\Tools::currentPageURL();
                $view = 'users/users_view';
                break;
        }
        
        View::RenderAdminTemplate('head_view', $data_head);
        View::RenderAdminTemplate('header_view', $data);
        View::RenderAdminTemplate('sidebar_view', $data);
        View::RenderAdmin($view, $data, $error);
        View::RenderAdminTemplate('footer_view', $this->footerDatasi);
    }

    /**
     * sifremi unuttum dediğinde şifre değişikliği yapacak alandır
     *
     * @return mixed
     */
    public function sifremi_unuttum_sifre_degistir()
    {
        if (\Lib\Session::get('loggedin')) {
            \Lib\url::redirect('hesapim');
        }
        
        $data['baslik'] = 'Şifre Değiştirme';
        
        $token = $this->request->get('token') ? $this->request->get('token') : '';
        if (! empty($token)) {
            $token = $this->request->get('token');
            
            if ($this->_model->getBoyle_bir_token_varmi($token) > 0) {
                $token_kontrol = true;
                $rows = $this->_model->getTokene_ait_kullanici_bilgileri($token);
                // token e ait kullnıcı bilgilerini bul
                $user_id = $rows['id'];
                $email = $rows['email'];
                
                if (Request::isGet()) {
                    
                    $basarili = \Lib\Tools::message_ver('ok', 'Lütfen yeni şifrenizi yazınız');
                    \Lib\Session::set('message', $basarili);
                }
            } else {
                $token_kontrol = false;
            }
        }
        
        if (Request::isPost() and $token_kontrol) {
            
            $uye_sifre1 = $this->request->get('uye_sifre1');
            $uye_sifre2 = $this->request->get('uye_sifre2');
            
            if ($uye_sifre1 == '') {
                $error[] = 'Şifre alanı boş bırakılamaz ';
            }
            
            if ($uye_sifre2 == '') {
                $error[] = 'şifre tekrar alanı boş bırakılamaz ';
            }
            
            if ($uye_sifre1 != $uye_sifre2) {
                $error[] = ' Şifreler uyuşmamakdadır';
            }
            
            if (strlen($uye_sifre1) < 6) {
                $error[] = 'Şifre en az 6 karakter olmalıdır ';
            }
            if (! $error) {
                // token bul
                // 'parola' => Sha1(md5($uye_sifre1)),
                $postdata = array(
                    'parola' => $uye_sifre1,
                    'token_key' => ''
                );
                
                $where = array(
                    'id' => $user_id
                );
                
                $this->_model->update_sifre__ve_token_guncelleme($postdata, $where);
                
                $basarili = \Lib\Tools::message_ver('ok', 'Şifreniz değiştirilmiştir , yeni şifrenizle giriş yapabilirsiniz');
                \Lib\Session::set('message', $basarili);
                
                \Lib\Url::redirect('uyelik/?action=login');
            }
        } else {
            if (! Request::isGet()) {
                
                $hata = \Lib\Tools::message_ver('hata', 'Sorun oluştu, mail adresinizdeki şifre yenileme mailini kontrol ediniz');
                \Lib\Session::set('message', $hata);
            }
        }
        
        return $error;
    }

    /**
     * index sayfası, site açıldığı anda ilk buradan başlar
     *
     * @return mixed
     */
    private function Yeni_uye()
    {
        if (\Lib\Session::get('loggedin')) {
            \Lib\Url::redirect('hesapim');
        }
        // TODO : mail adresi zaten var mı
        
        if (Request::isPost()) {
            
            $uye_ad = $this->request->get('uye_ad');
            $uye_soyad = $this->request->get('uye_soyad');
            $uye_cep = $this->request->get('uye_cep');
            $uye_email = $this->request->get('uye_email');
            $uye_cep = $this->request->get('uye_cep');
            $uye_sifre1 = $this->request->get('uye_sifre1');
            $uye_sifre2 = $this->request->get('uye_sifre2');
            $cinsiyet = $this->request->get('cinsiyet');
            $uye_dogum_gunu = $this->request->get('uye_dogum_gunu');
            $uye_dogum_ay = $this->request->get('uye_dogum_ay');
            $uye_sartlar = $this->request->get('uye_sartlar');
            $kampanya = $this->request->get('kampanya');
            $uye_dogum_yil = $this->request->get('uye_dogum_yil');
            $uye_sartlar = $this->request->get('uye_sartlar');
            $cinsiyet = $this->request->get('cinsiyet');
            
            if ($uye_ad == '') {
                $error[] = 'adı alanı boş bırakılamaz';
            }
            
            if ($uye_soyad == '') {
                $error[] = 'soyadı alanı boş bırakılamaz';
            }
            
            if ($uye_email == '') {
                $error[] = 'email alanı boş bırakılamaz';
            }
            
            if (! filter_var($uye_email, FILTER_VALIDATE_EMAIL)) {
                $error[] = 'lütfen geçerli bir email adresi yazınız ';
            }
            
            if ($uye_sifre1 == '') {
                $error[] = 'Şifre alanı boş bırakılamaz ';
            }
            
            if ($uye_sifre2 == '') {
                $error[] = 'şifre tekrar alanı boş bırakılamaz ';
            }
            
            if ($uye_sifre1 != $uye_sifre2) {
                $error[] = ' Şifreler uyuşmamakdadır';
            }
            
            if (strlen($uye_sifre1) < 6) {
                $error[] = 'Şifre en az 6 karakter olmalıdır ';
            }
            
            if ($this->_model->getEmail_Varmi($uye_email) > 0) {
                $error[] = 'Böyle bir email adresi bulunmakdadır, farklı bir e mail adresi deneyiniz ';
            }
            
            if ($uye_sartlar != 1) {
                $error[] = 'Lütfen üyelik şartlarını kabul ediniz ';
            }
            
            $post_datasi = array(
                'uye_ad' => $uye_ad,
                'uye_soyad' => $uye_soyad,
                'uye_cep' => $uye_cep,
                'uye_email' => $uye_email,
                
                'uye_sifre1' => $uye_sifre1,
                'uye_sifre2' => $uye_sifre2
            )
            ;
            
            $data['post_datasi'] = $post_datasi;
            $data['error'] = $error;
            if (empty($error)) {
                $sanal_dogum_tarihi = $uye_dogum_yil . "-" . $uye_dogum_ay . "-" . $uye_dogum_gunu;
                
                $uye_sartlar = $this->request->get('uye_sartlar') ? $this->request->get('uye_sartlar') : '';
                
                $genel_model = new \Models\Genel_Model();
                $son_cari_kodu = $genel_model->son_cari_kodu();
                
                $postdata = array(
                   /* 'sanal_adi' => $uye_ad,
                    'sanal_soyadi' => $uye_soyad,*/
                    'unvan' => $uye_ad . ' ' . $uye_soyad,
                    'fatura_unvan' => $uye_ad . ' ' . $uye_soyad,
                    'yetkili' => $uye_ad . ' ' . $uye_soyad,
                    'sanal_dogum_tarihi' => $sanal_dogum_tarihi,
                   /* 'parola' => Sha1(md5($uye_sifre1)),*/
                    'parola' => $uye_sifre1,
                    'tarih' => date('Y.m.d'),
                    'email' => $uye_email
                )
                ;
                
                $last_id = $this->_model->insert_user($postdata, $kampanya, $uye_email);
                
                $sonuc = \Lib\Tools::message_ver('ok', 'Üyeliğiniz başarı ile yapılmıştır');
                \Lib\Session::set('message', $sonuc);
                \Lib\Session::set('uyelik_tamam', true);
                \Lib\Session::set('loggedin', true);
                
                $kullanici_bilgilerim = array(
                    'kullanici_id' => $last_id,
                    'email' => $uye_email,
                    'adi' => $uye_ad,
                    'soyadi' => $uye_soyad,
                    'ad_soyad' => $uye_ad . ' ' . $uye_soyad
                );
                
                \Lib\Session::set('kullanici_bilgileri', $kullanici_bilgilerim);
                
                \Lib\Url::redirect('');
            }
            $this->mailGonder($last_id);
            return $data;
        }
    }

    /**
     * mail gonderim
     *
     * @return mixed
     */
    public function mailGonder($uye_id)
    {
        $mail = new \Helpers\Mailler_Helper();
        $konu = "İdeal.com.tr de yeni bir üye var";
        $mesajin_gidecegi_eposta = "siparis@ideal.com.tr";
        // $mesajin_gidecegi_eposta = "selmantunc@gmail.com";
        $ad_soyad = "İdeal Sanal Market";
        $mesaj = "İdeal.com.tr de yeni bir üye var id numarası " . $uye_id;
        // $sonuc = $mail->sendmail("siparis@ideal.com.tr", $eposta, $ad_soyad, $konu, $mesaj);
        $sonuc = $mail->sendmail("iletisim@ideal.com.tr", $mesajin_gidecegi_eposta, $ad_soyad, $konu, $mesaj);
    }

    /**
     * index sayfası, site açıldığı anda ilk buradan başlar
     *
     * @return mixed
     */
    public function logins()
    {
        // $error = $this->login();
        $data_head['page_title'] = 'Üye Girişi';
        $data_head['meta_link'] = \Lib\Tools::currentPageURL();
        $view = 'users/login_view';
        $data['gonderim'] = 'login';
        View::RenderAdminTemplate('head_view', $data_head);
        View::RenderAdmin($view, $data, $error);
    }

    /**
     * index sayfası, site açıldığı anda ilk buradan başlar
     *
     * @return mixed
     */
    private function login()
    {
        if (\Lib\Session::get('loggedin')) {
            \Lib\Url::redirect('hesapim');
        }
        $data['baslik'] = 'Kullanıcı Girişi';
        
        if ($this->request->getMethod () == 'POST') { // if (isset ( $_POST ['submit'] )) {
            
            $emailadres = $this->request->get('email');
            $password = $this->request->get('password');
            
            if ($emailadres == '') {
                $error[] = 'email alanı boş bırakılamaz';
            }
            
            if (! filter_var($emailadres, FILTER_VALIDATE_EMAIL)) {
                $error[] = 'lütfen geçerli bir email adresi yazınız ';
            }
            
            if ($password == '') {
                $error[] = 'Şifre alanı boş bırakılamaz ';
            }
            
            if (! $error) {
                $emailadres = $this->request->get('email');
                
                // $password = Sha1(md5($this->request->get('password')));
                $password = $this->request->get('password');
                
                $kullanici_bilgileri = $this->_model->getKullaniciBilgileri($emailadres);
                
                $parola = $kullanici_bilgileri['parola'];
                
                $id = $kullanici_bilgileri['id'];
                
                $email = $kullanici_bilgileri['email'];
                
                $ad_soyad = \Lib\Strings::adSoyadParcala($kullanici_bilgileri['unvan']);
                
                $ad = $ad_soyad['adi'];
                $soyad = $ad_soyad['soyadi'];
                $ad_soyad = $ad . ' ' . $soyad;
                
                $data['ad_soyad'] = $ad_soyad;
                
                $kullanici_bilgilerim = array();
                
                if (strcmp($parola, $password) == 0) {
                    \Lib\Session::set('loggedin', true);
                    
                    $kullanici_bilgilerim = array(
                        'kullanici_id' => $id,
                        'email' => $email,
                        'adi' => $ad,
                        'soyadi' => $soyad,
                        'ad_soyad' => $ad_soyad
                    );
                    
                    \Lib\Session::set('kullanici_bilgileri', $kullanici_bilgilerim);
                    
                    // kullanıcı giriş yapmışsa sepetindeki ürünleri sepetine ekle
                    
                    $this->UyeninSepetindekiUrunler($id);
                    
                    \Lib\Url::redirect('');
                } else {
                    \Lib\Log::LogOlustur('hatali_giris', 'uyelik', '{"kullanıcıadı":"' . $emailadres . '", "şifre":"' . $password . '"}', $emailadres . '/' . $password);
                    $hata = \Lib\Tools::message_ver('hata', 'Kullanıcı adı veya şifreyi yanlış girdiniz');
                    \Lib\Session::set('message', $hata);
                }
            }
        }
        
        return $error;
    }

    /**
     * şifremi unuttum
     *
     * @return mixed
     */
    public function SifremiUnuttum()
    {
        if (\Lib\Session::get('loggedin')) {
            \Lib\Url::redirect('hesapim');
        }
        // if (isset ( $_POST ['submit'] )) {
        if (Request::isPost()) {
            $email = $this->request->get('email');
            
            if ($email == '') {
                $error[] = 'email alanı boş bırakılamaz';
            }
            
            if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error[] = 'lütfen geçerli bir email adresi yazınız ';
            }
            
            if (! $error) {
                
                $total = $this->_model->getEmail_Varmi($email);
                
                if ($total > 0) {
                    $user = $this->_model->getKullaniciBilgileri($email);
                    // print_r($user);die;
                    $email_adresi = $user['email'];
                    
                    $ad_soyad = \Lib\Strings::adSoyadParcala($bilgiler['unvan']);
                    
                    $adi_soyadi = $ad_soyad['adi'] . ' ' . $ad_soyad['soyadi'];
                    
                    $user_id = $user['id'];
                    
                    $subject = 'İdeal.com.tr Şifre Yenileme';
                    
                    $tokenkey = \Lib\Tools::token_key_olustur();
                    $toplam_token_adet = $this->_model->getBoyle_bir_token_varmi($tokenkey);
                    // aynı isimde token key olabilir onu engellemek gerek
                    if ($toplam_token_adet > 0) {
                        $tokenkey = $tokenkey . 'st_n_ck_ey';
                    }
                    
                    $postdata = array(
                        'token_key' => $tokenkey
                    );
                    
                    $where = array(
                        'id' => $user_id
                    );
                    
                    $this->_model->update_tokenKey_user($postdata, $where);
                    
                    $message = '<a href="' . DIR . 'uyelik?action=uye_sifremiunuttum_degisiklik&token=' . $tokenkey . '">Şifre değiştirmek için tıklyayınız</a>';
                    
                    $mail = new \Helpers\Mailler_Helper();
                    
                    $sonuc = $mail->sendmail("info@ideal.com.tr", $email_adresi, $adi_soyadi, $subject, $message);
                    
                    if (! $sonuc) {
                        
                        $hata = \Lib\Tools::message_ver('hata', $sonuc);
                        
                        \Lib\Session::set('message', $hata);
                        // \Lib\Url::redirect('uyelik?action=sifremi_unuttum');
                    } else {
                        
                        $basarili = \Lib\Tools::message_ver('ok', 'Şifre değiştirme linki mail adresinize gönderilmiştir');
                        
                        \Lib\Session::set('message', $basarili);
                        // \Lib\Url::redirect('uyelik?action=uye_sifremiunuttum_degisiklik');
                    }
                } else {
                    
                    $err = 'Böyle bir e-mail adresi bulunamadi';
                    
                    $hata = \Lib\Tools::message_ver('hata', $err);
                    
                    \Lib\Session::set('message', $hata);
                    // \Lib\Url::redirect('uyelik?action=sifremi_unuttum');
                }
            }
        }
        
        return $error;
    }

    /**
     * çıkış yap
     */
    public function logout()
    {
        \Lib\Session::destroy('loggedin');
        \Lib\Session::destroy('kullanici_bilgileri');
        \Lib\Session::destroy('stncart');
        \Lib\Session::destroy('teslimatZamani');
        \Lib\Session::destroy('sepetStokSorunu');
        \Lib\Url::redirect('uyelik');
    }
}

?>