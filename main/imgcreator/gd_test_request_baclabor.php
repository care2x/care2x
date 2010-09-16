<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr('inc_test_request_gd_baclabor.php',$_SERVER['SCRIPT_NAME'])) 
	die("<meta http-equiv='refresh' content='0; url=../'>");
/*------end------*/

/**
* CARE2X Integrated Hospital Information System
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/

/**
*  This script works only with the barcode_label_single_large.php
*/

/* Load the variables elements */
require_once($root_path.'modules/laboratory/includes/inc_test_request_vars_baclabor.php');

/* Load additional language table */
if(file_exists($root_path.'language/'.$lang.'/lang_'.$lang.'_konsil_'.$subtarget.'.php')) include_once($root_path.'language/'.$lang.'/lang_'.$lang.'_konsil_'.$subtarget.'.php');
  else include_once($root_path.'language/'.LANG_DEFAULT.'/lang_'.LANG_DEFAULT.'_konsil_'.$subtarget.'.php');


function doBlock()
{
   global $sx, $sy,  $im, $pink, $black, $top_border, $mark_v_offset,$ewhite;
   
   $width=10;
   $height=5;
   $ex=$sx+$width;
   $ey=$sy+$height+$mark_v_offset;
 
   ImageRectangle($im,$sx,($sy+$mark_v_offset),$ex,($ey),$pink);
   ImageFilledRectangle($im,($sx+1),(($sy+$mark_v_offset)+1),($ex-1),($ey-1),$ewhite);
}
   
function doFilledBlock()
{
   global $sx, $sy, $im, $pink, $black, $mark_v_offset;
   
   $width=10;
   $height=5;
   $ex=$sx+$width;
   $ey=$sy+$height+$mark_v_offset;
 
 
   ImageRectangle($im,$sx,($sy+$mark_v_offset),$ex,($ey),$pink);
   ImageFilledRectangle($im,($sx+1),(($sy+$mark_v_offset)+1),($ex-1),($ey-1),$black);
}

function doSyncBlocks()
{
   global $w, $h, $hdiv, $vdiv, $im, $black, $top_border;
   
   $width=14;
   $height=7;

   $x1=$w-($width+1);
   $x2=$w-1;
 
   for($i=0,$y1=$top_border; $i<67; $i++, $y1=$y1+$vdiv)
   {   
       ImageFilledRectangle($im,$x1,$y1,$x2,($y1+$height),$black);
   }
}

function doTitel($titel,$len=6)
{
   global $sx, $sy, $hdiv, $vdiv, $im, $pink, $black, $left_border, $top_border, $mark_v_offset,$ewhite, $dark_pink;
 
   ImageFilledRectangle($im,($sx-$left_border),($sy-3),($sx+($hdiv*$len)-8),($sy+10),$dark_pink);
   ImageString($im,2,($sx),($sy-3),$titel,$ewhite);
}

function doWrite($item)
{
   global $sx, $sy, $im, $dark_pink;
 
   ImageString($im,1,($sx+14),($sy),$item,$dark_pink);
}
function doWriteLeft($item)
{
   global $sx, $sy, $im, $dark_pink;
 
   ImageString($im,1,($sx-16),($sy),$item,$dark_pink);
}

function doWriteTop($item)
{
   global $sx, $sy, $im, $dark_pink;
 
   ImageString($im,1,($sx),($sy-7),$item,$dark_pink);
}

function doBgColor($len=6)
{
   global $sx, $sy, $hdiv, $im, $pink,  $left_border, $bgcolor;
 
   ImageFilledRectangle($im,($sx-$left_border),($sy-2),($sx+($hdiv*$len)-8),($sy+10),$bgcolor);
   ImageLine($im,($sx-$left_border),($sy+10),($sx+($hdiv*$len)-8),($sy+10),$pink);
}

function showphone()
{
   global $sx, $sy, $hdiv, $vdiv, $im, $v_phone;
   
   if($v_phone) ImageCopy($im,$v_phone,($sx-5),($sy-1),0,0,14,10);
 
}

