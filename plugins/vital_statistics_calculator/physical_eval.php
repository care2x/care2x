<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> <?php echo $LDResultsInterpretations ?> </TITLE>
</HEAD>

<BODY>

<DIV ALIGN="CENTER"><H1><font face="Verdana"><?php echo $LDResultsInterpretations ?></font></H1></DIV>

<!-- Sources
Body fat percentage calculator and interpretation: http://bestbodyever.com/body-fat-calculator.html
BMI Calculator; http://nhlbisupport.com/bmi/bmi-m.htm
BMI Interpretation: http://www.cdc.gov/nccdphp/dnpa/bmi/bmi-adult.htm 
-->

<?php 

  # Get the data and assign  the various values to proper variables for manipulation and display.
		$AgeValue = $_POST["age"];
		$SexValue = $_POST["sex"];
		$WTValue = $_POST["wtkgs"];
		$WLValue = $_POST["wtlbs"];
		$HTValue = $_POST["htincms"];
		$PRValue = $_POST["prate"];
		$BPSValue = $_POST["bps"];
		$BPDValue = $_POST["bpd"];
		$waistSInCms = $_POST["wsincms"];

# All datas are in correct form. Now interpret the data as necessary.

		# Set the ideal body weight values as per the sex of the patient...
		if ($SexValue == $LDMale) 
		{
			$maxWaistSize = 102;
			$IBWValue = $HTValue - 105;
			$IBWLVal = (int) ($IBWValue * 2.20462262185);
			if ($AgeValue <= 20)
			{
				$SaluC = $LDYoungMen;
				$BMIntpret = $LDTheseBMICalculations;
			}
			else
			{
				$SaluC = $LDman;
				$BMIntpret = $LDTheBMICalculations;
			}
		}
		else 
		{
			$maxWaistSize = 88;
			if ($AgeValue <= 20)
			{
				$SaluC = $LDYoungLady;
				$BMIntpret = $LDTheseBMICalculations;
			}
			else
			{
				$SaluC = $LDlady;
				$BMIntpret = $LDTheBMICalculations;
			}
			$IBWValue = $HTValue - 107;
			$IBWLVal = (int) ($IBWValue * 2.20462262185);
		}

		# Perform the necessary calculations...
		$height = pow($HTValue, 0.725);
		$weight = pow($WTValue, 0.425);
		$SArea = round( (0.007184 * $height * $weight), 2);
		$PPValue = ($BPSValue - $BPDValue);
		$BMRValue = (0.75 * ($PRValue + (0.74 * $PPValue))) - 72;
		$BMRValue = round($BMRValue, 2);
		$INValue = ($HTValue / 2.54);
		$INValue = round($INValue, 2);
		$HTinM = ($HTValue / 100);
		$htInM = pow($HTinM, 2);
		$bodyFatP = round($WTValue/$htInM, 2);
		$BMIValue = (($WTValue) / $htInM);
		$BMIValue = round($BMIValue, 2);
		$LLBW = round( ($htInM * 18.49), 2);
		$IBWK = round( ($htInM * 22), 0);
		$AcBW = round( ($htInM * 24.99), 2);
		$MaxBW = round( ($htInM * 30), 2);
		$ULGrIOb = round( ($htInM * 34.9), 2);
		$ULGrIIOb = round( ($htInM * 39.9), 2);
		$LLBWLbs = round( ($LLBW * 2.20462262185), 2);
		$IBWL = round( ($IBWK * 2.20462262185), 0);
		$AcBWLbs = round( ($AcBW * 2.20462262185), 2);
		$MaxBWLbs = round( ($MaxBW * 2.20462262185), 2);
		$THRate = (220 - $AgeValue);
		$OHRate = round( ($THRate * 0.85), 0);
		$BPSValInkPa = round($BPSValue / 7.5, 2);
		$BPDValInkPa = round($BPDValue / 7.5, 2);

		# Calculate the Daily Calorie Requirement based on the ideal body weight of the patient
		$DRLValue = floor(($IBWValue * 22) * (1.3));
		$DRUValue = ceil(($IBWValue * 22) * 2);

		# Interpret the body fat percentage
		if ($bodyFatP < 20)
		{
			$bfpInt = "<font color=\"#3300FF\">".$LDunderweight."</font>";
		}
		elseif ( ($bodyFatP >= 20) and ($bodyFatP <= 25) )
		{
			$bfpInt = "<u>".$LDwithinRange."</u>";
		}
		elseif ( ($bodyFatP > 25) and ($bodyFatP < 27) )
		{
			$bfpInt = "<font color=\"#FF6600\">".$LDoverweight."</font>";
		}
		elseif ( ($bodyFatP > 27) and ($bodyFatP < 30) )
		{
			$bfpInt = "<font color=\"#CC0000\">".$LDsignificantlyoverweight."</font>";
		}
		elseif ($bodyFatP > 30)
		{
			$bfpInt = "<font color=\"#FF0000\">".$LDobese."</font>";
		}

		# Interpret the grade of obesity, if any
		if ( ($WTValue < $AcBW) and ($waistSInCms <= $maxWaistSize) )
		{
			$ObGrader = "<font color=\"#339900\">".$LDNotOverweight."</font>";
		}
		elseif ( ($WTValue < $MaxBW) and ($waistSInCms <= $maxWaistSize) )
		{
			$ObGrader = $LDVitalCalcTxt[0];
		}
		elseif ( ($WTValue < $MaxBW) and ($waistSInCms > $maxWaistSize))
		{
			$ObGrader = $LDVitalCalcTxt[1];
		}
		elseif ( ($WTValue < $ULGrIOb) and ($waistSInCms <= $maxWaistSize))
		{
			$ObGrader = $LDVitalCalcTxt[2];
		}
		elseif ( ($WTValue < $ULGrIOb) and ($waistSInCms > $maxWaistSize) )
		{
			$ObGrader = $LDVitalCalcTxt[3];
		}
		elseif ($WTValue < $ULGrIIOb)
		{
			$ObGrader = $LDVitalCalcTxt[4];
		}
		else
		{
			$ObGrader = $LDVitalCalcTxt[5];
		}


		# Interpret the body weight vis-a-vis ideal body weight
		if ($IBWK == $WTValue) 
		{
			$IBWInt = $LDVitalCalcTxt[6];
		}
		else
		{
			$IBWInt = $LDVitalCalcTxt[7]." <font color=\"darkorchid\">$IBWK </font>".$LDKgsor." <font color=\"darkorchid\">$IBWL </font>".$LDlbs;
		}

		# Interpret the pulse pressure
		if ($PPValue > 50) 
		{
			$PPInt = $LDVitalCalcTxt[8];
		}
		elseif ($PPValue < 40)
		{
			$PPInt = $LDVitalCalcTxt[8];
		}
		else
		#		($PPValue >= 40 || $PRValue <= 50)
		{
			$PPInt = $LDVitalCalcTxt[10];
		}

		# Interpret the type of pulse from its rate
		if ($PRValue < 40) 
		{
			$PRInt = $LDVitalCalcTxt[11];
		}
		elseif ($PRValue < 60 and $PRValue >= 40) 
		{
			$PRInt = "<font color=\"blue\">".$LDbradycardia."</font>";
		} 
		elseif ($PRValue > 100 and $PRValue <= 140) 
		{
			$PRInt = "<font color=\"#ff1cae\">".$LDSinusTachycardia."</font>";
		} 
		elseif ($PRValue > 140 and $PRValue <= 160) 
		{
			$PRInt = "<font color=\"red\">".$LDTachycardia."</font>";
		} 
		elseif ($PRValue > 160) 
		{
			$PRInt = "<font color=\"red\">".$LDVitalCalcTxt[12]."</font>";
		} 
		else
		#		($PRValue >= 60 | $PRValue <= 100)
		{
			$PRInt = "<font color=\"green\">".$LDVitalCalcTxt[13]."</font>";
		}

		# Interpret the systolic BP
		$BPInt = "<font color=\"green\">".$LDVitalCalcTxt[14]."</font>";
		
		# If the systolic is less than 60 and diastolic less than 40 say hypotensive
		if ($BPSValue < 60 and $BPDValue < 40) 
		{
			$BPInt = "<font color=\"blue\">".$LDhypotensive."</font>";
		}

 		# If the systolic is more than 140 but less than or equal to 160
		if ($BPSValue > 140 and $BPSValue <= 160)
		{
			if ($BPDValue > 90 and $BPDValue <= 100) 
			{
				$BPInt = "<font color=\"red\">".$LDmildlyhypertensive."</font>";
			}
			elseif ($BPDValue > 100 and $BPDValue <= 110) 
			{
				$BPInt = "<font color=\"red\">".$LDmoderatelyhypertensive."</font>";
			}
			elseif ($BPDValue > 110) 
			{
				$BPInt = "<font color=\"red\">".$LDseverelyhypertensive."</font>";
			}
		}		

 		# If the systolic is more than 160 but less than or equal to 200		
		if ($BPSValue > 160 and $BPSValue <= 200)
		{
			if ($BPDValue > 110) 
			{
				$BPInt = "<font color=\"red\">".$LDseverelyhypertensive."</font>";
			}
			else
			{
			   $BPInt = "<font color=\"red\">".$LDmoderatelyhypertensive."</font>";
			}
		}		
		elseif ($BPSValue > 200) 
		{
			$BPInt = "<font color=\"red\">".$LDseverelyhypertensive."</font>";
		}		

 		# If the diastolic is more than 90 but less than or equal to 100		
		if ($BPDValue > 90 and $BPDValue <= 100)
		{
			$BPInt = "<font color=\"red\">".$LDmildlyhypertensive."</font>";
		}

 		# If the diastolic is more than 100 but less than or equal to 110		
		if ($BPDValue > 100 and $BPDValue <= 110) 
		{
			$BPInt = "<font color=\"red\">".$LDmoderatelyhypertensive."</font>";
		}

 		# If the diastolic is more than 110		
		if ($BPDValue > 110) 
		{
			$BPInt = "<font color=\"red\">".$LDseverelyhypertensive."</font>";
		}

		# Interpret the body mass index
		if ($BMIValue < 19) 
		{
			$BMInt = " and you are <font color=\"blue\">".$LDunderweight."</font>";
		} 
		elseif ($BMIValue > 25 and $BMIValue <= 30) 
		{
			$BMInt = " and you are <font color=\"red\">".$LDpronetohealthrisks."prone to health risks</font>";
		} 
		elseif ($BMIValue > 30) 
		{
			$BMInt = $LDVitalCalcTxt[15];
		}
		elseif ($BMIValue > 25 and $BMIValue <= 30) 
		{
			$BMInt = $LDVitalCalcTxt[16];
		} 
		else
		{
			$BMInt = $LDVitalCalcTxt[17];
		}

		# Interpret the basal metabolic rate
		if ($BMRValue > 10) 
		{
			$BMRVal = "<font color=\"red\">$BMRValue</font>";
			$BMRInt = $LDVitalCalcTxt[18];
		} 
		elseif ($BMRValue < -10) 
		{
			$BMRVal = "<font color=\"blue\">$BMRValue</font>";
			$BMRInt = $LDVitalCalcTxt[19];
		} 
		else		#	if ($BMRValue >= -10 | $BMRValue <= 10) 
		{
			$BMRVal = "<font color=\"green\">$BMRValue</font>";
			$BMRInt = $LDVitalCalcTxt[20];
		}

		#Interpret the BP according to age
		if ($BPSValue > 140 or $BPDValue > 90) 
		{
			if ($AgeValue < 35 or $AgeValue > 55) 
			{
				$BPAgeInt = $LDVitalCalcTxt[21];
			}
			elseif ($AgeValue > 35 or $AgeValue < 55)
			{
				$BPAgeInt = "<font color=\"blue\">".$LDidiopathicHypertension."</font>";
			}
		}
		else
		{
			$BPAgeInt = "<font color=\"green\">".$LDVitalCalcTxt[22]."</font>";
		}
