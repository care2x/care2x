<?php
error_reporting ( E_COMPILE_ERROR | E_ERROR | E_CORE_ERROR );
require ('./roots.php');
require ($root_path . 'include/core/inc_environment_global.php');
/**
 *
 * Jean-Philippe LIOT  <flip-zali@tiscali.fr>
 * added the ff: functionalities
 * search for Ethnic origin types  2004-05-11
 * search for Immunization types 2004-04-12
 * zip_code addition to city town address 2004-05-13
 * revised by Elpidio for cross database compatibility 2004-05-13
 *
 * CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
 * GNU General Public License
 * Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
 * elpidio@care2x.org, 
 *
 * See the file "copy_notice.txt" for the licence notice
 *
 */
define ( 'LANG_FILE', 'aufnahme.php' );
$local_user = 'aufnahme_user';
require_once ($root_path . 'include/core/inc_front_chain_lang.php');
require_once ($root_path . 'include/core/inc_date_format_functions.php');
require_once ($root_path . 'classes/datetimemanager/class.dateTimeManager.php');

# Create time manager object
$datetime_obj = & new dateTimeManager ( );

$thisfile = basename ( __FILE__ );
$searchmask_bgcolor = "#f3f3f3";
$searchprompt = $LDEnterSearchKeyword;

$quicklistmaxnr = 10; // The maximum number of quicklist popular items


# Uncomment the following to debug the sql queries
///$db->debug=1;


$sql = '';

if (! isset ( $mode ))
	$mode = '';
	
# Set limited query result to false as default
$limitselect = FALSE;

# Set the default name of of the form
# Note to Jean-Philippe LIOT
# the form name was moved outside of the sql query because otherwise the element names become too long and get pruned by PostgreSQL


$formname = 'aufnahmeform';

if (isset ( $target )) {
	switch ($target) {
		case 'insurance' :
			$sql = "SELECT name AS \"insurance_firm_name.value\", firm_id AS \"insurance_firm_id.value\", use_frequency FROM care_insurance_firm";
			if ($mode == 'search') {
				$sql .= " WHERE name $sql_LIKE '$searchkey%' OR firm_id $sql_LIKE '$searchkey%'";
			} else {
				$sql .= " ORDER BY use_frequency DESC";
				$limitselect = TRUE;
			}
			$title = $LDSearch . ' :: ' . $LDInsuranceCo;
			$itemname = $LDInsuranceCo;
			break;
		
		case 'citytown' :
			$sql = "SELECT name AS \"addr_citytown_name.value\", nr AS \"addr_citytown_nr.value\", zip_code AS \"addr_zip.value\", use_frequency FROM care_address_citytown ";
			if ($mode == 'search') {
				$sql .= " WHERE name $sql_LIKE '$searchkey%' OR unece_locode $sql_LIKE '$searchkey%'";
			} else {
				$sql .= " ORDER BY use_frequency DESC";
				$limitselect = TRUE;
			}
			$title = $LDSearch . ' :: ' . $LDAddress . ' (' . $LDTownCity . ')';
			$itemname = $LDTownCity;
			break;
		
		case 'immunization' :
			$sql = "SELECT name AS \"type.value\", medicine AS \"medicine.value\", dosage AS \"dosage.value\", titer AS \"titer.value\", application AS \"application_type_nr.selectedIndex\", period as \"refresh_date.value\", 0 AS use_frequency FROM care_type_immunization ";
			if ($mode == 'search') {
				$sql .= "WHERE  name $sql_LIKE '" . $searchkey . "%'";
			} else {
				$sql .= " ORDER BY name DESC ";
				$limitselect = TRUE;
			}
			$title = $LDSearch . ' :: ' . $LDImmunization . ' (' . $LDImmunization . ')';
			$itemname = $LDImmunization;
			$formname = 'reportform';
			break;
		
		case 'ethnic_orig' :
			$sql = "SELECT name AS \"ethnic_orig_txt.value\" ,nr AS \"ethnic_orig.value\", 0 AS use_frequency FROM care_type_ethnic_orig ";
			if ($mode == 'search') {
				$sql .= "name $sql_LIKE '$searchkey%'";
			} else {
				$sql .= " ORDER BY name DESC";
				$limitselect = TRUE;
			}
			
			$title = $LDSearch . ' :: ' . $LDEthnicOrigin . ' (' . $LDEthnicOrigin . ')';
			$itemname = $LDEthnicOrigin;
			break;
	}
	
	# The adodb function of limited nr of return query is now used here
	

	if ($limitselect) {
		if ($result = $db->SelectLimit ( $sql, $quicklistmaxnr )) {
			$linecount = $result->RecordCount ();
		}
	} else {
		if ($result = $db->Execute ( $sql )) {
			$linecount = $result->RecordCount ();
		}
	}
	if ($linecount)
		$sql_value = $result->GetArray ();

}

