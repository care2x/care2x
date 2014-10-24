<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Nasýl 
<?php
switch($x1)
{
 	case "search": print 'bir telefon numarasýný aranýr?'; break;
	case "dir": print 'tüm telefon rehberi açýlýr?';break;
	case "newphone": print 'yeni telefon bilgisi girilir?';break;
 }
 ?></b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
<?php if($x1=="search") { ?>
	<?php if($src=="newphone") { ?>
	<b>Adým 1</b>
	<ul> <img <?php echo createLDImgSrc('../','such-gray.gif','0') ?>> düðmesini týklayýnýz.
	</ul>
	<?php } ?>
<b>Adým <?php if($src=="newphone") print "2"; else print "1"; ?></b>

<ul>  "<span style="background-color:yellow" >Aranacak anahtar sözcüðü giriniz.</span>" alanýna ad, soyad, servis, oda numarasý, veya bölüm kodu gibi bir bilgiyi ya tam veya birkaç harfini giriniz.
		<br>Örnek 1: "Nisaiye 3" veya "nis" veya  "Ni" giriniz.
		<br>Örnek 2:  "Arýkan" veya "arý" giriniz.
		<br>Örnek 3:  "Rükneddin" veya "rük" giriniz.
		<br>Örnek 4:  "op11" veya "OP11" veya "op" giriniz.
		
</ul>
<b>Adým <?php if($src=="newphone") print "3"; else print "2"; ?></b>
<ul> Aramayý baþlatmak için <input type="button" value="ARA"> düðmesini týklayýnýz.<p>
</ul>
<b>Adým <?php if($src=="newphone") print "4"; else print "3"; ?></b>
<ul> Eðer arama sonuç bulur ise bir liste görünür.<p>
</ul>
<?php } ?>

<?php if($x1=="dir") { ?>
<b>Adým 1</b>
<ul> <img <?php echo createLDImgSrc('../','phonedir-gray.gif','0') ?>> düðmesini týklayýnýz.
</ul>
<?php 
} 

 if($x1=="newphone") { 
	 if($src=="search") { 
?>
<b>Adým 1</b>
<ul> <img <?php echo createLDImgSrc('../','newdata-gray.gif','0') ?>> düðmesini týklayýnýz.
</ul>
<b>Adým 2</b>
<ul> Eðer önceden giriþ yaptý iseniz ve bu iþleve eriþim hakkýnýz var ise, ana çerçevede yeni telefon bilgisi giriþ formu görüntülenir.<br>
		Giriþ yapmadý iseniz, kullanýcý adý ve þifrenizi girmeniz istenir. <p>
	<?php } ?>
		Kullanýcý adý ve þifrenizi girip  <img <?php echo createLDImgSrc('../','continue.gif','0') ?>> düðmesini týklayýnýz.<p>
		
</ul>
<?php } ?>

<b>Uyarý</b>
<ul> Ýptal etmeye karar verir iseniz 
<?php
switch($x1)
{
 	case "search": print ' <img '.createLDImgSrc('../','cancel.gif','0').'> düðmesini týklayýnýz.'; break;
	case "dir": print '  <input type="button" value="Ýptal"> düðmesini týklayýnýz.';break;
	case "newphone": print '  <img '.createLDImgSrc('../','cancel.gif','0').'> düðmesini týklayýnýz.';break;
 }
 ?>
</ul>

</form>