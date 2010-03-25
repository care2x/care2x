<?php
/**
* this include file will only work properly if the calling script has created an smarty template object named $smarty
*/

$nofile=0;

/**
 Reset elements
*/
$sBuffer ='';
$smarty->assign('sImgAlign',$picalign);
$smarty->assign('sHeadlineItemTitle','');
$smarty->assign('sNewsPreview','');
$smarty->assign('sPreface','');
$smarty->assign('sEditorLink','');

if($news[$j]){
	# First test for record nr. + mime combination of image filename
	# If not exists, try pic_file value + mime combination
	
		 $picpath=$root_path.$news_fotos_path.$news[$j]['nr'].'.'.$news[$j]['pic_mime'];
		 if(!file_exists($picpath)){
		 	$picpath=$root_path.$news_fotos_path.$news[$j]['pic_file'].'.'.$news[$j]['pic_mime'];
		}

		if(!empty($news[$j]['body']))
		{
		    $sBuffer = '<font size="'.$news_headline_title_font_size.'" face="'.$news_headline_title_font_face.'" color="'.$news_headline_title_font_color.'">';
			
			if ($news_headline_title_font_bold) $sBuffer = $sBuffer.'<b>';

			$sBuffer = $sBuffer.ucfirst(deactivateHotHtml(nl2br($news[$j]['title'])));
			
			if ($news_headline_title_font_bold) $sBuffer = $sBuffer.'</b>';
			

			
			if(file_exists($picpath)&& !empty($news[$j]['body']))
		   {
			    $picsize=GetImageSize($picpath);
		 	    
				$smarty->assign('sHeadlineImg','src="'.$picpath.'"');

				if(!$picsize||($picsize[0]>150)) $smarty->assign('sImgWidth','width="150"');
				    else $smarty->assign('sImgWidth',$picsize[3]);
		    }
			
			$sBuffer = $sBuffer.'</font>';

			$smarty->assign('sHeadlineItemTitle',$sBuffer);
			
		    $sBuffer ='<font size="'.$news_headline_preface_font_size.'" face="'.$news_headline_preface_font_face.'" color="'.$news_headline_preface_font_color.'">';

			if ($news_headline_preface_font_bold) $sBuffer = $sBuffer.'<b>';
			
			$sBuffer = $sBuffer.ucfirst (deactivateHotHtml(nl2br($news[$j]['preface'])));
			
			if ($news_headline_preface_font_bold) $sBuffer = $sBuffer.'</b>';

			$sBuffer = $sBuffer.'</font>';
			
			$smarty->assign('sPreface',$sBuffer);
			
		    $sBuffer = '<font size="'.$news_headline_body_font_size.'" face="'.$news_headline_body_font_face.'" color="'.$news_headline_body_font_color.'">';
			
			if ($news_headline_body_font_bold) $sBuffer = $sBuffer.'<b>';
			
			$sBuffer = $sBuffer.substr(deactivateHotHtml(nl2br($news[$j]['body'])), 0 ,$news_normal_preview_maxlen).'...';
			
			if ($news_headline_body_font_bold) $sBuffer = $sBuffer.'</b>';
			
			$sBuffer = $sBuffer.'</font>';
			
			$smarty->assign('sNewsPreview',$sBuffer);
			
		 	$smarty->assign('sEditorLink','<a href="'.$readerpath.'&nr='.$news[$j]['nr'].'&news_type=headline"><font size=1 color="#ff0000" face="arial">'.$LDMore.'...</a>');

		}
		else
		{
		 $nofile=1;
		 }
	} 

	if(!$news[$j]||$nofile)
	{ 
		$i=$j;
		
		$smarty->assign('sHeadlineImg',createComIcon($root_path,'pplanu-s.jpg','0','',TRUE));
		$smarty->assign('sImgAlign',$picalign);
		
		ob_start();


			if(file_exists($root_path."language/".$lang."/lang_".$lang."_newsdummy.php")) include ($root_path."language/".$lang."/lang_".$lang."_newsdummy.php");
		   	else include($root_path."language/en/lang_en_newsdummy.php");
			
			$sBuffer = ob_get_contents();
		
		ob_end_clean();
		
		$smarty->assign('sHeadlineItemTitle',$sBuffer);

		if(!isset($editor_path)||empty($editor_path)) $editor_path='editor-pass.php?sid='.$sid.'&lang='.$lang.'&target=headline&title='.$LDEditTitle;
		
		$smarty->assign('sEditorLink','<a href="'.$editor_path.'">'.$LDClk2Write.'</a>');
	}
?>
