<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc"> <b>Bagaimana cara mencari 
dokumen medocs</b></font>
<p><font size=2 face="verana,arial" ></font>
<form action="#" >
<?php if(($src=="?")||($x1=="0")) : ?>
<b>Langkah 1</b>

  <ul>
    Masukkan di kolom "<span style="background-color:yellow" >Dokumen Medocs dari:</span>"informasi 
    lengkap atau beberapa kata dari informasi pasien, contoh : nomor pasien, atau 
    nama, atau nama pemberian. 
    <p>Contoh 1: masukkan"21000012" atau"12". <br>
      Contoh 2: masukkan"Guerero" atau "gue". <br>
      Contoh 3: masukkan"Alfredo" atau"Alf". 
  </ul>
<b>Langkah 2</b>
<ul>
    Klik tombol <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    untuk memulai pencarian. 
    <p>
</ul>
<b>Langkah 3</b>
  <ul>
    Jika pencarian menemukan hasil tunggal, dokumen medocs lengkap akan ditampilkan. 
    Jika bagaimanapun juga, pencarian menemukan beberapa hasil, sebuah daftar 
    akan ditampilkan. 
    <p> Untuk melihat medocs pasien yang anda cari, Klik tombol <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> 
      yang berhubungan dengannya, atau nama keluarga, atau nomor dokumen, atau 
      waktu. 
  </ul>
  <?php endif;?>
  <?php if($x1>1) : ?>
  Untuk melihat medocs pasien yang anda cari, Klik tombol <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> 
  yang berhubungan dengannya, atau dengan nama keluarga, atau nomor dokumen, atau 
  qaktu.. 
  <p> 
    <?php endif;?>
    <?php if(($src!="?")&&($x1=="1")) : ?>
    <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Saya 
    ingin memutakhirkan(Update) dokumen</b></font>
  <ul>
    Jika anda ingin memutakhirkan data yang ditampilkan, Klik tombol 
    <input type="button" value="Mutakhirkan data">
    . 
  </ul>
<?php endif;?>
<b>Catatan</b>
  <ul>
    Jika anda memutuskan untuk membatalkan. Klik tombol <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>. 
  </ul>


</form>

