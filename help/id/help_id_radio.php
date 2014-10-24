<font face="Verdana, Arial" size=3 color="#0000cc"> <b> Radiologi Sinar X- 
<?php

if($src=="search")
{
	print "Search a patient";	
}

 ?>
</b> </font> 
<p><font size=2 face="verana,arial" >
<form action="#" >
  <?php if($src=="search") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Bagaimana cara mencari Pasien?</b> </font> 
  <ul>
    <b>Langkah 1: </b>Masukkan informasi lengkap beberapa digit pertama nomor 
    pasien, atau nama keluarga, atau nama depan di kolom yang berhubungan. <br>
    <b>Langkah 2: </b>Klik tombol <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    untuk memulai pencarian pasien. 
    <p> 
    <ul>
      <b>Catatan: </b>Jika pencarian mengantarkan sebuah hasil, Sebuah daftar 
      akan ditampilkan. 
      <p> 
    </ul>
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Bagaimana cara menampilkan film sinar X pasien Dan diagnosisnya?</b> </font> 
  <ul>
    <b>Langkah 1: </b>Klik link atau radio button "<span style="background-color:yellow" > 
    <font color="#0000cc">Preview/Diagnosis</font> 
    <input type="radio" name="d" value="a">
    </span>".<br>
    Thumbnail film sinar X akan muncul di frame kiri bagian bawah.<br>
    Diagnosis film Sinar X akan muncul di frame kanan bagian bawah.<br>
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Bagaimana cara menampilkan Film sinar X pasien Secara utuh?</b> </font> 
  <ul>
    <b>Langkah 1: </b>Klik tombol <img <?php echo createComIcon('../','torso.gif','0') ?>> 
    yang berhubungan dengan pasien untuk berpindah ke mode layar penuh.<br>
  </ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Catatan:</b></font> 
  <ul>
    Jika anda memutuskan untuk menutup, klik tombol <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>. 
  </ul>
<?php endif;?>


</form>

