<?php
namespace Controllers;

// controller namespace ini kullanacağımı bildirdim
use \Core\Controller as controller;
use \Core\View;
use Symfony\Component\HttpFoundation\Request;
// view kullanımı için dahil edildi
class OrnekController extends controller
{

    /**
     * get ve post paramtreleri buradan geçer
     */
    private $request;

    public function __construct()
    {
        $this->request = Request::createFromGlobals();
    }

    /**
     * Ornek 1: kontroller ve router orneği
     * ekrana merhaba dunya yazdırır
     * http://cms.dev/merhaba
     */
    public function index()
    {
        echo 'Merhaba Dunya!';
    }

    /**
     * Ornek 2: router dan parametre gonderimi
     * Örnek routers parametresi bilgisi
     * http://cms.dev/parametre_test/selman
     */
    public function routers_parametresi($param)
    {
        echo 'Örnek routers parametresi bilgisi ' . $param;
    }

    /**
     * Ornek 3 -- View yapısı
     * view yapısının kullanımı
     * http://cms.dev/view_test
     */
    public function view_ornegi()
    {
        View::Render('ornekler/basit_ornek_view');
    }

    /**
     * Ornek 4 -- View layout yapısının kullanımı
     * view yapısının kullanımı
     * http://cms.dev/view_layout
     */
    public function view_layout()
    {
        View::RenderTemplate('head_view');
        View::RenderTemplate('header_view');
        View::Render('ornekler/basit_ornek_view');
        View::RenderTemplate('footer_view');
    }

    /**
     * Ornek 5 -- View dosyalarına veri gonderimi
     * view yapısının kullanımı
     * http://cms.dev/view_veri_aktarimi
     */
    public function view_veri_aktarimi()
    {
        $data = array(
            "site_adi" => "Hakkımızda",
            "icerik" => "lorem ipsum ,lorem ipsum, lorem ipsum, lorem ipsum ,lorem ipsum "
        );
        
        $data_head['site_baslik'] = "Hakkımızda";
        
        View::RenderTemplate('head_view', $data_head);
        View::RenderTemplate('header_view');
        View::Render('ornekler/data_aktarimi_view', $data);
        View::RenderTemplate('footer_view');
    }

    /**
     * Ornek 6 - modellerle çalışmak
     * modellerle çalışmak ornek bir
     * http://cms.dev/model_ornegi
     */
    public function model_ornegi()
    {
        $sayfa_Model = new \Models\ornekController_Model();
        $veri = $sayfa_Model->data();
        echo $veri['site_adi'];
        echo '<br>';
        echo $veri['icerik'];
    }

    /**
     * Ornek 7 - modellerle çalışmak
     * modellerle çalışmak ornek bir
     * http://cms.dev/model_view_aktarimi
     */
    public function model_ornegi_view_aktarimi()
    {
        $sayfa_Model = new \Models\ornekController_Model();
        $data = $sayfa_Model->data();
        $data_head['site_baslik'] = "Sağdıçlar Balıkçılık";
        View::RenderTemplate('head_view', $data_head);
        View::RenderTemplate('header_view');
        View::Render('ornekler/data_aktarimi_view', $data);
        View::RenderTemplate('footer_view');
    }

    /**
     * Ornek 8 - model ve veritabanı iliskisi
     * model
     * http://cms.dev/model_view_db
     */
    public function model_view_db()
    {
        $sayfa_Model = new \Models\ornekController_Model();
        $data = $sayfa_Model->sayfa_bilgisi();
        $data_head['site_baslik'] = "Sağdıçlar Balıkçılık";
        View::RenderTemplate('head_view', $data_head);
        View::RenderTemplate('header_view');
        View::Render('ornekler/data_aktarimi_db_view', $data);
        View::RenderTemplate('footer_view');
    }

    /**
     * Ornek9 helper yuklemek
     * helper
     * http://cms.dev/helper
     */
    public function helperlar()
    {
        $test = new \Helpers\URL_Helper();
        echo $test->url_adresi($url);
    }

