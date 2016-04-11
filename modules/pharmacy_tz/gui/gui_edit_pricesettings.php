<?php
/*
 * Created on 25.06.2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE> - </TITLE>
 <meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
<meta name="Author" content="Robert Meggle">
<meta name="Generator" content="various: Quanta, AceHTML 4 Freeware, NuSphere, PHP Coder">
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

  	<script language="javascript" >
<!--
function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php?sid=<?php $sid ?>&lang=<?php $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<script language="javascript" src="../../js/hilitebu.js"></script>

<style type="text/css">

<!--

	.table_content {
	            border: 1px solid #000000;
	}

	.tr_content {
		        border: 1px solid #000000;
	}

	.td_content {
	border: 1px solid #000000;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	}
p {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
}

	.headline {
	            background-color: #CC9933;
	            border-top-width: 1px;
	            border-right-width: 1px;
	            border-bottom-width: 1px;
	            border-left-width: 1px;
	            border-top-style: solid;
	            border-right-style: solid;
	            border-bottom-style: solid;
	            border-left-style: solid;
	}
	A:link  {color: #000066;}
	A:hover {color: #cc0033;}
	A:active {color: #cc0000;}
	A:visited {color: #000066;}
	A:visited:active {color: #cc0000;}
	A:visited:hover {color: #cc0033;}
-->
</style>


<script language="JavaScript">
<!--
function popPic(pid,nm){

 if(pid!="") regpicwindow = window.open("../../main/pop_reg_pic.php?sid=<?php echo $sid."&lang=".$lang;?>&pid="+pid+"&nm="+nm,"regpicwin","toolbar=no,scrollbars,width=180,height=250");

}
// -->
</script>


</HEAD>
<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066  >
<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">

	<tr>
	  <td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
  <td bgcolor="#99ccff" >
    &nbsp;&nbsp;<font color="#330066"><?php echo $LDPharmacyProductCatalog; ?></font>
       </td>
  <td bgcolor="#99ccff" align=right><a
   href="javascript:window.history.back()"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a><a
   href="javascript:gethelp('pharmacy_product_menu.php','Pharmacy :: My Product Catalog')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href="pharmacy_tz_product_catalog.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>  </td>

 </tr>
 </table>

 <br/>

 <form ENCTYPE="multipart/form-data" action="edit_pricesettings.php" method="POST" name="inputform">
  <table border="1" cellspacing="0" colspacing="0" class="table_content">
    <tr class="headline">
      <th><?php echo $LDPrice_fieldNo;?></th><th><?php echo $LDPrice_ShortDescription;?></th>
      <th><?php echo $LDPrice_LongDescription;?></th>
      <th><img src="<?php echo $root_path;?>/gui/img/common/default/billing.jpg" alt="insruance" width="33" height="27"></th>
    </tr>
    <tr class="tr_content">
      <td class="td_content">1</td>
      <td class="td_content">
  		<input type="text" name="short_1" value="<?php echo $short_1;?>" size="20"/>      </td>
      <td class="td_content"><input type="text" name="long_1" value="<?php echo $long_1;?>" size="40"/></td>
      <td class="td_content"><label>
        <div align="center">
          <input type="checkbox" name="is_insurance" value="1" <?php if ($is_insured_1) echo "checked";?>>
          </div>
      </label></td>
    </tr>
    <tr class="tr_content">
      <td class="td_content">2</td>
      <td class="td_content">
  		<input type="text" name="short_2" value="<?php echo $short_2;?>" size="20"/>      </td>
      <td class="td_content"><input type="text" name="long_2" value="<?php echo $long_2;?>" size="40"/></td>
      <td class="td_content"><div align="center">
        <input type="checkbox" name="is_insurance" value="2" <?php if ($is_insured_2) echo "checked";?>>
      </div></td>
    </tr>
    <tr class="tr_content">
      <td class="td_content">3</td>
      <td class="td_content">
  		<input type="text" name="short_3" value="<?php echo $short_3;?>" size="20"/>      </td>
      <td class="td_content"><input type="text" name="long_3" value="<?php echo $long_3;?>" size="40"/></td>
      <td class="td_content"><div align="center">
        <input type="checkbox" name="is_insurance" value="3" <?php if ($is_insured_3) echo "checked";?>>
      </div></td>
    </tr>
    <tr>
      <td class="td_content">4</td>
      <td class="td_content">
  		<input type="text" name="short_4" value="<?php echo $short_4;?>" size="20"/>      </td>
      <td class="td_content"><input type="text" name="long_4" value="<?php echo $long_4;?>" size="40"/></td>
      <td class="td_content"><div align="center">
        <input type="checkbox" name="is_insurance" value="4" <?php if ($is_insured_4) echo "checked";?>>
      </div></td>
    </tr>




    <tr>
      <td class="td_content">5</td>
      <td class="td_content">
  		<input type="text" name="short_5" value="<?php echo $short_5;?>" size="20"/>      </td>
      <td class="td_content"><input type="text" name="long_5" value="<?php echo $long_5;?>" size="40"/></td>
      <td class="td_content"><div align="center">
        <input type="checkbox" name="is_insurance" value="5" <?php if ($is_insured_5) echo "checked";?>>
      </div></td>
    </tr>


    <tr>
      <td class="td_content">6</td>
      <td class="td_content">
  		<input type="text" name="short_6" value="<?php echo $short_6;?>" size="20"/>      </td>
      <td class="td_content"><input type="text" name="long_6" value="<?php echo $long_6;?>" size="40"/></td>
      <td class="td_content"><div align="center">
        <input type="checkbox" name="is_insurance" value="6" <?php if ($is_insured_6) echo "checked";?>>
      </div></td>
    </tr>


    <tr>
      <td class="td_content">7</td>
      <td class="td_content">
  		<input type="text" name="short_7" value="<?php echo $short_7;?>" size="20"/>      </td>
      <td class="td_content"><input type="text" name="long_7" value="<?php echo $long_7;?>" size="40"/></td>
      <td class="td_content"><div align="center">
        <input type="checkbox" name="is_insurance" value="7" <?php if ($is_insured_7) echo "checked";?>>
      </div></td>
    </tr>

  </table>
  <br>

  <table width="100" align="center">
    <tr>
      <td>
	    <input type="reset"/>
      </td>
      <td widht="50">&nbsp;

      </td>
      <td>
  		<input type="submit" name="submit" value="submit"/>
      </td>
    </tr>

  </table>

  </form>

 <p><strong>legend: </strong></p>
 <table width="484" border="1">
  <tr>
    <th width="104" class="headline" scope="col"><?php echo $LDLegend_Field;?></th>
    <th width="364" class="headline" scope="col"><?php echo $LDLegend_Comment;?></th>
  </tr>
  <tr>
    <td class="td_content"><strong><?php echo $LDPrice_fieldNo;?></strong></td>
    <td class="td_content"><?php echo $LDComment_1;?></td>
  </tr>
  <tr>
    <td class="td_content"><strong><?php echo $LDPrice_ShortDescription;?></strong></td>
    <td class="td_content"><?php echo $LDComment_2;?></td>
  </tr>
  <tr>
    <td class="td_content"><strong><?php echo $LDPrice_LongDescription;?></strong></td>
    <td class="td_content"><?php echo $LDComment_3;?></td>
  </tr>
  <tr>
    <td class="td_content"><img src="<?php echo $root_path;?>gui/img/common/default/billing.jpg" alt="insruance" width="33" height="27"></td>
    <td class="td_content"><?php echo $LDComment_4;?></td>
  </tr>
 </table>
<p><strong><?php echo $LDDetail_headline;?></strong></p>
	  <table width="373" border="1">
        <tr>
          <th width="139" class="headline" scope="col"><?php echo $LDDetail;?></th>
          <th width="218" class="headline" scope="col"><?php echo $LDDetail_Information;?></th>
        </tr>
        <tr>
          <td class="table_content"><div align="right"><?php echo $LDDetail_Last_Change;?></div></td>
          <td class="table_content"><?php echo date("F j, Y, g:i a", $timestamp)?></td>
        </tr>
        <tr>
          <td class="table_content"><div align="right"><?php echo $LDDetail_information;?></div></td>
          <td class="table_content"><?php echo $user;?></td>
        </tr>
      </table>
	  </body>
