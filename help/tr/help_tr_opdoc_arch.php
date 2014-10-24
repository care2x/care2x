<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Ameliyathane Belgeler - 
<?php
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
	case "select": print "Hastanýn belgesi";
	}
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >

<?php if($src=="arch") : ?>
	<?php if(($x1=="dummy")||($x1=="?")||($x1=="")||!$x2) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir tarihte yapýlmýþ ameliyatlarýn tüm belgelerini listelemek istiyorum</b></font>
<ul> <b>Adým 1: </b>Ameliyat tarihini "<span style="background-color:yellow" > Ameliyat tarihi: </span>" alanýna giriniz. <br>
		<ul><font size=1 color="#000099">
		<!-- <b>Ýpucu:</b> Bugünkü tarihin otomatik yazýlmasý için "T" veya "t" giriniz.<br>
		<b>Ýpucu:</b> Dünkü tarihin otomatik yazýlmasý için "Y" veya "y" giriniz.<br> -->
		</font>
		</ul><b>Adým 2: </b>Tüm diðer alanlarý boþ býrakýnýz.<br>
		<b>Adým 3: </b>Aramayý baþlatmak için  <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düðmesini týklayýnýz.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir hastanýn tüm ameliyathane belgelerini listelemek istiyorum. </b></font>
<ul> <b>Adým 1: </b>Ýlgili alana anahtar sözcüðü giriniz. Hastanýn kiþisel bilgisinden tam bir sözcük, cümle veya ilk birkaç harfi olabilir. <br>
		<ul><font size=1 color="#000099" >
		<b>Aþaðýdaki alanlar bir anahtar sözcük ile doldurulabilir:</b>
		<br> Hasta numarasý.
		<br> Soyad
		<br> Ad
		<br> Doðum tarihi
		</font>
		</ul><b>Adým 2: </b>Tüm diðer alanlarý boþ býrakýnýz.<br>
		<b>Adým 3: </b>Aramayý baþlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir cerrahýn tüm ameliyathane belgelerini listelemek istiyorum.</b></font>
<ul> <b>Adým 1: </b>Cerrahýn ismini "<span style="background-color:yellow" > Cerrah: </span>" alanýna giriniz. <br>
		<b>Adým 2: </b>Tüm diðer alanlarý boþ býrakýnýz.<br>
		<b>Adým 3: </b>Aramayý baþlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Poliklinik hastalarýnýn tüm ameliyathane belgelerini listelemek istiyorum </b></font>
<ul> <b>Adým 1: </b> "<span style="background-color:yellow" >Poliklinik <input type="radio" name="r" value="1"></span>" seçim kutusunu týklayýnýz. <br>
		<b>Adým 2: </b>Tüm diðer alanlarý boþ býrakýnýz.<br>
		<b>Adým 3: </b>Aramayý baþlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Yatan hastalarýn tüm ameliyathane belgelerini listelemek istiyorum </b></font>
<ul> <b>Adým 1: </b> "<span style="background-color:yellow" >Yatan hasta <input type="radio" name="r" value="1"></span>" seçim kutusunu týklayýnýz. <br>
		<b>Adým 2: </b>Tüm diðer alanlarý boþ býrakýnýz.<br>
		<b>Adým 3: </b>Aramayý baþlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Genel saðlýk sigortasýna baðlý hastalarýn tüm ameliyathane belgelerini listelemek istiyorum </b></font>
<ul> <b>Adým 1: </b> "<span style="background-color:yellow" >Genel saðlýk sigortasý <input type="radio" name="r" value="1"></span>" seçim kutusunu týklayýnýz. <br>
		<b>Adým 2: </b>Tüm diðer alanlarý boþ býrakýnýz.<br>
		<b>Adým 3: </b>Aramayý baþlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Özel sigortalý hastalarýn tüm ameliyathane belgelerini görmek istiyorum </b></font>
<ul> <b>Adým 1: </b> "<span style="background-color:yellow" >Özel <input type="radio" name="r" value="1"></span>" seçim kutusunu týklayýnýz. <br>
		<b>Adým 2: </b>Tüm diðer alanlarý boþ býrakýnýz.<br>
		<b>Adým 3: </b>Aramayý baþlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Ücretli hastalarýn tüm ameliyathane belgelerini listelemek istiyorum </b></font>
<ul> <b>Adým 1: </b> "<span style="background-color:yellow" >Ücretli<input type="radio" name="r" value="1"></span>" seçim kutusunu týklayýnýz. <br>
		<b>Adým 2: </b>Tüm diðer alanlarý boþ býrakýnýz.<br>
		<b>Adým 3: </b>Aramayý baþlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düðmesini týklayýnýz.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir anahtar sözcük ile tüm ameliyathane belgelerini listelemek istiyorum.</b></font>
