<?php

if(!isset($template_style) || empty($template_style)) $template_style='default';
if(!isset($root_path) || empty($root_path)) $root_path='../';

if(file_exists($root_path.'gui/html_template/'.$template_style.'/'.$template)) include ($root_path.'gui/html_template/'.$template_style.'/'.$template);
 else include ($root_path.'gui/html_template/default/'.$template)

?>
