<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "$x3 - $x2" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bekleme listesindeki bir hasta nasýl kabul edilir?</b></font>
<ul> <b>Adým 1: </b>Bekleme listesinde hastanýn ismini týklayýnýz.<p>
<img src="../help/tr/img/tr_ambulatory_waitlist.png" border=0 width=301 height=156>
                                                                     <p>
		<b>Adým 2: </b>Servis yatan hasta listesini gösteren bir pencere açýlýr.<br>
		<b>Adým 3: </b>Hastaya verilecek yataðýn <img <?php echo createLDImgSrc('../','assign_here.gif','0') ?>> düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir yatak bir hastaya nasýl verilir?</b> (Eski yöntem)</font>
<ul> 
<b>Uyarý: </b> Bu hastayý bir servise kabul etmenin eski yöntemidir. Güncel yöntem için bekleme listesini kullanýnýz. Yukarýdaki adýmlara bakýnýz.<p>
<b>Adým 1: </b>Ýlgili oda numarasý ve yataðýn <img <?php echo createComIcon('../','plus2.gif','0') ?>> düðmesini týklayýnýz. 
                                                                     <br>
		<b>Adým 2: </b>Hasta aramak için bir pencere açýlýr.<br>
		<b>Adým 3: </b>Önce çeþitli giriþ alanlarýndan birine aranacak bir anahtar sözcük girerek hastayý bulunuz.<br>
		Hastayý ...<ul type="disc">
		<li>protokol numarasýna göre bulmak ister iseniz <br>"<span style="background-color:yellow" >Protokol numarasý:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" alanýna numarayý giriniz.
		<li>soyadýna göre bulmak ister iseniz <br>"<span style="background-color:yellow" >Soyadý:</span><input type="text" name="t" size=19 maxlength=10 value="Schmitt">" alanýna soyadýný veya soyadýnýn ilk birkaç harfini yazýnýz.
		<li>adýna göre bulmak ister iseniz  <br>"<span style="background-color:yellow" >Adý:</span><input type="text" name="t" size=19 maxlength=10 value="Peter">" alanýna adýný veya adýnýn ilk birkaç hharfini yazýnýz.
		<li>doðum tarihine göre bulmak isterseniz <br>"<span style="background-color:yellow" >Doðum tarihi:</span><input type="text" name="t" size=19 maxlength=10 value="10.10.1966">" alanýna doðum tarihini veya doðum tarihinin ilk birkaç rakamýný giriniz.
		</ul>
		<b>Adým 4: </b>Hastayý aramaya baþlamak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düðmesini týklayýnýz.<br>
		<b>Adým 5: </b>Eðer arama hastayý veya birkaç hasta bulur ise bir hasta listesi görüntülenir.<br>
		<b>Adým 6: </b>Doðru hastayý seçmek için hastanýn ilgili &nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> düðmesini týklayýnýz.<br>
</ul>

<?php if((($src=="")&&($x1=="ja"))||(($src=="fresh")&&($x1=="template"))) : ?>


<font face="Verdana, Arial" size=2>
<a name="open"></a>
<b>
<p><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000">Bir hastanýn çizelgeleri nasýl açýlýr?</font></b><p>
<font face="Verdana, Arial" size=2>
<ul>
<b>Adým:</b> Hasta dosyasýný açmak için renkli çubuklarý týklayýnýz...<p>
<img src="../help/tr/img/tr_ambulatory_sbars.png" border=0 width=434 height=84><p>
<b>Veya:</b> Hasta dosyasýný açmak için  <img <?php echo createComIcon($root_path,'open.gif','0'); ?>> simgesini týklayýnýz...<p>
<img src="../help/tr/img/tr_admission_folder.png" border=0 width=456 height=92>
</ul>
<a name="adata"></a>
<font face="Verdana, Arial" size=2>
<b>
<p><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000">Bir hastanýn kayýt kabul bilgileri nasýl görüntülenir?</font></b><p>
<font face="Verdana, Arial" size=2>
<ul>
<b>Adým:</b> Kabul bilgilerini görüntüntülemek için <img <?php echo createComIcon($root_path,'pdata.gif','0'); ?>> simgesini týklayýnýz...<p>
<img src="../help/tr/img/tr_admission_listlink.png" border=0 width=456 height=92><p>
<b>Veya:</b> Kabul bilgilerini görüntülemek için hastanýn soyadýný týklayýnýz.<p>
<img src="../help/tr/img/tr_ambulatory_name.png" border=0 width=434 height=84>
</ul>

