<?php
if (($sid == NULL) || ($sid != $$ck_sid_buffer) || ($user == NULL)) {
	header ( "Location: invalid-access-warning.php?mode=close" ) ;
	exit () ;
}
;

srand ( time () * 10000 ) ;
$r = rand ( 1, 10000 ) ;
// initializations
require_once ($root_path . 'include/core/inc_config_color.php') ;

$pdata = array ( ) ;
$filetitles = array ( ) ;
$template = array ( ) ;
$monat = array ( "januar" , "februar" , "märz" , "april" , "mai" , "juni" , "juli" , "august" , "september" , "oktober" , "november" , "dezember" ) ;
if ($pyear == "")
	$pyear = date ( Y ) ;
if ($pmonth == "")
	$pmonth = date ( m ) ;
if ($pday == "")
	$pday = date ( d ) ;

$md = $pday ;
if (strlen ( $md ) == 1)
	$md = "0" . $md ;

$mainpath = "op/abteilung/" . strtolower ( $dept ) . "/op_saal_" . strtolower ( $saal ) . "/opbuch/" . $pyear . "/" . $monat [ ( int ) $pmonth - 1 ] . "/" . $md . "/" ;

function getlastnum ( $xyr , $xmon , $xday ) {
	
	$xmonat = array ( "januar" , "februar" , "märz" , "april" , "mai" , "juni" , "juli" , "august" , "september" , "oktober" , "november" , "dezember" ) ;
	while ( ! sizeof ( $titles ) ) {
		
		if ($xday > 1) {
			$xday = $xday - 1 ;
			if ($xday < 10)
				$xday = "0" . $xday ;
		} else if ($xmon > 1) {
			$xmon -- ;
			if (checkdate ( $xmon, '31', $xyr ))
				$xday = 31 ; else if (checkdate ( $xmon, '30', $xyr ))
				$xday = 30 ; else if (checkdate ( $xmon, '29', $xyr ))
				$xday = 29 ; else
				$xday = 28 ;
		} else
			$xyr -- ;
		
		if ($xyr < 1950)
			break ; //limits the backwards lookup 
		$xpath = "op/abteilung/" . strtolower ( $dept ) . "/op_saal_" . strtolower ( $saal ) . "/opbuch/" . $xyr . "/" . $xmonat [ ( int ) $xmon - 1 ] . "/" . $xday . "/" ;
		//  echo $xday." ".$xpath."   ".$lastnum[0]; echo "<br>";
		if (file_exists ( $xpath )) {
			$xhandle = opendir ( $xpath ) ;
			while ( false !== ($xfile = readdir ( $xhandle )) ) {
				$v = strpos ( $xfile, "_" ) ;
				if ($xfile != "." && $xfile != ".." && $v != 0) {
					if (strstr ( $xfile, ".opb" ) != false)
						$titles [] = strtolower ( $xfile ) ;
				}
			}
		} else
			break ; // if a directory is missing break and return 0
	}
	if (sizeof ( $titles ) > 0) {
		array_multisort ( $titles, SORT_DESC ) ;
		$lastnum = explode ( "_", $titles [ 0 ] ) ;
	}
	
	return $lastnum [ 0 ] ;

}

