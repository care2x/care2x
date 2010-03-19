<?php
# This subroutine detects the ttf capability of the system and checks if the arial font is available
// Modified on ( 22/01/2004) By Walid Fathalla
# Set the font type here
$ttf_fonttype='arial.ttf';
$font_path=$root_path.'main/imgcreator/';
	
	# Check if TTF text possible
	if(function_exists(ImageTTFText)){
		# Workaround to avoid upper/lower case error
		if(file_exists($font_path.$ttf_fonttype)){
			$ttf_ok=TRUE;
			$arial=$font_path.$ttf_fonttype;
		}elseif(file_exists($font_path.strtoupper($ttf_fonttype))){
			$ttf_ok=TRUE;
			$arial=$font_path.strtoupper($ttf_fonttype);
		}
	}

?>