<ul> <b>Adým 1: </b>Anahtar sözcüðü ilgili alana giriniz. Tam bir sözcük, cümle veya bir sözcüðün ilk bir kaç harfi olabilir. <br>
		<ul><font size=2 color="#000099" >
		<b>Örnek:</b> Taný ile ilgili anahtar sözcüðü "Taný" alanýna giriniz.<br>
		<b>Örnek:</b> Yeri ile ilgili anahtar sözcüðü  "Yeri" alanýna giriniz.<br>
		<b>Örnek:</b> Tedavi ile ilgili anahtar sözcüðü "Tedavi" alanýna giriniz.<br>
		<b>Örnek:</b> Özel uyarý ile ilgili anahtar sözcüðü  "Özel uyarý" alanýna giriniz.<br>
		</font>
		</ul><b>Adým 2: </b>Tüm diðer alanlarý boþ býrakýnýz.<br>
		<b>Adým 3: </b>Aramayý baþlatmak için  <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düðmesini týklayýnýz.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir ameliyat sýnýfý içeren tüm belgeleri listelemek istiyorum</b></font>
<ul> <b>Adým 1: </b>Ýlgili alana anahtar sözcüðü giriniz. Tam bir sözcük, cümle, veya bir sözcüðün ilk birkaç harfi olabilir. <br>
		<ul><font size=2 color="#000099" >
		<b>Örnek:</b> Küçük ameliyat için sayýyý  "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> küçük </span>" alanýna giriniz.<br>
		<b>Örnek:</b> Orta ameliyat için sayýyý  "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> orta </span>" alanýna giriniz.<br>
		<b>Örnek:</b> Büyük ameliyat için sayýyý  "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> büyük </span>" alanýna giriniz.<br>
		</font>
		</ul><b>Adým 2: </b>Tüm diðer alanlarý boþ býrakýnýz.<br>
		<b>Adým 3: </b>Aramayý baþlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>><b><font color="#990000"> Uyarý:</font></b>
<ul> Birkaç arama koþulunu birleþtirebilirsiniz. Örneðin cerrah "Gürlek" tarafýndan ameliyat edilmiþ ve tedavisi "lipo" ile baþlayan bir sözcük içeren tüm yatan hastalarý listelemek isterseniz:<p>
		<b>Adým 1: </b> "<span style="background-color:yellow" > Cerrah: <input type="text" name="s" size=15 maxlength=4 value="Gürlek"> </span>" alanýna "Gürlek" giriniz.<br>
		<b>Adým 2: </b>"<span style="background-color:yellow" > <input type="radio" name="r" value="1" checked>Yatan hasta </span>" seçim kutusunu týklayýnýz.<br>
		<b>Adým 3: </b>"<span style="background-color:yellow" > Tedavi: <input type="text" name="s" size=20 maxlength=4 value="lipo"> </span>" alanýna "lipo" giriniz. <br>
		<b>Adým 4: </b>Aramayý baþlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düðmesini týklayýnýz.<p>

<b>Uyarý</b><br>
Eðer arama bir tek sonuç bulur ise, belgenin tamamý derhal görüntülenir.<br>
		Ancak eðer arama birkaç sonuç bulur ise bir liste görüntülenir.<p>
		Aradýðýnýz hastanýn belgesini açmak için, ya ilgili  <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> düðmesini, veya ad, veya soyad, veya tarih veya ameliyat numarasýný <nobr>(op nr)</nobr> týklayýnýz.
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.
</ul>
	<?php endif ?>
<?php if(($x1=="search"||$x1='paginate')&&($x2>0)) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Arþivdeki belirli bir belge görüntülenmek üzere nasýl seçilir?</b>
</font>
<ul>       	
 	<b>Uyarý: </b> Arþivdeki belgeyi görüntülemek için hastanýn adýný, veya soyadýný, veya ameliyat tarihini, veya ameliyat numarasýný týklayýnýz.<p> 
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Liste nasýl sýralanýr?</b>
</font>
<ul>       	
 	<b>Uyarý: </b> Listenin sýralanmasýný istediðiniz sütunun baþlýðýný týklayýnýz.<p> 
	Örnek: Listeyi ameliyat tarihine göre sýralamak ister iseniz "Ameliyat tarihi" baþlýðýný týklayýnýz.  <br>Tekrar týkladýðýnýzda sýralama tersine döner:<p>
	<blockquote>
	<img src='../help/tr/img/tr_or_search_sort.png'>
	</blockquote>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Arþivde aramaya nasýl devam edilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Arþivde arama alanlarýna geri itmek için  <input type="button" value="New archive research"> düðmesini týklayýnýz.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.
</ul>
	<?php endif ?>
<?php if(($x1=="select"||$x1='paginate')&&($x2==1)) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Görüntülenen arþiv belgesi nasýl düzenlenir veya güncellenir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Düzenleme moduna geçmek için  <input type="button" value="Bilgiyi güncelle"> düðmesini týklayýnýz.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Arþivlerde aramaya nasýl devam edilir?</b>
</font>
<ul>       	
 	<b>Yöntem 1: </b>Arþivin arama giriþ alanlarýna geri gitmek için <input type="button" value="Yeni arþiv aramasý"> düðmesini týklayýnýz.<p> 
 	<b>Veya Yöntem 2: </b>Arþivin giriþ alanlarýna geri gitmek için <img <?php echo createLDImgSrc('../','arch-blu.gif','0','absmiddle') ?>> düðmesini týklayýnýz.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.
</ul>

<?php endif ?>
<?php endif ?>

</form>

