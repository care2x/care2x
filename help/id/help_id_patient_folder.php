<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "Patient's Data - $x3" ?></b></font>
<form action="#" >
  <p><font size=2 face="verdana,arial" ></font> 
    <?php if($src=="") : ?>
    <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Apa 
    arti bar warna<img <?php echo createComIcon('../','colorcodebar3.gif','0') ?> >berikut? 
    </b></font> 
    <ul>
    <b>Catatan: </b>Setiap bar warna yang di "set visible" menandakan keberadaan 
    informasi tertentu, instruksi, perubahan, atau permintan, dll.<br>
    Arti warna bisa di set untuk tiap-tiap bangsal. <br>
    Serial bar warna pink di kanan merepresentasi perkiraan waktu ketika sebuah 
    instruksi akan dibawa.<br>
    Contoh : Enam bar warna pink menandakan "Jam ke-6" atau "6 pagi", 22 bar warna 
    menunjukkan "jam ke-22" atau "Jam 10 malam". 
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Apa (fungsi) tombol-tombol berikut?</b></font> 
  <ul> <input type="button" value="Grafik demam">
	<ul>
      Ini akan membuka grafik demam harian pasien. Anda bisa masuk, edit, atau 
      menghapus demam dan data DP di grafik.Informasi tambahan yang bisa di edit 
      adalah: 
      <ul type="disc">
        <li>Alergi<br>
        <li>Rencana diet harian<br>
        <li>Diagnosis/Terapi utama<br>
        <li>Diagnosis/Terapi harian<br>
        <li>Catatan, Diagnosis ekstra<br>
        <li>Pt (Terapi Fisik), Atg (anti-thrombosis gymnastics), dll.<br>
        <li>Antikoagulan<br>
        <li>Dokumentasi harian untuk antikoagulan<br>
        <li>Pengobatan ke dalam pembuluh darah & Pemakaian perban(pembalut)<br>
        <li>Dokumentasi harian untuk pengobatan ke dalam pembuluh darah<br>
        <li>Catatan<br>
        <li>(Daftar) Pengobatan<br>
        <li>Dokumentasi harian untuk pengobatan dan dosis<br>
      </ul>
    </ul>
<input type="button" value="Laporan Keperawatan">
	<ul>
		Ini akan membuka form laporan Keperawatan. anda bisa mendokumentasikan aktivitas keperawatan anda, efektivitas, observasi, permintaan, atau rekomendasi, dll.
	</ul>
	<input type="button" value="Perintah dokter">
	<ul>
	Pemimpin dokter memasukkan instruksinya, pengobatan, dosis, Jawaban ke permintaan perawat, atau instruksi untuk perubahan, dll.
	</ul>	
	<input type="button" value="Laporan Diagnostik">
	<ul>
	Menempatkan laporan diagnostik yang datang dari klinik atau departemen lain.
	</ul>	
	<input type="button" value="data Induk">
	<ul>
	Menempatkan data induk pasien dan Informasi pribadi seperti nama, nama pemberian, dll. ini juga merupakan dokumentasi inisial dari
	anamnesis atau Sejarah medis pasien yang melayani sebagai dasar untuk membuat rencana keperawatan.
	</ul>	
	<input type="button" value="Rencana Keperawatan">
	<ul>
	Ini adalah rencana keperawatan individu. Anda bisa membuat, edit, atau menghapus rencana.
	</ul>	
	<input type="button" value="Laporan Lab">
	<ul>
	Bagian ini menyimpan laporan medis dan patologi dari Laoratorium.
	</ul>	
	<input type="button" value="foto">
	<ul>
	Ini akan membuka katalog foto pasien.
	</ul>	
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Apa fungsi kotak pemilih ini</b><select name="d"><option value="">Pilih permintaan tes diagnostik</option></select>?
</font>
<ul>       	<b>Catatan: </b>Ini akan memilih form permintaan untuk tes diagnostik tertentu.<br>
 	<b>Langkah 1: </b>Klik di<select name="d"><option value="">Pilih permintaan tes diagnostik</option></select><br>
		<b>Langkah 2: </b>Klik di klinik terpilih, departemen, atau tes diagnostik.<br>
		<b>Langkah 3: </b>Form permintaan akan dibuka secara otomatis.<br>
</ul>
<?php endif;?>

<?php if($src=="labor") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>Tidak ada laporan laboratorium yang tersedia saat ini. </b></font>
<ul> Klik tombol <input type="button" value="OK"> untuk kembali ke folder data pasien.</ul>
<?php else  : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bagaimana cara menutup folder data pasien? </b></font>
<ul> <b>Catatan: </b>Jika anda ingin menutup, Klik tombol <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle">.</ul>

<?php endif;?>

</form>

