<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
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


# Get the max test value
$nTmax=$hi;
for($i=0;$i<$Dn;$i++)        if(!empty($data[$i])&&($data[$i]>$nTmax)) $nTmax=$data[$i];
# Get the min test value
if($lo) $nTmin=$lo; else $nTmin=$nTmax;
for($i=0;$i<$Dn;$i++)        if(!empty($data[$i])&&($data[$i]<$nTmin)) $nTmin=$data[$i];


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


$ooRange=false;
if($hi||$lo){
        if(($range*($nTmin-$nlo)/($nhi-$nlo) +$yofset)<0){
                $ooRange=true;
                $nlo=$nTmin;
        }
        if(($range*($nTmax-$nlo)/($nhi-$nlo) +$yofset)>$tabhi){
                $ooRange=true;
                $nhi=$nTmax;
        }
}

if($ooRange){
	$range=100;
	$yofset=0;
}

# Pixel y for lower limit, note it is in reverse = 0,0 is upper left corner
if($lo){
        if($hi){
                if($ooRange){
                        $y1=100-(100*($hi-$nTmin)/($nTmax-$nTmin));
                        $y2=100-(100*($lo-$nTmin)/($nTmax-$nTmin));
                }else{
                        $y1=20;
                        $y2=80;
                }        
        }else{
                $y1=0;
                if($ooRange){
                        $y2=100-(100*($lo-$nTmin)/($nTmax-$nTmin));
                }else{
                	$y2=80;
                }        
        }
}else{
        if($hi){
                # Pixel y for upper limit
                $y2=100;
                if($ooRange){
                        $y1=100-(100*($hi-$nTmin)/($nTmax-$nTmin));
                }else{
                $y1=20;
				}
        }else{
				# y1 = y2 will draw no rectangle
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

$text_color = ImageColorAllocate ($im, 175, 204, 255);
$lo_color = ImageColorAllocate ($im, 0, 85, 0);
$black = ImageColorAllocate ($im, 0, 0, 0);
$blue = ImageColorAllocate ($im, 0, 0, 255);
$red = ImageColorAllocate ($im, 204, 0, 0);

# Draw the normal range background rectangle
//if($hi&&$lo)
        ImageFilledRectangle($im,0,$y1,$tablen,$y2,$li_green);

for($i=$tabcols;$i<$tablen;$i+=$tabcols) ImageLine($im,$i,0,$i,$tabhi-1,$text_color);
for($i=$tabrows;$i<$tabhi;$i+=$tabrows) ImageLine($im,0,$i,$tablen-1,$i,$text_color);
ImageLine($im,0,$tabhi-1,$tablen-1,$tabhi-1,$text_color);

# Print the lo or hi normal range boundaries
if($lo) ImageString($im,2,5,$y2-10,$lo,$black);
if($hi) ImageString($im,2,5,$y1-3,$hi,$black);

//**************** start tracing ***********************

for($i=0;$i<sizeof($data);$i++){
#**************** begin of curve, plotting  data ***************

        $dybuf=$data[$i];
        if(empty($dybuf)){
                $ox=$ox+$tabcols;
                 continue;
        }
                        
        if(is_numeric($dybuf)){

                $dybuf=$range*($dybuf-$nlo)/($nhi-$nlo) + $yofset;

                if($data[$i]<$lo||($hi&&$data[$i]>$hi)){
						 $tcolor=$red;
						 if(($dybuf>=100 or $dybuf<=0)){
						 	$fontsize=3;
                        	$tfx=$ox-8;
						 }else{
							$fontsize=2;
							$tfx=$ox+5;
						}
                }else{
					$tcolor=$blue;
					$fontsize=2;
					$tfx=$ox+5;
				}
                $dybuf=$tabhi-$dybuf; # invert the values

                # shrinking plotting area by 4 pixels at the bottom
                if($dybuf<=0) $dybuf=1; else $dybuf = $dybuf*($tabhi-4)/$tabhi;
                
                # put label at the bottom if dybuf is close to top of chart
                if($dybuf<15) $tfy=3; else $tfy=$dybuf-13;

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