/* Set color values for the search mask */
$entry_block_bgcolor = '#fff3f3';
$entry_border_bgcolor = '#66ee66';
$entry_body_bgcolor = '#ffffff';
?>
<?php

html_rtl ( $lang );
?>
<head>
<?php
echo setCharSet ();
?>
<title><?php
echo $title?></title>


<script language="javascript">
<!-- Script Begin
function setValue(val) {
	mywin=parent.window.opener;
	var array_val= val.split("|");
	<?php
	$var_parent_document = array_keys ( $sql_value [0] );
	$indice = 0;
	for($i3 = 1; $i3 < sizeof ( $var_parent_document ) - 1; $i3 = $i3 + 2) {
		echo 'mywin.document.' . $formname . '.' . $var_parent_document [$i3] . '=array_val[' . $indice . ']; ';
		$indice ++;
	}
	;
	?>
	this.window.close();
	mywin.focus();
}


//  Script End -->
</script>
</head>
<body>
<font face=arial> <font size=3><b><?php
echo $title?></b></font>

<table border=0 cellpadding=10
	bgcolor="<?php
	echo $entry_border_bgcolor?>">
	<tr>
		<td>
<?php
include ($root_path . 'include/core/inc_patient_searchmask.php');

?>
</td>
	</tr>
</table>
   
<?php
if ($mode == 'search') {
	if (! $linecount)
		$linecount = 0;
	echo '<hr width=80% align=left>' . str_replace ( "~nr~", $linecount, $LDSearchFoundData ) . '<p>';
} else {
	echo '<hr width=80% align=left><font size=4 color="#990000">' . $LDTop . ' ' . $quicklistmaxnr . ' ' . $LDQuickList . '</font>';
}

//echo $mode;
if ($linecount) {
	$count = 0;
	echo '
						<table border=0 cellpadding=2 cellspacing=1> 
						<tr bgcolor="#66ee66" background="' . $root_path . 'gui/img/common/default/tableHeaderbg.gif">';
	
	echo '
						<td><font face=arial size=2 color="#336633"><b>' . $itemname . '</b></td>';
	
	echo '
						<td><font face=arial size=2 color="#336633">&nbsp;</td>';
	
	echo "</tr>";
	$sql_value_without_key = array_values ( $sql_value );
	for($i = 0; $i < sizeof ( $sql_value ); $i ++) {
		if (($mode != 'search') && ($count == $quicklistmaxnr))
			break;
		else
			$count ++;
		
		echo "
							<tr bgcolor=";
		if ($toggle) {
			echo "#efefef>";
			$toggle = 0;
		} else {
			echo "#ffffff>";
			$toggle = 1;
		}
		;
		echo "<td><font face=arial size=2>";
		echo "&nbsp;" . ucfirst ( $sql_value [$i] [0] );
		
		# This formats the refresh date to local data if available
		# Uses the dateTimeManager object
		# Note: the second parameter of the method ::shift_dates is negative to shift the date to the future
		

		if (isset ( $sql_value_without_key [$i] ['refresh_date.value'] ) && ! empty ( $sql_value_without_key [$i] ['refresh_date.value'] )) {
			
			$shifted_date = $datetime_obj->shift_dates ( date ( 'Y-m-d' ), - ($sql_value_without_key [$i] ['refresh_date.value']), 'd' );
			
			$sql_value_without_key [$i] ['refresh_date.value'] = formatDate2Local ( $shifted_date, $date_format );
		}
		// Creation du tableau export vers java
		

		// Elimination des doublons
		// The original code of Jean-Philippe was modified to patch the bug of inaccurate result of "sizeof" command
		

		$sql_java_string = '';
		while ( list ( $x, $v ) = each ( $sql_value_without_key [$i] ) ) {
			if (is_integer ( $x ))
				continue;
			else
				$sql_java_string .= "$v|";
		}
		
		echo "</td>";
		echo "<td><font face=arial size=2>";
		echo '<a href="javascript:setValue(\'' . $sql_java_string . '\')">';
		echo '<img ' . createLDImgSrc ( $root_path, 'ok_small.gif', '0' ) . ' alt="' . $LDTestThisPatient . '"></a>&nbsp;';
		echo '</td></tr>';
	}
	echo "
						</table>";
	if ($mode == 'search' && $linecount > 15) {
		?>
         <p>


<table border=0 cellpadding=10
	bgcolor="<?php
		echo $entry_border_bgcolor?>">
	<tr>
		<td>
	   <?php
		
		$searchform_count = 2;
		include ($root_path . 'include/core/inc_patient_searchmask.php');
		
		?>
</td>
	</tr>
</table>
<?php
	}
}

?>

</font>
</body>
</html>