switch ( $mode) {
	case 'edit' :
		{
			$filename = $mainpath . $fileid ;
			
			if (file_exists ( $filename ))
				$pdata = get_meta_tags ( $filename ) ; else
				echo "alert('File not found '.$filename.')" ;
			break ;
		}
	case 'save' :
		{
			
			$filename = $mainpath . $opnumber . "_" . $pyear . "-" . $pmonth . "-" . $md . ".opb" ;
			
			if (! file_exists ( $filename )) {
				$path = "op/abteilung/" . strtolower ( $dept ) . "/op_saal_" . strtolower ( $saal ) . "/opbuch/template.opb" ;
				$template = get_meta_tags ( $path ) ;
				$pdata = $template ;
			} else {
				$template = get_meta_tags ( $filename ) ;
			}
			
			$file = fopen ( $filename, "w+" ) ;
			if ($file) {
				reset ( $template ) ;
				reset ( $_POST ) ;
				while ( list ( $k, $v ) = each ( $_POST ) ) {
					$template [ $k ] = addcslashes ( $v, "\n\r" ) ;
					$pdata [ $k ] = $v ;
				}
				
				$buf = explode ( " ", $_POST [ 'pname' ] ) ;
				if (strstr ( $_POST [ 'pname' ], "," )) {
					$template [ 'nname' ] = str_replace ( ",", "", $buf [ 0 ] ) ;
					$template [ 'vname' ] = $buf [ 1 ] ;
				} else {
					if (sizeof ( $buf ) > 0) {
						$template [ 'nname' ] = $buf [ 1 ] ;
						$template [ 'vname' ] = $buf [ 0 ] ;
					} else {
						$template [ 'nname' ] = $buf [ 0 ] ;
					}
				}
				
				reset ( $template ) ;
				while ( list ( $k, $v ) = each ( $template ) ) {
					$line = '<meta name="' . $k . '" content="' . $v . '">' ;
					fputs ( $file, $line ) ;
					fputs ( $file, "\r\n" ) ;
				}
				
				fclose ( $file ) ;
				$gotoid = $pdata [ 'patnumber' ] ;
			} else
				die ( "fail" ) ;
			
			break ;
		}
	default :
		{
			$path = "op/abteilung/" . strtolower ( $dept ) . "/op_saal_" . strtolower ( $saal ) . "/opbuch/" . $pyear . "/" . $monat [ ( int ) $pmonth - 1 ] . "/" . $md . "/" ;
			$handle = opendir ( $path ) ;
			while ( false !== ($file = readdir ( $handle )) ) {
				$v = strpos ( $file, "_" ) ;
				if ($file != "." && $file != ".." && $v != 0) {
					if (strstr ( $file, ".opb" ) != false)
						$filetitles [] = strtolower ( $file ) ;
				}
			}
			if (sizeof ( $filetitles ) > 0) {
				array_multisort ( $filetitles, SORT_DESC ) ;
				$filetitles = explode ( "_", $filetitles [ 0 ] ) ;
				$filetitles [ 0 ] += 1 ;
				if ($filetitles [ 0 ] < 10)
					$filetitles [ 0 ] = "0" . $filetitles [ 0 ] ;
				$pdata [ 'opnumber' ] = $filetitles [ 0 ] ;
			} else {
				$pdata [ 'opnumber' ] = (getlastnum ( $pyear, $pmonth, $pday ) + 1) ;
				if ($pdata [ 'opnumber' ] < 10)
					$pdata [ 'opnumber' ] = "0" . $pdata [ 'opnumber' ] ;
				//			$mode="fresh";
			

			}
			$filename = $mainpath . $pdata [ 'opnumber' ] . "_" . $pyear . "-" . $pmonth . "-" . $md . ".opb" ;
			$gotoid = "bot" ;
		}

}

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php
html_rtl ( $lang ) ;
?>
<HEAD>
<?php
echo setCharSet () ;
?>
 <TITLE>OP Pflege Logbuch (Eingabefenster)</TITLE>

<script language="javascript">

function isnum(val,idx)
{
	xdoc=document.oppflegepatinfo;
	if (isNaN(val))
	{
		xval3="";
		for(i=0;i<val.length;i++)
		{
		xval2=val.slice(i,i+1);
		if (!isNaN(xval3 + xval2)) {xval3=xval3 + xval2;}
		}
		xdoc.elements[idx].value=xval3;

	}
	else
	{
		v3=val;
		if((v3==24)&&(v3.length==2)) v3="00";
		if (v3>24) 
		{

		
			switch(v3.length)
			{
			
				case 2: v1=v3.slice(0,1); v2=v3.slice(1,2);
						if(v2<6) v3="0"+v1+"."+v2; else v3=v3.slice(0,1); break;
				case 3: v1=val.slice(0,2); v2=val.slice(2,3);

						if(v2<6) v3=v1+"."+v2; 
							else v3=v3.slice(0,2);
						break;
				case 4: v3=val.slice(0,3); break;
			}
			
			
//			alert("Zeitangabe ist ungültig! (ausserhalb des 24H Zeitrahmens)");
	
		}
		switch(v3.length)
			{
				
				case 2: v1=v3.slice(0,1);v2=v3.slice(1,2);
						if(v2==".") v3="0"+v3;break;
		
				case 3: v1=v3.slice(0,2);v2=v3.slice(2,3);
						if(v2!=".") if(v2<6) v3=v1+"."+v2; else v3=v1; break;
				case 4: if(v3.slice(3,4)>5) v3=v3.slice(0,3); break;
			}
		if(v3.length>5) v3=v3.slice(0,v3.length-1);
		xdoc.elements[idx].value=v3;
	}
	
}
	
