<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "Hasta Dosyası" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bu renkli çubukların anlamı nedir? </b> <img <?php echo createComIcon('../','colorcodebar3.gif','0') ?> ></font>
<ul> <b>Uyarı: </b>"Görünür" hale gelmiş bu renkli çubukların her biri belirli bir bilgi, uyarı, değişiklik, veya soru vs. nin varlığını bildirirler.<br>
			Bir rengin anlamı her servis için ayrı düzenlenebilir. <br>
			Sağdaki pembe renkli çubuklar dizisi bir belirli bir yönergenin uygulanacağı yaklaşık zamanı temsil eder.<br>
			Örneğin: altıncı pembe çubuğun anlamı "altıncı saat" veya "saat 6.00" 22. renkli çubuk "22.saat" veya "saat 22" anlamına gelir.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
İzleyen bu düğmeler nelerdir?</b></font>
<ul> <input type="button" value="Ateş çizelgesi">
	<ul>
		Bu hastanın günlük derece kâğıdı formunu açar. Forma ateş ve kan basıncı değerlerini girer, düzenler veya silebilirsiniz.<br>
		Düzenlenebilen ek veri alanları şunlardır:
	<ul type="disc">
	<li>Allerji<br>
	<li>Günlük diyet planı<br>
	<li>Ana tanı/tedavi<br>
	<li>günlük tanı/tedavi<br>
	<li>Notlar, ek tanılar<br>
	<li>Pt (Fizik tedavi), Atg (anti-tromboz jimnastiği), vs.<br>
	<li>Antikoagülanlar<br>
	<li>Anti koagülanlar için günlük kayıtlar<br>
	<li>Intravenöz tedavi, bandaj ve pansuman<br>
	<li>İntravenöz ilaçların gönlük kaydı<br>
	<li>Notlar<br>
	<li>İlaç listesi<br>
	<li>İlaç ve dozlarınıın günlük kaydı<br>
	</ul>		
	</ul>
<input type="button" value="Hemşire gözlemi">
	<ul>
		Bu hemşire gözlem formunu açar. Hemşirelik çalışmanızı, etkinliğini, gözlemlerinizi, soruları veya önerileri vs belgelendirebilirsiniz.
	</ul>
	<input type="button" value="Doktor orderları">
	<ul>
	Görevli doktor buraya yönergelerini, ilaç, doz, hemşire sorularına yanıtlar veya değişiklik yönergelerini, vs. girer.
	</ul>	
	<input type="button" value="Tetkik raporları">
	<ul>
	Burada farklı tetkik klinik veya bölümlerinden gelen tetkik raporları saklanır.
	</ul>	
<!-- 	<input type="button" value="Ana kayıt">
	<ul>
	Burada hastanın ana kaydı ve ad, soyad vs gibi kişisel bilgileri saklanır. Bu aynı zamanda hastanın anamnez veya öyküsünün ilk belgesidir. Her hemşirelik planının temelini oluşturur.
	</ul>	
	<input type="button" value="Hemşirelik  Planı">
	<ul>
	Bu özel hemşirelik planıdır. Planı oluşurabilir, düzenleyebilir ya da silebilirsiniz.
	</ul>	
 -->	
 <input type="button" value="TİG">
	<ul>
	Bu TİG (Tanı ile ilgili grup) birleşik penceresini açar.
	</ul>	
 <input type="button" value="Laboratuvar Sonuçları">
	<ul>
	Burada hem biyokimya hem de patoloji laboratuvar sonuçları saklanır.
	</ul>	
	<input type="button" value="Fotoğraflar">
	<ul>
	Bu hastanın fotoğraf kataloğunu açar.
	</ul>	
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bu seçim kutusunun işlevi nedir </b>	<select name="d"><option value="">Tetkik istemini seçiniz</option></select>?
</font>
<ul>       	<b>Uyarı: </b>Bu belirli bir tetkik için istem formu seçer.<br>
 	<b>Adım 1: </b> <select name="d"><option value="">Tetkik istemi seçiniz</option></select> üzerine tıklayınız.
                                                                     <br>
		<b>Adım 2: </b>Seçilen klinik, bölüm veya tetkiki tıklayınız.<br>
		<b>Adım 3: </b>İstem formu otomatik olarak açılır.<br>
</ul>
<?php endif ?>

<?php if($src=="labor") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>Şu anda tetkik sonucu yok. </b></font>
<ul> Hastanın veri klasörüne dönmek için  <input type="button" value="Tamam"> düğmesini tıklayınız.</ul>
<?php else  : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Hastanın dosyası nasıl kapatılır? </b></font>
<ul> <b>Uyarı: </b>Eğer kapatmak ister iseniz,  <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.</ul>

<?php endif ?>

</form>
