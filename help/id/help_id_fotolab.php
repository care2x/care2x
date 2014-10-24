<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc"> <b>LabFoto - 
<?php
	switch($src)
	{
	case "init": print "Initializing";
												break;
	case "input": print "Selecting photos for storage";
												break;
	case "maindata": print "Patient's data";
												break;
	case "save": print "Photos stored";
												break;

	}


 ?>
</b></font> 
<p><font size=2 face="verdana,arial" ></font>
<form action="#" >
  <?php if($src=="input") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Kolom Masukan ditampilkan. Apa yang harus dilakukan selanjutnya?</b> </font> 
  <ul>
    <b>Langkah 1: </b>Klik tombol 
    <input type="button" value="Browse...">
    to file foto yang ingin anda tempatkan.<br>
    <b>Langkah 2: </b>Sebuiah jendela "Pilih File"akan muncul. Pilih file yang 
    anda inginkan dan klik"Open".<br>
    <b>Langkah 3: </b>Jika file yang anda pilih adalah file grafis dalam format 
    yang valid, Preview foto akan muncul di frame kanan atas. Jika tidak, ulangi 
    langkah satu dan dua.<br>
    <b>Langkah 4: </b>Masukkan tanggal foto ini diambil di kolom "<span style="background-color:yellow" > 
    Shotdate </span>" . 
    <p> <img src="../img/warn.gif" border=0> <b>Perhatian! </b>tanggal ini bisa 
      ditimpa akhirnya ketika anda memilih fungsi data di data pasien di frame 
      kanan awah. Tip: Jika anda ingin tanggal ini berbeda dengan yang anda masukkan 
      di frame data pasien , tinggalkan dalam keadaan kosong pada waktu itu. anda 
      bisa memasukkan tanggal yang unik(yang anda inginkan) nanti..
    <p> <b>Langkah 5: </b>Masukkan jumlah foto di kolom"<span style="background-color:yellow" > 
      Jumlah</span>".
    <p> <img src="../img/warn.gif" border=0> <b>Perhatian! </b>If you want this 
      photo to be the "main photo" of the patient, enter 'main' instead of a number. 
      The "main photo" will always appear on the patient's data folder and on 
      other documents.
    <p> <font color="#990000">What to do next?</font>
    <p> <b>Langkah 6: </b>Find the patient's data. Enter the patient's number 
      in the "<span style="background-color:yellow" > Patient number </span>" 
      field.<br>
      <b>Langkah 7: </b>Klik tombol 
      <input type="button" value="Search">
      to find the patient.<br>
      <b>Langkah 8: </b>When the patient is found, his basic data will appear 
      in the corresponding fields.<br>
      <b>Langkah 9: </b>If all or most of the photos are taken on the same date, 
      enter the date in the <nobr>"<span style="background-color:yellow" > Shotdate 
      </span>"</nobr> field.<br>
      <b>Langkah 10: </b>Klik tombol <img src="../img/preset-add.gif" border=0 align="absmiddle"> 
      to set this date for all the photos. This date will automatically appear 
      in the "Shotdate" fields on the left frame.
    <p> <img src="../img/warn.gif" border=0><b> Perhatian! </b>Jika satu atau 
      beberapa foto harus memiliki tanggal yang berbeda, masukkan tanggal unik 
      di kolom "Shotdate" pada foto yang berkait. Anda baru bisa melakukan hal 
      ini jika anda telah menyelesaikan Langkah 10.
    <p> <b>Langkah 11: </b>Klik tombol 
      <input type="button" value="Simpan">
      untuk menyimpan foto di bankdata.<br>
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>><font color="#990000"><b>Bagaimana 
  cara mempreview foto?</b> </font> 
  <ul>
    <b>Langkah 1: </b>Klik pada tombol <img src="../img/lilcamera.gif" border=0> 
    pada foto berkait.<br>
  </ul>
		
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Saya 
  tidak bisa menemukan pasien lewat nomor pasiennya. dapatkah saya memasukkan 
  data secara manual dan menyimpan fotonya?</b> </font> 
  <ul>
    <b>Tidak. </b>dalam versi ini, anda tidak dapat melakukan penyimpanan foto 
    yang tidak memiliki nomor pasien atau kasus yang valid.<br>
  </ul>
  <?php endif;?>
  <?php if($src=="maindata") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bagaimana 
  cara mencari data pasien?</b> </font> 
  <ul>
    <b>Langkah 1: </b>Masukan No. Pasien milik pasien atau nomor kasus di kolom 
    "<span style="background-color:yellow" > Nomor Pasien</span>".<br>
    <b>Langkah 2: </b>Klik tombol 
    <input type="button" value="Cari">
    untuk mencari pasien.<br>
    <b>Langkah 3: </b>Jika pasien tidak ditemukan, data dasar akan muncul di kolom 
    bersangkutan.<br>
    <b>Langkah 4: </b>Jika semua atau sebagian besar foto diambil pada tanggal 
    yang sama, masukkan tanggal di<nobr> kolom "<span style="background-color:yellow" > 
    Shotdate </span>"</nobr>..<br>
    <b>Langkah 5: </b>Klik tombol <img src="../img/preset-add.gif" border=0 align="absmiddle"> 
    untuk mengeset tanggal ini bagi semua foto. tanggal ini akan muncul secara 
    otomatis di kolom "Shotdate" di frame kiri. 
    <p> <img src="../img/warn.gif" border=0><b> Perhatian! </b>Jika satu atau 
      beberapa foto harus memilki tanggal yang berbeda, masukkan ke kolom "Shotdate" 
      . Anda hanya bisa melakukan hal ini setelah menyelesaikan Langkah 5.
    <p> 
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>><font color="#990000"><b>Saya 
  tidak bisa menemukan pasien lewat nomor pasiennya. dapatkah saya memasukkan 
  data secara manual dan menyimpan fotonya?</b> </font> 
  <ul>
    <b>Tidak. </b>dalam versi ini, anda tidak dapat melakukan penyimpanan foto 
    yang tidak memiliki nomor pasien atau kasus yang valid.
  </ul>
