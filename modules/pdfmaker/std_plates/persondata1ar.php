<?php
include_once($root_path.'include/inc_t1ps_ar2uni.php');

$pataddress=$encounter['addr_str']." ".$encounter['addr_str_nr']."\n".$encounter['addr_zip']." ".$person_obj->CityTownName($encounter['addr_citytown_nr']);
//$pdf->Line(20,750,550,750);
$pdf->ezText("\n",6);
$data[]=array(ar2uni($pataddress),ar2uni("$LDAddress :"),'    ',ar2uni($encounter['name_first'])."\n".ar2uni($encounter['name_last'])."\n".formatDate2Local($encounter['date_birth'],$date_format)."\n\n".$encounter['pid'],ar2uni("$LDRegistryNr :\n\n$LDBday :\n$LDLastName :\n$LDFirstName :"));

$pdf->ezTable($data,'','',array('xPos'=>'right','xOrientation'=>'left','showLines'=>0,'fontSize'=>12,'showHeadings'=>0,'shaded'=>0,'cols'=>array(0=>array('justification'=>'right'))));
# Add the PID barcode
if(file_exists($pidbarcode)){
	$imgsize=GetImageSize($pidbarcode);
 	$pdf->addPngFromFile($pidbarcode,400,650,$imgsize[0],25);
}
$y=$pdf->ezText("\n",18);


# Add the person id picture
if(file_exists($idpic)){
	//$imgsize=GetImageSize($idpic);
 	$pdf->addJpegFromFile($idpic,40,655,70);
}

$pdf->setStrokeColor(0,0,0);
$pdf->setLineStyle(2);
$pdf->rectangle(20,650,555,110);
?>
