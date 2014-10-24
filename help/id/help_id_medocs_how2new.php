<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc"> <b>Bagaimana cara mendokumentasikan 
pasien di medocs</b></font>
<p><font size=2 face="verana,arial" ></font>
<form action="#" >
<?php if($src=="?") : ?>
<b>Langkah 1</b>

  <ul>
    Cari data dasar pasien.<br>
    Masuk ke kolom "Dokumen pasien berikut:"dari informasi berikut:<br>
    <Ul type="disc">
      <li>Nomor Pasien atau<br>
      
      <li>Nama Keluarga Pasien atau<br>
      
      <li>Nama Depan pasien<br>
        <font size=1 color="#000099" face="verdana,arial"> <b>Tip:</b> Jika sistem anda dilengkapi
		dengan scanner barcode, klik di kolom"Dokumentasikan pasien berikut:" untuk memfokuskannya 
		dan scan barcode kartu pasien dengan scanner tersebut. Lewati Langkah 2. </font> 
    </ul>
  </ul>
<b>Langkah 2</b>

  <ul>
    Klik tombol 
    <input type="button" value="Cari">
    Untuk memulai pencarian. 
  </ul>
  <b>Alternativ untuk Langkah 2</b> 
  <ul>
    Anda bisa melakukan hal berikut:<br>
    <Ul type="disc">
      <li>Masukan nama keluarga pasien di kolom &quot;Nama Belakang&quot;.<br>
      <li>OR Masukkan nama pemberian pasien di kolom &quot;Nama Depan&quot;.<br>
    </ul>
    Lalu klik tombol &quot;enter&quot; di keyboard. 
  </ul>
<b>Langkah 3</b>
  <ul>
    Jika Pencarian menemukan hasil tunggal, sebuah form dokumen baru dengan data 
    dasar pasien akan ditampilkan. Jika bagaimanapun juga, pencarian menemukan 
    beberapa hasil, sebuah daftar akan ditampilkan.. 
    <?php endif;?>
    <?php if(($src=="?")||($x1>1)) : ?>
    <br>
    Untuk medokumentasikan pasien yang ada di dalam daftar, Klik tombol <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> 
    yang berhubungan dengannya, atau nama keluarga, atau nama pemberian(nama belakang), 
    atau nomor pasien, atau tanggal masuk(izin). 
  </ul>
<?php endif;?>

<?php if($src=="?") : ?>
<b>Langkah 4</b>
<?php endif;?>

<?php if(($src!="?")&&($x1==1)) : ?>
<b>Langkah 1</b>
<?php endif;?>
<?php if(($x1=="1")||($src=="?")) : ?>
  <ul>
    Sekali sebuah form dokumen dengan data pasien ditampilkan, anda bisa melakukan 
    hal berikut : 
    <Ul type="disc">
      <li>Memasukkan informasi tambahan mengenai pengasuransi atau asuransi di 
        kolom &quot;Informasi ekstra&quot;,<br>
      
      <li>Klik tombol "<span style="background-color:yellow" > 
        <input type="radio" name="n" value="a">
        Ya</span>" di"Saran medis" Jika pasien telah menerima Saran medis wajib,<br>
      
      <li>Klik tombol "<span style="background-color:yellow" > 
        <input type="radio" name="n" value="a">
        Tidak</span>" di"Saran Medis" Jika pasien belum menerima saran medis wajib,<br>
      
      <li>Masukkan laporan diagnosis di kolom "Diagnosis:",<br>
      
      <li>Masukkan laporan terapi di kolom "Terapi:",<br>
      
      <li>Jika perlu, rubah tanggal di kolom "Di dokumentasikan pada:",<br>
      
      <li>Jika perlu, rubah nama pada kolom "Di dokumentasikan oleh",<br>
      
      <li>Jika perlu, Masukkan nomor kunci di kolom "Nomor Kunci:",<br>
      
    </ul>
  </ul>
<b>Catatan</b>
<ul>
    Jika anda memutuskan untuk menghapus masukan anda, Klik tombol 
    <input type="button" value="Reset">.
</ul>

<b>Langkah <?php if($src!="?") print "2"; else print "5"; ?></b>
  <ul>
    Klik tombol 
    <input type="button" value="Save">
    untuk menyimpan dokumen. 
  </ul>
<?php endif;?>
<b>Catatan</b>
  <ul>
    Jika anda memutuskan untuk membatalkan dokumentasi. Klik tombol <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>. 
  </ul>


</form>

