<?php

if (eregi('pageheader1.php',$PHP_SELF)){
	die('<meta http-equiv="refresh" content="0; url=../../../">');
}

#Get care logo
$imgsize=GetImageSize($logo);
$pdf->addPngFromFile($logo,20,780,$imgsize[0]);
# Attach logo
$diff=array(199=>'Ccedilla',208=>'Gbreve',
             221=>'Idotaccent',214=>'Odieresis',
             222=>'Scedilla',220=>'Udieresis',
             231=>'ccedilla',240=>'gbreve',
             253=>'dotlessi',246=>'odieresis',
	     254=>'scedilla',252=>'udieresis',
             226=>'acircumflex');
$pdf->selectFont($fontpath.'cour.afm'
       ,array('encoding'=>'WinAnsiEncoding'
             ,'differences'=>$diff));
$pdf->ezStartPageNumbers(550,25,8);
# Get the main informations
if(!isset($GLOBAL_CONFIG)) $GLOBAL_CONFIG=array();
include_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob=& new GlobalConfig($GLOBAL_CONFIG);
# Get all config items starting with "main_"
$glob->getConfig('main_%');

$addr[]=array($GLOBAL_CONFIG['main_info_address'],
						"$LDPhone:\n$LDFax:\n$LDEmail:",
						$GLOBAL_CONFIG['main_info_phone']."\n".$GLOBAL_CONFIG['main_info_fax']."\n".$GLOBAL_CONFIG['main_info_email']."\n"
						);
$pdf->ezTable($addr,'','',array('xPos'=>165,'xOrientation'=>'right','showLines'=>0,'showHeadings'=>0,'shaded'=>0,'fontsize'=>6,'cols'=>array(1=>array('justification'=>'right'))));
?>
