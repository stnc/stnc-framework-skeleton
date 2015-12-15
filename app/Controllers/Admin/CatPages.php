<?php
namespace Controllers\Admin;

use \Core\View,

\Core\Controller as controller;
use Lib\Url;
use Lib\Session;
use Symfony\Component\HttpFoundation\Request;

/**
 * page controller
 * page add
 * page edit
 * page list
 *
 * @author Selman TUNÇ <selmantunc@gmail.com>
 * @copyright Copyright (c) 2015 SELMAN TUNÇ
 *
 * @link https://github.com/stnc/stnc-framework/
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 *          @TODO :stok miktarını sepete vermiyor
 *
 */
class CatPages extends controller
{

    /**
     * default page model
     */
    private $_model;

    /**
     * footer_view de gorunmesi gerekne data lar burada görülecekdir
     *
     * @var array
     */
    private $footerDatasi = array();

    /**
     * get ve post paramtreleri buradan geçer
     */
    private $request;

    public $post;
    
    
    public $post_name;
    public function __construct()
    {
        // header('Content-Type: text/html; charset=utf-8');
        $this->request = Request::createFromGlobals();
        $this->_model = new \Engine\Posts_Model();
        
        $type = 'pages'; // $this->request->get('type');
        $this->post = new \Engine\Post($type);
        $this->_model->type = $type;
        $this->type = $type;
        $this->footerDatasi = $data;
    }

    
    
    /**
     * sayfanın defaul da olması gereken ayarları burada bulunuyor
     */
    private function default_params()
    {
    	$data['view_page_name'] = "Sayfa";
    	$data['post_name'] = "cat_pages";
    	$this->post_name= $data['post_name'];
    	return $data;
    }
    

    
    
    /**
     * test
     * http://eticaret.dev/admin/pages/forms/general.html
     * INSERT dr_page_pages Set post_id = post_id + 1;
     * update dr_page_pages Set post_id = post_id + 1 where id=2;
     *
     * @return mixed
     */
    public function add()
    {
    	$data_head['page_title'] = 'Sayfa Ekleme';
    	$data['languages'] = $this->_model->All_languages();
    	$data['categories'] = $this->_model->AllPostsCategories("tr");
    	$data['_setting'] = $this->default_params();
    	if ($this->request->getMethod() == 'POST') {
    		$add_ids = $this->post->addCat();
    		$id = $add_ids['post_id'];
    		$last_id = $add_ids['last_id'];
    		$ok = \Lib\Tools::message_ver('ok', 'Sayfa Başarı ile Eklenmiştir');
    		\Lib\Session::set('message', $ok);
    		\Lib\Url::redirect('admin/'.$this->post_name.'_edit/' . $id);
    	}
    
    	View::RenderAdminTemplate('head_view', $data_head);
    	View::RenderAdminTemplate('header_view', '');
    	View::RenderAdminTemplate('sidebar_view', '');
    	View::RenderAdmin('posts_cat/add_view', $data, $error);
    	View::RenderAdminTemplate('footer_view', '');
    }
    
    /**
     * düzenleme alanı
     *
     * @param int $id
     * @return mixed
     */
    public function edit($post_id)
    {
    	$languages = $this->_model->All_languages(); // tüm diller
    	foreach ($languages as $value) {
    		$lng = $value['slug'];
    		$data['lang'][$lng] = $this->_model->fetch_cats($post_id, $lng);
    	}
    
    	$data['languages'] = $languages;

    	$data['_setting'] = $this->default_params();
    
    	$data_head['page_title'] = 'Sayfa Düzenleme';
    	$data['post_id'] = $post_id;
    	// && \Lib\Tools::is_ajax()
    	if ($this->request->getMethod() == 'POST') {
    		$this->post->editCat();
    		$ok = \Lib\Tools::message_ver('ok', 'Bilgileriniz başarı ile değiştirilmiştir');
    		\Lib\Session::set('message', $ok);
    		\Lib\Url::redirect('admin/'.$this->post_name.'_edit/' . $post_id);
    	}
    
    	View::RenderAdminTemplate('head_view', $data_head);
    	View::RenderAdminTemplate('header_view');
    	View::RenderAdminTemplate('sidebar_view');
    	View::RenderAdmin('posts_cat/edit_view', $data, $error);
    	View::RenderAdminTemplate('footer_view');
    }



    /**
     * silme
     *
     * @param int $post_id
     * @return mixed
     */
    public function delete($post_id)
    {
        if ($this->request->getMethod() == 'GET') {
            $this->post->Catdelete($post_id);
            \Lib\Url::redirect('admin/'.$this->post_name);
        }
    }



    /**
     * index sayfası, site açıldığı anda ilk buradan başlar
     *
     * @return mixed
     */
    public function index()
    {

        $data_head['meta_aciklama'] = 'Sayfalar';
        $data_head['meta_image'] = DIR . PUBLIC_PATH . "/img/idealcomtrlogo.png";
        $data['pages'] = $this->_model->All_Cats('tr');
        $data_head['page_title'] = 'Sayfalar';
        $data['_setting'] = $this->default_params();
        View::RenderAdminTemplate('head_view', $data_head);
        View::RenderAdminTemplate('header_view', $data_head);
        View::RenderAdminTemplate('sidebar_view');
         View::RenderAdmin('posts_cat/view', $data, $error);
        View::RenderAdminTemplate('footer_view');
    }

}

?>