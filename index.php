<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(- 1);

/**
 * STNC FRAMEWORK
 *
 * Author(s): Selman TUNÇ www.selmantunc.com <selmantunc@gmail.com>
 *
 * Licensed under the MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @author Selman TUNÇ <selmantunc@gmail.com>
 * @copyright Copyright (c) 2017
 * @link http://github.com/stnc
 * @version 3.0.0.0
 * @date 26.03.2017
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 */

// TODO : urunler kategorisinde yan bar daki alana her alanın adetini yazacak
if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';
} else {
    echo "<h1>Lütfen composer.json ı yükleyin </h1>";
    echo "<p>Örnekler <a href='https://getcomposer.org/doc/00-intro.md#globally'>https://getcomposer.org/doc/00-intro.md#globally</a></p>";
    echo "<p> terminal yada cmd yi açarak  'composer install' yazınız</p>";
    echo "<p> eğer yuklü ise terminal yada cmd yi açarak  'composer update' yazınız</p>";
    exit();
}

if (! is_readable('vendor/stnc/framework/src/Core/Config.php')) {
    die('config.php bulunamadı, config.example.php dosyasının ismini değiştirip config.php yapınız ve  app/core. içine atınız ');
}



// rotuter lar tanımlanır namespace de include olmaz başka bi çözüm lazım
if (! is_readable('app/Routers.php')) {
    die('routes dosyası bulunamadı app içinde routes oluşturunuz ');
} else {
    include "app/Routers.php";
}



