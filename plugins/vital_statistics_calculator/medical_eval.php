<?php 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<TITLE><?php echo $LDPersonalPhysicalEval; ?></TITLE>
<STYLE TYPE="text/css">
	A:link  {text-decoration: none; color: #000066;}
	A:hover {text-decoration: underline; color: #cc0033;}
	A:active {text-decoration: none; color: #cc0000;}
	A:visited {text-decoration: none; color: #000066;}
	A:visited:active {text-decoration: none; color: #cc0000;}
	A:visited:hover {text-decoration: underline; color: #cc0033;}
</STYLE>
<script language="javascript">
function cursorOn(fld)
{
	fld.select();
	fld.focus();
}

function htincm()
{
	var feet = parseInt(document.frmgpv.ft.options[document.frmgpv.ft.selectedIndex].value);
	var inches = parseInt(document.frmgpv.inc.options[document.frmgpv.inc.selectedIndex].value);
	total_inches = (feet * 12) + inches;
	htcms = total_inches * 2.54;
	htcms = parseInt(htcms);
	document.frmgpv.htincms.value = htcms;
}

function wsincm()
{
	var inches = parseInt(document.frmgpv.wsinches.value);
	wscms = inches * 2.54;
	wscms = parseInt(wscms);
	document.frmgpv.wsincms.value = wscms;
}

function wsinin()
{
	var cms = parseInt(document.frmgpv.wsincms.value);
	wsinin = cms / 2.54;
	wsinin = parseInt(wsinin);
	document.frmgpv.wsinches.value = wsinin;
}

function wtinkgs()
{
	var wtinlbs = parseInt(document.frmgpv.wtlbs.value);
	wtKgs = wtinlbs / 2.20462262185;
	wtKgs = parseInt(wtKgs);
	document.frmgpv.wtkgs.value = wtKgs;
}

function wtinlbs()
{
	var wtinkgs = parseInt(document.frmgpv.wtkgs.value);
	wtLbs = wtinkgs * 2.20462262185;
	wtLbs = parseInt(wtLbs);
	document.frmgpv.wtlbs.value = wtLbs;
}
</script>
</head>

<BODY bgColor=#ffffff onload=cursorOn(frmgpv.age)>
<H1 align=center><FONT color=#000080>Llogarites i Statistikave Vitale</FONT></H1><FONT color=#008000>
<P align=center><SMALL><FONT color=#ff0000 face="Verdana"><B>Kujdes Java Script duhet te jete aktiv</B></FONT></SMALL></P>
<FORM name=frmgpv action=physical_eval.php method=post>
<DIV align=center>
<CENTER><FONT face=Verdana size=2>
<TABLE cellSpacing=4 cellPadding=2 border=3 bordercolorlight="#C0C0C0" bordercolordark="#808080" style="border-collapse: collapse" bordercolor="#111111" bgcolor="#CCCCCC">
  <TBODY>
  <TR>
    <TD align="right"><font size="2">Mosha (ne vjet) eshte</font></TD>
    <TD><INPUT tabIndex=1 maxLength=3 
      onchange="if(!isNaN(this.value)) {return true;} else {this.focus(); this.select(); alert('Jepni nje numer');}" 
      size=3 value=0 name=age></TD></TR>
  <TR>
    <TD align="right"><font size="2">Ju jeni?</font></TD>
    <TD><SELECT tabIndex=2 size=1 name=sex> <OPTION value=male 
        selected>Mashkull</OPTION> <OPTION value=female>Femer</OPTION></SELECT></TD></TR>
  <TR>
    <TD align="right"><font size="2">Pesha juaj (ne Kg) eshte</font><font size="2" color="#ff0080">*</font></TD>
    <TD><INPUT tabIndex=3 maxLength=5 
      onchange="if(!isNaN(this.value)) {wtinlbs(); return true;} else {this.focus(); this.select(); alert('Jepni nje numer');}" 
      size=5 value=0.01 name=wtkgs></TD></TR>
  <TR>
    <TD align="right"><font size="2">Pesha juaj (ne Lbs) eshte</font>
    <font size="2" color="#ff0080">*</font></TD>
    <TD><INPUT tabIndex=4 maxLength=5 
      onchange="if(!isNaN(this.value)) {wtinkgs(); return true;} else {this.focus(); this.select(); alert('Jepni nje numer');}" 
      size=5 value=0.01 name=wtlbs></TD></TR>
  <TR>
    <TD align="right"><font size="2">Beli juaj (ne cm) eshte</font><font size="2" color="#ff0080">*</font></TD>
    <TD><INPUT tabIndex=5 maxLength=5 
      onchange="if(!isNaN(this.value)) {wsinin(); return true;} else {this.focus(); this.select(); alert('Jepni nje numer');}" 
      size=5 value=0.01 name=wsincms></TD></TR>
  <TR>
    <TD align="right"><font size="2">Beli juaj (ne inch) eshte</font>
    <font size="2" color="#ff0080">*</font></TD>
    <TD><INPUT tabIndex=6 maxLength=5 
      onchange="if(!isNaN(this.value)) {wsincm(); return true;} else {this.focus(); this.select(); alert('Jepni nje numer');}" 
      size=5 value=0.01 name=wsinches></TD></TR>
  <TR>
    <TD align="right"><font size="2">Gjatesia (ne cm) eshte</font>
    <font size="2" color="#ff0080">*</font></TD>
    <TD><INPUT tabIndex=7 
      onchange="if(!isNaN(this.value)) {return true;} else {this.focus(); this.select(); alert('Jepni nje numer');}" 
      size=3 value=0.1 name=htincms></TD></TR>
  <TR>
    <TD align="right"><font size="2">Gjatesia (ne feet dhe inches) eshte</font>
    <font size="2" color="#ff0080">*</font></TD>
    <TD><SELECT tabIndex=8 size=1 name=ft> <OPTION value=0 
        selected>0</OPTION> <OPTION value=1>1</OPTION> <OPTION 
        value=2>2</OPTION> <OPTION value=3>3</OPTION> <OPTION value=4>4</OPTION> 
        <OPTION value=5>5</OPTION> <OPTION value=6>6</OPTION> <OPTION 
        value=7>7</OPTION> <OPTION value=4>8</OPTION> <OPTION value=9>9</OPTION> 
        <OPTION value=10>10</OPTION> 
      <OPTION></OPTION></SELECT><STRONG><font size="2">'</font></STRONG><font size="2">
    </font> <SELECT 
      onblur=htincm() tabIndex=9 size=1 name=inc> <OPTION value=0 
        selected>0</OPTION> <OPTION value=1>1</OPTION> <OPTION 
        value=2>2</OPTION> <OPTION value=3>3</OPTION> <OPTION value=4>4</OPTION> 
        <OPTION value=5>5</OPTION> <OPTION value=6>6</OPTION> <OPTION 
        value=7>7</OPTION> <OPTION value=8>8</OPTION> <OPTION value=9>9</OPTION> 
        <OPTION value=10>10</OPTION> <OPTION value=11>11</OPTION> <OPTION 
        value=12>12</OPTION> 
      <OPTION></OPTION></SELECT><STRONG><font size="2">"</font></STRONG><font size="2">
    </font> </TD></TR>
  <TR>
    <TD align="right"><font size="2">Pulsi </font> </TD>
    <TD><INPUT tabIndex=10 maxLength=3 
      onchange="if(!isNaN(this.value)) {return true;} else {this.focus(); this.select(); alert('Jepni nje numer');}" 
      size=3 value=72 name=prate><font size="2">rrahje per minut</font></TD></TR>
  <TR>
    <TD align="right"><font size="2">Presioni (mm Hg) eshte</font></TD>
    <TD><INPUT tabIndex=11 maxLength=3 
      onchange="if(!isNaN(this.value)) {return true;} else {this.focus(); this.select(); alert('Please enter a number');}" 
      size=3 value=120 name=bps><font size="2"> systolik, </font> <INPUT tabIndex=12 maxLength=3 
      onchange="if(!isNaN(this.value)) {return true;} else {this.focus(); this.select(); alert('Please enter a number');}" 
      size=3 value=80 name=bpd><font size="2"> diastolik </font> 
</TD></TR></TBODY></TABLE></FONT></CENTER></DIV>
<DIV align=center>
<CENTER>
    <p align="center"><button name="calculate" type="submit"><font face="Verdana">Llogarit</font></button>&nbsp;
    <button name="clearit" type="reset"><font face="Verdana">Pastro Formen</font></button></CENTER></DIV></FORM>
<P align=center><font face="Verdana"><font size="2" color="#ff0080">*</font><font size="2">
</font> <FONT color=#ff00ff><SMALL>Ploteso vetem njeren peshe ( Kg ose Lb ) dhe njeren gjatesi ( cm ose feet )  <br>
Programi do te llogarit automatikisht tjetren.</SMALL><font size="2"><BR>
</font></FONT></font><FONT color=red><font face="Verdana"><B><font size="2">Nqs jeni ne dyshim kerkoni ndihmen e nje infermiereje ose para-medik</font></B></font> 
</FONT></P>
</FONT>
<P align=center><FONT size=1 face="Verdana">©Gjergj Sheldija- 2004 - 2014</FONT></P>
<FONT color=#008000>
<DIV></DIV></FONT></BODY></HTML>