<?php
new \Core\Config();
//TODO : çok fazla routers var kurtulmak gerek
// bu kısımda url (router) ayarları yapılır
use \Core\Router, \Lib\Url;

Router::any('', '\Controllers\Sayfalar@sayfa'); // anasayfa

//Router::any('', '\Controllers\Admin\Pages@index'); // anasayfa
Router::any('sayfa/(:any)', '\Controllers\Sayfalar@sayfa'); // sayfalar içine al anasayfa değil

Router::any('iletisim', '\Controllers\Iletisim@index');

#uyelik
Router::any('admin/uyelik', '\Controllers\Admin\Auth@index');
Router::any('admin/login', '\Controllers\Admin\Auth@logins');//login ADMİN



Router::any('test', function() {
   echo 'merhaba router da yazan dosyayı işaret eder';
});
 

Router::any('admin', '\Controllers\Admin\Pages@index');
//admin panel sayfa ekleme
Router::any('admin/pages', '\Controllers\Admin\Pages@index');
Router::any('admin/pages_edit/(:num)', '\Controllers\Admin\Pages@edit');
Router::any('admin/pages_delete/(:num)', '\Controllers\Admin\Pages@delete');
Router::any('admin/pages_add', '\Controllers\Admin\Pages@add');


// kategori yapısı
Router::any('admin/cat_pages', '\Controllers\Admin\CatPages@index');
Router::any('admin/cat_pages_edit/(:num)', '\Controllers\Admin\CatPages@edit');
Router::any('admin/cat_pages_delete/(:num)', '\Controllers\Admin\CatPages@delete');
Router::any('admin/cat_pages_add', '\Controllers\Admin\CatPages@add');

/*sürekli kullanılacak*/
Router::any('admin/picture_delete/(:num)', '\Controllers\Admin\Pages@delete_picture');//tum resimler buradan silenecek



/*örrnekler kısmına ait bilgiler*/
Router::any('merhaba', '\Controllers\ornekController@index');//http://cms.dev/merhaba
Router::any('parametre_test/(:any)', '\Controllers\ornekController@routers_parametresi');//http://cms.dev/parametre_test/selman
Router::any('view_test', '\Controllers\ornekController@view_ornegi');//http://cms.dev/view_test
Router::any('view_layout', '\Controllers\ornekController@view_layout');//http://cms.dev/view_layout
Router::any('view_veri', '\Controllers\ornekController@view_veri_aktarimi');//http://cms.dev/view_veri
Router::any('model_ornegi', '\Controllers\ornekController@model_ornegi');//http://cms.dev/model_ornegi
Router::any('model_view_aktarimi', '\Controllers\ornekController@model_ornegi_view_aktarimi');//http://cms.dev/model_view_aktarimi
Router::any('model_view_db', '\Controllers\ornekController@model_view_db');//http://cms.dev/model_view_db
Router::any('helper', '\Controllers\ornekController@helperlar');//http://cms.dev/helper
Router::any('library', '\Controllers\ornekController@library');//http://cms.dev/library
Router::any('request', '\Controllers\ornekController@request');//http://cms.dev/request
Router::any('sepet', '\Controllers\ornekController@sepet');//http://cms.dev/sepet
Router::any('session', '\Controllers\ornekController@session');//http://cms.dev/session
Router::any('string', '\Controllers\ornekController@string');//http://cms.dev/string
Router::any('zaman', '\Controllers\ornekController@zaman');//http://cms.dev/zaman
Router::any('sayfalama', '\Controllers\ornekController@sayfalama');//http://cms.dev/sayfalama
Router::any('upload', '\Controllers\ornekController@upload');//http://cms.dev/upload
Router::any('tools', '\Controllers\ornekController@tools');//http://cms.dev/tools
Router::any('dil', '\Controllers\ornekController@dil');//http://cms.dev/dil
// hata sayfası url bulunmazsa bu sayfaya gider
Router::error('\Controllers\Error@index');

// turn on old style routing
Router::$fallback = false;

// execute matched routes
Router::dispatch();
