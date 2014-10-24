<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Bir tıbbi belge nasıl aranır</b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if(($src=="?")||($x1=="0")) : ?>
<b>Step 1</b>

<ul> "<span style="background-color:yellow" >Tıbbi belgesi aranan kişi:</span>" alanına hastanın protokol numarası, ad, veya soyad bilgilerini ya tam olarak veya birkaç harf ile giriniz.
		<p>Örnek 1: "21000012" veya  "12" giriniz.
		<br>Örnek  2: "Potur" veya "pot" giriniz.
		<br>Örnek 3: enter "Gürcan" veya "Gür" giriniz.
		
</ul>
<b>Adım 2</b>
<ul> Aramayı başlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düğmesini tıklatınız.<p>
</ul>
<b>Adım 3</b>
<ul> Eğer aramada bir tek sonuç bulunur ise tıbbi belgenin tamamı görünür.
		Ancak birkaç sonuç bulunur ise, bir liste görüntülenir.<p>
		Aradığınız hastanın tıbbi belgesini görmek için ilgili  <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> düğmesini ya da soyad, belge numarası veya zamanı tıklayınız.
</ul>
<?php endif ?>
<?php if($x1>1) : ?>
		Aradığınız hastanın tıbbi belgesini görmek için ilgili  <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> düğmesini ya da soyad, belge numarası veya zamanı tıklayınız.<p>
<?php endif ?>
<?php if(($src!="?")&&($x1=="1")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belgeyi güncellemek istiyorum</b></font>
<ul> Görünen belgeyi güncellemek ister iseniz, <input type="button" value="Verileri güncelle"> düğmesini tıklayınız.
</ul>
<?php endif ?>
<b>Uyarı</b>
<ul> Eğer aramayı iptal etmek isterseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul>


</form>

