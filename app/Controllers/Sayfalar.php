<?php
namespace Controllers;

session_start();
use \Core\Language;
use Symfony\Component\HttpFoundation\Request;
use \Core\View, \Lib\Paginator, \Core\Controller as controller;
use Helpers;

/**
 * standart içerik ve yazıların olduğu sayfadır
 * /kurumsal/hakkimizda gibi
 *
 * @author Selman TUNÇ <selmantunc@gmail.com>
 * @copyright Copyright (c) 2015 SELMAN TUNÇ
 * @link http://github.com/stnc
 * @link https://github.com/stnc/stnc-framework/
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class Sayfalar extends controller
{

    /**
     * footer_view de gorunmesi gerekne data lar burada görülecekdir
     *
     * @var array
     */
    private $footerDatasi = array();

    private $defaultLanguage;

    /**
     * get ve post paramtreleri buradan geçer
     */
    private $request;

    public function __construct()
    {
        parent::__construct();
        // footer da da olduğu için buradan verdim
        
        $this->request = Request::createFromGlobals();
        
        // dil objelerini set et
        
        $this->footerDatasi = $data;
    }

    /**
     * slug a bağlı ilgili sayfayı açar
     *
     * @param string $slug
     * @todo slug db de var mı yok yoksa 404 bas
     * @return mixed
     */
    public function sayfa($slug="kurumsal")
    {
        $this->model = new \Models\Posts_Model();
        $this->model->type = 'pages';
        
        $lng = new \Core\Language();
        $lang = $this->request->get('lang');

        if ($lang==""){
        $lng->defaultLanguage = "tr"; // dili belirtiyoruz
        } else {
            $lng->defaultLanguage=$lang;
        }
        
        $lng->load('header');
        
        $pages = $this->model->fetchPost_Slug($slug, $this->defaultLanguage);
        if ($pages) {
            // print_r($pages);
            $data['title'] = $pages['title'];
            $data['content'] = stripslashes($pages['content']);
            $data_head['title'] = $pages['title'];
            $data_head['meta_title'] = substr(stripslashes($pages['description']), 0, 150);
            $data_head['meta_image'] = DIR . PUBLIC_PATH . "/img/idealcomtrlogo.png";
            $data_head['meta_link'] = \Lib\Tools::currentPageURL();
            
            //menuler
            $data_header['kurumsal']=$lng->get('kurumsal');
            $data_header['hizmetler']=$lng->get('hizmetler');
            $data_header['urunler']=$lng->get('urunler');
            $data_header['markalar']=$lng->get('markalar');
            $data_header['satis']=$lng->get('satis');
            $data_header['kariyer']=$lng->get('kariyer');
            $data_header['iletisim']=$lng->get('iletisim');
            

            
            
            View::RenderTemplate('head_view', $data_head);
            View::RenderTemplate('header_view',$data_header);
            View::Render('sayfa/index_view', $data);
            View::RenderTemplate('footer_view', $this->footerDatasi);
        } else {
            View::render('error/404', '');
        }
    }

    /**
     * slug a bağlı ilgili sayfayı açar
     *
     * @param string $slug
     * @todo slug db de var mı yok yoksa 404 bas
     * @return mixed
     */
    public function tekilSayfa($post_id)
    {
        $this->model = new \Engine\Posts_Model();
        $this->model->type = 'pages';
        $this->language = new Language();
        $this->language->load('anasayfa');
        $this->defaultLanguage = $this->language->defaultLanguage;
        $pages = $this->model->fetchPost_Slug($post_id, $this->defaultLanguage);
        if ($pages) {
            $data['title'] = $pages['title'];
            $data['content'] = stripslashes($pages['content']);
            $data['description'] = stripslashes($pages['description']);
            return $data;
        } else {
            return 'istediğiniz adres bulunamadı';
        }
    }
}