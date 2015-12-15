<?php
namespace Models;
/**
 * yorumların kontroleri ile ilgili modeldir
 * @author Selman TUNÇ <selmantunc@gmail.com>
 * @copyright Copyright (c) 2015 SELMAN TUNÇ
 * @link https://github.com/stnc/stnc-framework/
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @todo bazı özellikleri urunler / kategori kategoriler de de var hepsi tek bir alana alınmalıdır
 */
class Yorumlar_Model extends \Core\Model
{


    
    /**
     *yorum ekler
     * @param array $data
     * @param string $uye_email
     * @return boolean
     */
    public function insert_yorum($data)
    {
      $this->_db->insert(PREFIX. "urun_yorumlari", $data);
        
      return  $this->_db->lastID();
        

    }

    /**
     * yorumlar onaylı olanlar
     *
     * @param int $urunId
     */
    public function UrunYorumlari($urunId)
    {
        $sql  = "select " . PREFIX . "urun_yorumlari.*,
           (select unvan  FROM " . PREFIX_ERP . "cari WHERE id=" . PREFIX . "urun_yorumlari.uye_id) as ad_soyad
           FROM  " . PREFIX . "urun_yorumlari where  urun_id='$urunId' and durum=1 ";
        return $data = $this->_db->rows( $sql );
    }
    
    /**
     * kullanici bilgileri
     *
     * @param string $email
     */
    public function getKullaniciBilgileri($email)
    {
         $sql  = "select " . PREFIX_ERP . "cari.*,(SELECT durum FROM " . PREFIX . "kampanya_habercisi where uye_id=" . PREFIX_ERP . "cari.id) as kampanya FROM " . PREFIX_ERP . "cari where email='$email' ";
        return $data = $this->_db->fetch( $sql );
    }
}