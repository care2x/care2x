<?php
/**
* Care2x API package
* @package care_api
*/

/**
*  Core methods. Will be extended by other classes.
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Core {
	/**
	* @var string Table name used for core routines. Default table name.
	*/
    var $coretable;
	/**
	* @var string Holder for SQL query. Can be extracted with the "getLastQuery()" method.
	*/
	var $sql='';
	/**
	* @var array  Contains fieldnames of the table named in the $coretable. For internal update/insert operations.
	*/
	var $ref_array=array();
	/**
	* @var array   For internal update/insert operations
	*/
	var $data_array=array();
	/**
	* @var array   For internal update/insert operations
	*/
	var $buffer_array=array();
	/**
	* @var ADODB record object  For sql query results.
	*/
	var $result;
	/**
	* @var string  For update sql queries condition
	*/
	var $where;
	/**
	* @var int  For counting resulting rows. Can be extracted w/ the "LastRecordCount()" method.
	*/
	var $rec_count;
	/**
	* @var mixed
	*/
	var $buffer;
	/**
	* @var array  Used for containing results returned as pointer.
	*/
	var $res=array();
	/**#@+
	* @var boolean
	* @access private
	*/
	var $do_intern;
	var $ok;
	/**#@-*/
	var $is_preloaded=FALSE;
	/**
	*  Internal error message  usually used in debugging.
	* @var string
	* @access private
	*/
	var $error_msg='';
	/**
	* Status items used in sql queries "IN (???)"
	* @var string
	* @access private
	*/
	var $dead_stat="'deleted','hidden','inactive','void'";
	/**
	* Status items used in sql queries "IN (???)"
	* @var string
	* @access private
	*/
	var $normal_stat="'','normal'";
	/**
	* Sets the coretable variable to the name of the database table.
	*
	* This points the core object to that database table and all core routines will use this table
	* until the core table is reset or replaced with another table name
	* @param string Table name
	* @return void
	*/
	function setTable($table) {
	    $this->coretable=$table;
	}
	/**
	* Points the reference variable $ref_array to the field names' array.
	*
	* This field names array corresponds to  the database table set by the setTable() method
	* @param array By reference, the associative array containing the field names.
	* @return boolean
	*/
	function setRefArray(&$array) {
	    if(!is_array($array)){
			return FALSE;
		}else{
	   		$this->ref_array=$array;
			return TRUE;
		}
	}
	/**
	* Points the core data array to the external array that holds the data to be stored.
	* @param array  By reference, the associative array holding the data.
	*/
	function setDataArray(&$array){
	    $this->data_array=$array;
	}
	/**
	* Checks if a certain database record exists based onthe supplied query condition.
	*
	* Should be used privately.
	* @param string The query "where" condition without the WHERE word.
	* @return boolean
	*/
	function _RecordExists($cond=''){
		global $db;
		if(empty($cond)) return FALSE;
		if($this->result=$db->Execute("SELECT create_time FROM $this->coretable WHERE $cond")){
			if($this->result->RecordCount()){
				return TRUE;
			}else{return FALSE;}
		}else{return FALSE;}
	}
	/**
	* Sets the internal sql query variable to the sql query.
	* @param string Query statement.
	*/
	function setSQL(&$sql){
		$this->sql=$sql;
	}
	/**
	* Transaction routine, ADODB transaction. It internally uses the ADODB transaction routine.
	*
	* <code>
	* $sql="INSERT INTO care_users (item) VALUES ('value')";
	* $core->Transact($sql);
	* </code>
	* If the query parameter is empty, the method will use the sql query stored internally.
	* This internal sql query statement must be set with the setSQL() method or direct setting of variable before Transact() is called.
	*
	* <code>
	* $sql="INSERT INTO care_users (item) VALUES ('value')";
	* $core->setSQL($sql);
	* $core->Transact();
	* </code>
	*
	* or internally in class extensions
	*
	* <code>
	* $this->sql="INSERT INTO care_users (item) VALUES ('value')";
	* $this->Transact();
	* </code>
	*
	* @param string sql  SQL query statement.
	* @return TRUE/FALSE
	* @global ADODB db link
	* @access public
	*/
	function Transact($sql='') {
		global $db;
		if(!empty($sql)) $this->sql=$sql;
		$db->BeginTrans();
		$this->ok=$db->Execute($this->sql);
		if($this->ok) {
			$db->CommitTrans();
			return TRUE;
		} else {
			$db->RollbackTrans();
			return FALSE;
		}
	}
	/**
	* Filters the data array intended for saving, removing the key-value pairs that do not correspond to the table's field names.
	* @access private
	* @return int Size of the resulting data array.
	*/
	function _prepSaveArray(){
		$x='';
		$v='';
		reset($this->ref_array);
		reset($this->data_array);
		while(list($x,$v)=each($this->ref_array)) {
			// Gjergj Sheldija :
			// deleted && ($this->data_array[$v]!='') gives me errors when var value == 0
			if(isset($this->data_array[$v]) ) {
				$this->buffer_array[$v]=$this->data_array[$v];
				if($v=='create_time' && $this->data['create_time']!='') $this->buffer_array[$v] = date('YmdHis');
			}
		}
		# Reset the source array index to start
		reset($this->ref_array);
		return sizeof($this->buffer_array);
	}
	/**
	* Inserts data from the internal array previously filled with data by the <var>setDataArray()</var> method.
	*
	* This method also uses the field names from the internal array $ref_array previously set by "use????" methods that point
	* the core object to the proper table and fields names.
	* @access public
	* @return boolean
	*/
	function insertDataFromInternalArray() {
		//$this->data_array=NULL;
		$this->_prepSaveArray();
		# Check if  "create_time" key has a value, if no, create a new value
		//if(!isset($this->buffer_array['create_time'])||empty($this->buffer_array['create_time'])) $this->buffer_array['create_time']=date('YmdHis');
		return $this->insertDataFromArray($this->buffer_array);
	}
	/**
	* Returns all records with the needed items from the table.
	*
	* The table name must be set in the coretable first by <var>setTable()</var> method.
	* @param string  items By reference. Items to be returned from each record fetched from the table. The items should be separted with commas.
	* @return mixed ADODB record object or boolean
	*
	* Example:
	*
	* <code>
	* $items="pid, name_last, name_first, birth_date, sex";
	* $core->setTable('care_person');
	* $persons = $core->getAllItemsObject($items);
	* while($row=$persons->FetchRow()){
	* ...
	* }
	* </code>
	*
	*/
	function getAllItemsObject(&$items) {
		global $db;
		$this->sql="SELECT $items  FROM $this->coretable";
        	if($this->res['gaio']=$db->Execute($this->sql)) {
			if($this->rec_count=$this->res['gaio']->RecordCount()) {
				 return $this->res['gaio'];
			} else { return FALSE; }
		} else { return FALSE; }
	}
	/**
	* Returns all records with all items from the table.
	*
	* The table name must be set in the coretable first by setTable() method.
	* @return mixed ADODB record object or boolean
	*
	* Example:
	*
	* <code>
	* $core->setTable('care_person');
	* $persons = $core->getAllDataObject();
	* while($row=$persons->FetchRow()){
	* ...
	* }
	* </code>
	*/
	function getAllDataObject() {
	    global $db;
	    $this->sql="SELECT *  FROM $this->coretable";
        if($this->res['gado']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['gado']->RecordCount()) {
				 return $this->res['gado'];
			} else { return FALSE; }
		} else { return FALSE; }
	}
	/**
	* Similar to getAllItemsObject() method but returns the records in an associative array.
	*
	* Returns all records with the needed items from the table. The table name must be set in the coretable first by <var>setTable()</var> method.
	*
	* Example:
	* <code>
	* $items="pid, name_last, name_first, birth_date, sex";
	* $core->setTable('care_person');
	* $persons = $core->getAllItemsArray($items);
	* while(list($x,$v)=each($persons)){
	* ...
	* }
	* </code>
	*
	* @param  string items By reference. Items to be returned from each record fetched from the table. The items should be separted with commas.
	* @return array associative
	* @access private
	*/
	function getAllItemsArray(&$items) {
	    global $db;
	    $this->sql="SELECT $items  FROM $this->coretable";
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 //while($this->ref_array=$this->result->FetchRow());
				 //return $this->ref_array;
				 return $this->result->GetArray();
			} else { return FALSE; }
		} else { return FALSE; }
	}
	/**
	* Returns all records with the all items from the table.
	*
	* The table name must be set in the coretable first by setTable() method.
	* @return mixed ADODB record object or boolean
	* @global ADODB db link
	*
	* Example:
	* <code>
	* $core->setTable('care_person');
	* $persons = $core->getAllDataArray();
	* while(list($x,$v)=each($persons)){
	* ...
	* }
	* </code>
	*/
	function getAllDataArray() {
	    global $db;
	    $this->sql="SELECT *  FROM $this->coretable";
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 while($this->ref_array=$this->result->FetchRow());
				 return $this->ref_array;
			} else { return FALSE; }
		} else { return FALSE; }
	}
	/**
	* Inserts data from an array  (passed by reference) into a table.
	*
	* This method  uses the table and field names from  internal variables previously set by "use????" methods that point
	* the object to the proper table and fields names. Private or public (preferably private being called by other methods).
	* @access private
	* @param array By reference. The array containing the data. Note: the array keys must correspond to the table field names.
	* @return boolean
	*/
   function insertDataFromArray(&$array) {
   		global $dbtype;
		$x='';
		$v='';
		$index='';
		$values='';
		//gjergji : bug for concat  when inserting...
		if($dbtype=='postgres7'||$dbtype=='postgres') $concatfx='||';
			else $concatfx='concat';
		if(!is_array($array)){ return FALSE;}
		while(list($x,$v)=each($array)) {
			# use backquoting for mysql and no-quoting for other dbs
			if ($dbtype=='mysql') $index.="`$x`,";
				else $index.="$x,";
				
			if(stristr($v,$concatfx)||stristr($v,'null')) $values.=" $v,";
				else $values.="'$v',";
		}
		reset($array);
		$index=substr_replace($index,'',(strlen($index))-1);
		$values=substr_replace($values,'',(strlen($values))-1);
		$this->sql="INSERT INTO $this->coretable ($index) VALUES ($values)";
		reset($array);
		return $this->Transact();
	}
	/**
	* Updates a record with the data from an array  (passed by reference) based on the primary key.
	*
	* This method also uses the field names from an internal array previously set by "use????" methods that point
	* the object to the proper table and fields names.
	* private or public (preferably private being called by other methods)
	* @param array Data. By reference. Note: the array keys must correspond to the table field names
	* @param int Key used in the update queries' "where" condition
	* @param boolean Flags if the param $item_nr should be strictly numeric or not. Defaults to TRUE = strictly numeric.
	* @return boolean
	*/
    function updateDataFromArray(&$array,$item_nr='',$isnum=TRUE) {
    	global $dbtype;
		$x='';
		$v='';
		$elems='';
		if($dbtype=='postgres7'||$dbtype=='postgres') $concatfx='||';
			else $concatfx='concat';
		if(empty($array)) return FALSE;
		if(empty($item_nr)||($isnum&&!is_numeric($item_nr))) return FALSE;
		while(list($x,$v)=each($array)) {
			# use backquoting for mysql and no-quoting for other dbs.
			if ($dbtype=='mysql') $elems.="`$x`=";
				else $elems.="$x=";
			
			if(stristr($v,$concatfx)||stristr($v,'null')) $elems.=" $v,";
				else $elems.="'$v',";
		}
		# Bug fix. Reset array.
		reset($array);

		$elems=substr_replace($elems,'',(strlen($elems))-1);
		if(empty($this->where)) $this->where="nr=$item_nr";
        $this->sql="UPDATE $this->coretable SET $elems WHERE $this->where";
		# Bug fix. Reset the condition variable to prevent affecting subsequent update calls.
		$this->where='';
		return $this->Transact();
	}
	/**
	* Updates a table using data from an internal array previously filled with data by the <var>setDataArray()</var> method.
	*
	* Update the record based on the primary key.
	* This method also uses the field names from an internal array previously set by "use????" methods that point
	* the object to the proper table and fields names.
	* @access public
	* @param int Key used in the update queries' "where" condition
	* @param boolean Flags if the param $item_nr should be strictly numeric or not. Defaults to TRUE = strictly numeric.
	* @return boolean
	*/
    function updateDataFromInternalArray($item_nr='',$isnum=TRUE) {
		if(empty($item_nr)||($isnum&&!is_numeric($item_nr))) return FALSE;
	    $this->_prepSaveArray();
		return $this->updateDataFromArray($this->buffer_array,$item_nr,$isnum);
	}
	/**
	* Returns the the last sql query string
	* @return string
	*/
	function getLastQuery(){
		return $this->sql;
	}
	/**
	* Feturns the value of result
	* @return mixed
	*/
	function getResult(){
		return $this->result;
	}
	/**
	* Feturns the value of error_msg, the internal error message.
	* @return string
	*/
	function getErrorMsg(){
		return $this->error_msg;
	}
	/**
	* Sets the "where"  condition in an update query used with the updateDataFromInternalArray() method.
	*
	* The where condition defaults to "nr='$nr'".
	* @access private
	* @param string cond The constraint for the sql query.
	* @return void
	*/
	function setWhereCondition($cond){
		$this->where=$cond;
	}
	/**
	* Returns the value of is_preloaded that is set by methods that preload large number of data.
	* @return boolean
	*/
	function isPreLoaded(){
		return $this->is_preloaded;
	}
	/**
	* Returns the value of rec_count
	* @return int
	*/
	function LastRecordCount(){
		return $this->rec_count;
	}
	/**
	* Saves temporary data to a cache in database.
	* @access public
	* @param string Cached data identification
	* @param mixed By referece.  Data to be saved.
	* @param boolean Signals the type of the data contained in the param $data.  FALSE=nonbinary data, TRUE=binary
	* @return boolean
	*/
	function saveDBCache($id,&$data,$bin=FALSE){
		if($bin) $elem='cbinary';
			else $elem='ctext';
		$this->sql="INSERT INTO care_cache (id,$elem,tstamp) VALUES ('$id','$data','".date('YmdHis')."')";
		return $this->Transact();
	}
	/**
	* Gets temporary data from the database cache.
	* @access public
	* @param string Cached data identification
	* @param mixed By reference.  Variable for the data to be fetched.
	* @param boolean   Signals the type of data contained in the $data.  FALSE=nonbinary data, TRUE=binary.
	* @return mixed string, binary or boolean
	*/
	function getDBCache($id,&$data,$bin=FALSE){
		global $db;
		$buf;
		$row;
		if($bin) $elem='cbinary';
			else $elem='ctext';
		$this->sql="SELECT $elem FROM care_cache WHERE id = '$id'";
        if($buf=$db->Execute($this->sql)) {
            if($buf->RecordCount()) {
				 $row=$buf->FetchRow();
				 $data=$row[$elem];
				 return TRUE;
			} else { return FALSE; }
		} else { return FALSE; }
	}
	/**
	* Deletes data from the database cache based on the id key.
	* @access public
	* @param char ID of data for deletion.
	* @return boolean
	*/
	function deleteDBCache($id){
		global $sql_LIKE;
		if(empty($id)) return FALSE;
		$this->sql="DELETE  FROM care_cache WHERE id = '$id'";
		return $this->Transact();
	}
	/**
	* Deletes data from a database table based on the job_id and
	* batch_nr. Used in the update action for the laboratory tables
	* ( chemlabor and baclabor )
	* @access public
	* @param varchar $batch_nr
	* @param varchar $job_id
	* @return boolean
	*/
	function deleteOldValues($batch_nr, $encounter_nr){
		if(empty($batch_nr) || empty($encounter_nr)) return FALSE;
		$this->sql="DELETE  FROM $this->coretable WHERE batch_nr = '$batch_nr' AND encounter_nr = '$encounter_nr'";
		return $this->Transact();
	}	
	/**
	* Returns the  core field names of the core table in an array.
	* @access public
	* @return array
	*/
	function coreFieldNames(){
		return $this->ref_array;
	}
	/**
	* Returns a list of filename within a path in array.
	* @access public
	* @param string Path of the filenames relative to the root path.
	* @param string Discriminator string.
	* @param  string The sort direction (ASC or DESC) defaults to ASC (ascending)
	* @return mixed  array or boolean
	*/
	function FilesListArray($path='',$filter='',$sort='ASC'){
		$localpath=$path.'/.';
		//echo "<br>$localpath<br>";
		$this->res['fla']=array();
		if(file_exists($localpath)){
			$handle=opendir($path);
			$count=0;
 			while (FALSE!==($file = readdir($handle))) {
     			if ($file != "." && $file != ".."){
					if(!empty($filter)){
						if(stristr($file,$filter)){
							$this->res['fla'][$count]=$file;
							$count++;
						}
					}else{
						$this->res['fla'][$count]=$file;
						$count++;
					}
     			}
			}
 			closedir($handle);
			if($count){
				$this->rec_count=$count;
				if($sort=='ASC'){
					@sort($this->res['fla']);
				}elseif($sort=='DESC'){
					@rsort($this->res['fla']);
				}
					return $this->res['fla'];
			}
		}else{
			return FALSE;
		}
	}
	/**
	* Returns the  value of the primary key of a row based on the column OID key
	*
	* Special for postgre and other dbms that returns OID after an insert query
	* @param str Table name
	* @param str Field name of the primary key
	* @param int OID value
	* @return int Non-zero if value ok, else zero if not found
	*/
	function postgre_Insert_ID($table,$pk,$oid=0){
		global $db;
		if(empty($oid)){
			 return 0;
		}else{
			$this->sql="SELECT $pk FROM $table WHERE oid=$oid";
			if($result=$db->Execute($this->sql)) {
				if($result->RecordCount()) {
					$buf=$result->FetchRow();
					 return $buf[$pk];
				} else { return 0; }
			} else { return 0; }
		}
	}
	/**
	* Returns the  value of the last inserted primary key of a row based on the column field name
	*
	* This function uses the  core table set by the child class
	* @param str Field name of the primary key
	* @param int OID value
	* @return int Non-zero if value ok, else zero if not found
	*/
	function LastInsertPK($pk='',$oid=0){
		global $dbtype;
		if(empty($pk)||empty($oid)){
			return $oid;
		}else{
			switch($dbtype){
				case 'mysql': return $oid;
					break;
				case 'postgres': return $this->postgre_Insert_ID($this->coretable,$pk,$oid);
					break;
				case 'postgres7': return $this->postgre_Insert_ID($this->coretable,$pk,$oid);
					break;
				default: return $oid;
			}
		}
	}
	/**
	* Returns  a field concat string for sql query.
	*
	* This function resolves the problems of concatenating a field value with a string in different db types
	* @param str Field name
	* @param str String to concate
	* @return string
	*/
	function ConcatFieldString($fieldname,$str=''){
		global $dbtype;

		switch($dbtype){
			case 'mysql': return "CONCAT($fieldname,'$str')";
				break;
			case 'postgres': return "$fieldname || '$str'";
				break;
			case 'postgres7':return "$fieldname || '$str'";
				break;
			default: return "$fieldname || '$str'";
		}
	}
	/**
	* Returns  a "history" field concat string for sql query.
	*
	* This function resolves the problems of concatenating the "history" field value with a string in different db types
	* @param str String
	* @return string
	*/
	function ConcatHistory($str=''){
		return $this->ConcatFieldString('history',$str);
	}
	/**
	* Returns  a "notes" field concat string for sql query.
	*
	* This function resolves the problems of concatenating the "note"  field value with a string in different db types
	* @param str String
	* @return string
	*/
	function ConcatNotes($str=''){
		return $this->ConcatFieldString('notes',$str);
	}
	/**
	* Returns  a field's string for sql query. Portions of the string is replaced by a string.
	*
	* This function resolves the problems of replacing a field value with a string in different db types
	* @param str Field name
	* @param str String to be replaced
	* @param str Replacement string
	* @return string
	*/
	function ReplaceFieldString($fieldname,$str1='',$str2=''){
		global $dbtype;

		switch($dbtype){
			case 'mysql': return "REPLACE($fieldname,'$str1','$str2')";
				break;
				default: return "REPLACE($fieldname,'$str1','$str2')";
		}
	}
}
?>
