<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
	<TITLE> <?php echo $LDBillingInsurance; ?></TITLE>
	<meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
	<meta name="Author" content="Timo Hasselwander, Robert Meggle">
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
</style>
<script language="JavaScript">
<!--
function popPic(pid,nm){

 if(pid!="") regpicwindow = window.open("../../main/pop_reg_pic.php?sid=6ac874bb63e983fd6ec8b9fdc544cab5&lang=$lang&pid="+pid+"&nm="+nm,"regpicwin","toolbar=no,scrollbars,width=180,height=250");

}
// -->
</script>

<script language="javascript">

<!--
function closewin()
{
	location.href='startframe.php?sid=6ac874bb63e983fd6ec8b9fdc544cab5&lang=$lang';
}
// -->
</script>

<script language="javascript">
<!--
function saveData()
{
    document.forms["inputform"].submit();
}
function reset()
{
    document.forms["inputform"].submit();
}
-->
</script>

<link rel="StyleSheet" href="dtree.css" type="text/css" />
<script type="text/javascript" src="dtree.js"></script>

<script type="text/javascript">
<?php
		require($root_path.'include/inc_checkdate_lang.php');
?>
</script>
<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/dtpick_care2x.js"></script>


</HEAD>
<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066>
<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">
	<tr>
		<td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border=0>
          <tr valign=top  class="titlebar" >
            <td bgcolor="#99ccff" >
                &nbsp;&nbsp;<font color="#330066"><?php echo $LDPrescrWard; ?></font>
       </td>
  <td bgcolor="#99ccff" align=right><a
   href="javascript:window.history.back()"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a><a
   href="javascript:gethelp('insurance_companies_overview.php','Administrative Companies :: Overview')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href="pharmacy_tz_pass.php?ntid=false&lang=$lang" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>  </td>
 </tr>

 </table>		</td>
	</tr>

	</td></tr>
	</form>
	<tr>
		<td bgcolor=#ffffff valign=top>

		<table cellpadding=20>
		<tr valign=top>

		<!-- left side (list of insurances) -->
		<td>
		<form method="GET" name="inputform" action="" >
			<table cellpadding=5 ><font color=#000000>


			<th bgcolor=#ffff66>wards</th>
			<?php

			/* The following routine creates the list of insurances on the left side:  */

			require($root_path.'include/inc_ward_lister.php');

			?>



			</table>

		</td>
		<?php include_once($root_path.'include/inc_date_format_functions.php');

			if (isset($_GET['prescr_date']))
			{
				$prescr_date = $_GET['prescr_date'];
				//echo 'Datum gesetzt: '.$prescr_date;

			}
			else
			{
				$prescr_date = formatDate2Local(date('Y-m-d'),$date_format);


			}

		?>


		<!-- right side (form) -->
		<td valign="top">

		<table cellSpacing=1  width=600  cellpadding=3>
		<TBODY class="submenu">
<tr class="titlebar" bgcolor=#ffffff colspan="2"><td align="center"><font color=#000000><?php echo $prescr_date ?></font></td></tr>

		<tr>
                    <td class="submenu_item"><?php echo $LDPrescrWithoutServices?></td>
                    <td class="submenu_item"><?php echo $LDDosage?></td>

         </tr>

		<?php



			$coreObjOuter = new Core;

			$sqlOuter = "select * from care_encounter where current_ward_nr=$ward_nr and is_discharged=0";

			$coreObjOuter->result = $db->Execute($sqlOuter);

			//foreach ($coreObjOuter->result as $rowEncounter){

			//select *, sum(dosage) from care_encounter_prescription INNER JOIN care_tz_drugsandservices ON care_tz_drugsandservices.item_id=care_encounter_prescription.article_item_number where encounter_nr in(2009000011, 2009000012) and purchasing_class='drug_list' group by article_item_number order by article

			$crit = '(';

			foreach ($coreObjOuter->result as $rowEncounter){

				$encounterNr = $rowEncounter['encounter_nr'];
				if ($crit=='(')
						$crit .= $encounterNr;
				else
						$crit .= ', '.$encounterNr;


			}

			$crit .= ')';


			$dateSQL = substr($prescr_date, 6,4).'-'.substr($prescr_date, 3,2).'-'.substr($prescr_date, 0,2);

			$crit .= " and prescribe_date = '$dateSQL' ";


				echo '<TR  height=1>
                        <TD colSpan=2 class="vspace"><IMG height=1 src="../../gui/img/common/default/pixel.gif" width=5></TD>
                      </TR>';


				//echo '<tr>';

				//data person
				//$pid = $rowEncounter['pid'];
				//echo '<td>'.$pid.'</td>';

				/*
				$sqlPerson = "select * from care_person where pid=$pid";
				$coreObjInner->result = $db->Execute($sqlPerson);
				$rowPerson = $coreObjInner->result->FetchRow();
				$name_last =  $rowPerson['name_last'];
				$name_first = $rowPerson['name_first'];
				*/

				//echo '<td>'.$name_last.', '.$name_first.'</td>';


				//encounter nr
				//$encounterNr = $rowEncounter['encounter_nr'];
				//echo 'Encounter nr: '.$encounterNr.'<br> ';


				//SELECT * FROM care_encounter_prescription INNER JOIN care_tz_drugsandservices ON care_tz_drugsandservices.item_id=care_encounter_prescription.article_item_number
				//where encounter_nr='2009000077' and purchasing_class='drug_list'

				//alt:
				//$sqlInner = "SELECT * FROM care_encounter_prescription where encounter_nr = $encounterNr";

				//data prescription(s) per encounter nr
				$sqlInner = "select *, sum(dosage) from care_encounter_prescription INNER JOIN care_tz_drugsandservices ON care_tz_drugsandservices.item_id=care_encounter_prescription.article_item_number " .
						"where encounter_nr in $crit and purchasing_class='drug_list' group by article_item_number order by article";



				//echo $sqlInner;

				$coreObjInner->result = $db->Execute($sqlInner);

				$prescr = '';

				foreach ($coreObjInner->result as $rowPrescr){

					$prescr .= '<tr><td>';


					$article = $rowPrescr['article'];
					$dosage  = $rowPrescr['sum(dosage)'];
					//$times_per_day = $rowPrescr['times_per_day'];
					//$notes =$rowPrescr['notes'];


					//$prescr .= $article.'</td><td>'.$dosage.'</td><td>'.$times_per_day.'</td><td>'.$notes;
					$prescr .= $article.'</td><td>'.$dosage;
					$prescr .= '</td></tr>';

					$prescr .= '<TR  height=10><TD colSpan=2 class="vspace"><IMG height=1 src="../../gui/img/common/default/pixel.gif" width=5></TD>
                      </TR>';




				}
				if ($prescr == '')
					$prescr .= '<td>&nbsp;</td><td>&nbsp;</td></tr>';

				echo $prescr;

