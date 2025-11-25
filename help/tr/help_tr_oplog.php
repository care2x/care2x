<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
OR Logbook - 
<?php
if($src=="create")
{
	switch($x1)
	{
	case "": print "Yeni bir k�t�k belgesine ba�la";
						break;
	case "fresh": print "Yeni bir k�t�k belgesine ba�la";
						break;
	case "get": print  "";
						break;
	case "logmain": print "Belgelenmi� bir ameliyat�n k�t�k girdilerini d�zenle";
						break;
	default: print "Yeni bir ameliyat k�t���";	
	}
}
if($src=="time")
{
	print "Belgelendiriliyor ";
	switch($x1)
	{
	case "entry_out": print "giri� ve ��k�� zamanlar�";
						break;
	case "cut_close": print "kesi ve s�t�r zamanlar�";
						break;
	case "wait_time": print "bo� (bekleme) zamanlar�";
						break;
	case "bandage_time": print "al�� atel zamanlar�";
						break;
	case "repos_time": print "repozisyon zamanlar�";
	}
}
if($src=="person")
{
	print "Belgelendiriliyor ";
	switch($x1)
	{
	case "operator":$person="bir cerrah"; 
						break;
	case "assist":$person="bir asistan cerrah"; 
						break;
	case "scrub": $person="bir ameliyat hem�iresi";
						break;
	case "rotating":$person="bir alet hem�iresi"; 
						break;
	case "ana": $person="bir anestezist";
	}
	print $person;
}
if($src=="search")
{
	switch($x1)
	{
	case "search": print "Belirli bir belge se�iliyor";
						break;
	case "": print "Bir ameliyat�n k�t�k belgesini arama";
						break;
	case "get": print  "Hastan�n ameliyat�n�n k�t�k belgesi";
						break;
	case "fresh": print "Bir ameliyat�n k�t�k belgesini arama";
	}
}
if($src=="arch")
{
	print "Ar�iv";	
	/*switch($x1)
	{
	case "dummy": print "Ar�iv";
						break;
	case "": print "Ar�iv";
						break;
	case "?": print "Ar�iv";
						break;
	case "search": print  "Ar�iv arama sonu�lar� listesi";
						break;
	case "select": print "Hastan�n belgesi";
	}*/
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="person") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
H�zl� se�im listesi ile <?php echo $person ?> nas�l girilir?</b>
</font>
<ul>       	
 	<b>Uyar�: </b>E�er <?php echo $person ?> �nceki ameliyatta se�ildi ise, ismi h�zl� se�im listesinde listelenir.<p>
 	<b>Ad�m 1: </b>�nce g�revinin "Ameliyathane g�revi" se�im kutusundan do�ru olarak se�ilip se�ilmedi�ini kontrol ediniz. E�er se�ilmemi�se ameliyathane g�revini se�iniz veya d�zeltiniz.<br>
 	<b>As�m 2: </b> <?php echo $person ?> n�n soyad veya ad veya <nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Bu ki�iyi <?php echo $person ?>...olarak kaydediniz </span>"</nobr> ba�lant�s�na t�klay�n�z.
	Cerrah otomatik olarak "g�ncel girdiler" listesine eklenecektir. <p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<?php echo ucfirst($person) ?> h�zl� se�im listesinde g�r�nm�yor. <?php echo $person ?> nas�l girilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> <?php echo $person ?>'�n soyad veya ad�n�n tamam�n� veya ilk birka� harfini   "<span style="background-color:yellow" > Yeni bir  <?php echo substr($person,2) ?>...ara </span>" alan�na giriniz.<br>
 	<b>Ad�m 2: </b> <?php echo $person ?> '� aramaya ba�lamak i�in  <input type="button" value="Tamam"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 3: </b>Arama sonu�lar� listeler. Belgelendirmek istedi�iniz  <?php echo $person ?> nin soyad veya ad vaya ilgili <nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Bu ki�iyi  <?php echo $person ?>...olarak gir  </span>"</nobr> ba�lant�s�na t�klay�n�z. 
