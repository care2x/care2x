<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Ameliyathane Belgelendirme - 
<?php
if($src=="create")
{
	switch($x1)
	{
	case "dummy": print "Yeni belge oluþtur";
						break;
	case "saveok": print  " - Belge kayýt edildi";
						break;
	case "update": print "Bu belgeyi güncelle";
						break;
	case "search": print "Bir hasta ara";
						break;
	case "paginate": print  "Arama sonuçlarý listesi";
						break;
	}
}
if($src=="search")
{
	switch($x1)
	{
	case "dummy": print "Bir belge ara";
						break;
	case "": print "Bir belge ara";
						break;
	case "paginate": print  "Arama sonuçlarý listesi";
						break;
	case "match": print  "Arama sonuçlarý listesi";
						break;
	case "select": print "Güncel belge";
	}
}
if($src=="arch")
{
	switch($x1)
	{
	case "dummy": print "Arþiv";
						break;
	case "": print "Arþiv";
						break;
	case "?": print "Arþiv";
						break;
	case "search": print  "Arþiv arama sonuçlarý listesi";
						break;
	case "select": print "Güncel belge";
	}
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php

if($src=="create") { 
	
	if($x1=='search'||$x1=='paginate'){
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Belgesi yazýlacak hasta nasýl seçilir?</b>
</font>
<ul>       	
 	<b>Uyarý: </b> Hastanýn soyadýný veya <img <?php echo createLDImgSrc('../','ok_small.gif','0') ?>> düðmesini týklayýnýz.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni hasta aramasý nasýl baþlatýlýr?</b>
</font>
<ul>       	
 	<b>Uyarý: </b>  <img <?php echo createLDImgSrc('../','document-blue.gif','0') ?>> sekmesini týklayýnýz.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bölüm nasýl deðiþtirilir?</b>
</font>
<ul>       	
 	<b>Uyarý: </b> Sayfanýn sol alt kýsmýndaki "Bölümü deðiþtir" baðlantýsýný týklayýnýz. <p> 
</ul>
<?php
	}

	 if($x1=="saveok") { 
?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Güncel belge nasýl düzenlenir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Düzenleme moduna geçmek için  <input type="button" value="Bilgiyi güncelle"> düðmesini týklayýnýz.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir belgeye nasýl baþlanýr?</b>
</font>
<ul>       	
 	<b>Adým 1: </b> <input type="button" value="Yeni bir belgeye baþla"> düðmesini týklayýnýz.<br>
	</ul>
<b>Uyarý</b>
<ul> Kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.
</ul>

<?php } ?>

<?php if($x1=="update") { ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Açýk olan belge nasýl düzenlenir veya güncellenir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Düzenleme moduna geçildiði zaman, bilgileri güncelleyebilirsiniz.<br> 
 	<b>Adým 2: </b>Belgeyi kayýt etmek için,  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz.<br> 
	</ul>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hangi bilgilerin girilmesi zorunludur?</b>
</font>
<ul>       	
 	<b>Uyarý: </b>Tüm kýrmýzý alanlar zorunludur.<br> 
	</ul>
	
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.
</ul>
<?php } ?>
<?php if($x1=="dummy") { ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir belge nasýl oluþturulur?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Önce hastayý bulunuz. Arama giriþ alanýna hastanýn soyad veya adýnýn tamamýný veya ilk birkaç harfini giriniz.<br>
 	<b>Adým 2: </b>Hastayý aramaya baþlamak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düðmesini týklayýnýýz.<p> 
<ul>       	
 	<b>Uyarý: </b>Eðer arama bir tek sonuç bulur ise, hastanýn temel bilgileri ilgili alanlara otomatik olarak girilir.<p> 
 	<b>Uyarý: </b>Arama birkaç sonuç bulur ise ,  bir liste görüntülenir. Belge yazmak üzere seçmek için hastanýn soyadýný týklayýnýz.<p> 
	</ul>
 	<b>Adým 3: </b>Hastanýn temel bilgileri görüntülendiði zaman, ameliyat ile ilgili ek bilgileri ilgili alanlara girebilirsiniz.<br> 
 	<b>Adým 4: </b>Belgeyi kayýt etmek için, <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz.<br> 
	</ul>
	<?php } ?>
<?php } ?>



<?php if($src=="search") : ?>
	<?php if(($x1=="dummy")||($x1=="")) : ?>


<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Belirli bir hastanýn bir belgesi nasýl aranýr?</b>
</font>
<ul>       	
 	<b>Adým 1: </b> "<span style="background-color:yellow" > Aranacak anahtar sözcük: ad veya soyad <input type="text" name="m" size=20 maxlength=20> </span>" alanýna bir hastanýn ad veya soyadýnýn tamamýný veya baþtan birkaç harfini giriniz. <br>
 	<b>Adým 2: </b>Hastanýn belgesini aramaya baþlamak için  <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düðmesini týklayýnýz.<p> 
<ul>       	
<!--  	<b>Uyarý: </b>Arama bir sonuç bulur ise, hastanýn belgesi derhal görüntülenir.<p> 
 --> 	<b>Uyarý: </b>Arama birkaç sonuç bulur ise, bir liste görüntülenir. Hastayý belge yazmak üzere seçmek için soyadý, veya ameliyat tarihi, veya ameliyat numarasý üzerine týklayýnýz.<p> 
	</ul>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.
</ul>
	<?php endif ?>
<?php if(($x1=="match"||$x1=='paginate')&&($x2>0)) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Görüntülemek üzere belirli bir belge nasýl seçilir?</b>
</font>
<ul>       	
 	<b>Uyarý: </b> Belgesini görüntülemek için hastanýn soyadýna, veya ameliyat tarihine, veya ameliyat numarasýna týklayýnýz.<p> 
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Liste nasýl sýralanýr?</b>
</font>
<ul>       	
 	<b>Uyarý: </b> Listenin sýralanmasýný istediðiniz sütununun baþlýðýna týklayýnýz.<p> 
	Örnek: Listeyi ameliyat tarihine göre sýralamak ister iseniz:<p>
	<blockquote>
	<img src='../help/tr/img/tr_or_search_sort.png'>
	</blockquote>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Aramaya nasýl devam edilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b> "<span style="background-color:yellow" > Aranan anahtar sözcük: ad veya soyad <input type="text" name="m" size=20 maxlength=20> </span>" alanýna hastanýn ad veya soyadýnýn ya tamamýýný veya ilk birkaç harfini giriniz. <br>
 	<b>Adým 2: </b>Hastanýn belgesini aramaya baþlamak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düðmesini týklayýnýz.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý: </b></font> 
<ul>       	
 Kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.
</ul>
	<?php endif ?>
<?php if(($x1=="select")&&($x2==1)) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Güncel belge nasýl düzenlenir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Düzenleme moduna geçmek için <img <?php echo createLDImgSrc('../','update_data.gif','0') ?>> düðmesini týklayýnýz.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Aramaya nasýl devam edilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b> "<span style="background-color:yellow" > Aranacak anahtar sözcük: ad veya soyad <input type="text" name="m" size=20 maxlength=20> </span>" alanýna hastanýn ad veya soyadýnýn ya tamamýný ya da baþtan birkaç harfini giriniz. <br>
 	<b>Adým 2: </b>Hastanýn belgesini aramaya baþlamak için  <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düðmesini týklayýnýz.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.
</ul>

<?php endif ?>
<?php endif ?>

<?php if($src=="arch") : ?>
	<?php if(($x1=="dummy")||($x1=="?")||($x1=="")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir tarihte yapýlmýþ ameliyatlarýn tüm belgelerini listelemek istiyorum</b></font>
<ul> <b>Adým 1: </b> "<span style="background-color:yellow" > Ameliyat tarihi: </span>" alanýna ameliyatýn tarihini giriniz. <br>
		<ul><font size=1 color="#000099">
		<!-- <b>Ýpucu:</b> Otomatik olarak bugünün tarihini girmek için "T" veya "t" giriniz.<br>
		<b>Ýpucu:</b> Dünkü tarihi otomatik olarak girmek için "Y" veya "y" giriniz.<br> -->
		</font>
		</ul><b>Adým 2: </b>Tüm diðer alanlarý boþ býrakýnýz.<br>
		<b>Adým 3: </b>Aramayý baþlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düðmesini týklayýnýz.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir hastanýn tüm ameliyat belgelerini listelemek istiyorum.</b></font>
<ul> <b>Adým 1: </b>Ýlgili alana anahtar sözcüðü giriniz. Tam bir sözcük, bir cümle veya bir sözcüðün ilk bir kaç harfi olabilir. <br>
		<ul><font size=1 color="#000099" >
		<b>Ýzleyen alanlar bir anahtar sözcük ile doldurulabilir:</b>
		<br> Hasta protokol no.
		<br> Soyad
		<br> Ad
		<br> Doðum tarihi
		</font>
		</ul><b>Adým 2: </b>Tüm diðer alanlarý boþ býrakýnýz.<br>
		<b>Adým 3: </b>Aramayý baþlatmak için  <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir cerrahýn yaptýðý ameliyatlarýn tüm belgelerini listelemek istiyorum.</b></font>
<ul> <b>Adým 1: </b>Cerrahýn adýný "<span style="background-color:yellow" > Cerrah: </span>" alanýna yazýnýz. <br>
		<b>Adým 2: </b>Tüm diðer alanlarý boþ býrakýnýz.<br>
		<b>Adým 3: </b>Aramayý baþlatmak için  <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Ayaktan gelen hastalarýn tüm ameliyat belgelerini listelemek istiyorum </b></font>
<ul> <b>Adým 1: </b> "<span style="background-color:yellow" >Ayaktan hasta <input type="radio" name="r" value="1"></span>" seçim kutusunu týklayýnýz . <br>
		<b>Adým 2: </b>Tüm diðer alanlarý boþ býrakýnýz.<br>
		<b>Adým 3: </b>Aramayý baþlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Yatan hastalarýn tüm ameliyat belgelerini listelemek istiyorum </b></font>
<ul> <b>Adým 1: </b> "<span style="background-color:yellow" >Yatan hasta <input type="radio" name="r" value="1"></span>" seçim kutusunu týklayýnýz . <br>
		<b>Adým 2: </b>Tüm diðer alanlarý boþ býrakýnýz.<br>
		<b>Adým 3: </b>Aramayý baþlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Genel saðlýk sigortasýna tabi hastalarýn tüm ameliyat belgelerini listelemek istiyorum </b></font>
<ul> <b>Adým 1: </b> "<span style="background-color:yellow" >Sigortalý <input type="radio" name="r" value="1"></span>" seçim kutusunu týklayýnýz . <br>
		<b>Adým 2: </b>Tüm diðer alanlarý boþ býrakýnýz.<br>
		<b>Adým 3: </b>Aramayý baþlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Özel sigortalý hastalarýn tüm ameliyat belgelerini listelemek istiyorum </b></font>
<ul> <b>Adým 1: </b> "<span style="background-color:yellow" >Özel <input type="radio" name="r" value="1"></span>" seçim kutusunu týklayýnýz . <br>
		<b>Adým 2: </b>Tüm diðer alanlarý boþ býrakýnýz.<br>
		<b>Adým 3: </b>Aramayý baþlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Ücretli hastalarýn tüm ameliyat belgelerini listelemek istiyorum </b></font>
<ul> <b>Adým 1: </b> "<span style="background-color:yellow" >Ücretli <input type="radio" name="r" value="1"></span>" seçim kutusunu týklayýnýz . <br>
		<b>Adým 2: </b>Tüm diðer alanlarý boþ býrakýnýz.<br>
		<b>Adým 3: </b>Aramayý baþlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir anahtar sözcük ile tüm ameliyat belgelerini listelemek istiyorum </b></font>
<ul> <b>Adým 1: </b>Ýlgili alana anahtar sözcüðü giriniz. Tam bir sözcük, cümle, veya bir sözcüðün ilk birkaç harfi olabilir. <br>
		<ul><font size=2 color="#000099" >
		<b>Örnek:</b> Taný anahtar sözcüðünü "Taný" alanýna giriniz.<br>
		<b>Örnek:</b> Yeri anahtar sözcüðünü "Yeri" alanýna giriniz.<br>
		<b>Örnek:</b> Tedavi anahtar sözcüðünü "Tedavi" alanýna giriniz.<br>
		<b>Örnek:</b> Özel uyarý anahtar sözcüðünü "Özel uyarý" alanýna giriniz.<br>
		</font>
		</ul><b>Adým 2: </b>Tüm diðer alanlarý boþ býrakýnýz.<br>
		<b>Adým 3: </b>Aramayý baþlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düðmesini týklayýnýz.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir ameliyat sýnýfýna göre tüm belgeleri listelemek istiyorum</b></font>
<ul> <b>Adým 1: </b>Ýlgili alana anahtar sözcüðü giriniz. Tam bir sözcük, cümle veya bir sözcüðün ilk birkaç harfi olabilir. <br>
		<ul><font size=2 color="#000099" >
		<b>Örnek:</b> Küçük ameliyat için numarayý  "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> küçük </span>" alanýna giriniz.<br>
		<b>Örnek:</b> Orta ameliyat için numarayý  "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> orta </span>" alanýna giriniz.<br>
		<b>Örnek:</b> Büyük ameliyat için numarayý  "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> büyük </span>" alanýna giriniz.<br>
		</font>
		</ul><b>Adým 2: </b>Tüm diðer alanlarý boþ býrakýnýz.<br>
		<b>Adým 3: </b>Aramayý baþlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>><b><font color="#990000"> Uyarý: </font></b>
<ul> Birkaç arama þartýný birleþtirebilirsiniz. Örnek: Cerrah "Gürlek" tarafýndan ameliyat edilmiþ ve tedavisinde "lipo" ile baþlayan bir sözcük içeren tüm yatan hastalarý listelemek ister iseniz:<p>
		<b>Adým 1: </b> "<span style="background-color:yellow" > Cerrah: <input type="text" name="s" size=15 maxlength=4 value="Gürlek"> </span>" alanýna "Gürlek" giriniz.<br>
		<b>Adým 2: </b> "<span style="background-color:yellow" > <input type="radio" name="r" value="1" checked>Yatan hasta </span>" seçim kutusunu týklayýnýz.<br>
		<b>Adým 3: </b> "<span style="background-color:yellow" > Tedavi: <input type="text" name="s" size=20 maxlength=4 value="lipo"> </span>" alanýna "lipo" giriniz. <br>
		<b>Adým 4: </b>Aramayý baþlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düðmesini týklayýnýz.<p>

<b>Uyarý</b><br>
Arama bir tek sonuç bulur ise, tüm belge derhal görüntülenir.<br>
		Ancak arama birkaç sonuç bulur ise, bir liste görüntülenir.<p>
		Aradýðýnýz hastanýn belgesini açmak için, ya ilgili <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> düðmesini, veya
		adýný, veya soyadýný, veya tarihi, veya ameliyat numarasýný <nobr>(op nr)</nobr> týklayýnýz.
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.
</ul>
	<?php endif ?>
<?php if(($x1=="search")&&($x2>1)) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Arþivdeki belirli bir belge görüntülenmek üzere nasýl seçilir?</b>
</font>
<ul>       	
 	<b>Uyarý: </b> Arþivdeki belgeyi görüntülemek için hastanýn soyadý, veya adý, veya ameliyat tarihi, veya ameliyat numarasýný týklayýnýz.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Arþivde aramaya nasýl devam edilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Arþivin arama giriþ alanlarýna geri gitmek için  <input type="button" value="Yeni arþiv aramasý"> düðmesini týklayýnýz.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.
</ul>
	<?php endif ?>
<?php if(($x1=="select")&&($x2==1)) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Görüntülenen arþiv belgesi nasýl düzenlenir veya güncellenir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Düzenleme moduna geçmek için  <input type="button" value="Veriyi güncelle"> düðmesini týklayýnýz.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Arþivlerde aramaya nasýl devam edilir?</b>
</font>
<ul>       	
 	<b>Yöntem 1: </b>Arþivin arama giriþ alanlarýna geri gitmek için <input type="button" value="Yeni arþiv aramasý"> düðmesini týklayýnýz.<p> 
 	<b>Yöntem 2: </b>Arþivin arama giriþ alanlarýna geri gitmek için <img <?php echo createLDImgSrc('../','arch-blu.gif','0','absmiddle') ?>> düðmesini týklayýnýz.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.
</ul>

<?php endif ?>
<?php endif ?>

</form>

