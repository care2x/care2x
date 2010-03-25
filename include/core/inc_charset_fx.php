<?php
/**
* setCharSet returns the meta code to set the charset of the page based on the 
* language variable $lang.
* param $param_lang = the language currently used by the script
* global $lang = in case the parameter is not used
* return = the meta code with the appropriate charset
*/

function setCharSet($param_lang=''){
   global $lang, $root_path;
   
   $cs_ok=false;
   
   if(!$param_lang && $lang) $param_lang=$lang;
   
   # Try to get the charset code from the language file
   if(file_exists($root_path."language/$param_lang/tags.php")){
   		include_once($root_path."language/$param_lang/tags.php");
		if(isset($lang_charset)&&!empty($lang_charset))	$cs_ok=true;
	}	
   
   # If charset not available, find it here locally
   if(!$cs_ok){
		switch ($param_lang)
   		{
			case 'cs-iso': $lang_charset='iso-8859-2'; break;
			case 'fr': $lang_charset='iso-8859-1'; break;
		     case 'pl': $lang_charset='iso-8859-2'; break;
			default : $lang_charset='iso-8859-1';
		}
   }
   # return the meta code
   return '<meta http-equiv="Content-Type" content="text/html; charset='.$lang_charset.'">';
}
?>
