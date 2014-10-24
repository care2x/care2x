<?php html_rtl($lang); ?>
<HEAD>
<?php 
echo setCharSet(); 
?>
 <TITLE><?php echo $LDMainTitle ?></TITLE>

 <!-- <TITLE>CARE 2002 Integrated Hospital Information System</TITLE> -->
<meta name="Description" content="Virtual Integrated Information System of a Hospital powered by CARE 2002">
<meta name="Author" content="Elpidio Latorilla">
<meta name="Generator" content="AceHTML 4 Freeware">
</HEAD>


<frameset cols="*,19%" border=0>
<FRAME NAME = "CONTENTS" SRC = "blank.php?lang=<?php echo "$lang&sid=$sid" ?>&mask=2">
<frameset rows="*" border=0>
<frame name="STARTPAGE" src="main/indexframe.php?boot=1&lang=<?php echo "$lang&egal=$egal&cookie=$cookie&sid=$sid" ?>">
</frameset></frameset>


<noframes>
<BODY bgcolor=white>
<?php echo $LDNoFrame ?><BR>
<A HREF="contents.htm">OK</A></BODY>
</noframes>

</HTML>
