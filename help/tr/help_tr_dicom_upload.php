<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Radyoloji - Dicom resimlerini yükleme

 </b>
 </font>
<p><font size=2 face="verana,arial" >
<form action="#" >

<?php
if(!$src){
?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Dicom resimleri nasýl yüklenir?</b>
</font>
	
	<ul>       	
 	<b>Adým 1: </b>Resim ile ilgili vizit numarasý var ise "<font color=#0000ff>Ýlgili vizit numarasý</font>" alanýna giriniz.<p>
 	<b>Adým 2: </b>Eðer kimlik veya ilgili belgeler var ise  "<font color=#0000ff>Ýlgili belgeler, kimlik</font>" alanýna giriniz. Kimliði virgüllerle ayýrýnýz.<p> 
 	<b>Adým 3: </b>Resimlerin kýsa bir tanýmýný  "<font color=#0000ff>Notlar</font>" alanýna yazýnýz.<p> 
 	<b>Adým 4: </b> Dosya seçme penceresini açmak için <input type="button" value="Tara"> button to düðmesini týklayýnýz.<p> 
 	<b>Adým 5: </b>Resim dosyasýný seçiniz.<p> 
 	<b>Adým 6: </b>Tüm resim dosyalarý seçildiðinde yüklemeyi baþlatmak için  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz.<p> 
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yüklenecek resim sayýsý nasýl deðiþtirilir?</b>
</font>
	
	<ul>       	
 	<b>Uyarý: </b>Sayýyý herhangi bir veri girmeden, ya da resim dosyalarýný seçmeye baþlamadan belirleyiniz.<p> 
 	<b>Adým 1: </b>Sayýyý "Yüklemem gerekiyor <input type="text" name="d" size=3 maxlength=1 value=4>" alanýna giriniz.<p>
 	<b>Adým 2: </b> "Git" i týklayýnýz.<p> 
</ul>
<?php
}else{
?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Baþarýlý bir yüklemeden sonra, yüklenmiþ resimlerin durmunu nasýl kontrol edebilirim?</b>
</font>
	<ul>       	
 	<b>Uyarý: </b> Resimleri (tarayýcýya baðlý olarak) ayný pencerede izlemek için "<b>Resim Grubu #</b>" nun <img <?php echo createComIcon('../','torso.gif','0') ?>> simgesine týklayýnýz.<p>
	<img src="../help/tr/img/tr_dicom_group_in.png" border=0 width=318 height=132><p> 
  	<b>Veya:</b> Yeni bir pencerede izlemek için "<b>Image Group #</b>" grubunun  <img <?php echo createComIcon('../','torso_win.gif','0') ?>> simgesine týklayýnýz.<p>
	<img src="../help/tr/img/tr_dicom_group_ex.png" border=0 width=318 height=132> 
	 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Baþarýlý vir yüklemeden sonra, yüklenmiþ her bir resmi ayry ayrý nasýl kontrol edebilirim?</b>
</font>
	<ul>       	
 	<b>Adým: </b>Resmi ayný pencerede (tarayýcýya baðlý) izlemek için  listedeki <img <?php echo createComIcon('../','torso.gif','0') ?>> simgesini týklayýnýz.<p>
	<img src="../help/tr/img/tr_dicom_single_in.png" border=0 width=410 height=101><p> 
  	<b>Veya: </b>Bir resmi ayrý bir pencerede izlemek için listedeki <img <?php echo createComIcon('../','torso_win.gif','0') ?>> simgesini týklayýnýz.<p>
	<img src="../help/tr/img/tr_dicom_single_ex.png" border=0 width=410 height=101>
	 
</ul>

<?php
}
?>

</form>

