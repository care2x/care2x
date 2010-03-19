<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_resolve_dept_dept.php",$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

if(!isset($dept)) $dept='';
if(!isset($ck_thispc_dept)) $ck_thispc_dept='';
if(!isset($ck_thispc_station)) $ck_thispc_station='';
if(!isset($ck_thispc_room)) $ck_thispc_room='';
if(!isset($checkdept)) $checkdept='';

if(!(trim($dept)))
{

	if($ck_thispc_dept) 
	{
		$dept=$ck_thispc_dept;
		$checkdept=1;
	}
	elseif($ck_thispc_station)
	{
		$dept=$ck_thispc_station;
		$checkdept=1;
	}
	elseif($ck_thispc_room)
	{
		$dept=$ck_thispc_station;
		$checkdept=1;
	}
	else $dept='plast';
}

if($checkdept)
{
	if(trim($dept)=='') $dept='plast';
	$Dept2Dept=get_meta_tags($root_path.'global_conf/$lang/resolve_dept_dept.pid');
	
		$dx=strtolower($dept);
		//print $Dept2Dept[deptfilter];
		$df=explode(',',$Dept2Dept[deptfilter]);
		while(list($x,$v)=each($df))
		{
			$dx=str_replace($v,'',$dx);
		}

		$dx=strtr($dx,'/-_*:;><+ ','~~~~~~~~~~');
		$dx=str_replace('~','',$dx);
		//print "init $dept <br>";
		//print $dx." dx <p>";
		while(list($x,$v)=each($Dept2Dept))
		{
			//print "$x $v <br>";
			if(stristr($v,$dx))
			{
				$dept=$x;
				$deptOK=1;
				break;
			}
		}
	//print $dept;
	if(!$deptOK) $dept='plast';
}

?>
