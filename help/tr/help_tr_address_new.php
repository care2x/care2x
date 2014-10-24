<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Adres yöneticisi - Yeni adres bilgisi</b></font>
<p>
<font size=2 face="verdana,arial" >


<a name="sel"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Forma ne doldurulacak?</b></font>
<ul>
	<b>Adým 1:</b> En azýndan zorunlu olan þehir ya da ilçe adýný giriniz.<p>
	<b>Adým 2:</b> Eðer var ise, uygun alanlara ek bilgileri giriniz.<p>
	<b>Adým 3:</b> Bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz.
</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Devamlý olarak  "Save attempt to DB failed!" hata mesajýný alýyorum ve bilgiler veritabanýna kaydedilmiyor. Yanlýþ nerede?</b></font>
<ul>
Bu genellikle bir PostgreSQL veritabaný kullanýr iken olur. En büyük olasýlýk "ISO Country Code" ülke kodu girdisini boþ býrakmanýzdan kaynaklanýr.
	<p>
	<b>Adým 1:</b> Adresin ISO ülke kodunu doðru olarak giriniz<p>
	<b>Adým 2:</b> Eðer ISO ülke kodunu bilmiyor iseniz bir soru iþareti, bir boþluk ya da "-na-" (not available-yok anlamýnda-) girebilirsiniz.<p>
	<b>Adým 3:</b> "ISO Ülke Kodu" girdisini asla boþ býrakmayýnýz.<p>
</ul>
