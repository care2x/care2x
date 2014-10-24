<?php
$foreword='
<form action="#">

<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Bagaimana untuk memulai ';

switch($x1)
{
 	case "entry": print $foreword.'sebuah penerimaan pasien baru '; break;
	case "search": print $foreword.'pencarian data penerimaan untuk seorang pasient';break;
	case "archiv": print $foreword.'Pencarian kebali dalam arsif';break;
 }
?>

<?php if(!$x1) : ?>
		<?php require("help_en_main.php"); ?>
<?php else : ?>
</b></font>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<p>
<font face="Verdana, Arial" size=2>
<?php if($src!=$x1) : ?>
<b>Langkah 1</b> 
<ul>
  klik tombol ini <img <?php
switch($x1)
{
    case "entry": echo createLDImgSrc('../','ein-gray.gif','0'); break;
	case "search": echo createLDImgSrc('../','such-gray.gif','0'); break;
	case "archiv": echo createLDImgSrc('../','arch-gray.gif','0'); break;
}
?> border="0">. 
</ul>
<b>Langkah 2</b> 
<?php endif;?>
<ul> Jika anda telah login sebelumnya dan anda mempunyai hak akses untuk fungsi ini,
<?php switch($x1)
	{
		case "entry": print 'form penerimaan pasien'; break;
		case "search": print 'field pencarian'; break;
		case "archiv": print 'field pencarian arsif'; break;
	}
?>  akan muncul dalam frame utama .<br>
Sebaliknya, jika anda tidak login , anda perlu untuk memasukan username dan password.
Masukan username dan password dan click button <img <?php echo createLDImgSrc('../','continue.gif','0') ?>  border=0>.
Jika anda  memutuskan untuk membatalkan klik tombol  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0>.
</ul>


</form>
<?php endif;?>