?>

<div align="center">
  <center>

<TABLE FRAME="BORDER" BORDER="8" RULES="ROWS" COLS="1" CELLSPACING="5" CELLPADDING="5" bordercolorlight="#CCCCCC" bordercolordark="#666666" style="border-collapse: collapse" bordercolor="#111111">
<TR>
<TD ALIGN="LEFT">
<font face="Verdana" size="2">
<div align="center"><b><font color="#333399"><?php echo $LDVitalCalcTxt[23]; ?> <u><?php echo $SaluC ?></u> <?php echo $LDVitalCalcTxt[24]; ?> <u><?php echo $AgeValue ?> <?php echo $LDyears; ?></u></font></b></div>&nbsp;<table border="5" cellpadding="2" cellspacing="5" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" bordercolorlight="#999999" bordercolordark="#666666" bgcolor="#CCCCCC">
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<b><u><div align="center"><?php echo $LDWeight; ?></div></u></b></font></td>
  </tr>
  <tr>
    <td width="100%">
<font color="#339900" face="Verdana" size="2"><div align="center"><i><b><?php echo $ObGrader ?></b></i></div></font></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<?php echo $LDVitalCalcTxt[55]; ?> <font color="#FF3399"><?php echo $WTValue ?> </font><?php echo $LDKgsor; ?> <font color="#FF3399"><?php echo $WLValue ?> </font><?php echo $LDlbs; ?>, <?php echo $IBWInt ?></font></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<?php echo $LDVitalCalcTxt[25]; ?> <?php echo $SaluL ?> <?php echo $LDVitalCalcTxt[26]; ?> <font color="blue"><?php echo $LLBW ?></font> <?php echo $LDand; ?> <font color="green"><?php echo $AcBW ?></font> <?php echo $LDVitalCalcTxt[27]; ?> <font color="red"><?php echo $MaxBW ?></font> <?php echo $LDKgs; ?></font></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<?php echo $LDVitalCalcTxt[28]; ?> <font color="blue"><?php echo $LLBWLbs ?></font>, <font color="green"><?php echo $AcBWLbs ?></font> and <font color="red"><?php echo $MaxBWLbs ?></font> <?php echo $LDVitalCalcTxt[29]; ?></font></td>
  </tr>
