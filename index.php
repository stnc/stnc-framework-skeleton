<?php



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(- 1);

// define('BASEPATH', str_replace("\\", "/", $system_path));
// require_once BASEPATH . 'core/CodeIgniter.php';
// if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * SAVEAS FRAMEWORK
 *
 * Copyright (c) 2015
 *
 * Author(s): Selman TUNÇ www.selmantunc.com <selmantunc@gmail.com>
 * Author(s): YUSUF YALÇIN
 * Author(s): SUAT ERENLER
 * Licensed under the MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @author Selman TUNÇ <selmantunc@gmail.com>
 * @copyright Copyright (c) 2015 SAVEAS YAZILIM
 * @link http://github.com/stnc
 * @link http://www.saveas.com.tr/
 * @version 2.0.0.1
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 */

// TODO : urunler kategorisinde yan bar daki alana her alanın adetini yazacak
if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';
} else {
    echo "<h1>Lütfen composer.json ı yükleyin </h1>";
    echo "<p>Örnekler <a href='https://getcomposer.org/doc/00-intro.md#globally'>https://getcomposer.org/doc/00-intro.md#globally</a></p>";
    echo "<p> terminal/cmd yi açarak  'composer install' yazınız</p>";
    exit();
}

if (! is_readable('vendor/framework/Core/Config.php')) {
    die('config.php bulunamadı, config.example.php dosyasının ismini değiştirip config.php yapınız ve  app/core. içine atınız ');
}



// rotuter lar tanımlanır namespace de include olmaz başka bi çözüm lazım
if (! is_readable('app/Routers.php')) {
    die('routes dosyası bulunamadı app içinde routes oluşturunuz ');
} else {
    include "app/Routers.php";
}



