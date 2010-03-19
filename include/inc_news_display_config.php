<?php
# Get the  config depending on the current logged user id
require_once($root_path.'include/care_api_classes/class_config.php');
$userobj=new UserConfig;
$globobj=new GlobalConfig($GLOBALCONFIG);

$USERCONFIG=&$userobj->getConfig($user_id);
$globobj->getConfig('news_%');

while(list($x,$v)=each($GLOBALCONFIG)) {
    $$x=($USERCONFIG[$x]) ? $USERCONFIG[$x] : $GLOBALCONFIG[$x];
}

if(!$news_normal_preview_maxlen) $news_normal_preview_maxlen=300;


# Load editor functions
require_once($root_path.'include/inc_editor_fx.php');

require_once($root_path.'include/inc_date_format_functions.php');
?>
