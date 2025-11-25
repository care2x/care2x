<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Biyokimya Laboratuvar� - 
<?php
if($src=="create")
{
	switch($x1)
	{
	case "": print "Yeni k�t�k belgesine ba�la";
						break;
	case "fresh": print "Yeni k�t�k belgesine ba�la";
						break;
	case "get": print  "";
						break;
	case "logmain": print "Belgeli bir ameliyat�n k�t�k girdilerini d�zenle";
						break;
	default: print "Yeni bir ameliyat k�t���";	
	}
}
if($src=="time")
{
	print "Belgelendiriliyor ";
	switch($x1)
	{
	case "entry_out": print "giri� ve ��k�� s�resi";
						break;
	case "cut_close": print "kesi ve s�t�r s�resi";
						break;
	case "wait_time": print "bo� (bekleme) s�resi";
						break;
	case "bandage_time": print "al��-bandaj s�resi";
						break;
	case "repos_time": print "repozisyon s�resi";
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
	case "rotating":$person="bir meydanc� hem�ire"; 
						break;
	case "ana": $person="bir anestezi uzman�";
	}
	print $person;
}
if($src=="search")
{
	print "Bir hastay� ara";	
/*	switch($x1)
	{
	case "search": print "Belirli bir belgeyi se�me";
						break;
	case "": 
						break;
	case "get": print  "Hastan�n ameliyat k�t�k belgesi";
						break;
	case "fresh": print "Bir hastan�n ameliyat k�t�k belgesini arama";
	}
*/}
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
	case "search": print  "Ar�iv arama sonu�lar�n�n listesi";
						break;
	case "select": print "Hastan�n belgesi";
	}*/
}
if($src=="input")
{
	print "Tetkik sonu�lar�n� girme";	
	/*switch($x1)
	{
	case "dummy": print "Ar�iv";
						break;
	case "": print "Ar�iv";
						break;
	case "?": print "Ar�iv";
						break;
	case "search": print  "Ar�iv arama sonu�lar�n�n listesi ";
						break;
	case "select": print "Hastan�n belgesi";
	}*/
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="person") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
H�zl� se�im listesi <?php echo $person ?> yolu ile nas�l girilirt?</b>
</font>
<ul>       	
 	<b>Uyar�: </b>E�er ki�inin ismi �nceki bir i�lemde se�ildi ise <?php echo $person ?> ismi h�zl� listede g�r�n�r.<p>
 	<b>Ad�m 1: </b>�nce i�levinin "Ameliyathane i�levi" se�im kutusunda do�ru olarak se�ilip se�ilmedi�ini kontrol ediniz, se�ilmemi� ise ki�inin ameliyathane i�levini do�ru olarak se�iniz.<br>
 	<b>Ad�m 2: </b> <?php echo $person ?>'�n soyad�n�, veya ad�n�, veya <nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> bu ki�iyi <?php echo $person ?>... </span>"</nobr> olarak kaydet ba�lant�s�n� t�klay�n�z.
	Cerrah otomatik olarak "g�ncel kay�tlar"  listesine eklenecektir.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<?php echo ucfirst($person) ?> h�zl� se�im listesinde g�r�lm�yor. <?php echo $person ?>'yi nas�l kaydetmeli?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b><?php echo $person ?>'in soyad ad bilgilerinin ya tamam�n� ya da bir k�sm�n�  "<span style="background-color:yellow" > Yeni ara <?php echo substr($person,2) ?>... </span>" alan�na giriniz.<br>
 	<b>Ad�m 2: </b> <input type="button" value="Tamam"> d��mesini t�klayarak  <?php echo $person ?>'yi aramaya ba�lay�n�z.<br>
 	<b>Ad�m 3: </b>Arama sonu�lar� listeler. Belgelendirmek istedi�iniz <?php echo $person ?> 'in  ilgili  soyad, ad, veya <nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Bu ki�iyi olarak kaydet <?php echo $person ?>... </span>"</nobr> ba�lant�s�na t�klay�n�z. 