//}



?>

		<tr><td>&nbsp;</td></tr>
		<tr><td colspan=2><font color=#FF0000><?php echo $errorMess?>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>

		<tr><td>



		<input name="prescr_date" type="text" size="15" maxlength=10 value="<?php

		{
			echo $prescr_date;

		}
 ?>"
 				onFocus="this.select();"
				onBlur="IsValidDate(this,'dd/MM/yyyy')"
				onKeyUp="setDate(this,'dd/MM/yyyy','en');">
				<a href="javascript:show_calendar('inputform.prescr_date','dd/MM/yyyy')">
				<img <?php echo createComIcon($root_path,'show-calendar.gif','0','absmiddle'); ?>></a>


				<font size=1>[
<?php
					$dfbuffer="LD_".strtr($date_format,".-/","phs");
					echo $$dfbuffer;
?>
				 ] </font><br>




		<?php

		/*if (!$status)
			{
				echo '<input height="21" border="0" width="76" type="image" name="clear" value="clear" onClick="reset()" alt="clear" src="../../gui/img/control/blue_aqua/en/en_reset.gif"/>';
			}
			else
				echo '<br><br>';

				*/
			?>
			</td><td>
			<input type="submit" value="show" name="name">
  			<!--<input height="21" border="0"  width="76" type="image" name="save" value="save" onClick="saveData()" alt="Save data" src="../../gui/img/control/blue_aqua/en/en_savedisc.gif"/>-->
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="pharmacy_tz_pass.php?ntid=false&lang=$lang" ><img src="../../gui/img/control/blue_aqua/en/en_close2.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
		</td></tr>




		</td></tr>
		<tr><td>&nbsp;</td></tr>



		</tr>

		</table>
		<input type="hidden" name="insurance_ID" value=<?php echo $insurance_ID?>>
		<input type="hidden" name="status" value="<?php echo $status?>">

		<input type="hidden" name="name_old" value='<?php echo $name?>'>
		<input type="hidden" name="max_pay_old" value=<?php echo $max_pay?>>
		<input type="hidden" name="id_insurer_old" value=<?php echo $id_insurer?>>

		<input type="hidden" name="contact_person_old" value='<?php echo $contact_person?>'>
		<input type="hidden" name="po_box_old" value='<?php echo $po_box?>'>
		<input type="hidden" name="city_old" value='<?php echo $city?>'>
		<input type="hidden" name="phone_old" value='<?php echo $phone?>'>
		<input type="hidden" name="email_old" value='<?php echo $email?>'>
		</td>

		</tr>

		</table>
			<?php/* if (!$status)
			{
				echo '<input height="21" border="0" align="absmiddle" width="76" type="image" name="clear" value="clear" onClick="reset()" alt="clear" src="../../gui/img/control/blue_aqua/en/en_reset.gif"/><br><br>';
			}
			else
				echo '<br><br>';
				*/
			?>

  			<!--<input height="21" border="0" align="absmiddle" width="76" type="image" name="save" value="save" onClick="saveData()" alt="Save data" src="../../gui/img/control/blue_aqua/en/en_savedisc.gif"/>-->

			</p>
			<a href="pharmacy_tz_pass.php?ntid=false&lang=$lang" ><img src="../../gui/img/control/blue_aqua/en/en_close2.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>

		</form>

		</blockquote>
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
	    <div class="copyright">
<script language="JavaScript">
<!-- Script Begin
function openCreditsWindow() {

	urlholder="../../language/$lang/$lang_credits.php?lang=$lang";
	creditswin=window.open(urlholder,"creditswin","width=500,height=600,menubar=no,resizable=yes,scrollbars=yes");

}
//  Script End -->
</script>


 <a href="http://www.care2x.org" target=_new>CARE2X 2nd Generation pre-deployment 2.0.2</a> :: <a href="../../legal_gnu_gpl.htm" target=_new> License</a> ::
 <a href=mailto:info@care2x.org>Contact</a>  :: <a href="../../language/en/en_privacy.htm" target="pp"> Our Privacy Policy </a> ::
 <a href="../../docs/show_legal.php?lang=$lang" target="lgl"> Legal </a> ::
 <a href="javascript:openCreditsWindow()"> Credits </a> ::.<br>

</div>
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