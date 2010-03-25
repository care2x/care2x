<?php

if ($rt!="optimeinput") {header("Location: invalid-access-warning.php"); exit;};

$pdata=array();
$template=array();

switch ($mode)
{
	case 'save':
	{
		if (file_exists($filename)) $pdata=get_meta_tags($filename);
		$file=fopen($filename,"w+");
		if($file)
		{
			while(list($k,$v)=each($_POST))
			{
				$pdata[$k]=$v;
			}
			reset($pdata);
			while(list($k,$v)=each($pdata))
			{
				$pdata[$k]=$v;
				$line='<meta name="'.$k.'" content="'.$v.'">';
				fputs($file,$line);fputs($file,"\r\n");
			}
		fclose($file);
		}
		else { $mode="";}
	}
	default:
	{
		if (file_exists($filename)) $pdata=get_meta_tags($filename);
	}
}
?>

<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE>Eingabefenster für die Kurve</TITLE>
<META name="description" content="">
<META name="keywords" content="">
<META name="generator" content="CuteHTML">

<script language="javascript">
<!-- 
  function resetinput(){
	document.infoform.neuedaten.value="";
	document.infoform.neuedaten.focus();
	}

function resettimebars()
{
	window.opener.parent.OPLOGIMGBAR.location.replace('oplogtimebar.php?filename=<?php echo $filename; ?>');
	window.opener.top.focus();
	window.focus();
}

function checkform()
{

}

