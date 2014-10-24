function chkForm()
{
	d=document.selectform;

	if(d.newstitle.value=="")
	{
		alert("<?php echo $LDAlertTitle ?>");
		d.newstitle.focus();
		return false;
	}
	else if(d.newsbody.value=="")
	{
		alert("<?php echo $LDAlertNews ?>");
		return false;
	}
	else if(d.author.value=="")
	{
		alert("<?php echo $LDAlertAuthor ?>");
		d.author.focus();
		return false;
	}
	else if(d.publishdate.value=="")
	{
		alert("<?php echo $LDAlertDate ?>");
		d.publishdate.focus();
		return false;
	}
	else return true;
		
}

