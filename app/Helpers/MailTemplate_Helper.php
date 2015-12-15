<?php
namespace Helpers;


/**
 * maillerin arayüz dosyaları bulunur
 * @author Selman TUNÇ <selmantunc@gmail.com>
 * @copyright Copyright (c) 2015 SELMAN TUNÇ
 * @link https://github.com/stnc/stnc-framework/
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class MailTemplate_Helper
{

    function test()
    {
        return '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Really Simple HTML Email Template</title>
<style>
/* -------------------------------------
		GLOBAL
------------------------------------- */
* {
	margin:0;
	padding:0;
	font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
	font-size: 100%;
	line-height: 1.6;
}

img {
	max-width: 100%;
}

body {
	-webkit-font-smoothing:antialiased;
	-webkit-text-size-adjust:none;
	width: 100%!important;
	height: 100%;
}


/* -------------------------------------
		ELEMENTS
------------------------------------- */
a {
	color: #348eda;
}

.btn-primary, .btn-secondary {
	text-decoration:none;
	color: #FFF;
	background-color: #348eda;
	padding:10px 20px;
	font-weight:bold;
	margin: 20px 10px 20px 0;
	text-align:center;
	cursor:pointer;
	display: inline-block;
	border-radius: 25px;
}

.btn-secondary{
	background: #aaa;
}

.last {
	margin-bottom: 0;
}

.first{
	margin-top: 0;
}


/* -------------------------------------
		BODY
------------------------------------- */
table.body-wrap {
	width: 100%;
	padding: 20px;
}

table.body-wrap .container{
	border: 1px solid #f0f0f0;
}


/* -------------------------------------
		FOOTER
------------------------------------- */
table.footer-wrap {
	width: 100%;
	clear:both!important;
}

.footer-wrap .container p {
	font-size:12px;
	color:#666;
	
}

table.footer-wrap a{
	color: #999;
}


/* -------------------------------------
		TYPOGRAPHY
------------------------------------- */
h1,h2,h3{
	font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;
	margin: 40px 0 10px;
	line-height: 1.2;
	font-weight:200;
}

h1 {
	font-size: 36px;
}
h2 {
	font-size: 28px;
}
h3 {
	font-size: 22px;
}

p, ul {
	margin-bottom: 10px;
	font-weight: normal;
	font-size:14px;
}

ul li {
	margin-left:5px;
	list-style-position: inside;
}

/* ---------------------------------------------------
		RESPONSIVENESS
		Nuke it from orbit. Its the only way to be sure.
------------------------------------------------------ */

/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
.container {
	display:block!important;
	max-width:600px!important;
	margin:0 auto!important; /* makes it centered */
	clear:both!important;
}

/* This should also be a block element, so that it will fill 100% of the .container */
.content {
	padding:20px;
	max-width:600px;
	margin:0 auto;
	display:block;
}

/* Let make sure tables in the content area are 100% wide */
.content table {
	width: 100%;
}

</style>
</head>
 
<body bgcolor="#f6f6f6">

<table class="body-wrap">
	<tr>
		<td></td>
		<td class="container" bgcolor="#FFFFFF">


			<div class="content">
			<table>
				<tr>
					<td>
						<p>Hi there,</p>
						<p>Sometimes all you want is to send a simple HTML email with a basic design.</p>
						<h1>Really simple HTML email template</h1>
						<p>This is a really simple email template. Its sole purpose is to get you to click the button below.</p>
						<h2>How do I use it?</h2>
						<p>All the information you need is on GitHub.</p>
						<p><a href="https://github.com/leemunroe/html-email-template" class="btn-primary">View the source and instructions on GitHub</a></p>
						<p>Feel free to use, copy, modify this email template as you wish.</p>
						<p>Thanks, have a lovely day.</p>
						<p><a href="http://twitter.com/leemunroe">Follow @leemunroe on Twitter</a>
					</td>
				</tr>
			</table>
			</div>
			<!-- /content -->
									
		</td>
		<td></td>
	</tr>
</table>
<!-- /body -->

<!-- footer -->
<table class="footer-wrap">
	<tr>
		<td></td>
		<td class="container">
			
			<!-- content -->
			<div class="content">
				<table>
					<tr>
						<td align="center">
							<p>Dont like these annoying emails? <a href="#"><unsubscribe>Unsubscribe</unsubscribe></a>.
							</p>
						</td>
					</tr>
				</table>
			</div><!-- /content -->
				
		</td>
		<td></td>
	</tr>
</table>
<!-- /footer -->

