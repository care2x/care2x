<html>

<head>
<title></title>

</head>
<body>
<form >
<font face="Verdana, Arial" size=2>
<font  size=3 color="#0000cc">
<b>

<?php
	switch($src)
	{
		case "show": print "Hemþire nöbetleri - Nöbet planý";
							break;
		case "quick": print "Hemþire nöbetleri - Hýzlý bakýþ";
							break;
		case "plan": print "Hemþire nöbetleri - Nöbet planý oluþtur";
							break;
		case "personlist": print "Personel listesi oluþtur";
							break;
		case "dutydoc": print "Hemþire nöbetleri - Ýcap nöbetlerinde yapýlan iþin belgelendirilmesi";
							break;
	}
?>
</b>
</font>
<p>

<?php if($src=="quick") : ?>
<p><font color="#990000" face="Verdana, Arial">Burada ne yapabilirim?</font></b><p>
<font face="Verdana, Arial" size=2>
<img <?php echo createComIcon('../','update.gif','0','absmiddle') ?>><b> Nöbetçi hemþireler hakkýnda (varsa) ek bilgi almak.</b>
<ul>Ek bilgiyi görmek için, listedeki kiþinin  <span style="background-color:yellow" >ismi</span> üzerine týklayýnýz. Küçük bir pencere açýlýr, ilgili bilgiler görünür.</ul><p>
<img <?php echo createComIcon('../','update.gif','0','absmiddle') ?>><b> Tüm ayýn nöbet planýný görmek.</b>
<ul>Tüm ayýn nöbet planýný görüntülemek için, ilgili &nbsp;<button><img <?php echo createComIcon('../','new_address.gif','0','absmiddle') ?>> <font size=1>Göster</font></button> simgesini týklayýnýz.<br>
			Nöbet planý görüntülenir.</ul><p>
<font face="Verdana, Arial" size=3 color="#990000">
<p><b>Hýzlý bakýþ görüntüsü neyi göstermek istiyor?</b></font></b><p>
<font face="Verdana, Arial" size=2>
</b><li><b>Ameliyathane Bölüm</b> :<ul>Ýcapçý ve/veya nöbetçi doktor/cerrahlarý bulunan bölümlerin listesi.</ul><p>
<li><b>Ýcapçý </b> :<ul>Ýcap nöbetçisi hemþire.</ul><p>
<li><b>Çaðrý/Telefon</b> :<ul>Ýcap nöbetindeki hemþirenin telefon ve çaðrý bilgisi.</ul>
<li><b>Nöbetçi </b> :<ul>Nöbetçi hemþire.</ul><p>
<li><b>Çaðrý/Telefon</b> :<ul>Nöbetçinin çaðrý ve telefon bilgisi.</ul><p>
<li><b>Nöbet planý</b> :<ul>Týklanabilir simge. Bölümün bütün aylýk nöbet planýna baðlantý. Tüm ayýn nöbet planýný açmak sonrada oluþturmak veya düzenlemek ister iseniz&nbsp;<button><img <?php echo createComIcon('../','new_address.gif','0','absmiddle') ?>> <font size=1>Göster</font></button>
			simgesini týklayýnýz.</ul>

<?php endif ?>
<?php if($src=="show") : ?>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Görüntülenen ay için yeni bir nöbet planý oluþturmak istiyorum</b></font>
<ul> <b>Adým 1: </b> <img <?php echo createLDImgSrc('../','newplan.gif','0') ?>> düðmesini týklayýnýz.<br>
</ul>
<ul><b>Adým 2:</b>
 Daha önce giriþ yaptý iseniz ve iþleve eriþim hakkýnýz var ise, ana çerçevede nöbet planýný düzenlemek için düzenleme modu görüntülenir.<br>
		Yoksa, giriþ yapmamýþ iseniz, kullanýcý adý ve þifreniz sorulur. <p>
		Kullanýcý adý ve þifrenizi giriniz ve  <img <?php echo createLDImgSrc('../','continue.gif','0') ?>> düðmesini týklayýnýz.<p>
		Ýptal etmeye karar verir iseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düðmesini týklayýnýz.

