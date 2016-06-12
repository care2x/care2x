<?php
/*
 * Created on 15.08.2008
 *
 * CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
 * GNU General Public License
 * Copyright 2005 Robert Meggle based on the development of Elpidio Latorilla (2002,2003,2004,2005)
 * elpidio@care2x.org, meggle@merotech.de
 *
 * See the file "copy_notice.txt" for the licence notice
*/

require('./roots.php');

require($root_path.'include/core/inc_environment_global.php');
error_reporting($ErrorLevel);
require_once($root_path.'include/care_api_classes/class_core.php');

$coreobj = new core;

$lang_tables[]='pharmacy.php';
//define('NO_2LEVEL_CHK',1);
require($root_path.'include/core/inc_front_chain_lang.php');

    $debug=FALSE;
    $debug==TRUE ? $db->debug=TRUE : $db->debug=FALSE;

echo $_FILES['filename']['tmp_name']."<br>";

if ($_FILES['filename']['tmp_name'] ) {

	if ($debug) echo $_FILES['filename']['tmp_name'];

	// Create a temporary file with the same structure like
	// the pricelist

	// enlarge the max_tmp_table_size to the maximum what we can use:
	$coreobj->Transact("SET @@max_heap_table_size=4294967296");

	// create an empty druglist:
	$coreobj->setTable('tmp_care_tz_drugsandservices');

	$sql = "CREATE TEMPORARY TABLE $coreobj->coretable " .
			"SELECT  c.`item_number`, " .
					"c.`partcode`, " .
					"c.`is_pediatric`, " .
					"c.`is_adult`, " .
					"c.`is_other`, " .
					"c.`is_consumable`, " .
					"c.`is_labtest`, " .
					"c.`item_description`, " .
					"c.`item_full_description`, " .
					"c.`unit_price`, " .
					"c.`unit_price_1`, " .
					"c.`unit_price_2`, " .
					"c.`unit_price_3`, " .
					"c.`purchasing_class` " .
					"FROM care_tz_drugsandservices c where 0;";

	if ($debug) echo $sql."<br>";

	if ($coreobj->Transact($sql))
		if ($debug) echo "Temporary table created <br>";

	$filename = $_FILES['filename']['tmp_name'];

	if ($debug) echo "Got filename:".$filename."<br>";

	// load the file
	$row = 1;
	$handle = fopen ($filename,"r");

	if ($debug) echo "File is now opened<br>";

	while ( ($data = fgetcsv ($handle, 1000, ",")) !== FALSE ) {
	    $num = count ($data);

	    //if ($this_debug) echo "reading now line ".$row."<br>";

		if ($row>=2) {
		    //if ($this_debug) print "<p> $num fields in line $row: <br>\n";
		    	$sql = "INSERT INTO tmp_care_tz_drugsandservices (`item_number`, " .
					"`partcode`, " .
					"`is_pediatric`, " .
					"`is_adult`, " .
					"`is_other`, " .
					"`is_consumable`, " .
					"`is_labtest`, " .
					"`item_description`, " .
					"`item_full_description`, " .
					"`unit_price`, " .
					"`unit_price_1`, " .
					"`unit_price_2`, " .
					"`unit_price_3`, " .
					"`purchasing_class` " .
					") VALUES (" .
					"'$data[0]'," .
					"'$data[1]'," .
					"'$data[2]'," .
					"'$data[3]'," .
					"'$data[4]'," .
					"'$data[5]'," .
					"'$data[6]'," .
					"'$data[7]'," .
					"'$data[8]'," .
					"'$data[9]'," .
					"'$data[10]'," .
					"'$data[11]'," .
					"'$data[12]'," .
					"'$data[13]'" .
					")";
		        $coreobj->Transact($sql);
		        //if ($this_debug) echo $sql."<br>";
		}
		$row++;
	}

	if ($debug) echo $row." lines inserted now to the tmp-table<br>";

	fclose ($handle);
	//$sql="drop table care_tz_drugsandservices";
} else {
	if ($debug) echo "I haven't got an filename so far... <br>";
}

