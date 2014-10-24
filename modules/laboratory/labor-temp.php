<?php if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$$ck_sid_buffer)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require("../language/".$lang."/lang_".$lang."_lab.php");
require_once($root_path.'include/core/inc_config_color.php');

$breakfile=$root_path.'main/startframe.php'.URL_APPEND;

setcookie(firstentry,"");
setcookie(ck_op_dienstplan_user,"");
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript" >
<!-- 
function closewin()
{
	location.href='startframe.php?sid=<?php echo "$sid&lang=$lang";?>';
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script> 
 
<?php 
require($root_path.'include/core/inc_js_gethelp.php');
require($root_path.'include/core/inc_css_a_hilitebu.php');
?><SCRIPT language="JavaScript" src="../js/sublinker-nd.js">
</SCRIPT>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0  
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0" >
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo $LDOr ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  class="fadeOut" >';?></a>
<a href="javascript:gethelp('submenu1.php','OR - Operation Room')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'class="fadeOut" >';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'class="fadeOut" >';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>

<ul>
<img src="../img/<?php echo "$lang/$lang" ?>_arzt2.gif" border=0  alt="<?php echo $LDDoctor ?>">
  <TABLE cellSpacing=0 cellPadding=0 width=600 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=600 bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>> 
				 <a href="op-doku-pass.php?sid=<?php echo "$sid&lang=$lang" ?>" onmouseover="ssm('ALog'); clearTimeout(timer) " 
      onmouseout="timer=setTimeout('hsm()',1000)" ><?php echo $LDOrDocument ?></a>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDOrDocumentTxt ?></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B> 
   				<img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>  
				<a href="doctors-shift-fastview.php?sid=<?php echo "$sid&lang=$lang" ?>&retpath=op"><?php echo "$LDDutyPlan $LDQuickview" ?></a></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDQviewTxtDocs ?></nobr></FONT></TD></TR>
              
<!--               <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>  <a href="#" onmouseover="ssm('ADienstplan'); clearTimeout(timer) " 
      onmouseout="timer=setTimeout('hsm()',1000)">Dienstplan</a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2>Dienstplan erstellen, ansehen, verarbeiten, u.s.w.</FONT></TD></TR> -->
              
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>

<p>
<img src="../img/<?php echo "$lang/$lang" ?>_pflege2.gif" border=0  height=24 alt="<?php echo $LDNursing ?>">
 <TABLE cellSpacing=0 cellPadding=0 width=600 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=600 bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>  
				 <a href="labor_datasearch_pass.php?<?php echo "sid=$sid&lang=$lang" ?>&route=validroute"><?php echo $LDSeeLabData  ?></a><br>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDSeeLabData  ?></FONT></TD>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B> 
   				<img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>  
				<a href="labor_datainput_pass.php?<?php echo "sid=$sid&lang=$lang" ?>"><?php echo $LDEnterLabData ?></a></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDEnterLabData ?></nobr></FONT></TD></TR>
              
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>> 
				 <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDEnterPrioParams ?>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDEnterPrioParams ?></nobr></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>> 
				 <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDEnterNorms ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDEnterNorms ?></FONT></TD></TR>
				  <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				<img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>
				<a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDOtherOptions ?></a></nobr>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDOtherOptions ?></nobr></FONT></TD></TR>
				  <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				<img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>
				<a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDMemo ?></a></nobr>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDMemo ?></nobr></FONT></TD></TR>
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>

<p>
<img src="../img/<?php echo "$lang/$lang" ?>_anaes.gif" border=0  height=24 alt="<?php echo $LDAna ?>">
 <TABLE cellSpacing=0 cellPadding=0 width=600 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=600 bgColor=#999999 
            border=0>
              <TBODY>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B><nobr>
				 <img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>  <a href="ucons.php" onmouseover="ssm('AnaLog'); clearTimeout(timer) " 
      onmouseout="timer=setTimeout('hsm()',1000)" ><?php echo "$LDOr $LDAnaLogBook" ?></a><br>
				  </nobr></B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDAnaLogBookTxt ?></FONT></TD>
                           
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>  
				<a href="op-pflege-dienst-schnellsicht.php?sid=<?php echo "$sid&lang=$lang" ?>&retpath=menu&hilitedept=anaesth"><?php echo $LDQuickView ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><nobr><?php echo $LDQviewTxtAna ?></nobr></FONT></TD></TR>
              <TR bgColor=#dddddd height=1>
                <TD colSpan=2><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR bgColor=#eeeeee>
                <TD vAlign=top width=180><FONT 
                  face="Verdana,Helvetica,Arial" size=2><B>
				<img <?php echo createComIcon($root_path,'blaupfeil.gif','0','middle') ?>>  
				<a href="op-pflege-dienstplan.php?sid=<?php echo "$sid&lang=$lang" ?>&dept=anaesth&retpath=menu" onmouseover="ssm('AnaDienstplan'); clearTimeout(timer) " 
      onmouseout="timer=setTimeout('hsm()',1000)" ><?php echo $LDDutyPlan ?></a>
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" 
                  size=2><?php echo $LDDutyPlanTxt ?></FONT></TD></TR>
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>
		<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  alt="<?php echo $LDCloseAlt ?>" align="middle"></a>

<p>
</ul>


</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
require($root_path.'include/core/inc_load_copyrite.php');
?>
</td>
</tr>
</table>        
&nbsp;




</FONT>

<DIV id=PLog
style=" VISIBILITY: hidden; POSITION: absolute; ">
<TABLE cellSpacing=1 cellPadding=0 bgColor=#000000 border=0 >

  <TR height=20>
    <TD>
      <TABLE cellSpacing=1 cellPadding=5 width="100%" bgColor=#dddddd 
        border=0><TBODY>
        <TR>
          <TD bgColor=#ffffff><font face=arial,verdana size=2><nobr>
		  <A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-logbuch-pass.php<?php echo URL_APPEND; ?>"><?php echo $LDNewDocu ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-logbuch-such-pass.php<?php echo URL_APPEND; ?>"><?php echo $LDSearch ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-logbuch-arch-pass.php<?php echo URL_APPEND; ?>"><?php echo $LDArchive ?></A></nobr><BR></TD></TR></TABLE></TD></TR></TBODY></TABLE>
			</DIV>

<DIV id=PProgram
style=" VISIBILITY: hidden; POSITION: absolute; ">
<TABLE cellSpacing=1 cellPadding=0 bgColor=#000000 border=0 >

  <TR height=20>
    <TD>
      <TABLE cellSpacing=1 cellPadding=5 width="100%" bgColor=#dddddd 
        border=0><TBODY>
        <TR>
          <TD bgColor=#ffffff><font face=arial,verdana size=2><nobr>
		  <A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDSee ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDUpdate ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDCreate ?></A></nobr><BR></TD></TR></TABLE></TD></TR></TBODY></TABLE>
			</DIV>
<DIV id=PDienstplan
style=" VISIBILITY: hidden; POSITION: absolute;  ">
<TABLE cellSpacing=1 cellPadding=0 bgColor=#000000 border=0 >

  <TR height=20>
    <TD>
      <TABLE cellSpacing=1 cellPadding=5 width="100%" bgColor=#dddddd 
        border=0><TBODY>
        <TR>
          <TD bgColor=#ffffff><font face=arial,verdana size=2><nobr>
		  <A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-dienstplan.php<?php echo URL_APPEND; ?>&retpath=menu"><?php echo $LDSee ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-dienstplan-pass.php?sid=<?php echo $$ck_sid_buffer.'&pmonth='.date(m); ?>&retpath=menu"><?php echo "$LDCreate/$LDUpdate" ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-dienst-personalliste-pass.php<?php echo URL_APPEND; ?>&ipath=menu"><?php echo $LDCreatePersonList ?></A></nobr></TD></TR></TABLE></TD></TR></TBODY></TABLE>
			</DIV>
<DIV id=ALog
style=" VISIBILITY: hidden; POSITION: absolute;  ">
<TABLE cellSpacing=1 cellPadding=0 bgColor=#000000 border=0 >

  <TR height=20>
    <TD>
      <TABLE cellSpacing=1 cellPadding=5 width="100%" bgColor=#dddddd 
        border=0><TBODY>
        <TR>
          <TD bgColor=#ffffff><font face=arial,verdana size=2><nobr>
		  <A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-doku-pass.php<?php echo URL_APPEND; ?>&target=entry"><?php echo $LDNewDocu ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-doku-pass.php<?php echo URL_APPEND; ?>&target=search"><?php echo $LDSearch ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-doku-pass.php<?php echo URL_APPEND; ?>&target=archiv"><?php echo $LDArchive ?></A></nobr><BR></TD></TR></TABLE></TD></TR></TBODY></TABLE>
			</DIV>
			
<DIV id=ADienstplan
style=" VISIBILITY: hidden; POSITION: absolute;  ">
<TABLE cellSpacing=1 cellPadding=0 bgColor=#000000 border=0 >

  <TR height=20>
    <TD>
      <TABLE cellSpacing=1 cellPadding=5 width="100%" bgColor=#dddddd 
        border=0><TBODY>
        <TR>
          <TD bgColor=#ffffff><font face=arial,verdana size=2><nobr>
		  <A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-logbuch-pass.php<?php echo URL_APPEND; ?>"><?php echo $LDSee ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-logbuch-such-pass.php<?php echo URL_APPEND; ?>"><?php echo $LDUpdate ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-logbuch-arch-pass.php<?php echo URL_APPEND; ?>"><?php echo $LDCreate ?></A></nobr><BR></TD></TR></TABLE></TD></TR></TBODY></TABLE>
			</DIV>
			
			
<DIV id=AnaLog
style=" VISIBILITY: hidden; POSITION: absolute; ">
<TABLE cellSpacing=1 cellPadding=0 bgColor=#000000 border=0 >

  <TR height=20>
    <TD>
      <TABLE cellSpacing=1 cellPadding=5 width="100%" bgColor=#dddddd 
        border=0><TBODY>
        <TR>
          <TD bgColor=#ffffff><font face=arial,verdana size=2><nobr>
		  <A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-logbuch-pass.php<?php echo URL_APPEND; ?>"><?php echo $LDNewDocu ?> 
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-logbuch-such-pass.php<?php echo URL_APPEND; ?>"><?php echo $LDSearch ?> 
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-logbuch-arch-pass.php<?php echo URL_APPEND; ?>"><?php echo $LDArchive ?></A></nobr><BR></TD></TR></TABLE></TD></TR></TBODY></TABLE>
			</DIV>

<DIV id=AnaDienstplan
style=" VISIBILITY: hidden; POSITION: absolute; ">
<TABLE cellSpacing=1 cellPadding=0 bgColor=#000000 border=0 >

  <TR height=20>
    <TD>
      <TABLE cellSpacing=1 cellPadding=5 width="100%" bgColor=#dddddd 
        border=0><TBODY>
        <TR>
          <TD bgColor=#ffffff><font face=arial,verdana size=2><nobr>
		  <A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-dienstplan.php<?php echo URL_APPEND; ?>&dept=anaesth"><?php echo $LDSee ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-dienstplan-pass.php?sid=<?php echo $$ck_sid_buffer.'&pmonth='.date(m); ?>&dept=anaesth&retpath=menu"><?php echo $LDUpdate ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-dienstplan-pass.php<?php echo URL_APPEND; ?>&dept=anaesth&retpath=menu"><?php echo $LDCreate ?></A></nobr><BR></TD></TR></TABLE></TD></TR></TBODY></TABLE>
			</DIV>
			
</BODY>
</HTML>