function isvalnum(val,idx)
{
	xdoc=document.oppflegepatinfo;

		xval3="";
		for(i=0;i<val.length;i++)
		{
		xval2=val.slice(i,i+1);
		if (!isNaN(xval2)) 
			{
				xval3=xval3 + xval2;
				if (xval3.length>8) 
				{ 
				alert("Die Aufnahmenummer hat maximal 8 Ziffern!"); 
				xdoc.elements[idx].value=xval3.slice(0,8);
				return; }
			}
		}
		xdoc.elements[idx].value=xval3;
}

function isgdatum(val,idx)
{
	xdoc=document.oppflegepatinfo;

		xval3="";
		for(i=0;i<val.length;i++)
		{
		xval2=val.slice(i,i+1);
		if ((!isNaN(xval2))||(xval2=="."))
			{
				if(xval2==".")
				{
				 if(val.length>1) xval3=xval3+xval2;
				}
				else 
				{
					 xval3=xval3+xval2;					
				}
			}
		}
		switch (xval3.length)
		{
			case 2: v1=xval3.slice(0,1);
					v2=xval3.slice(1,2);
					if(v2==".")
					{
						if (v1=0) xval3=""; else xval3="0"+xval3;
					}
					else {
					if ((v1+v2)<1) xval3=""; 
						else if ((v1+v2)>31) xval3="0"+v1+"."+v2; 
							
					}
					 break;
			case 3: v1=xval3.slice(0,2);
					v2=xval3.slice(2,3);
					if (v2!=".") xval3=v1+"."+v2; 
					break;
			case 4: v1=xval3.slice(0,3);
					v2=xval3.slice(3,4);
					if (v2!=".") xval3=v1+v2; else xval3=v1;
					break;
			case 5: v1=xval3.slice(0,3);
					v2=xval3.slice(3,4);
					v3=xval3.slice(4,5);
					if (v3==".")
					{
						if (v2==0) xval3=v1+v2; 
							else xval3=v1+"0"+v2+v3;
					}
					else if((v2+v3)<1) xval3=v1+v2;
						else if((v2+v3)>12) xval3=v1+"0"+v2+"."+v3;
					break;
			case 6: v1=xval3.slice(0,5);
					v2=xval3.slice(5,6);
					if (v3!=".")
					{
						if (v2==0) xval3=v1 
							else xval3=v1+"."+v2;
					}
					break;
		}
 	if ((xval3.length>6)&&(xval3.slice(xval3.length-1,xval3.length)=="."))xval3=xval3.slice(0,xval3.length-1);
	if (xval3.length>10) xval3=xval3.slice(0,10);
	xdoc.elements[idx].value=xval3;

}

function checksubmit()
{

	xdoc=document.oppflegepatinfo;
	if (xdoc.pname.value=="")
	{
		if (xdoc.gdatum.value=="")
		{
			alert("Der Name & das Geburtsdatum fehlen!");
		}
		else	alert("Der Name fehlt!");
		xdoc.pname.focus(); return false;
	}
	else
	{
	  	if (xdoc.gdatum.value=="")
		{
			alert("Das Geburtsdatum fehlt!");
			xdoc.gdatum.focus(); return false;
		}
	}
	
	if (xdoc.patnumber.value=="")
	{
		react=confirm("Die Aufnahmenummer fehlt! Möchten Sie trotzdem speichern?!");	
		xdoc.patnumber.focus();
		return react;
	}
}

</script>

 <?php
	if ($cfg [ 'dhtml' ]) {
		echo ' 

	<STYLE TYPE="text/css">
	A:link  {text-decoration: none; color: ' . $cfg [ 'body_txtcolor' ] . ';}
	A:hover {text-decoration: underline; color: ' . $cfg [ 'body_hover' ] . ';}
	A:active {text-decoration: none; color: ' . $cfg [ 'body_alink' ] . ';}
	A:visited {text-decoration: none; color: ' . $cfg [ 'body_txtcolor' ] . ';}
	A:visited:active {text-decoration: none; color: ' . $cfg [ 'body_alink' ] . ';}
	A:visited:hover {text-decoration: underline; color: ' . $cfg [ 'body_hover' ] . ';}
	</style>' ;
	}
	?>
</HEAD>

