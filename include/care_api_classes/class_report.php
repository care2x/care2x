<?php
/**
* Care2x API package
* @package care_api
*/

/**
*  basis reporting methods. Will be extended by other classes like class_tz_selianreporting or class_tz_MTHUAreporting.
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
* @author Robert Meggle (www.MEROTECH.de: meggle@merotech.de)
* @version beta 0.0.1
* @copyright 2006 Robert Meggle, based on the development of Elpidio Latorilla
* @package care_api
*/

/**
* Include the class_core if it�s not done so far...
*/
require_once($root_path.'include/care_api_classes/class_core.php');

/**
* Class and its members..
*/
class report extends core {

  /**
  * constructor
  */

  var $tmp_tbl_name="rep_tbl";
  var $sql="";

  /**
  * Class-Constructor: Setting debug=FALSE if you don�t want to have some debugging
  */
  function report() {
    global $db;
    $this->debug=false;
    $this->debug==TRUE ? $db->debug=TRUE : $db->debug=FALSE;
  }

  /**
  * The fieldnames must be named seperated by commatas within the common SQL syntax. This private method will serve it.
  */
  function _SetColumnNamesAsString($tbl_name,$arr_fields) {
    while (list($index,$column)=each($arr_fields))
      if ($index>=0)
        //$result_str.=$tbl_name.".".$column." AS ".$column.$index.",";
        $result_str.=$column.",";
    return substr($result_str,0,strlen($result_str)-1);
  }

  /**
  * This private class will check if the table $tbl is an temporary table or not. Return value is either
  * TRUE or FALSE.
  * todo: It must be inserted in some other publich methods - in places it makes sense.
  */
  function _isTemporaryTable($tbl) {
    return (stristr($tbl,$this->tmp_tbl_name)) ? TRUE : FALSE;
  }

  /**
  * This private method will erase all fields that are not allowed in temporary tables.
  * It gives an "clean" array of allowed fields back.
  */
  function _DropOutNotAllowedFields($t, $f) {
    global $db;
    $arr_forbidden_fields=array("text","blob");
    $this->setTable($t);
    $this->sql="show fields from $this->coretable";
    $rs_ptr = $db->Execute($this->sql);
    $fieldlist=array();
    while ($row=$rs_ptr->FetchRow()) {
      reset($arr_forbidden_fields);
      $INSERT_FIELD=TRUE;
      while (list($i,$v) = each($arr_forbidden_fields))
        if ($v==$row['Type'])
          $INSERT_FIELD=FALSE;
      if ($INSERT_FIELD)
        array_push($fieldlist,$row['Field']);
    }
    return $fieldlist;
  }


  /**
  * This private method gives the column names back that are allowed in TEMPORARY tables.
  * By using the JOIN command there are the possibility of ambigius column names. In this
  * case this private method will rename this ambigius fields with the syntax: TABLENAME_FIELDNAME
  * IT will return an comma separated string that can be used in common SQL syntaxes.
  */
  function _ColumnNames() {
    if ($this->debug) echo "class_report::_ColumnNames(".func_num_args()." parameters)<br>";

  	if (func_num_args()>2) {

  		if ($this->debug) echo "---> 4 parameters...<br>";

  		$tbl1     = func_get_arg(0);
  		$fields1  = func_get_arg(1);
  		$tbl2	  = func_get_arg(2);
  		$fields2  = func_get_arg(3);

	    $arr_field1=explode(",",$fields1);
	    $arr_field2=explode(",",$fields2);

	    if (!$this->_isTemporaryTable($tbl))
	      $arr_field1 = $this->_DropOutNotAllowedFields($tbl1, $arr_field1);
	    if (!$this->_isTemporaryTable($tb2))
	      $arr_field2 = $this->_DropOutNotAllowedFields($tbl2, $arr_field2);

	    while (list($i2,$v2)=each($arr_field2)) {
	      while (list($i1,$v1)=each($arr_field1)) {
	        if (strtolower($v1)==strtolower($v2)) {
	          $arr_field1[$i1]=$tbl1.".".$v1." AS ".$tbl1."_".$v1;
	          $arr_field2[$i2]=$tbl2.".".$v2." AS ".$tbl2."_".$v2;
	        }
	      }
	      reset($arr_field1);
	    }
	    $fields1=implode (",",$arr_field1);
	    $fields2=implode (",",$arr_field2);
	    return $fields1.",".$fields2;

  	} else {

  		if ($this->debug) echo "---> just 2 parameters...<br>";

  		$tbl1     = func_get_arg(0);
  		$fields1  = func_get_arg(1);


	    $arr_field1=explode(",",$fields1);

	    if (!$this->_isTemporaryTable($tbl))
	      $arr_field1 = $this->_DropOutNotAllowedFields($tbl1, $arr_field1);

	      while (list($i1,$v1)=each($arr_field1)) {
	        if (strtolower($v1)==strtolower($v2)) {
	          $arr_field1[$i1]=$tbl1.".".$v1." AS ".$tbl1."_".$v1;
	          $arr_field2[$i2]=$tbl2.".".$v2." AS ".$tbl2."_".$v2;
	        }
	    }
	    $fields1=implode (",",$arr_field1);
	    return $fields1;


  	}
  	exit();
  }


