<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr($_SERVER['SCRIPT_NAME'],'inc_accessplan_areas_functions.php')) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

require($root_path.'global_conf/areas.php');

/**
* Do not edit the following lines of code. 
*/
function createselecttable($itemselect)
{
	global $areaopt;

	foreach($areaopt as $k => $v)
	{
		print '<option value="'.$k.'" ';
		if ($itemselect==$k) print "selected";
		print '>'.$v.'</option>';
	}
	reset($areaopt);
}

function printAccessAreas()
{
	global $areaopt;

	$batch=0;
	foreach($areaopt as $k => $v)
	{
		print $v.', ';
		$batch++;
		if($batch>3)
		{
		    print "<br>";
			$batch=0;
	    }
	}
	reset($areaopt);
}
?>
