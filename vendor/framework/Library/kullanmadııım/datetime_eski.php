<?php namespace lib;
class datetime {
	
	/*
	  veri kayıt edildiklden sonra donus işlemleri
	 
	 
	  @param bool $returns_
	         	geri dönüş değeri başarılımı
	         	
	  @param string $modul_name
	         	link in gideceği id adı
	         	
	  @param int $id
	         	db ye son eklenen id
	         	
	  @param bool $goto
	         	iki adet donus var biri dogru diğer yanlış onu belirler varsayılan standartdır kişi deger verirse donus yapar
	         	
	         	
	  @return string
	* /
	public function js_kaydet($returns_, $modul_name, $id, $goto = "standart") {
		if ($goto == "standart") {
			if ($returns_) {
				echo "<script>alert('Kaydedildi'); top.location.href='?s=" . $modul_name . "&duzenle=$id'</script>";
			} else {
				echo "<script>alert('Kaydedilemedi')</script>";
			}
		} else {
			
			if ($returns_) {
				echo "<script>alert('Başarı ile silindi'); top.location.href=top.location.href;</script>";
			} else {
				echo "<script>alert('Sorun Oluştu')</script>";
			}
			
			exit ();
		}
	}

/*
  database al kuralı
 
  @param string $value        	
  @return string
 */
	
	  public function trNumber($x,$d=2)
	  {
	  $x=number_format($x,$d,'.','');
	  $x=eregi_replace("[^0-9\.-]","",$x);
	  return number_format($x, $d, ',', '.');
	  }
	 

/*
  veritabanına decimal olarak değer yazmak içindir
 
  @param decimal $x        	
  @return int
 
	*/
	  public function DbNumber($x)
	  {
	  $x=eregi_replace("[^0-9\.,-]","",$x);
	  $x=str_replace(".","",$x);
	  $x=str_replace(",",".",$x);
	  return $x;
	  }
	 
	 

/*
  veritabanındaki tarihi formatlar
 
  @param string $x        	
  @return mixed
 */
	
	  function DbDate($x)
	  {
	  list($g,$a,$y)=explode(".",$x);
	  $x="$y-$a-$g";
	  if($x=="--"){$x="";}
	  return $x;
	  }
	 
	 

/*
  veritabanındaki tarih ve saati formatlar
 
  @param string $x        	
  @return mixed
 */
	
	  function DbTimeTime($x)
	  {
	  list($t,$s)=explode(" ",$x);
	  list($g,$a,$y)=explode(".",$t);
	  $x="$y-$a-$g $s";
	  if($x=="-- "){$x="";}
	  return $x;
	  }
	 

/*
  veritabanına tarih saat formatı ile gonderir
 
  @param string $x        	
  @return mixed
 */
	
	  function TrDate($x)
	  {
	  list($y,$a,$g)=explode("-",$x);
	  $x = "$g.$a.$y";
	  if($x=="00.00.0000" or $x==".."){$x="";}
	  return $x;
	  }
	 

/*
  database al kuralı
 
  @param string $value        	
  @return mixed
 */
	
	
	  function TrDateTime($x)
	  {
	  list($t,$s)=explode(" ",$x);
	  list($y,$a,$g)=explode("-",$t);
	  list($sa,$dk,$sn)=explode(":",$s);
	  $x = "$g.$a.$y $sa:$dk:$sn";
	  if($x=="00.00.0000 00:00:00" or $x==".. ::"){$x="";}
	  return $x;
	  }
	 
	 
}
