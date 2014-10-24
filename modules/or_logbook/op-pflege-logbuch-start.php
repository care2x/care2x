<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
define('LANG_FILE','or.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');

if (!$internok&&!$_COOKIE['ck_op_pflegelogbuch_user'.$sid]) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
      <title><?php echo "$dept $LDOr $LDLOGBOOK" ?></title>
<?php echo setCharSet(); ?>
</HEAD>

<frameset rows="83%,*" border=0>
  <frameset rows="53%,*">
<?php if(($mode!="")) : ?>
    <frame name= "OPLOGMAIN"  src="<?php //echo 'oplogmain.php?gotoid='.$patnum.'&op_nr='.$op_nr.'&dept='.$dept.'&saal='.$saal.'&pyear='.$pyear.'&pmonth='.$pmonth.'&pday='.$pday; ?>" >
    <frame name="LOGINPUT"  src="<?php echo "oploginput.php?sid=$sid&lang=$lang&internok=$internok&mode=$mode&enc_nr=$enc_nr&op_nr=$op_nr&dept_nr=$dept_nr&saal=$saal&thisday=$thisday";?>">
  </frameset>
  <frameset cols="15%,*">
    <frame name= "OPLOGINPUT"  SRC = "">
    <frame name="OPLOGIMGBAR" src="">
  </frameset>

<?php else : ?>
    <frame name= "OPLOGMAIN"  src="blank.htm" >
    <frame name="LOGINPUT"  src="oploginput.php?sid=<?php echo "$sid&lang=$lang&internok=$internok&dept_nr=$dept_nr&saal=$saal" ?>">
  </frameset>
  <frameset cols="15%,*">
    <frame name= "OPLOGINPUT"  SRC = "blank.htm">
    <frame name="OPLOGIMGBAR" src="blank.htm">
  </frameset>
 <?php endif ?>
<noframes>
<BODY BACKGROUND="#ffffff" onLoad="if (window.focus) window.focus()">


</body>
</noframes>
</frameset>
</HTML>
