<?php
# This subroutine detects the ttf capability of the system and checks if the arial font is available

# If you want to enable ttf font rendering, set the following variable to TRUE.
# In some cases, if your system detects ttf capability but the text does not appear, you have to disable
# ttf font rendering. By default, ttf rendering is disabled due to inconsequent results from different php versions.

$ttf_render=FALSE;
//$ttf_render=TRUE;

# If the language is arabic or farsi, force TTF font to true
if($lang=='ar'||$lang=='fa'||$lang=='tr') $ttf_render=TRUE;


# Set the font type here

$ttf_fonttype='arial.ttf';

if($ttf_render){

	$font_path=$root_path.'main/imgcreator/';
	$ttf_ok=FALSE;
	# Check if TTF text possible
	if(function_exists('ImageTTFText')){
		# Workaround to avoid upper/lower case error

		if(file_exists($font_path.$ttf_fonttype)){
			$ttf_ok=TRUE;
			$arial=$font_path.$ttf_fonttype;
		}elseif(file_exists($font_path.strtoupper($ttf_fonttype))){

			$ttf_ok=TRUE;
			$arial=$font_path.strtoupper($ttf_fonttype);
		}
	}
}else{
	$ttf_ok=FALSE;
}
?>
