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
class Pages extends controller
{

    /**
     * default page model
     */
    private $_model;

    private $upload_dir;

    /**
     * $type
     */
    private $type;

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

    public function __construct()
    {
        $this->request = Request::createFromGlobals();
        $this->_model = new \Models\Posts_Model();
        $type = 'pages'; // $this->request->get('type');
        $this->upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/public/resimler/pages';
        //$this->post = new \Engine\Post($type);
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
        $data['post_name'] = "pages";
        $this->post_name = $data['post_name'];
        return $data;
    }

    /**
     * sayfanın defaul da olması gereken ayarları burada bulunuyor
     */
    private function upload($last_id)
    {
        if (count($_FILES['uploadPic']['name']) > 0) {
            $file_size = '2000000'; // dosya boyutu
            $allowed_types = 'jpg,gif,png,jpeg'; // izin verilen uzantılar
            $input_names = array();
            $input_names = $_FILES['uploadPic'];
            $Uploader = new \Lib\Uploader();
            $upload_dir = $this->upload_dir;
            $Uploader->name_format(false, 'st_', '_nc');
            $Uploader->picture_control_value = true; // resimin gerçek olup olmadığını kontrol eçindir
            $Uploader->uploader_set($input_names, $upload_dir, $allowed_types, $file_size); // çalıştırıcı
            
            for ($i = 0; $i < count($Uploader->uploaded_files); $i ++) {
                $picture = $Uploader->uploaded_files[$i];
                $data = array(
                    'photo_post_id' => $last_id,
                    'photo_filename' => $picture,
                    'photo_status' => 'open'
                );
                
                $this->_model->postsPicturesInsert($data);
            }
            
            if (! $Uploader->uploaded) {
                $ok = \Lib\Tools::message_ver('hata', $Uploader->result_report());
                \Lib\Session::set('message', $ok);
            }
        }
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
        
        $data['categories'] = $this->_model->AllPostsCategories("tr");
        $data['_setting'] = $this->default_params();
        if ($this->request->getMethod() == 'POST') {
            $id = $this->add_post();
            
            $ok = \Lib\Tools::message_ver('ok', 'Sayfa Başarı ile Eklenmiştir');
            \Lib\Session::set('message', $ok);
            $this->upload($last_id);
            \Lib\Url::redirect('admin/' . $this->post_name . '_edit/' . $id);
        }
        
        View::RenderAdminTemplate('head_view', $data_head);
        View::RenderAdminTemplate('header_view', '');
        View::RenderAdminTemplate('sidebar_view', '');
        View::RenderAdmin('posts/add_view', $data, $error);
        View::RenderAdminTemplate('footer_view', '');
    }

    /**
     * burada mantık olay dillere göre ayarlanır ve ona göre verilir
     */
    public function add_post()
    {
        $data = array(
            'cat_id' => $this->request->get('cat_id'),
            'description' => $this->request->get('description'),
            'title' => $this->request->get('title'),
            'slug' => $this->request->get('slug'),
            'content' => $this->request->get('content'),
            'img' => $this->request->get('img'),
            'status' => 'open',
            'type' => $this->type
        );
        $this->_model->postsInsert($data);
        
        return $this->_model->lastId();
    }

    /**
     * düzenleme alanı
     *
     * @param int $id
     * @return mixed
     */
    public function edit($post_id)
    {
        $data['post'] = $this->_model->fetch_post($post_id);
        
        $data['languages'] = $languages;
        $data['categories'] = $this->_model->AllPostsCategories();
        $data['pictures'] = $this->_model->AllPostsPictures(1);
        $data['_setting'] = $this->default_params();
        
        $data_head['page_title'] = 'Sayfa Düzenleme';
        $data['post_id'] = $post_id;
        // && \Lib\Tools::is_ajax()
        if ($this->request->getMethod() == 'POST') {
            $this->edit_post();
            $this->upload($post_id);
            $ok = \Lib\Tools::message_ver('ok', 'Bilgileriniz başarı ile değiştirilmiştir');
            \Lib\Session::set('message', $ok);
            \Lib\Url::redirect('admin/' . $this->post_name . '_edit/' . $post_id);
        }
        
        View::RenderAdminTemplate('head_view', $data_head);
        View::RenderAdminTemplate('header_view');
        View::RenderAdminTemplate('sidebar_view');
        View::RenderAdmin('posts/edit_view', $data, $error);
        View::RenderAdminTemplate('footer_view');
    }

    /**
     * post gelirse bu alandan gonderilir
     *
     * @param int $id
     * @return mixed
     */
    public function edit_post()
    {
        $post_id = $this->request->get('post_id');
        
        $data = array(
            'cat_id' => $this->request->get('cat_id'),
            'description' => $this->request->get('description'),
            'title' => $this->request->get('title'),
            'slug' => $this->request->get('slug'),
            'content' => $this->request->get('content'),
            'status' => 'open'
        );
        
        $where = array(
            'post_id' => $post_id
        );
        
        $this->_model->postsUpdate($data, $where);
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
            $this->delete_post($post_id);
            \Lib\Url::redirect('admin/' . $this->post_name);
        }
    }

    /**
     * silme
     *
     * @param int $post_id
     * @return mixed
     */
    public function delete_post($post_id)
    {
        $where = array(
            "post_id" => $post_id
        );
        
        $this->_model->postsDelete($where);
    }

    /**
     * resim silme
     *
     * @param int $post_id
     * @return mixed
     */
    public function delete_picture($id)
    {
        if ($this->request->getMethod() == 'GET') {
            // resmin filkenmainin öğrenip resmide sunucudan silsin
            // $this->upload_dir;
            $this->deletePicturePost($id);
            echo 'ok';
        }
    }

    /**
     * silme
     *
     * @param int $post_id
     * @return mixed
     */
    public function deletePicturePost($id)
    {
        $where = array(
            "photo_id" => $id
        );
        
        $this->_model->postsPictureDelete($where);
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
        $data['pages'] = $this->_model->Allposts();
        $data_head['page_title'] = 'Sayfalar';
        $data['_setting'] = $this->default_params();
        View::RenderAdminTemplate('head_view', $data_head);
        View::RenderAdminTemplate('header_view', $data_head);
        View::RenderAdminTemplate('sidebar_view');
        View::RenderAdmin('posts/view', $data, $error);
        View::RenderAdminTemplate('footer_view');
    }
}

?>