<BODY background="../img/gray2.jpg" topmargin=0 leftmargin=0
	marginwidth=0 marginheight=0 onLoad="if (window.focus) window.focus();"> 
<?php
if ($mode == 'save')
	echo 'window.opener.location.reload(true);window.close()' ;
echo '"' ;
//echo  ' bgcolor='.$cfg['body_bgcolor']; 
if (! $cfg [ 'dhtml' ]) {
	echo ' link=' . $cfg [ 'body_txtcolor' ] . ' alink=' . $cfg [ 'body_alink' ] . ' vlink=' . $cfg [ 'body_txtcolor' ] ;
}
?>
  >

<TABLE CELLPADDING=0 CELLSPACING=0 border=0 width=100%>
	<TR>
		<TD bgcolor=navy><FONT COLOR="white" SIZE=3 face=verdana,arial> <b>OP
		Logbuch Eingabefenster</b></FONT></TD>
		<td align=right bgcolor="navy"><a href="#"><FONT COLOR="white" SIZE=3
			face=verdana,arial> Andere Funktionen</a> &nbsp; Hilfe &nbsp; <a
			href="#"
			onClick="window.parent.opener.focus(); window.parent.close();"><FONT
			COLOR="white" SIZE=3 face=verdana,arial>Schliessen</a></td>
	</TR>
</TABLE>

<FORM METHOD="post" ACTION="op-pflege-logbuch-arch-edit.php?mode=save"
	name="oppflegepatinfo" onSubmit="return checksubmit()"><input
	type="hidden" name="processer"
	value="<?php
	echo $op_pflegelogbuch_user ;
	?>"> <input type="hidden"
	name="opnumber" value="<?php
	echo $pdata [ 'opnumber' ] ;
	?>"> <input
	type="hidden" name="pmonth" value="<?php
	echo $pmonth ;
	?>"> <input
	type="hidden" name="pyear" value="<?php
	echo $pyear ;
	?>"> <input
	type="hidden" name="pday" value="<?php
	echo $pday ;
	?>"> <input
	type="hidden" name="user"
	value="<?php
	echo str_replace ( " ", "+", $user ) ;
	?>"> <input type="hidden"
	name="sid" value="<?php
	echo $sid ;
	?>"> <input type="hidden"
	name="saal" value="<?php
	echo $saal ;
	?>"> <input type="hidden"
	name="dept" value="<?php
	echo $dept ;
	?>"> <font face=verdana,arial
	size=2>OP Nummer <FONT face=arial COLOR="red" SIZE=3> <b><?php
	echo $pdata [ 'opnumber' ] ;
	?></b>
</FONT>
Datum: 

<?php
if (($mode != "") && ($mode != "fresh")) {
	echo '<font size=2 face=arial><b>' . $pdata [ 'date' ] . '</b></font>' ;
	echo "\r\n" ;
	echo '<input name="date" type="hidden" value="' . $pdata [ 'date' ] . '">' ;
} else {
	echo '<INPUT NAME="date" TYPE="text" VALUE="' . strftime ( "%d.%m.%Y" ) . '" SIZE="10">' ;
	echo "\r\n" ;
}
?>

&nbsp;
&nbsp; <!-- 
<a href="op-pflege-logbuch-arch-edit.php?mode=fresh&filename=<?php
echo $filename . '&pyear=' . date ( Y ) . '&pmonth=' . date ( m ) . '&pday=' . date ( d ) ;
?>"><img src="../img/newpat2.gif" border=0></a>
 -->
