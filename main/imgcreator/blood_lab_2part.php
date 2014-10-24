<?php 
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/*
CARE2X Integrated Information System Deployment 2.1 - 2004-10-02 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002,2003,2004,2005  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/
if(!extension_loaded('gd')) dl('php_gd.dll');

header ("Content-type: image/png");

define("LANG_FILE","konsil.php");
define("NO_CHAIN",1);
require("inc_front_chain_lang.php");

$im =@ ImageCreateFromPNG("../img/blood_lab.png");
//$blue=ImageColorAllocate ($im, 0,0, 255);
//$green=ImageColorAllocate ($im, 153,255, 204);
$black = ImageColorAllocate ($im, 0, 0, 0);
//ImageColorTransparent($im,$green);
// *******************************************************************
// * the following code is for ttf fonts use only for php machines with ttf support
// *******************************************************************
/*
/* -------------- START ----------------------------------------------*/

/* -------------- END -------------------------------------------------*/


// ******************************************************************
// * the following code is the default - uses system fonts
// ******************************************************************

/* -------------- START  ----------------------*/
$txt=$LDNoOccList;
ImageString($im,4,37,8,$LDPB,$black); /* PB */
ImageString($im,4,35,24,$LD350,$black);
ImageString($im,4,35,55,$LDRB,$black);
ImageString($im,4,35,88,$LDLLRB,$black);
ImageString($im,4,35,121,$LDWRB,$black);
ImageString($im,4,35,154,$LDPRP_Initial,$black);
ImageString($im,4,35,187,$LDTC,$black);
ImageString($im,4,35,220,$LDFFP_Initial,$black);

ImageString($im,5,35,250,$LDLabServices,$black);/* Computation of lab services */

 /* Services codes */
ImageString($im,1,31,275,$LDServiceCode,$black);
ImageString($im,2,34,286,$LDBloodGroupCode,$black);
ImageString($im,2,34,300,$LDA_SubgroupCode,$black);
ImageString($im,2,34,314,$LDExtraBGFactorsCode,$black);
ImageString($im,2,34,330,$LDCoombsTestCode,$black);
ImageString($im,2,34,347,$LDAntibodyTestCode,$black);
ImageString($im,2,34,367,$LDCrossTestCode,$black);
ImageString($im,2,34,385,$LDAntibodyDiffCode,$black);

 /* Services description */
ImageString($im,2,75,286,$LDBloodGroup,$black);
ImageString($im,2,75,300,$LDA_Subgroup,$black);
ImageString($im,2,75,314,$LDExtraBGFactors,$black);
ImageString($im,2,75,330,$LDCoombsTest,$black);
ImageString($im,2,75,347,$LDAntibodyTest,$black);
ImageString($im,2,75,367,$LDCrossTest,$black);
ImageString($im,2,75,385,$LDAntibodyDiff,$black);

 /* Count & Price */
ImageString($im,2,264,272,$LDCount,$black);
ImageString($im,2,324,272,$LDPrice,$black);

 /* Total Amount */
ImageString($im,2,35,467,$LDTotalAmount,$black);

 /* Paste conserve number notice*/
ImageString($im,1,384,4,$LDConserveNrPaste,$black);
 /* Time stamp */
ImageString($im,1,384,250,$LDLabTimeStamp,$black);
 /* Release by, Ack */
ImageString($im,1,384,313,$LDReleaseVia,$black);
ImageString($im,1,557,313,$LDReceiptAck,$black);
 /*Main journal, lab-nr. */
ImageString($im,1,384,410,$LDLabLogBook,$black);
ImageString($im,1,557,410,$LDLabNumber,$black);
 /* Booked on, date*/
ImageString($im,1,384,440,$LDBookedOn,$black);
ImageString($im,1,557,440,$LDDate,$black);
 /* Signatures */
ImageString($im,1,384,394,$LDSignature,$black);
ImageString($im,1,557,394,$LDSignature,$black);
ImageString($im,1,384,472,$LDSignature,$black);
ImageString($im,1,557,472,$LDSignature,$black);

 /* Booked on, date*/
ImageStringUp($im,5,2,390,$LDFillByLab,$black);


/* -------------- END --------------------------*/

Imagepng ($im);
ImageDestroy ($im);
 ?>


