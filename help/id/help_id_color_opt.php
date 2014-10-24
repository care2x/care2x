<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc"> <b> Pilihan Warna 
<?php
	switch($src)
	{
	case "ext": print " - Extended";
						break;
	 }
?>
</b></font> 
<p><font size=2 face="verana,arial" >
<form action="#" >
  <?php if($src=="") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bagaimana 
  cara memilih warna Latar Belakang ?</b> </font> 
  <ul>
    <b>Langkah 1: </b>Klik link "<span style="background-color:yellow" > Warnalatar belakang
    <img src="../img/settings_tree.gif" border=0></span>" di frame yang anda inginkan.<br>
    <b>Langkah 2: </b>Sebuah jendela yang menapilkan color palette akan muncul.<br>
    <b>Langkah 3: </b>Klik warna yang anda inginkan untuk warna latar belakang.<br>
    <b>Langkah 4: </b>Klik tombol <input type="button" value="Terapkan">untuk mengaplikasikan warna.<br>
    <b>Langkah 5: </b>Jika anda selesai, Klik tombol <input type="button" value="OK">.<br>
  </ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bagaimana cara memilih Warna Teks?</b>
</font>
  <ul>
    <b>Langkah 1: </b>Klik link "<span style="background-color:yellow" > Warna 
    Teks</span>" di frame atas atau link "<span style="background-color:yellow" > 
    Menu items </span>" di frame menu..<br>
    <b>Langkah 2: </b>Sebuah jendela menampilkan pallete warna akan muncul.<br>
    <b>Langkah 3: </b>Klik warna yang anda inginkan untuk teks.<br>
    <b>Langkah 4: </b>Klik tombol 
    <input type="button" value="Terapkan">
    untuk menerapkan warna.<br>
    <b>Langkah 5: </b>Jika anda selesai, Klik tombo 
    <input type="button" value="OK">
    .<br>
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bagaimana 
  cara memilih warna hover dan link ?</b> </font> 
  <ul>
    <b>Langkah 5: </b>Klik 
    <input type="button" value="Opsi Warna Extended">
    untuk mengubah ke opsi warna extended.<br>
  </ul>
  <?php endif;?>
  <?php if($src=="ext") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Bagaimana cara memilih warna link aktiv?</b> </font> 
  <ul>
    <p><b>Langkah 1: </b>Klik link "<span style="background-color:yellow" > Link 
      Aktiv </span>" di frame utama atau link "<span style="background-color:yellow" > 
      Link Activ </span>" di frame menu.<br>
      <b>Langkah 2: </b>Sebuah jendela menampilkan pallete warna akan muncul.<br>
      <b>Langkah 3: </b>Klik warna yang anda inginkan untuk Link Aktiv.<br>
      <b>Langkah 4: </b>Klik tombol 
      <input type="button" value="Terapkan">
      untuk menerapkan warna.<br>
      <b>Langkah 5: </b>Jika anda selesai, Klik tombol 
      <input type="button" value="OK">
      .<br>
    </p>
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Bagaimana cara memilih Warna Hover Link?</b> </font> 
  <ul>       	
 	<b>Langkah 1: </b>Klik link "<span style="background-color:yellow" > hover link </span>" di frame utama atau link
	"<span style="background-color:yellow" > Hover link </span>" di frame menu.<br>
 	<b>Langkah 2: </b>Sebuah jendela yang menampilkan pallete warna akan muncul.<br>
 	<b>Langkah 3: </b>Klik warna yang anda inginkan untuk hover link.<br>
 	<b>Langkah 4: </b>Klik tombol <input type="button" value="Terapkan">untuk menerapkan warna.<br>
 	<b>Langkah 5: </b>Jika anda selesai, Klik tombol <input type="button" value="OK">.<br>
</ul>

<?php endif;?>
	</form>