</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir ay için liste yapmak istiyorum fakagörüntülenen liste bir baþka ayýn.</b></font>
<ul> <b>Adým 1: </b>Ýstediðiniz aya ulaþýncaya deðin týklanabilir "Ay" a tekrar tekrar týklayýnýz. <br>
								Ayý ilerletmek için saðdaki "ay" baðlantýsýný týklayýnýz.<br>
								Ayý geri almak için soldaki "ay" baðlantýsýný týklayýnýz.<br>
		<b>Adým 2: </b>Bir nöbet planý oluþturmak konusundaki önceki yönergeleri izleyiniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Hýzlý bakýþa geri gitmek istiyorum </b></font>
<ul> <b>Adým 1: </b> <img <?php echo createLDImgSrc('../','close2.gif','0') ?> > simgesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Nöbetçi hemþirelerin telefon ve çaðrý numaralarýný görmek istiyorum </b></font>
<ul> <b>Adým 1: </b><span style="background-color:yellow" >Kiþinin ismini týklayýnýz</span>.  Ýlgili bilgiyi gösteren küçük bir pencere açýlýr.<br>
</ul>


<b>Uyarý</b>
<ul> Nöbet planýný kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.
</ul>
<?php endif ?>
<?php if($src=="plan") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hemþireler listesini kullanarak bir hemþireyi nöbet için planlamak istiyorum</b></font>
<ul> <b>Adým 1: </b>Hemþireler listesini açmak için seçilen günün  &nbsp;<button><img <?php echo createComIcon('../','patdata.gif','0') ?>></button> düðmesini týklayýnýz. <br>
			Hemþireler listesini gösteren küçük bir pencere açýlýr.<br>
			<ul type=disc>
			<li>Ýcapçý nöbeti yzamak için sol "icapçý" sütunundaki simgeyi týklayýnýz.<br>
			<li>Nöbet yazmak için saðdaki "nöbet" sütunundaki simgeyi týklayýnýz.
			</ul>
		<b>Adým 2: </b>Nöbet planýna kopyalamak için <span style="background-color:yellow" >hemþirenin ismini týklayýnýz</span> .<br>
		<b>Adým 3: </b>Yanlýþ isme týkladý iseniz, ikinci adýmý tekrarlayýp doðru ismi týklayýnýz.<br>
		<b>Adým 4: </b>Ýþiniz bitti ise, hemþire listesi penceresindeki <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týkayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Nöbet listesine hemþirenin adýný el ile girmek istiyorum</b></font>
<ul> <b>Adým 1: </b>Seçilen günün metin giriþ alanýný "<input type="text" name="t" size=11 maxlength=4 >" týklayýnýz.<br>
		<b>Adým 2: </b>Hemþirenin adýný el ile yazýnýz<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Nöbet planýnda bir ismi silmek istiyorum</b></font>
<ul> <b>Adým 1: </b>Silinecek ismin metin giriþ alanýna "<input type="text" name="t" size=11 maxlength=4 value="Name">" týklayýnýz.<br>
		<b>Adým 2: </b>Ýsmi klavyenin geri veya delete tuþunu kullanarak siliniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Nöbet planýný kayýt etmek istiyorum</b></font>
<ul> <b>Adým 1: </b> <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Planý kayýt ettim ve planlamayý sonlandýrmak istiyorum, ne yapmalýyým? </b></font>
<ul> <b>Adým 1: </b>Ýþiniz bitti ise, <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz. <br>
</ul>
</font>
<?php endif ?>
<?php if($src=="personlist") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Görüntülenen bölüm yanlýþ. Doðru bölüme deðiþtirmek istiyorum.</b></font>
<ul> <b>Adým 1: </b>Bölümü <nobr>"<span style="background-color:yellow" >Bölümü veya ameliyathaneyi deðiþtir: </span><select name="s">
                                                                     	<option value="Örnek bölüm 1" selected> Örnek bölüm 1</option>
                                                                     	<option value="Örnek bölüm 2"> Örnek bölüm 2</option>
                                                                     	<option value="Örnek bölüm 3"> Örnek bölüm 3</option>
                                                                     	<option value="Örnek bölüm 4"> Örnek bölüm 4</option>
                                                                     </select>"</nobr> alanýndan seçiniz.
                                                                     <br>
		<b>Adým 2: </b>Seçilen bölümü deðiþtirmek için <input type="button" value="Deðiþtir"> düðmesini týklayýnýz.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Listede bir ismi silmek istiyorum</b></font>
