<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?php
switch($x2)
{
	case "search": print "How to "; 
 						if($x1) print 'display the ward\'s occupancy where the search keyword was found';
						else  print 'search for a patient';
						break;
	case "quick": print  "Nursing - Quickview of today's ward occupancy";
						break;
	case "arch": print "Nursing wards - Archive";
}
 ?></b></font>
<p><font size=2 face="verdana,arial" ></font>
<form action="#" >
<?php if($x2=="search") : ?>
<?php if(!$x1) : ?>
<b>Langkah 1</b>

  <ul>
    Masukkan di kolom "<span style="background-color:yellow" >Silakan masukkan 
    kata kunci pencarian.</span>" informasi lengkap atau beberapa huruf pertama, 
    Contoh nama belakang, Nama depan, atau keduanya. 
    <ul type=disc>
      <li>Contoh 1: masukkan "Guerero" atau "gue". 
      <li>Contoh 2: masukkan "Alfredo" atau "Alf". 
      <li>Contoh 3: masukkan "Guerero, Alf". 
    </ul>
  </ul>
<b>Langkah 2</b>
<ul> klik tombol 
    <input type="button" value="Cari">
    untuk memulai pencarian. 
    <p>
</ul>
<b>Langkah 3</b>
  <ul>
    Jika pencarian menemukan satu hasil, daftar penginap dibangsal dimana kata 
    kunci ditemukan akan ditampilkan 
    <p> 
  </ul>
<b>Langkah 4</b>
  <ul>
    Jika pencarian menemukan beberapa hasil, sebuah daftar hasil akan ditampilkan.
    <p> 
  </ul>
<b>Catatan</b>
  <ul>
    Jika anda memutuskan untuk membatalkan pencarian klik tombol <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>. 
  </ul>
  <?php endif;?>
<b>Langkah <?php if($x1) print "1"; else print "5"; ?></b>
  <ul>
    klik tombol <img <?php echo createComIcon('../','bul_arrowblusm.gif','0') ?>>, 
    atau tanggal, atau bangsal untuk menampilkan daftar penginap di bangsal. 
    <p><b>Catatan:</b> Kata kunci pencarian akan di highlight. <br>
      <b>Catatan:</b> daftar tidak bisa diedit "mode baca saja". Jika anda mencoba 
      untuk membuka folder data pasien dengan mengklik namanya, anda akan dihadapkan 
      pada prompt untuk memasukkan username dan password anda. 
      <?php endif;?>
      <?php if($x2=="quick") : ?>
      <?php if($x1) : ?>
      <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
      Bagaimana cara menampilkan daftar penginap (di)bangsal?</b> </font> 
  </ul>
  <ul>
    <b>Langkah 1: </b>Klik di id bangsal atau namanya dikolom kiri.<br>
    <b>Catatan: </b>Daftar penginap yang akan ditampilkan dalam mode &quot;Baca 
    saja&quot;. Anda tidak bisa mengedit atau merubah dat pasien manapun.<br>
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bagaimana 
  cara menampilkan daftar penginap bangsal untuk melakukan pengeditan atau pemutakhiran?</b> 
  </font> 
  <ul>
    <b>Langkah 1: </b>klik ikon <img <?php echo createComIcon('../','statbel2.gif','0') ?>> 
    yang berhubungan dengan bangsal yang dipilih.<br>
    <b>Langkah 2: </b>Jika anda telah login sebelumnya dan memiliki hak akses 
    untuk fungsi ini, daftar penginap akan ditampilkan secepatnya. Jika tidak, 
    anda akan diminta untuk memasukkan username dan password anda.<br>
    <b>Langkah 3: </b>Jika diminta, masukkan username dan password anda..<br>
    <b>Langkah 4: </b>klik tombol 
    <input type="button" value="Lanjut.....">
    .<br>
    <b>Langkah 5: </b>Jika anda memiliki hak akses untuk fungsi ini, daftar penginap 
    akan ditampilkan.<br>
    <b>Catatan: </b>Daftar penginap akan ditampilkan dan bisa &quot;diedit&quot;. 
    Pilihan untuk mengedit atau memutakhirkan data pasien akan ditampilkan. Anda 
    jugabisa membuka folder data pasien untuk melakukan pengeditan lebih lanjut.<br>
  </ul>
  <?php else : ?>
  <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> 
  Belum anda daftar penginap saat ini !</b> </font> 
  <p> <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
    Bagaimana cara menampilkan tinjauan cepat penginap sebelumnua menggunakan 
    arsip?</b> </font> 
    <ul>
    <b>Langkah 1: </b>klik "<span style="background-color:yellow" > Klik ini untuk 
    pergi ke arsip<img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> 
    </span>".<br>
    <b>Langkah 2: </b>Kalender pemandu akan muncul.<br>
    <b>Langkah 3: </b>klik tanggal di kalender untuk melakukan tinjauan cepat 
    untuk hari tersebut.<br>
  </ul>
	
	<?php endif;?>
<b>Catatan</b>
  <ul>
    Jika anda memutuskan untuk menutup Tinjauan cepat, klik tombol <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>. 
  </ul>
  <?php endif;?>
  <?php if($x2=="arch") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bagaimana 
  cara menampilkan Tinjauan cepat penginap sebelumnya menggunakan arsip?</b> </font> 
  <ul>
    <b>Langkah 1: </b>Klik di sebuah tanggal untuk menampilkan tinjauan cepat 
    penginap hari tersebut.<br>
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Bagaimana cara mengganti bulan kalender pemandu?</b> </font> 
  <ul>
    <p><b>Langkah 1: </b>Untuk menampilkan bulan selanjutnya, klik di nama bulan 
      di kanan atas kalender pemandu. Klik sebanyak yang anda butuhkan sampai 
      anda menemukan bulan yang anda inginkan.</p>
    <p><b>Langkah 2: </b>Untuk menampilkan bulan sebelumnya, kkil di nama bulan 
      di kiri atas kalender pemandu. Klik sebanyak yang anda butuhkan sampai anda 
      menemukan bulan yang anda inginkan..<br>
    </p>
  </ul>
	
	<?php endif;?>


</form>

