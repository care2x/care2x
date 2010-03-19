<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Laboratuvar tetkik istemi</b></font>
<p>
<font size=2 face="verdana,arial" >

<?php
if(!$src){
?>
<a name="sday"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Hastanın etiketi eklenmemiş. Ne yapmalıyım?</b></font>
<ul> 
	<b>Adım 1: </b>Bir hastanın ad, soyad, veya protokol numarası bilgisinin tamamını ya da birkaç harf giriniz.
		<p>Örnek 1: "21000012" veya "12" giriniz.
		<br>Örnek 2: "Potur" veya "pot" giriniz.
		<br>Örnek 3: "Bülent" veya "Bül" giriniz.<p>
	<b>Adım 2: </b>Aramayı başlatmak için<img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düğmesini tıklayınız. <p>
	<b>Adım 3: </b> Eğer arama bir sonuç bulur ise, listeden doğru kişiyi seçmek için 
	 <img <?php echo createLDImgSrc('../','ok_small.gif','0') ?>> düğmesini tıklayınız.
</ul>
<?php
}else{
?>

<a name="sel"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Tetkik parametresi nasıl seçilir?</b></font>
<ul> 
	<b>Adım: </b>Parametrenin yanındaki küçük pembe kutuyu tıklatıp "karartınız".<p>
	<img src="../help/tr/img/tr_request_chemlab.png" border=0 width=352 height=125>
</ul>

<a name="usel"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Bir parametre seçimden nasıl çıkarılır?</b></font>
<ul> 
	<b>Adım: </b>Parametrenin yanındaki "karartılmış" kutuya tekrar tıklayıp "rengini açabilir" siniz. <br>
</ul>

<a name="sday"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Örnek alma günü nasıl seçilir?</b></font>
<ul> 
	<b>Adım: </b>Günün altındaki küçük pembe kutuyu tıklayıp "karartınız".<p>
<img src="../help/tr/img/tr_request_chemlab_sday.png" border=0 width=325 height=120>
</ul>

<a name="stime"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Örnek alma saati nasıl seçilir?</b></font>
<ul> 
	<b>Adım: </b>Saat ve dakikanın altındaki küçük pembe kutuyu tıklayıp "karartınız".<p>
<img src="../help/tr/img/tr_request_chemlab_stime.png" border=0 width=325 height=120>
</ul>
<a name="send"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Tetkik istemi nasıl gönderilir?</b></font>
<ul> 
	<b>Adım: </b><img <?php echo createLDImgSrc('../','abschic.gif','0') ?>> düğmesini tıklayınız.
</ul>

<?php
}
?>
