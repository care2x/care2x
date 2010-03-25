<?php
/**
* SETUP Smarty for CARE2X
*
* SMARTY.PHP
* 19.12.2003 Thomas Wiedmann
* Converted to smarty_care.class.php by Elpidio Latorilla 2003-12-25
* For global smarty template class
*/

/**
* LOAD Smarty Library
*/
require_once ($root_path.'classes/smarty/libs/Smarty.class.php');

class smarty_care extends Smarty {

	var $bInitGUI = TRUE;
	var $bShowCopyright = TRUE;
	var $bLoadJS = TRUE;
	var $templatedir;

	#Set the default template, change this to the desired default template
	var $default_template='default';

	var $sDocRoot;
	var $templateCache;
	
	var $root_path;
	var $LDCloseAlt;
	var $cfg;
	var $lang;
	var $pgt;

	/**
	* Constructor
	*
	* @param string modulname ==  cache directory /modules/$dirname
	* @param boolean Initialize GUI (default TRUE)
	* @param boolean Show copyright footer (default TRUE)
	* @param boolean Load standard Javascript code (default TRUE)
	*/
	function smarty_care ($dirname, $bInit = TRUE, $bShowCopy = TRUE, $bLoadJS = TRUE) {

 		global $root_path, $templatedir, $default_template, $sDocRoot, $LDCloseAlt, $cfg, $lang, $pgt, $GLOBAL_CONFIG;

		$this->smarty();

		$this->root_path = $root_path;

		# Set the root path
		$this->assign('root_path',$root_path);
		
		# Path to the smarty care templates and classes
		$this->sDocRoot = $root_path.'gui/smarty_template';
		# Path to the template cache
		$this->templateCache = $root_path.'cache/templates_c';

		# Set the template
		# First check if the user config template is available
		if(isset($cfg['template_smarty'])&&!empty($cfg['template_smarty'])){
			$this->templatedir=$cfg['template_smarty'];
		}else{
			# Else get try to get the global config template
			if(!isset($GLOBAL_CONFIG)||!is_array($GLOBAL_CONFIG)) $GLOBAL_CONFIG=array();

			# create global config object
			if(!isset($GLOBAL_CONFIG['template_smarty'])){
				include_once($root_path.'include/care_api_classes/class_globalconfig.php');
				$gc=& new GlobalConfig($GLOBAL_CONFIG);
				# Get the global template config
				$gc->getConfig('template_smarty');
			}

			# If the global config template is not available, use hard coded template theme
			if(!isset($GLOBAL_CONFIG['template_smarty'])||empty($GLOBAL_CONFIG['template_smarty'])){
				if(isset($template_theme)) $this->templatedir=$template_theme; // use this theme if the global item is not available
					 else $this->templatedir = $this->default_template;
			}else{
				$this->templatedir=$GLOBAL_CONFIG['template_smarty'];
			}
		}

		# Set the flags
		$this->bInitGUI = $bInit;
		$this->bShowCopyright = $bShowCopy;
		$this->bLoadJS = $bLoadJS;

		$this->LDCloseAlt = $LDCloseAlt;
		$this->cfg = $cfg;
		$this->lang = $lang;
		$this->pgt = $pgt;

		# Another check if the working directory is really inside the template theme.
		# If not, use default template theme.

		if(file_exists($this->sDocRoot."/templates/$this->templatedir/$dirname/.")){
			$this->template_dir = $this->sDocRoot."/templates/$this->templatedir";
			$this->compile_dir = $this->templateCache."/$this->templatedir";
		}else{
			$this->template_dir = $this->sDocRoot."/templates/$this->default_template";
			$this->compile_dir = $this->templateCache."/$this->default_template";
		}

		$this->config_dir = $this->sDocRoot.'/configs';
		$this->cache_dir = $this->templateCache.'/cache';

		# For temporary debugging
/*		 if(0){
			echo  $this->template_dir."<p>";
			echo  $this->compile_dir."<p>";
			echo  $this->config_dir."<p>";
			echo  $this->cache_dir."<p>";
		 }
		/***/
		/* global configs
		*/

		$this->debug = true;
		// $this->caching = true;

		/**
		* Smarty delimiters
		*/
		$this->left_delimiter = '{{';
		$this->right_delimiter = '}}';

		# Now assign standard GUI elements if bInitGUI flag is set to TRUE (default is TRUE)

		if($this->bInitGUI){
			$this->InitializeGUI();
		}
	} // end of constructor

