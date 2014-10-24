<?php
if (stristr($_SERVER['SCRIPT_NAME'],"inc_news_save.php")) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

# Load editor functions
require_once($root_path.'modules/news/includes/inc_editor_fx.php');
# Load date formatter
require_once($root_path.'include/core/inc_date_format_functions.php');
# Load image class 
require_once($root_path.'include/care_api_classes/class_image.php');
# Create image object
$img_obj=new Image;

# Clean the content
$newstitle=stripslashes($newstitle);
$preface=stripslashes($preface);
$newsbody=stripslashes($newsbody);

if (!isset($category)) $category=1;

# Clean the title
require('inc_newstitle_clean.php');
# Check if the uploaded image file is valid
$is_pic=@$img_obj->isValidUploadedImage($_FILES['pic']);
# Retrieve the filename extension
$picext=@$img_obj->UploadedImageMimeType();

$publishdate=@ formatDate2STD($publishdate,$date_format);
	
/* Prepare data set for saving */
$news=array( 'category'=>$category,
                     'title'=>$newstitle,
					 'preface'=>$preface,
					 'body'=>$newsbody,
					 'pic_mime'=>$picext,
					 'art_num'=>$artnum,
					 'author'=>$author,
					 'publish_date'=>$publishdate
					 );

require_once($root_path.'include/care_api_classes/class_news.php');
$newsobj=new News;
if($news_nr = $newsobj->saveNews($dept_nr,$news)) {
    if($is_pic)	{
	    # Get the news foto path from global config 					
		require_once($root_path.'include/care_api_classes/class_globalconfig.php');    
        $globobj=new GlobalConfig($GLOBALCONFIG);
		$globobj->getConfig('news_fotos_path');
					
	    if($GLOBALCONFIG['news_fotos_path']=='') $news_fotos_path=$root_path.'uploads/photos/news/'; /* default path */
	        else $news_fotos_path = $root_path.$GLOBALCONFIG['news_fotos_path']; 
				
	    $picfilename="$news_nr.$picext";
        $img_obj->saveUploadedImage($_FILES['pic'],$news_fotos_path,$picfilename);
	}
	header('Location: '.$fileforward.URL_REDIRECT_APPEND.'&nr='.$news_nr.'&mode=preview4saved'); exit;
}else{
    echo $img_obj->getLastQuery()."<p>$LDDbNoSave";
} 
?>
