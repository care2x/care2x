<?php
/**
This assigns the news data to the template 
Note: this script works only properly when the calling script has a smarty template object named "smarty"
*/
# Load the news display configs
require_once($root_path.'include/inc_news_display_config.php');

$picpath=$root_path.$news_fotos_path.$news['nr'].'.'.$news['pic_mime'];

if(!isset($picalign) || empty($picalign)) {
    $picalign=(!($news['art_num']%2))? 'right' : 'left';
}

$smarty->assign('sImgAlign',$picalign);


		   $sBuffer = '<font size="'.$news_headline_title_font_size.'" face="'.$news_headline_title_font_face.'" color="'.$news_headline_title_font_color.'">';
			if ($news_headline_title_font_bold)  $sBuffer = $sBuffer. '<b>';
			 $sBuffer = $sBuffer. ucfirst(deactivateHotHtml(nl2br($news['title'])));
			if ($news_headline_title_font_bold)  $sBuffer = $sBuffer. '</b>';
			
			if(file_exists($picpath)&& !empty($news['body']))
		   {
			    $picsize=GetImageSize($picpath);
		 	    
				$smarty->assign('sHeadlineImg','src="'.$picpath.'"');

				if(!$picsize||($picsize[0]>150)) $smarty->assign('sImgWidth','width="150"');
				    else $smarty->assign('sImgWidth',$picsize[3]);
		    }
			
			 $sBuffer = $sBuffer. '</font><br>';
			$smarty->assign('sHeadlineItemTitle',$sBuffer);
			
		     $sBuffer =  '<font size="'.$news_headline_preface_font_size.'" face="'.$news_headline_preface_font_face.'" color="'.$news_headline_preface_font_color.'">';

			if ($news_headline_preface_font_bold) $sBuffer = $sBuffer. '<b>';
			$sBuffer = $sBuffer. ucfirst (deactivateHotHtml(nl2br($news['preface'])));
			if ($news_headline_preface_font_bold) $sBuffer = $sBuffer. '</b>';

			$sBuffer = $sBuffer. '</font>';
			
			$smarty->assign('sPreface',$sBuffer);

		    $sBuffer =  '<font size="'.$news_headline_body_font_size.'" face="'.$news_headline_body_font_face.'" color="'.$news_headline_body_font_color.'">';
			if ($news_headline_body_font_bold) $sBuffer = $sBuffer. '<b>';
			$sBuffer = $sBuffer.deactivateHotHtml(nl2br($news['body']));
			if ($news_headline_body_font_bold) $sBuffer = $sBuffer. '</b>';
			$sBuffer = $sBuffer.'</font>';
			$smarty->assign('sNewsPreview',$sBuffer);

		 	$smarty->assign('sEditorLink',$LDWrittenFrom.' '.$news['author'].' '.$LDWrittenOn.' '.formatDate2Local($news['submit_date'],$date_format));
			
			$sBuffer = ($mode == 'preview4saved') ? $returnfile : $breakfile;
			
			$smarty->assign('sBackLink','<a href="'.$sBuffer.'"><img '.createComIcon($root_path,'l-arrowgrnlrg.gif','0').'> '.$LDBackTxt.'</a>');

?>