  /**
  * This method will drop the temporary table named as parameter in the method call
  *
  * todo: Check that it is a temprary table what is to delete!
  */

  function DisconnectReportingTable($tbl='') {
    if (empty($tbl)) {
      return FALSE;
    } else {
      $this->SetTable($tbl);
      $this->sql = "DROP TABLE $this->coretable";
      return ($this->Transact($this->sql)) ? $this->coretable : FALSE;
    }
  }

  /**
  * Sets the main core table for reportings and later following links to it.
  * You will get an reference number back if there is an tmp-table successfully created.
  *
  *<code>
  * $rep_obj = new selianreport();
  * $table_ref = $rep_obj -> SetReportingTable();
  *</code>
  * OR in case you have an name for one table:
  *<code>
  * $rep_obj = new selianreport();
  * $table_ref = $rep_obj -> SetReportingTable('care_tz_insurance');
  *</code>
  */
  function SetReportingTable($tbl='') {
 
  	if ($this->debug) echo "class_report::SetReportingTable($tbl)<br>";
  	$result_fields_tbl = $this->_SetColumnNamesAsString($tbl,$this->GetFieldnames($tbl));
  	$result_fields = $this->_ColumnNames($tbl,$result_fields_tbl);
    $this->setTable($this->tmp_tbl_name.=time());


	// enlarge the max_tmp_table_size to the maximum what we can use:
	//$this->Transact("SET @@max_heap_table_size=4294967296");

    if (empty($tbl)) {
      if (empty($tbl)) {
        $this->sql="CREATE TEMPORARY TABLE $this->coretable (id int unsigned not null, primary key (id)) ";
      } else {
        $this->sql="CREATE TEMPORARY TABLE $this->coretable  SELECT $result_fields FROM $tbl ";
      }
    } else {    
      $this->sql="CREATE TEMPORARY TABLE $this->coretable  SELECT $result_fields FROM $tbl ";
    }
    return ($this->Transact($this->sql)) ? $this->coretable : FALSE;
  }

  /**
  * List all fieldnames given by the table $tbl. This gives an array with all fieldnames back.
  */
  function GetFieldnames($tbl='') {
    global $db;
    if (!empty($tbl)) {
      $this->sql="show fields from $tbl";
      $rs_ptr = $db->Execute($this->sql);
      $res_array = $rs_ptr->GetArray();
      $f[-1]=''; //init
      while (list ($i,$v)=each($res_array)) {
        array_push($f,$v['Field']);
      }
      return $f;
    } else {
      return FALSE;
    }
  }

  /**
  * Sometimes it is important that the primary index field is know.
  * todo: Maybe this is more and less an private object of this class. Let see...
  */
  function GetPrimaryIndexField($tbl='') {
    global $db;
    if (!empty($tbl)) {
      $this->sql="show index from $tbl ";
      $rs_ptr = $db->Execute($this->sql);
      $res_array = $rs_ptr->GetArray();
      while (list ($i,$v)=each($res_array)) {
        if ($v['Key_name']=='PRIMARY'){
          $primary_field_name=$v['Column_name'];
        }
      }
      return $primary_field_name;
    } else {
      return FALSE;
    }
  }