// This will be given later to a class, when I do know where would be
// the best place it:
// TODO: Store "Manage Pricelist functions" to a class
function showPriceListTable() {
	// This function returns returns row by row the entries of the
	// temporary pricelist table (feeded by csv data)
	global $db, $debug;

	$sql="SELECT * FROM tmp_care_tz_drugsandservices";
	if ($debug) echo "function::showPriceListTable()";
	if ( $result=$db->Execute($sql) ) {

		$purchase_classes = array (	"bigop",
									"dental",
									"drug_list",
									"labtest",
									"eye-service",
									"service",
									"smallop",
									"special_others_list",
									"supplies",
									"supplies_laboratory",
									"supplies",
									"xray");
		$line=0;

		while ($row=$result->FetchRow() ) 	{

			if ($debug) echo "there are items comming in!";

			$item_number		=	$row[0];
			$partcode			=	$row[1];
			$is_pediatric		=	$row[2];
			$is_adult			=	$row[3];
			$is_other			=	$row[4];
			$is_consumable		=	$row[5];
			$is_labtest			=	$row[6];
			$item_description	=	$row[7];
			$item_full_description=$row[8];
			$unit_price			=	$row[9];
			$unit_price_1		=	$row[10];
			$unit_price_2		=	$row[11];
			$unit_price_3		=	$row[12];
			$purchasing_class	=	$row[13];

			// Check if the pruchase class wihin the valid fields
			/*
			if (in_array($purchasing_class, $purchase_classes)==FALSE )
			{
				echo "PLEASE CORRECT FOLLOWING BUGS first :<br>";
				$REDCELL='bgcolor="#FF0000"';
				echo '<font color="#FF0000">Error at line: </font> ' . $line . ' Reason: ---> Wrong Purchasing Class<br>';
			}else if(empty($row[0])){
				$REDCELL='bgcolor="#FF0000"';
				echo '<font color="#FF0000">Error at line: </font> ' . $line . ' Reason: ---> No Item Number<br>';
			}else if(empty($row[1])){
				$REDCELL='bgcolor="#FF0000"';
				echo '<font color="#FF0000">Error at line: </font> ' . $line . ' Reason: ---> No Partcode<br>';
			}else{
				$REDCELL='';
			}
			*/
			if (in_array($purchasing_class, $purchase_classes)==FALSE )
			{
				$REDCELL='bgcolor="#FF0000"';

			}else if(empty($row[0])){
				$REDCELL='bgcolor="#FF0000"';

			}else if(empty($row[1])){
				$REDCELL='bgcolor="#FF0000"';

			}else{
				$REDCELL='';
			}

			echo '<tr>' .
					'<td bgcolor="#999933"'.$REDCELL.'>'.$line.'</td>' .
					'<td '.$REDCELL.'>'.$item_number.'</td>' .
					'<td '.$REDCELL.'>'.$partcode.'</td>' .
					'<td '.$REDCELL.'>'.$is_pediatric.'</td>' .
					'<td '.$REDCELL.'>'.$is_adult.'</td>' .
					'<td '.$REDCELL.'>'.$is_other.'</td>' .
					'<td '.$REDCELL.'>'.$is_consumable.'</td>' .
					'<td '.$REDCELL.'>'.$is_labtest.'</td>' .
					'<td '.$REDCELL.'>'.$item_description.'</td>' .
					'<td '.$REDCELL.'>'.$item_full_description.'</td>' .
					'<td '.$REDCELL.'>'.$unit_price.'</td>' .
					'<td '.$REDCELL.'>'.$unit_price_1.'</td>' .
					'<td '.$REDCELL.'>'.$unit_price_2.'</td>' .
					'<td '.$REDCELL.'>'.$unit_price_3.'</td>' .
					'<td '.$REDCELL.'>'.$purchasing_class.'</td>' .
		              		'</tr>';

		      $line++;
		}
	}
	return 0;
}


require ("gui/gui_manage_pricelist.php");
?>
