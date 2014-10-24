<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
EDP - 
<?php
	if($x1=='edit') $x1='update';
	switch($src)
	{
	case "access": 
		switch($x1)
						{
							case "": print "Erişim hakkı oluşturma";
												break;
							case "save": print "Yeni erişim hakkı kaydedildi";
												break;
							case "list": print "Bulunan erişim hakları";
												break;
							case "update": print "Bir erişim hakkının düzenlenmesi";
												break;
							case "lock":  print  " Bulunan bir erişim hakkının"; if($x2=="0") print " kilitlenmesi"; else print " kilidinin açılması"; 
												break;
							case "delete": print "Bir erişim hakkının silinmesi";
												break;
						}
						break;
	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >

	

<?php if($src=="access") : ?>
	<?php if($x1=="") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hastane çalışanı için erişim hakları nasıl oluşturulur ?</b>
</font>
<ul>       	
 	<b>Adım  1: </b>Önce çalışanı bulunuz.  <input type="button" value="Bir çalışanı bul"> düğmesini tıklayınız.<p>
 	<b>Adım 2: </b>Bir arama sayfası açılır. Bir çalışanı arama konusundaki yönergeleri izleyiniz.<p>
</ul>

		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni erişim hakkı nasıl oluşturulur?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Kişi, bölüm, veya klinik vs.nin tam adını "<span style="background-color:yellow" > İsim </span>" alanına yazınız.<br>
 	<b>Adım 2: </b>Kullanıcı ismini "<span style="background-color:yellow" > kullanıcı giriş ismi </span>" alanına yazınız.<p>
	<b>Uyarı:</b> Kullanıcı adında boşluğa izin verilmez.<p>
 	<b>Adım 3: </b>Kullanıcı şifresini "<span style="background-color:yellow" > Şifre </span>" alanına giriniz.<p>
 	<b>Adım 4: </b>"İzin ağacı" nda kullanıcının girmesine izin verilen alanları işaretleyiniz.<p>
</ul>

	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Tüm ilgili bilgileri girmeyi bitirdim. Nasıl kaydederim?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
</ul>
	<?php endif ?>	
	<?php if($x1=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Şimdi yeni erişim hakkı kaydedildi. Bir başka erişim hakkı daha nasıl oluşturulur?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> <input type="button" value="Tamam"> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Giriş formu görülecek.<br>
 	<b>Adım 3: </b>Erişim hakkı oluşturmak hakkında daha fazla bilgi görmek için "Yardım" düğmesini tıklayınız.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Daha önceden verilmiş erişim haklarının listesini görmek istiyorum. Nasıl yaparım?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> <input type="button" value="Güncel erişim hakları listesi"> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Güncel erişim hakları listelenir<br>
</ul>
	
	<?php endif ?>	
	<?php if($x1=="list") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<img <?php echo createComIcon('../','padlock.gif','0','absmiddle') ?>> ve <img <?php echo createComIcon('../','arrow-gr.gif','0','absmiddle') ?>> düğmelerinin anlamı ne?</b>
</font>
<ul>       	
 	<img <?php echo createComIcon('../','padlock.gif','0','absmiddle') ?>> = Kullanıcının erişim hakkı kilitlenmiş veya "dondurulmuş". Erişilebilir olarak düzenlenmiş alanlara giremez.<br>
 	<img <?php echo createComIcon('../','arrow-gr.gif','0','absmiddle') ?>> = Kullanıcının erişim hakkı kilitli değil. Erişilebilir olarak düzenlenmiş alanlara girebilir.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
 "C","L", ve "D", veya "U" seçenekleri ne anlama gelir?</b>
</font>
<ul>       	
 	<b>C: </b> = Kullanıcının erişim bilgisini değiştirmek veya düzenlemek.<br>
 	<b>L: </b> = Kullanıcının erişim hakkını kilitlemek.<br>
 	<b>D: </b> = Kullanıcının erişim hakkını silmek.<br>
 	<b>U: </b> = (Halen kilitli ise) kullanıcının erişim hakkının kilidini çözmek.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Kullanıcının erişim bilgisi nasıl düzenlenir veya değiştirilir?</b>
</font>
<ul>       	
 	Kullanıcı ile ilgili "<span style="background-color:yellow" > C </span>" seçeneğini tıklayınız.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Kullanıcının  erişim verisi nasıl kilitlenir?</b>
</font>
<ul>       	
 	Kullanıcı ile ilgili "<span style="background-color:yellow" > L </span>" seçeneğini tıklayınız.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
(Eğer halen kilitli ise) Kullanıcının erişim hakkının kilidi nasıl açılır?</b>
</font>
<ul>       	
 	Kullanıcı ile ilgili "<span style="background-color:yellow" > U </span>" seçeneğini tıklayınız.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir erişim hakkı nasıl silinir?</b>
</font>
<ul>       	
 	Kullanıcı ile ilgili  "<span style="background-color:yellow" > D </span>" seçeneğini tıklayınız.<br>
</ul>

	<?php endif ?>	
	
	<?php if($x1=="update") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir erişim hakkı nasıl düzenlenir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Bilgiyi düzenleyiniz.<br>
 	<b>Adım 2: </b><img <?php echo createLDImgSrc('../','savedisc.gif','0','absmiddle') ?>> düğmesini tıklayınız .<br>
</ul>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Uyarı:</b>
</font>
<ul>       	
 	Eğer düzenlememeye karar verirseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0','absmiddle') ?>>  düğmesini tıklayınız.<br>
</ul>
	
	<?php endif ?>		
	<?php if($x1=="delete") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir erişim hakkı nasıl silinir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Erişim hakkını silmek istediğinizden emin iseniz,<br>
	  <input type="button" value="Evet, Kesinlikle eminim. Erişim hakkını sil."> düğmesini tıklayınız.<br>
</ul>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Uyarı:</b>
</font>
<ul>       	
 	Silmemeye karar verir iseniz <input type="button" value="Hayır Geri."> düğmesini tıklayınız.<br>
</ul>
	
	<?php endif ?>		
	
	<?php if($x1=="lock") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir erişim hakkı nasıl <?php if($x2=="0") print "kilitlenir"; else print "açılır"; ?> ?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Eğer bir erişim hakkını  <?php if($x2=="0") print "kilitlemek"; else print "açmak"; ?> istediğinizden emin iseniz,<br>
	  <input type="button" value="Evet, eminim."> düğmesini tıklayınız.<br>
</ul>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Uyarı:</b>
</font>
<ul>       	
 	Eğer <?php if($x2=="0") print "kilitlemeye"; else print "çözmemeye"; ?> karar verirseniz <input type="button" value="Hayır. Geri."> düğmesini tıklayınız.<br>
</ul>
	
	<?php endif ?>		
<?php endif ?>	

	</form>

