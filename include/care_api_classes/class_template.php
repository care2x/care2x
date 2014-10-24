<?php
/**
* @package care_api
*/
/**
*  Template methods. 
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance.
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Template{
	/**
	* Filename of the template.
	* @var string
	*/
	var $filename;
	/**
	* Template text.
	* @var string
	*/
	var $template;
	/**
	* Default template path, modify if you placed the template somewhere else. Will be attempted for use if the path is not passed the object.
	* @var string 
	*/
	var $default_path='gui/html_template/';
	/**
	* Default template theme.
	* @var string 
	*/
	var $default_theme='default';
	/**
	* Template directory.
	* @var string 
	*/
	var $tp_dirs=array();
	/**
	* Root path to template file.
	* @var string 
	*/
	var $tp_root;
	/**
	* Path to template file.
	* @var string 
	*/
	var $tp_path;
	/**
	* Main path to template file.
	* @var string 
	*/
	var $tp_main_path;
	/**
	* Template theme.
	* @var string 
	*/
	var $tp_theme;
	
	/**
	* Constructor
	* @access public
	* @param  string The root path of the current script that instantiates this class.
	* @param string  Path of template source file.
	* @param string The template theme.
	*/
	function Template($root='./',$path='',$theme='default'){
		$this->tp_root=$root;
		if(empty($path)) $this->tp_path=$root.$this->default_path;
			else $this->tp_path=$path;
		$this->tp_main_path=$this->tp_path;
		$this->tp_theme=$theme;
	}
	/**
	* Sets the template path 
	* @access public
	* @param string Path to template source file
	* @return boolean
	*/
	function setPath($path=''){
		if(empty($path)) return false;
		if(empty($this->tp_main_path)) $this->tp_main_path=$this->tp_path;
		$this->tp_path=$path;
		return true;
	}
	/**
	* Sets the template theme 
	* @access public
	* @param string  Template theme
	*/
	function setTheme($theme=''){
		if(empty($theme)) return false;
		$this->tp_theme=$theme;
	}
	/** 
	* Sets the template path to the main path which was set at the construction time
	* @access public
	* @return boolean
	*/
	function useMainPath(){
		if(empty($this->tp_main_path)){
			return false;
		}else{
			$this->tp_path=$this->tp_main_path;
			return true;
		}
	}
	/**
	* Creates a list of available templates returned as array.
	* @access  private
	* @return  array
	*/
	function _getTemplates(){
		$handle=opendir($this->tp_path.'.');  // Modify this path if you have placed the language tables somewhere else
		$this->tp_dirs=array();
		while (false!==($tp = readdir($handle))) { 
   			if ($tp != '.' && $tp != '..') {
				if(is_dir($this->tp_path.$tp)){
					$this->tp_dirs[$tp]=$tp;
				}
			} 
		}
		@asort($this->tp_dirs,SORT_STRING);
	}
	/**
	* Loads the template file and appends/prepends '"' at the loaded string. Will return the template contents if succesful.
	* @access public
	*@param string Template filename.
	* @return mixed  string boolean 
	*/
	function load($tp_fn){
		if(!empty($tp_fn)){
			$tpsrc=$this->tp_path.$this->tp_theme.'/';
			if(file_exists($tpsrc.$tp_fn)) $this->filename=$tpsrc.$tp_fn;
				else $this->filename=$this->tp_root.$this->default_path.$this->default_theme.'/'.$tp_fn;
			$fn=fopen($this->filename,'r');
			$this->template=fread($fn,filesize($this->filename));
			fclose($fn);
			$this->template=$this->neutralize($this->template);
			return '"'.$this->template.'"';
		}else{return false;}
	}
	/**
	* Creates and returns a select form element with the available templates as options.
	* @access public
	* @param string  Current theme, if the current theme is equal to a theme, the theme will be marked "selected"
	* @return string
	*/
	function createSelectForm($curr_theme){
		$this->_getTemplates();
		$str='';
		while(list($x,$v)=each($this->tp_dirs)){
			$str.= '<option value="'.$x.'"';
			if($curr_theme==$x) $str.='selected';
			$str.= '> '.$v.'</option>
			';
		}
		return $str;
	}
	/**
	* Creates  radio buttons with the list of available templates.
	* @access public
	* @param string Name of the radio  button element.
	* @param string  Current theme, if the current theme is equal to a theme, the theme will be marked "checked"
	* @return string
	*/
	function createRadioSelect($name,$curr_theme){
		$this->_getTemplates();
		$str='';
		while(list($x,$v)=each($this->tp_dirs)){
			$str.= '<input type="radio" name="'.$name.'" value="'.$x.'"';
			if($curr_theme==$x) $str.='checked';
			$str.= '> '.$v;
		}
		return $str;
	}
	/**
	* Public interface of the template list variable. Will return the list as array.
	* @access public
	* @return array
	*/
	function getTemplateList(){
		$this->_getTemplates();
		return $this->tp_dirs;
	}
	/**
	* Converts all \ chars  to \\ and " to \" of the string
	* @access public
	* @param string String to be neutralized
	* @return string
	*/
	function neutralize(&$str){
		$str=str_replace('\\','\\\\',$str);
		$str=str_replace('"','\\"',$str);
		return $str;
		echo $str;
	}
}