</table>
<p>&nbsp;<TABLE FRAME="BORDER" BORDER="5" RULES="ROWS" COLS="1" CELLSPACING="5" CELLPADDING="2" bordercolorlight="#999999" bordercolordark="#808080" style="border-collapse: collapse" bordercolor="#111111" bgcolor="#CCCCCC" width="100%">
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<b><u><div align="center"><?php echo $LDVitalCalcTxt[30]; ?></div></u></b></font></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<?php echo $BMIntpret ?><br />
<?php echo $LDVitalCalcTxt[31]; ?> <font color="#FF3399"><?php echo $HTValue ?> </font><?php echo $LDcmsor; ?> <font color="#FF3399"><?php echo $INValue ?> </font><?php echo $LDinches; ?> <?php echo $SaluL ?> <?php echo $LDVitalCalcTxt[32]; ?> <font color="firebrick"><b><?php echo $BMIValue ?></b></font> <?php echo $BMInt ?> </font>
    </td>
  </tr>
</table>
<p>
&nbsp;<table border="5" cellpadding="2" cellspacing="5" style="border-collapse: collapse" bordercolor="#111111" width="100%" bordercolorlight="#999999" bordercolordark="#666666" bgcolor="#CCCCCC">
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<b><u><div align="center"><?php echo $LDVitalCalcTxt[33]; ?></div></u></b></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<?php echo $LDVitalCalcTxt[34]; ?> <font color="red"> <?php echo $DRLValue ?> </font> <?php echo $LDand; ?> <font color="blue"> <?php echo $DRUValue ?> </font><?php echo $LDVitalCalcTxt[35]; ?></td>
  </tr>
