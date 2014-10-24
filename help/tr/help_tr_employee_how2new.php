<font face="Verdana, Arial" size=3 color="#0000cc"><b>Personnel yönetimi</b></font><p>
<?php 
if(!$src&&!$x1){
?>
<font size=2 face="verdana,arial" >
<b>Bir kiþi nasýl iþe alýnýr</b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<b>Adým 1</b>

<ul> 
<font color=#ff0000>Kiþinin temel bilgilerinin önceden bulunup bulunmadýðýný kontrol ediniz</font>.<p>
		 Bir hastanýn ad, soyad gibi bilgilerinden ya tamamýný ya da birkaç harfini veya TC kimlik numarasýný giriniz.
		<p>Örnek 1: "21000012" veya "12" giriniz.
		<br>Örnek 2:  "Potur" veya "pot" giriniz.
		<br>Örnek 3: "Bülent" veya "Bül" giriniz.
		
</ul>

<b>Adým 2</b>
<ul> Aramaya baþlamak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düðmesini týklayýnýz. 
</ul>

<b>Adým 3</b>
<ul> Arama sonunda hiç kimse bulunamaz ise, önce kiþi kaydýný girmek gerekir.  <img <?php echo createLDImgSrc('../','register_gray.gif','0') ?>>  düðmesine týklayýnýz ve kiþi kaydý için gereken yönergeleri izleyiniz.
</ul>
<b>Adým 4</b>
<ul> Eðer araþtýrma bir sonuç bulur ise yanýndaki <img <?php echo createLDImgSrc('../','ok_small.gif','0') ?>> düðmesini týklayarak listeden doðru kiþiyi seçiniz.
</ul>
<b>Adým 5</b>
<ul> Ýþe alma formu görüntülenince, iþ ile ilgili tüm bilgileri giriniz.<p>
		<img <?php echo createComIcon('../','warn.gif','0') ?>> Uyarý: Eðer bir kiþi halen çalýþmakta ise, onun bilgileri görüntülenecektir .
</ul>
<b>Adým 6</b>
<ul> 
	 Sicil bilgisini kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz.<p>
	
</ul>


<b>Uyarý</b>

<ul> Eðer bir bilgi eksik ise, bilgiler tekrar görüntülenir ve kýrmýzý ile iþaretli alan(lar) daki bilgileri girmeniz istenir. Daha sonra tam bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz.<p>
</ul>

<b>Uyarý</b>
<ul> Eðer kaydý iptal etmeye karar verirseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düðmesini týklayýnýz.
		
</ul>
</form>
<?php
}else{
?>

<font size=2 face="verdana,arial" >
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<?php
	if($src){
?>
<font color="#990000"><b>Çalýþan sicil bilgisi nasýl güncellenir?</b></font>
<ul> 
	<b>Adým 1:</b> Uygun alanlara yeni bilgileri giriniz.<p>
	<b>Adým 2:</b> Güncellenmiþ sicil bilgisini kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz.<p>
	<img <?php echo createComIcon('../','warn.gif','0') ?>> Uyarý: Güncellemeyi iptal etmeye karar verirseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düðmesini týklayýnýz.
</ul>
<?php
	}else{
?>
<font color="#990000"><b>Kiþi nasýl iþe alýnýr?</b></font>
<ul> 
	<b>Adým 1:</b> Uygun alanlara sicil bilgisini giriniz.<p>
	<b>Adým 2:</b> Sicil bilgisini kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz.<p>
	<img <?php echo createComIcon('../','warn.gif','0') ?>> Uyarý: Ýptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düðmesini týklayýnýz.
</ul>
<?php
	}
}
?>
