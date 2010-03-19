<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta name="AUTHOR" content="Dr. S. B. Bhattacharyya">
<title>Calculating the Commonly Recommended Immunisation Schedule</title>
<STYLE TYPE="text/css">
	A:link  {text-decoration: none; color: #000066;}
	A:hover {text-decoration: underline; color: #cc0033;}
	A:active {text-decoration: none; color: #cc0000;}
	A:visited {text-decoration: none; color: #000066;}
	A:visited:active {text-decoration: none; color: #cc0000;}
	A:visited:hover {text-decoration: underline; color: #cc0033;}
</STYLE>
</HEAD>
<?php 

	// Capture the entered data!
	$do = $_POST["do"];
	$theDay = $_POST["TheDay"];
	$theMonth = $_POST["TheMonth"];
	$theYear = $_POST["TheYear"];
	$theSex = $_POST["TheSex"];

switch ($do)
{
	// if the value of $do is "validate", continue this process
	case "calculate":

		if ( checkdate($theMonth, $theDay, $theYear) == FALSE )
		{
			exitIt("The date entered is NOT a valid one. Try again...");
		}

		include ("im_sch.inc");

		// Format the date into a workable form
		$dobdate = mktime (0, 0, 0, date($theMonth), date($theDay), date($theYear));

		// Get today's date
		$today = time();
		
		// Check whether the date is in future, if so, then ask for another
		if ($today < $dobdate)
		{
			exitIt("Wrong Birth Date");
		}

		// Check for sex and get the proper salutation
		if ($theSex == 1)
		{
			$term="He";
			$termS = "His";
		}
		else
		{
			$term="She";
			$termS = "Her";
		} 

		// BCG date
		$bcgdate = DateAdd("m", 3, $dobdate);

		// OPV dates
		$opv1=DateAdd("d", 2, $dobdate);
		$opv2=DateAdd("d", 45, $opv1);
		$opv3=DateAdd("d", 30, $opv2);
		$opv4=DateAdd("d", 30, $opv3);
		$opv5=DateAdd("d", 30, $opv4);
  
		// Hepatitis B dates
		$hepb1=$opv1;
		$hepb2=DateAdd("m", 1, $hepb1);
		$hepb3=DateAdd("m", 6, $hepb2);
		
		// Hepatitis A dates
		$hepa1=DateAdd("m", 60, $dobdate);
		$hepa2=DateAdd("m", 1, $hepa1);
		$hepa3=DateAdd("m", 6, $hepa1);

		// Measles date
		$measles=DateAdd("m", 9, $dobdate);
  
		// MMR date
		$mmr=DateAdd("m", 15, $dobdate);
		
		// Meningitis date
		$menin=DateAdd("m", 12, $opv1);
		
		// HIB dates
		$hib1=DateAdd("m", 2, $dobdate);
		$hib2=DateAdd("m", 4, $dobdate);
		$hib3=DateAdd("m", 6, $dobdate);
		$hib4=DateAdd("m", 15, $dobdate);
		
		// Typhoid date
		$typh=DateAdd("m", 24, $dobdate);
		
		// Chicken pox date
		$cpox=DateAdd("m", 12, $dobdate);
		
		// Rubella date
		$rubella=DateAdd("m", 144, $dobdate);
  
		// Hepatitis booster dates
		$hepboost1=DateAdd("m", 12, $dobdate);
		$hepboost2=DateAdd("m", 120, $dobdate);
  
		// OPV booster dates
		$opvboost1=DateAdd("m", 18, $dobdate);
		$opvboost2=DateAdd("m", 54, $dobdate);
  
		// Typhoid booster dates
		//$typhboost=DateAdd("m", 36, $typh);
		$typhboost = date("l, dS of F, Y", $typh);
		$typhboost = "Every three years after $typhboost";
		
		// DT booster date
		$dtboost = DateAdd("m", 96, $dobdate);

		// Format the dates in a presentable form
		if ($today > $bcgdate)
		{
			$bcgdate = date("l, dS of F, Y", $bcgdate);
			$bcgdate = "<font color=#FF0000>within $bcgdate</font>";
		}
		else
		{
			$bcgdate = "within ".date("l, dS of F, Y", $bcgdate);
		}

		if ($today > $opv1)
		{
			$opv1 = date("l, dS of F, Y", $opv1);
			$opv1 = "<font color=#FF0000>$opv1</font>";
		}
		else
		{
			$opv1 = date("l, dS of F, Y", $opv1);
		}
		if ($today > $opv2)
		{
			$opv2 = date("l, dS of F, Y", $opv2);
			$opv2 = "<font color=#FF0000>$opv2</font>";
		}
		else
		{
			$opv2 = date("l, dS of F, Y", $opv2);
		}
		if ($today > $opv3)
		{
			$opv3 = date("l, dS of F, Y", $opv3);
			$opv3 = "<font color=#FF0000>$opv3</font>";
		}
		else
		{
			$opv3 = date("l, dS of F, Y", $opv3);
		}
		if ($today > $opv4)
		{
			$opv4 = date("l, dS of F, Y", $opv4);
			$opv4 = "<font color=#FF0000>$opv4</font>";
		}
		else
		{
			$opv4 = date("l, dS of F, Y", $opv4);
		}
		if ($today > $opv5)
		{
			$opv5 = date("l, dS of F, Y", $opv5);
			$opv5 = "<font color=#FF0000>$opv5</font>";
		}
		else
		{
			$opv5 = date("l, dS of F, Y", $opv5);
		}
		
		
		if ($today > $hepb1)
		{
			$hepb1 = date("l, dS of F, Y", $hepb1);
			$hepb1 = "<font color=#FF0000>$hepb1</font>";
		}
		else
		{
			$hepb1 = date("l, dS of F, Y", $hepb1);
		}
		if ($today > $hepb2)
		{
			$hepb2 = date("l, dS of F, Y", $hepb2);
			$hepb2 = "<font color=#FF0000>$hepb2</font>";
		}
		else
		{
			$hepb2 = date("l, dS of F, Y", $hepb2);
		}
		if ($today > $hepb3)
		{
			$hepb3 = date("l, dS of F, Y", $hepb3);
			$hepb3 = "<font color=#FF0000>$hepb3</font>";
		}
		else
		{
			$hepb3 = date("l, dS of F, Y", $hepb3);
		}

		
		if ($today > $hepa1)
		{
			$hepa1 = date("l, dS of F, Y", $hepa1);
			$hepa1 = "<font color=#FF0000>$hepa1</font>";
		}
		else
		{
			$hepa1 = date("l, dS of F, Y", $hepa1);
		}
		if ($today > $hepa2)
		{
			$hepa2 = date("l, dS of F, Y", $hepa2);
			$hepa2 = "<font color=#FF0000>$hepa2</font>";
		}
		else
		{
			$hepa2 = date("l, dS of F, Y", $hepa2);
		}
		if ($today > $hepa3)
		{
			$hepa3 = date("l, dS of F, Y", $hepa3);
			$hepa3 = "<font color=#FF0000>$hepa3</font>";
		}
		else
		{
			$hepa3 = date("l, dS of F, Y", $hepa3);
		}

		
		if ($today > $measles)
		{
			$measles = date("l, dS of F, Y", $measles);
			$measles = "<font color=#FF0000>$measles</font>";
		}
		else
		{
			$measles = date("l, dS of F, Y", $measles);
		}
		if ($today > $mmr)
		{
			$mmr = date("l, dS of F, Y", $mmr);
			$mmr = "<font color=#FF0000>$mmr</font>";
		}
		else
		{
			$mmr = date("l, dS of F, Y", $mmr);
		}
		if ($today > $menin)
		{
			$menin = date("l, dS of F, Y", $menin);
			$menin = "<font color=#FF0000>$menin</font>";
		}
		else
		{
			$menin = date("l, dS of F, Y", $menin);
		}

		if ($today > $hib1)
		{
			$hib1 = date("l, dS of F, Y", $hib1);
			$hib1 = "<font color=#FF0000>$hib1</font>";
		}
		else
		{
			$hib1 = date("l, dS of F, Y", $hib1);
		}
		if ($today > $hib2)
		{
			$hib2 = date("l, dS of F, Y", $hib2);
			$hib2 = "<font color=#FF0000>$hib2</font>";
		}
		else
		{
			$hib2 = date("l, dS of F, Y", $hib2);
		}
		if ($today > $hib3)
		{
			$hib3 = date("l, dS of F, Y", $hib3);
			$hib3 = "<font color=#FF0000>$hib3</font>";
		}
		else
		{
			$hib3 = date("l, dS of F, Y", $hib3);
		}
		if ($today > $hib4)
		{
			$hib4 = date("l, dS of F, Y", $hib4);
			$hib4 = "<font color=#FF0000>$hib4</font>";
		}
		else
		{
			$hib4 = date("l, dS of F, Y", $hib4);
		}

		if ($today > $typh)
		{
			$typh = date("l, dS of F, Y", $typh);
			$typh = "<font color=#FF0000>$typh</font>";
		}
		else
		{
			$typh = date("l, dS of F, Y", $typh);
		}
		if ($today > $cpox)
		{
			$cpox = date("l, dS of F, Y", $cpox);
			$cpox = "<font color=#FF0000>$cpox</font>";
		}
		else
		{
			$cpox = date("l, dS of F, Y", $cpox);
		}
		if ($today > $rubella)
		{
			$rubella = date("l, dS of F, Y", $rubella);
			$rubella = "<font color=#FF0000>$rubella</font>";
		}
		else
		{
			$rubella = date("l, dS of F, Y", $rubella);
		}

		if ($today > $hepboost1)
		{
			$hepboost1 = date("l, dS of F, Y", $hepboost1);
			$hepboost1 = "<font color=#FF0000>$hepboost1</font>";
		}
		else
		{
			$hepboost1 = date("l, dS of F, Y", $hepboost1);
		}
		if ($today > $hepboost2)
		{
			$hepboost2 = date("l, dS of F, Y", $hepboost2);
			$hepboost2 = "<font color=#FF0000>$hepboost2</font>";
		}
		else
		{
			$hepboost2 = date("l, dS of F, Y", $hepboost2);
		}
  
  
		if ($today > $opvboost1)
		{
			$opvboost1 = date("l, dS of F, Y", $opvboost1);
			$opvboost1 = "<font color=#FF0000>$opvboost1</font>";
		}
		else
		{
			$opvboost1 = date("l, dS of F, Y", $opvboost1);
		}
		if ($today > $opvboost2)
		{
			$opvboost2 = date("l, dS of F, Y", $opvboost2);
			$opvboost2 = "<font color=#FF0000>$opvboost2</font>";
		}
		else
		{
			$opvboost2 = date("l, dS of F, Y", $opvboost2);
		}
  

		if ($today > $dtboost)
		{
			$dtboost = date("l, dS of F, Y", $dtboost);
			$dtboost = "<font color=#FF0000>$dtboost</font>";
		}
		else
		{
			$dtboost = date("l, dS of F, Y", $dtboost);
		}

		// Calculate the child's age in days
		$childAgeInDays = DateDiff("d", $dobdate, $today);
		
		// Calculate the child's age in months
		$childAgeInMonths = ($childAgeInDays/30);

		// Calculate the child's age in years
		$childAgeInYears = floor($childAgeInMonths/12);
			
		if ($childAgeInYears < 1) 
		{
			$childAgeInMs = floor($childAgeInDays/30);
			$childAgeInDs = ($childAgeInDays%30);
		}

		if ($childAgeInYears >= 1)
		{
			$childAgeInMs = floor($childAgeInDays/30);
			$childAgeInMs = $childAgeInMs - ($childAgeInYears * 12);
		}

		// Format the DOB in a presentable form
		$dobdate=date("l, dS of F, Y", $dobdate);
?>
		<BODY>
		<DIV ALIGN="CENTER">
		<h3><font face="Verdana" size="2">The recommended immunisation schedule of your child is as follows:</h3>
		<p>
<?php

		echo "Your child's date of birth is <b>$dobdate</b><br />";

		if ( ($childAgeInYears < 2) && ($childAgeInYears >= 1) )
		{
			echo "$term is now <b>$childAgeInYears</b> year and <b>$childAgeInMs</b> months old</br>";
		}
		elseif ($childAgeInYears < 1)
		{
			echo "$term is now <b>$childAgeInMs</b> months and <b>$childAgeInDs</b> days old</br>";
		}
		elseif ($childAgeInYears >= 2)
		{
			echo "$term is now <b>$childAgeInYears</b> years and <b>$childAgeInMs</b> months old</br>";
		}
?>
</p>
</font>
</div>
<div align="center">

<table border='2' cellspacing='5' style='border-collapse: collapse' bordercolor='#FFFFFF' bordercolorlight='#C0C0C0' bordercolordark='#808080' bgcolor='#FFFFFF' cellpadding='2'>
<!--  <TABLE BORDER="2" CELLPADDING="5" CELLSPACING="0" STYLE="border-collapse: collapse" BORDERCOLOR="#111111" COLSPAN=3><FONT FACE="Verdana" SIZE="2">
 --> <tr>
    <td ALIGN="CENTER"><font face="verdana" size="2">Vaccine Name</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">First Dose Due Date</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">Second Due Date</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">Third Due Date</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">Fourth Due Date</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">Fifth Due Date</font></td>
  </tr>
 <tr>
    <td ALIGN="LEFT"><font face="verdana" size="2">BCG</font></td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$bcgdate" ?></font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
  </tr>
  <tr>
    <td ALIGN="LEFT"><font face="verdana" size="2">OPV</font></td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$opv1" ?></font></td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$opv2" ?></font></td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$opv3" ?></font></td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$opv4" ?></font></td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$opv5" ?></font></td>
  </tr>
  <tr>
    <td ALIGN="LEFT"><font face="verdana" size="2">DPT</font></td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$opv2" ?></font></td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$opv3" ?></font></td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$opv4" ?></font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
  </tr>
  <tr>
    <td ALIGN="LEFT"><font face="verdana" size="2">Hepatitis B</font></td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$hepb1" ?></font></td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$hepb2" ?></font></td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$hepb3" ?></font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
  </tr>
  <tr>
    <td ALIGN="LEFT"><font face="verdana" size="2">HIB Titre</font></td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$hib1" ?></font></td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$hib2" ?></font></td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$hib3" ?></font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
  </tr>
  <tr>
    <td ALIGN="LEFT"><font face="verdana" size="2">Measles</font></td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$measles" ?></font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
  </tr>
  <tr>
    <td ALIGN="LEFT"><font face="verdana" size="2">MMR</font></td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$mmr" ?></font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
  </tr>
  <tr>
    <td ALIGN="LEFT"><font face="verdana" size="2">Typhoid</font></td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$typh" ?></font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
  </tr>
  <tr>
    <td ALIGN="LEFT"><font face="verdana" size="2">Meningitis</font></td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$menin" ?></font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
  </tr>
  <tr>
    <td ALIGN="LEFT"><font face="verdana" size="2">Chicken Pox </font>/td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$cpox" ?></font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
  </tr>
  <tr>
    <td ALIGN="LEFT"><font face="verdana" size="2">Hepatitis A</font></td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$hepa1" ?></font></td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$hepa2" ?></font></td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$hepa3" ?></font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">---</font></td>
  </tr></FONT> 
</table>

<!-- Booster Doses //-->

<h4><font face="verdana" size="2">Booster Doses</font></h4>

 <center>
 <TABLE BORDER="2" CELLPADDING="2" CELLSPACING="5" STYLE="border-collapse: collapse" BORDERCOLOR="#FFFFFF" COLSPAN=3 bordercolorlight="#C0C0C0" bordercolordark="#808080" bgcolor="#FFFFFF" width="100%">
<tr>
    <td ALIGN="CENTER"><font face="verdana" size="2">Vaccine Name</font> </td>
    <td ALIGN="CENTER"><font face="verdana" size="2">Due Date</font></td>
    <td ALIGN="CENTER"><font face="verdana" size="2">Due Date</font></td>
  </tr>
  <tr>
    <td ALIGN="LEFT"><font face="verdana" size="2">Hepatitis B</font> </td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$hepboost1" ?></font> </td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$hepboost2" ?></font> </td>
  </tr>
  <tr>
    <td ALIGN="LEFT"><font face="verdana" size="2">OPV</font> </td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$opvboost1" ?></font> </td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$opvboost2" ?></font> </td>
  </tr>
  <tr>
    <td ALIGN="LEFT"><font face="verdana" size="2">DPT</font> </td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$opvboost1" ?></font> </td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$opvboost2" ?></font> </td>
  </tr>
  <tr>
    <td ALIGN="LEFT"><font face="verdana" size="2">Typhoid</font> </td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$typhboost" ?></font> </td>
    <td ALIGN="CENTER">---</td>
  </tr>
  <tr>
    <td ALIGN="LEFT"><font face="verdana" size="2">DT</font> </td>
    <td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$dtboost" ?></font> </td>
    <td ALIGN="CENTER">---</td>
  </tr>
  <tr>
    <td ALIGN="LEFT"><font face="verdana" size="2">TT</font> </td>
    <td ALIGN="LEFT"><font face="verdana" size="2">Once every 10 years after <? echo "$dobdate" ?></font> </td>
    <td ALIGN="CENTER">---</td>
  </tr>
  <tr>
<?
	if ($theSex==2)
	{
?>
		<td ALIGN="LEFT"><font face="verdana" size="2">Rubella (for girls at 12yrs +)</font> </td>
		<td ALIGN="LEFT"><font face="verdana" size="2"><? echo "$rubella" ?></font> </td>
		<td ALIGN="CENTER">---</td>
<?   
	} 
?>
  </tr>
</table>
</center></div>

<p align="center"><small><font face="verdana" size="2">If you have missed any of these, please consult
your child's paediatrician without delay <br />
<U>The dates in <font color=#FF0033>red</font> mean they have elapsed as on today</U><br />
Please remember that the doctor's decision is final. Any alterations/additions suggested by the doctor is absolute<br />
<b><font face="verdana" size="2" color=#FF0033>N. B. Certain vaccines are controversial and therefore may not be given at all</font></b></small><br />
<font face="verdana" size="2">You may print out this schedule by using the print button</font></p>
<div align="center">
<FORM METHOD=POST ACTION="">
	<center><INPUT TYPE="submit" NAME="doagain" VALUE="Repeat Calculations"></center>
</FORM>
</div>
<?
		break;
	
	default:
	// The default case.
	include("imsch_form.inc");
}
?>
<!-- <div align="center>
<font  face="verdana" size="1">&copy;Sudisa - 2003 - 2010</font></DIV> -->
</BODY>
</HTML>