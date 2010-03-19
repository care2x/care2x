<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/*
CARE2X Integrated Information System for Hospitals and Health Care Organizations and Services
Copyright (C) 2002,2003,2004,2005  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/

# Set graph height in pixel
$tabhi=100;
# Set graph column width in pixel
$tabcols=100;


if(!extension_loaded('gd')) dl('php_gd.dll');
# Prepare data
$data=explode('~',$d);

# Graph total length in pixels (colums x column nr)
$tablen=$tabcols*$cols;
# The x offset where the data will be plotted, default in the middle of column
$ox=$tabcols/2;
# Row height in pixels
$tabrows=$tabhi/10;
# low/high limit x in pixels
$lopix=$tabrows*2;
$hipix=$tabrows*8;
# normal range in pixels
$normpix=$hipix-$lowpix;
$Dn=sizeof($data);
$range=60;
$yofset=20;
# Get the max value
$nTmax=$hi;
for($i=0;$i<$Dn;$i++)	if(!empty($data[$i])&&($data[$i]>$nTmax)) $nTmax=$data[$i];
# Get the min value
if($lo) $nTmin=$lo; else $nTmin=$nTmax;
for($i=0;$i<$Dn;$i++)	if(!empty($data[$i])&&($data[$i]<$nTmin)) $nTmin=$data[$i];
# Prepare low/high normal range limits
if($hi){
	$nhi=$hi;
}else{
	$nhi=$nTmax;
}
if($lo){
	$nlo=$lo;
}else{
	$nlo=$nTmin;
}
# Check for out of pixel range
$ooRange=false;
if($hi&&$lo){
	if(($range*($nTmin-$lo)/($hi-$lo) +$yofset)<0){
		$ooRange=true;
		$nlo=$nTmin;
	}
	if(($range*($nTmax-$lo)/($hi-$lo) +$yofset)>$hi){
		$ooRange=true;
		$nhi=$nTmax;
	}
}

# Pixel y for lower limit, note it is in reverse = 0,0 is upper left corner
if($lo){
	if($hi){
		if($ooRange){
			$y2=100-(100*($lo-$nTmin)/($nTmax-$nTmin));
			$y1=100-(100*($hi-$nTmin)/($nTmax-$nTmin));
			$range=100;
			$yofset=0;
		}else{
			$y1=20;
			$y2=80;
		}	
	}else{
		$y1=0;
		$y2=80;
	}
}else{
	if($hi){
		# Pixel y for upper limit
		$y1=20;
		$y2=100;
	}else{
		$y1=100;
		$y2=100;
	}
}
$im = @ImageCreate ($tablen, $tabhi)
     or die ('Cannot Initialize new GD image stream');
// $background_color = ImageColorAllocate ($im, 205,225,236);
$background_color = ImageColorAllocate ($im, 255,255,255);
$li_green = ImageColorAllocate ($im, 204, 255, 204);
# Create the normal range block
ImageFilledRectangle($im,0,$y1,$tablen,$y2,$li_green);

$text_color = ImageColorAllocate ($im, 175, 204, 255);
$lo_color = ImageColorAllocate ($im, 0, 85, 0);
$black = ImageColorAllocate ($im, 0, 0, 0);
$blue = ImageColorAllocate ($im, 0, 0, 255);
$red = ImageColorAllocate ($im, 204, 0, 0);

for($i=$tabcols;$i<$tablen;$i+=$tabcols) ImageLine($im,$i,0,$i,$tabhi-1,$text_color);
for($i=$tabrows;$i<$tabhi;$i+=$tabrows) ImageLine($im,0,$i,$tablen-1,$i,$text_color);
ImageLine($im,0,$tabhi-1,$tablen-1,$tabhi-1,$text_color);

//**************** start tracing ***********************
$vbuf=array();

for($i=0;$i<sizeof($data);$i++){
#**************** begin of curve, plotting  data ***************

	$dybuf=$data[$i];
	if(empty($dybuf)){
		$ox=$ox+$tabcols;
	 	continue;
	}
	if(($range*($lo-$nlo)/($nhi-$nlo) +$yofset)<=0){
		ImageString($im,2,5,$y2-10,$lo,$lo_color);
	}else{
		ImageString($im,2,5,$y2-5,$lo,$lo_color);
	}
	if(($range*($hi-$nlo)/($nhi-$nlo) +$yofset)>=100){
		ImageString($im,2,5,$y1-3,$hi,$red);
	}else{
		ImageString($im,2,5,$y1-5,$hi,$red);
	}
	//ImageString($im,2,5,$y1-5,$hi.'-'.$y1,$red);
	
	$arc_color=$blue;
			
	if(is_numeric($dybuf))	{
		$dybuf=$range*($dybuf-$nlo)/($nhi-$nlo) +$yofset;
		$tcolor=$red;
		$fontsize=3;
		$tfx=$ox-8;
		if($dybuf>=100){
			//ImageString($im,3,($ox-3),5,$data[$i],$tcolor);
			$tfy=5;
			$dybuf=1;
		}elseif($dybuf<=0) {
			//ImageString($im,3,($ox-3),80,$data[$i],$tcolor); 
			$tfy=80;
			$dybuf=98;
		}else{
			if($data[$i]<$lo||$data[$i]>$hi) $tcolor=$red;
				else $tcolor=$black;
			$fontsize=2;
			$tfx=$ox+5;
			$tfy=$tabhi-$dybuf-5;
			$dybuf=$tabhi-$dybuf; # invert the values
		}
		ImageArc($im,$ox,$dybuf,4,4,0,360,$blue);
		if($ox1 || $oy1) ImageLine($im,$ox1,$oy1,$ox,$dybuf,$blue);
		ImageString($im,$fontsize,$tfx,$tfy,$data[$i],$tcolor);
	}
	$ox1=$ox;$oy1=$dybuf;
	//$xlb=$ox2;$ylb=$oy2;
	$ox+=$tabcols; 
}

header ('Content-type: image/PNG');
ImagePNG($im);
ImageDestroy ($im);
 ?>
