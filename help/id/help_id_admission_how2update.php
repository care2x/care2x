<p><font size=2 face="verana,arial" >
<form action="#" >
<b>Untuk memperbaharui atau mengubah data</b>
<ul> Jika anda ingin membuat perubahan dalam informasi klik button
<input type="button" value="Update data">.
</ul>
<?php if($src=="search") : ?>
<b>New search</b>
<ul> Jika anda ingin memulai sebuah pencarian klik button <input type="button" value="Kembali untuk mencari">.
</ul>
<?php else : ?>
<b>Untuk memulai sebuah penerimaan(=Admission) terhadap seorang pasien baru </b>
<ul> Jika anda memulai penerimaan baru klik button  <input type="button" value="Kembali untuk penerimaan">.
</ul>
<?php endif;?>
<b>catatan</b>
<ul> Jika anda telah selesai klik tombol <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0>.
		
</ul>


</form>

