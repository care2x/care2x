
<p><font size=2 face="verana,arial" >
<form action="#" >
<b>Bilgileri güncelleþtirmek veya deðiþtirmek</b>
<ul> Bilgilerde deðiþiklik yapmak isterseniz <input type="button" value="Güncelleþtir"> düðmesini týklayýnýz.
</ul>
<?php if($src=="search") : ?>
<b>Yeni arama</b>
<ul> Yeni bir arama baþlatmak isterseniz  <input type="button" value="Aramaya geri"> düðmesini týklayýnýz.
</ul>
<?php else : ?>
<b>Yeni bir hasta için yeni kabul baþlatmak</b>
<ul> Eðer yeni bir kabul iþemi baþlatmak isterseniz  <input type="button" value="Kabule geri "> düðmesini týklatýnýz.
</ul>
<?php endif ?>
<b>Uyarý</b>
<ul> Eðer iþiniz bitti ise <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düðmesini týklatýnýz.
		
</ul>


</form>

