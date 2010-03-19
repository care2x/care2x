<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?php
switch($x2)
{
	case "search": print "Nasýl "; 
 						if($x1) print 'bir anahtar sözcük bulunduðunda servis yatan hasta listesi gösterilir';
						else  print 'bir hasta aranýr';
						break;
	case "quick": print  "Bugünkü servis yatan hasta listesi hýzlý bakýþ";
						break;
	case "arch": print "Servisler arþivi";
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($x2=="search") : ?>
<?php if(!$x1) : ?>
<b>Adým 1</b>

<ul>  "<span style="background-color:yellow" >Lütfen aranacak bir anahtar sözcük giriniz.</span>" 
	alanýna bir ad veya soyadýn tamamýný veya ilk birkaç harfini giriniz.
		<ul type=disc><li>Örnek 1:  "Gürcan" veya "gür" giriniz.
		<li>Örnek 2: "Potur" veya "Pot" giriniz.
		<li>Örnek 3: "Potur, Gürcan" giriniz.
	</ul>	
</ul>
<b>Adým 2</b>
<ul> Aramayý baþlatmak için <input type="button" value="Ara"> düðmesini týklayýnýz.<p>
</ul>
<b>Adým 3</b>
<ul> Eðer arama bir sonuç bulur ise, anahtar sözcüðün bulunduðu yatan hasta listesi görüntülenir.<p>
</ul>
<b>Adým 4</b>
<ul> Eðer arama birkaç sonuç bulur ise, sonuçlar listesi görüntülenir.<p>
</ul>
<b>Uyarý</b>
<ul> Aramayý iptal etmek ister iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düðmesini týklayýnýz.
</ul><?php endif ?>
<b>Adým <?php if($x1) print "1"; else print "5"; ?></b><ul>Servis yatan hasta listesini görmek için ya <img <?php echo createComIcon('../','bul_arrowblusm.gif','0') ?>> düðmesini, veya tarih veya servisi týklayýnýz.
<p><b>Uyarý:</b> Aranan sözcük listede belirginleþtirilmiþ olarak görüntülenir. 
<br><b>Uyarý:</b> Liste "salt okunur" moddadýr, düzenlenemez. Eðer hastanýn ismini týklayarak bilgileri klasörünü açmak ister iseniz kullanýcý adý ve parolanýz sorulur.
</ul>
<?php endif ?>
<?php if($x2=="quick") : ?>
	<?php if($x1) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Diðer günlerin yatan hasta listeleri nasýl görüntülenir?</b>
</font>
<ul>       	
 	<b>Adým: </b>Mini takvimde tarihi týklayýnýz.<p>
	<img src="../help/tr/img/tr_mini_calendar_php.png" border=0 width=223 height=133><p>
	<b>Uyarý: </b>Görüntülenen eski hasta listesi "salt okunur" dur. Hasta bilgisini deðiþtiremez ve düzenleyemezsiniz.<br>
	</ul>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Servis yatan hasta listesi nasýl görüntülenir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Sol sütundaki servis kimliði ya da ismini týklayýnýz.<br>
	<b>Uyarý: </b>Görüntülenen hasta listesi "salt okunur" dur. Hasta bilgisini deðiþtiremez ve düzenleyemezsiniz.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Servis yatan hasta listesi düzenlemek veya güncellemek üzere nasýl gösterilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Seçilen servisin ilgili  <img <?php echo createComIcon('../','statbel2.gif','0') ?>> simgesini týklayýnýz.<br>
 	<b>Adým 2: </b>Daha önce giriþ yaptý iseniz, ve iþleve eriþim hakkýnýz bulunuyor ise, yatan hasta listesi derhal görüntülenir.<br>
		Aksi halde, kullanýcý adý ve þifrenizi girmeniz istenir.<br>
 	<b>Adým 3: </b>Sorulur ise, kullanýcý adý ve þifrenizi giriniz.<br>
 	<b>Adým 4: </b> <img <?php echo createLDImgSrc('../','continue.gif','0') ?>> düðmesini týklayýnýz.<br>
 	<b>Adým 5: </b>Ýþleve eriþim hakkýnýz var ise, yatan hasta listesi görüntülenir.<br>
	<b>Uyarý: </b>Görüntülenen yatan hasta listesi "düzenlenebilir" haldedir. Hasta bilgilerini düzenleme veya güncelleme seçenekleri görüntülenir.
		Hastalarýn bilgi klasörlerini de düzenlemek için açabilirsiniz.<br>
	</ul>
	<?php else : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Þu anda yatan hasta listesi oluþturulmamýþ</b>
</font><p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Arþiv kullanýlarak önceki yatan hasta listeleri hýzlý bakýþ olarak nasýl izlenir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b> "<span style="background-color:yellow" > Arþive gitmek için burayý týklayýnýz <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> </span>" yazýsýný týklayýnýz.<br>
 	<b>Adým 2: </b>Bir rehber takvim görüntülenir.<br>
 	<b>Adým 3: </b>O günün yatan hasta listesini görüntülemek için takvimdeki bir tarihi týklayýnýz.<br>
	</ul>
	
	<?php endif ?>
<b>Uyarý</b>
<ul> Hýzlý bakýþ penceresini kapatmak ister iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.
</ul><?php endif ?>

<?php if($x2=="arch") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Arþiv kullanýlarak önceki yatan hasta listeleri hýzlý bakýþta nasýl izlenir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>O günün yatan hastalarýna hýzlý bakýþ için takvimdeki bir tarihi týklayýnýz.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Rehber takvimdeki ay nasýl deðiþtirilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Sonraki ayý göstermek için, rehber takvimin üst SAÐ köþesindeki ay ismini týklayýnýz
								Ýstenen ay görüntüleninceye kadar ne kadar gerekirse o kadar týklayýnýz.<p>
 	<b>Adým 2: </b>Önceki ayý görüntülemek için, rehber takvimin SOL üst köþesindeki ay ismini týklayýnýz.
								Ýstenen ay görüntüleninceye kadar ne kadar gerekirse o kadar týklayýnýz.<br>
	</ul>
	
	<?php endif ?>


</form>

