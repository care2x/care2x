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
<?php
if($mask==2)
{
?>
<frameset rows="25,*" border=0>
  <frameset cols="9%,*" border=0>
    <frame name="STARTPAGE" src="main/indexframe.php?boot=1&lang=<?php echo "$lang&egal=$egal&cookie=$cookie&sid=$sid" ?>&mask=2">
    <frame name="MENUBAR" src="main/menubar2.php" scrolling=no>
  </frameset>
 <!--  <frame name="CONTENTS" src=""> -->
  
<?php
}
else
{
?>
<frameset cols="<?php echo $GLOBALCONFIG['gui_frame_left_nav_width'] ?>,*" 
	border="<?php echo $GLOBALCONFIG['gui_frame_left_nav_border'] ?>" >
	<FRAME MARGINHEIGHT="5"	MARGINWIDTH  ="5" NAME = "STARTPAGE" SRC = "main/indexframe.php?boot=1&mask=<?php echo "$mask&lang=$lang&cookie=$cookie&sid=$sid" ?>" SCROLLING="auto"  >
<?php
}
?>
	<FRAME NAME = "CONTENTS" SRC = "blank.php?lang=<?php echo "$lang&sid=$sid&root_path=" ?>">
</frameset>
<noframes>
<BODY bgcolor=white>
<?php echo $LDNoFrame ?><BR>
<A HREF="contents.htm"> OK</A></BODY>
</noframes>

</HTML>
