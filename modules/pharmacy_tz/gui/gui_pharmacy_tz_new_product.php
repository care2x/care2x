<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE><?php echo $LDPharmacyDBNewProduct; ?> - </TITLE>
  <meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
  <meta name="Author" content="Robert Meggle">
  <meta name="Generator" content="various: Quanta, AceHTML 4 Freeware, NuSphere, PHP Coder">
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

  	<script language="javascript" >
<!--
function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php?sid=<?php echo $sid."&lang=".$lang;?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->

</script>
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<script language="javascript" src="../../js/hilitebu.js"></script>

<STYLE TYPE="text/css">
<!--
A:link  {color: #000066;}
A:hover {color: #cc0033;}
A:active {color: #cc0000;}
A:visited {color: #000066;}
A:visited:active {color: #cc0000;}
A:visited:hover {color: #cc0033;}
.product_table {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
}

// .class_classification {
}
.classification {
	font-family: Arial, Helvetica, sans-serif;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: none;
	border-right-style: dotted;
	border-bottom-style: none;
	border-left-style: none;
}
.product_price {
	font-family: Arial, Helvetica, sans-serif;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: dotted;
	border-right-style: none;
	border-bottom-style: dotted;
	border-left-style: none;
}
-->
</style>

</HEAD>
<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066>

<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">
	<tr>
		<td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
  <td bgcolor="#99ccff" >
    &nbsp;&nbsp;<font color="#330066"><?php echo $LDPharmacyProcuctCatalog; ?></font>
       </td>
  <td bgcolor="#99ccff" align=right><a
   href="javascript:window.history.back()"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a><a
   href="javascript:gethelp('<?php echo $help_file ?>','<?php echo $src ?>')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href="../../modules/pharmacy_tz/pharmacy_tz.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>  </td>
 </tr>
 </table>		</td>
	</tr>

	<tr>
		<td bgcolor=#ffffff valign=top>


<font class="prompt"><?php if (!$ERROR) echo $MSG; ?>&nbsp;</font>

<font class="warnprompt">
                              <?php if ($ERROR) echo $ERROR_MSG?><br>
                              <?php if ($DELETE_FORM) echo "WARNING! If you press OK, this item with code \"".$selian_item_number."\" will be deleted!<br>"?>
</font>

<form ENCTYPE="multipart/form-data" action="pharmacy_tz_new_product.php" method="get" name="inputform">


	      <table border=0 cellspacing=1 cellpadding=3 class="product_table">
            <tbody class="submenu">
              <tr>
                <td align=right width=103><?php echo $LDPediatric; ?> </td>
                <td align=right width=30 class="classification">
                <input type="checkbox" name="is_peadric" <?php if (!empty($is_peadric)) echo "checked";?> <?php echo $html_disabler;?>></td>
                <td align=right width=32 >&nbsp;</td>
                <td align=right width=145 >
                                           <?php if ($ERROR_SELIAN_ITEM_NUMBER) echo '<font color="red">';?>
                                              <?php echo $LDSelianItemNumber; ?>
                                           <?php if ($ERROR_SELIAN_ITEM_NUMBER) echo '</font>';?>                </td>
                <td width="594"><input type="text" name="selian_item_number" value="<?PHP echo $selian_item_number;?>" <?php echo $html_disabler;?> size=20 maxlength=20></td>
                <td width="7" rowspan=16 valign=top> <br>                </td>
              </tr>
	      <tr>
              <td align=right width=103><?php echo $LDAdultList; ?></td>
                <td width=30 align=right class="classification"><input type="checkbox" name="is_adult" <?php if (!empty($is_adult)) echo "checked";?> <?php echo $html_disabler;?>></td>
                <td align=right width=32>&nbsp;</td>
                <td align=right width=145><?php echo $LDPartCode; ?></td>
                <td><input type="text" name="part_code" value="<?php echo $part_code;?>" <?php echo $html_disabler;?> size=40 maxlength=40>
                  <?php echo $LDForInventory; ?></td>
              </tr>
              <tr>
                <td align=right width=103><?php echo $LDOther; ?></td>
                <td width=30 align=right class="classification"><input type="checkbox" name="is_other" <?php if (!empty($is_other)) echo "checked";?> <?php echo $html_disabler;?>></td>
                <td align=right width=32>&nbsp;</td>
                <td align=right width=145><?php echo $LDPackSize; ?></td>
                <td><input type="text" name="pack_size" value="<?php echo $pack_size;?>" <?php echo $html_disabler;?> size=40 maxlength=40>
                  <?php echo $LDForAddInformation; ?></td>
              </tr>
              <tr>
                <td align=right>&nbsp;</td>
                <td align=right class="classification">&nbsp;</td>
                <td align=right>&nbsp;</td>
                <td align=right>
                                          <?php if ($ERROR_SELIANS_ITEM_DESCRIPTION) echo '<font color="red">';?>
                                            <?php echo $LDSeliansItemDesc; ?></td>
                                          <?php if ($ERROR_SELIANS_ITEM_DESCRIPTION) echo '</font>';?>
                <td><input type="text" name="selians_item_description" value="<?php echo $selians_item_description;?>" <?php echo $html_disabler;?> size=40 maxlength=60>
                  <?php echo $LDWilBeShown; ?></td>
              </tr>
              <tr>
                <td align=right width=103>&nbsp;</td>
                <td width=30 align=right class="classification">&nbsp;</td>
                <td align=right width=32>&nbsp;</td>
                <td width=145 align=right class="product_price"><p><?php echo $LDFullDescItem; ?></p>
                <p><?php echo $LDJustForInternalUse; ?></p></td>
                <td class="product_price"><textarea name="items_full_description" cols=35 rows=4 <?php echo $html_disabler;?>><?php echo $items_full_description?></textarea></td>
              </tr>
              <tr>
                <td align=right width=103>&nbsp;</td>
                <td width=30 align=right class="classification">&nbsp;</td>
                <td align=right width=32>&nbsp;</td>
                <td align=right width=145><p><?php echo $LDItemClassification; ?></p>                  </td>
                <td><?php

                if ($html_disabler) {
                          echo $item_classification;
                      } else { ?>
                  <select name="purchasing_class">
		    <option selected value=""></option>
                    <option value="drug_list" <?PHP if ($item_classification=="drug_general") echo "selected";?>>drug general</option>
                    <option value="drug_list_ctc" <?PHP if ($item_classification=="drug_ctc") echo "selected";?>>drug ctc</option>
                    <option value="drug_list_nhif" <?PHP if ($item_classification=="drug_nhif") echo "selected";?>>drug nhif</option>
                    <option value="supplies" <?PHP if ($item_classification=="supplies") echo "selected";?>>supplies</option>
                    <option value="supplies_laboratory" <?PHP if ($item_classification=="supplies lab.") echo "selected";?>>supplies Laboratory</option>
                    <option value="special_others_list" <?PHP if ($item_classification=="special others") echo "selected";?>>special others</option>
                    <option value="xray" <?PHP if ($item_classification=="x-ray") echo "selected";?>>x-ray</option>
                    <option value="service" <?PHP if ($item_classification=="service") echo "selected";?>>service</option>
                    <option value="dental" <?PHP if ($item_classification=="dental services") echo "selected";?>>dental services</option>
                    <option value="minor_proc_op" <?PHP if ($item_classification=="minor proc op") echo "selected";?>>minor proc op</option>
                    <option value="obgyne_op" <?PHP if ($item_classification=="obgyne op") echo "selected";?>>obgyne op</option>
		    <option value="ortho_op" <?PHP if ($item_classification=="ortho op") echo "selected";?>>ortho op</option>
                    <option value="surgical_op" <?PHP if ($item_classification=="surgical op") echo "selected";?>>surgical op</option>
                    <option value="labtest" <?PHP if ($item_classification=="labtest") echo "selected";?>>labtest</option>
					<option value="eye-service" <?PHP if ($item_classification=="eye-service") echo "selected";?>>Eye Service</option>
					<option value="eye-surgery" <?PHP if ($item_classification=="eye-surgery") echo "selected";?>>Eye Surgery</option>
					<option value="eye-glasses" <?PHP if ($item_classification=="eye-glasses") echo "selected";?>>Eye Glasses</option>

                  </select>
                  <?php } ?></td>
              </tr>

		 <tr>
                <td align=right>&nbsp;</td>
                <td align=right class="classification">&nbsp;</td>
                <td align=right>&nbsp;</td>
                <td align=right><?php echo $LDItemSubCategory; ?></td>
                <td><p>
                    <input type="text" name="item_subclass" value="<?php echo $item_subclass;?>" <?php echo $html_disabler;?> size=20 maxlength=40>
                </tr>


              <tr>
                <td align=right>&nbsp;</td>
                <td align=right class="classification">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>

              <tr>
                <td align=right width=103>&nbsp;</td>
                <td width=30 align=right class="classification">&nbsp;</td>
                <td align=right width=32>&nbsp;</td>
                <td align=right class="product_price"><?php echo $LDSeliansPriceItem; ?></td>
                <td class="product_price"><p>
                    <input type="text" name="selians_item_price" value="<?php echo $selians_item_price;?>" <?php echo $html_disabler;?> size=20 maxlength=40>
                    <?php echo $short_1; ?></p>
                    <p>
                      <input type="text" name="selians_item_price_1" value="<?php echo $selians_item_price_1;?>" <?php echo $html_disabler;?> size=20 maxlength=40>
                      <?php echo $short_2; ?></p>
                  <p>
                      <input type="text" name="selians_item_price_2" value="<?php echo $selians_item_price_2;?>" <?php echo $html_disabler;?> size=20 maxlength=40>
                      <?php echo $short_3; ?></p>
                  <p>
                      <input type="text" name="selians_item_price_3" value="<?php echo $selians_item_price_3;?>" <?php echo $html_disabler;?> size=20 maxlength=40>
                      <?php echo $short_4; ?></p>


                  <p>
                      <input type="text" name="selians_item_price_4" value="<?php echo $selians_item_price_4;?>" <?php echo $html_disabler;?> size=20 maxlength=40>
                      <?php echo $short_5; ?></p>

                  <p>
                      <input type="text" name="selians_item_price_5" value="<?php echo $selians_item_price_5;?>" <?php echo $html_disabler;?> size=20 maxlength=40>
                      <?php echo $short_6; ?></p>

                  <p>
                      <input type="text" name="selians_item_price_6" value="<?php echo $selians_item_price_6;?>" <?php echo $html_disabler;?> size=20 maxlength=40>
                      <?php echo $short_7; ?></p>

                      </td>
              </tr>
              <tr>
                <td align=right width=103>&nbsp;</td>
                <td width=30 align=right class="classification">&nbsp;</td>
                <td align=right width=32>&nbsp;</td>
                <td align=right width=145>&nbsp;</td>
                <td align=right>

                <?php if ($GO_BACK_TO_SEARCH)
                          echo '<input type="hidden" name="GO_BACK_TO_SEARCH" value="TRUE">';
                          echo '<input type="hidden" name="keyword" value="'.$keyword.'">';
                          echo '<input type="hidden" name="formular_sent" value="true">';
                          if (isset($selian_item_number))
                            echo '<input type="hidden" name="item_id" value="'.$item_id.'">';
                ?>

                <?php if ($html_disabler) {
                          echo "&nbsp;";
                          if ($DELETE_FORM) {
                            echo '<input type="hidden" name="mode" value="delete">';
                          }
                      } else {
                        if ($UPDATE_FORM)  {
                        ?>
                        <input type="hidden" name="mode" value="update">
                        <?php
                        } else {
                        ?>
                          <?php echo $LDPrepareThisDatasetFor; ?>
                            <select name="mode">
                              <option value="insert" selected><?php echo $LDInsert; ?></option>
                              <option value="delete"><?php echo $LDDelete; ?></option>
                              <option value="update"><?php echo $LDUpdate; ?></option>
                            </select>
                        <?php } ?>
                <?php } ?>
				        <input type="hidden" name="lang" value="en">

                <input type="submit" value="<?php echo $LDOK; ?>">                </td>
              </tr>
            </tbody>
          </table>
  </form>

<a href="../../modules/pharmacy_tz/pharmacy_tz.php"><img src="../../gui/img/control/default/en/en_cancel.gif" border=0 align="left" width="103" height="24" alt="Go back to databank menu"></a>
		</td>
	</tr>


		<tr valign=top >
		<td bgcolor=#cccccc>
							<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#cfcfcf">
<tr>
<td align="center">
  <table width="100%" bgcolor="#ffffff" cellspacing=0 cellpadding=5>
   <tr>
   	<td>
	    <div class="copyright"></div>
	    </td>
   <tr>
  </table>
</td>
</tr>
</table>
					</td>

	</tr>

	</tbody>
 </table>

</BODY>
</HTML>