<TABLE CELLPADDING=1 CELLSPACING=0 border=1 bgcolor=#dddddd>
	<tr>
		<TD><font face=verdana,arial size=1> AufnahmeNr: <INPUT
			NAME="patnumber" TYPE="text"
			VALUE="<?php
			echo $pdata [ 'patnumber' ] ;
			?>"
			onKeyUp="isvalnum(this.value,this.name)" SIZE="9"> Name, Vorname<br>
		<INPUT NAME="pname" TYPE="text"
			VALUE="<?php stripcslashes($pdata['pname']);
			?>" SIZE="20"><BR>
		Geburtsdatum<br>
		<INPUT NAME="gdatum" TYPE="text"
			VALUE="<?php 
			echo $pdata [ 'gdatum' ] ;
			?>" SIZE="20"
			onKeyUp="isgdatum(this.value,this.name)"><BR>
		Addresse<br>
		<TEXTAREA NAME="addresse" Content-Type="text/html" COLS="17" ROWS="4"><?php
		echo stripcslashes ( $pdata [ 'addresse' ] ) ;
		?></TEXTAREA></TD>

		<TD><font face=verdana,arial size=1>Diagnose:<br>
		<TEXTAREA NAME="diagnose" Content-Type="text/html" COLS="18" ROWS="10"><?php
		echo stripcslashes ( $pdata [ 'diagnose' ] ) ;
		?></TEXTAREA></TD>

		<TD valign=top><font face=verdana,arial size=1>Operateur/Assistent<br>
		<TEXTAREA NAME="opdoc1" Content-Type="text/html" COLS="17" ROWS="4"><?php
		echo stripcslashes ( $pdata [ 'opdoc1' ] ) ;
		?></TEXTAREA><br>
		Instrumenteur/Springer<br>
		<TEXTAREA NAME="instru1" Content-Type="text/html" COLS="17" ROWS="4"><?php
		echo stripcslashes ( $pdata [ 'instru1' ] ) ;
		?></TEXTAREA></TD>

		<TD valign=top><font face=verdana,arial size=1>Narkoseart<br>
		<select NAME="narkose" SIZE="1">
			<option value=ITN
				<?php
				if ($pdata [ 'narkose' ] == "ITN")
					echo "selected" ;
				?>>ITN</option>
			<option value=LA <?php
			if ($pdata [ 'narkose' ] == "LA")
				echo "selected" ;
			?>>LA</option>
			<option value=DS <?php
			if ($pdata [ 'narkose' ] == "DS")
				echo "selected" ;
			?>>DS</option>
			<option value=Plexus
				<?php
				if ($pdata [ 'narkose' ] == "Plexus")
					echo "selected" ;
				?>>Plexus</option>
			<option value=Standy
				<?php
				if ($pdata [ 'narkose' ] == "Standby")
					echo "selected" ;
				?>>Standby</option>
			<option value="X">...</option>
		</select> <BR>
		Anästhesist<br>
		<TEXTAREA NAME="anadoc1" Content-Type="text/html" COLS="17" ROWS="2"><?php
		echo stripcslashes ( $pdata [ 'anadoc1' ] ) ;
		?></TEXTAREA>
		<p>
		
		
		<table cellpadding="0" cellspacing="0" border=0 width=100%>
			<tr>
				<td><font face=verdana,arial size=1> Schnitt:<br>
				<INPUT NAME="schnitt1" TYPE="text"
					VALUE="<?php
					echo $pdata [ 'schnitt1' ] ;
					?>" SIZE="6"
					onKeyUp="isnum(this.value,this.name)"> <BR>
				Naht:<br>
				<INPUT NAME="naht1" TYPE="text"
					VALUE="<?php
					echo $pdata [ 'naht1' ] ;
					?>" SIZE="6"
					onKeyUp="isnum(this.value,this.name)"></td>
				<td><font face=verdana,arial size=1> Einschleusen:<br>
				<INPUT NAME="ein1" TYPE="text" VALUE="<?php
				echo $pdata [ 'ein1' ] ;
				?>"
					SIZE="6" onKeyUp="isnum(this.value,this.name)"> <BR>
				Ausschleusen:<br>
				<INPUT NAME="aus1" TYPE="text" VALUE="<?php
				echo $pdata [ 'aus1' ] ;
				?>"
					SIZE="6" onKeyUp="isnum(this.value,this.name)"></td>
			</tr>
		</table></TD>



		<TD><font face=verdana,arial size=1>Therapie/OP<br>
		<TEXTAREA NAME="therapie" Content-Type="text/html" COLS="17" ROWS="10"><?php
		echo stripcslashes ( $pdata [ 'therapie' ] ) ;
		?></TEXTAREA></TD>


		<TD><font face=verdana,arial size=1>Ausgang<br>
		<TEXTAREA NAME="ausgang1" Content-Type="text/html" COLS="17" ROWS="10"><?php
		echo stripcslashes ( $pdata['ausgang1']); ?></TEXTAREA></TD>




	</TR>



</TABLE>
<p>


<ul>
	<input type="image" src="../img/save.gif" border=0>
	<p><a href="#" onClick="window.close()"><img src="../img/close.gif"
		border=0 width=103 height=24></a>

</ul></FORM>

</BODY>
</HTML>