<br>

  <?php endif;?>
  <?php if($src=="save") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>><font color="#990000"><b>Saya 
  ingin menempatkan foto tambahan dari pasien yang sama. Bagaimana cara melakukannya?</b> </font> 
  <ul>
    <b>Langkah 1: </b>Masukkan jumlah foto tambahan yang ingin anda tempatkan 
    di <nobr>"foto tambahan 
    <input type="text" name="g" size=3 maxlength=2>
    untuk <span style="background-color:yellow" > pasien yang sama</span></nobr><nobr><span style="background-color:yellow" >. 
    </span>"</nobr>.<br>
    <b>Langkah 2: </b>Klik tombol 
    <input type="button" value="Go">
    .<br>
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Saya ingin menempatkan foto dari pasien lain. bagaimana cara melakukannya?</b> 
  </font> 
  <ul>
    <b>Langkah 1: </b>Masukkan jumlah foto yang ingin anda tempatkan <nobr>di 
    kolom " 
    <input type="text" name="g" size=3 maxlength=2>
    Foto dari<span style="background-color:yellow" > Pasien lain</span></nobr><nobr><span style="background-color:yellow" >. 
    </span>"</nobr>.<br>
    <b>Step 2: </b>Klik tombol 
    <input type="button" value="Go">
    .<br>
  </ul>
  <?php endif;?>
  <?php if($src=="init") : ?>
  <?php if($x1=="") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Bagaimana cara menaruh Foto di bankdata?</b> </font> 
  <ul>
    <b>Langkah 1: </b>Pertama Inisialisasi. Masukkan jumlah foto yang ingin anda 
    masukkan di Bankdata.<br>
    <b>Langkah 2: </b>Klik tombol 
    <input type="button" value="OK Lanjut.......">
    .<br>
    <b>Langkah 3: </b>Kolom masukan untuk foto akan muncul. Klik tombol "Bantuan" 
    untuk instruksi Lebih Lanjut.<br>
  </ul>
  <?php endif;?>
  <?php if($x1=="save") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Hak Akses baru sekarang telah tersimpan, bagaimana cara membuat yang lain?</b> 
  </font> 
  <ul>
    <b>Langkah 1: </b>Klik tombol 
    <input type="button" value="OK" name="button2">
    .<br>
    <b>Langkah 2: </b>Form masukan akan mucul.<br>
    <b>Langkah 3: </b>Untuk melihat Instruksi lebih lanjut mengenai pembuatan 
    hak akses, Klik Tombol "bantuan".<br>
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Saya ingin melihat Hak Akses yang ada saat ini. Bagaimana cara melakukannya?</b> 
  </font> 
  <ul>
    <b>Langkah 1: </b>Klik tombol 
    <input type="button" value="Daftar Hak Akses Aktual" name="button2">
    .<br>
    <b>Langkah 2: </b>daftar Hak Akses yang telah ada akan ditampilkan<br>
  </ul>
  <?php endif;?>
  <?php if($x1=="list") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Apa 
  kegunaan tombol <img <?php echo createComIcon('../','padlock.gif','0','absmiddle') ?>> 
  dan <img <?php echo createComIcon('../','arrow-gr.gif','0','absmiddle') ?>> 
  ?</b> </font> 
  <ul>
    <img <?php echo createComIcon('../','padlock.gif','0','absmiddle') ?>> = Hak 
    akses pengguna di kunci atau &quot;dibekukan&quot;. dia tidak dapat memasuki 
    area yang di set sebagai dapat diakses.<br>
    <img <?php echo createComIcon('../','arrow-gr.gif','0','absmiddle') ?>> = 
    Hak Ases Pengguna tidak di kunci. Dia dapat memasuki area yang di set sebagai 
    dapat diakses.
  </ul>
	
  <br>

  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Apa arti opsi "C","L", dan "D", atau "U"?</b> </font> 
  <ul>
    <p><b>C: </b> = Rubah atau edit data Hak Akses Pengguna.<br>
      <b>L: </b> = Kunci Hak Akses pengguna.<br>
      <b>D: </b> = Hapus hak akses pengguna.<br>
      <b>U: </b> = Buka kunci Hak Akses pengguna(Jika Saat ini terkunci).<br>
    </p>
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bagaimana 
  cara merubah atau mengedit data Hak Akses Pengguna?</b> </font> 
  <ul>
    Klik Opsi "<span style="background-color:yellow" > C </span>" yang berkait 
    dengan pengguna.<br>
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Bagaimana cara mengunci data Hak Akses Pengguna?</b> </font> 
  <ul>
    Klik Opsi "<span style="background-color:yellow" > L </span>" Berkait dengan 
    pengguna.<br>
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Bagaimana cara membuka kunci data Hak Akses pengguna ? (Jika saat ini terkunci)</b> 
  </font> 
  <ul>
    Klik Opsi "<span style="background-color:yellow" > U </span>" Berkait dengan 
    pengguna.<br>
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Bagaimana cara mengapus Hak Akses?</b> </font> 
  <ul>
    Klik Opsi "<span style="background-color:yellow" > D </span>" Berkait dengan 
    pengguna.<br>
  </ul>
  <?php endif;?>
  <?php if($x1=="update") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Bagaimana cara mengedit Hak Akses?</b> </font> 
  <ul>
    <b>Langkah 1: </b>Edit Informasi.<br>
    <b>Langkah 2: </b>Klik tombol 
    <input type="button" value="simpan" name="button">
    .<br>
  </ul>
  <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> 
  Catatan:</b> </font> 
  <ul>
    Jika anda memutuskan untuk tidak melakukan pengeditan Klik tombol 
    <input type="button" value="Batalkan" name="button">
    .<br>
  </ul>
  <?php endif;?>
  <?php if($x1=="delete") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Bagaimana Cara menghapus Hak Akses?</b> </font> 
  <ul>
    <b>Langkah 1: </b>Jika anda yakin mau menghapus Hak Akses,<br>
    Klik tombol 
    <input type="button" value="Ya, Saya sangat yakin.  Hapus hak akses" name="button">
    .
  </ul>
	<br>
  <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> 
  Perhatian!</b> </font> 
  <ul>
    Jika anda memutuskan untuk tidak menghapus. Klik tombol 
    <input type="button" value="Tidak, Kembali">
    .<br>
  </ul>
  <?php endif;?>
  <?php if($x1=="lock") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Bagaimana cara 
  <?php if($x2=="0") print "lock"; else print "unlock"; ?>
  Sebuah Hak Akses?</b> </font> 
  <ul>
    <b>Langkah 1: </b>Jika anda yakin mau 
    <?php if($x2=="0") print "lock"; else print "unlock"; ?>
    Hak Akses,<br>
	 Klik tombol 
    <input type="button" value="Ya, Saya yakin">
    .<br>
</ul>
  <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> 
  Perhatian! </b></font> 
  <ul>
    Jika anda memutuskan untuk tidak 
    <?php if($x2=="0") print "lock"; else print "unlock"; ?>
    Klik tombol 
    <input type="button" value="Tidak, Kembali">
    .<br>
</ul>
	
	<?php endif;?>		
<?php endif;?>	

	</form>