    /**
     * library ler ile çalışmak
     * helper
     * http://cms.dev/library
     */
    public function library()
    {
        $arr = new \Lib\Arrays();
    }

    /**
     * Ornek 11 -- View yapısı
     * view yapısının kullanımı
     * http://cms.dev/request
     */
    public function request()
    {
        echo $this->request->get('isim');
    }

    /**
     * burada sepet ornekleri var
     * sepet yapısı
     * http://cms.dev/sepet
     */
    public function sepet()
    {
        // ornek kullanım şekilleri
        
        // http://cms.dev/sepet?action=sepet_tutari
        $action = $this->request->get('action');
        
        // eğer use olarak kullanılacaksa
        // use \Lib\Cart;
        // $sepet = new cart($cart_name, PUBLIC_PATH);
        $cart_name = 'stnc'; // sepetin session değerine bir değer atadık
        
        $cart = new \Lib\Cart($cart_name, PUBLIC_PATH);
        
        /**
         * sepete ekleme örnekleri
         */
        if ($action == "ekle") {
            
            $data = array(
                'UrunID' => 02,
                'UrunAdi' => "çikolata  ",
                'Resim' => "biskuvi.jpg",
                'ResimURL' => "biskuvi.jpg",
                'URL' => "biskuvi.jpg",
                'Fiyat' => 40.99,
                "ToplamAdet" => 1,
                "ToplamFiyat" => ""
            );
            // sepete eklenenen her ürün için benzersiz bir id verilmesi gerekir
            // 34 burada bunu temsil ediyor
            // bu mesela şu olabilir urunler tablosundaki urun_id yada sku değeri olabilir
            // bunlar tekil değerlerdir
            $cart->addToCart("100", $data);
            
            $data = array(
                'UrunID' => 05,
                'UrunAdi' => "kraker  ",
                'Resim' => "biskuvi.jpg",
                'ResimURL' => "biskuvi.jpg",
                'URL' => "biskuvi.jpg",
                'Fiyat' => 5,
                "ToplamAdet" => 1,
                "ToplamFiyat" => ""
            );
            $cart->addToCart("125", $data);
            
            // sepet blgisini ver
            $cart->viewCart();
            echo $cart->getJSON();
        }
        
        // /sepeti siler
        if ($action == "sil") {
            $cart->removeCart(100);
            $cart->viewCart();
        }
        
        // sepeti boşaltır
        if ($action == "bosalt") {
            $cart->emptyCart();
            $cart->viewCart();
        }
        
        if ($action == "mini_sepet_fiyat") {
            echo $cart->viewCartTablePrice();
        }
        
        /*
         * sepet sayfası na basılıcak yerdir
         * sepetteki ler hakkında table olarak ayrıntılı bilgi verir
         */
        if ($action == "table") {
            echo $cart->viewCartTableFull();
        }
        
        // sepet fiyat bilgisi verir
        if ($action == "sepet_tutari") {
            print_r($cart->cartCount());
            
            /*
             *
             * Array
             * (
             * [toplam_urun] => 2
             * [toplam_adet] => 4
             * )
             */
        }
    }

    /**
     * session sınıfı kullanımı
     * http://cms.dev/session
     */
    public function session()
    {
        session::set('message', 'merhaba');
        
        session::pull('message');
        
        echo session::get('message');
        
        print_r(session::display());
        
        session::destroy();
    }

    /**
     * session sınıfı kullanımı
     * http://cms.dev/string
     */
    public function string()
    {
        $string = new \Lib\Strings();
        $str = "lorem ipsum ,lorem ipsum,lorem ipsum ,lorem ipsum,lorem ipsum ,lorem ipsum,lorem ipsum ,lorem ipsum";
        $string->replaceSpace($str);
        
        $string->Hecele($str, 2);
        
        $adSoyad = "mehmet ali alacadağ";
        $isim = $string->adSoyadParcala($adSoyad);
        // print_r($isim);
        
        $string->cevir_artiya($adSoyad);
        
        $string->trURLtoCHAR($sr);
        
        $metin = "merHaba ali Veli Deli haSan";
        $string->strto_tr_lower_upper('lower', $metin);
        $string->strto_tr_lower_upper('upper', $metin);
        
        echo $string->strto_tr_ucwords($metin); // Merhaba Ali Veli Deli Hasan
    }

