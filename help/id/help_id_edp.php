<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc"> <b> PDE - 
<?php
	switch($src)
	{
	case "access": switch($x1)
						{
							case "": print "Creating access right";
												break;
							case "save": print "New access right saved";
												break;
							case "list": print "Existing access rights";
												break;
							case "update": print "Editing an existing access right";
												break;
							case "lock":  if($x2=="0") print "Locking"; else print "Unlocking"; print  " an existing right";
												break;
							case "delete": print "Deleting an access right";
												break;
						}
						break;
	}


 ?>
</b></font> 
<p><font size=2 face="verana,arial" ></font>
<form action="#" >
  <?php if($src=="access") : ?>
  <?php if($x1=="") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bagaimana 
  cara membuat sebuah hak akses baru ?</b> </font> 
  <ul>
    <b>Langkah 1: </b>Masukan nama lengkap seseorang, atau departemen, atau klinik, 
    dll di kolom "<span style="background-color:yellow" > Nama</span>".<br>
    <b>Langkah 2: </b>Masukkan Nama Pengguna(UserName) di kolom "<span style="background-color:yellow" > 
    Nama login Pengguna</span>". 
    <p> <b>Catatan:</b> Spasi tidak diijinkan untuk Nama Pengguna(User Name).
    <p> <b>Langkah 3: </b>Masukkan Password untuk pengguna di kolom "<span style="background-color:yellow" > 
      Password </span>".<br>
      <b>Langkah 4: </b>Pilih Area dimana Pengguna diijinkan masuk di kolom "<span style="background-color:yellow" > 
      Area # </span>".
    <p> <b>Catatan:</b> Seorang Pengguna dapat mendapatkan maksimal 10 area yang 
      dapat diakses (Area 1 sampai Area 10).
    <p> 
  </ul>

	
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Saya selesai memasukkan informasi yang dibutuhkan, bagaimana cara menyimpannya?</b> 
  </font> 
  <ul>       	
 	<b>Langkah 1: </b>Klik tombol <input type="button" value="Simpan">.<br>
</ul>
	
  <?php endif;?>
  <?php if($x1=="save") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Hak Akses baru sekarang telah tersimpan, bagaimana cara membuat yang lain?</b> 
  </font> 
  <ul>
    <b>Langkah 1: </b>Klik tombol 
    <input type="button" value="OK" name="button">
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
    <input type="button" value="Daftar Hak Akses Aktual">
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
    dapat diakses.<br>
  </ul>
	
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
 	Klik Opsi "<span style="background-color:yellow" > L </span>" Berkait dengan pengguna.<br>
</ul>
	
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Bagaimana cara membuka kunci data Hak Akses pengguna ? (Jika saat ini terkunci)</b> 
  </font> 
  <ul>       	
 	Klik Opsi "<span style="background-color:yellow" > U </span>" Berkait dengan pengguna.<br>
</ul>
		
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Bagaimana cara mengapus Hak Akses?</b> </font> 
  <ul>       	
 	Klik Opsi "<span style="background-color:yellow" > D </span>" Berkait dengan pengguna.<br>
</ul>

	
  <?php endif;?>
  <?php if($x1=="update") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Bagaimana cara mengedit Hak Akses?</b> </font> 
  <ul>
    <b>Langkah 1: </b>Edit Informasi.<br>
    <b>Langkah 2: </b>Klik tombol 
    <input type="button" value="simpan">
    .<br>
  </ul>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Catatan:</b>
</font>
  <ul>
    Jika anda memutuskan untuk tidak melakukan pengeditan Klik tombol 
    <input type="button" value="Batalkan">
    .<br>
  </ul>
	
	
  <?php endif;?>
  <?php if($x1=="delete") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Bagaimana Cara menghapus Hak Akses?</b> </font> 
  <ul>
    <b>Langkah 1: </b>Jika anda yakin mau menghapus Hak Akses,<br>
    Klik tombol 
    <input type="button" value="Ya, Saya sangat yakin.  Hapus hak akses">
    .<br>
  </ul>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Catatan:</b>
</font>
  <ul>
    Jika anda memutuskan untuk tidak menghapus Klik tombol 
    <input type="button" value="Tidak. Kembali">
    .<br>
  </ul>
  <?php endif;?>
  <?php if($x1=="lock") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>><b><font color="#990000">Bagaimana 
  cara </font></b><font color="#990000"><b> 
  <?php if($x2=="0") print "lock"; else print "unlock"; ?>
  Sebuah hak akses ?</b> </font> 
  <ul>
    <b>Langkah 1: </b>Jika anda yakin ingin 
    <?php if($x2=="0") print "lock"; else print "unlock"; ?>
    hak akses,<br>
    Klik tombol 
    <input type="button" value="Ya, Saya yakin">
    .<br>
  </ul>
  <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> 
  Catatan:</b> </font> 
  <ul>
    Jika anda memutuskan untuk 
    <?php if($x2=="0") print "lock"; else print "unlock"; ?>
    Klik tombol 
    <input type="button" value="Tidak. Kembali">
    .<br>
  </ul>
	
	<?php endif;?>		
<?php endif;?>	

	</form>