<a name="transfer"></a>
<font face="Verdana, Arial" size=2>
<b>
<p><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000">Bir hasta nasýl nakil edilir?</font></b><p>
<font face="Verdana, Arial" size=2>
<ul>
<b>Adým:</b> Transfer penceresini açmak için  <img <?php echo createComIcon($root_path,'xchange.gif','0'); ?>> simgesini týklayýnýz.<p>
<img src="../help/tr/img/tr_admission_transfer.png" border=0 width=456 height=92>
</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hasta servisten nasýl çýkarýlýr?</b></font>
<ul> <b>Adým 1: </b>Hastanýn ilgili <img <?php echo createComIcon('../','bestell.gif','0') ?>> düðmesini týklayýnýz.
                                                                     <p>
<img src="../help/tr/img/tr_admission_discharge.png" border=0 width=456 height=92><p>
		<b>Adým 2: </b>Hastanýn çýkýþ formu görüntülenir.<br>
		<b>Adým 3: </b>Hastayý çýkaracaðýnýzdan emin iseniz, <br> 
		"<input type="checkbox" name="g" ><span style="background-color:yellow" > Evet, eminim. Hastayý çýkar.</span>" kutusunu iþaretleyiniz.<br>
       	<b>Adým 4: </b>Hastayý çýkarmak için <input type="button" value="çýkar"> düðmesini týklayýnýz.<p>
       	<b>Uyarý: </b>Ýptal etmek ister iseniz,  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düðmesini týklayýnýz. Hasta çýkarýlmaz.<br>
</ul>




<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir yatak nasýl kilitlenir?</b></font>
<ul> <b>Adým 1: </b>Ýlgili oda numarasý yataðýn <img <?php echo createComIcon('../','plus2.gif','0') ?>> düðmesini týklayýnýz.
                                                                     <br>
		<b>Adým 2: </b>Hasta aramak için bir pencere açýlýr.<br>
		<b>Adým 3: </b> "<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Bu yataðý kilitle</font> </span>" yi týklayýnýz.<br>
		<b>Step 4: </b>Onay istendiðinde&nbsp;<button>Tamam</button> týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Listeden bir hastayý silmek istiyorum</b></font>
.<ul> <b>Uyarý: </b>Bir hastayý basitçe listeden SÝLEMEZSÝNÝZ. Hastayý kurala uygun olarak çýkarmanýz gerekir. Bunu yapmak için, yukarýda açýklanan hastayý servisten çýkarma yönergelerini izleyiniz. <br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bu  <img <?php echo createComIcon('../','s_colorbar.gif','0') ?>> renkli çubuklar ne anlama geliyor? </b></font>
<ul> <b>Uyarý: </b>Bu renkli çubuklarýn her biri "görünür" olduklarý zaman belirli bir bilginin, bir uyarýnýn, bir deðiþikliðin veya bir sorgunun vs. varlýðýný belirtirler.<br>
			Her servis için bir rengin anlamý ayarlanabilir. 
