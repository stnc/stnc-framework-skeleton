<?php
namespace Lib;

/**
 * veritabanı bağlantıları yapılır
 * STNC FW
 * Copyright (c) 2015
 * Author(s): Selman TUNÇ www.selmantunc.com <selmantunc@gmail.com>
 *
 * @todo webofisim db de eklenecek
 * @author Selman TUNÇ <selmantunc@gmail.com>
 * @copyright Copyright (c) 2015 SELMAN TUNÇ
 * @link http://github.com/stnc
 * @link https://github.com/stnc/stnc-framework/
 * @version 2.0.0.1
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 */
use \PDO;

class Database extends PDO implements DatabaseInterface
{

    /**
     *
     * @var array Array of saved databases for reusing
     */
    protected static $instances = array();

    /**
     * Static method get
     *
     * @param array $group            
     * @return \lib\database
     */
    public static function get($group = false)
    {
        
        // Determining if exists or it's not empty, then use default group defined in config
        $group = ! $group ? array(
            'type' => DB_TYPE,
            'host' => DB_HOST,
            'name' => DB_NAME,
            'user' => DB_USER,
            'pass' => DB_PASS
        ) : $group;
        
        // Group information
        $type = $group['type'];
        $host = $group['host'];
        $name = $group['name'];
        $user = $group['user'];
        $pass = $group['pass'];
        
        // ID for database based on the group information
        $id = "$type.$host.$name.$user.$pass";
        
        // Checking if the same
        if (isset(self::$instances[$id])) {
            return self::$instances[$id];
        }
        
        try {
            // I've run into problem where
            // SET NAMES "UTF8" not working on some hostings.
            // Specifiying charset in DSN fixes the charset problem perfectly!
            $instance = new Database("$type:host=$host;dbname=$name;charset=UTF8", $user, $pass, array(
                PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false
            ));
            
            $instance->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8'); // new -> stnc
            $instance->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
            /*
             * benim eski mvc den
             * self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             * self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
             */
            
            // Setting Database into $instances to avoid duplication
            self::$instances[$id] = $instance;
            
            return $instance;
        } catch (PDOException $e) {
            // in the event of an error record the error to errorlog.html
            Logger::newMessage($e);
            logger::customErrorMsg();
        }
    }

    /**
     * method for multiple rows selecting records from a database
     * birden fazla kolon bilgisini gonderir
     *
     * @param string $sql
     *            sql query
     * @param array $array
     *            named params
     * @param object $fetchMode            
     * @return array returns an array of records
     * @example en iyi ornekl sayfalar model içinde vardır getKategoriSayfalar
     */
    public function rows($sql, $array = array(), $fetchMode = 'array')
    {
        if ($fetchMode == 'array') {
            $fetchMode = PDO::FETCH_ASSOC;
        } else 
            if ($fetchMode == 'object') {
                $fetchMode = PDO::FETCH_OBJ;
            }
        
        $stmt = $this->prepare($sql);
        foreach ($array as $key => $value) {
            if (is_int($value)) {
                $stmt->bindValue("$key", $value, PDO::PARAM_INT);
            } else {
                $stmt->bindValue("$key", $value);
            }
        }
        
        $stmt->execute();
        return $stmt->fetchAll($fetchMode);
    }

    /**
     * json data return
     */
    public function ToJson()
    {
        if ($fetchMode == 'array') {
            $fetchMode = PDO::FETCH_ASSOC;
        } else 
            if ($fetchMode == 'object') {
                $fetchMode = PDO::FETCH_OBJ;
            }
        
        $stmt = $this->prepare($sql, array(
            PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false
        ));
        
        $stmt->execute();
        
        return $stmt->fetch($fetchMode);
    }

    /**
     * method for single row selecting records from a database
     * tek bir datayı/kolon bilgisini gönderir
     *
     * @param string $sql
     *            sql query
     * @param array $array
     *            named params
     * @param object $fetchMode            
     * @return array returns an array of records
     */
    public function fetch($sql, $fetchMode = 'array')
    {
        if ($fetchMode == 'array') {
            $fetchMode = PDO::FETCH_ASSOC;
        } elseif ($fetchMode == 'object') {
            $fetchMode = PDO::FETCH_OBJ;
        }
        
        $stmt = $this->prepare($sql, array(
            PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false
        ));
        
        $stmt->execute();
        
        return $stmt->fetch($fetchMode);
    }

    /**
     * insert method
     *
     * @param string $table
     *            table name
     * @param array $data
     *            array of columns and values
     */
    public function insert($table, $data)
    {
        ksort($data);
        
        $fieldNames = implode(',', array_keys($data));
        $fieldValues = ':' . implode(', :', array_keys($data));
        
        $stmt = $this->prepare("INSERT INTO $table ($fieldNames) VALUES ($fieldValues)");
        
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        
        $stmt->execute();
    }

    /**
     * update method
     * //güncelleme işlemleri yapan kısım
     *
     * @param string $table
     *            table name
     * @param array $data
     *            array of columns and values
     * @param array $where
     *            array of columns and values
     */
    public function update($table, $data, $where)
    {
        ksort($data);
        
        $fieldDetails = NULL;
        foreach ($data as $key => $value) {
            $fieldDetails .= "$key = :$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');
        
        $whereDetails = NULL;
        $i = 0;
        foreach ($where as $key => $value) {
            if ($i == 0) {
                $whereDetails .= "$key = :$key";
            } else {
                $whereDetails .= " AND $key = :$key";
            }
            
            $i ++;
        }
        $whereDetails = ltrim($whereDetails, ' AND ');
        $s = "UPDATE $table SET $fieldDetails WHERE $whereDetails";
        
        $stmt = $this->prepare($s);
        
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        
        foreach ($where as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        
        $stmt->execute();
    }

    /**
     * Delete method
     * TR : silme işlemleri yapan kısım
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
    public function delete($table, $where, $limit = 1)
    {
        ksort($where);
        
        $whereDetails = NULL;
        $i = 0;
        foreach ($where as $key => $value) {
            if ($i == 0) {
                $whereDetails .= "$key = :$key";
            } else {
                $whereDetails .= " AND $key = :$key";
            }
            
            $i ++;
        }
        $whereDetails = ltrim($whereDetails, ' AND ');
        
        // if limit is a number use a limit on the query
        if (is_numeric($limit)) {
            $uselimit = "LIMIT $limit";
        }
        $sql = "DELETE FROM $table WHERE $whereDetails $uselimit";
        $stmt = $this->prepare($sql);
        
        foreach ($where as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        
        $stmt->execute();
    }

    /**
     * son eklenenin id numarası
     */
    function lastID()
    {
        return $this->lastInsertId();
    }

    /**
     * son hatayı verir
     */
    function error()
    {
        return $this->error();
    }

    /**
     * tek sonuc verir
     *
     * @param string $sql
     *            table name
     */
    function result($sql)
    {
        $val = current(array_values($this->fetch($sql)));
        return $val;
    }

    /**
     * truncate table
     *
     * @param string $table
     *            table name
     */
    public function truncate($table)
    {
        return $this->exec("TRUNCATE TABLE $table");
    }
}