/**
*  Initializations
*  Create the image $im and allocate colors
*/

$left_border=4; /* The left border for drawing of blocks */
$top_border=24; /* The top border for drawing of blocks */
$mark_v_offset=1; /* Vertical offset of the marking blocks */

	
    /* Load the batch nr barcode */
    if(file_exists('../cache/barcodes/form_'.$batch_nr.'.png'))
	{
	   $fbc = ImageCreateFrompng('../cache/barcodes/form_'.$batch_nr.'.png');
	}
	
	/* Set dimensions of the form */
    $w=745; 
    $h=1080;
    $im=@ ImageCreate($w,$h);

	/* Allocate colors used for the form */
    $white = ImageColorAllocate ($im, 255,255,255); //white bkgrnd
    $blue=ImageColorAllocate($im, 0, 127, 255);
    $purple=ImageColorAllocate($im, 186, 124, 237);
    $light_violet=ImageColorAllocate($im, 243, 241, 254);
    $black = ImageColorAllocate ($im, 000, 0000, 000);
	$pink=ImageColorAllocate ($im, 255, 206, 206);
	$light_pink=ImageColorAllocate ($im, 255, 243, 243);
	$dark_pink=ImageColorAllocate ($im, 238, 102, 102);
    
	/*calculate the divisions */
	$hdiv=(int)$w/41;
	$vdiv=(int)$h/69;
	/* fill the form with color */
	ImageFillToBorder($im,2,2,$blue, $light_pink);
	
	/* Top horizontal title bar */
	ImageFilledRectangle($im,$left_border,1,($w-($hdiv*2)),($top_border-4),$pink);
	
	 /* Write the info part */
	ImageString($im,5,$hdiv,3,($LDHospitalName.' '.$LDCentralLab),$dark_pink);
	
	/* second top horizontal bar */
	ImageFilledRectangle($im,$left_border,($top_border-3),($left_border+($hdiv*26)),($top_border+8),$dark_pink);
	ImageString($im,2,($left_border+4),($top_border-4),strtoupper($LDMaterial),$white);
	ImageString($im,2,($left_border+($hdiv*5)),($top_border-4),strtoupper($LDRequestedTest),$white);

	$lab_x1=(int)($w-($label_w))/2;
	$lab_y1=(int)($label_h+1);
	/* Create the background rectangle for the label */
	ImageFilledRectangle($im,($lab_x1-7-$hdiv),($top_border-3),($lab_x1+$label_w+14-$hdiv),($lab_y1+14+$top_border),$dark_pink);
	
	/* Copy the patient label into the form */
	ImageCopy($im,$label,($lab_x1+4-$hdiv),($top_border+8),0,0,$label_w,$label_h);
	 
	
	/* Create the synchronizing blocks on the right edge of the form */
	doSyncBlocks(); 


	
	/* Create initialization markers */
	$sy=$top_border+$vdiv;
	$sx=$left_border+($hdiv*29);
	doBlock();
	
	$sx=$left_border+($hdiv*32);
	doFilledBlock();
	
	$sx=$left_border+($hdiv*33);
	doFilledBlock();
	
	$sx=$left_border+($hdiv*38);
	doFilledBlock();
	
	$sx=$left_border+($hdiv*39);
	doFilledBlock();
	
	/* Create the case number markers */
	
	$sy=$top_border+$vdiv;
	
	for($n=0;$n<8;$n++)
	{

	   $sy+=$vdiv;
	   
       for($i=0,$sx=($left_border+($hdiv*29));$i<10;$i++,$sx=$sx+$hdiv)
	   {
	          ImageString($im,1,($sx+3),($sy-6),$i,$dark_pink);
			  
			  if(substr($fen,$n,1)==$i) doFilledBlock();
			  else doBlock();
        }
	}

	/* Place the form batch nr barcode */
	
	$sx=$left_border+($hdiv*32);
	$sy=$top_border+($vdiv*10)-6;
	
   /* Copy the batch nr barcode into the form */
	if($fbc) ImageCopy($im,$fbc,$sx,$sy,6,7,139,28);

	
	/* Create the material  elements */
	
	$sy=($top_border+($vdiv*2));
	while(list($x,$v)=each($LDBacLabMaterialType))
	{
	    $sx=$left_border;
	
		if($stored_material[$x])
		{
			doFilledBlock();
		}
		else
		{
			doBlock();
		}
	    
		doWriteTop($v);
		
		$sx+=($hdiv*2);
	
	    list($x,$v)=each($LDBacLabMaterialType);
		
		if($stored_material[$x])
		{
			doFilledBlock();
		}
		else
		{
			doBlock();
		}
		doWriteTop($v);
		
		$sy+=$vdiv;
	}
	
	/* Create the test type  elements */
	
	$sy=($top_border+($vdiv*2));
	while(list($x,$v)=each($LDBacLabTestType))
	{
	    $sx=$left_border+($hdiv*5);
	
		if($stored_test_type[$x])
		{
			doFilledBlock();
		}
		else
		{
			doBlock();
		}
		
		doWriteTop($v);
		
		$sx+=($hdiv*3);
	
	    list($x,$v)=each($LDBacLabTestType);
		
		if($stored_test_type[$x])
		{
			doFilledBlock();
		}
		else
		{
			doBlock();
		}

		doWriteTop($v);
		
		$sy+=$vdiv;
	}
	
	/* Create the date code*/
	
   $day_tens=0;
   $day_ones=0;
   
   if($edit_form || $read_form )
   {
      /* Process the sampling date, isolate the elements from the DATE format */
      list($yearval,$monval,$dayval) = explode("-",$stored_request['sample_date']);
   }
   else
   {
      /* If fresh form, assume today */
      $yearval=(int)date('Y');
      $dayval=(int)date('d');
	  $monval=(int)date('m');
   }
   
   /* Process the day of the week, separate the 10's from ones */
   
   if($dayval>29)
   {
     $day_tens=30;
	 $day_ones=$dayval-$day_tens;
   }
   elseif($dayval>19)
   {
     $day_tens=20;
	 $day_ones=$dayval-$day_tens;
   }
   elseif($dayval>10)
   {
     $day_tens=10;
	 $day_ones=$dayval-$day_tens;
   }
   else
   {
    $day_ones=$dayval;
   }
   
   /* Set the row and column */
   $sx=$left_border+($hdiv*28);
   $sy=$top_border+($vdiv*12);
   
   //echo $day_ones." ".$day_tens;
	for($i=1;$i<10;$i++)
	{
	   if($day_ones==$i)  doFilledBlock();
	     else doBlock();
		 doWriteTop($i);
	   $sx+=$hdiv;
	}
	/* For the 10's */
	
	  if($day_tens==10) echo doFilledBlock();
	     else doBlock();
		 doWriteTop(10);
	   $sx+=$hdiv; /* advance to the right */
	   
	/* For the 20's */

	   if($day_tens==20) echo doFilledBlock();
	     else doBlock();
		 doWriteTop(20);
	   $sx+=$hdiv; /* advance to the right */
	   
	/* For the 30's */

	   if($day_tens==30)  echo doFilledBlock();
	     else doBlock();
		 doWriteTop(30);
	   $sx+=$hdiv; /* advance to the right */
	
	
	$sx=$left_border+($hdiv*28);
	$sy+=$vdiv; /* Move down one column */
	
	/* Create the month code */
	for($i=1;$i<13;$i++)
	{
	   if($monval==$i) echo doFilledBlock();
	     else doBlock();
		 doWriteTop($LDShortMonth[$i]);
	   $sx+=$hdiv; /* advance to the right */
	}
	
	/* Create the batch nr code */
	$sy=$top_border+($vdiv*14);
    $sx=$left_border;

	for($i=0,$sx=($left_border+($hdiv*10));$i<30; $i++, $sx=$sx+$hdiv)
	{
	    doBlock();
	}	
	
	$sy+=$vdiv;
	
	/* horizontal bar under the label  */
	ImageFilledRectangle($im,$left_border,($sy-3),($left_border+($hdiv*40)-4),($sy+8),$dark_pink);
	ImageString($im,1,($left_border+($hdiv*10)),($sy-2),$LDBatchNumber,$white);
	ImageString($im,2,($left_border+($hdiv*14)),($sy-4),$stored_request['batch_nr'],$black);
	ImageString($im,1,($left_border+($hdiv*18)),($sy-2),$LDInitFindings,$white);
	ImageString($im,1,($left_border+($hdiv*24)),($sy-2),$LDCurrentFindings,$white);
	ImageString($im,1,($left_border+($hdiv*30)),($sy-2),$LDFinalFindings,$white);
	ImageString($im,1,($left_border+($hdiv*33)),($sy-2),$LDResistanceTestAnaerob,$white);
	
	/* Create the findings status code*/
	
	$sy+=$vdiv;
	$sx=$left_border+($hdiv*19);
	if($stored_findings['findings_init']) echo doFilledBlock();
	     else doBlock();
	   $sx+=($hdiv*6); /* advance to the right */
	if($stored_findings['findings_current']) echo doFilledBlock();
	     else doBlock();
	   $sx+=($hdiv*6); /* advance to the right */
	if($stored_findings['findings_final']) echo doFilledBlock();
	     else doBlock();
		 
    /* Convert any possible html special chars to normal chars and print the text */	
	$translation_table= array_flip(get_html_translation_table(HTML_SPECIALCHARS));
	 
	/* Write some text */
	ImageString($im,5,($left_border),($sy),$LDMaterial.':',$dark_pink);
	$sx=$left_border+($hdiv*5);
	ImageString($im,2,$sx,($sy),strtr($stored_request['material_note'],$translation_table),$purple); // Material

	$sy+=$vdiv;
	ImageString($im,5,($left_border),($sy),$LDDiagnosis,$dark_pink);
	$sx=$left_border+($hdiv*5);
	ImageString($im,2,$sx,($sy),strtr($stored_request['diagnosis_note'],$translation_table),$purple); // Diagnosis
	
	$sy+=($vdiv*2);
	ImageString($im,1,($left_border),($sy),$LDImmuneSupp,$dark_pink);
	
	/* Imunne suppression Yes/No*/
	$sx=$left_border+($hdiv*5);
	if($stored_request['immune_supp']) echo doFilledBlock();
	     else doBlock();
	doWrite($LDYes);
	   $sx+=($hdiv*3); /* advance to the right */
	if(!$stored_request['immune_supp']) echo doFilledBlock();
	     else doBlock();
	doWrite($LDNo);
	/* Write some more text */
	$sx=$left_border;
	$sy+=$vdiv;
	ImageString($im,3,($left_border),($sy-6),$LDFillLabOnly.'!',$dark_pink); // Fill lab only
	$sy+=$vdiv;
	doWriteTop($LDLEN); // LEN
	$sx=$left_border+($hdiv*2);
	ImageString($im,2,$sx,($sy-9),$stored_findings['entry_nr'],$purple); // LEN
	$sx=$left_border+($hdiv*9);
	doWriteTop($LDDate); // Date
	$sx=$left_border+($hdiv*11);
	if($stored_findings['rec_date'] && $stored_findings['rec_date']!=DBF_NODATE){
		ImageString($im,2,$sx,($sy-9),formatDate2Local($stored_findings['rec_date'],$date_format),$purple); // Date
	}
	
	/* Create test type elements */
		
     $tr_tracker=0;
    $sx=$left_border;
	$sy+=$vdiv;
   	while(list($x,$v)=each($lab_TestType))
	{

	   if($parsed_type[$x])
	       {
		       doFilledBlock();
		    }
		    else
		    {
			   doBlock();
		    }

	      doWriteTop($v);

	  $tr_tracker++;
	  $sy+=$vdiv;
	  
	   if($tr_tracker>9)
	   { 
		   $tr_tracker=0;
		   $sy-=($vdiv*10);
		   $sx+=($hdiv*2);
	   }
		
    }
		
	/* Free text field */
	$sx=$left_border+($hdiv*19);
	$sy=$top_border+($vdiv*17);
	doWriteTop($LDFillLabOnly.':');
	
	$stored_findings['notes']=strtr($stored_findings['notes'],$translation_table);
	/* Chunk split the notes */
	$chunks=explode('~',chunk_split($stored_findings['notes'],35,'~'));
	for($i=0;$i<sizeof($chunks);$i++)
	{
	   $sy+=$vdiv;
	   ImageString($im,2,$sx,$sy,trim($chunks[$i]),$purple); 
	}   
	
	$sx=$left_border+($hdiv*33);
	$sy=$top_border+($vdiv*16);
	doWrite($LDBac_1);
	$sx+=($hdiv*2);
	doWrite($LDBac_2);
	$sx+=($hdiv*2);
	doWrite($LDBac_3);
	
	/* Create Resistance test anaerobes */
	$sy+=$vdiv;
	 $sx=$left_border+($hdiv*34);
	doWriteTop('S');
	 $sx+=$hdiv;
	doWriteTop('R');
	
	/* First column - anaerobes */
	   	while(list($x,$v)=each($lab_ResistANaerobAcro))
	{
	   $sx=$left_border+($hdiv*34);
	   
       doWriteLeft($v);
	   
       for($n=0;$n<2;$n++)
	   {			

	       list($x2,$v2)=each($lab_ResistANaerob_1);
	       if($parsed_resist_anaerob[$v2])
	       {
		       doFilledBlock();
		    }
		    else
		    {
			   doBlock();
		    }
	      $sx+=$hdiv;
	   }
       $sy+=$vdiv;  
    }
	
	   reset($lab_ResistANaerobAcro);

	/* 2nd column - anaerobes */

	$sy-=($vdiv*15);
	 $sx=$left_border+($hdiv*36);
	doWriteTop('S');
	 $sx+=$hdiv;
	doWriteTop('R');
	
	   	while(list($x,$v)=each($lab_ResistANaerobAcro))
	{
	   $sx=$left_border+($hdiv*36);
	      
       for($n=0;$n<2;$n++)
	   {			

	       list($x2,$v2)=each($lab_ResistANaerob_2);
	       if($parsed_resist_anaerob[$v2])
	       {
		       doFilledBlock();
		    }
		    else
		    {
			   doBlock();
		    }
	      $sx+=$hdiv;
	   }
       $sy+=$vdiv;  
    }
   reset($lab_ResistANaerobAcro);
   
	/* 3rd column - anaerobes */

	$sy-=($vdiv*15);
	 $sx=$left_border+($hdiv*38);
	doWriteTop('S');
	 $sx+=$hdiv;
	doWriteTop('R');
	
	   	while(list($x,$v)=each($lab_ResistANaerobAcro))
	{
	   $sx=$left_border+($hdiv*38);
	      
       for($n=0;$n<2;$n++)
	   {			

	       list($x2,$v2)=each($lab_ResistANaerob_3);
	       if($parsed_resist_anaerob[$v2])
	       {
		       doFilledBlock();
		    }
		    else
		    {
			   doBlock();
		    }
	      $sx+=$hdiv;
	   }
       $sy+=$vdiv;  
    }
   reset($lab_ResistANaerobAcro);
   
	/* horizontal bar under the label  */
	$sy=$top_border+($vdiv*32);
	ImageFilledRectangle($im,$left_border,($sy-3),($left_border+($hdiv*40)-4),($sy+8),$dark_pink);
	ImageString($im,2,($left_border+4),($sy-5),$LDTestFindings,$white);
	ImageString($im,2,($left_border+($hdiv*26)),($sy-5),$LDResistanceTestAerob,$white);
	
	/* Bac I,II,III*/
	
	$sx=$left_border+($hdiv*27);
	$sy+=$vdiv;
	if($parsed_resist_aerob['_rx_pathogen_1_'])
	{
		doFilledBlock();
	}
	else
	{
		doBlock();
	}
	doWrite($LDBac_I);
   
	$sx+=$hdiv*3;
	if($parsed_resist_aerob['_rx_pathogen_2_'])
	{
		doFilledBlock();
	}
	else
	{
		doBlock();
	}
	doWrite($LDBac_II);
	
	$sx+=$hdiv*3;
	if($parsed_resist_aerob['_rx_pathogen_3_'])
	{
		doFilledBlock();
	}
	else
	{
		doBlock();
	}
	doWrite($LDBac_III);
	
	$sx+=$hdiv*4;
	if($parsed_resist_aerob['_rx_fungus_'])
	{
		doFilledBlock();
	}
	else
	{
		doBlock();
	}
	doWrite($LDFungi);
	
	/* Resistance test aerobes 1st column */
	
	$sx=$left_border+($hdiv*27);
	
   	while(list($x,$v)=each($lab_ResistAerobAcro))
	{
	
	   $sy+=$vdiv;
	   doWriteLeft($v);
	   
       for($n=0;$n<3;$n++)
	   {			

	       list($x2,$v2)=each($lab_ResistAerob_1);
	       if($parsed_resist_aerob[$v2])
	       {
		       doFilledBlock();
		    }
		    else
		    {
			   doBlock();
		    }
		 
		 doWriteTop($LDSMR[$n]);
         $sx+=$hdiv; /* Advance to the right */
		 
	   }
	   $sx=$left_border+($hdiv*27);
    }
   
   reset($lab_ResistAerobAcro);
   
   /* 2nd column*/
	$sx=$left_border+($hdiv*30);
	$sy-=($vdiv*32);
   	while(list($x,$v)=each($lab_ResistAerobAcro))
	{
	
	   $sy+=$vdiv;
	   
       for($n=0;$n<3;$n++)
	   {			

	       list($x2,$v2)=each($lab_ResistAerob_2);
	       if($parsed_resist_aerob[$v2])
	       {
		       doFilledBlock();
		    }
		    else
		    {
			   doBlock();
		    }
		 
		 doWriteTop($LDSMR[$n]);
         $sx+=$hdiv; /* Advance to the right */
		 
	   }
	   $sx=$left_border+($hdiv*30);
    }
   
   reset($lab_ResistAerobAcro);
   
	   /* 3rd column*/
	$sx=$left_border+($hdiv*33);
	$sy-=($vdiv*32);
   	while(list($x,$v)=each($lab_ResistAerobAcro))
	{
	
	   $sy+=$vdiv;
	   
       for($n=0;$n<3;$n++)
	   {			

	       list($x2,$v2)=each($lab_ResistAerob_3);
	       if($parsed_resist_aerob[$v2])
	       {
		       doFilledBlock();
		    }
		    else
		    {
			   doBlock();
		    }
		 
		 doWriteTop($LDSMR[$n]);
         $sx+=$hdiv; /* Advance to the right */
		 
	   }
	   $sx=$left_border+($hdiv*33);
    }
   
   reset($lab_ResistAerobAcro);
   
   /* The 4th column group of resistance test aerobes*/
	$sy-=($vdiv*32);
	
   $tr_tracker=0;
   $rx_tracker=0;
   
   	while(list($x,$v)=each($lab_ResistAerobExtra))
	{
	   $sx=$left_border+($hdiv*37);
	   $sy+=$vdiv;
	    doWriteLeft($v);
		
	   if($tr_tracker==6)
	   {
	       doWriteTop($LDEye);
		   
	       if($parsed_resist_aerob['_rx_eye_'.$rx_tracker])
	       {
		       doFilledBlock();
		    }
		    else
		    {
			   doBlock();
		    }

	       $tr_tracker++;
	   }
	   elseif($tr_tracker==7)
	   {
	       doWriteTop($LDBAC[$rx_tracker]);

	       if($parsed_resist_aerob['_rx_bac_'.$rx_tracker])
	       {
		       doFilledBlock();
		    }
		    else
		    {
			   doBlock();
		    }


	       $tr_tracker=0;
	       $rx_tracker++;
	   }
	   else
	   {	  

       for($n=0;$n<3;$n++)
	   {			

	       list($x2,$v2)=each($lab_ResistAerobExtra_1);
	       if($parsed_resist_aerob[$v2])
	       {
		       doFilledBlock();
		    }
		    else
		    {
			   doBlock();
		    }

            doWriteTop($LDSMR[$n]);	
			$sx+=$hdiv;
	   }
			   
	   $tr_tracker++;
	   }
    }
   
   reset($lab_ResistAerobExtra);   
   
   /* Initial test findings elements */
   $sy=$top_border+($vdiv*33);
   $sx=$left_border+($hdiv*12);
	
   if($parsed_findings['_tr_blocker_neg']) // blocker negative
   {
	   doFilledBlock();
	}
	else
	{
	    doBlock();
    }

    doWrite($LDBlockerNeg);	
   
   $sx+=($hdiv*6);
	
   if($parsed_findings['_tr_blocker_pos']) // blocker positive
   {
	   doFilledBlock();
	}
	else
	{
	    doBlock();
    }

    doWrite($LDBlockerPos);	
	
	$sy+=$vdiv;
	$sx=$left_border;
	
      if($parsed_findings['_tr_mark_streptococcus']) // mark streptococcus
   {
	   doFilledBlock();
	}
	else
	{
	    doBlock();
    }

    doWrite($LDMarkStreptocResistance);	

	$sx=$left_border+($hdiv*12);;
	
      if($parsed_findings['_tr_pathogenless']) // pathogen count <10^5
   {
	   doFilledBlock();
	}
	else
	{
	    doBlock();
    }

    doWrite($LDBacNr_LT);	
	
	$sx+=($hdiv*5);;
	
      if($parsed_findings['_tr_pathogenmore']) // pathogen count >10^5
   {
	   doFilledBlock();
	}
	else
	{
	    doBlock();
    }

    doWrite($LDBacNr_GT);		
	
	$sx+=($hdiv*5);;
	
      if($parsed_findings['_tr_patho_neg']) // pathogen count negative
   {
	   doFilledBlock();
	}
	else
	{
	    doBlock();
    }

    doWrite($LDBacNrNeg);		
	
	/* Column markers for findings group */
	$sy+=($vdiv*2);
	$sx=$left_border;
	for($i=0;$i<3;$i++)
	{
	   doWriteTop('I');
	   $sx+=$hdiv;
	   doWriteTop('II');
	   $sx+=$hdiv;
	   doWriteTop('III');
	   $sx+=($hdiv*7);
	}
	
	/* First group of findings */
	$sx=$left_border;
	$tr_tracker=0;
	
	while(list($x,$v)=each($lab_TestResultId_1))
	{


       for($n=0;$n<3;$n++)
	   {			

	       list($x2,$v2)=each($lab_TestResult_1);
	       if($parsed_findings[$v2])
	       {
		       doFilledBlock();
		    }
		    else
		    {
			   doBlock();
		    }
	       if($n==2)
		   { 
	         doWrite($v);
		     $sx+=($hdiv*7);
			}
			else
			{
			  $sx+=$hdiv;
			}
	   }

	   
	   if($tr_tracker>1)
	   {
	     $tr_tracker=0;
		 $sy+=$vdiv;
	     $sx=$left_border;
	    }
	     else $tr_tracker++;

    }	
	
	/* Second group of findings */
	$sy+=$vdiv;
	$sx=$left_border;
	
   	while(list($x,$v)=each($lab_TestResultId_2))
	{
	       list($x2,$v2)=each($lab_TestResult_2);
	       if($parsed_findings[$v2])
	       {
		       doFilledBlock();
		    }
		    else
		    {
			   doBlock();
		    }
	         doWrite($v);
	   if($tr_tracker>1)
	   {
	      $tr_tracker=0;
		  $sx=$left_border;
		  $sy+=$vdiv;
	    }
	    else
		{  
		   $tr_tracker++;
		   $sx+=($hdiv*9);
		   
		}
	  
    }	
	
	/* Output the image form */	
	Imagepng($im);
	ImageDestroy($im);

?>