</ul>
<!-- <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bu simgenin <img <?php echo createComIcon('../','patdata.gif','0') ?>> anlamý ne? </b></font>
<ul> <b>Uyarý: </b>Bu hastanýn veri dosyasý düðmesidir. Hastanýn veri dosyasý klasörünü görüntülemek için, bu simgeyi týklayýnýz. Hastanýn var ise resmi, ve birkaç diðer seçeneði içeren hastanýn temel bilgilerini gösteren bir pencere açýlýr.<br>
</ul> -->
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bu simgenin  <img <?php echo createComIcon('../','bubble2.gif','0') ?>> anlamý nedir? </b></font>
<ul> <b>Uyarý: </b>Bu Oku/Yaz uyarý düðmesidir. Bu týklandýðýnda hasta ile ilgili notlarý okumak veya yazmak için bir pencere açýlýr..<br>
			Düz <img <?php echo createComIcon('../','bubble2.gif','0') ?>> simgenin anlamý henüz hasta hakkýnda yazýlmýþ bir not veya uyarý yok demektir. Bir not veya uyarý yazmak için bu simgeyi týklayýnýz.
			 <img <?php echo createComIcon('../','bubble3.gif','0') ?>> simgesi hasta hakkýnda kayýtlý not veya uyarý bulunduðu anlamýna gelir. Not veya uyarýlarý okumak ya da eklemek için bu simgeyi týklayýnýz.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bu simgenin <img <?php echo createComIcon('../','bestell.gif','0') ?>> anlamý nedir? </b></font>
