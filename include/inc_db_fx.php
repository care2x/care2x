<?php

/**
*  checkTableExist = Check whether the table exists, 
*  param $must_table = the table to be check if it exists
*  param $default_table = default table 
*  return = $must_table if exist, otherwise $default_table
*/

function checkTableExist($must_table, $default_table)
{
	global $dbname, $link;
	
    $all_table=mysql_list_tables($dbname,$link);
	$i=0;
	while($i < mysql_num_rows($all_table))
	{
		if($must_table == mysql_tablename($all_table,$i))
		{
		    $default_table=$must_table;
			 break;
		}
		$i++;
	}
			
    return $default_table;
}

?>