</body>
</html>';
    }

    function replaceSpace($string)
    {
        $string = preg_replace("/\s+/", " ", $string);
        $string = trim($string);
        return $string;
    }

    public static function YeniSiparisBildirimi($data,$mailYazisi)
    {
        $kullanici_bilgileri =\Lib\Session::get('kullanici_bilgileri');
        $ad_soyad = \Lib\Strings::strtoTrUcFirst($kullanici_bilgileri['adi']) . ' ' . \Lib\Strings::strtoTrUcFirst($kullanici_bilgileri['soyadi']);
        // echo '<pre>';
        extract($data);
        
        $file = self::TableStyle() . '<body bgcolor="#f6f6f6">
            
           <strong>  '.$mailYazisi.'   </strong>' . $data['sepet'] . '
							<table class="body-wrap">
								<tbody>
									<tr class="price2">
										<td class="right"><b>Toplam:</b></td>
										<td class="right"><a class="toplamfiyat" href="' . $data['sepet_fiyat_toplami'] . '"></a>
		                                      <span class="toplamfiyatspan">' . $data['sepet_fiyat_toplami'] . ' TL</span>
										</td>
									</tr>
								</tbody>
							</table>
	
		

								  <strong>Bilgileriniz  </strong>
								<table class="body-wrap" border="1" cellspacing="0" cellpadding="0">
									<tbody>
										<tr>
											<th>Sipariş No:</th>
											<td>' . $siparis_no . '</td>
										</tr>
										<tr>
											<th>Siparişi Oluşturan:</th>
											<td>' . $ad_soyad . '</td>
										</tr>
											<tr>
											<th>Telefon Numarası</th>
											<td>' . $telefon . '</td>
										</tr>
											    
										<tr>
											<th>Email Adresi</th>
											<td>' . $email . '</td>
										</tr>
											  
											    
										<tr>
											<th>Oluşturma Zamanı:</th>
											<td>' . $olusturma_zamani . '</td>
										</tr>
										<tr>
											<th>Sipariş Durumu:</th>
											<td>' . $siparis_durumu . '</td>
										</tr>
										<tr>
											<th>Sipariş Tutarı</th>
											<td>' . $siparis_tutari . ' TL</td>
										</tr>
        
										<tr>
											<th>Ödeme Türü</th>
											<td>' . $odeme_tipi . '</td>
										</tr>
        
        
											<tr>
											<th>Mağaza</th>
											<td>' . $magaza_adi . '</td>
										</tr>
        
        
									</tbody>
								</table>
							</div>
        

								  <strong>Teslimat Bilgileri  </strong>
								<table class="body-wrap" border="1" cellspacing="0" cellpadding="0">
									<tbody>
        
										<tr>
											<th>Teslimat Saati:</th>
											<td>' . $teslimat_saati . '</td>
										</tr>
        
										<tr>
											<th>Teslimat Tarihi:</th>
											<td>' . $teslimat_tarihi . '</td>
										</tr>
        
										<tr>
											<th>İsim Soyisim:</th>
											<td>' . $ad_soyad . '</td>
										</tr>
        
										<tr>
											<th>Adres:</th>
											<td>' . $alici_adres . ' </td>
										</tr>
        
										<tr>
											<th>Şehir ,İlçe, Semt/Mahalle</th>
											<td>' . $alici_il . ' , ' . $alici_ilce . ' , ' . $alici_semt . '</td>
										</tr>
        
									</tbody>
								</table>
							</div>
				
								  <strong>Fatura Bilgileri  </strong>
								<table class="body-wrap" border="1" cellspacing="0" cellpadding="0">
									<tbody>
        
										<tr>
											<th>İsim Soyisim:</th>
											<td>' . $ad_soyad . '</td>
										</tr>
										<tr>
											<th>Adres:</th>
											<td>' . $fatura_adres . '  </td>
										</tr>
        
										<tr>
											<th>Şehir ,İlçe, Semt/Mahalle</th>
											<td>' . $fatura_il . ' , ' . $fatura_ilce . ' , ' . $fatura_semt . '</td>
										</tr>
									</tbody>
								</table>
							</div></body></html>';
        $file = self::replaceSpace($file);
        return $file;
    }

public function TableStyle()
{
        return '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Really Simple HTML Email Template</title>
<style>
/* -------------------------------------
		GENEL
------------------------------------- */
* {
	margin:0;
	padding:0;
	font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
	font-size: 100%;
	line-height: 1.6;
}
    
img {
	max-width: 100%;
}
    
body {
	-webkit-font-smoothing:antialiased;
	-webkit-text-size-adjust:none;
	width: 100%!important;
	height: 100%;
}
    
    
/* -------------------------------------
		ELEMENTS
------------------------------------- */
a {
	color: #348eda;
}
    
.btn-primary, .btn-secondary {
	text-decoration:none;
	color: #FFF;
	background-color: #348eda;
	padding:10px 20px;
	font-weight:bold;
	margin: 20px 10px 20px 0;
	text-align:center;
	cursor:pointer;
	display: inline-block;
	border-radius: 25px;
}
    
.btn-secondary{
	background: #aaa;
}
    
.last {
	margin-bottom: 0;
}
    
.first{
	margin-top: 0;
}
    
    
/* -------------------------------------
		BODY
------------------------------------- */
            
        

    
.container{
	border: 1px solid #f0f0f0;
}
    
    
/* -------------------------------------
		FOOTER
------------------------------------- */
table {
    border: 1px solid #000!important;
            	width: 100%;
	clear:both!important;
    border: 1px solid #000;
}

table tr{
    border: 1px solid #000!important;
}

 table th{
    border: 1px solid #000!important;
}
            

.container p {
	font-size:12px;
	color:#666;
    
}
    
table a{
	color: #999;
}
    
    
/* -------------------------------------
		TYPOGRAPHY
------------------------------------- */
h1,h2,h3{
	font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;
	margin: 40px 0 10px;
	line-height: 1.2;
	font-weight:200;
}
    
h1 {
	font-size: 36px;
}
h2 {
	font-size: 28px;
}
h3 {
	font-size: 22px;
}
    
p, ul {
	margin-bottom: 10px;
	font-weight: normal;
	font-size:14px;
}
    
ul li {
	margin-left:5px;
	list-style-position: inside;
}
    
/* ---------------------------------------------------
		RESPONSIVENESS
------------------------------------------------------ */
    
/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
.container {
	display:block!important;
	max-width:600px!important;
	margin:0 auto!important; /* makes it centered */
	clear:both!important;
}
    
/* This should also be a block element, so that it will fill 100% of the .container */
.content {
	padding:20px;
	max-width:600px;
	margin:0 auto;
	display:block;
}
    
/* Let make sure tables in the content area are 100% wide */
.content table {
	width: 100%;
}
    
</style>
</head>
    ';
    }
}