</table>
<p>
&nbsp;<table border="5" cellpadding="2" cellspacing="5" style="border-collapse: collapse" bordercolor="#111111" width="100%" bordercolorlight="#999999" bordercolordark="#666666" bgcolor="#CCCCCC">
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<b><u><div align="center"><?php echo $LDVitalCalcTxt[36]; ?></div></u></b></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<?php echo $LDVitalCalcTxt[37]; ?> <b><font color="orange"><?php echo $SArea ?> </font></b>m<sup><b><font size="1">2</font></b></sup></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<?php echo $LDVitalCalcTxt[38]; ?> <font color="#FF33CC"><?php echo $bodyFatP ?></font>%, <?php echo $LDVitalCalcTxt[39]; ?> <?php echo "$bfpInt" ?></u></td>
  </tr>
</table>
<p>
&nbsp;<table border="5" cellpadding="2" cellspacing="5" style="border-collapse: collapse" bordercolor="#111111" width="100%" bordercolorlight="#999999" bordercolordark="#666666" bgcolor="#CCCCCC">
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<b><u><div align="center"><?php echo v; ?></div></u></b></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<?php echo $LDVitalCalcTxt[40]; ?> <font color="#3300CC"><?php echo $BPSValue ?>/<?php echo $BPDValue ?></font> <?php echo $LDtorr; ?><FONT COLOR="RED">*</FONT> <?php echo $LDor; ?> <font color="#3300CC"><?php echo $BPSValInkPa ?>/<?php echo $BPDValInkPa ?></font> <?php echo $LDkPa; ?></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<?php echo $LDVitalCalcTxt[41]; ?> <?php echo $BPInt ?> <?php echo $LDVitalCalcTxt[42]; ?> <?php echo $BPAgeInt ?></font></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<?php echo $LDVitalCalcTxt[43]; ?> <font color="#FF3399"><?php echo $PPValue ?> </font> <?php echo $LDVitalCalcTxt[44]; ?> <?php echo $PPInt ?></font></td>
  </tr>
