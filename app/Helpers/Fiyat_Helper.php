<?php
namespace Helpers;

/**
 * fiyat hesaplamaları ve o türden özellikdeki bilgileri barındıracak
 * @author Selman TUNÇ <selmantunc@gmail.com>
 * @copyright Copyright (c) 2015 SELMAN TUNÇ

 * @link https://github.com/stnc/stnc-framework/
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class Fiyat_Helper
{

    /**
     * çıktı kullanıcının göreceği hali
     *
     * @example tr_number(1.75); sonuc 1,75
     * @param money $x
     * @param number $d
     * @return string
     *
     */
    function tr_number($x, $d = 2)
    {
        $x = number_format($x, $d, '.', '');
        $x = preg_replace("[^0-9\.-]", "", $x);
        return number_format($x, $d, ',', '.');
    }

    /**
     * db ye gidecek hali
     *
     * @example db_number(1,75); sonuc 1.75
     * @param money $x
     * @param number $d
     * @return string
     */
    function db_number($x)
    {
        $x = preg_replace("[^0-9\.,-]", "", $x);
        $x = str_replace(".", "", $x);
        $x = str_replace(",", ".", $x);
        return $x;
    }

    /**
     *vergi oranını verir
     * @example vergi_oranlari(3) sonuc: 8
     *
     * @param number $d
     * @return number
     */
    function vergi_orani($oran)
    {
        $vergi_isim = array(
            0 => 0,
            1 => 0,
            2 => 1,
            3 => 8,
            4 => 18,
            5 => 26
        );
        return $vergi_isim[$oran];
        // vergi isimleri (3=>%8)
        // $vergi_kodlar = array_combine(array_values($vergi_isim),array_keys($vergi_isim)); //18=>4
        //TODO : vergi kodlarına bakılacak
    }

    /**
     * **
     * Örnek: 600 TL lik bir malın %18 KDV si ne kadardır?
     *
     * Cevap: 600 x 0.18 = 600 x (18 / 100) = 108 TL KDV tutarıdır.
     *
     * Malın KDV dahil fiyatı = 600 TL + 108 TL = 708 TL dir.
     *
     * Malın KDV hariç fiyatı = 600 TL dir.
     * *
     */
    
    /**
     * kdv tutarını verir ,ürünün kdv tutarı ne kadar onu verir
     *
     * @param money $x
     * @param number $d
     * @return string
     */
    function kdv_tutari($fiyat, $kdv)
    {
        return $fiyat * $kdv / 100;
    }

    /**
     * çıktı kullanıcının göreceği hali
     * turk lirası formatı
     *
     * @example tr_number(1234.56); sonuc 1.234,56
     * @param money $x
     * @param number $d
     * @return string
     *
     */
    public function TLFormat($value)
    {
        return number_format($value, 2, ',', '.');
    }
}