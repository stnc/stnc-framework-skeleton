<?php
namespace Models;

/**
 * controller içine , model dosyasını verir
 * @link https://github.com/stnc/stnc-framework/
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class ornekController_Model extends \Core\Model
{

    public function data()
    {
        $data = array(
            "site_adi" => "Hakkımızda",
            "icerik" => "içerik sayfası ,modelden gelen ,lorem ipsum ,lorem ipsum, lorem ipsum, lorem ipsum ,lorem ipsum "
        );
        return $data;
    }

    /**
     * sayfa bilgisini verir
     *
     */
    public function sayfa_bilgisi()
    {
        $sql = "select * FROM " . PREFIX . "sayfalar where id=1";
        return $data = $this->_db->fetch($sql);
    }
}