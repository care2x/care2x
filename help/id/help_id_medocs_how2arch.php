<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<b><font face="Verdana, Arial" size="3" color="#0000cc">Bagaimana cara melakukan 
penelitian/pencarian di arsip medocs</font></b> 
<form action="#" >
<p>
  <?php if($src=="select") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Saya ingin update the displayed medocs document</b></font> 
  <ul>
    <b>Langkah : </b>Klik tombol 
    <input type="button" value="Mutakhirkan data">
    untuk memulai mengedit dokumen.<br>
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Saya 
  ingin </b></font><b><font color="#990000">memulai pencarian baru di arsip</font></b> 
  <ul> <b>Langkah : </b>Klik tombol <input type="button" value="Pencarian baru di arsip">
    untuk memulai pencarian baru.<br>
</ul>
<?php elseif(($src=="search")&&($x1)) : ?>
<b>Catatan</b>
  <ul>
    <?php if($x1==1) : ?>
    Jika pencarian menemukan hasil tunggal, dokumen lengkap akan ditampilkan secepatnya.<br>
    Bagaimanapun juga, jika pencarian menemukan beberapa hasil, sebuah daftar 
    akan ditampilkan.<br>
    <?php endif;?>
    Untuk melihat informasi pasien yang anda cari, klik tombol <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> 
    yang berhubungan dengannya, atau namanya, atau nama keluarganya, atau tanggal 
    dia masuk.. 
  </ul>
<b>Catatan</b>
  <ul>
    Jika anda ingin memulai pencarian baru, klik tombol 
    <input type="button" value="Pencarian baru di arsip">
    . 
  </ul>
  <?php else : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Saya 
  ingin daftar semua dokumen medocs dari departemen tertentu</b></font>
  <ul>
    <b>Langkah 1: </b>Masukkan kode departemen di kolom "Departemen:". <br>
    <b>Langkah 2: </b>Tinggalkan kolom lainnya dalam keadaan kosong.<br>
    <b>Langkah 3: </b>Klik tombol 
    <input type="button" value="Cari">
    untuk memulai pencarian.<br>
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Saya 
  mencari dokumen medocs khusus dari seorang </b></font><b><font color="#990000">pasien</font></b> 
  <ul>
    <b>Langkah 1: </b>Masukkan kata kunci di kolom yang berhubungan. bisa kata 
    penuh atau frasa atau beberapa huruf daru kata dari data pribadi pasien. <br>
    <ul>
      <font size=2 color="#000099" ><b>Kolom berikut bisa diisi dengan kata kunci:</b> 
      <br>
      Nomor Pasien<br>
      Nama Keluarga<br>
      Nama Pemberian (nama depan)<br>
      Tanggal Lahir<br>
      Alamat</font> 
    </ul>
    <b>Langkah 2: </b>Tinggalkan kolom lain dalam keadaan kosong.<br>
    <b>Langkah 3: </b>Klik tombol 
    <input type="button" value="Cari">
    untuk memulai pencarian baru.<br>
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Saya 
  ingin daftar dokumen medocs yang berhubungan dengan organisasi asuransi tertentu</b></font> 
  <ul>
    <b>Langkah 1: </b>Masukkan akronim organisasi asuransi di kolom &quot;Asuransi&quot;. 
    <br>
    <b>Langkah 2: </b>Tinggalkan kolom lain dalam keadaan kosong.<br>
    <b>Langkah 3: </b>Klik tombol 
    <input type="button" value="Cari">
    untuk memulai pencarian baru.<br>
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Saya 
  ingin daftar semua dokumen medocs dengan info tambahan asuransi </b></font> 
  <ul>
    <b>Langkah 1: </b>Masukkan kata kunci di kolom &quot;Informasi Ekstra&quot;.. 
    <br>
    <b>Langkah 2: </b>Tinggalkan kolom lain dalam keadaan kosong.<br>
    <b>Langkah 3: </b>Klik tombol 
    <input type="button" value="Cari">
    untuk memulai pencarian baru.<br>
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Saya 
  ingin daftar semua dokumen medocs pasien PRIA</b></font>
  <ul>
    <b>Langkah 1: </b>klik radio button "<span style="background-color:yellow" >Jenis 
    Kelamin 
    <input type="radio" name="r" value="1">
    pria</span>". <br>
    <b>Langkah 2: </b>Tinggalkan kolom lain dalam keadaan kosong.<br>
    <b>Langkah 3: </b>Klik tombol 
    <input type="button" value="Cari">
    untuk memulai pencarian baru.<br>
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Saya 
  ingin daftar semua dokumen medocs pasien WANITA</b></font> 
  <ul>
    <b>Langkah 1: </b>klik radio button "<span style="background-color:yellow" > 
    <input type="radio" name="r" value="1">female</span>". <br>
		<b>Langkah 2: </b>Tinggalkan kolom lain dalam keadaan kosong.<br>
		<b>Langkah 3: </b>Klik tombol 
    <input type="button" value="Cari">
    untuk memulai pencarian baru.<br>
</ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Saya 
  ingin daftar semua dokumen medocs pasien yang telah mendapat saran medis wajib</b></font>
  <ul>
    <b>Langkah 1: </b>klik radio button "<span style="background-color:yellow" >Saran 
    Medis: 
    <input type="radio" name="r" value="1">
    Ya</span>". <br>
    <b>Langkah 2: </b>Tinggalkan kolom lain dalam keadaan kosong.<br>
    <b>Langkah 3: </b>Klik tombol 
    <input type="button" value="Cari">
    untuk memulai pencarian baru.<br>
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Saya 
  ingin daftar semua dokumen medocs pasien yang belum menerima saran medis wajib</b></font> 
  <ul>
    <b>Langkah 1: </b>klik radio button "<span style="background-color:yellow" > 
    <input type="radio" name="r" value="1">
    No</span>". <br>
    <b>Langkah 2: </b>Tinggalkan kolom lain dalam keadaan kosong.<br>
    <b>Langkah 3: </b>Klik tombol 
    <input type="button" value="Cari">
    untuk memulai pencarian baru.<br>
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Saya 
  ingin daftar semua dokumen medocs dengan kata kunci tertentu</b></font> 
  <ul>
    <b>Langkah 1: </b>Masukkan kata kunci di kolom yang berkaitan denganya. bisa 
    kata lengkap, frase, atau beberapa huruf dari sebuah kata. <br>
    <ul>
      <font size=2 color="#000099" > <b>Contoh :</b> untuk kata kunci diagnosis 
      masukkan di kolom "Diagnosis"..<br>
      <b>Contoh :</b> untuk kata kunci terapi masukkan di kolom "terapi yang disarankan".<br>
      </font> 
    </ul>
    <b>Langkah 2: </b>Tinggalkan kolom lain dalam keadaan kosong.<br>
    <b>Langkah 3: </b>Klik tombol 
    <input type="button" value="Cari">
    untuk memulai pencarian baru.<br>
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Saya 
  ingin </b></font><b><font color="#990000">daftar dokumen medocs yang ditulis 
  pada tanggal tertentu</font></b> 
  <ul>
    <b>Langkah 1: </b>Masukkan tanggal dokumentasi di kolom "didokumentasikan 
    pada :". <br>
    <ul>
      <font size=2 color="#000099"> <b>Tip:</b> Masukkan "T" atau "t" untuk membuat 
      tanggal hari ini secara otomatis..<br>
      <b>Tip:</b> Masukkan "Y" atau"y"untuk membuat tanggal kemarin secara otomatis.<br>
      </font> 
    </ul>
    <b>Langkah 2: </b>Tinggalkan kolom lain dalam keadaan kosong.<br>
    <b>Langkah 3: </b>Klik tombol 
    <input type="button" value="Cari">
    untuk memulai pencarian baru.<br>
  </ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Saya 
  ingin list semua dokumen medocs yang ditulis oleh orang tertentu</b></font>
  <ul>
    <b>Langkah 1: </b>Masukkan secara lengkap atau beberapa huruf nama orang tersebut 
    di kolom "didokumentasikan oleh:". <br>
    <b>Langkah 2: </b>Tinggalkan kolom lain dalam keadaan kosong.<br>
    <b>Langkah 3: </b>Klik tombol 
    <input type="button" value="Cari">
    untuk memulai pencarian baru.<br>
  </ul>
<b>Catatan</b>
  <ul>
    Anda bisa mengkombinasikan beberapa kondisi pencarian. Sebagai contoh: Jika 
    anda ingin mendaftar semua pasien PRIA yang di operasi di bedah plastik, yang 
    telah menerima saran medis wajib, dan yang telah menerima terapi yang mengandung 
    kata &quot;lipo&quot;: 
    <p> <b>Langkah 1: </b>Masukkan "plop" di kolom "Departemen:". <br>
      <b>Langkah 2: </b>klik radio button "<span style="background-color:yellow" >Jenis 
      Kelamin</span><span style="background-color:yellow" > 
      <input type="radio" name="r" value="1">
      pria</span>".<br>
      <b>Langkah 3: </b>klik radio button "<span style="background-color:yellow" >Saran 
      medis: 
      <input type="radio" name="r" value="1">
      Ya</span>".<br>
      <b>Langkah 4: </b>masukkan "lipo" di kolom "Terapi:". <br>
      <b>Langkah 5: </b>Klik tombol 
      <input type="button" value="Cari" name="Button">
      untuk memulai pencarian.<br>
    </p>
  </ul>
  <b>Catatan</b> 
  <ul>
    <?php if($x1==1) : ?>
    <p>Jika pencarian menemukan hasil tunggal, dokumen lengkap akan ditampilkan 
      secepatnya.<br>
      Bagaimanapun juga, jika pencarian menemukan beberapa hasil, sebuah daftar 
      akan ditampilkan.<br>
      <?php endif;?>
      Untuk melihat informasi pasien yang anda cari, klik tombol <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> 
      yang berhubungan dengannya, atau namanya, atau nama keluarganya, atau tanggal 
      dia masuk.. </p>
    <p> 
      <?php endif;?>
      <b>Catatan</b> </p>
  </ul>

<ul>
    Jika anda memutuskan untuk membatalkan pencarian, klik tombol 
    <input type="button" value="Tutup">
    . 
  </ul>
</form>

