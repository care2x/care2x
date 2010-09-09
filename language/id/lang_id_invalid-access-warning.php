<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require_once($root_path.'include/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
 <TITLE>Invalid Access Warning</TITLE>
</HEAD>

<BODY BACKGROUND="leinwand.gif">


<table width=100% border=1>
<tr>
    <td bgcolor="navy"> <FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Akses 
      Halaman Tidak sah</STRONG></FONT></td>
</tr>
<tr>
<td ><p><br>


<center>
        <FONT    SIZE=3 color=red  FACE="Arial"> <b>Anda tidak mempunyai hak untuk 
        mengakses dokumen ini!</b></font> 
        <p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
      <ul>
        <font size=3 face="verdana,arial"> Sebab yang memungkinkan terjadinya 
        masalah ini:</FONT> 
        <p> 
        <font size=2 face="verdana,arial"> <img <?php echo createComIcon('../../','achtung.gif') ?>> 
        Anda menggunakan fungsi standar "Back" atau"Forward" di Browser anda. 
        Hindari penggunaan Tombol ini.<br>
        <img <?php echo createComIcon('../../','achtung.gif') ?>> Bisa jadi 
        anda menolak Cookie. Program ini bergantung pada Cookie agar dapat berfungsi 
        dengan baik. Jadi tolong terima Cookie. <br>
        <img <?php echo createComIcon('../../','achtung.gif') ?>> Boleh jadi 
        Browser anda tidak menerima Cookie. Silakan Set Up Browser anda agar dapat 
        menerima Cookie Secara otomatis. <br>
        <img <?php echo createComIcon('../../','achtung.gif') ?>> Browser 
        anda tidak mampu manjalankan JavaScript atau JavaScript-nya dimatikan. 
        Silakan nyalakan JavaScript di Browser anda. <br>
        <img <?php echo createComIcon('../../','achtung.gif') ?>> Pada beberapa 
        Kasus yang jarang terjadi anda error pada bagian transfer data. Untuk 
        mengkoreksi situasi ini Klik sama tombol "reload" Browser anda. 
        <p> 
        </FONT> 
        <p> 
      </ul>
</td>
</tr>
</table>        
<p>
<?php
$root_path='../../';
require('id_copyrite.php'); 
?>
</FONT>


</BODY>
</HTML>