function isnum(val,idx)
{
	xdoc=document.timeform;;
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
	
-->
</script>

<STYLE type=text/css>
div.box { border: double; border-width: thin; width: 100%; border-color: black; }
</style>

</HEAD>
<BODY  background=img/gray2.jpg TEXT="#000000" LINK="#0000FF" VLINK="#800080" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0
onLoad="if (window.focus) window.focus();<?php if ($mode=='save') echo 'resettimebars();'; if($scope==3) echo 'window.resizeTo(600,500)'; else echo 'window.resizeTo(450,500)';?>" >

<table width=100% cellspacing="0" cellpadding="3" border=0>
<tr>
<td bgcolor="navy" align=right>
<font face=arial size=2 >
<?php
$thisurl="op-pflege-logbuch-poptimeinput.php?rt=optimeinput&filename=";

if($scope==1) echo '<font color=silver>Ein/Aus &nbsp;</font>';
	else echo '<a href="'.$thisurl.$filename.'&scope=1"><font color=white>Ein/Aus</a> &nbsp;</font>';
if($scope==2) echo '<font color=silver>Schnitt/Naht &nbsp;</font>';
	else echo '<a href="'.$thisurl.$filename.'&scope=2"><font color=white>Schnitt/Naht</a> &nbsp;</font>';
if($scope==3) echo '<font color=silver>Wartezeit &nbsp;</font>';
	else echo '<a href="'.$thisurl.$filename.'&scope=3"><font color=white>Wartezeit</a> &nbsp;</font>';
if($scope==4) echo '<font color=silver>Gipsen &nbsp;</font>';
	else echo '<a href="'.$thisurl.$filename.'&scope=4"><font color=white>Gipsen</a> &nbsp;</font>';
if($scope==5) echo '<font color=silver>Reposition &nbsp;</font>';
	else echo '<a href="'.$thisurl.$filename.'&scope=5"><font color=white>Reposition</a> &nbsp;</font>';


?>
</td>
</tr>
<tr>
<td >

<font face=verdana,arial size=4 color=maroon>
<b>
Zeiteingabe
</b>
</font>
<p>
<ul>

<form method="post" name="timeform" action="op-pflege-logbuch-poptimeinput.php?mode=save&rt=optimeinput&scope=<?php echo $scope; ?>&filename=<?php echo $filename; ?>" onSubmit=checkform()>

<font face=verdana,arial size=2>
<?php if (($scope==1)||($scope==0))
{
	echo '<font face=verdana,arial size=5 color=navy ><b>Ein-/Ausschleusen:</b></font><br>';
	for ($n=1;$n<10;$n++)
	{
		echo '<b>'.$n.'</b> Ein <input align=right type="text" size=5 size=5 value="'.$pdata['ein'.$n].'" name=ein'.$n.' onKeyUp="isnum(this.value,this.name)"> 
				Aus <input type="text" size=5 value="'.$pdata['aus'.$n].'" name=aus'.$n.' onKeyUp="isnum(this.value,this.name)"><br> ';
		echo "\r\n";
	}
}

if (($scope==2)||($scope==0))
{
	echo '<p><font face=verdana,arial size=5 color=navy ><b>Schnitt/Naht:</b></font><br>';
	for ($n=1;$n<10;$n++)
	{
		echo '<b>'.$n.'</b> Schnitt <input type="text" size=5 size=5 value="'.$pdata['schnitt'.$n].'" name=schnitt'.$n.' onKeyUp="isnum(this.value,this.name)"> Naht <input type="text" size=5 value="'.$pdata['naht'.$n].'" name=naht'.$n.' onKeyUp="isnum(this.value,this.name)"><br> ';
		echo "\r\n";
	}
}


										
if (($scope==3)||($scope==0))
{
echo '<p><font face=verdana,arial size=5 color=navy ><b>Wartezeit:</b></font><br>';
	for ($n=1;$n<10;$n++)
	{
		echo '<b>'.$n.'</b> Start <input type="text" size=5 size=5 value="'.$pdata['bwarte'.$n].'" name=bwarte'.$n.' onKeyUp="isnum(this.value,this.name)"> Ende <input type="text" size=5 value="'.$pdata['ewarte'.$n].'" name=ewarte'.$n.' onKeyUp="isnum(this.value,this.name)"> Grund: <input type="text" size=35 value="'.$pdata['warte'.$n.'grund'].'" name=warte'.$n.'grund><br> ';
		echo "\r\n";
	}
}

if (($scope==4)||($scope==0))
{
echo '<p><font face=verdana,arial size=5 color=navy ><b>Gipsen:</b></font><br>';
	for ($n=1;$n<10;$n++)
	{
		echo '<b>'.$n.'</b> Start <input type="text" size=5 size=5 value="'.$pdata['bgips'.$n].'" name=bgips'.$n.' onKeyUp="isnum(this.value,this.name)"> Ende <input type="text" size=5 value="'.$pdata['egips'.$n].'" name=egips'.$n.' onKeyUp="isnum(this.value,this.name)"><br> ';
		echo "\r\n";
	}
}

if (($scope==5)||($scope==0))
{
echo '<p><font face=verdana,arial size=5 color=navy ><b>Reposition:</b></font><br>';
	for ($n=1;$n<10;$n++)
	{
		echo '<b>'.$n.'</b> Start <input type="text" size=5 size=5 value="'.$pdata['brepos'.$n].'" name=brepos'.$n.' onKeyUp="isnum(this.value,this.name)"> Ende <input type="text" size=5 value="'.$pdata['erepos'.$n].'" name=erepos'.$n.' onKeyUp="isnum(this.value,this.name)"><br> ';
		echo "\r\n";
	}
}

?>

</font><p>
<input type="image" src=../img/save.gif border=0 alt="Zeitangaben speichern.">
</form>

<a href="#" onClick="window.close()"><img src="../img/close.gif" border="0" alt="Dieses Fenster schliessen" align="right">
</a><p>
<a href="#" onClick="document.timeform.reset()"><img src="../img/verwerf.gif" border="0" alt="Eingaben verwerfen (Zuvor gespeicherte Eingaben bleiben)" align="right"></a>
</ul>

<?php if((($scope==1)||($scope==2))&&($mode=='save')) 
								echo '<script language=javascript>
										window.opener.parent.OPLOGMAIN.location.reload();
										window.opener.parent.LOGINPUT.location.reload();
										window.opener.top.focus();
										window.focus();
										</script>';
?>

</td>
</tr>
</table>
</BODY>

</HTML>
