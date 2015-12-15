<?php

namespace Core;

/**
 * STNC FW
 *
 * Copyright (c) 2015
 *
 * Author(s): Selman TUNÇ www.selmantunc.com <selmantunc@gmail.com>
 * model yapısı
 *
 * @author Selman TUNÇ <selmantunc@gmail.com>
 * @copyright Copyright (c) 2015 SELMAN TUNÇ
 * @link http://github.com/stnc
 * @link https://github.com/stnc/stnc-framework/
 * @version 2.0.0.1
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 */
abstract class Model extends Controller
{

    /**
     * database bağlntısı ku r
     *
     * @var object
     */
    protected $_db;

    /**
     * database helper ına nesneyi init et
     */
    public function __construct()
    {
        
        // PDO bağlantısı yapılır
        $this->_db = \Lib\Database::get();
    }
}