<ul> <b>Uyarý: </b>Bu hasta çýkarma düðmesidir. Bir hastayý çýkarmak istediðinizde hasta çýkarma formunu açmak için bunu týklayýnýz.<br>
</ul>
<?php elseif(($src=="")&&($x1=="template")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<span style="background-color:yellow" >Henüz bugünün listesi oluþturulmadý </span> yazar ise ne yapmalýyým?</b></font>
<ul> <b>Adým 1: </b>Son kayýt edilmiþ listeyi görmek için <input type="button" value="Son yatan hasta listesini göster"> düðmesini týklayýnýz.
                                                                     <br>
		<b>Adým 2: </b>Son 31 gün içinde kayýt edilmiþ bir liste var ise görüntülenir.<br>
		<b>Adým 3: </b> <input type="button" value="Bu listeyi bugün için yine de kopyala."> düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Son yatan hasta listesini görmek istemiyorum. Yeni bir liste nasýl oluþtururum?</b></font>
<ul> <b>Adým 1: </b>Ýlgili oda numarasý ve yataðýn <img <?php echo createComIcon('../','plus2.gif','0') ?>> düðmesini týklayýnýz.
                                                                     <br>
		<b>Adým 2: </b>Hasta aramak için bir pencere açýlýýr.<br>
		<b>Adým 3: </b>Önce çeþitli giriþ alanlarýndan birine bir anahtar sözcük girip hastayý bulunuz.<br>
		Hastayý...<ul type="disc">
		<li>protokol numarasýna göre aramak ister iseniz <br>"<span style="background-color:yellow" >Protokol no.:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" alanýna protokol numarasýný veya ilk birkaç rakamýný yazýnýz.
		<li>soyadýna göre aramak ister iseniz, soyadýný veya soyadýnýn ilk birkaç harfini <br>"<span style="background-color:yellow" >Soyadý:</span><input type="text" name="t" size=19 maxlength=10 value="Potur">" alanýna yazýnýz.
		<li>Adýna göre aramak ister iseniz adýný veya adýnýn ilk birkaç harfini <br>"<span style="background-color:yellow" >Adý:</span><input type="text" name="t" size=19 maxlength=10 value="Ahmet">" alanýna yazýnýz.
		<li>doðum tarihine göre aramak ister iseniz, doðum tarihini veya ilk bir kaç rakamýný  <br>"<span style="background-color:yellow" >Doðum tarihi:</span><input type="text" name="t" size=19 maxlength=10 value="10.08.1946">" alanýna yazýnýz.
		</ul>
		<b>Adým 4: </b>Hastayý aramaya baþlamak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düðmesini týklayýnýz.<br>
		<b>Adým 5: </b>Eðer arama bir hasta veya birkaç hasta bulur ise bir hasta listesi görüntülenir.<br>
		<b>Adým 6: </b>Doðru hastayý seçmek için,ilgili &nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> düðmesini týklayýnýz.<br>
</ul>
<?php elseif(($src=="getlast")&&($x1=="last")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Görüntülenen son yatan hasta listesi bugünkü yatan hasta listesi olarak nasýl kopyalanýr?</b></font>
<ul> <b>Adým 1: </b>Son kayýtlý listeyi kopyalamak için  <input type="button" value="Bu listeyi bugün için yine de kopyala."> düðmesini týklayýnýz.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Son yatan hasta listesi görüntüleniyor fakat onu kopyalamak istemiyorum. Yeni bir listeye nasýl baþlarým? </b></font>
<ul> <b>Adým 1: </b>Yeni liste oluþturmaya baþlamak için  <input type="button" value="Bunu kopyalama! Yeni liste oluþtur."> düðmesini týklayýnýz.
</ul>
<?php elseif($src=="assign") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir yatak bir hastaya nasýl verilir?</b></font>
<ul> <b>Adým 1: </b>Önce çeþitli giriþ alanlarýndan birine bir anahtar sözcük girip hastayý bulunuz.<br>
		Hastayý...<ul type="disc">
		<li>protokol numarasýna göre aramak ister iseniz <br>"<span style="background-color:yellow" >Protokol no.:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" alanýna protokol numarasýný veya ilk birkaç rakamýný yazýnýz.
		<li>soyadýna göre aramak ister iseniz, soyadýný veya soyadýnýn ilk birkaç harfini <br>"<span style="background-color:yellow" >Soyadý:</span><input type="text" name="t" size=19 maxlength=10 value="Potur">" alanýna yazýnýz.
		<li>Adýna göre aramak ister iseniz adýný veya adýnýn ilk birkaç harfini <br>"<span style="background-color:yellow" >Adý:</span><input type="text" name="t" size=19 maxlength=10 value="Ahmet">" alanýna yazýnýz.
		<li>doðum tarihine göre aramak ister iseniz, doðum tarihini veya ilk bir kaç rakamýný  <br>"<span style="background-color:yellow" >Doðum tarihi:</span><input type="text" name="t" size=19 maxlength=10 value="10.08.1946">" alanýna yazýnýz.
		</ul>
		<b>Adým 2: </b>Hastayý aramaya baþlamak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düðmesini týklayýnýz.<br>
		<b>Adým 3: </b>Eðer arama bir hasta veya birkaç hasta bulur ise bir hasta listesi görüntülenir.<br>
		<b>Adým 4: </b>Doðru hastayý seçmek için,ilgili &nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir yatak nasýl kilitlenir?</b></font>
<ul> <b>Adým 1: </b>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Bu yataðý kilitle</font> </span>" yazýsýný týklayýnýz.<br>
		<b>Adým 2: </b>Onay istendiði zaman &nbsp;<button>Tamam</button> ý týklayýnýz.<p>
</ul>
  <b>Uyarý: </b>Ýptal etmek ister iseniz,  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düðmesini týklayýnýz.</ul>
  
<?php endif ?>

<?php if(($src!="assign")&&($src!="remarks")&&($src!="discharge")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bu "<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Kilitli</font> </span>" simgesinin anlamý nedir? </b></font>
<ul> <b>Uyarý: </b>Bunun anlamý yatak kilitli bir hastaya verilemez demektir. Kilidini açmak için "<span style="background-color:yellow" ><font color="#0000ff">Kilitli</font></span>" simgesini týklayýnýz ve onay istenildiði zaman &nbsp;<button>Tamam</button>
			seçiniz.<br>
 <b>Uyarý: </b>Program versiyonuna veya kurulum ayarlarýna baðýmlý olarak, kilitli bir yataðýn açýlmasý þifre gerektirebilir.</ul>

<?php endif ?>

<a name="pic"></a>
<font face="Verdana, Arial" size=2>
<b>
<p><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000">Hastanýn kimlik fotoðrafý nasýl gösterilir?</font></b><p>
<font face="Verdana, Arial" size=2>
<ul>
<b>Adým:</b> Ya  <img <?php echo createComIcon($root_path,'spf.gif','0'); ?>> veya  <img <?php echo createComIcon($root_path,'spm.gif','0'); ?>> simgesini týklayýnýz.<p>
<img src="../help/tr/img/tr_ambulatory_sex.png" border=0 width=434 height=84>
</ul>


</form>

