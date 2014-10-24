<?php 
require_once('../include/core/inc_date_format_functions.php');
 ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title></title>
</head>
<body>
<font face="Verdana, Arial" size=3 color="#000099"><b>Bir kişiyi aramada ip uçları</b></font>
<p>
<img <?php echo createComIcon('../','warn.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Anımsamak önemli!</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
Girdiğiniz her hangi bir sözcük bir bilginin olası başlangıcı olarak kabul edilir. <p>
Böylece, örneğin "Can" girdi iseniz Care2x  "can" ile başlayan tüm soyadları (veya adları) arar. Arama somucu olasılıkla "Can", "Canan", "Caner" vs gibi isimleri de içerir.
<p>
</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Bir kişiyi en hızlı bulmanın yolu nedir?</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Tam TC kimlik numarası ile arayınız.
</blockquote>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Soyad ile nasıl aranır?</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Soyadı veya baştan birkaç harfini giriniz.
<li> "Ara" düğmesini tıklayınız.<br>
<img src="../help/tr/img/tr_search_fname.png">
<p>
</blockquote>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Arar iken ad neden dahil edilmeli?</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Eğer "Adları da ara" düğmesi görünüyor ise etkinleşmesi için tıklanması gerekir. O zaman Care2x hem ad hem de soyadları aramaya zorlanır. Yoksa (düğme işaretlenmemiş ise) sadece soyadlar aranır.
<br>
<img src="../help/tr/img/tr_search_radio.png">
</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Aramamı niçin soyadlara sınırlı tutmalıyım?</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Arama hızlı olur.

</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Sadece ad ile HIZLI arama!</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Adı yazınız, bir boşluk bırakınız, sonra <b>*</b> yazınız.
<br>
<img src="../help/tr/img/tr_search_quickfirst.png">

</blockquote>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Ad ve soyad ile arama.</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Adı ve soyadı aralarında boşluk bırakarak yazınız
<br>
<img src="../help/tr/img/tr_search_firstlast.png">
<p>
<img <?php echo createComIcon('../','warn.gif','0') ?>> Uyarı: İlk uyarı burada da geçerlidir. Birinci ve ikinci adlar ad ve soyadın başlangıcı olarak kabul edilir. Böylece yukarıdaki örneğe göre "Can Potuk", "Caner Potur", "Cansu Poturlu", vs. gibi isimler de bulunur.
</blockquote>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Soyad ve ada göre arama.</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Önce soyad, sonra ad yazarak aramak ister iseniz:
<li>Önce soyadı yazınız, hemen bitişiğine bir virgül yazınız, sonra bir boşluk bırakınız ve en sonuna ad yazınız.
<br>
<img src="../help/tr/img/tr_search_lastfirst.png">
</blockquote>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
1 Kasım 1967 (01.11.1967) de doğan kişileri aramak .</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Güncel tarih biçiminize göre doğum tarihini giriniz.
<br>
<img src="../help/tr/img/tr_search_fullbday.png">
</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Güncel tarih biçimim nedir?</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Güncel tarih biçiminiz: <font color="red"><?php echo $date_format.'</font>. Bugün = ('.@formatDate2Local(date('Y-m-d'),$date_format).')'; ?>

</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
1947 de doğmuş tüm Ahmet Polat ları aramak.</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Adı, soyadı, doğum yılını yazınız
<br>
<img src="../help/tr/img/tr_search_firstlastyear.png">
</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
1989 da doğmuş tüm kişileri arama.</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li> *, boşluk,  *, boşluk, doğum yılı yazınız
<br>
<img src="../help/tr/img/tr_search_allyear.png">
</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Tüm 20 yüzyılda doğmuş (1900-1999) Ahmet Potur ları arama.</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>"ahmet", boşluk, "potur", boşluk, "19" yazınız.
<br>
<img src="../help/tr/img/tr_search_firstlastcent.png">
</blockquote>


</body>
</html>
