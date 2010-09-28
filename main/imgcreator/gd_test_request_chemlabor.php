<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr($_SERVER['SCRIPT_NAME'],'inc_test_request_gd_chemlabor.php')) 
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

function doWrite($item,$len=6)
{
   global $sx, $sy, $hdiv, $vdiv, $im, $pink, $black,  $left_border, $top_border, $mark_v_offset,$ewhite, $dark_pink, $bgcolor, $purple;
 
  // ImageFilledRectangle($im,($sx-$left_border),($sy-5),($sx+($hdiv*6)),($sy+5),$bgcolor);
   ImageString($im,1,($sx+14),($sy),$item,$purple);
   ImageLine($im,($sx-$left_border),($sy+10),($sx+($hdiv*$len)-8),($sy+10),$pink);
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


    /* Load the violet phone icon */
    if(file_exists($root_path.'gui/img/common/default/violet_phone2.png'))
	{
	   $v_phone = ImageCreateFrompng($root_path.'gui/img/common/default/violet_phone2.png');
	}
 
	
	/* Load the batch nr barcode */
    if(file_exists($root_path.'cache/barcodes/form_'.$batch_nr.'.png'))
	{
	   $fbc = ImageCreateFrompng($root_path.'cache/barcodes/form_'.$batch_nr.'.png');
	}

	/* Load the label nr barcode */
    if(file_exists($root_path.'cache/barcodes/lab_'.$batch_nr.'.png'))
	{
	   $lab_bc = ImageCreateFrompng($root_path.'cache/barcodes/lab_'.$batch_nr.'.png');
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
    $black = ImageColorAllocate ($im, 000, 000, 000);
	$pink=ImageColorAllocate ($im, 255, 206, 206);
	$light_pink=ImageColorAllocate ($im, 255, 243, 243);
	$dark_pink=ImageColorAllocate ($im, 238, 102, 102);
	$red=ImageColorAllocate ($im, 255, 0, 0);
	$green=ImageColorAllocate ($im, 0, 255, 0);
	$yellow=ImageColorAllocate ($im, 255, 255, 0);
    
	/*calculate the divisions */
	$hdiv=(int)$w/42;
	$vdiv=(int)$h/81;
	/* fill the form with color */
	ImageFillToBorder($im,2,2,$blue, $light_pink);
	
	$lab_x1=(int)($w-($label_w))/2;
	$lab_y1=(int)($label_h+1);
	ImageFilledRectangle($im,($lab_x1-7),1,($lab_x1+$label_w+14),($lab_y1+14),$dark_pink);
	/* Copy the patient label into the form */
	ImageCopy($im,$label,($lab_x1+4),8,0,0,$label_w,$label_h);
	 
	 /* Write the info part */
	 
	ImageString($im,5,$left_border,15,$LDHospitalName,$dark_pink);
	ImageString($im,4,$left_border,30,$LDCentralLab,$dark_pink);
	
	/* Create the synchronizing blocks on the right edge of the form */
	doSyncBlocks(); 

    /* Create Room nr box */
	
	ImageRectangle($im,15,80,150,115,$dark_pink);
	ImageFilledRectangle($im,16,81,149,114,$ewhite);
	
	ImageString($im,1,19,83,$LDRoomNr,$purple);
	ImageString($im,4,22,90,$stored_request['room_nr'],$dark_pink);
	
	/* Create the Sampling time info */
	$sx=$left_border; // set start x 
	$sy=$top_border+($vdiv*10); // set start y column
	
	ImageString($im,1,($sx),($sy-4),$LDSamplingTime,$purple);
    $sx+=($hdiv*5); /* advance to right */
	ImageString($im,1,($sx),($sy-4),$LDDay,$purple);
    $sx+=($hdiv*2); /* advance to right */
	ImageString($im,1,($sx),($sy-4),$LDMinutes,$purple);
	
	
	$sy+=$vdiv; // advance to next row
	$sx=$left_border; // set start x 

	/* Sampling day */
   $day_names=(int)$stored_request['sample_weekday'];
	  
    if(!$day_names) $day_names=7;
	
	for($i=1;$i<8;$i++)
	{
	   if($day_names==$i)
	  {
		  doFilledBlock();
	   }
		else
	   {
		 doBlock();
	   }
	   
	   ImageString($im,1,($sx+1),($sy-8),$LDShortDay[$i],$dark_pink);
	   $sx+=$hdiv;
	   
	}
  
    /* Sampling time */  
    list($hour,$quarter_mins)=explode(":",$stored_request['sample_time']);
 
   if($quarter_mins>44)
   {
     $quarter_mins=45;
   }
   elseif($quarter_mins>29)
   {
     $quarter_mins=30;
   }
   elseif($quarter_mins>14)
   {
     $quarter_mins=15;
   }
   else $quarter_mins=0;

	/* For the 10's */
	  if($quarter_mins==15)
	  {
		  doFilledBlock();
	   }
		else
	   {
		 doBlock();
	   }
	   ImageString($im,1,($sx+1),($sy-8),15,$dark_pink);
	   $sx+=$hdiv; /* advance to right */

	   
	/* For the 30's */

	   if($quarter_mins==30)
	  {
		  doFilledBlock();
	   }
		else
	   {
		 doBlock();
	   }
	   ImageString($im,1,($sx+1),($sy-8),30,$dark_pink);
	   $sx+=$hdiv; /* advance to right */
	   
	/* For the 45's */
	   if($quarter_mins==45) 
	  {
		  doFilledBlock();
	   }
		else
	   {
		 doBlock();
	   }
	   ImageString($im,1,($sx+1),($sy-8),45,$dark_pink);
	   $sx+=$hdiv; /* advance to right */
	  
   $sy+=$vdiv; /* Advance to next row */
   $sx=$left_border+$hdiv;
   	  
   /* 10's hours */	 
   if($hour>19)
   {
     $hour_tens=20;
	 $hour_ones=$hour-$hour_tens;
   }
   elseif($hour>9)
   {
     $hour_tens=10;
	 $hour_ones=$hour-$hour_tens;
   }
   else
   {
    $hour_ones=$hour;
   }	  
	   if($hour_tens==10)
	  {
		  doFilledBlock();
	   }
		else
	   {
		 doBlock();
	   }
	   ImageString($im,1,($sx+1),($sy-7),10,$dark_pink);
	   $sx+=$hdiv; /* advance to right */

	   if($hour_tens==20)
	  {
		  doFilledBlock();
	   }
		else
	   {
		 doBlock();
	   }
	   ImageString($im,1,($sx+1),($sy-7),20,$dark_pink);
	   $sx+=($hdiv*5); /* advance to right */
	   ImageString($im,1,($sx),($sy-4),$LDHours,$purple);
	   
	/* 1's hours */
	
   $sy+=$vdiv; /* Advance to next row */
   $sx=$left_border;
	
	
	for($i=0;$i<10;$i++)
	{
	   if($hour_ones==$i)
	  {
		  doFilledBlock();
	   }
		else
	   {
		 doBlock();
	   }
	   ImageString($im,1,($sx+1),($sy-7),$i,$dark_pink);
	   $sx+=$hdiv; /* advance to right */
	}
	
	/*Urgent*/
   $sy+=$vdiv; /* Advance to next row */
   $sx=$left_border;
    ImageString($im,1,($sx),($sy),$LDUrgent,$purple);
   $sx=$left_border+($hdiv*4);
   $urgent = $stored_request['urgent'];
   if($urgent == '1') {
   		doFilledBlock();
   } else {
   		doBlock();
   }
   /* end urgent */
   
	/* Write batch nr */
   $sy+=$vdiv; /* Advance to next row */
   $sx=$left_border;
    ImageString($im,1,($sx),($sy),$LDBatchNr,$purple);
   $sx=$left_border+($hdiv*4);
    ImageString($im,2,($sx),($sy),$stored_request['batch_nr'],$purple);

	/* Create the batch nr code */
	$sy=$top_border+($vdiv*14);
	/* Added because i fave add a row for the urgent marker */
	$sy+=$vdiv; /* Advance to next row */
	for($i=0,$sx=($left_border+($hdiv*10));$i<30; $i++, $sx=$sx+$hdiv)
	{
	    doBlock();
	}

   
	/* Create initialization markers */
	$sy=$top_border+$vdiv;
	$sx=$left_border+($hdiv*30);
	doBlock();
	
	$sx=$left_border+($hdiv*33);
	doFilledBlock();
	
	$sx=$left_border+($hdiv*34);
	doFilledBlock();
	
	$sx=$left_border+($hdiv*39);
	doFilledBlock();
	
	$sx=$left_border+($hdiv*40);
	doFilledBlock();
	
	/* Create the case number markers */
	
	$sy=$top_border+$vdiv;
	
	for($n=0;$n<8;$n++)
	{

	   $sy+=$vdiv;
	   
       for($i=0,$sx=($left_border+($hdiv*30));$i<10;$i++,$sx=$sx+$hdiv)
	   {
	          ImageString($im,1,($sx+3),($sy-6),$i,$dark_pink);
			  
			  if(substr($fen,$n,1)==$i) doFilledBlock();
			  else doBlock();
        }
	}

	/* Place the form batch nr barcode */
	
	$sx=$left_border+($hdiv*37);
	$sy=$top_border+($vdiv*11)-10;
	
    ImageString($im,2,($sx),($sy),$stored_request['batch_nr'],$purple);
	$sx=$left_border+($hdiv*32);
	$sy+=$vdiv;
	
   /* Copy the batch nr barcode into the form */
	if($fbc) ImageCopy($im,$fbc,$sx,$sy,6,7,139,28);

	
	/* Now Create the form elements */

  //$tdcount=0; /* $tdcount limits the number of  columns (7) for test elements */
  
  $sy=$top_border+($vdiv*16); /* Set the first row's y-dim */
 // $tdcount=0;
  $sx=$left_border;
  for($i=0;$i<=$max_row;$i++) {
	if($i>$max_row) $len=5; else $len=6;  
	for($j=0;$j<=$column;$j++) {	
			/* write the param group */
			if($LD_Elements[$j][$i]['type']=='top') {
				doTitel($LD_Elements[$j][$i]['value'],$len);
				$sx+=($hdiv*$len); /* Move to next column */			
			} else {
				/* Write the item */
	    		doWrite($LD_Elements[$j][$i]['value'],$len); 
				if( $stored_param[$LD_Elements[$j][$i]['id']] == 1) {
					doFilledBlock();
				} else {
					doBlock();
				}
				$sx+=($hdiv*$len); /* Move to next column */			
			}
	}
	$sy+=$vdiv; /* Adjust to next row */
	$sx=$left_border;
  }

	/* Create the lower  boxes for the doctor's sign, etc. */
	$sx=1;
	$sy=$top_border+($vdiv*66);
	
	ImageRectangle($im,$sx,($sy+10),($sx+($hdiv*16)),($sy+($vdiv*2.5)),$dark_pink);
	ImageRectangle($im,($sx+($hdiv*17)),($sy+10),($sx+($hdiv*40)),($sy+($vdiv*2.5)),$dark_pink);
		
	/* Convert any possible html special chars to normal chars and print the text */	
	$translation_table= array_flip(get_html_translation_table(HTML_SPECIALCHARS));

	ImageString($im,2,($sx+$left_border),($sy+15),strtr($stored_request['doctor_sign'],$translation_table),$dark_pink);
	ImageString($im,2,($sx+($hdiv*17)+4),($sy+15),strtr($stored_request['notes'],$translation_table),$dark_pink);

 	/* Write the notices below */		
	$sy=$top_border+($vdiv*68)+8;
	ImageString($im,3,($sx+$left_border),($sy),$LDEmergencyProgram,$purple);
	$sx=($sx+($hdiv*26));
	$sy=$top_border+($vdiv*68)+11;
	showPhone();
	$sy=$top_border+($vdiv*68)+8;
	ImageString($im,3,($sx+10),($sy),$LDPhoneOrder,$purple);
	
	/* Create white background */
	
	$sy=$top_border+($vdiv*70);
	
	ImageFilledRectangle($im,1,$sy,($w-2),($h-2),$white);
	
	/* Create the bloodsugar & glucose label barcodes */
	$sx=$left_border+$hdiv;
	$sy=$top_border+($vdiv*73)-4;
	/* Copy the lab barcode into the form */
	for($i=0;$i<6;$i++)
	{
	    ImageCopy($im,$lab_bc,$sx,$sy,38,16,73,25);
        if($i==2)
		{
	         $sx=$left_border+$hdiv;
	        $sy=$top_border+($vdiv*77)-4;
	     }
		 else
		 {
		    $sx+=($hdiv*5);
		 }
     }

	 $sy=$top_border+($vdiv*72);
	/* Write the horizontal batch nr.s */
	$sugar=array('',$LDSober,$LD9Hour,$LD15Hour,$LDBloodPlasma,$LDBloodSugar,$LDBloodSugar1);
	
	for($i=3,$n=1;$i<16;$i+=5,$n++)
	{
	   $sx=$left_border+($hdiv*$i)-10;
	   ImageString($im,2,($sx-13),($sy-6),$stored_request['batch_nr'],$black);
	   ImageString($im,1,($sx-$hdiv),($sy-$vdiv),$n,$dark_pink);
	   ImageString($im,1,($sx),($sy-$vdiv),$sugar[$n],$dark_pink);
	   ImageStringUp($im,1,($sx+($hdiv*3)-3),($sy+($vdiv*2)+6),$LDGlucose.' '.$n,$dark_pink);
	   if($n==3)
	   {
	     $i=(-2);
		 $sy+=($vdiv*4);
	    }
	 }
		
			 
	/* Create the RGY vertical bars*/	
	// red	 
	$sx=$left_border+($hdiv*22);
	$sy=$top_border+($vdiv*70);
	ImageFilledRectangle($im,$sx,($sy+10),($sx+10),($sy+($vdiv*5)-6),$red);
	ImageStringUp($im,1,($sx-15),($sy+($vdiv*5)-6),$LDHematology,$dark_pink);
	// green
	$sx=$left_border+($hdiv*28);
	ImageFilledRectangle($im,$sx,($sy+10),($sx+10),($sy+($vdiv*5)-6),$green);
	ImageStringUp($im,1,($sx-15),($sy+($vdiv*5)-6),$LDCoagulation,$dark_pink);
	// yellow
	$sx=$left_border+($hdiv*34);
	ImageFilledRectangle($im,$sx,($sy+10),($sx+10),($sy+($vdiv*5)-6),$yellow);
	ImageStringUp($im,1,($sx-15),($sy+($vdiv*5)-6),$LDUrine,$dark_pink);
	// white
	$sx=$left_border+($hdiv*40);
	ImageFilledRectangle($im,$sx,($sy+10),($sx+10),($sy+($vdiv*5)-6),$white);
	ImageStringUp($im,1,($sx-15),($sy+($vdiv*5)-6),$LDSerum,$dark_pink);
	
	/* Write the vertical batch nr.s */
	for($i=23,$n=0;$i<42;$i+=6,$n++)
	{
	   $sx=$left_border+($hdiv*$i)-10;
	   ImageStringUp($im,2,($sx-13),($sy+($vdiv*5)-6),$stored_request['batch_nr'],$black);
	   if($n==3)
	   {
	     $i=17;
		 $sy+=($vdiv*4);
	    }
		 if($n>2) ImageStringUp($im,1,($sx-22),($sy+($vdiv*5)-6),$LDSerum,$dark_pink);
	 }
	
	/* Create the Urin,Serum,etc. label barcodes */
	$sx=$left_border+($hdiv*17);
	$sy=$top_border+($vdiv*72);
	/* Copy the lab barcode into the form */
	for($i=0;$i<8;$i++)
	{
	    ImageCopy($im,$lab_bc,$sx,$sy,38,16,73,41);
        if($i==3)
		{
	        $sx=$left_border+($hdiv*17);
	        $sy=$top_border+($vdiv*76);
	     }
		 else
		 {
		    $sx+=($hdiv*6);
		 }
     }
			 
		
	/* Output the image form */	
	Imagepng($im);
	ImageDestroy($im);

?>

