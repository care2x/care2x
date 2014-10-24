<?php
# Prepare the photo filename
if ($photo_filename=='' || $photo_filename=='nopic' || !file_exists($root_path.$photo_path.'/'.$photo_filename)){
   $img_source=createLDImgSrc($root_path,'x-blank.gif','0');
}else{
	$img_source='src="'.$root_path.$photo_path.'/'.$photo_filename.'" border=0 ';
	$img_size=GetImageSize($root_path.$photo_path.'/'.$photo_filename);
	if ($img_size[0]>137||$img_size[1]>150){
		if($img_size[1]>150) $buf=' height=150';
		if ($img_size[0]>137) $buf=' width=137';
		$img_source.=$buf;
	}else{ $img_source.=$img_size[3];}
}
?>