</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Listeden  <?php echo $person ?> nas�l silinir?</b></font> 
<ul>       	
 	<b>Ad�m 1: </b>Ki�inin isminin sa��ndaki  <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> simgesini t�klay�n�z.<br>
 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> ��im bitti. K�t�k kayd�na nas�l geri giderim?</b></font> 
<ul>       	
 	<b>Ad�m 1: </b> <?php echo $person ?>'yi se�tikten sonra g�r�nen <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 �ptal etmeye karar verir iseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<?php endif ?>

<?php if($src=="time") : ?>
	<?php if($x1=="entry_out") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Giri� ve ��k�� zamanlar� nas�l belgelendirilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Giri� saatini sol s�tundaki "<span style="background-color:yellow" > giri� saati: <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<br>
 	<b>Ad�m 2: </b>��k�� saatini sa� s�tundaki "<span style="background-color:yellow" > ��k�� saati: <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<p>
<ul>       	
 	<b>�pucu: </b>Giri� alan�na �u an� otomatik olarak girmek i�in  "n" veya "N" (Now=�imdi anlam�nda) giriniz.
</ul><br>
 	<b>Uyar�: </b>Bilgiyi kay�t etmeden �nce birka� giri� ve ��k�� zaman�n� ayn� anda kay�t edebilirsiniz.<p>
</ul>

	<?php endif ?>
	<?php if($x1=="cut_close") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Kesi ve s�t�r s�releri nas�l belgelendirilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Kesi yap�ld��� an� sol s�tundaki "<span style="background-color:yellow" > ba�lama saati: <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<br>
 	<b>Ad�m 2: </b>S�t�r an�n� sa� s�tundaki "<span style="background-color:yellow" > biti� saati: <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<p>
<ul>       	
 	<b>�pucu: </b>Giri� alan�na �u an� otomatik olarak girmek i�in  "n" veya "N" (Now=�imdi anlam�nda) giriniz.
</ul><br>
	<b>Uyar�: </b>Bilgiyi kay�t etmeden �nce birka� kesi ve s�t�r zaman�n� ayn� anda kay�t edebilirsiniz.<p>