<ul> <b>Adým 1: </b>Silinecek ismin metin giriþ alanýna  "<input type="text" name="t" size=11 maxlength=4 value="Ýsim">" týklayýnýz.<br>
		<b>Adým 2: </b>Ýsmi klavyenin geri veya sil tuþlarýný kullanarak el ile siliniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Personel listesini kayýt etmek istiyorum</b></font>
<ul> <b>Adým 1: </b> <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Listeyi kayýt ettim, kapatmak istiyorum, ne yapmalýyým? </b></font>
<ul> <b>Adým 1: </b>Ýþiniz bitti ise, <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz. <br>
</ul>
<?php endif ?>
<?php if($src=="dutydoc") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Nöbet saatlerinde yapýlan bir iþ nasýl belgelendirilir?</b></font>
<ul> <b>Adým 1: </b>Tarihi "Tarih <input type="text" name="d" size=10 maxlength=10> " alanýna giriniz.<p>
	<ul> <b>Ýpucu: </b>Bugünün tarihini otomatik olarak girmek için  "t" veya "T" (TODAY=bugün anlamýnda) giriniz.<br>
		<b>Ýpucu: </b>Dünkü tarihi utomatik olarak girmek için "y" veya "Y" (YESTERDAY=Dün anlamýnda) giriniz.<p>
		</ul>
		<b>Adým 2: </b>Nöbetçi hemþirenin adýný  <nobr>"<span style="background-color:yellow" > Soyad, ad <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> alanýna giriniz.<br>
 <b>Adým 3: </b>Ýþin baþlangýç zamanýný  "<span style="background-color:yellow" > baþlama saati <input type="text" name="d" size=5 maxlength=5> </span>" alanýna giriniz.<br>
 <b>Adým 4: </b>Ýþin birme saatini "<span style="background-color:yellow" > bitiþ saati <input type="text" name="d" size=5 maxlength=5> </span>" alanýna giriniz.<p>
	<ul> <b>Ýpucu: </b>Þu andaki saati otomatik olarak girmek için "n" veya "N" (NOW=þimdi anlamýnda) giriniz.<p>
		</ul>
 <b>Adým 5: </b>Ameliyathane numarasýný  "<span style="background-color:yellow" > Ameliyathane No <input type="text" name="d" size=5 maxlength=5> </span>" alanýna giriniz.<br>
 <b>Adým 6: </b>Taný, tedavi veya ameliyatý  <nobr>"<span style="background-color:yellow" > Taný/Tedavi <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> alanýna giriniz.<br>
 <b>Adým 7: </b>Ýcap hemþiresinin ismini <nobr>"<span style="background-color:yellow" > Ýcap: <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> alanýna giriniz.<br>
 <b>Adým 8: </b>Nöbetçi hemþirenin adýný <nobr>"<span style="background-color:yellow" > Nöbetçi: <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> alanýna giriniz.<br>
 <b>Adým 1: </b>Belgeyi kayýt etmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz. <br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belge listesi nasýl yazdýrýlýr?</b></font>
<ul> <b>Adým 1: </b> <img <?php echo createLDImgSrc('../','printout.gif','0') ?>>  düðmesini týklayýnýz. Yazdýrma penceresi açýlýr.<br>
	<b>Adým 2: </b>Pencereyi yazdýrma yönergelerini izleyiniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belgeyi kayýt ettim ve kapatmak istiyorum. Ne yapmalýyým? </b></font>
<ul> <b>Adým 1: </b>Ýþiniz bitti ise,  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz. <br>
</ul>
<?php endif ?>

</form>
</body>
</html>
