<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_resolve_opr_dept.php",$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

if(!$dept)
{
	$Or2Or=get_meta_tags($root_path."global_conf/$lang/resolve_or2or.pid");
	$Dept2Dept=get_meta_tags($root_path."global_conf/$lang/resolve_dept2ordept.pid");

	if($ck_thispc_dept)
	{
		$dx=strtolower($ck_thispc_dept);
		$df=explode(",",$Dept2Dept[deptfilter]);
		while(list($x,$v)=each($df))
		{
			$dx=str_replace($v,"",$dx);
		}
		
		$dx=strtr($dx,"/-_*:;><+ ","~~~~~~~~~~");
		$dx=str_replace("~","",$dx);
		//print $Dept2Dept[deptfilter];
		//print "init $dept <br>";
		while(list($x,$v)=each($Dept2Dept))
		{
			if(stristr($v,$dx))
			{
				$dept=$x;
				//print "found $dept <br>";
				$deptOK=1;
				break;
			}
		}
	}
	//print "$dept $saal<br>";
	if(($deptOK||!$ck_thispc_dept)&&($saal!="exclude"))
	{
		if($ck_thispc_room)
		{
			//print "room $ck_thispc_room dept $dept";
			$roombuf=strtolower($ck_thispc_room);
			$df=explode(",",$Or2Or[orfilter]);
			while(list($x,$v)=each($df))
			{
				$roombuf=str_replace($v,"",$roombuf);
			}
			$roombuf=strtr($roombuf,"/-_*:;><+ ","~~~~~~~~~~");
			$roombuf=str_replace("~","",$roombuf);
			while(list($x,$v)=each($Or2Or))
			{	
				if(stristr($v,$roombuf))
				{
					$saal=$x;				
					if($dept)
					{
						if ($dept!=$Or2Dept[$x])  $getSaal=1;
					}
					else
					{
 						$dept=$Or2Dept[$x];
					}
					//print "found saal $x found $dept<br>";
					break;
				}
			}
		}
		else $getSaal=1;
	}
}
elseif(!$saal) $getSaal=1;

$Or2Dept=get_meta_tags($root_path."global_conf/resolve_or2ordept.pid");

if($getSaal)
		{
			while(list($x,$v)=each($Or2Dept))
			{	
				if($dept==$v)
				{
					$saal=$x;
					break;
				}
			}
		
		}
//print "$dept $saal";
if(!$dept||!$saal) { $dept="plop"; $saal="a";}

?>
