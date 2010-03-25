{{* ordering_frameset.tpl Frameset for the ordering module (pharma & meddepot) 2004-07-04 Elpidio Latorilla *}}

<frameset rows="33,*">
  <frame name="BHEADER" {{$sHeaderSource}} scrolling="no" frameborder="yes" >
  <frameset cols="50%,*" id="products">
	<frame name="BESTELLKORB" {{$sBasketSource}} scrolling="auto" frameborder="yes">
     <frame name="BESTELLKATALOG" {{$sCatalogSource}} scrolling="auto" frameborder="yes">
  </frameset>
</frameset>