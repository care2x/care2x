<?php
/**
* @package care_api
*/
/**
*  Language methods. 
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Language {
	/**
	* Path to language files.
	*
	* Modify this path if you have placed the language tables somewhere else.
	* @var string
	*/			
	var $lang_path='language/';
	/**
	* Generates  a list of <options> of available languages for a  combo box .
	*
	* The <select> tags are not generated. This method must be called to insert only the <option> inside a <select> element
	* @param string  Language code
	* @return string
	*/			
	function createSelectForm($curr_lang){
		global $root_path;
		$str='';
		$handle=opendir($root_path.$this->lang_path.'.');
		$langdirs=array();
		while (false!==($langcode = readdir($handle))) { 
   			if ($langcode != '.' && $langcode != '..') {
				if(is_dir($root_path.$this->lang_path.$langcode)&&file_exists($root_path.$this->lang_path.$langcode.'/tags.php')){
				@include($root_path.$this->lang_path.$langcode.'/tags.php');
				if($langcode==$lang_iso_code) $langdirs[$lang_iso_code]=$lang_name;
				}
			} 
		}
		@ksort($langdirs,SORT_STRING);
		while(list($x,$v)=each($langdirs)){
			$str.= '<option value="'.$x.'"';
			if($curr_lang==$x) $str.='selected';
			$str.= '> '.$v.'</option>
			';
		}
		return $str;
	}
}
?>