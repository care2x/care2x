<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE><?php echo $LDManagePriceList;; ?> - </TITLE>
<meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
<meta name="Author" content="Robert Meggle">
<meta name="Generator" content="various: Quanta, AceHTML 4 Freeware, NuSphere, PHP Coder">
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

  	<script language="javascript" >
<!--
function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php<?php echo URL_APPEND; ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->

</script>
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<script language="javascript" src="../../js/hilitebu.js"></script>

<STYLE TYPE="text/css">
A:link  {color: #000066;}
A:hover {color: #cc0033;}
A:active {color: #cc0000;}
A:visited {color: #000066;}
A:visited:active {color: #cc0000;}
A:visited:hover {color: #cc0033;}
.csvtable {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 9px;
	background-color: #C9C994;
	border: thin dotted #996600;
}
</style>
<script language="JavaScript">
<!--
function popPic(pid,nm){

 if(pid!="") regpicwindow = window.open("../../main/pop_reg_pic.php?sid=887dbee085487a55605a5120412992dd&lang=$lang&pid="+pid+"&nm="+nm,"regpicwin","toolbar=no,scrollbars,width=180,height=250");

}
// -->
</script>
</HEAD>
<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066 onLoad="document.suchform.keyword.select()" >
<table width="102%" border="0" cellspacing="0" >
  <tbody class="main">
	<tr>
		<td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border="0">
 				<tr valign=top  class="titlebar" >
 					<td bgcolor="#99ccff" >
    					&nbsp;&nbsp;<font color="#330066"><?php echo $LDManagePriceList; ?></font>
    				</td>
       			    <td bgcolor="#99ccff" align=right>
       			    	<a href="javascript:window.history.back()">
       			    		<img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" >
       			    	</a>
       			    	<a href="javascript:gethelp('pharmacy_product_edit.php','Pharmacy :: My Product Catalog :: Search')">
       			    		<img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)">
       			    	</a>
       			    	<a href="pharmacy_tz_product_catalog.php" >
       			    		<img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)">
       			    	</a>
   					</td>
			 </tr>
 			</table>
 		</td>
	</tr>
	<tr>
      <td height="321" valign=top bgcolor=#ffffff>
      	  <ul>
          <p> <br>
          <form action="magage_pricelist.php" method="post" name="manage" enctype="multipart/form-data">
            <table border="0" cellspacing="2" cellpadding="3">
              <tr bgcolor=#ffffdd>
                <td colspan=2> <FONT color="#800000"><?php echo $LDSelectPriceList_description; ?></font> <br> <p> </td>
              </tr>

              <tr bgcolor=#ffffdd>
                <td width="1">&nbsp; </td>
                <td width="544" align=right>
                  <div align="right">
                    <input type="file" name="filename" value="nopic" size="60" length="200">
                  </div>
                </td>
              </tr>

              <tr bgcolor=#ffffdd>
                <td width="1">&nbsp; </td>
                <td width="544" align=right>
                  <div align="right">
                    <input type="hidden" name="test" value ="test">
                    <input type="submit" value="open" size="60" length="200" >
                  </div>
                </td>
              </tr>

            </table>
          </form>

          <hr>

          </p>
          <table width="100%" border="1" cellpadding="0" cellspacing="0" class="csvtable">
            <caption>
              <strong><?php echo $LDStoredPriceList_header;?></strong>
            </caption>
            <tr>
              <th width="60" bgcolor="#999933" scope="col"><p><?php echo $column0;?></p></th>
              <th width="60" bgcolor="#999933" scope="col"><p><?php echo $column1;?></p></th>
              <th width="60" bgcolor="#999933" scope="col"><p><?php echo $column2;?></p></th>
              <th width="60" bgcolor="#999933" scope="col"><p><?php echo $column3;?></p></th>
              <th width="60" bgcolor="#999933" scope="col"><p><?php echo $column4;?></p></th>
              <th width="60" bgcolor="#999933" scope="col"><p><?php echo $column5;?></p></th>
              <th width="60" bgcolor="#999933" scope="col"><p><?php echo $column6;?></p></th>
              <th width="60" bgcolor="#999933" scope="col"><p><?php echo $column7;?></p></th>
              <th width="60" bgcolor="#999933" scope="col"><p><?php echo $column8;?></p></th>
              <th width="100" bgcolor="#999933" scope="col"><p><?php echo $column9;?></p></th>
              <th width="100" bgcolor="#999933" scope="col"><p><?php echo $column10;?></p></th>
              <th width="64" bgcolor="#999933" scope="col"><p><?php echo $column11;?></p></th>
              <th width="64" bgcolor="#999933" scope="col"><p><?php echo $column12;?></p></th>
              <th width="64" bgcolor="#999933" scope="col"><p><?php echo $column13;?></p></th>
              <th width="70" bgcolor="#999933" scope="col"><p><?php echo $column14;?></p></th>
            </tr>
            <tr>
              <th bgcolor="#999933" scope="col"><div align="left"></div></th>
              <th bgcolor="#999933" scope="col"><div align="left"></div></th>
              <th bgcolor="#999933" scope="col"><div align="left"></div></th>
              <th bgcolor="#999933" scope="col"><div align="left"></div></th>
              <th bgcolor="#999933" scope="col"><div align="left"></div></th>
              <th bgcolor="#999933" scope="col"><div align="left"></div></th>
              <th bgcolor="#999933" scope="col"><div align="left"></div></th>
              <th bgcolor="#999933" scope="col"><div align="left"></div></th>
              <th bgcolor="#999933" scope="col"><div align="left"></div></th>
              <th bgcolor="#999933" scope="col"><div align="left"></div></th>
              <th bgcolor="#999933" scope="col"><div align="left"></div></th>
              <th bgcolor="#999933" scope="col"><div align="left"></div></th>
              <th bgcolor="#999933" scope="col"><div align="left"></div></th>
              <th bgcolor="#999933" scope="col"><div align="left"></div></th>
              <th bgcolor="#999933" scope="col"><div align="left"></div></th>
            </tr>
            
			<?php showPriceListTable(); ?>
          
          </table>
          <hr>
      	  </ul>
	  </td>
	</tr>
	<tr valign=top >
	  <td>&nbsp;</td>
	  <td>
	<tr>
      <td bgcolor=#ffffff><hr></td>
	  </td>
	</tr>
	</tbody>
 </table>
</BODY>
</HTML>