</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Listeden <?php echo $person ?> nas�l silinir?</b></font> 
<ul>       	
 	<b>Ad�m 1: </b>Ki�inin isminin sa��ndaki  <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> simgesini t�klay�n�z.<br>
 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> ��im bitti. K�t��e nas�l geri giderim?</b></font> 
<ul>       	
 	<b>Ad�m 1: </b>Siz  <?php echo $person ?> se�tikten sonra g�r�nen <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 �ptal etmeye karar verirseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<?php endif ?>

<?php if($src=="time") : ?>
	<?php if($x1=="entry_out") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Giri� ve ��k�� zamanlar� nas�l belgelendirilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Giri� zaman�n� sol s�tundaki  "<span style="background-color:yellow" > giri� saati: <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<br>
 	<b>Ad�m 2: </b>��k�� zaman�n� sa� s�tundaki "<span style="background-color:yellow" > ��k�� saati: <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<p>
<ul>       	
 	<b>�pucu: </b>�u anki zaman� otomatik olarak girmek i�in  "n" veya "N" (Now=�imdi anlam�nda) giriniz.
</ul><br>
 	<b>Uyar�: </b>Bilgiyi kay�t etmeden �nce birka� giri� ve ��k�� saatini birden girebilirsiniz.<p>
</ul>

	<?php endif ?>
	<?php if($x1=="cut_close") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Kesi ve s�t�r saatleri nas�l belgelendirilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Kesi zaman�n� sol s�tundaki "<span style="background-color:yellow" > ba�lama saati: <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<br>
 	<b>Ad�m 2: </b>S�t�r zaman�n� sa� s�tundaki  "<span style="background-color:yellow" > biti� saati: <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<p>
<ul>       	
 	<b>�pucu: </b>�u anki zaman� otomatik olarak girmek i�in  "n" veya "N" (Now=�imdi anlam�nda) giriniz.
</ul><br>
 	<b>Uyar�: </b>Bilgiyi kay�t etmeden �nce birka� kesi ve s�t�r saatini birden girebilirsiniz..<p>
