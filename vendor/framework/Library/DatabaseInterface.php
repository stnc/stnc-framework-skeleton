<?php
namespace Lib;

/**
 * veritabanı interface yapılır
 * STNC FW
 * Copyright (c) 2015
 * Author(s): Selman TUNÇ www.selmantunc.com <selmantunc@gmail.com>
 *
 * @author Selman TUNÇ <selmantunc@gmail.com>
 * @copyright Copyright (c) 2015 SELMAN TUNÇ
 * @link http://github.com/stnc
 * @link https://github.com/stnc/stnc-framework/
 * @version 2.0.0.1
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 */
use \PDO;

interface DatabaseInterface
{

    /**
     * method for multiple rows selecting records from a database
     *
     * @param string $sql
     *            sql query
     * @param array $array
     *            named params
     * @param object $fetchMode
     * @return array returns an array of records
     * @example en iyi ornekl sayfalar model içinde vardır getKategoriSayfalar
     */
    function rows($sql, $array = array(), $fetchMode = 'array');

    /**
     * tek bir datayı gönderir
     *
     * @param string $sql
     *            sql query
     * @param array $array
     *            named params
     * @param object $fetchMode
     * @return array returns an array of records
     */
    function fetch($sql, $fetchMode = 'array');

    /**
     * insert method
     *
     * @param string $table
     *            table name
     * @param array $data
     *            array of columns and values
     */
    function insert($table, $data);

    /**
     * update method
     *
     * @param string $table
     *            table name
     * @param array $data
     *            array of columns and values
     * @param array $where
     *            array of columns and values
     */
    function update($table, $data, $where);

    /**
     * Delete method
     *
     * @param string $table
     *            table name
     * @param array $data
     *            array of columns and values
     * @param array $where
     *            array of columns and values
     * @param integer $limit
     *            limit number of records
     */
    function delete($table, $where, $limit = 1);

    /**
     * son eklenenin id numarası
     */
    function lastInsertId();

    /**
     * son hatayı verir
     */
    function error();
}
