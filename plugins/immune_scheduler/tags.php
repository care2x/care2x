<?php
#
# This is the sample tags script for the sample plug-in Immunization Scheduler
#
/*
# Plug-in name that is displayed on the menu or submenu pages
*/
$sPluginName = 'Immunization Scheduler';

/*
# Plug-in description that is displayed on some format of menu pages or as context sensitive info
*/
$sPluginDescription = 'Automatic immunization scheduler based on standard sets of immunization regulations';

/*
# Plug-in start script or URL. This will be started when the user clicks on the
# icon or text link to the plug-in module.
# This can be:
# - a full url  (e.g. http://ipath.sourceforge.net/ipath/ ) or
# - a filename relative to the ./plugins/ subdirectory.
# - a full path relative to the web server root (e.g. /htdocs/)
#
# In case the path is relative to the ./plugins/ subdirectory, the plugin's directory name
# must be included in the path. e.g. $sPluginStartLocator = 'biometric/start.php';
#
*/
$sPluginStartLocator = 'immune_scheduler/im_sch_calculator.php';

/*
# Small size icon for the plugin menu or submenus.
# The image file must be inside the plugin directory (e.g. immune_scheduler/)
# Include the plugin directory name in the path.
# If empty or file not exists, the system will use a default icon image.
*/
$sPluginIconSmall = 'immune_scheduler/guy_arrow.gif';

/*
# Medium size icon for the plugin menu or submenus.
# The image file must be inside the plugin directory (e.g. immune_scheduler/)
# Include the plugin directory name in the path.
# If empty or file not exists, the system will use a default icon image.
*/
$sPluginIconMedium = '';

/*
# Large size icon for the plugin menu or submenus.
# The image file must be inside the plugin directory (e.g. immune_scheduler/)
# Include the plugin directory name in the path.
# If empty or file not exists, the system will use a default icon image.
*/
$sPluginIconLarge = '';

?>
