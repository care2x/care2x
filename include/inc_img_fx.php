<?php
/* These are functions for image routines */

# Initialize themes and paths 
//$theme_control='blue_aqua'; // Temporary initial theme
//$theme_control='aqua'; // Temporary initial theme
//$theme_control=$GLOBAL_CONFIG['theme_control_buttons'];
//$theme_com_icon='default'; // Temporary initial theme
//$theme_com_icon='winter_jelias'; // Temporary initial theme
//$theme_logo='default';

$theme_logo='lopo';  // The logo theme


# Create global config object

if(!isset($GLOBAL_CONFIG)||!is_array($GLOBAL_CONFIG)) $GLOBAL_CONFIG=array();
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$gc=new GlobalConfig($GLOBAL_CONFIG);


# Set the control buttons theme

if(!isset($cfg['control_buttons'])||empty($cfg['control_buttons'])){
	$gc->getConfig('theme_control_buttons');
	if(!isset($GLOBAL_CONFIG['theme_control_buttons'])||empty($GLOBAL_CONFIG['theme_control_buttons'])){
		$theme_control='default'; // this is the last default theme if the global item is not available, change this to the desired mascot theme
	}else{
		$theme_control=$GLOBAL_CONFIG['theme_control_buttons'];
	}
}else{
	$theme_control=$cfg['control_buttons'];
}


# Set the mascot theme

if(!isset($cfg['mascot'])||empty($cfg['mascot'])){
	$gc->getConfig('theme_mascot');
	if(!isset($GLOBAL_CONFIG['theme_mascot'])||empty($GLOBAL_CONFIG['theme_mascot'])){
		$theme_mascot='default'; // this is the last default theme if the global item is not available, change this to the desired mascot theme
	}else{
		$theme_mascot=$GLOBAL_CONFIG['theme_mascot'];
	}
}else{
	$theme_mascot=$cfg['mascot'];
}

# Set the common icons theme/style

if(!isset($cfg['icons'])||empty($cfg['icons'])){
	$gc->getConfig('theme_common_icons');
	if(!isset($GLOBAL_CONFIG['theme_common_icons'])||empty($GLOBAL_CONFIG['theme_common_icons'])){
		$theme_com_icon='default'; // this is the last default theme if the global item is not available, change this to the desired mascot theme
	}else{
		$theme_com_icon=$GLOBAL_CONFIG['theme_common_icons'];
	}
}else{
	$theme_com_icon=$cfg['icons'];
}

//$theme_mascot='none';
//$theme_mascot='default';
$theme_skin='default';

$img_path_control='gui/img/control/'.$theme_control.'/';  # the path for language dependent control buttons
$img_path_com_icon='gui/img/common/'.$theme_com_icon.'/'; # the path for non-language dependent common icons
$img_path_mascot='gui/img/mascot/'.$theme_mascot.'/'; # the path for non-language dependent mascot
$img_path_skin='gui/img/skin/'.$theme_skin.'/'; # the path for non-language dependent mascot

/**
* createLDImgSrc will display a language dependent image
* if the filename does not exists, the default version will be displayed
* It also receives the root of the image and creates the width and height values
* param $fn = filename of the image
* param $froot = root of the image
* param $align = alignment of the image
* param $border = image border value
* return = root + image filename
*/

function createLDImgSrc($froot, $fn, $border='', $align='')
{
   global $lang, $theme_control, $img_path_control;
   
   //return 1;
	if(file_exists($froot.$img_path_control.$lang.'/'.$lang.'_'.$fn)){
		$picfile_path=$froot.$img_path_control.$lang.'/'.$lang.'_'.$fn;
	}elseif(file_exists($froot.'gui/img/control/default/'.$lang.'/'.$lang.'_'.$fn)){
		$picfile_path=$froot.'gui/img/control/default/'.$lang.'/'.$lang.'_'.$fn;
	}else{
		$picfile_path=$froot.'gui/img/control/default/'.LANG_DEFAULT.'/'.LANG_DEFAULT.'_'.$fn;
	}
	
	$picsize=GetImageSize($picfile_path);
	  
	$picfilesrc='src="'.$picfile_path.'"';  
	if($border!='') $picfilesrc.=' border='.$border;
	if($align) $picfilesrc.=' align="'.$align.'"';
	  
	$picfilesrc.=' '.$picsize[3];
	  
	return $picfilesrc;
}