  /**
  * Checks if this named $keyfield in the table $tbl is an primary index.
  * todo: Maybe this is more and less an private object of this class. Let see...
  */
  function is_primary_index($tbl,$keyfiled) {
    global $db;
    if (!empty($tbl)) {
      $this->sql="show index from $tbl ";
      $rs_ptr = $db->Execute($this->sql);
      $res_array = $rs_ptr->GetArray();
      while (list ($i,$v)=each($res_array)) {
        if ($v['Key_name']=='PRIMARY'){
          echo $v['Column_name'];
          if ($keyfiled==$v['Column_name'])
            return TRUE;
          else
            return FALSE;
        }
      }
    } else {
      return FALSE;
    }
  }

  /**
  * This is the function what will be mostely used.
  * You can call this public method in three different ways, it will always give back an temporary table.
  * case1. Call without any destination table.
  *        e.g. $result = $rep_obj -> SetReportingTable();
  *        in $result is now stored an TEMPORARY table with one primay index field.
  * case2. Call with ONE destination table
  *        e.g. $result = $rep_obj -> SetReportingTable('care_tz_insurance');
  *        in $result is the name of the TEMPORARY table with all colums and rows what is given by the destination table
  * case3. Link two tables together
  *        e.g. $result = SetReportingLink('care_person','pid','care_encounter','pid');
  *        in $result is now stored an TEMPORARY table with this JOINED two tables.
  */
  function SetReportingLink($tbl1,$tbl1_key, $tbl2,$tbl2_key) {
    global $db;
    $this->debug=FALSE;
    if ($this->debug) echo "class_report::SetReportingLink($tbl1,$tbl1_key, $tbl2,$tbl2_key)<br>";
	// enlarge the max_tmp_table_size to the maximum what we can use:
	$this->Transact("SET @@max_heap_table_size=4294967296");
    if ( ! (empty($tbl1) || empty($tbl1_key) || empty($tbl2) || empty($tbl2_key)) ) {

      // For a given existing table from the database, we need more specific informations in the alias field

      // check it for table 1:
      $result_fields_tbl1 = $this->_SetColumnNamesAsString($tbl1,$this->GetFieldnames($tbl1));
      // check it for table 2:
      $result_fields_tbl2 = $this->_SetColumnNamesAsString($tbl2,$this->GetFieldnames($tbl2));

      // There are no TEXT nor BLOBS in TEMPORARY tables allowed: Clean it:
      $result_fields = $this->_ColumnNames($tbl1,$result_fields_tbl1,$tbl2,$result_fields_tbl2);

      $this->setTable($this->tmp_tbl_name.=time());
      $this->sql="CREATE TEMPORARY TABLE $this->coretable  SELECT $result_fields FROM $tbl1 INNER JOIN $tbl2 ON $tbl1.$tbl1_key=$tbl2.$tbl2_key ";
      return ($this->Transact($this->sql)) ? $this->coretable : FALSE;
    } else {
      return FALSE;
    }
  }

  /**
  * This public method will give back the number of rows given by the table $tbl
  */
  function RowCount($tbl) {
    global $db;
    if ($this->debug) echo "class_report::RowCount($tbl)<br>";
    $this->setTable($tbl);
    $this->sql="SELECT COUNT(*) FROM $this->coretable";
    $rs_ptr = $db->Execute($this->sql);
    return ($row=$rs_ptr->FetchRow()) ? $row[0] : FALSE;
  }

  /**
  * This public method will give back an array that represents the result after a GROUP BY on an table $table
  */
  function GroupBy($table,$field) {
    global $db;
    if ($this->debug) echo "class_report::GroupBy($table,$field)<br>";
    $result_fields = $this->_SetColumnNamesAsString($table,$this->GetFieldnames($table));
    $this->setTable($table);
    $this->sql="SELECT $result_fields FROM $table GROUP BY $field ";
    $rs_ptr = $db->Execute($this->sql);
    return $res_array = $rs_ptr->GetArray();

  }

  /**
  * This public method will give back an new TEMPORARY table that represents the result after a GROUP BY on an table $table
  */
  function TMP_GroupBy($table,$field) {
    global $db;
    if ($this->debug) echo "class_report::GroupBy($table,$field)<br>";
    $result_fields = $this->_SetColumnNamesAsString($table,$this->GetFieldnames($table));
      $this->setTable($this->tmp_tbl_name.=time());
      $this->sql="CREATE TEMPORARY TABLE $this->coretable  SELECT $result_fields FROM $table GROUP BY $field ";
    return ($this->Transact($this->sql)) ? $this->coretable : FALSE;

  }

 }

?>
