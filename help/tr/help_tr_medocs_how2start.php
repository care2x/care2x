<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

$foreword='
<form action="#">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Nasıl başlamalı ';

switch($x1)
{
 	case "entry": print $foreword.'yeni bir tıbbi belgeye'; break;
	case "search": print $foreword.'Bir tıbbi belge arama ';break;
	case "archiv": print $foreword.'tıbbi belgeler arşivinde araştırma';break;
 }
?>

<?php if(!$x1) : ?>
		<?php require("help_tr_main.php"); ?>
<?php else : ?>
</b></font>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<p>
<font face="Verdana, Arial" size=2>

<?php if($src!=$x1) : ?>
<b>Adım 1</b>
<ul> <img src="../img/tr/tr<?php switch($x1)
																			{
																				case "entry": print '_newdata-gray.gif'; break;
																				case "search": print '_such-gray.gif'; break;
																				case "archiv": print '_arch-gray.gif'; break;
																			}
?>" border="0"> düğmesini tıklayınız.
		
</ul>
<b>Adım 2</b>
<?php endif ?>
<ul> Eğer daha önce giriş yaptı iseniz ve bu fonksiyona erişim hakkınız var ise 
<?php switch($x1)
	{
		case "entry": print 'ilk belge formu'; break;
		case "search": print 'arama alanı '; break;
		case "archiv": print 'arşiv arama alanı'; break;
	}
?>  ana çerçevede görüntülenir.<br>
		Giriş yapmadı iseniz, kullanıcı adı ve şifreniz sorulur.. <p>
		Kullanıcı adı ve şifrenizi girip  <img <?php echo createLDImgSrc('../','continue.gif','0') ?>> düğmesini tıklayınız.<p>
		İptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
		
</ul>


</form>
<?php endif ?>