</ul>

	<?php endif ?>
	<?php if($x1=="wait_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bo� (bekleme) zamanlar� nas�l belgelendirilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Ba�lama saatini ilk s�tundaki  "<span style="background-color:yellow" > ba�lama saati: <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<br>
 	<b>Ad�m 2: </b>Biti� saatini ikinci s�tundaki  "<span style="background-color:yellow" > biti� saati: <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<p>
<ul>       	
 	<b>�pucu: </b>�u anki zaman� otomatik olarak girmek i�in  "n" veya "N" (Now=�imdi anlam�nda) giriniz.
</ul><br>
 	<b>Ad�m 3: </b>Sebebi ���nc� s�tundaki (sebep) se�im kutusundan se�iniz.<p>
 	<b>Uyar�: </b>Bilgiyi kay�t etmeden �nce birka� ba�lama, biti� saati ve sebepleri birden girebilirsiniz.<p>
</ul>

	<?php endif ?>
	<?php if($x1=="bandage_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Al�� ve atel zamanlar� nas�l belgelendirilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Ba�lama saatini ilk s�tundaki  "<span style="background-color:yellow" > ba�lama saati: <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<br>
 	<b>Ad�m 2: </b>Biti� saatini ikinci s�tundaki  "<span style="background-color:yellow" > biti� saati: <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<p>
<ul>       	
 	<b>�pucu: </b>�u anki zaman� otomatik olarak girmek i�in  "n" veya "N" (Now=�imdi anlam�nda) giriniz.
</ul><br>
 	<b>Uyar�: </b>Bilgiyi kay�t etmeden �nce birka� ba�lama, biti� saati birden girebilirsiniz.<p>
</ul>

	<?php endif ?>
	<?php if($x1=="repos_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Repozisyon zamanlar� nas�l belgelendirilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Ba�lama saatini ilk s�tundaki  "<span style="background-color:yellow" > ba�lama saati: <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<br>
 	<b>Ad�m 2: </b>Biti� saatini ikinci s�tundaki  "<span style="background-color:yellow" > biti� saati: <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<p>
<ul>       	
 	<b>�pucu: </b>�u anki zaman� otomatik olarak girmek i�in  "n" veya "N" (Now=�imdi anlam�nda) giriniz.
</ul><br>
 	<b>Uyar�: </b>Bilgiyi kay�t etmeden �nce birka� ba�lama, biti� saati birden girebilirsiniz.<p>
</ul>

	<?php endif ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bilgi nas�l kay�t edilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Bilgiyi kay�t etmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>��iniz bitti ise, pencereyi kapat�p k�t��e geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Girilenleri silmek istiyorum fakat "Yeni ba�tan" d��mesi �al��m�yor g�r�n�yor. Ne yapmal�y�m?</b></font> 
<ul>       	
 	<b>Uyar�: </b>"Yeni ba�tan" d��mesi t�kland���nda yaln�zca kay�t edilmemi� girdileri siler. Daha �nceden kay�t edilmi� girdileri silmek ister iseniz �u y�nergeyi izleyiniz:<p>
 	<b>Ad�m 1: </b>Silmek istedi�iniz zaman�n giri� alan�n� t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Zaman� el ile klavyedeki "sil" veya "geri" tu�lar�n� kullanarak siliniz.<br>
 	<b>Ad�m 3: </b>De�i�iklikleri kay�t etmek i�in  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 �ptal etmeye karar verir iseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<?php endif ?>


<?php if($src=="create") : ?>
	<?php if($x1=="logmain") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyat�n k�t�k kay�d� nas�l d�zenlenir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Hastan�n k�t�k girdisinin ilgili  <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>>  d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Hastan�n k�t�k kay�tlar� edit�r �er�eveye kopyalan�r. Burada kay�tlar� bir ameliyat� belgelendirme y�nergelerini izleyerek d�zenleyebilirsiniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hastan�n belge klas�r� nas�l a��l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Hasta numaras�n�n solundaki  <img <?php echo createComIcon('../','info3.gif','0') ?>> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Hastan�n belge klas�r� a��l�r.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ba�ka b�l�m ve/veya ameliyathaneye nas�l de�i�tirilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Se�im kutusundan b�l�m� se�iniz 
				<select name="dept" size=1>
				<?php
$Or2Dept=get_meta_tags("../global_conf/resolve_or2ordept.pid");
					$opabt=get_meta_tags("../global_conf/$lang/op_tag_dept.pid");

					foreach($opabt as $x=>$v)
					{
						if($x=="anaesth") continue;
						print'
					<option value="'.$x.'"';
						if ($dept==$x) print " se�ildi";
						print '> '.$v.'</option>';
					}
				?>
					
				</select>.
<br>
 	<b>Ad�m 2: </b>Se�im kutusundan ameliyathaneyi se�iniz <select name="saal" size=1 >
				<?php
foreach($Or2Dept as $x=>$v)
					{
						print'
					<option value="'.$x.'"';
						if ($saal==$x) print " se�ildi";
						print '> '.$x.'</option>';
					}
				?>
				</select>.
<br>
 	<b>Ad�m 3: </b>Ba�ka ameliyathane ve/veya b�l�me de�i�tirmek i�in  <input type="button" value="De�i�tir"> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Halen g�sterilenin d���nda belirli bir g�n�n k�t�k kay�tlar� nas�l g�r�nt�lenir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>�nceki g�n(g�nler) in k�t�k girdilerini g�stermek i�in tablonun �st sol k��esindeki  "<span style="background-color:yellow" > �nceki g�n </span>" ba�lant�s�n� t�klay�n�z.<br>
	�stenilen g�n�n k�t�k girdileri g�r�nt�lenene de�in gerekti�i kadar t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Sonraki g�n(g�nler) in k�t�k girdilerini g�stermek i�in tablonun �st sa� k��esindeki  "<span style="background-color:yellow" > Sonraki g�n </span>" ba�lant�s�n� t�klay�n�z.<br>
	�stenilen g�n�n k�t�k girdileri g�r�nt�lenene de�in gerekti�i kadar t�klay�n�z.<br>
</ul>

<hr>

	<?php endif ?>
	
	<?php if($x2=="material") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyatta kullan�lan malzeme nas�l belgelendirilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Malzemenin numaras�n� "<span style="background-color:yellow" > Malzeme no.: </span>" alan�na yaz�n�z.<p>
	<b>Di�er se�enekler: </b>
	<ul type=disc>  	
	<li>Malzemenin ad�, �r�n tan�m�, jenerik lisans numaras�, sipari� numaras� bilgisinin ya tamam�n� ya da ilk birka� harfini  "<span style="background-color:yellow" > Malzeme no.: </span>" alan�na yaz�n�z.
	<li>Malzemenin barkodunu barkod okuyucuya okutunuz.
	</ul><br> 
 	<b>Ad�m 2: </b>�r�n� aramak i�in  <input type="button" value="Tamam"> d��mesini t�klay�n�z veya klavyede  "enter" tu�una bas�n�z.<p> 
<ul>       	
 	<b>Uyar�: </b>E�er arama bir sonu� bulur ise, malzemenin bilgisi belgeye derhal eklenir.<p> 
 	<b>Uyar�: </b>Arama birka� sonu� bulur ise, bir liste g�r�nt�lenir. Malzemeyi belgeye eklemek i�in malzemenin ad�n�, veya numaras�n�, veya  <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> d��mesini t�klay�n�z.<p> 
	</ul>
 	<b>Ad�m 3: </b>E�er malzeme belgeye eklendi ise, e�er gerekir ise  "<span style="background-color:yellow" > par�a say�s�.</span>" alan�ndaki bilgiyi de�i�tirebilirsiniz.<p> 
<ul>       	
 	<b>Uyar�: </b>"Par�a say�s�" alan�ndaki girdiyi de�i�tirdi�iniz zaman "Kaydet" ve "Yeni ba�tan" d��meleri belirir.<p> 
	</ul>
 	<b>Ad�m 4: </b>E�er "Par�a say�s�" alan�ndaki girdiyi de�i�tirdi iseniz, de�i�iklikleri kay�t etmek i�in  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Listeden bir malzeme nas�l silinir?</b>
</font>
<ul> 
 	<b>Ad�m 1: </b>�lgili malzemenin <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> simgesini t�klay�n�z.<br> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Malzeme bulunmad�. Bir malzemenin bilgisi nas�l el ile (zorla) girilir?</b>
</font>
<ul> 
 	<b>Ad�m 1: </b> "<span style="background-color:yellow" > <img <?php echo createComIcon('../','accessrights.gif','0') ?>> Malzemeyi el ile girmek i�in buray� t�klay�n�z. </span>" ba�lant�s�n� t�klay�n�z.<br> 
 	<b>Ad�m 2: </b>Malzeme bilgisini ilgili alanlara el ile giriniz.<p> 
 	<b>Ad�m 3: </b>Malzemenin bilgisini belgeye eklemek i�in  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 �ptal etmeye karar verirseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ana k�t�k geri nas�l g�r�nt�lenir?</b>
</font>
<ul> 
 	<b>Ad�m 1: </b> "<span style="background-color:yellow" > <img <?php echo createComIcon('../','manfldr.gif','0') ?>> K�t�k kay�d�n� g�ster. </span>" ba�lant�s�n� t�klay�n�z.<br> 
</ul>
<hr>
	<?php endif ?>

	<?php if(($x1=="")||($x1=="fresh")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir ameliyat�n k�t�k belgesine nas�l ba�lan�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>�nce hastay� bulunuz. Hastan�n numaras�n� "<span style="background-color:yellow" > Hasta no: </span>" alan�na yaz�n�z.<p>
	<b>Di�er se�enekler: </b>
	<ul type=disc>  	
	<li>Hastan�n soyad veya ad�n�n tamam�n� veya ilk birka� harfini  "<span style="background-color:yellow" > Soyad, Ad </span>" alan�na giriniz.
	<li>Hastan�n do�um tarihinin tamam�n� veya ilk birka� rakam�n�  "<span style="background-color:yellow" > Do�um tarihi </span>" alan�na giriniz.
	</ul>
 	<b>Ad�m 2: </b>Hastay� aramaya ba�lamak i�in  <input type="button" value="Hastay� ara"> d��mesini t�klay�n�z.<p> 
<ul>       	
 	<b>Uyar�: </b>E�er arama bir sonu� bulur ise, hastan�n temel bilgileri ilgili alanlara hemen girilir.<p> 
 	<b>Uyar�: </b>Arama birka� sonu� bulur ise, bir liste g�r�l�r. Belgelendirmek i�in hastan�n soyad� veya ad�n� t�klay�n�z.<p> 
	</ul>
 	<b>Ad�m 3: </b>Daha fazla bilgi i�in  <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> d��mesini tekrar t�klay�n�z.<p> 

</ul>

	<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyat i�in tan� nas�l girilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Tan�y� "<span style="background-color:yellow" > Tan�: </span>" alan�na yaz�n�z.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Cerrah bilgisi nas�l girilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>"<span style="background-color:yellow" > Cerrah </span>" ba�lant�s�n� t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Cerrah�n bilgisini girmek i�in bir pencere a��l�r. <br>
 	<b>Ad�m 3: </b>Penceredeki y�nergeleri izleyiniz veya daha fazla bilgi i�in pencere i�erisindeki "Yard�m" d��mesini t�klay�n�z. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Asistan cerrah bilgisi nas�l girilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> "<span style="background-color:yellow" > Asistan </span>" ba�lant�s�n� t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Asistan cerrah�n bilgilerini girmek i�in bir pencere a��l�r. <br>
 	<b>Ad�m 3: </b>Penceredeki y�nergeleri izleyiniz veya daha fazla bilgi i�in pencere i�erisindeki "Yard�m" d��mesini t�klay�n�z. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyat hem�iresi bilgileri nas�l girilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> "<span style="background-color:yellow" > Ameliyat hem�iresi </span>" ba�lant�s�n� t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Ameliyat hem�iresi bilgilerini girmek i�in bir pencere a��l�r. <br>
 	<b>Ad�m 3: </b>Penceredeki y�nergeleri izleyiniz veya daha fazla bilgi i�in pencere i�erisindeki "Yard�m" d��mesini t�klay�n�z.  <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Alet hem�iresi bilgileri nas�l girilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> "<span style="background-color:yellow" > Alet hem�iresi </span>" ba�lant�s�n� t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Alet hem�iresi bilgilerini girmek i�in bir pencere a��l�r. <br>
 	<b>Ad�m 3: </b>Penceredeki y�nergeleri izleyiniz veya daha fazla bilgi i�in pencere i�erisindeki "Yard�m" d��mesini t�klay�n�z.  <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyatta kullan�lan anestezi tipi nas�l girilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>anestezi tipini  "<span style="background-color:yellow" > Anestezi <select name="a">
                                                                     	<option > ITA</option>
                                                                     	<option > Plexus</option>
                                                                     	<option > ITA-Jet</option>
                                                                     	<option > ITA-Mask</option>
                                                                     	<option > LA</option>
                                                                     	<option > DS</option>
                                                                     	<option > AS</option>
                                                                     </select> </span>" alan�ndan se�iniz.<p>
	<ul type=disc>       	
 	<li><b>ITA: </b>�ntra-trakeal anestezi<br>
 	<li><b>LA: </b>Lokal anestezi<br>
 	<li><b>AS: </b>Analjezik-sedasyon<br>
 	<li><b>DS: </b>AS ye e�de�er<br>
 	<li><b>Plexus: </b>Pleksus blo�u lokal anestezi<br>
	</ul>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Anastezist bilgileri nas�l girilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> "<span style="background-color:yellow" > Anestezist </span>" ba�lant�s�n� t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Anestezist bilgilerini girmek i�in bir pencere a��l�r. <br>
 	<b>Ad�m 3: </b>Penceredeki y�nergeleri izleyiniz veya daha fazla bilgi i�in pencere i�erisindeki "Yard�m" d��mesini t�klay�n�z. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Giri�, kesi, s�t�r ve ��k�� zamanlar� do�rudan ilgili alanlara nas�l girilir?</b>
</font>
<ul>       	
 	<b>Giri� zaman�: </b>Giri� zaman�n�  "<span style="background-color:yellow" > Giri�:<input type="text" name="t" size=5 maxlength=5> </span>" alan�na giriniz.<br>
 	<b>Kesi zaman�: </b>Kesi zaman�n� "<span style="background-color:yellow" > Kesi: <input type="text" name="t" size=5 maxlength=5> </span>" alan�na giriniz.<br>
 	<b>S�t�r zaman�: </b>S�t�r zaman�n� "<span style="background-color:yellow" > S�t�r: <input type="text" name="t" size=5 maxlength=5> </span>" alan�na giriniz.<br>
 	<b>��k�� zaman�: </b>��k�� zaman�n� "<span style="background-color:yellow" > ��k��: <input type="text" name="t" size=5 maxlength=5> </span>" alan�na giriniz.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Birka� zaman bilgisi hep bir arada nas�l girilir?</b>
</font>
<ul> <b>Ad�m 1: </b><p>    	
 	<b>Giri�/��k�� zaman�: </b>
 	Sol alt k��ede bulunan  "<span style="background-color:yellow" > Giri�/��k�� <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" ba�lant�s�n� t�klay�n�z.<p>
 	<b>Kesi/S�t�r zaman�:</b>
 	Sol alt k��ede bulunan  "<span style="background-color:yellow" > Kesi/S�t�r <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" ba�lant�s�n� t�klay�n�z.<p>
 	<b>Bo� zaman: </b>
 	Sol alt k��ede bulunan "<span style="background-color:yellow" > Bo� zaman <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" ba�lant�s�n� t�klay�n�z.<p>
 	<b>Al��/Atel zaman�:</b>
 	Sol alt k��ede bulunan "<span style="background-color:yellow" > Al��/Atel <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" ba�lant�s�n� t�klay�n�z.<p>
 	<b>Repozisyon zaman�: </b>
 	Sol alt k��ede bulunan "<span style="background-color:yellow" > Repozisyon <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" ba�lant�s�n� t�klay�n�z.<p>
 	<b>Ad�m 2: </b>Zaman bilgilerini girmek i�in bir pencere a��l�r. <br>
 	<b>Ad�m 3: </b>Penceredeki y�nergeleri izleyiniz veya daha fazla bilgi i�in pencere i�erisindeki "Yard�m" d��mesini t�klay�n�z.  <br>
	</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Grafik zaman �izelgesine zaman bilgisi nas�l girilir?</b>
</font>
<ul> <b>Ad�m 1: </b>Fare i�aret�isini zaman �izelgesinde ilgili zaman bilgisi i�in se�ilen zaman �zerine g�t�r�n�z (�rne�in Al��/Atel).<br>
 	<b>Ad�m 2: </b>Se�ilen zamana kar��l�k gelen zaman �izelgesine t�klay�n�z.<p>
<b>Uyar�:</b> �lk girdi�iniz ba�lama zaman�, ikinci girdi�iniz biti� zaman�, ���nc� girdi�iniz ikinci ba�lama zaman� vs. olur.
	</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Tedavi veya ameliyat bilgisi nas�l girilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Tedavi veya ameliyat bilgisini "<span style="background-color:yellow" > Tedavi/Ameliyat: </span>" alan�na giriniz.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Sonu�lar, g�zlem, ek bilgiler nas�l girilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> "<span style="background-color:yellow" > Sonu�lar: </span>" alan�na yaz�n�z.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
K�t�k belgesi nas�l kay�t edilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir k�t�k belgesine nas�l ba�lan�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> <img <?php echo createLDImgSrc('../','newpat2.gif','0') ?>> d��mesini t�klay�n�z<br>
 	<b>Ad�m 2: </b>Daha fazla bilgi i�in  <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> d��mesini tekrar t�klay�n�z.<br>
	</ul>
	
<b>Uyar�</b>
<ul> Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
	<?php endif ?>

<?php endif ?>



<?php if($src=="search") : ?>
	<?php if(($x1=="fresh")||($x1=="")) : ?>


<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Belirli bir hastan�n belgesi nas�l ara�t�r�l�r?</b>
</font>
<ul>       	
 	<b>Ad�m  1: </b>Hastan�n soyad, ad, veya do�um tarihi bilgilerinin ya tamam�n�  veya ilk birka� harfini  "<span style="background-color:yellow" > Anahtar s�zc�k: <input type="text" name="m" size=20 maxlength=20> </span>" alan�na giriniz. <br>
 	<b>Ad�m 2: </b>Hastan�n belgesini aramaya ba�lamak i�in  <input type="button" value="Ara"> d��mesini t�klay�n�z.<p> 
<ul>       	
 	<b>Uyar�: </b>Arama anahtar s�zc���n tam kar��l���n� bulur ise, hastan�n belgesi derhal g�r�nt�lenir.<p> 
 	<b>Uyar�: </b>E�er arama anahtar s�zc��e sadece yakla��k bir s�zc�k bulur ise bir liste g�r�nt�lenir. 
	Belgesini g�r�nt�lemek i�in hastan�n soyad�n� t�klay�n�z.<p> 
	</ul>
</ul>
	<?php endif ?>
<?php if(($x1=="search")&&($x3!="1")) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Belirli belge g�r�nt�lenmek �zere nas�l se�ilir?</b>
</font>
<ul>       	
 	<b>Uyar�: </b> Belgesini g�r�nt�lemek i�in hastan�n soyad�n� t�klay�z.<p> 
</ul>

	<?php endif ?>
<?php if(($x1=="get")||($x3=="1")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
G�r�nt�lenen k�t�k belgesi nas�l d�zenlenir veya g�ncellenir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>D�zenleme moduna ge�mek i�in ameliyat tarihinin alt�ndaki en sol s�tunda bulunan  <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>D�zenleme moduna ge�ti�inizde belge d�zenleme ilgili daha fazla yard�ma gereksiniminiz olur ise "Yard�m" d��mesini t�klay�n�z.<p> 
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hastan�n belge klas�r� nas�l a��l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Hastan�n protokol numaras�n�n solundaki <img <?php echo createComIcon('../','info3.gif','0') ?>> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Hastan�n belge klas�r� a��l�r. Daha fazla bilgiye gereksiniminiz olur ise pencere i�erisindeki "Yard�m" d��mesini t�klay�n�z.<p> 
	</ul>

<?php endif ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Aramaya nas�l devam edilir?</b>
</font>
<ul>       	
 	<b>Ad�m  1: </b>Hastan�n soyad, ad, veya do�um tarihi bilgilerinin ya tamam�n�  veya ilk birka� harfini  "<span style="background-color:yellow" > Anahtar s�zc�k: <input type="text" name="m" size=20 maxlength=20> </span>" alan�na giriniz. <br>
 	<b>Ad�m 2: </b>Hastan�n belgesini aramaya ba�lamak i�in  <input type="button" value="Ara"> d��mesini t�klay�n�z.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<?php endif ?>

<?php if($src=="arch") : ?>
	<?php if($x2=="1") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�: Son k�t�k girdileri</b></font> 
<ul>  Ar�ive her giri�inizde, son t�t��e al�nm�� amaliyatlar derhal g�r�nt�lenir.
</ul>
	<?php endif ?>
	<?php if(($x3=="")&&($x1!="0")) : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Bu tarihte hi� ameliyat yap�lmad�.</b></font> 
<ul>       	
Se�enekler kutusundan "Se�enekler" i t�klay�n�z.<br>
Arama moduna ge�mek i�in "Ara" y� t�klay�n�z.</ul>
	
	<?php endif ?>
	



<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Bir ba�ka g�n�n ar�ivlenmi� k�t�k girdilerini g�rmek istiyorum.</b></font>
<ul> <b>�nceki g�n� g�r�nt�lemek i�in : </b>�st sol s�tundaki  "<span style="background-color:yellow" > �nceki g�n </span>" ba�lant�s�n� t�klay�n�z. 
				Bu ba�lant�y� istenilen g�n g�r�nt�lenene de�in ne kadar gerekir ise o kadar t�klay�n�z.<p>
 <b>Sonraki g�n� g�r�nt�lemek i�in: </b>�st sa� s�tundaki "<span style="background-color:yellow" > Sonraki g�n </span>" ba�lant�s�n� t�klay�n�z. 
				�stenilen g�n g�r�nt�lenene de�in bu ba�lant�y� ne kadar gerekir ise o kadar t�klay�n�z.<br>		
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Bir ba�ka ameliyathane veya b�l�m�n ar�ivlenmi� k�t�k bilgilerini g�rmek istiyorum.</b></font>
<ul> <b>Ad�m 1: </b>B�l�m� se�im kutusundan se�iniz <nobr>"<span style="background-color:yellow" > B�t�m veya ameliyathaneyi de�i�tiriniz <select name="o">
                                                                                                                                         	<option > �rnek b�l�m 1</option>
                                                                                                                                         	<option > �rnek b�l�m 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> <br>																  
	<b>Ad�m 2: </b>Veya ameliyathaneyi se�im kutusundan se�iniz <nobr>"<span style="background-color:yellow" > <select name="o">
                                                                                                                                         	<option > �rnek ameliyathane 1</option>
                                                                                                                                         	<option > �rnek ameliyathane 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> <br> 						  																																		  
		<b>Ad�m 3: </b>Yeni b�l�m veya ameliyathaneye de�i�tirmek i�in Click the button <input type="button" value="De�i�tir">  d��mesini t�klay�n�z.<br>
</ul>
<?php if(($x3!="")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
G�r�nt�lenen k�t�k belgesi nas�l g�ncellenir veya d�zenlenir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>D�zenleme moduna ge�mek i�in ameliyat tarihinin alt�nda en sol s�tundaki <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>D�zenleme moduna ge�tikten sonra daha fazla bilgiye gereksinim duyar iseniz "Yard�m" d��mesini t�klay�n�z.<p> 
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hastan�n veri klas�r� nas�l a��l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Hastan�n protokol numaras�n�n solundaki  <img <?php echo createComIcon('../','info3.gif','0') ?>> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Hastan�n bilgi klas�r� a��l�r. Daha fazla a��klamaya gereksinim duyar iseniz "Yard�m" d��mesini t�klay�n�z.<p> 
	</ul>
	<?php endif ?>
	
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 �ptal etmeye karar verir iseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
</ul>


	<?php endif ?>


</form>

