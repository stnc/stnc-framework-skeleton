<?php
namespace Models;

/**
 * admin posts model
 * * test
 * http://eticaret.dev/admin/news/forms/general.html
 * INSERT dr_cms_news Set post_id = post_id + 1;
 * update dr_cms_news Set post_id = post_id + 1 where id=2;
 * @author Selman TUNÇ <selmantunc@gmail.com>
 * @copyright Copyright (c) 2015 SELMAN TUNÇ
 *
 * @link https://github.com/stnc/stnc-framework/
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class Posts_Model extends \Core\Model
{

    private $table_prefix = 'cms_';

    public $type;

    /**
     * son id değerini verir
     *
     * @return string
     */
    public function lastId()
    {
        return $this->_db->lastID();
    }

    /**
     * posts add
     *
     * @return mixed
     * @param array $data
     * @return boolean
     */
    public function postsInsert($data)
    {
        $this->_db->insert(PREFIX . $this->table_prefix . "posts", $data);
        return true;
    }
    
    

    /**
     * posts a resim ekler
     *
     * @return mixed
     * @param array $data
     * @return boolean
     */
    public function postsPicturesInsert($data)
    {
        $this->_db->insert(PREFIX . $this->table_prefix . "post_photos", $data);
        return true;
    }

    /**
     * post sil
     *
     * @param array $where
     * @return boolean
     */
    public function postsDelete($where)
    {
        return $this->_db->delete(PREFIX . $this->table_prefix . "posts", $where, 50);
    }
    
    
    /**
     * post sil
     *
     * @param array $where
     * @return boolean
     */
    public function postsPictureDelete($where)
    {
        return $this->_db->delete(PREFIX . $this->table_prefix . "post_photos", $where, 50);
    }
    

    /**
     * posts update
     *
     * @param array $data
     * @param array $where
     * @return boolean
     */
    public function postsUpdate($data, $where)
    {
        $this->_db->update(PREFIX . $this->table_prefix . "posts", $data, $where);
        return true;
    }

    /**
     * sayfa bilgisi
     *
     * @param int $post_id
     * @param string $lang
     * @return boolean
     */
    public function fetch_post($post_id)
    {

          $q = "SELECT
				post_id as post_id,
                cat_id ,
				title as title,
			    slug as slug,
			  	description as description,
				content as content
				FROM " . PREFIX . $this->table_prefix . "posts WHERE post_id=$post_id and type='" . $this->type . "' ;";
        return $this->_db->fetch($q);
    }

    /**
     * önyüz kullanacak burayı
     *
     * @param array $slug
     * @param string $lang
     * @return boolean
     */
    public function fetchPost_Slug($slug)
    {

         $q = "SELECT
				post_id,
                cat_id,
				title ,
			    slug ,
			  	 description,
				content
				FROM " . PREFIX . $this->table_prefix . "posts WHERE  type='" . $this->type . "' and slug='" . $slug . "'  ;";
        return $this->_db->fetch($q);
    }

    /**
     * tüm sayfa bilgisini verir
     *
     * @param int $lng_id
     * @return boolean
     */
    public function Allposts()
    {

        $q = "SELECT
				post_id,
                cat_id,
			
				title ,
			    slug ,
			  	description ,
				content
				FROM " . PREFIX . $this->table_prefix . "posts WHERE  type='" . $this->type . "'  ";
        return $this->_db->rows($q);
    }


    
    /**
     *kategorileri verir
     *
     * @param int $lng_id
     * @return boolean
     */
    public function AllPostsCategories()
    {

        $q = "SELECT
                cat_id,
				cat_title,
			    cat_slug
				FROM " . PREFIX . $this->table_prefix . "posts_cats WHERE  cat_type='" . $this->type . "' ";
        return $this->_db->rows($q);
    }
    
    
    /**
     *kategorileri verir
     *
     * @param int $lng_id
     * @return boolean
     */
    public function AllPostsPictures($post_id)
    {

        $q = "SELECT * FROM " . PREFIX . $this->table_prefix . "post_photos WHERE photo_post_id=$post_id";
        return $this->_db->rows($q);
    }


    /**
     * dilin slug ına gore id degerini verir
     *
     * @return array
     */
    public function LastpostsID()
    {
        $q = "SELECT post_id FROM " . PREFIX . $this->table_prefix . "posts where type='" . $this->type . "' order by post_id desc limit  1	 ";
        return $this->_db->fetch($q)['post_id'];
    }

    /**
     * dilin slug ına gore id degerini verir
     *
     * @return array
     */
    public function postsIDTotal()
    {
        $q = "SELECT count(id) as  total	FROM " . PREFIX . $this->table_prefix . "posts where type='" . $this->type . "'";
        return $this->_db->fetch($q)['total'];
    }

    /* kategoriler bölümü */
    
    /**
     * kategori bilgisini verir
     *
     * @param int $lng
     * @return boolean
     */
    public function All_Cats($lng)
    {

        
        $q = "SELECT
				cat_id as id,
	            cat_post_id as post_id,
				cat_title as title,
			    cat_slug as slug,
	            cat_lang_id
				FROM " . PREFIX . $this->table_prefix . "posts_cats WHERE  cat_type='" . $this->type . "'  ";
        return $this->_db->rows($q);
    }

    /**
     * kategori ekle
     *
     *
     *
     * @return mixed
     * @param array $data
     * @return boolean
     */
    public function catsInsert($data)
    {
        $this->_db->insert(PREFIX . $this->table_prefix . "posts_cats", $data);
        return true;
    }

    /**
     * kategori sil
     *
     * @param array $where
     * @return boolean
     */
    public function catsDelete($where)
    {
        return $this->_db->delete(PREFIX . $this->table_prefix . "posts_cats", $where, 50);
    }

    /**
     * kategori güncelle
     *
     * @param array $data
     * @param array $where
     * @return boolean
     */
    public function catsUpdate($data, $where)
    {
        $this->_db->update(PREFIX . $this->table_prefix . "posts_cats", $data, $where);
        return true;
    }

    /**
     * kategori bilgisi
     *
     * @param int $post_id
     * @param string $lang
     * @return boolean
     */
    public function fetch_cats($post_id, $lang)
    {


        $q = "SELECT
                cat_post_id as  post_id,
				cat_id as  cat_id
                cat_post_id as cat_post_id,
				cat_title as  cat_title,
			    cat_slug as cat_slug
				FROM " . PREFIX . $this->table_prefix . "posts_cats WHERE cat_post_id=$post_id and cat_type='" . $this->type . "'  ;";
        return $this->_db->fetch($q);
    }

    /**
     * dilin slug ına gore categori id degerini verir
     *
     * @return array
     */
    public function LastCatID()
    {
        $q = "SELECT cat_post_id FROM " . PREFIX . $this->table_prefix . "posts_cats where cat_type='" . $this->type . "'  limit  1";
        return $this->_db->fetch($q)['cat_post_id'];
    }

    /**
     * dilin slug ına gore id degerini verir
     *
     * @return array
     */
    public function CatsIDTotal()
    {
        $q = "SELECT count(cat_id) as  total	FROM " . PREFIX . $this->table_prefix . "posts_cats where cat_type='" . $this->type . "'";
        
        return $this->_db->fetch($q)['total'];
    }

    /**
     * kategoriyi slug adresine göre çeker
     * önyüz kullanacak burayı
     *
     * @param string $slug
     * @param string $lang
     * @return boolean
     */
    public function fetchCats_Slug($slug, $lang)
    {

        $q = "SELECT
				cat_post_id,
				cat_title ,
			    cat_slug
				FROM " . PREFIX . $this->table_prefix . "posts_cats WHERE  cat_type='" . $this->type . "' and cat_slug='" . $slug . "' ;";
        return $this->_db->fetch($q);
    }
}
