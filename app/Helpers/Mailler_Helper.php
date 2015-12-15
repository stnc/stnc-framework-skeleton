<?php
namespace Helpers;

use PHPMailer;

/**
 * mail gonderim arayuzu
 * @author Selman TUNÇ <selmantunc@gmail.com>
 * @copyright Copyright (c) 2015 SELMAN TUNÇ
 * @link https://github.com/stnc/stnc-framework/
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class Mailler_Helper
{

    /*
     * mail gonderim için hızlı ayarlar
     *
     * @param string $to mail gonderen kişinin mail adresi
     * @param string $from kime mail gidecek,virgüllerle ayrılarak gelebilir
     * @param string $sendername gonderici adi
     * @param string $subject konusu
     * @param string $textmail mail hali
     * @param string $htmlmail mail hali
     * @param string $attachment eklenecek dosya
     * @return boolean
     */
    function sendmail($to, $from, $sender_name, $subject, $textmail, $htmlmail = NULL, $attachment = NULL)
    {
        $mail = new \PHPMailer();
        
      // smtp den gondermek için ayarlar
      
       /*
          $mail->isSMTP();
          $mail->Host = 'smtp.yandex.com';
          $mail->SMTPAuth = true;
          $mail->Username = 'iletisim@ideal.com.tr';
          $mail->Password = 'FK290707';
          $mail->Port = 465;
          $mail->SMTPSecure = 'ssl';
          $mail->SMTPDebug = 3;
     */
        
        $mail->CharSet = "UTF-8";
        $mail->From = $to; // kimden
        $mail->FromName = 'Ideal Sanal Market'; // Gönderici adı
        $mail->addAddress($from, $sender_name); // Gönderen
       //$mail->addAddress('selman@saveas.com.tr', 'ideal.com.tr'); // Gönderen
           $mail->addAddress('selmantunc@gmail.com', 'ideal.com.tr'); // Gönderen
       // $mail->addAddress('selmantunc@yandex.com', 'ideal.com.tr'); // Gönderen
        $mail->isHTML(true); // içeriğin içersinde html olacak mı
        
        $mail->Subject = $subject; // konu
        $mail->Body = $textmail;
        $mail->AltBody = 'Ideal Sanal Market, keyifli alışveriş';
        $mail->ErrorInfo;
        if (! $mail->send()) {
            return "Mesaj  gönderiminde hata oluştu .mail hatası:" . $mail->ErrorInfo;
        } else {
            return true;
        }
    }
}
	/*  <table align="center" border="0" cellpadding="0" cellspacing="0" width="700" style="background-color:white;border:1px solid #d1d1d1;color:#292929;font:12px Arial">
	  <thead>
	  <tr>
	  <td height="60" style="padding:10px;padding-bottom:0">
	  <table align="center" border="0" cellpadding="0" cellspacing="0" width="660"><tbody>
	  <tr>
	  <td rowspan="2" height="60" width="200"><a href="http://www.n11.com/?kid=400005_23042015_anasayfa" title="n11.com" target="_blank">
	  <img src="" alt="" border="0" height="60" width="160" class="CToWUd"></a></td>
	  <td align="right" valign="bottom" height="30" style="color:#7f7f7f;font-size:11px">23 Nisan 2015</td></tr>
	  <tr><td align="right" height="30" style="color:#0f0f0f;font-size:20px;font-weight:bold">Yeni Şifre Bilginiz</td></tr></tbody></table></td></tr>
	  <tr><td height="20" style="border-bottom:1px solid #d1d1d1"><img src="https://ci3.googleusercontent.com/proxy/lV1B-BFkl0vftxJUwNmfd_jS5Mxhq54S-nsoxIe44gGR-WloreLk6iYkMfCet1tm3xo9yBKwIIcT5VoPDgRo3irjd-TGB4CqMQzOF78aPS9R4seFcICD=s0-d-e1-ft#http://www.n11.com/static/images/layout/mailing/head-gradient.jpg" alt="" border="0" height="20" width="698" class="CToWUd"></td></tr></thead>
	   <tbody><tr> <td style="font:12px Arial;padding:20px 30px"><p style="font-size:18px;margin:5px 0"><b>Sayın Selman Tunç,</b></p> <br>
	   <table cellpadding="15" cellspacing="0" width="100%" style="border:1px solid #d1d1d1"> <tbody><tr> <td align="left" style="border-bottom:1px solid #e9e9e9"><b>Yeni şifrenizi oluşturmak için lütfen aşağıdaki linke tıklayın.</b><br> <a href="https://www.n11.com/sifredegistir?token=qNCkBFunmaSlavDOLDCs" style="color:#012fa7" target="_blank">https://www.n11.com/<wbr>sifredegistir?token=<wbr>qNCkBFunmaSlavDOLDCs</a></td> </tr>
	    <tr> <td align="center" bgcolor="#f9f9f9"><span>Şifre değişikliklerini, Hesabım sayfanızdan yapabilirsiniz.</span><br>
      <a href="https://www.n11.com/hesabim/sifre-degistir" title="Hesabım" target="_blank">
      <img src="https://ci3.googleusercontent.com/proxy/rLjQ_qMH5WxO90M-sWZ4M3IyirVTk027aDZU84Nd8rRw6gKV9-0xZLlEKqot5tFZDTI_MLJxCKRffl8mJfKs77lOYPudjb7XOLOeENv6OLGJdLR-8BkB7w=s0-d-e1-ft#http://www.n11.com/static/images/layout/mailing/button-hesabim.jpg" alt="Hesabım" border="0" height="32" width="109" class="CToWUd"></a></td> </tr> </tbody></table> </td> </tr> <tr>
<td height="70" style="border-top:1px solid #ebebeb">
<table align="center" border="0" cellspacing="0" cellpadding="0" width="700" style="font-size:10px">
<tbody><tr>
<td height="37" width="120"><a href="http://www.n11.com/katilim/dogrula/daily?dailyMail=true&amp;redirect=anasayfa" title="n11" target="_blank">  </a></td>
<td></td>
</tr>
</tbody></table></td>
</tr>
<tr>
<td style="padding:10px 0"></td>
</tr>

</tbody></table>*/