    /**
     * zaman olaylarının ornekleri
     * http://cms.dev/zaman
     */
    public function zaman()
    {
        $zaman = new \Lib\ZamanOlaylari();
        
        echo $zaman->TarihHangiGun('2015-08-29', '-'); // sonuç :Monday
    }

    /**
     * sayfalama olaylarının ornekleri
     * http://cms.dev/sayfalama
     */
    public function sayfalama()
    {
        $pages = new \Lib\Paginator('20', 'page');
        $toplam_urun = "50"; // burası modelden gelebilir
        $pages->setTotal($toplam_urun);
        $pagination = \Helpers\URL_Helper::PaginationLink();
        $data['urun_sayfalama_linkler'] = $pages->pageLinks($pagination);
        View::Render('ornekler/data_aktarimi_db_view', $data);
    }

    /**
     * upload örneği
     * http://cms.dev/upload
     */
    public function upload()
    {
        echo '
            <form role="form" method="post" action="" enctype="multipart/form-data" id="posts">
            <input type="file" class="textbox-value" class="btn btn-default btn-file" name="uploadPic[]"></br>
            <input type="submit"  name="gonder"></br>
            </form>
            ';
        
        if (count($_FILES['uploadPic']['name']) > 0) {
            $file_size = '2000000'; // dosya boyutu
            $allowed_types = 'jpg,gif,png,jpeg'; // izin verilen uzantılar
            $input_names = array(); // gececi aktarılacak yer
            $input_names = $_FILES['uploadPic']; // yuklenecek olan input değeri
            $Uploader = new \Lib\Uploader(); // upload tanıtılır
            $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/public/resimler'; // resim yukleneceği yeri gosterir
            $Uploader->name_format(false, 'st_', '_nc'); // resim onek ve sonek orneğidir //eğer değer true ise resim yuklendiği ismi ile yuklenir
            $Uploader->picture_control_value = true; // resimin gerçek olup olmadığını kontrol eçindir
            $Uploader->uploader_set($input_names, $upload_dir, $allowed_types, $file_size); // upload a ayarları tanıtılır
                                                                                            
            // burada upload yuklenirken veritabanına kayıt etme örneği
            for ($i = 0; $i < count($Uploader->uploaded_files); $i ++) {
                $picture = $Uploader->uploaded_files[$i];
                $data = array(
                    'photo_post_id' => $last_id,
                    'photo_filename' => $picture,
                    'photo_status' => 'open'
                );
                
                // $this->_model->postsPicturesInsert($data);
            }
            
            if (! $Uploader->uploaded) {
                echo $Uploader->result_report();
            }
        }
        
        // <input type="file" class="textbox-value" class="btn btn-default btn-file" name="uploadPic[]"></br>
    }
    
    
    
    /**
     * araçlar sayfası
     * http://cms.dev/tools
     */
    public function tools()
    {
        $tool = new \Lib\Tools();
        
        //printr çıktısı
        $data = array(
            'UrunID' => 02,
            'UrunAdi' => "çikolata  ",
            'Resim' => "biskuvi.jpg",
            'ResimURL' => "biskuvi.jpg",
            'URL' => "biskuvi.jpg",
            'Fiyat' => 40.99,
            "ToplamAdet" => 1,
            "ToplamFiyat" => ""
        );
       // $tool->printr($data);
        
       // $tool->fileInfo();
      //echo  $tool->token_key_olustur();
       //echo  $tool->currentPageURL();
       echo  $tool->curPageName();
    }
    
    /**
     * araçlar sayfası
     * http://cms.dev/tools
     */
    public function dil()
    {
        
    $lng = new \Core\Language();
    $lng->defaultLanguage="en";//dili belirtiyoruz
    $lng->load('anasayfa');//yuklenecek olan dosyayı belirtiyoruz
    echo  $lng->get('welcome_text');//dizinin içindeki yazıyı gosteriyoruz

    }

}