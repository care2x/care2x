<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo $x1 ?></b></font>

<p><font size=2 face="verdana,arial" >

<?php

if($x2=='show'||$src=='sickness'){
	if($x3){
	
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Kayýt bilgisi nasýl görüntülenir?</b></font>
<ul> 
<b>Adým: </b>   <img <?php echo createLDImgSrc('../','reg_data.gif','0') ?>> düðmesini týklayýnýz.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Kabul bilgisi nasýl görüntülenir?</b></font>
<ul> 
<b>Adým: </b>   <img <?php echo createLDImgSrc('../','admission_data.gif','0') ?>> düðmesini týklayýnýz.<p>
<b>Uyarý: </b> Bu düðme ancak hasta þu anda yatan hasta ya da poliklinik hastasý olarak kabul edilmiþ durumda ise görüntülenir.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Rapor nasýl görüntülenir?</b></font>
<ul> 
<b>Adým: </b> <img <?php echo createComIcon('../','info3.gif','0') ?>> düðmesini týklayýnýz.<p>
<b>Uyarý: </b> Bu düðme ancak rapor bilgisi ön izleme listesinde tamamen görüntülenmedi ide görünür.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Raporun PDF belgesi nasýl oluþturulur?</b></font>
<ul> 
<b>Adým: </b>   <img <?php echo createComIcon('../','pdf_icon.gif','0') ?>> düðmesini týklayýnýz.<p>
</ul>

<?php
	}else{

		if($src=='sickness'){	
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Bölüm nasýl deðiþtirilir?</b></font>
<ul> 
<b>Adým 1: </b> " <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> Form oluþtur" seçim kutusundan bölümü seçiniz.<p>
<b>Adým 2: </b> "Git" i týklayýnýz.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Onay nasýl kaydedilir?</b></font>
<ul> 
<b>Adým: </b> <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Onay nasýl yazdýrýlýr?</b></font>
<ul> 
<b>Adým: </b> <img <?php echo createLDImgSrc('../','printout.gif','0') ?>> düðmesini týklayýnýz.<p>
</ul>

<?php
		}elseif($src=='diagnostics'){
?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Henüz kayýtlý bilgi yok. Yeni bilgi nasýl girilir?</b></font>
<ul> 
<b>Uyarý: </b> Yeni tetkik sonuçlarý veya raporlar yalnýzca uygun laboratuvar veya tetkik modüllerinden girilebilir. Kabul modülü "salt okunur" moddadýr.<p>
</ul>
<?php
		}elseif($src=='notes'){
?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Henüz yeni bilgi yok. Yeni bilgi nasýl girilir?</b></font>
<ul> 
<b>Adým: </b> " <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> <font color=#0000ff><b>Yeni kayýt gir</b></font>" baðlantýsýný týklayýnýz.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Seçenekler menüsü geri nasýl görüntülenir?</b></font>
<ul> 
<b>Adým: </b> " <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> <font color=#0000ff><b>Seçeneklere geri</b></font>" baðlantýsýný týklayýnýz.<p>
</ul>

<?php
		}else{
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Henüz kayýtlý bilgi yok. Yeni bilgi nasýl girilir?</b></font>
<ul> 
<b>Adým: </b> " <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> <font color=#0000ff>Yeni kayýt gir</font>" baðlantýsýný týklayýnýz.<p>
</ul>

<?php 
		}
	}
}else{
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Kayýt nasýl oluþturulur?</b></font>

<ul> 
<b>Adým: </b> Bilgiyi giriniz, sonra <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>>  düðmesini týklayýnýz.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Tarih nasýl girilir?</b></font>
<ul> 
<b>Adým 1: </b> <img <?php echo createComIcon('../','show-calendar.gif','0') ?>>  simgesini týklayýnýz, bir mini takvim açýlýr.<p>
<img src="../help/tr/img/tr_date_select.png"><p>
<b>Adým 2: </b> Mini takvimde tarihi týklayýnýz.<p>
<img src="../help/tr/img/tr_mini_calendar.png"><p>
<b>Veya: </b> Bugünü girmek için, tarih alanýna  "t" veya "T" giriniz. Bugünün tarihi otomatik olarak eklenir.<p>
<b>Veya: </b> Dünkü tarihi girmek için, tarih alanýna  "y" veya "Y" giriniz. Dünkü tarih otomatik olarak eklenir.<p>

</ul>
<?php 
}
?>