	function InitializeGUI(){
 		global $root_path, $lang, $cfg;
		
		if(empty($root_path)) $root_path = $this->root_path;
		if(empty($lang)) $lang = $this->lang;
		
		# HEAD META definition

		$this->assign('setCharSet',setCharSet());

		# collect JavaScript for Smarty. By default collect the help javascript and css stylesheets
		
		if($this->bLoadJS){
			ob_start();
				include($this->root_path.'include/core/inc_js_gethelp.php');
				include($this->root_path.'include/core/inc_css_a_hilitebu.php');
				$sTemp = ob_get_contents();
			ob_end_clean();
		}

		$this->assign('JavaScript',$sTemp);

		# Added for the html tag direction
		$this->assign('HTMLtag',html_ret_rtl($this->lang));

		# Set colors
		$this->assign('top_txtcolor',$this->cfg['top_txtcolor']);
		$this->assign('top_bgcolor',$this->cfg['top_bgcolor']);
		$this->assign('body_bgcolor',$this->cfg['body_bgcolor']);
		$this->assign('body_txtcolor',$this->cfg['body_txtcolor']);
		$this->assign('bot_bgcolor',$this->cfg['bot_bgcolor']);

		# Set title bar buttons
		$this->assign('gifBack2',createLDImgSrc($this->root_path,'back2.gif','0') );
		$this->assign('gifHilfeR',createLDImgSrc($this->root_path,'hilfe-r.gif','0') );
		$this->assign('gifClose2',createLDImgSrc($this->root_path,'close2.gif','0') );
		$this->assign('LDCloseAlt',$this->LDCloseAlt );

		# Set default href of the title bar buttons
		# By default, the back button uses the javascript
		$this->assign('pbBack','javascript:window.history.back()');

		# By default the help button points to the main help window
		$this->assign('pbHelp',"javascript:gethelp()");

		# By default the break/close button points to the main startframe
		$this->assign('breakfile',$this->root_path.'main/startframe.php'.URL_APPEND);

		
		# By default the toolbar title is empty
		//$this->assign('sToolbarTitle','');

		# By default the window title is Care2x
		 $this->assign('title','SIIS');

		# For the dhtml effects

		if($this->cfg['dhtml']) {

			# Overload css  document body attributes
			
			$this->assign('bgcolor','bgcolor='.$this->cfg['body_bgcolor']);
			$this->assign('dhtml','class="fadedOut"');
			$this->assign('sLinkColors','link='.$this->cfg['idx_txtcolor'].' alink='.$this->cfg['body_alink'].' vlink='.$this->cfg['idx_txtcolor']);
		}

		# Show Copyright
		
		if($this->bShowCopyright){
			$this->assign('sCopyright',$this->Copyright());
			$this->assign('sPageTime',$this->Pagetime());
		}
	}

	function Copyright(){
		global $root_path, $lang;

		if(empty($root_path)) $root_path = $this->root_path;
		if(empty($lang)) $lang = $this->lang;

		ob_start();
			$sTempFile=$this->root_path.'language/'.$this->lang.'/'.$this->lang.'_copyrite.php';
			if(file_exists($sTempFile)) include($sTempFile);
			else include($this->root_path.'language/sq/sq_copyrite.php');
			$sTemp = ob_get_contents();
		ob_end_clean();
		return "<div class=\"copyright\">$sTemp</div>";
	}

	function PageTime(){
		//global $pgt;
		ob_start();
			if(defined('USE_PAGE_GEN_TIME')&&USE_PAGE_GEN_TIME){
				$this->pgt->ende();
				$this->pgt->ausgabe();
			}
			$sTemp = ob_get_contents();
		ob_end_clean();
		return $sTemp;
	}

} // end class

?>
