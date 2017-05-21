<?php
session_start();
use \Lib\Session;
/*
 * @package core/config.php dosyasına bağlıdır
 */

/*
 * ---------------------------------------------------------------
 * APPLICATION ORTAMI
 * ---------------------------------------------------------------
 *
 * fw nin geliştirme yapılması yada canlı çalışmasına göre ayarlamalar kısmı
 *
 * herhangi birşey verilmezse development ayarlaında çalışır :
 *
 * development
 * production
 *
 * NOT
 *
 */

// set timezone ayarı
date_default_timezone_set('Europe/Istanbul');

//burası birkaç yeri etkiler silmeyin
define('ENVIRONMENT', 'development'); // production / development
                                      
//memcache options
define('MEMCACHED_HOST', '127.0.0.1');
define('MEMCACHED_PORT', '11211');
define('MEMCACHED_STATUS', false); //memcache aktif olup olmayacağını belirtir 

/*
 * ---------------------------------------------------------------
 * HATA RAPORLARI
 * ---------------------------------------------------------------
 *
 * sistemin farklı modlarda çalışmasına göre raporlama ayarları
 * live sitede hataları kapatınız
 */

if (defined('ENVIRONMENT')) {

    switch (ENVIRONMENT) {
        case 'development':
             error_reporting(E_ALL & ~E_NOTICE);
            ini_set('display_errors', 'On');
            //   error_reporting(E_ALL & ~E_NOTICE);
            break;

        case 'production':
            error_reporting(0);
            ini_set('display_errors', 'Off');
            break;

        default:
            exit('Uygulamanın çalışma ortamını ayarlayınız');
    }
}
define('SMARTY_ENGINE_STATUS', true); //memcache aktif olup olmayacağını belirtir 

define('DIR', 'http://cms.dev/');
define('RuntimePath', 'cms.localhost');
define('PUBLIC_PATH', 'public');
define('PUBLIC_URL', DIR.'/'.PUBLIC_PATH.'/');//reklamlar alanı içindir

define('FRAMEWORK_VERSION', '3.0.0.1');

define('BISLEM_RESIM_YOLU', PUBLIC_URL.'resimler/urunler/');
define('BISLEM_RESIM_YOLU_DIR', 'resimler/urunler/');
//define('BISLEM_RESIM_YOLU', 'http://212.156.40.90:8081/dosyalar/webofisim_2013/stok_foto/');
//define('BISLEM_RESIM_YOLU', 'http://10.0.0.118/dosyalar/webofisim_2013/stok_foto/');

define('BISLEM_RESIM_BULUNAMADİ', DIR . PUBLIC_PATH . '/img/ozel/resim_bulunamadi.jpg');

define('GoogleAnalytics', false);
define('LINKVERSION', '?'.date('Ymd'));
// varsaylan kontoller ve fonksiyonu
// TODO: değişmesi gerekiyor
define('DEFAULT_CONTROLLER', 'welcome');
define('DEFAULT_METHOD', 'index');

// varsayalan site dili
define('LANGUAGE_CODE', 'tr');


 
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'test');
define('DB_USER', 'root');
define('DB_PASS', '');


//
define('PREFIX', 'dr_'); // onek

                             
// sessions oneki
define('SESSION_PREFIX', 'st_');


// web site varsayaln bağşlığı
define('SITETITLE', ' Web Admin Panel');

define('SIRKET_ISMI', 'SAĞDIÇLAR İDEAL GIDA SAN VE DIŞ TİC A.Ş.');

define('SIRKET_ADRES_BILGILERI', 'Madenler Mah. Alemdağ Cad. Arafat Sok. No:2<br>
Ümraniye <br>
İstanbul, Türkiye<br>
Telefon: (0216) 364 24 37-38-39 <br>
Faks: (0216) 364 24 33<br>');




