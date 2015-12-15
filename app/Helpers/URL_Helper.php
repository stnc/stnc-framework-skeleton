<?php
namespace Helpers;

/**
 * url ile işlemlerin kontrol edildiği kısımdır
 *
 * @author Selman TUNÇ <selmantunc@gmail.com>
 * @copyright Copyright (c) 2015 SELMAN TUNÇ
 *
 * @link https://github.com/stnc/stnc-framework/
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 *          çalışan
 */
class URL_Helper
{



    /**
     * geçerli url adresi
     *
     * @param string $link
     * @return string
     */
    public function url_adresi($url)
    {
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }

    

    /**
     * link içindeki boş olan key değerlerinin sileri
     *
     * @example LinkTemizle(http://smvc.dev/kategori/gida_ve_icecek?page=2&m=&cinsiyet=erkek )
     *          sonuc = http://smvc.dev/kategori/gida_ve_icecek?page=2&cinsiyet=erkek
     * @param string $link
     * @return string
     */
    private function LinkTemizle($url)
    {
        $path = parse_url($url, PHP_URL_PATH);
        // query var mı ona bakılır
        $queryKontrolQueryName = parse_url($url, PHP_URL_QUERY);
        $dir = substr(DIR, 0, - 1); // bu / işareti sil
        parse_str($queryKontrolQueryName, $output);
    
        $deleted = array(
            ''
        );
        $sonuc = array_diff($output, $deleted); // boşlukları sildir
        $yeni = array_unique($sonuc); // aynı olanları sil
    
        $query = http_build_query($yeni);
        return $dir . $path . '?' . $query;
    }
    
    /**
     * pagination kısmını linkler
     *
     * @return string
     */
    public static function PaginationLink()
    {
        $url = \Lib\Tools::currentPageURL();
        $path = parse_url($url, PHP_URL_PATH);
        // query var mı ona bakılır
        $queryKontrolQueryName = parse_url($url, PHP_URL_QUERY);
        $dir = substr(DIR, 0, - 1); // bu / işareti sil
        if (! empty($queryKontrolQueryName)) {
            // https://secure.php.net/parse_str Dizge içindeki değişkenleri çözümledik yani diziye donuşturdum
            parse_str($queryKontrolQueryName, $output);
    
            // query içinde page varsa sil
            if (array_key_exists('page', $output)) {
                unset($output['page']); // varsa sil
                $linkleme = '';
                // sort haricindekileri yeniden linkle
    
                foreach ($output as $anakey => $value) {
                    if (! empty($value)) {
                        $linkleme .= '&' . $anakey . '=' . $value;
                    }
                }
                $linkleme = substr($linkleme, 1); // bu / işareti sil
    
                if (! empty($linkleme)) {
                    $links = $linkleme . '&';
                } else {
                    $links = $linkleme;
                }
    
                return self::LinkTemizle($dir . $path . '?' . $links);
            } else {
    
                return $url . '&';
            }
        } else {
    
            return self::LinkTemizle($url . '?');
        }
    }

}