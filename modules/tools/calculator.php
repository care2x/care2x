<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','specials.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');
$breakfile=$root_path."main/spediens.php".URL_APPEND;

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDCalc);

# href for return button
 $smarty->assign('pbBack',$breakfile);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('calculator.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDCalc);

# Buffer page output

ob_start();
?>


<CENTER>
<FORM name="Keypad" action="">

<TABLE border=2 width=50 height=60 cellpadding=1 cellspacing=5>
<TR>
<TD colspan=3 align=middle>
<input name="ReadOut" type="Text" size=24 value="0" width=100%>
</TD>
<TD
</TD>
<TD>
<input name="btnClear" type="Button" value="  C  " onclick="Clear()">
</TD>
<TD><input name="btnClearEntry" type="Button" value="  CE " onclick="ClearEntry()">
</TD>
</TR>
<TR>
<TD>
<input name="btnSeven" type="Button" value="  7  " onclick="NumPressed(7)">
</TD>
<TD>
<input name="btnEight" type="Button" value="  8  " onclick="NumPressed(8)">
</TD>
<TD>
<input name="btnNine" type="Button" value="  9  " onclick="NumPressed(9)">
</TD>
<TD>
</TD>
<TD>
<input name="btnNeg" type="Button" value=" +/- " onclick="Neg()">
</TD>
<TD>
<input name="btnPercent" type="Button" value="  % " onclick="Percent()">
</TD>
</TR>
<TR>
<TD>
<input name="btnFour" type="Button" value="  4  " onclick="NumPressed(4)">
</TD>
<TD>
<input name="btnFive" type="Button" value="  5  " onclick="NumPressed(5)">
</TD>
<TD>
<input name="btnSix" type="Button" value="  6  " onclick="NumPressed(6)">
</TD>
<TD>
</TD>
<TD align=middle><input name="btnPlus" type="Button" value="  +  " onclick="Operation('+')">
</TD>
<TD align=middle><input name="btnMinus" type="Button" value="   -   " onclick="Operation('-')">
</TD>
</TR>
<TR>
<TD>
<input name="btnOne" type="Button" value="  1  " onclick="NumPressed(1)">
</TD>
<TD>
<input name="btnTwo" type="Button" value="  2  " onclick="NumPressed(2)">
</TD>
<TD>
<input name="btnThree" type="Button" value="  3  " onclick="NumPressed(3)">
</TD>
<TD>
</TD>
<TD align=middle><input name="btnMultiply" type="Button" value="  *  " onclick="Operation('*')">
</TD>
<TD align=middle><input name="btnDivide" type="Button" value="   /   " onclick="Operation('/')">
</TD>
</TR>
<TR>
<TD>
<input name="btnZero" type="Button" value="  0  " onclick="NumPressed(0)">
</TD>
<TD>
<input name="btnDecimal" type="Button" value="   .  " onclick="Decimal()">
</TD>
<TD colspan=3>
</TD>
<TD>
<input name="btnEquals" type="Button" value="  =  " onclick="Operation('=')">
</TD>
</TR>
</TABLE>

</B>
</FORM>
</CENTER>

<SCRIPT LANGUAGE="javascript" src="<?php  echo $root_path ?>js/calculator.js"></SCRIPT>

</td>
<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign page output to the mainframe template

$smarty->assign('sMainFrameBlockData',$sTemp);
 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
