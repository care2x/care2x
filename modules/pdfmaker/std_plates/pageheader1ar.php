<?php
/*
*  Modification for arabic version
* Walid Fathalla (Tripoli, Libya) <fathalla_w@yahoo.com>
* 2004 June
*/
include_once($root_path.'include/inc_t1ps_ar2uni.php');

if (eregi('pageheader1ar.php',$PHP_SELF)){
	die('<meta http-equiv="refresh" content="0; url=../../../">');
}

#Get care logo
$imgsize=GetImageSize($arlogo);
$pdf->addPngFromFile($arlogo,420,780,$imgsize[0]);
# Attach logo
$pdf->selectFont($fontpath.'TRIPOLI_.afm');
$pdf->ezStartPageNumbers(550,25,8);

# Get the main informations
if(!isset($GLOBAL_CONFIG)) $GLOBAL_CONFIG=array();
include_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob=& new GlobalConfig($GLOBAL_CONFIG);
# Get all config items starting with "main_"
$glob->getConfig('main_%');

$addr[]=array(ar2uni($GLOBAL_CONFIG['main_info_address']),$GLOBAL_CONFIG['main_info_phone']."\n".$GLOBAL_CONFIG['main_info_fax']."\n".$GLOBAL_CONFIG['main_info_email']."\n",ar2uni("$LDEmail :\n$LDFax :\n$LDPhone :"));
$pdf->ezTable($addr,'','',array('xPos'=>25,'xOrientation'=>'right','showLines'=>0,'showHeadings'=>0,'shaded'=>0,'fontsize'=>6,'cols'=>array(1=>array('justification'=>'right'))));
?>