</table>
<p>
&nbsp;<table border="5" cellpadding="2" cellspacing="5" style="border-collapse: collapse" bordercolor="#111111" width="100%" bordercolorlight="#999999" bordercolordark="#666666" bgcolor="#CCCCCC">
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<b><u><div align="center"><?php echo $LDPulseRate; ?></div></u></b></font></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<?php echo $LDVitalCalcTxt[45]; ?> <font color="#FF3399"><?php echo $PRValue ?> </font><?php echo $LDVitalCalcTxt[46]; ?> <?php echo $PRInt ?></font></font></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<?php echo $LDVitalCalcTxt[47]; ?> <font color="red"><?php echo $THRate ?></font> <?php echo $LDbeatsperminute; ?></font></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<?php echo $LDVitalCalcTxt[48]; ?> <font color="blue"><?php echo $OHRate ?></font> <?php echo $LDVitalCalcTxt[49]; ?></font></td>
  </tr>
</table>
<br />
&nbsp;<table border="5" cellpadding="2" cellspacing="5" style="border-collapse: collapse" bordercolor="#111111" width="100%" bordercolorlight="#999999" bordercolordark="#666666" bgcolor="#CCCCCC">
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<b><u><div align="center"><?php echo $LDBasalMetabolicRate; ?></div></u></b></font></td>
  </tr>
  <tr>
    <td width="100%">

<font face="Verdana" size="2">
<?php echo $LDVitalCalcTxt[50]; ?> <?php echo $BMRVal ?> <?php echo $LDand; ?> <?php echo $BMRInt ?></font></td>
  </tr>
</table>
<BR />
</TD>
</TR>
</TABLE>
</center>
</div>
<DIV ALIGN="CENTER">
<font face="Verdana" size="1">
<FONT COLOR="RED">*</FONT> <?php echo $LDVitalCalcTxt[51]; ?></font><font face="Verdana" size="2"><BR />
<FONT COLOR="RED" SIZE="2"><?php echo $LDVitalCalcTxt[52]; ?></FONT>
<BR />
<FONT COLOR="RED" SIZE="2"><?php echo $LDVitalCalcTxt[53]; ?> </FONT> </font>
<form method="POST" action="medical_eval.php">
  <button name="recalc" value="<?php echo $LDVitalCalcTxt[54]; ?>" type="submit"><font face="Verdana">
  Re-calculate</font></button>
  </font>
  </p>
</form>
<font face="Verdana" size="1">©Sudisa - 2004 to 2014</font></DIV>
</BODY>
</HTML>