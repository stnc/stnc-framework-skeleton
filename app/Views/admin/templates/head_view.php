<?php
use DebugBar\StandardDebugBar;
if (ENVIRONMENT == 'development') {
    $debugbar = new StandardDebugBar();
    $debugbarRenderer = $debugbar->getJavascriptRenderer();
}
?>
<!DOCTYPE html>
<html lang="<?php echo LANGUAGE_CODE; ?>">
<head>
<?php
if (ENVIRONMENT == 'development') {
    echo $debugbarRenderer->renderHead();
}
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $page_title.' - '.SITETITLE; ?></title>
<meta name="description" content="<?php echo $meta_aciklama;?> kapıda ödeme avantajı, hızlı kargo ve 365 gün iade avantajıyla ideal.com.tr'de uygun fiyatlarla satışta!">
<meta name="keywords" content="ideal sanal market,ideal sanal market,ideal.com.tr,<?php echo $meta_keywords;?>">
<link rel="shortcut icon" href="<?php echo DIR.PUBLIC_PATH."/img/ozel/".'favicon.ico' ?>" />
<meta property="fb:app_id" content="">
<link href="https://plus.google.com/u/0/107483710860855918230"	rel="publisher">
<link rel="image_src" href="<?php echo $meta_image;?>">
<link rel="canonical"href="<?php echo $meta_link;?>">
<meta property="og:site_name" content="İdeal Sanal Market">
<meta property="og:url"	content="<?php echo $meta_link;?>">
<meta property="og:title" content="<?php echo $baslik.' - '.SITETITLE; ?> ">
<meta property="og:image" content="<?php echo $meta_image;?>">
<meta property="og:description"	content="<?php echo $meta_aciklama;?> kapıda ödeme avantajı, hızlı kargo ve 365 gün iade avantajıyla ideal.com.tr'de uygun fiyatlarla satışta!">
<meta itemprop="image" content="<?php echo $meta_image;?>">
<meta name="robots" content="INDEX,FOLLOW" />
<meta name="robots" content="NOODP">
<?php
Lib\Assets::css(array(
    '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
    'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css',
		Lib\Url::publicPath() . '/admin/css/AdminLTE.min.css',
		Lib\Url::publicPath() . '/admin/css/skins/_all-skins.min.css',
		Lib\Url::publicPath() . '/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
));



Lib\Assets::js(array(
    'https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js',
		Lib\Url::publicPath() .'/admin/bootstrap/js/bootstrap.min.js',
		Lib\Url::publicPath() .'/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"'
));

/*
 * //maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css
 *
 * Lib\Url::publicPath(). '/css/font-awesome.min.css',
 * 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css',
 * Lib\Url::publicPath(). '/css/font-awesome.min.css',
 * Lib\Url::publicPath(). '/css/bootstrap.min.css',
 * Lib\Url::publicPath(). '/css/style.css',
 */
?>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>