</ul>
 	
	<?php endif ?>
	<?php if($x1=="wait_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bo� (bekleme) s�resi nas�l belgelendirilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Ba�lad��� zaman� ilk s�tundaki "<span style="background-color:yellow" > ba�lama saati: <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<br>
 	<b>Ad�m 2: </b>Bitti�i zaman� ikinci s�tundaki "<span style="background-color:yellow" > bitme saati: <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<p>
<ul>       	
 	<b>�pucu: </b>Giri� alan�na �u an� otomatik olarak girmek i�in  "n" veya "N" (Now=�imdi anlam�nda) giriniz.
</ul><br>
	<b>Ad�m 3: </b>���nc� (sebep) s�tunundan sebebi se�iniz.<p>
 	
 	<b>Uyar�: </b>Bilgiyi kay�t etmeden �nce birka� ba�lama ve bitme saatini ve sebeplerini ayn� anda kay�t edebilirsiniz.<p>
</ul>
 
	<?php endif ?>
	<?php if($x1=="bandage_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Al�� ve pansuman s�releri nas�l belgelendirilir?</b>
</font>
<ul>     
	<b>Ad�m 1: </b>Ba�lad��� zaman� sol s�tundaki "<span style="background-color:yellow" > ba�lama saati: <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<br>
 	<b>Ad�m 2: </b>Bitti�i zaman� sa� s�tundaki "<span style="background-color:yellow" > bitme saati: <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<p>
<ul>       	
 	<b>�pucu: </b>Giri� alan�na �u an� otomatik olarak girmek i�in  "n" veya "N" (Now=�imdi anlam�nda) giriniz.
</ul><br>
	
 	<b>Uyar�: </b>Bilgiyi kay�t etmeden �nce birka� ba�lama ve bitme saatini ayn� anda kay�t edebilirsiniz.<p>  	
 	
</ul>

	<?php endif ?>
	<?php if($x1=="repos_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Repozisyon s�resi nas�l belgelendirilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Ba�lad��� zaman� sol s�tundaki "<span style="background-color:yellow" > ba�lama saati: <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<br>
 	<b>Ad�m 2: </b>Bitti�i zaman� sa� s�tundaki "<span style="background-color:yellow" > bitme saati: <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<p>
<ul>       	
 	<b>�pucu: </b>Giri� alan�na �u an� otomatik olarak girmek i�in  "n" veya "N" (Now=�imdi anlam�nda) giriniz.
</ul><br>
 	<b>Uyar�: </b>Bilgiyi kay�t etmeden �nce birka� ba�lama ve bitme saatini ayn� anda kay�t edebilirsiniz.<p>  	
 	
</ul>

	<?php endif ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bilgi nas�l kay�t edilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Bilgiyi kaydetmek i�in  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z<br>
 	<b>Ad�m 2: </b>��iniz bitti ise, pencereyi kapat�p kay�t k�t��� sayfas�na geri d�nmek i�in  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Girilenleri silmek istiyorum ama "Yeni ba�tan" d��mesi �al��m�yor gibi g�r�n�yor. Ne yapmal�y�m?</b></font> 
<ul>       	
 	<b>Uyar�: </b>"Yeni ba�tan" d��mesi t�klan�nca sadece hen�z kay�t edilmemi� girdiler silinir. E�er daha �nceden kay�t edilmi� girdileri silmek isterseniz, �u y�nergeyi izleyiniz:<p>
 	<b>Ad�m 1: </b>Silmek istedi�iniz zaman�n giri� alan�n� t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Zaman� klavyeden el ile  "Del" veya "Backspace" tu�lar�n� kullanarak siliniz.<br>
 	<b>Ad�m 3: </b>De�i�iklikleri kay�t etmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 �ptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<?php endif ?>


<?php if($src=="create") : ?>
	<?php if($x1=="logmain") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir ameliyat�n k�t�k kayd� nas�l d�zenlenir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Hastan�n k�t�k kayd� ile ilgili <img src="../img/update3.gif" width=15 height=14 border=0> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Hastan�n k�t�k kay�tlar� bir d�zenleyici penceresinde a��l�r. Kay�tlar� burada bir ameliyat� belgelendirme y�nergelerini izleyerek d�zenleyebilirsiniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hastan�n belgeler klas�r� nas�l a��l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Hastan�n numaras�n�n solundaki  <img <?php echo createComIcon('../','info3.gif','0') ?>> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Hastan�n belgeler klas�r� yeni bir pencerede a��l�r.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ba�ka bir b�l�m ve/veya ameliyathaneye nas�l de�i�tirilir?</b>
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
 	<b>Ad�m 3: </b>Di�er b�l�m ve/veya ameliyathaneye de�i�tirmek i�in <input type="button" value="Change"> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�u anda g�r�nt�lenenin d���nda belirli bir g�ne ait k�t�k kay�tlar� nas�l g�r�nt�lenir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Daha �nceki g�nlerin k�t�k kay�tlar�n� g�r�nt�lemek i�in, tablonun sol �st k��esindeki  "<span style="background-color:yellow" > �nceki g�n </span>" ba�lant�s�n� t�klay�n�z.<br>
	�stedi�iniz g�n�n k�t�k girdileri g�r�nt�lenene de�in ne kadar gerekirse o kadar t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Sonraki g�nlerin k�t�k girdilerini g�r�nt�lemek i�in tablonun sa� �st k��esindeki  "<span style="background-color:yellow" > Sonraki g�n </span>" ba�lant�s�n� t�klay�n�z.<br>
	�stedi�iniz g�n�n kayd�na ula�ana de�in ne kadar gerekir ise o kadar t�klay�n�z .<br>
</ul>

<hr>

	<?php endif ?>
	
	<?php if($x2=="material") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyat i�in kullan�lm�� bir malzeme nas�l belgelendirilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Malzemenin kalem numaras�n� "<span style="background-color:yellow" > Kalem numaras�: </span>" alan�na yaz�n�z.<p>
	<b>Di�er yollar: </b>
	<ul type=disc>  	
	<li>Bir malzemenin ismi, �r�n tan�m�, jenerik, lisans numaras� veya sipari� numaras� bilgisinin tamam�n� veya bir k�sm�n�  "<span style="background-color:yellow" > Kalem numaras�: </span>" alan�na giriniz.
	<li>Barkod okuyucu ile malzemenin barkodunu okutturunuz.
	</ul><br> 
 	<b>Ad�m 2: </b>�r�n� aramak i�in ya  <input type="button" value="Tamam"> d��mesini t�klat�n�z veya klavyeden entere bas�n�z.<p> 
<ul>       	
 	<b>Uyar�: </b>E�er arama bir tek sonu� bulur ise, araman�n sonucu do�rudan belgeye eklenir.<p> 
 	<b>Uyar�: </b>E�er arama birka� sonu� bulur ise , bir liste g�r�nt�lenir. Malzemeyi belgeye eklemek i�in, malzeme kaleminin  kaleminin numaras�na, malzemenin ismine veya  <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> d��mesine t�klay�n�z.<p> 
	</ul>
 	<b>Ad�m 3: </b>Malzeme listeye eklendi ise, gerekirse girilenleri  "<span style="background-color:yellow" > par�a say�s�</span>" alan�ndan de�i�tirebilirsiniz.<p> 
<ul>       	
 	<b>Uyar�: </b>"par�a say�s�" alan�ndaki bilgiyi de�i�tirdi�inizde "Kaydet" ve "Yeni ba�tan" d��meleri g�r�nt�lenir.<p> 
	</ul>
 	<b>Ad�m 4: </b>"par�a say�s�" alan�ndaki bilgiyi de�i�tirdi iseniz, de�i�iklikleri kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Listeden bir malzeme nas�l ��kar�l�r?</b>
</font>
<ul> 
 	<b>Ad�m 1: </b>Malzemenin ilgili <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> d��mesine t�klay�n�z.<br> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Malzeme bulunmad�. Bilgisi nas�l el ile (zorla) girilir?</b>
</font>
<ul> 
 	<b>Ad�m 1: </b> "<span style="background-color:yellow" > <img <?php echo createComIcon('../','accessrights.gif','0') ?>> Malzemeyi el ile girmek i�in, buray� t�klay�n�z. </span>" ba�lant�s�n� t�klay�n�z.<br> 
 	<b>Ad�m 2: </b>Malzemenin bilgisini ilgili alanlara el ile giriniz.<p> 
 	<b>Ad�m 3: </b>Malzemenin bilgisini belgeye eklemek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 �ptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ana kay�t k�t��� geri tekrar nas�l g�r�nt�lenir?</b>
</font>
<ul> 
 	<b>Ad�m 1: </b> "<span style="background-color:yellow" > <img <?php echo createComIcon('../','manfldr.gif','0') ?>> Kay�t k�t���n� g�ster. </span>" ba�lant�s�n� t�klay�n�z.<br> 
</ul>
<hr>
	<?php endif ?>

	<?php if(($x1=="")||($x1=="fresh")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir ameliyat� k�t�k belgesine nas�l ba�lan�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>�nce hastay� bulunuz. Hastan�n numaras�n� "<span style="background-color:yellow" > Hasta no: </span>" alan�na yaz�n�z.<p>
	<b>Di�er se�enekler: </b>
	<ul type=disc>  	
	<li>Hastan�n soyad veya ad�n�n tamam�n� ya da birka� harfini  "<span style="background-color:yellow" > Soyad, Ad </span>" alan�na giriniz .
	<li>Hastan�n do�um tarihinin tamam�n� ya da ilk birka� rakam�n� "<span style="background-color:yellow" > Do�um tarihi </span>" alan�na giriniz.
	</ul>
 	<b>Ad�m 2: </b>Hastay� aramaya ba�lamak i�in  <input type="button" value="Hastay� ara"> d��mesini t�klay�n�z.<p> 
<ul>       	
 	<b>Uyar�: </b>Arama bir sonu� bulur ise, hastan�n temel bilgileri hemen ilgili alanlara girilmi� g�r�nt�lenir.<p> 
 	<b>Uyar�: </b>Arama birka� sonu� bulur ise,  bir liste g�r�nt�lenir. Belgelendirmek �zere hastay� se�mek i�in hastan�n soyad veya ad�na t�klay�n�z.<p> 
	</ul>
 	<b>Ad�m 3: </b>Daha fazla bilgi i�in <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> d��mesini t�klay�n�z.<p> 

</ul>

	<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyat i�in tan� nas�l girilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Tan�y�  "<span style="background-color:yellow" > Tan�: </span>" alan�na yaz�n�z.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Cerrah bilgisi nas�l girilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> "<span style="background-color:yellow" > Cerrah </span>" ba�lant�s�n� t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Cerrah bilgisi i�in bir pencere a��l�r. <br>
 	<b>Ad�m 3: </b>Pencere i�indeki bilgileri izleyiniz ya da daha fazla bilgi i�in pencere i�erisindeki "Yard�m" d��mesini t�klay�n�z. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Asistan cerrah bilgisi nas�l girilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>"<span style="background-color:yellow" > Asistan </span>" ba�lant�s�n� t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Asistan cerrah bilgisini girmek i�in bir pencere a��l�r. <br>
 	<b>Ad�m 3: </b>Penceredeki bilgileri izleyiniz ya da daha fazla bilgi i�in pencere i�erisindeki "Yard�m" d��mesini t�klay�n�z. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyat hem�iresi bilgisi nas�l girilir?</b>
</font>
<ul>       	
 	
	<b>Ad�m 1: </b>"<span style="background-color:yellow" > Ameliyat hem�iresi </span>" ba�lant�s�n� t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Ameliyat hem�iresi bilgisini girmek i�in bir pencere a��l�r. <br>
 	<b>Ad�m 3: </b>Penceredeki bilgileri izleyiniz ya da daha fazla bilgi i�in pencere i�erisindeki "Yard�m" d��mesini t�klay�n�z. <br>
	</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yard�mc� hem�ire bilgisi nas�l girilir?</b>
</font>
<ul>       	
 	
	<b>Ad�m 1: </b>"<span style="background-color:yellow" > Yard�mc� hem�ire </span>" ba�lant�s�n� t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Yard�mc� hem�ire bilgisini girmek i�in bir pencere a��l�r. <br>
 	<b>Ad�m 3: </b>Penceredeki bilgileri izleyiniz ya da daha fazla bilgi i�in pencere i�erisindeki "Yard�m" d��mesini t�klay�n�z. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyatta kullan�lan anestezi tipi nas�l girilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Anestezi tipini "<span style="background-color:yellow" > Anestezi <select name="a">
                                                                     	<option > ITA</option>
                                                                     	<option > Plexus</option>
                                                                     	<option > ITA-Jet</option>
                                                                     	<option > ITA-Mask</option>
                                                                     	<option > LA</option>
                                                                     	<option > DS</option>
                                                                     	<option > AS</option>
                                                                     </select> </span>" alan�ndan se�iniz.<p>
	<ul type=disc>       	
 	<li><b>ITA: </b>Intra-tracheal anesthesia<br>
 	<li><b>LA: </b>Local anesthesia<br>
 	<li><b>AS: </b>Analgesic-sedation<br>
 	<li><b>DS: </b>Equivalent to AS<br>
 	<li><b>Plexus: </b>Nervus plexus local anesthesia<br>
	</ul>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Anestezist bilgisi nas�l girilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>"<span style="background-color:yellow" > Anestezist </span>" ba�lant�s�n� t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Anestezist bilgisini girmek i�in bir pencere a��l�r. <br>
 	<b>Ad�m 3: </b>Penceredeki bilgileri izleyiniz ya da daha fazla bilgi i�in pencere i�erisindeki "Yard�m" d��mesini t�klay�n�z. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyata giri�, kesi, s�t�r ve ��k�� zamanlar� ilgili alanlar�ndan do�rudan nas�l girilir?</b>
</font>
<ul>       	
 	<b>Giri� zaman�: </b>Zaman� "<span style="background-color:yellow" > Giri�:<input type="text" name="t" size=5 maxlength=5> </span>" alan�na yaz�n�z.<br>
 	<b>Kesi zaman�: </b>Zaman� "<span style="background-color:yellow" > Kesi: <input type="text" name="t" size=5 maxlength=5> </span>" alan�na yaz�n�z.<br>
 	<b>S�t�r zaman�: </b>Zaman� "<span style="background-color:yellow" > S�t�r: <input type="text" name="t" size=5 maxlength=5> </span>" alan�na yaz�n�z.<br>
 	<b>��k�� zaman�: </b>Zaman� "<span style="background-color:yellow" > ��k��: <input type="text" name="t" size=5 maxlength=5> </span>" alan�na yaz�n�z.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Birka� zaman bilgisi hepsi birden nas�l girilir?</b>
</font>
<ul> <b>Ad�m 1: </b><p>    	
 	<b>Giri�/��k�� zaman�: </b>
 	Sol alt k��edeki  "<span style="background-color:yellow" > Giri�/��k�� <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" ba�lant�s�n� t�klay�n�z.<p>
 	<b>Kesi/S�t�r zaman�:</b>
 	Sol alt k��edeki  "<span style="background-color:yellow" > Kesi/S�t�r <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" ba�lant�s�n� t�klay�n�z.<p>
 	<b>Bo� zaman: </b>
 	Sol alt k��edeki "<span style="background-color:yellow" > Bo� zaman <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" ba�lant�s�n� t�klay�n�z.<p>
 	<b>Al��/Atel zaman�:</b>
 	Sol alt k��edeki "<span style="background-color:yellow" > Al��/Atel <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" ba�lant�s�n� t�klay�n�z.<p>
 	<b>Repozisyon zaman�: </b>
 	Sol alt k��edeki "<span style="background-color:yellow" > Repozisyon <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" ba�lant�s�n� t�klay�n�z.<p>
 	<b>Ad�m 2: </b>Bilgi girmek i�in bir pencere a��l�r. <br>
 	<b>Ad�m 3: </b>Penceredeki bilgileri izleyiniz ya da daha fazla bilgi i�in pencere i�erisindeki "Yard�m" d��mesini t�klay�n�z. <br>
	</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Grafik zaman �izelgesine nas�l bilgi girilir?</b>
</font>
<ul> <b>Ad�m 1: </b>Fare i�aret�isini zaman cetvelinde ilgili zaman bilgisine (�rne�in Al��/Atel) kar��l�k gelen zaman bilgisine getiriniz.<br>
 	<b>Ad�m 2: </b>Se�ilen zamandaki zaman cetveline t�klay�n�z.<p>
<b>Uyar�:</b> �lk de�er ba�lang�� zaman�, ikinci de�er biti� zaman�, ���nc� de�er ikinci ba�lang�� zaman� vs. olur.
	</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Tedavi veya operasyon bilgisi nas�l girilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Tedavi veya operasyonu "<span style="background-color:yellow" > Tedavi/Operasyon: </span>" alan�na yaz�n�z.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Sonu�lar, g�zlem ve ek notlar nas�l girilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Bunlar� "<span style="background-color:yellow" > Sonu�lar: </span>" alan�na yaz�n�z.<br>
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
 	<b>Ad�m 1: </b> <img <?php echo createLDImgSrc('../','newpat2.gif','0') ?>> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Daha fazla bilgi i�in <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> d��mesini tekrar t�klay�n�z.<br>
	</ul>
	
<b>Uyar�</b>
<ul> Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
	<?php endif ?>

<?php endif ?>



<?php if($src=="search") : ?>
<?php if(($x2!="")&&($x2!="0")) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Raporunu <?php if($x1=="edit") print "d�zenlemek"; else print "g�rmek"; ?> istedi�im belirli bir hasta nas�l se�ilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Raporunu <?php if($x1=="edit") print "d�zenlemek"; else print "g�rmek"; ?> istedi�iniz hastan�n ilgili &nbsp;<button><img <?php echo createComIcon('../','update2.gif','0') ?>> <font size=1>Lab raporu</font></button> d��mesini t�klay�n�z.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Aramaya nas�l devam edilir?</b>
</font>
	<?php endif ?>
	<?php if(($x2=="")||($x2=="0")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hasta nas�l aran�r?</b>
</font>
	<?php endif ?>
	
	<ul>       	
 	<b>Ad�m 1: </b>Bir hastan�n soyad, veya  ad, veya  do�um tarihi bilgisinin ya tamam�n� veya birka� harfini  "<span style="background-color:yellow" > Aranacak anahtar s�zc��� giriniz. <input type="text" name="m" size=20 maxlength=20> </span>" alan�na yaz�n�z. <br>
 	<b>Ad�m 2: </b>Hastay� aramaya ba�lamak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> d��mesini t�klay�n�z.<p> 
<ul>       	
 	<b>Uyar�: </b>Arama bir sonu� verir ise, bir liste g�r�nt�lenir. <p>
	</ul>
	<?php if(($x2=="")||($x2=="0")) : ?>
 	<b>Ad�m 3: </b>Laboratuvar raporunu  <?php if($x1=="edit") print "d�zenlemek"; else print "g�rmek"; ?> istedi�iniz hastan�n &nbsp;<button><img <?php echo createComIcon('../','update2.gif','0') ?>> <font size=1>Lab raporu</font></button> d��mesini t�klay�n�z.<p> 
	<?php endif ?>
</ul>

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�: </b></font> 
<ul>       	
 �ptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<?php endif ?>

<?php if($src=="arch") : ?>
	<?php if($x2=="1") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�: Son k�t�k kay�d� (kay�tlar�) </b></font> 
<ul>  Ar�ive her girdi�inizde son kaydedilen ameliyatlar derhal g�r�nt�lenir.
</ul>
	<?php endif ?>
	<?php if(($x3=="")&&($x1!="0")) : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Bu g�n hi� ameliyat yap�lmad�. </b></font> 
<ul>       	
Se�enek kutusunu a�mak i�in "Se�enekler" i t�klay�n�z.<br>
Arama moduna ge�mek i�in "Ara" y� t�klay�n�z.</ul>
	
	<?php endif ?>
	



<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Bir ba�ka g�n�n ar�ivli k�t�k bilgilerini g�rmek istiyorum.</b></font>
<ul> <b>�nceki g�n� g�stermek i�in: </b>Sol �st s�tundaki  "<span style="background-color:yellow" > �nceki g�n </span>" ba�lant�s�n� t�klay�n�z. 
				�stenilen g�n g�r�nt�leninceye kadar ne kadar gerekir ise o kadar t�klay�n�z.<p>
 <b>Sonraki g�n� g�stermek i�in: </b>Sa� �sr s�tundaki "<span style="background-color:yellow" > Sonraki g�n </span>" ba�lant�s�n� t�klay�n�z. 
				�stenilen g�n g�r�nt�leninceye kadar bu ba�lant�ya t�klamaya devam ediniz.<br>		
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Bir ba�ka ameliyathane veya b�l�m�n k�t�k bilgilerini g�rmek istiyorum.</b></font>
<ul> <b>Ad�m 1: </b>Se�enek kutusundan b�l�m� se�iniz <nobr>"<span style="background-color:yellow" > B�l�m veya ameliyathaneye ge�iniz <select name="o">
                                                                                                                                         	<option > �rnek b�l�m 1</option>
                                                                                                                                         	<option > �rnek b�l�m 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> <br>�n se�imli ameliyathane otomatik olarak
		d�zenlenir.<br>																																		  
	<b>Ad�m 2: </b>Veya ameliyathaneyi se�im kutusundan se�iniz <nobr>"<span style="background-color:yellow" > <select name="o">
                                                                                                                                         	<option > �rnek ameliyathane 1</option>
                                                                                                                                         	<option > �rnek ameliyathane 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> <br> �lgili b�l�m ameliyathaneleri
		otomatik olarak d�zenlenir.<br>																																		  																																		  
		<b>Ad�m 3: </b>Yeni b�l�m veya ameliyathaneye ge�mek i�in  <input type="button" value="De�i�tir">  d��mesini t�klay�n�z.<br>
</ul>
<?php if(($x3!="")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
G�r�nt�lenen bir k�t�k belgesi nas�l d�zenlenir veya g�ncellenir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>D�zenleme moduna ge�mek i�in en sol s�tundaki ameliyat tarihinin alt�ndaki  <img src="../img/update3.gif" border=0> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>D�zenleme modunda iken belgeyi d�zenlemede daha fazla yard�ma gereksiniminiz olur ise "Yard�m" d��mesini t�klay�n�z.<p> 
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hastan�n veri klas�r� nas�l a��l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Hasta numaras�n�n solundaki  <img src="../img/info2.gif" border=0> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Hastan�n veri klas�r� a��l�r. Daha fazla bilgiye gereksiniminiz olur ise a��lan penceredeki "Yard�m" d��mesini t�klay�n�z.<p> 
	</ul>
	<?php endif ?>
	
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 �ptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
</ul>


	<?php endif ?>

<?php if($src=="input") : ?>
	<?php if($x1=="main") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Sonu� de�erleri nas�l girilir?</b>
</font>
<ul>       	
		<?php if($x2=="") 
			print '
 			<b>Ad�m 1: </b>K�me numaras�n� "<span style="background-color:yellow" > K�me no: </span>" alan�na giriniz.<br>	
 			<b>Ad�m 2: </b>Gerekir ise muayene tarihini "<span style="background-color:yellow" > Muayene tarihi </span>" alan�na giriniz.<br>	';
	
		?>

	
 	<b>Ad�m	<?php if($x2=="") 
			print "3"; else print "1";
		?>:</b> De�erleri ilgili parametre alanlar�na giriniz.<br>	
 	<b>Ad�m <?php if($x2=="") 
			print "4"; else print "2";
		?>: </b> De�erleri kay�t etmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<p> 
 	<b>Uyar�: </b>De�erleri kaydettikten sonra kapatmak ister iseniz,<br>  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br> 
</ul>
	<?php endif ?>
<?php if($x1=="few") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yaln�zca birka� de�er girmem gerekiyor! Nas�l yap�l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>De�erleri illgili parametre alanlar�na giriniz.<br> 
 	<b>Ad�m 2: </b>Parametre de�erlerini kay�t etmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<p> 
 	<b>Uyar�: </b>Parametre de�erlerini girmeyi bitirdi iseniz ve kapatmak istiyor iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br> 
</ul>
	<?php endif ?>
	<?php if($x1=="param") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�stedi�im parametre g�r�nt�lenmiyor! Do�ru parametre grubuna nas�l ge�erim?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Do�ru parametre grubunu <nobr>"<span style="background-color:yellow" > Parametre grubunu se�iniz <select name="s">
     <option value="Sample parameter"> �rnek parametre</option> </select> </span>"</nobr> se�im kutusundan se�iniz.<p> 
 	<b>Ad�m 2: </b>Se�ilen parametre grubuna ge�mek i�in <img <?php echo createLDImgSrc('../','auswahl2.gif','0') ?>> d��mesini t�klay�n�z.<p> 
</ul>
	<?php endif ?>
	<?php if($x1=="save") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
De�erleri nas�l kay�t etmeliyim?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Parametre de�erlerini kay�t etmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<p> 
 	<b>Uyar�: </b>De�erleri kaydettikten sonra kapatmak i�in,<br>  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br> 
</ul>
	<?php endif ?>
	<?php if($x1=="correct") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yanl�� bir de�er kay�t ettim. Nas�l d�zeltirim?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Do�ru de�eri ilgili parametre alan�na giriniz.<br> 
 	<b>Ad�m 2: </b>Do�ru de�eri kay�t etmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<p> 
 	<b>Uyar�: </b>De�erleri kaydettikten sonra kapatmak i�in,<br>  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
</ul>
	<?php endif ?>
	<?php if($x1=="note") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir de�er yerine bir not girmek istiyorum. Nas�l yap�l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>�lgili parametre alan�na yaln�zca notu yaz�n�z.<br> 
 	<b>Ad�m 2: </b>Notu kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<p> 
 	<b>Uyar�: </b>Kaydettikten sonra kapatmak i�in,<br>  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
</ul>
	<?php endif ?>
	<?php if($x1=="done") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�� bitti. �imdi ne var?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>T�m de�erleri kay�t etmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<p> 
 	<b>Uyar�: </b> <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br> 
</ul>
	<?php endif ?>
	

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 �ptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<?php endif ?>
</form>

