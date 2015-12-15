<?php
namespace Controllers;

use \Core\View;
use \Core\Controller as controller;

/**
 * hata ve 404 sayfası
 * @author Selman TUNÇ <selmantunc@gmail.com>
 * @copyright Copyright (c) 2015 SELMAN TUNÇ
 * @link https://github.com/stnc/stnc-framework/
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 */

class Error extends Controller
{

    /**
     * $error kapsamı
     *
     * @var string
     */
    private $_error = null;

    /**
     * footer_view de gorunmesi gerekne data lar burada görülecekdir
     *
     * @var array
     */
    private $footerDatasi = array();

    

    
    /**
     * hata kaydeder to $this->_error
     *
     * @param string $error
     */
    public function __construct($error)
    {
        parent::__construct();
        $this->_error = $error;

    }

    /**
     * 404 sayfasını basar
     */
    public function index()
    {
        
      
        header('Content-Type: text/html; charset=utf-8');
        $data['title'] = '404 Sayfası ';
        View::RenderTemplate('head_view', '');
      //  View::RenderTemplate('header_view', '');
        View::render('error/404', '');
        View::RenderTemplate('footer_view', '');
    }
    
    
    
    /**
     * 404 sayfasını basar
     */
    public function bakimModu()
    {
        header('Content-Type: text/html; charset=utf-8');
    
        $data['title'] = 'bakım Sayfası ';

        View::render('error/bakim', $data);
     
    }
    
    
    public function yapimAsamasi()
    {
    
    	
        /*
         * header("HTTP/1.0 404 Not Found");
         * $data['error'] = $this->_error;
         */
        $data['title'] = 'bakım Sayfası ';

        View::render('error/yapim_asamasi', $data);
    
    }
    
    /**
     * hataları gösterir
     *
     * @param array $error
     *            hatalar
     * @param string $class
     *            div in class ları
     * @return string hataların döneceği div basılacak olanı
     */
    public static function display($error, $class = 'alert alert-danger')
    {
        if (is_array($error)) {
            
            foreach ($error as $error) {
                $row .= "<div class='$class'>$error</div>";
            }
            return $row;
        } else {
            
            if (isset($error)) {
                return "<div class='$class'>$error</div>";
            }
        }
    }
}