/**
* createComIcom = create common icon
* displays the common non-language dependent icon
* param 1 = root path
* param 2 = icon's file name
* param 3 = border size
* param 4 = alignment
* param 5 = FALSE = the icon can be hidden based on the user config, TRUE = the icon will be shown always
*/
function createComIcon($froot, $fn, $border='', $align='', $show_always=TRUE)
{
   global $lang, $theme_com_icon, $img_path_com_icon;
	
   # if icon theme is  "no_icon", return a transparent pixel gif
   if($theme_com_icon == 'no_icon' && !$show_always){
	$picfile_path=$froot.'gui/img/common/default/pixel.gif';
   }
   elseif(file_exists($froot.$img_path_com_icon.$fn))
   {
      $picfile_path=$froot.$img_path_com_icon.$fn;
    }
	else
	{
        $picfile_path=$froot.'gui/img/common/default/'.$fn;
	}
   
	
	$picsize= @ GetImageSize($picfile_path);
	  
	$picfilesrc='src="'.$picfile_path.'"';  
	if($border!='') $picfilesrc.=' border='.$border;
	if($align) $picfilesrc.=' align="'.$align.'"';
	  
	$picfilesrc.=' '.$picsize[3];
	  
	return $picfilesrc;
}

/**
* createMascot = create mascot 
* displays the non-language dependent mascot
*/
function createMascot($froot, $fn, $border='', $align='')
{
   global $lang, $theme_mascot, $img_path_mascot;
   
   if(file_exists($froot.$img_path_mascot.$fn))
   {
      $picfile_path=$froot.$img_path_mascot.$fn;
    }
	else
	{
        $picfile_path=$froot.'gui/img/mascot/default/'.$fn;
	}
	
	$picsize= @ GetImageSize($picfile_path);
	  
	$picfilesrc='src="'.$picfile_path.'"';  
	if($border!='') $picfilesrc.=' border='.$border;
	if($align) $picfilesrc.=' align="'.$align.'"';
	  
	$picfilesrc.=' '.$picsize[3];
	  
	return $picfilesrc;
}

/**
*  createBgSkin will return the correct file path for the skin and background image
*/
function createBgSkin($froot,$fn)
{
   global $lang, $theme_skin, $img_path_skin;
   
   if(file_exists($froot.$img_path_skin.$fn))
   {
      $picfile_path=$froot.$img_path_skin.$fn;
    }
	else
	{
        $picfile_path=$froot.'gui/img/skin/default/'.$fn;
	}
	
  
	return $picfile_path;
}
   
/**
*  createLogo creates a logo image 
*/ 
function createLogo($froot, $fn, $border='', $align=''){
   global $lang, $theme_logo, $img_path_com_icon;
	# save the orig icon path
	$icon_path=$img_path_com_icon;
	# set the logo path
	$img_path_com_icon='gui/img/logos/'.$theme_logo.'/'.$lang.'/'; # the path for language dependent logo
	if(!file_exists($froot.$img_path_com_icon.$fn)){
		$img_path_com_icon='gui/img/logos/'.$theme_logo.'/'; # the path for default dependent logo
		if(!file_exists($froot.$img_path_com_icon.$fn)) $fn = 'care_logo.gif';
	}
	if(!file_exists($froot.$img_path_com_icon.$fn)) $img_path_com_icon='gui/img/logos/default/';

	# create the icon/logo
	$img_src=createComIcon($froot,$fn,$border,$align);
	# reset the orig icon path
	$img_path_com_icon=$icon_path;
	return $img_src;
}
/**
* Checks if the given icon (or non-language dependent image) exists
*/
function image_exists($froot, $fn)
{
   global $lang,  $img_path_com_con;
   
	if(file_exists($froot.$img_path_com_icon.$fn)){
		return TRUE;
	}else{
		return FALSE;
	}
}
/**
* Checks if the language dependent image exists
*/
function lang_image_exists($froot, $fn)
{
   global $lang, $img_path_control;
   
	if(file_exists($froot.$img_path_control.$lang.'/'.$lang.'_'.$fn)){
		return TRUE;
	}else{
		return FALSE;
	}
}

?>
