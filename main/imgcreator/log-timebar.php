<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/*
CARE2X Integrated Information System for Hospitals and Health Care Organizations and Services
Copyright (C) 2002,2003,2004,2005  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/

 // globalize POST, GET, & COOKIE  vars

if(!extension_loaded('gd')) dl('php_gd.dll');

$tabhi=90;
$tablen=3000; //original length
$tabcols=$tablen/24;
$tabrows=$tabhi/6;

 header ("Content-type: image/PNG");

$im = @ImageCreate ($tablen, $tabhi)
     or die ("Cannot Initialize new GD image stream");
$background_color = ImageColorAllocate ($im, 255,255,255);
$text_color = ImageColorAllocate ($im, 0, 170, 255);
$black = ImageColorAllocate ($im, 0, 0, 0);
$red =ImageColorAllocate ($im, 255, 0, 0);

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/core/inc_db_makelink.php');
if($dblink_ok){	
	$sql="SELECT entry_out,cut_close,wait_time,bandage_time,repos_time FROM care_encounter_op 
			WHERE encounter_nr='$enc_nr' 
			AND dept_nr='$dept_nr' 
			AND op_room='$saal' 
			AND op_nr='$op_nr'";
	if($ergebnis=$db->Execute($sql)){
		$rows=$ergebnis->RecordCount();
		if($rows==1){
			$result=$ergebnis->FetchRow();
		}
	}else{exit;} 
}else{exit;}

$x=$tabcols/2;
$h=$tabrows*2;
$mincols=$tablen/(12*24);
$lock=1;

for($i=$tabrows;$i<$tabhi;$i+=$tabrows)
{
	ImageLine($im,0,$i,$tablen-1,$i,$text_color);

	for ($n=$mincols;$n<=$tablen;$n+=$mincols) 	
	{
		if($lock<12)
		{
 		ImageLine($im,$n,($h-($tabrows*0.30)),$n,$h-1,$text_color);
 		$lock++;
		}
		else{ $lock=1;}
	}
	$h+=$tabrows;
}

for ($h=$tabrows*2;$h<=$tabhi;$h+=$tabrows)	
ImageLine($im,($tabcols/4),$h-($tabrows*0.50),($tabcols/4),$h-1,$text_color);

for($i=$tabcols,$j=1;$i<=$tablen;$i+=$tabcols,$j++)
{
 ImageLine($im,$i,0,$i,$tabhi-1,$text_color);

 if($j>23) $j=0;
 // *******************************************************************
 // * the following code is for ttf fonts use only for php machines with ttf support
 // * uncomment the following line to use ttf font and comment the default line
 // *******************************************************************

 // ImageTTFText ($im, 12, 0,$i-7, 10, $red, "arial.ttf",$j);  

 // ******************************************************************
 // * the following code is the default - uses system fonts
 // * comment the following line if you use the ttf font line above
 // ******************************************************************

 ImageString($im,3,$i-7,3,$j,$red);

 for ($h=$tabrows*2;$h<=$tabhi;$h+=$tabrows)
	{
			ImageLine($im,$i-$x,($h-($tabrows*0.70)),$i-$x,$h-1,$black);
			ImageLine($im,$i-($tabcols/4),($h-($tabrows*0.50)),$i-($tabcols/4),$h-1,$text_color);
			ImageLine($im,$i+($tabcols/4),($h-($tabrows*0.50)),$i+($tabcols/4),$h-1,$text_color);
	}
}

ImageLine($im,0,$tabhi-1,$tablen-1,$tabhi-1,$text_color);

// * here starts the drawing of the time bars

$idx1=array("ein","schnitt","bwarte","bgips","brepos");
$idx2=array("aus","naht","ewarte","egips","erepos");
$element=array("entry_out","cut_close","wait_time","bandage_time","repos_time");

for($i=0,$j=1;$i<sizeof($element);$i++,$j++)
{
   $datarray=explode("~",trim($result[$element[$i]]));
   for($n=0;$n<sizeof($datarray);$n++)
   {
      parse_str($datarray[$n],$dat);

      if((!$dat['s']&&!$dat['e'])) continue;
	  
      if($dat['s']!=NULL)
      {
  	        $dat['s']=(float) $dat['s'];
  	        if($dat['s']==0) $dat['s']=0.01;
  	        $buf= (int) trim($dat['s']);
  	        $buff= (int) (($dat['s']-$buf)*100);
  	        $buff=$buf+($buff/60);
  	        //print $buff."<p> dats";
			
			// *******************************************************************
            // * the following code is for ttf fonts use only for php machines with ttf support
            // * uncomment the following line to use ttf font and comment the default line
            // *******************************************************************

  	        // ImageTTFText ($im, 9, 45,($buff*$tabcols),($tabrows*(0.50+$j)), $black, "arial.ttf",$dat['s']);

            // ******************************************************************
            // * the following code is the default - uses system fonts
            // * comment the following line if you use the ttf font line above
            // ******************************************************************
  	        ImageString($im,1,($buff*$tabcols),($tabrows*$j+1),strtr($dat['s'],'.',':'),$black);
      }
	  
  	  if($dat['e']!=NULL)
      {
  	        $dat['e']=(float) $dat['e'];
			
			// *******************************************************************
			// * uncomment the following line if you want to display midnight as 24.00
			// *******************************************************************
			
  	        //if($dat['e']==0) $dat['e']=24.00;
			
  	        $buf2=(int) trim($dat['e']);
  	        $buff2= (int) (($dat['e']-$buf2)*100);
  	        $buff2=$buf2+($buff2/60);

			// *******************************************************************
            // * the following code is for ttf fonts use only for php machines with ttf support
            // * uncomment the following line to use ttf font and comment the default line
            // *******************************************************************

  	        // ImageTTFText ($im, 9, 45,($buff2*$tabcols),($tabrows*(0.50+$j)), $black, "arial.ttf",$dat['e']);

            // ******************************************************************
            // * the following code is the default - uses system fonts
            // * comment the following line if you use the ttf font line above
            // ******************************************************************

  	        ImageString($im,1,($buff2*$tabcols),($tabrows*$j+1),strtr($dat['e'],'.',':'),$black);
      }
	  
 	  if(($buff<$buff2)||($dat['e']==NULL))
 	  {
  	        if(($dat['s']!=NULL)&&($dat['e']!=NULL)) ImageFilledRectangle($im,($buff*$tabcols),($tabrows*(0.65+$j)),($buff2*$tabcols),($tabrows*(0.85+$j)),$red);
  	        if(($dat['s']!=NULL)&&($dat['e']==NULL)) ImageFilledRectangle($im,($buff*$tabcols),($tabrows*(0.65+$j)),(($buff*$tabcols)+4),($tabrows*(0.85+$j)),$red);
  	        if(($dat['s']==NULL)&&($dat['e']!=NULL)) ImageFilledRectangle($im,(($buff2*$tabcols)+4),($tabrows*(0.65+$j)),($buff2*$tabcols),($tabrows*(0.85+$j)),$red);
	  }
	  else
	  {
  	        $blue = ImageColorAllocate ($im, 0, 0, 255);
  	        ImageFilledRectangle($im,($buff*$tabcols),($tabrows*(0.75+$j)),(24*$tabcols),($tabrows*(0.95+$j)),$blue);
  	        ImageFilledRectangle($im,(0.009*$tabcols),($tabrows*(0.75+$j)),($buff2*$tabcols),($tabrows*(0.95+$j)),$blue);
	  }
   }
}

ImagePNG($im); ImageDestroy ($im);

 ?>
