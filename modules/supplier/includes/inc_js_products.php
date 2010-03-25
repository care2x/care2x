<script language="JavaScript">
<!-- Script Begin
function prufform(d){
	
	var nmin="<?php echo $LDAlertInvalidMinorder ?>";
	var nmax="<?php echo $LDAlertInvalidMaxorder ?>";
	var noneg="<?php echo $LDAlertNoNegativeOrder ?>";
	if(d.mode.value=="search") return true;
	if(d.bestellnum.value=="")
	{
		alert("<?php echo $LDAlertNoOrderNr ?>");
		d.bestellnum.focus();
		return false;
	}
	if(d.artname.value=="")
	{
		alert("<?php echo $LDAlertNoArticleName ?>");
		d.artname.focus();
		return false;
	}
	if(d.besc.value=="")
	{
		alert("<?php echo $LDAlertNoDescription ?>");
		d.besc.focus();
		 return false;
	}
	//if(d.minorder.value=="") d.minorder.value=0;
	if(isNaN(d.minorder.value))
	{
		alert(nmin);
		d.minorder.focus();
		 return false;
	}
	minO=parseInt(d.minorder.value);
	if(minO<0)
	{
		alert(noneg);
		d.minorder.focus();
		 return false;
	}
	//if(d.maxorder.value=="") d.maxorder.value=0;
	if(isNaN(d.maxorder.value))
	{
		alert(nmax);
		d.maxorder.focus();
		 return false;
	}
	maxO=parseInt(d.maxorder.value);
	if(maxO<0)
	{
		alert(noneg);
		d.maxorder.focus();
		 return false;
	}
	if(minO>maxO)
	{
		alert("<?php echo $LDAlertMinHigherMax ?>");
		d.maxorder.focus();
		 return false;
	}
	if(d.proorder.value==0||isNaN(d.proorder.value))
	{
		alert("<?php echo $LDAlertInvalidProorder ?>");
		d.proorder.focus();
		 return false;
	}
	proO=parseInt(d.proorder.value);
	if(proO<0)
	{
		alert(noneg);
		d.proorder.focus();
		return false;
	}
	
	return true;
}
//  Script End -->
</script>
