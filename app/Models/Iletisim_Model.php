<?php
namespace Models;
/**
 * iletişim için gerekli modeldir
 * @author Selman TUNÇ <selmantunc@gmail.com>
 * @copyright Copyright (c) 2015 SELMAN TUNÇ

 * @link https://github.com/stnc/stnc-framework/
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class Iletisim_Model extends \Core\Model
{


    private $table_prefix = 'cms_';
    
    private $table = 'messages';

    
    /**
     * son id değerini verir
     *
     * @return string
     */
    public function last_id()
    {
        return $this->_db->lastID();
    }

    /**
     *sitelerden mesajlar tablosuna ekleme yapar
     *
     * @param array $data
     * @return boolean
     */
    public function ekle($data)
    {
        
        $table=PREFIX . $this->table_prefix . $this->table;
        
        $this->_db->insert($table, $data);
        return true;
    }

    
    

    




    

}