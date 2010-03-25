<?php
/*error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');*/

/**
 *  File: calendar.php | (c) dynarch.com 2004
 *  Distributed as part of "The Coolest DHTML Calendar"
 *  under the same terms.
 *  -----------------------------------------------------------------
 *  This file implements a simple PHP wrapper for the calendar.  It
 *  allows you to easily include all the calendar files and setup the
 *  calendar by instantiating and calling a PHP object.
 */



define('NEWLINE', "\n");

class DHTML_Calendar {
    var $calendar_lib_path;

    var $calendar_file;
    var $calendar_lang_file;
    var $calendar_setup_file;
    var $calendar_theme_file;
    var $calendar_options;
    var $lang;
    var $set_datetime = 'setdatetime.js';
    var $check_date = 'checkdate.js';

    function DHTML_Calendar($calendar_lib_path = 'jscalendar',
                            $lang              = 'en',
                            $theme             = 'calendar-win2k-1',
                            $stripped          = true) {
        if ($stripped) {
            $this->calendar_file = 'calendar_stripped.js';
            $this->calendar_setup_file = 'calendar-setup_stripped.js';
        } else {
            $this->calendar_file = 'calendar.js';
            $this->calendar_setup_file = 'calendar-setup.js';
        }
        $this->calendar_lang_file = 'lang/calendar-' . $lang . '.js';
        $this->calendar_theme_file = $theme.'.css';
        $this->calendar_lib_path = preg_replace('/\/+$/', '/', $calendar_lib_path);
        $this->calendar_options = array('ifFormat' => '%Y/%m/%d',
                                        'daFormat' => '%Y/%m/%d');
        $this->lang = $lang;
    }

    function set_option($name, $value) {
        $this->calendar_options[$name] = $value;
    }

    function load_files() {
        echo $this->get_load_files_code();
    }

    function get_load_files_code() {
        $code  = ( '<link rel="stylesheet" type="text/css" media="all" href="' .
                   $this->calendar_lib_path . $this->calendar_theme_file .
                   '" />' . NEWLINE );
        $code .= ( '<script type="text/javascript" src="' .
                   $this->calendar_lib_path . $this->calendar_file .
                   '"></script>' . NEWLINE );
        $code .= ( '<script type="text/javascript" src="' .
                   $this->calendar_lib_path . $this->calendar_lang_file .
                   '"></script>' . NEWLINE );
        $code .= ( '<script type="text/javascript" src="' .
                   $this->calendar_lib_path . $this->calendar_setup_file .
                   '"></script>' . NEWLINE );
        $code .= ( '<script type="text/javascript" src="' .
        		   $this->calendar_lib_path . $this->set_datetime .
        		   '"></script>' . NEWLINE );
        $code .= ( '<script type="text/javascript" src="' .
        		   $this->calendar_lib_path . $this->check_date .
        		   '"></script>' . NEWLINE );
        return $code;
    }

    function _make_calendar($other_options = array()) {
        $js_options = $this->_make_js_hash(array_merge($this->calendar_options, $other_options));
        $code  = ( '<script type="text/javascript">Calendar.setup({' .
                   $js_options .
                   '});</script>' );
        return $code;
    }
	//gjergji
	//modified to fit care2x needs
    function show_calendar ($calendar,$date_format,$input_field,$value='') {
		
    	//date value check
    	
		if($value != DBF_NODATE && !empty($value)) {
			$value = formatDate2Local($value,$date_format);
		} else {
			//$value = formatDate2Local(date('Y-m-d'),$date_format); 
			$value = '';
		}
    	//convert date_format from care2x model to the calendar model
    	$search = array('yyyy','mm','dd');
		$replace = array('%Y','%m','%d');
		$date_format_calendar = str_replace($search,$replace,strtolower($date_format));

		
		$calendarJS = $calendar->make_input_field(
   		array('firstDay'       => 1,
         	  'showOthers'     => true,
         	  'ifFormat'       => $date_format_calendar,
         	  'button'         => 'trigger'),
   			  array('name'     => $input_field,
   			  		'value'	   => $value,
   			  		'style'    => 'width:90px;'),
   			  $date_format);
   		return $calendarJS;
    }
    
    function make_input_field($cal_options = array(), $field_attributes = array(), $date_format) {
    	$code = '';
        $id = $this->_gen_id();
        $attrstr = $this->_make_html_attr(array_merge($field_attributes,
                                                      array('id'   => $this->_field_id($id),
                                                            'type' => 'text')));
        $code .= '<input ' . $attrstr .'onBlur="IsValidDate(this,\'' . $date_format . '\')"  onKeyUp="setDate(this,\''. $date_format . '\',\''.  $this->lang . '\')"/> ';
        $code .= '<a href="#" id="'. $this->_trigger_id($id) . '">' .
            '<img align="middle" border="0" src="' . $this->calendar_lib_path . 'img.gif" alt="" /></a>';

        $options = array_merge($cal_options,
                               array('inputField' => $this->_field_id($id),
                                     'button'     => $this->_trigger_id($id)));
        $code .=  $this->_make_calendar($options);
        return $code;
    }

    /// PRIVATE SECTION

    function _field_id($id) { return 'f-calendar-field-' . $id; }
    function _trigger_id($id) { return 'f-calendar-trigger-' . $id; }
    function _gen_id() { static $id = 0; return ++$id; }

    function _make_js_hash($array) {
        $jstr = '';
        reset($array);
        while (list($key, $val) = each($array)) {
            if (is_bool($val))
                $val = $val ? 'true' : 'false';
            else if (!is_numeric($val))
                $val = '"'.$val.'"';
            if ($jstr) $jstr .= ',';
            $jstr .= '"' . $key . '":' . $val;
        }
        return $jstr;
    }

    function _make_html_attr($array) {
        $attrstr = '';
        reset($array);
        while (list($key, $val) = each($array)) {
            $attrstr .= $key . '="' . $val . '" ';
        }
        return $attrstr;
    }
};

?>