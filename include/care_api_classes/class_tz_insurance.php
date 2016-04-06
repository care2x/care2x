<?php
require_once($root_path.'include/care_api_classes/class_core.php');


/**
*  Insurance methods for tanzania (the product-module is completely rewritten by Alexander Irro)
*
* Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Alexander Irro (Version 1.0.0) - alexander.irro@merotech.de
* @copyright 2006 Robert Meggle (MEROTECH info@merotech.de)
* @package care_api from Elpidio Latirilla
*/



class Insurance_tz extends Core {

  var $tbl_company='care_tz_company';
  var $tbl_temp="tmp_search_results";
  var $fields_tbl_company=array('id','name','contact','email',
									'phone_code',
									'phone_nr',
									'po_box',
									'city',
									'start_date',
									'end_date');
  var $result;
  var $rs_fuzziness;
  var $pid;

  // Constructor
  function Insurance_tz() {
    return TRUE;
  }

  //------------------------------------------------------------------------------
  // Methods:


  function CheckForValidContract($PID,$timestamp=0,$company_id=0) {
  	/*
  	 * Retruns -2 when this person is contracted to another company!
  	 */

    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if($timestamp==0) $timestamp = time();
    if ($debug) {
    	echo "check for $PID for Company-ID $company_id <br>";
    	echo "Is there a company for $PID: ".$this->GetCompanyFromPID($PID)."<br>";
    }

	//$db_company is the (possible) company for this PID what comes out of database. Could be empty or the Id of the company.
	$db_company=$this->GetCompanyFromPID($PID);

    if (empty($company_id)) {
      $company_id = $db_company;
    } else {
        // Check if the company_id (as parameter) is the same like what we have in the database:
    	if (($company_id <> $db_company) && (!empty($db_company))) {
    			return -2;
    		}
    }
    if ($debug) echo "CheckForValidContract::GetCompanyFromPID returns: ".$company_id."<br>";
    $contractarray = $this->GetActualContractForCompanyAsArray($company_id);
    //echo $contractarray['start_date']."<".$timestamp." && ".$contractarray['end_date'].">".$timestamp;
    if($contractarray['start_date']<$timestamp && $contractarray['end_date']>$timestamp)
	  {
	    $this->sql="SELECT i.*, it.ceiling FROM care_tz_insurance i, care_tz_insurance_types it WHERE company_id=".$company_id." AND PID=".$PID." AND parent= ".$contractarray['id']." AND cancel_flag=0 AND it.id = i.plan ORDER BY i.id DESC LIMIT 1";
	    $this->result = $db->Execute($this->sql);
	    if ($debug) echo $this->sql;
	    if($this->result)
		    if($this->row = $this->result->FetchRow())
		    {
		    	$this->row['is_valid']=TRUE;
		    	$this->row['contract_start_date'] = $contractarray['start_date'];
		    	$this->row['contract_end_date'] = $contractarray['end_date'];
		    	return $this->row;
		  	}
		}
  	return false;
  }

  // -----------------------------------------------------------------------------

  function GetCompanyIDFromContract($contract) {
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
  	$this->sql="SELECT company_id FROM care_tz_insurance WHERE id=".$contract;
    $this->result = $db->Execute($this->sql);
    if($this->row = $this->result->FetchRow())
    {
   		return $this->row['company_id'];
  	}
  	return false;
  }

  // -----------------------------------------------------------------------------

  function GetCompanyFromPID($PID) {
    global $db;
    if (!$PID) return FALSE;
    $debug=FALSE;
    $company_id=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="SELECT company_id FROM care_tz_insurance WHERE PID=$PID ORDER BY id DESC LIMIT 1";
    $this->result = $db->Execute($this->sql);
    if($this->row = $this->result->FetchRow()) {
    	$company_id=$this->row['company_id'];
  	}
	return $company_id;

  }

  // -----------------------------------------------------------------------------

  function GetCompanyFromParent($parent,$start)
  {

    global $db;

    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
		//Abort reason
  	if(!$parent) return false;
  	if($start)
  		$where = 'WHERE PID='.$parent;
  	else
  		$where = 'WHERE id='.$parent;
  	$this->sql="SELECT company_id, parent FROM care_tz_insurance $where ORDER BY id DESC LIMIT 1";
    $this->result = $db->Execute($this->sql);
    if($this->row = $this->result->FetchRow())
    {
    	if($this->row['parent']!=-1)
    	{
    		//Recursive call of next parent
    		return $this->GetCompanyFromParent($this->row['parent'],false);
    	}
    	else
    	{
    		//We finally got it, return it now all the way back
    		return $this->row['company_id'];
    	}
  	}

	}

  function GetAllInsurancesAsArray($JUST_CONTRACTED=FALSE,$hide_flag) {
    /**
    * If you want just a list of contracted companies, give this function a TRUE as parameter
    */
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if($hide_flag)
    {
    	$hide_sql1 = " WHERE hide_company_flag=0";
    	$hide_sql2 = " AND care_tz_company.hide_company_flag=0";
    }
    else
    {
    	$hide_sql1=false;
    	$hide_sql2=false;
    }
    if (!$JUST_CONTRACTED)
	  	$this->sql="SELECT com.id, com.name,com.contact, com.email, com.phone_code, com.phone_nr, com.po_box, com.city, com.hide_company_flag,
        ins.cancel_flag,ins.start_date,ins.end_date

        FROM 

        ( SELECT max(care_tz_insurance.id) as c_id,care_tz_company.id FROM

        care_tz_insurance
         INNER JOIN care_tz_company  ON care_tz_insurance.company_id=care_tz_company.id  GROUP BY care_tz_company.id  

        ) as ins_q
		
		INNER JOIN care_tz_insurance as ins ON
        ins_q.c_id      =  ins.id 
		RIGHT JOIN care_tz_company as com ON
        ins_q.id      =  com.id  ".$hide_sql1." ORDER BY com.id ASC";
		
		
		
    else {
      // This gives a list of companies what are somehow dedicated to a list of contracted companies
      // No check if the contract is valid to any time period...
      $this->sql="SELECT
                    care_tz_company.id,
                    care_tz_company.name,
                    care_tz_company.contact,
		    		care_tz_company.email,
		    		care_tz_company.phone_code,
		    		care_tz_company.phone_nr,
                    care_tz_company.po_box,
                    care_tz_company.city,
                    care_tz_company.start_date,
                    care_tz_company.end_date,
                    care_tz_company.invoice_flag,
                    care_tz_company.credit_preselection_flag,
                    care_tz_company.hide_company_flag,
                    care_tz_company.prepaid_amount
                  FROM care_tz_company
                    INNER JOIN care_tz_insurance ON care_tz_insurance.company_id=care_tz_company.id
                    INNER JOIN care_tz_insurance_types ON care_tz_insurance_types.id=care_tz_insurance.plan
                  WHERE parent=-1".$hide_sql2."
                  ORDER BY care_tz_company.name";
    }

    $this->result = $db->Execute($this->sql);
    $counter=0;
    if ($this->result)
	    while($this->row = $this->result->FetchRow())
	    {
	    	$return[$counter++] = $this->row;
	  	}
  	return $return;
  }

  // -----------------------------------------------------------------------------

  function GetContractsForCompanyAsArray($company_id) {
    global $db;

    $debug=FALSE;
    $return=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    /*
    if ($this->is_company_just_invoiced($company_id)) {
    	# This company does not have a ceiling, does not have any entry what allocates to care_tz_insurance_types.
    	# so there is no need to join this table.
    	$this->sql="SELECT i.id, start_date, end_date, cancel_flag, paid_flag FROM care_tz_insurance i WHERE PID=0 AND company_id=$company_id";
    } else {
     $this->sql="SELECT i.id, it.name, plan, start_date, end_date, cancel_flag, paid_flag FROM care_tz_insurance i, care_tz_insurance_types it WHERE PID=0 AND company_id=$company_id AND it.id = i.plan  ORDER BY end_date DESC";
    }
    */
    $this->sql="SELECT i.id, start_date, end_date, cancel_flag, paid_flag FROM care_tz_insurance i WHERE PID=0 AND company_id=$company_id";

    if ($debug) echo $this->sql;
    $this->result = $db->Execute($this->sql);
    $counter=0;
    if ($this->result)
	    while($this->row = $this->result->FetchRow()) {
	    	$return[$counter++] = $this->row;
	  	}
  	return $return;
  }

  // -----------------------------------------------------------------------------

  function GetContractMemberFromTimestamp($PID, $time) {

    global $db, $bill_obj;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    // Select matching contract
    $sql="SELECT id, company_id, start_date, end_date, timestamp, cancel_flag, paid_flag
	FROM care_tz_insurance i
	WHERE start_date <".$time."
	AND end_date >=".$time."
	AND id
	IN (
		SELECT parent AS id
		FROM care_tz_insurance i
		WHERE PID = ".$PID."
	)";

    if($result = $db->Execute($sql))
    {

		if($row = $result->FetchRow())
		{
			$matchingContract = $row;
		}

		$sql="SELECT i.id, company_id, it.ceiling, i.ceiling_startup_subtraction, it.name, plan, timestamp, cancel_flag, paid_flag, gets_company_credit
		FROM care_tz_insurance i, care_tz_insurance_types it
		WHERE it.id = i.plan AND parent = ".$matchingContract['id']." AND PID=".$PID;
		if($result = $db->Execute($sql))
			if($row = $result->FetchRow())
			{
				$matchingContract['Member'] = $row;
			}
	}
  	return $matchingContract;
  }

  // -----------------------------------------------------------------------------

  function GetActualContractForCompanyAsArray($company_id) {
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;

    if(!$company_id) return false;
    if ($this->is_company_just_invoiced($company_id)) {
    	# This company does not have a ceiling, does not have any entry what allocates to care_tz_insurance_types.
    	# so there is no need to join this table.
    	$this->sql="SELECT i.id, start_date, end_date, cancel_flag, paid_flag FROM care_tz_insurance i WHERE parent=-1 AND company_id=".$company_id." AND start_date<".time()." AND end_date > ".time()." AND cancel_flag=0 ORDER BY id DESC";
    } else {
    	$this->sql="SELECT i.id, it.name, plan, start_date, end_date, cancel_flag, paid_flag FROM care_tz_insurance i, care_tz_insurance_types it WHERE parent=-1 AND company_id=".$company_id." AND it.id = i.plan AND start_date<".time()." AND end_date > ".time()." AND cancel_flag=0 ORDER BY id DESC";
    }

    $this->result = $db->Execute($this->sql);
    $counter=0;
    if($this->row = $this->result->FetchRow())
    {

    	return $this->row;
  	}
  	return false;
  }

  function GetContractForCompanyAsArray($company_id) {
    global $db;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if(!$company_id) return false;
    $this->sql="SELECT i.id, it.name, plan, start_date, end_date, cancel_flag, paid_flag, gets_company_credit FROM care_tz_insurance i, care_tz_insurance_types it WHERE parent=-1 AND company_id=$company_id
    AND it.id = i.plan AND start_date>".time()." AND cancel_flag=0 ORDER BY id DESC LIMIT 0,1";
    $this->result = $db->Execute($this->sql);
    $counter=0;
    if($this->row = $this->result->FetchRow())
    {
    	return $this->row;
  	}
  	return false;
  }

  // -----------------------------------------------------------------------------




  function GetContractsByIDAsArray($contract_id) {
    global $db;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="SELECT i.id, i.company_id, it.name, plan, start_date, end_date, cancel_flag FROM care_tz_insurance i, care_tz_insurance_types it WHERE i.id = ".$contract_id." AND it.id = i.plan ORDER BY end_date DESC";
    $this->result = $db->Execute($this->sql);
    if($this->row = $this->result->FetchRow())
    {
    	return $this->row;
  	}
  	return false;
  }

  // -----------------------------------------------------------------------------



  function GetInsuranceTypesAsArray() {
    global $db;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="SELECT id, name, ceiling, is_disabled FROM care_tz_insurance_types ORDER BY id ASC";
    $this->result = $db->Execute($this->sql);
    $counter=0;
    while($this->row = $this->result->FetchRow())
    {
    	$return[$counter++] = $this->row;
  	}
  	return $return;
  }

  // -----------------------------------------------------------------------------

  function GetInsuranceTypeAsArray($id) {
    global $db;
    $debug=FALSE;

    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="SELECT id, name, ceiling, is_disabled FROM care_tz_insurance_types WHERE id=".$id;
    $this->result = $db->Execute($this->sql);

    if($this->row = $this->result->FetchRow())
    {
    	return $this->row;
  	}
  	return false;
  }

  // -----------------------------------------------------------------------------



	function GetInsuranceAsArray($id){
    global $db;
    if(!$id || !is_numeric($id)) return false;
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->is_company_just_invoiced($id)) {
    	# This company does not have a ceiling, does not have any entry what allocates to care_tz_insurance_types.
    	# so there is no need to join this table.
    	$this->sql="SELECT
                  care_tz_company.id,
                  care_tz_company.name,
                  care_tz_company.contact,
 	          	  care_tz_company.email,
		  		  care_tz_company.phone_code,
		 		  care_tz_company.phone_nr,
                  care_tz_company.po_box,
                  care_tz_company.city,
                  care_tz_company.start_date,
                  care_tz_company.end_date,
                  care_tz_company.invoice_flag,
                  care_tz_company.credit_preselection_flag,
                  care_tz_company.hide_company_flag,
                  care_tz_company.prepaid_amount,
                  care_tz_insurance.plan as insurance
                FROM care_tz_company
                  LEFT JOIN care_tz_insurance ON care_tz_insurance.company_id=care_tz_company.id
                WHERE care_tz_company.id=$id";

    } else {
    	$this->sql="SELECT
                  care_tz_company.id,
                  care_tz_company.name,
                  care_tz_company.contact,
		  care_tz_company.email,
		  care_tz_company.phone_code,
		  care_tz_company.phone_nr,
                  care_tz_company.po_box,
                  care_tz_company.city,
                  care_tz_company.start_date,
                  care_tz_company.end_date,
                  care_tz_company.invoice_flag,
                  care_tz_company.credit_preselection_flag,
		  care_tz_company.hide_company_flag,
		  care_tz_company.prepaid_amount,
                  care_tz_insurance_types.name as InsuranceName,
                  care_tz_insurance.plan as insurance
                FROM care_tz_company
                  LEFT JOIN care_tz_insurance ON care_tz_insurance.company_id=care_tz_company.id
                  LEFT JOIN care_tz_insurance_types ON care_tz_insurance_types.id=care_tz_insurance.plan
                WHERE care_tz_company.id=".$id;
    }
    if ($this->debug) echo $this->sql;
    if ( $this->result = $db->Execute($this->sql))
    	if($this->row = $this->result->FetchRow())  {
    		return $this->row;
  		}

  	// anyway, when the script is comming to this line, there is something wrong
  	// and we have to say that there was an error...
  	return false;
	}

  // -----------------------------------------------------------------------------

	function GetPlanForPID($pid) {
		/*
		 * Getting the correspodending plan for a specific PID. If there is no plan, it will return FALSE
		 */
    global $db;
    if(!$pid) return false;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="SELECT plan FROM care_tz_insurance where PID=$pid limit 0,1";
    $this->result = $db->Execute($this->sql);
    if($this->result)
    {
	    if($this->row = $this->result->FetchRow())
	    {
	    	return $this->row['plan'];
	    }
	  }
  	return FALSE;
	}



  // -----------------------------------------------------------------------------

	function GetInsuranceIDByCompanyID($id){
    global $db;
    if(!$id || !is_numeric($id)) return false;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="SELECT id FROM care_tz_insurance WHERE company_id =$id AND parent=-1 ORDER BY company_parent DESC LIMIT 1";
    $this->result = $db->Execute($this->sql);
    if($this->result)
    {
	    if($this->row = $this->result->FetchRow())
	    {
	    	return $this->row;
	    }
	  }
  	return 0;
	}

  //------------------------------------------------------------------------------
  	function CreateInsuranceRoot($id){

    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $company = $this->GetInsuranceAsArray($id);
    $this->sql="INSERT INTO care_tz_insurance SET
    	parent=-1,
    	company_id='".$id."',
    	PID=0,
    	company_parent=0,
    	ceiling_startup_subtraction=0,
    	plan=0,
    	start_date=".mktime(0,0,0,date("Y"),1,1).",
    	end_date=".mktime(23,59,59,date("Y"),12,31).",
    	timestamp='".time()."',
    	cancel_flag=0";
    $this->result = $db->Execute($this->sql);
    return $this->GetInsuranceIDByCompanyID($id);

	}

  //------------------------------------------------------------------------------
  	function CreateInsuranceContract($company_id, $plan, $start, $end){

    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $company_parent = $this->GetInsuranceIDByCompanyID($company_id);
    if (empty($plan))
    	$plan=-1;
    $this->sql="INSERT INTO care_tz_insurance SET
    	parent=-1,
    	company_id='".$company_id."',
    	PID='".$pid."',
    	company_parent='".$company_parent."',
    	ceiling_startup_subtraction=0,
    	plan=".$plan.",
    	start_date=".$start.",
    	end_date=".$end.",
    	timestamp='".time()."',
    	cancel_flag=0";
    $this->result = $db->Execute($this->sql);

    $newId= $this->GetInsuranceIDByCompanyID($id);
    $this->RenewContractMembers($newId, $company_parent, $company_id);
    return $newId;

	}

  //------------------------------------------------------------------------------
  	function RenewContractMembers($new_id, $old_id, $company_id){

    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="INSERT INTO care_tz_insurance (parent, company_id, PID, company_parent, ceiling_startup_substraction,
    plan, start_date, end_date, timestamp, cancel_flag, paid_flag)
    SELECT ".$new_id.", company_id, PID, 0, 0, plan, 0, 0, ".time().", 0, 0 WHERE cancel_flag=0 AND parent = ".$old_id;
    $this->result = $db->Execute($this->sql);
    return true;

	}


  //------------------------------------------------------------------------------
	function GetInsuranceContractsAsArray($id,$timestamp,$guilty=0){
		/*
		Definitions:
		$guilty < 0 : Show all expired contracts
		$guilty = 0 : Show actual contract
		$guilty > 0 : Show future contracs
		*/

    global $db;
    if(!$id || !is_numeric($id)) return false;

    if(!$timestamp) $timestamp=time();
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if($guilty<0)
    {
    	$where = ' AND end_date < '.$timestamp;
  	}
  	elseif($guilty==0)
  	{
  		$where = ' AND start_date < '.$timestamp.' AND end_date > '.$timestamp;
  	}
  	else
  	{
  		$where = ' AND start_date > '.$timestamp;
  	}
    $this->sql="SELECT * FROM care_tz_insurance WHERE company_id=".$id; //.$where;

    $this->result = $db->Execute($this->sql);
    $counter=0;
    while($this->row = $this->result->FetchRow())
    {
    	if($this->row['PID']>0)
    	{
    		$return[$this->row['PID']]=$this->row;
    	}
  	}
  	return $return;
	}

  //------------------------------------------------------------------------------

  function GetMembersOfContractID($id){
    global $db;
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "calling GetMembersOfContractID($id)<br>";

    if(!$id || !is_numeric($id)) {
    	if ($this->debug) echo "NO PID OR PID IS NOT NUMMERIC<br>";
    	return false;
    }


    $this->sql="SELECT * FROM care_tz_insurance WHERE PID>0 and parent=$id";
	if ($this->debug) echo $this->sql;
    $this->result = $db->Execute($this->sql);
    while($this->row = $this->result->FetchRow())
    {
   		$return[$this->row['PID']]=$this->row;
  	}
  	return $return;
	}

  //------------------------------------------------------------------------------



	function InsertNewInsuranceCompany($dataarray){
    global $db;
    if(!$dataarray) return false;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if($dataarray['invoice_flag']) $invoice=1; else $invoice=0;
    if($dataarray['credit_preselection_flag']) $credit=1; else $credit=0;
    $this->sql="INSERT INTO care_tz_company SET
    	name='".$dataarray['name']."',
    	contact='".$dataarray['contact']."',
    	email='".$dataarray['email']."',
	phone_code='".$dataarray['phone_code']."',
	phone_nr='".$dataarray['phone_nr']."',
    	po_box='".$dataarray['po_box']."',
    	city='".$dataarray['city']."',
    	invoice_flag='".$invoice."',
    	credit_preselection_flag='".$credit."'";
    $this->result = $db->Execute($this->sql);
  	return $db->Insert_ID();;
	}

  //------------------------------------------------------------------------------

	function UpdateInsuranceCompany($dataarray){
    global $db;
	$debug=FALSE;
    if(!$dataarray) return false;
     ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if($dataarray['invoice_flag']) $invoice=1; else $invoice=0;
    if($dataarray['credit_preselection_flag']) $credit=1; else $credit=0;
    if($dataarray['hide_company_flag']) $hide=1; else $hide=0;
    $this->sql="UPDATE care_tz_company SET
    	name='".$dataarray['name']."',
    	contact='".$dataarray['contact']."',
    	email='".$dataarray['email']."',
	phone_code='".$dataarray['phone_code']."',
	phone_nr='".$dataarray['phone_nr']."',
    	po_box='".$dataarray['po_box']."',
    	city='".$dataarray['city']."',
    	invoice_flag='".$invoice."',
    	credit_preselection_flag='".$credit."',
    	hide_company_flag='".$hide."',
        prepaid_amount='".$dataarray['prepaid_amount']."'
    	WHERE id=".$dataarray['id'];
    $this->result = $db->Execute($this->sql);
    $this->sql="UPDATE care_tz_insurance SET
      plan='".$dataarray['insurance']."'
      WHERE company_id=".$dataarray['id'];
    $this->result = $db->Execute($this->sql);
  	return true;
	}

    //------------------------------------------------------------------------------

	function UpdateInsuranceType($dataarray){
    global $db;
    if(!$dataarray) return false;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if(!$dataarray['is_disabled']) $dataarray['is_disabled'] = 0;
    $this->sql="UPDATE care_tz_insurance_types SET
    	name='".$dataarray['name']."',
    	ceiling='".$dataarray['ceiling']."',
    	is_disabled='".$dataarray['is_disabled']."'
    	WHERE id=".$dataarray['id'];
    $this->result = $db->Execute($this->sql);
  	return true;
	}

    //------------------------------------------------------------------------------

  	function InsertInsuranceType($dataarray){
    global $db;
    if(!$dataarray) return false;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if(!$dataarray['is_disabled']) $dataarray['is_disabled'] = 0;
    $this->sql="INSERT INTO care_tz_insurance_types SET
    	name='".$dataarray['name']."',
    	ceiling='".$dataarray['ceiling']."',
    	is_disabled='".$dataarray['is_disabled']."'";
    $this->result = $db->Execute($this->sql);
  	return true;
	}

    //------------------------------------------------------------------------------

  	function ConcludeContractForPID($pid, $parent, $company_id, $startup_subtraction, $plan, $companycredit){
    global $db;

    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;

	// Check up if this person is somehow in that database...
	$this->sql = "SELECT * FROM care_tz_insurance WHERE PID=$pid AND parent=$parent";
	$this->result = $db->Execute($this->sql);

	if($companycredit) $companycredit=1; else $companycredit=0;

	if ($this->result->RecordCount()>0) {
		if ($debug) $this->GetCompanyFromPID($pid);

	    $this->sql="UPDATE care_tz_insurance SET
	    	parent='".$parent."',
	    	company_id='".$company_id."',
	    	company_parent=0,
	    	ceiling_startup_subtraction='".$startup_subtraction."',
	    	gets_company_credit='".$companycredit."',
	    	plan='".$plan."',
	    	start_date='".date()."',
	    	end_date='".(date()+Y(1))."',
	    	timestamp='".time()."',
	    	cancel_flag=0 WHERE PID='".$pid."' AND parent='".$parent."'";
	} else {

	    $this->sql="INSERT INTO care_tz_insurance SET
	    	parent='".$parent."',
	    	company_id='".$company_id."',
	    	company_parent=0,
	    	PID='".$pid."',
	    	ceiling_startup_subtraction='".$startup_subtraction."',
	    	gets_company_credit='".$companycredit."',
	    	plan='".$plan."',
	    	start_date='".date()."',
	    	end_date='".(date()+Y(1))."',
	    	timestamp='".time()."',
	    	cancel_flag=0";
	}
    $this->result = $db->Execute($this->sql);
  	return true;
	}

    //------------------------------------------------------------------------------


	function UpdateContractsArray($dataarray){
    global $db;
    if(!$dataarray) return false;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $temparray = $dataarray;
    //if($debug) var_dump($dataarray);
    while(list($x,$v) = each($dataarray))
    {
    	//if($debug) echo '<br>('.$x.') ';
    	if(strstr($x,"this_"))
    	{
    		$currentpid = substr(strstr($x,"this_"),5);
    		if($temparray['this_'.$currentpid]=="conclude" && $temparray['action_'.$currentpid]=="conclude")
    		{ if ($debug) echo "conclude";
    			$parent = $this->GetInsuranceIDByCompanyID($temparray['insurance']);
    			$this->ConcludeContractForPID($currentpid, $parent['id'], $temparray['insurance'], $temparray['startup_'.$currentpid], $temparray['plan_'.$currentpid], $temparray['credit_preselection_flag_'.$currentpid]);
    		}
    		elseif($temparray['this_'.$currentpid]=="cancel" && $temparray['action_'.$currentpid]=="cancel")
    		{ if ($debug) echo "cancel";
    			if($this->CancelContractForPID($temparray['contract_'.$currentpid]))
    				$status['cancel']++;
    			$this->SetContractPlanForPID($temparray['contract_'.$currentpid],$temparray['plan_'.$currentpid]);
    			if($temparray['startup_'.$currentpid] && is_numeric($temparray['startup_'.$currentpid]))
    				$this->SetContractStartupsubstractionForPID($temparray['contract_'.$currentpid],$temparray['startup_'.$currentpid]);
    		}
    		elseif($temparray['this_'.$currentpid]=="cancel" && !$temparray['action_'.$currentpid])
    		{ if ($debug) echo "weiss net";
    			if($this->EnableContractForPID($temparray['contract_'.$currentpid]))
    				$status['enable']++;
    			//$this->SetContractPlanForPID($temparray['contract_'.$currentpid],$temparray['plan_'.$currentpid]);
    			if($temparray['startup_'.$currentpid] && is_numeric($temparray['startup_'.$currentpid]))
    				$this->SetContractStartupsubstractionForPID($temparray['contract_'.$currentpid],$temparray['startup_'.$currentpid]);
    		}
    	}
    	//if($debug) echo $currentpid.' - ';
  	}
  	if($debug) echo $status['cancel'].' ---- '.$status['enable'];
  	return true;
	}

  //------------------------------------------------------------------------------


	function CancelContractForPID($id){
    global $db;
    if(!$id) return false;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="UPDATE care_tz_insurance SET
    	cancel_flag=1
    	WHERE id=".$id;
    $this->result = $db->Execute($this->sql);
  	return true;
	}


  //------------------------------------------------------------------------------

	function EnableContractForPID($id){
    global $db;
    if(!$id) return TRUE;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="UPDATE care_tz_insurance SET
    	cancel_flag=0
    	WHERE id=".$id;
    $this->result = $db->Execute($this->sql);
  	return true;
	}


  //------------------------------------------------------------------------------

	function EnablePaymentForContract($id){
    global $db;
    if(!$id) return false;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="UPDATE care_tz_insurance SET
    	paid_flag=1
    	WHERE id=".$id;
    $this->result = $db->Execute($this->sql);
  	return true;
	}


  //------------------------------------------------------------------------------

	function CancelPaymentForContract($id){
    global $db;
    if(!$id) return false;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="UPDATE care_tz_insurance SET
    	paid_flag=0
    	WHERE id=".$id;
    $this->result = $db->Execute($this->sql);
  	return true;
	}


  //------------------------------------------------------------------------------


  function SetContractPlanForPID($id,$value){
    global $db;
    if(!$id) return false;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="UPDATE care_tz_insurance SET
    	plan=".$value."
    	WHERE id=".$id;
    $this->result = $db->Execute($this->sql);
  	return true;
	}


  //------------------------------------------------------------------------------

  function SetContractStartupsubstractionForPID($id,$value){
    global $db;
    if(!$id) return false;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="UPDATE care_tz_insurance SET
    	ceiling_startup_subtraction=".$value."
    	WHERE id=".$id;
    $this->result = $db->Execute($this->sql);
  	return true;
	}


  //------------------------------------------------------------------------------

  function ShowListOfContractedMembers($company_id) {
  	global $db;
  	global $person_obj;
    $this->debug=FALSE;
    ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;

	if (!$company_id) return FALSE;

	$this->sql="SELECT PID FROM care_tz_insurance WHERE PID>0 and cancel_flag=0 and company_id=$company_id";
    if ($this->result = $db->Execute($this->sql)) {
    	if ($this->debug) echo "We have hits!";

	    while($this->row = $this->result->FetchRow()) {
	   		if ($this->debug) echo $this->row['PID']." ";
	   		$result=$person_obj->getAllInfoObject($this->row['PID']);
	    	if($person = $result->FetchRow()) {
	      	 echo "<option value=\"".$this->row['PID']."\">".$person['selian_pid']." - ".$person['name_last'].", ".$person['name_first']." (".$person['date_birth'].")</option>\n";
	    	}
	  	}
    } // end of while
  	return FALSE;
  }

//------------------------------------------------------------------------------

  function ShowInsuranceList($mode,$SHOWALL) {
  global $LDID,$LDCompanyName,$LDStartDate,$LDEndDate,$LDStatus,$LDOptions;
    /**
    * Returns TRUE if this item number still exists in the database
    */
	$bg="";
	$ADDITIONALLY_INFO="";
	$SHOWIT=FALSE;
    $this->insurance_array = $this->GetAllInsurancesAsArray(FALSE, FALSE);
    //[hide_company_flag]
    echo '<table border="0" cellpadding="2" cellspacing="0">
    <tr bgcolor=#ffff66>
    	<td align="center" width="30">'.$LDID.'</td>
    	<td align="center" width="240">'.$LDCompanyName.'</td>
	<td align="center" width="100">'.$LDStartDate.'</td>
        <td align="center" width="100">'.$LDEndDate.'</td>
        <td align="center" width="80">'.$LDStatus.'</td>

			<td colspan="2" align="center" width="50">'.$LDOptions.'</td>
    </tr>';

    while(list($x,$v) = each($this->insurance_array)) {
      // Do we have to show also the hidden companies?

      if ($SHOWALL==1) {
		$SHOWIT = TRUE;
      } else if ( ($SHOWALL==0 && $v['hide_company_flag']==1) ) {
    	$SHOWIT = FALSE;
      } else {
		$SHOWIT = TRUE;
      }
      //echo $v['name'].":Show all is set to: $SHOWALL and hide_company_flag is set to ".$v['hide_company_flag']."-> SHOWIT is set to $SHOWIT<br>";
      if ( $SHOWIT )	{

      	  if ($v['hide_company_flag']) {
      	  	$ADDITIONALLY_INFO="<i>hidden</i>";
      	  } else {
      	  	$ADDITIONALLY_INFO="";
      	  }

		$status = '';
                $start_date = date("d.m.Y" ,$v['start_date']);
                $end_date = date("d.m.Y",$v['end_date']);

                if ($v['cancel_flag'] == 1) {
                        $status = 'Cancelled';
                  } else {
                        if($v['end_date'] > time())
                        $status = 'Active';
                        else
                        $status = 'Inactive';

                }

	 	  if($bg=="#ffffaa")
				$bg="#ffffdd";
		  else
				$bg="#ffffaa";

		 

		  echo '
		  <tr bgcolor='.$bg.'>
		  	<td>'.$v['id'].'</td>
		  	<td>'.$v['name'].'</td>
			<td align="center">'.$start_date.'</td>
                        <td align="center">'.$end_date.'</td>
                        <td align="center">'.$status.'</td>';

				if($mode=='report')
					echo '
			      <td><div align="center"><a href="insurance_reports_company_contracts.php?id='.$v['id'].'"><img src="../../gui/img/common/default/documents.gif" alt="Show contracts" width="16" height="16" border="0"></a></td></tr>
			      </tr>';
				else
					echo '
			      <td><div align="center"><a href="insurance_company_tz_contracts.php?id='.$v['id'].'"><img src="../../gui/img/common/default/documents.gif" alt="Show contracts" width="16" height="16" border="0"></a>'.$ADDITIONALLY_INFO.'</td>
			      </tr>';
      } // end of if
  	} // end of while
  	echo '</table>';
    return true;
  }

    //------------------------------------------------------------------------------

  function ShowMemberBillsOfContract($contract_id, $show_company_info) {

  	global $root_path, $person_obj;
  	global $LDContractID,$LDPlan,$LDTimeframe,$LDCompanyName,$LDCity,$LDContractPerson,$LDInsurancetype,
  	       $LDPOBOX,$LDPOBOX,$LDPaybyInvoice,$LDYes,$LDNo,$LDPID,$LDplan,$LDCeiling,$LDPrepaidAmount,$LDName,
  	       $LDTSH,$LDTotalSum;

    /**
    * Returns TRUE if this item number still exists in the database
    */
    $this->contractmembers = $this->GetMembersOfContractID($contract_id);
    $this->contract = $this->GetContractsByIDAsArray($contract_id);
    $this->company = $this->GetInsuranceAsArray($this->GetCompanyIDFromContract($contract_id));

    if($show_company_info) {
	    echo '
		<table border="0" cellpadding="2" cellspacing="1">
		<tr bgcolor="#FFBD72">
	      	<td width="120">'.$LDContractID.' '.$this->contract['id'].'</td>
	      	<td width="190">'.$LDPlan.' '.$this->contract['name'].'</td>
	      	<td width="118">'.$LDTimeframe.'</td>
	      	<td width="90" align="center">'.date("d.m.y", $this->contract['start_date']).'</td>
	      	<td width="10">-</td>
	      	<td width="80" align="center">'.date("d.m.y", $this->contract['end_date']).'</td>
		</tr>
		</table>
		<table border="0" cellpadding="2" cellspacing="1">
			<tr bgcolor=ffffaa>
				<td width="120">'.$LDCompanyName.'</td>
				<td width="190">'.$this->company['name'].'</td>
				<td width="118">'.$LDCity.'</td>
				<td width="190">'.$this->company['city'].'</td>
			</tr>
			<tr bgcolor=ffffee>
				<td>'.$LDContractPerson.':</td>
				<td>'.$this->company['contact'].'</td>
				<td>'.$LDInsurancetype.'</td>
				<td>'.$this->company['insurance'].'</td>
			</tr>
			<tr bgcolor=ffffaa>
				<td>'.$LDPOBOX.'</td>
				<td>'.$this->company['po_box'].'</td>
				<td>'.$LDPaybyInvoice.'</td>
				<td>';
				if($this->company['invoice_flag']) echo $LDYes; else echo $LDNo;
				if($this->company['credit_preselection_flag']) echo $LDYes; else echo $LDNo;
			echo '</td>
			</tr>
		</table><p>
		<b>Member list:</b>';
    }
	echo '
    <table border="0" cellpadding="2" cellspacing="1">
    <tr bgcolor=#ffff66>
    	<td align="center" width="30">'.$LDPID.'</td>
    	<td align="center" width="200">'.$LDName.'</td>
		<td align="center" width="100">'.$LDplan.'</td>
		<td align="center" width="100">'.$LDCeiling.'</td>
		<td align="center" width="150">'.$LDPrepaidAmount.'</td>';
	if(!$this->company['invoice_flag'])
		echo '<td align="center" width="150">'.$LDBalance.'</td>';
	echo '
    </tr>

    ';
    $total=0;
    $overdrawnsum=0;
    while(list($x,$v) = each($this->contractmembers))
    {
    	$result = $person_obj->getAllInfoObject($v['PID']);
	    $person = $result->FetchRow();
		if (!$this->is_company_just_invoiced($this->company['id']))
	    	$plan = $this->GetInsuranceTypeAsArray($v['plan']);
    	if($bg=="#ffffaa")
    		$bg="#ffffdd";
    	else
    		$bg="#ffffaa";
      echo '
      <tr bgcolor='.$bg.'>
      	<td>'.$v['PID'].'</td>
      	<td>'.$person['name_last'].', '.$person['name_first'].'</td>
      	<td align="center">'.$plan['name'].'</td>
      	<td align="right">'.$plan['ceiling'].' '.$LDTSH.'</td>
      	<td align="right"><b>';
      	if($this->company['invoice_flag'])
      	{
      		$account = $this->CalculateSummaryForInsuranceId($v['id']);
      		echo $account.' '.$LDTSH.'</b></td>';
      	}
      	else
      	{
      		$overdrawn = $plan['ceiling']-$v['ceiling_startup_substraction']-$this->CalculateSummaryForInsuranceId($v['id']);
      		$balancearray[$v['id']] = $overdrawn;
      		$account = $plan['prepaid_amount'];
      		if($overdrawn<0)
      		{
      			$overdrawnsum += $overdrawn;
      			$overdrawn = '<font color="red"><b>'.$overdrawn.' '.$LDTSH.'</b></font>';
      		}
      		else $overdrawn = '('.$overdrawn.' '.$LDTSH.')';
      		echo $account.' '.$LDTSH.'</b></td><td align="right">'.$overdrawn.'</td>';
      	}
      	echo '
      </tr>';
      $total += $account;
  	}
	echo '
	<tr bgcolor="#000000" height="3">
		<td colspan="5"></td>';
	if(!$this->company['invoice_flag'])
		echo '<td></td>';
	echo '
	</tr>
	<tr bgcolor="#ffff66">
		<td colspan="4" align="right"><b>'.$LDTotalSum.'</b></td>
		<td align="right"><b>'.$total.' '.$LDTSH.'</b></td>';
	if(!$this->company['invoice_flag'])
		echo '<td align="right">'.$overdrawnsum.' '.$LDTSH.'</td>';
	echo '
	</tr>';
  	echo '</table>
  	</form>';
    return $balancearray;
  }


  //------------------------------------------------------------------------------

    function CalculateSummaryForInsuranceId($insurance_id) {
    global $db;

    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $sum=0;
	$this->sql="SELECT balanced_insurance FROM care_tz_billing_archive_elem WHERE insurance_id=".$insurance_id;
    $this->result = $db->Execute($this->sql);
    while($this->row = $this->result->FetchRow())
    {
    	$sum += $this->row['balanced_insurance'];
  	}
  	return $sum;
  }

  //------------------------------------------------------------------------------

  function ShowContractsOfCompany($company_id) {

  	global $root_path;
  	global $LDNoContractsFound,$LDID,$LDplan,$LDStartDate,$LDEndDate,$LDCancelled,$LDAlreadyPaid,$LDShowContract,$LDShowBill, $LDPaybyInvoice,
  	       $LDYes,$LDNo;
    /**
    * Returns TRUE if this item number still exists in the database
    */
    $this->contract_array = $this->GetContractsForCompanyAsArray($company_id);
  		echo '<script language="javascript" >
            <!--
            function printOut(id)
            {
            	urlholder="show_contract.php?id=" + id;
            	testprintout=window.open(urlholder,"printout","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");

            }
            function Bill(id)
            {
            	urlholder="insurance_company_tz_contracts_bill.php?id=" + id;
            	testprintout=window.open(urlholder,"printout","width=630,height=600,menubar=no,resizable=yes,scrollbars=yes");

            }
            // -->
            </script>
            ';
    echo '



    <input type="hidden" name="mode" value="updateflags">
    <table border="2" cellpadding="2" cellspacing="1" width="788">
    <tr bgcolor=#ffff66>
    	<td align="center" width="30">'.$LDID.'</td>
    	<td align="center" width="240">'.$LDplan.'</td>
    	<td align="center" width="80">'.$LDStartDate.'</td>
    	<td align="center" width="70">'.$LDEndDate.'</td>
	<td align="center" width="70">'.$LDCancelled.'</td>
	<td align="center" width="100">'.$LDAlreadyPaid.'</td>
	<td align="center" width="70">'.$LDShowContract.'</td>
	<td align="center" width="70">'.$LDShowBill.'</td>
    </tr>
    ';
    if(is_array($this->contract_array))
	    while(list($x,$v) = each($this->contract_array))
	    {
	    	if($bg=="#ffffaa")
	    		$bg="#ffffdd";
	    	else
	    		$bg="#ffffaa";
	    	if($v['start_date']< time() && $v['end_date'] > time()) $bg='#FFBD72';
	    	if($v['cancel_flag']) $bg='#DBDBDB';
	    	if($v['cancel_flag'])
	    	{
	    		$cancel_flag_yes = 'checked';
	    		$cancel_flag_no = false;
	    	}
	    	else
	    	{
	    		$cancel_flag_yes= false;
	    		$cancel_flag_no = 'checked';
	    	}
	    	if($v['paid_flag'])
	    	{
	    		$paid_flag_yes = 'checked';
	    		$paid_flag_no = false;
	    	}
	    	else
	    	{
	    		$paid_flag_yes= false;
	    		$paid_flag_no = 'checked';
	    	}

	      //$plan = (!$this->is_company_just_invoiced($v['id'])) ? $v['name'] : $LDPaybyInvoice;
	      $plan = $this->getPlanOfContractAsString($v['id']);
	      echo '
	      <tr bgcolor='.$bg.'>
	      	<td>'.$v['id'].'</td>
	      	<td>'.$plan.'</td>
	      	<td align="center">'.date("d.m.y", $v['start_date']).'</td>
	      	<td align="center">'.date("d.m.y", $v['end_date']).'</td>
	      <td><div align="center">'.$LDYes.'<input type="radio" '.$cancel_flag_yes.' name="cancel_'.$v['id'].'" value="yes"><input type="radio" '.$cancel_flag_no.' name="cancel_'.$v['id'].'" value="no"> '.$LDNo.'</td>
	      <td><div align="center">'.$LDYes.'<input type="radio" '.$paid_flag_yes.' name="paid_'.$v['id'].'" value="yes"><input type="radio" '.$paid_flag_no.' name="paid_'.$v['id'].'" value="no"> '.$LDNo.'</td>
	      <td><div align="center"><a href="javascript:printOut('.$v['id'].')"><img src="../../gui/img/common/default/documents.gif" alt="Show contracts" width="16" height="16" border="0"></a></td>
		  <td><div align="center"><a href="javascript:Bill('.$v['id'].')"><img src="../../gui/img/common/default/play_one.gif" alt="Show Bill" border="0"></a></td>

	      </tr>';
	  	}
	else
		echo '
	      <tr bgcolor=#ffffaa>
	      	<td colspan="9" align="center">'.$LDNoContractsFound.'</td>

	      </tr>';
  	echo '</table>
  	';
    return true;
  }

  //------------------------------------------------------------------------------

  function ReportContractsOfCompany($company_id) {

  	global $root_path;
  	global $LDNoContractsFound,$LDID,$LDplan,$LDStartDate,$LDEndDate,$LDAlreadyPaid,$LDYes,$LDNo;
    /**
    * Returns TRUE if this item number still exists in the database
    */
    $this->contract_array = $this->GetContractsForCompanyAsArray($company_id);
    echo ' <input type="hidden" name="mode" value="updateflags">
    <table border="0" cellpadding="2" cellspacing="1" width="678">
    <tr bgcolor=#ffff66>
    	<td align="center" width="40">'.$LDID.'</td>
    	<td align="center" width="240">'.$LDplan.'</td>
    	<td align="center" width="80" colspan="2">'.$LDStartDate.'</td>
    	<td align="center" width="70">'.$LDEndDate.'</td>
			<td align="center" width="80">'.$LDEndDate.'</td>
			<td align="center" width="110">'.$LDAlreadyPaid.'</td>

    </tr>
    ';
    if(is_array($this->contract_array)) {
	    while(list($x,$v) = each($this->contract_array)) {

	    	// switch background color
	    	($bg=="#ffffaa") ? $bg="#ffffdd" : $bg="#ffffaa";

	    	if($v['start_date']< time() && $v['end_date'] > time()) $bg='#FFBD72';
	    	if($v['cancel_flag']) $bg='#DBDBDB';

	    	if($v['cancel_flag']) {
	    		$cancel_flag_yes = $LDYes;
	    		$cancel_flag_no = false;
	    	} else {
	    		$cancel_flag_yes= false;
	    		$cancel_flag_no = $LDNo;
	    	}

	    	if($v['paid_flag']) {
	    		$paid_flag_yes = $LDYes;
	    		$paid_flag_no = false;
	    	} else {
	    		$paid_flag_yes= false;
	    		$paid_flag_no = $LDNo;
	    	}

  	        echo '
		      	<tr bgcolor='.$bg.'>
		      		<td>'.$v['id'].'</td>
		      		<td>'.$v['name'].'</td>
		      		<td align="center">'.date("d.m.y", $v['start_date']).'</td>
		      		<td>-</td>
		      		<td align="center">'.date("d.m.y", $v['end_date']).'</td>
		      		<td><div align="center">'.$cancel_flag_yes.$cancel_flag_no.'</td>
		      		<td><div align="center">'.$paid_flag_yes.$paid_flag_no.'</td>
		        </tr>
			    <tr>
					<td>&nbsp;</td><td colspan="6">';
						$this->ShowMemberBillsOfContract($v['id'], false);
				echo '</td>
				</tr>';
	    } // end of while(list($x,$v) = each($this->contract_array))
	} else {
		echo '
	      <tr bgcolor=#ffffaa>
	      	<td colspan="9" align="center">'.$LDNoContractsFound.'(</td>

	      </tr>';
	} // End of if(is_array($this->contract_array))
  	echo '</table>
  	';
    return true;
  }

  //------------------------------------------------------------------------------

function CheckCurrentContractValidity($company_id) {
    /**
    * Returns TRUE if this item number still exists in the database
    */
	global $db;
    	$db->debug=FALSE;


    if(!$company_id) return false;

	 $this->sql="SELECT max(id) from care_tz_insurance WHERE company_id = $company_id AND cancel_flag=0 AND  end_date >= UNIX_TIMESTAMP()";

	if ($debug) echo $this->sql;
	    $this->result = $db->Execute($this->sql);

	if ($this->result)
	{
		if($this->result->RecordCount() > 0)
		return true;
		else
		return false;
	}
	else { 
		return false;

	}
  }


//------------------------------------------------------------------------------

  function CheckContractValidity($company_id, $start_date, $end_date) {
    /**
    * Returns TRUE if this item number still exists in the database
    */

    if(!$company_id || !$start_date || !$end_date || $start_date >= $end_date) return false;
    $this->contract_array = $this->GetContractsForCompanyAsArray($company_id);
    while(list($x,$v) = each($this->contract_array))
    {
    	if(($v['end_date']>$start_date || $v['start_date']>$start_date) && $v['cancel_flag']!=1) return false;
  	}
    return true;
  }

  //------------------------------------------------------------------------------

  function NewContractForm($company_id) {
  	global $root_path, $db, $start, $end;
  	global $LDContractStartEnd,$LDPreselectedContractPlan;
    /**
    * Returns TRUE if this item number still exists in the database
    */

    include_once($root_path.'include/inc_date_format_functions.php');
    echo '<script language="JavaScript">';
    require($root_path.'include/inc_checkdate_lang.php');
    echo '</script>';
    echo '<script language="javascript" src="'.$root_path.'js/setdatetime.js"></script>';
    echo '<script language="javascript" src="'.$root_path.'js/checkdate.js"></script>';
    echo '<script language="javascript" src="'.$root_path.'js/dtpick_care2x.js"></script>';
    echo '<table border="0" cellpadding="1" cellspacing="1" width="" align="center">
      	<tr bgcolor="ffffdd"><td>'.$LDContractStartEnd.':<br><input type="text" size="15" maxlength=10 value="';
      	$datename=	'start';
    	$formname= 'insurance';
				if($start){
					echo $start;
				}
				else{
					echo formatDate2Local(date('Y').'-01-01',$date_format);
				}
		  		echo '"
		 				onFocus="this.select();"
						onBlur="IsValidDate(this,\''.$date_format.'\')"
						onKeyUp="setDate(this,\''.$date_format.'\',\''.$lang.'\');" name="'.$datename.'">
						<a href="javascript:show_calendar(\''.$formname.'.'.$datename.'\',\''.$date_format.'\')">
						<img '.createComIcon($root_path,'show-calendar.gif','0','absmiddle').'></a> - <input type="text" size="15" maxlength=10 value="';
      $datename=	'end';
      $formname= 'insurance';
				if($end){
					echo $end;
				}
				else{
					echo formatDate2Local(date('Y').'-12-31',$date_format);
				}

			if ($this->is_company_just_invoiced($company_id)) {
			  	echo '
			 				onFocus="this.select();"
							onBlur="IsValidDate(this,\''.$date_format.'\')"
							onKeyUp="setDate(this,\''.$date_format.'\',\''.$lang.'\');" name="'.$datename.'">
							<a href="javascript:show_calendar(\''.$formname.'.'.$datename.'\',\''.$date_format.'\')">
							<img '.createComIcon($root_path,'show-calendar.gif','0','absmiddle').'></a></td><td>&nbsp;</td></tr>
					</table>';

			} else {
			  	echo '
			 				onFocus="this.select();"
							onBlur="IsValidDate(this,\''.$date_format.'\')"
							onKeyUp="setDate(this,\''.$date_format.'\',\''.$lang.'\');" name="'.$datename.'">
							<a href="javascript:show_calendar(\''.$formname.'.'.$datename.'\',\''.$date_format.'\')">
							<img '.createComIcon($root_path,'show-calendar.gif','0','absmiddle').'></a></td><td>'.$LDPreselectedContractPlan.':<br>'; $this->ShowInsuranceTypesDropDown('plan',$v['Contract']['plan']); echo '</td></tr>
					</table>';
			}
  }

  //------------------------------------------------------------------------------


  function ShowInsuranceTypesList() {
    global $LDID,$LDInsurancetype,$LDCeiling,$LDPrepaidamount,$LDOptions;
    /**
    * Returns TRUE if this item number still exists in the database
    */

    $this->insurance_array = $this->GetInsuranceTypesAsArray();
    echo '<table border="0" cellpadding="2" cellspacing="0">
    <tr bgcolor=#ffff66>
    	<td align="center" width="30">'.$LDID.'</td>
    	<td align="center" width="240">'.$LDInsurancetype.'</td>
    	<td align="center" width="70">'.$LDCeiling.'</td>
		<td colspan="2" align="center" width="50">'.$LDOptions.'</td>
    </tr>

    ';
    while(list($x,$v) = each($this->insurance_array))
    {
    	if($bg=="#ffffaa")
    		$bg="#ffffdd";
    	else
    		$bg="#ffffaa";
    	if($v['is_disabled']>0)
    		$disabled='<font color=red><b>(DISABLED)</b></font>';
    	else $disabled=false;
      echo '
      <tr bgcolor='.$bg.'>
      	<td>'.$v['id'].'</td>
      	<td>'.$v['name'].' '.$disabled.'</td>
      	<td align="center">'.$v['ceiling'].' TSH</td>
      <td><div align="center"><a href="insurance_types_tz_edit.php?id='.$v['id'].'"><img src="../../gui/img/common/default/hammer.gif" alt="Edit" width="16" height="16" border="0"></a></td>
      </tr>';
  	}
  	echo '</table>';
    return true;
  }



  //------------------------------------------------------------------------------
  function ShowInsuranceTypesDropDown($name,$selected,$FLAG) {
    /**
    * Print out (HTML) an drop down list of possible insurance plans (with selection by default given parameter from database)
    */
	$arr_name_informations = explode ("_", $name);
	$this->pid=$arr_name_informations[1];

    $this->insurancetype_array = $this->GetInsuranceTypesAsArray();
	// $this->insurancetype_array[0] is the given name parameter (temporary)
	// $this->insurancetype_array[1] is PID number
	//$this->Plan_ID=$this->insurancetype_array[1][0];
    echo '<select name="'.$name.'">';

    if ($FLAG=='WITH_EMPTY_FIRST_FIELD')
    	echo '<option value="-1"></option>';

	$this->Plan_id = $this->GetPlanForPID($this->pid);

    while(list($x,$v) = each($this->insurancetype_array))
    {
    	if($v['is_disabled']==0) {
	      	echo '<option ';
	      	if($v['id']==$this->Plan_id) echo ' selected ';
	      	echo ' value="'.$v['id'].'">'.$v['name'].' ('.$v['ceiling'].')</option>';
      	}
  	}
  	echo '</select>';
    return true;
  }

   //------------------------------------------------------------------------------

  function ShowInsuranceHeadline($company_id) {
    /**
    * Returns TRUE if this item number still exists in the database
    */

    global $thisfile;
    global $LDSelectInsuranceCompany;
    $this->insurance = $this->GetInsuranceAsArray($company_id);
    echo '<table border="0" cellpadding="1" cellspacing="1" bgcolor="FFFF33" width="">
    			<tr>
    				<td align="center">'.$LDSelectInsuranceCompany.' '.$this->insurance['name'].'
    				</td>
    			</tr>
    </table>';
    return true;
  }

  //------------------------------------------------------------------------------

  function ShowInsurancesDropDown($name,$selected) {
    /**
    * Returns TRUE if this item number still exists in the database
    */
    global $thisfile;
    global $LDPleaseSelectCompany;
    $this->insurance_array = $this->GetAllInsurancesAsArray(FALSE, TRUE);
    echo '<select name="'.$name.'">
    <option selected value="-1">'.$LDPleaseSelectCompany.' </option>';
    while(list($x,$v) = each($this->insurance_array))
    {
      	echo '<option ';
      	if($v['id']==$selected) echo 'selected ';
      	echo 'value="'.$v['id'].'">'.$v['id'].' - '.$v['name'].'</option>';
  	}
  	echo '</select>';
    return;
  }



  //------------------------------------------------------------------------------

  function ShowMemberForms($array) {
  	global $person_obj, $root_path, $company_id;
  	global $LDContractStartEnd,$LDAction,$LDPersonNoValidContract,$LDNoMembersCompany,$LDNoValidContract,
  		   $LDClickCreateContract,$LDPlanSubstraction,$LDGetsCredit,$LDDeactivatePersonContract,$LDCancelContract,
  		   $LDPlan,$LDTSH,$LDSubstraction,$LDStatus;

  	$selected_insurance = $company_id;
  	include_once($root_path.'include/inc_date_format_functions.php');
    /**
    * Returns TRUE if this item number still exists in the database
    */

    echo '<script language="JavaScript">';
		require($root_path.'include/inc_checkdate_lang.php');
    echo '</script>';

    echo '<table border="0" cellpadding="1" cellspacing="1" width="850">';
	$insurance_masterfile = $this->GetInsuranceAsArray($company_id);
    $allcontracts = $this->GetInsuranceContractsAsArray($selected_insurance,false,0);
	$contractarray = $this->GetActualContractForCompanyAsArray($company_id);
	if (!$contractarray) {
	  // if there is no valid contract for now, take the next one what you have in the database.
	  $contractarray = $this->GetContractForCompanyAsArray($company_id);

	}

	if(count($contractarray)>0) {
		if(is_array($array))
		    while(list($x,$v) = each($array))
		    {
		    		$result = $person_obj->getAllInfoObject($v['PID']);
		    		$person = $result->FetchRow();
		    		if($v['Contract']['gets_company_credit']) $credit='Yes'; else $credit='No';
		    		unset($allcontracts[$v['PID']]);

		    		if(!is_array($v['Contract']) and $v['Contract']!=-2)		//New Contract
		    		{
							echo '<tr bgcolor="ffffaa"><td>'.$person['name_last'].', '.$person['name_first'].' (Hospital file nr: '.$person['selian_pid'].')</td><td>'.$LDAction.'</td><td>'.$LDPlanSubstraction.'</td></tr>
							<tr bgcolor="ffffdd"><td>'.$LDContractStartEnd.'<br><input type="hidden" name="this_'.$v['PID'].'" value="conclude">'.date("m/d/Y",$contractarray['start_date']).' - '.date("m/d/Y",$contractarray['end_date']).'</td><td><input type="hidden" name="this_'.$v['PID'].'" value="conclude">
							<input type="checkbox" name="action_'.$v['PID'].'" align="absmiddle" checked value="conclude">Conclude contract</td>
							<td align="center">';
							if (!$this->is_company_just_invoiced($company_id))
								$this->ShowInsuranceTypesDropDown('plan_'.$v['PID'],$contractarray['plan']);

							if (!$this->is_company_just_invoiced($company_id)) {
								echo '<input type="text" value="'.$v['Contract']['ceiling_startup_subtraction'].'" name="startup_'.$v['PID'].'"><br><input type="checkbox" value="1" name="credit_preselection_flag_'.$v['PID'].'" ';
								if($insurance_masterfile['credit_preselection_flag']) echo 'checked'; echo '> '.$LDGetsCredit.'</td></tr>';
							} else {
								echo $LDGetsCredit.'</td></tr>';
							}
						}
				    	elseif($v['Contract']['is_valid'])  // Actual Contract
				    	{

							echo '<tr bgcolor="ffffaa"><td><img src="'.$root_path.'gui/img/common/default/lock.gif" height="15" align="absmiddle">'.$person['name_last'].', '.$person['name_first'].' (Hospital file nr: '.$person['selian_pid'].')</td><td>'.$LDAction.'</td><td>'.$LDPlanSubstraction.'</td></tr>';

							if($v['Contract']['company_id']!=$selected_insurance) // Is there another valid contract for this person?
				    		{
				    			$other_insurance = $this->GetInsuranceAsArray($v['Contract']['company_id']);
				    			echo '<tr>
				    			<td colspan="3"><table border="0" bgcolor="FFFF00" width="100%">
				    			<tr><td><img src="'.$root_path.'gui/img/common/default/level_7.gif" height="15" align="absmiddle"></td><td align="center">'.$LDPersonNoValidContract.'<br><b>'.$other_insurance['name'].'</b><br>'.$LDDeactivatePersonContract.'Please deactivate the persons contract there first!</td><td><img src="'.$root_path.'gui/img/common/default/level_7.gif" height="15" align="absmiddle"></td></tr></table></td></tr>';
				    		} else {// No its not, pid is member of this company

				    			if($v['Contract']['ceiling_startup_subtraction']) $startupsubstraction=$v['Contract']['ceiling_startup_subtraction'];
				    			else $startupsubstraction=0;
				    			$selectedplan = $this->GetInsuranceTypeAsArray($v['Contract']['plan']);
				    			echo '<tr bgcolor="ffffdd"><td>'.$LDContractStartEnd.'Contract (Start/End):<br>'.date('m/d/Y',$contractarray['start_date']).' - '.date('m/d/Y',$contractarray['end_date']).'
				    			</td>';
				    			echo '<td><input type="hidden" name="parent_'.$v['PID'].'" value="'.$v['Contract']['parent'].'"><input type="hidden" name="contract_'.$v['PID'].'" value="'.$v['Contract']['id'].'"><input type="hidden" name="this_'.$v['PID'].'" value="cancel"><input type="checkbox" name="action_'.$v['PID'].'" align="absmiddle" value="cancel"> '.$LDCancelContract.'</td>';
				    			if (!$this->is_company_just_invoiced($company_id) ) {
				    				echo '<td align="center">'.$LDPlan.' '.$selectedplan['name'].'<br> '.$LDSubstraction.' '.$startupsubstraction.' '.$LDTSH.'<br> '.$LDGetsCredit.' '.$credit.'</td></tr>';
				    			} else {
				    				echo '<td align="center">'.$LDGetsCredit.'</td></tr>';
				    			}

				    		}
				  		}
				  		elseif($v['Contract']==-2) { // contracted to another company!
							echo '<tr bgcolor="ffffaa"><td><i>'.$person['name_last'].', '.$person['name_first'].' (Hospital file nr: '.$person['selian_pid'].')</td><td>'.$LDAction.'</td><td>'.$LDPlanSubstraction.'<i></td></tr>
							<tr bgcolor="ffffdd"><td><font color="red"> this person is a member of another company</font></td><td>--</td>
							<td align="center">--</td></tr>';

				  		} else {
				  			echo 'No Data ...';
				  		}
				} else {
					echo '<tr bgcolor="ffffaa"><td colspan="3" align="center">'.$LDNoMembersCompany.'</a></td></tr>';
  				}
	} else {
		echo '<tr bgcolor="ffffaa"><td colspan="3" align="center">'.$LDNoValidContract.'<br><a href="insurance_company_tz_contracts_new.php?company_id='.$company_id.'">'.$LDClickCreateContract.'</a></td></tr>';
  	}

  	while(list($x,$v) = each($allcontracts))   	{
			$result = $person_obj->getAllInfoObject($v['PID']);
			if ($result)
				$person = $result->FetchRow(); // Just if there are results, there should be a FetchRow()...

			if ($this->is_contract_cancelled($v['PID']))
				$cancel_string="checked";
			else
				$cancel_string="";
			echo '<tr bgcolor="ffffaa"><td><img src="'.$root_path.'gui/img/common/default/lock.gif" height="15" align="absmiddle"><input type="hidden" name="this_'.$v['PID'].'" value="cancel">'.$person['name_last'].', '.$person['name_first'].' (Hospital file nr: '.$person['selian_pid'].')</td><td>'.$LDStatus.'</td><td>'.$LDPlanSubstraction.'</td></tr>';

    		echo '<tr bgcolor="ffffdd"><td>'.$LDContractStartEnd.'<br>'.date('m/d/Y',$contractarray['start_date']).' - '.date('m/d/Y',$contractarray['end_date']).'
    		</td><td><input type="hidden" name="contract_'.$v['PID'].'" value="'.$v['id'].'"><input type="checkbox" name="action_'.$v['PID'].'" '.$cancel_string.' value="cancel"> Cancel contract</td><td align="center">'; $this->ShowInsuranceTypesDropDown('plan_'.$v['PID'],$v['plan']); echo '</td></tr>';
  	}
  	  echo '</table>';
    return true;
  }


    //------------------------------------------------------------------------------

  function ShowAllInsurancesForQuotatuion()  {
  /*
   *  A list (selectionbox list) of all insurances what have an direct payment wihtout ceiling
   */

  	global $db;
	$this->debug=FALSE;
	($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($this->debug) echo "<br><b>Method class_tz_billing::ShowAllInsurancesForQuotatuion()</b><br>";
    $this->sql = "

SELECT DISTINCT (
company_id
) AS company_id, name
FROM care_tz_insurance
INNER JOIN care_tz_company ON care_tz_company.id = care_tz_insurance.company_id
WHERE parent = -1
AND (
(care_tz_insurance.start_date <= UNIX_TIMESTAMP( ))
AND (care_tz_insurance.end_date >= UNIX_TIMESTAMP()))
AND cancel_flag ='0'
ORDER BY `care_tz_insurance`.`company_id` ASC

";
	$this->request=$db->Execute($this->sql);
	$this->result_string= "<select id = \"insurance\" name =\"insurance\">";
	$this->result_string .="<option value=\"-2\" selected>-Select Company or None for Cash-</option>";
	$this->result_string .="<option value=\"-1\">-None(Cash)-</option>";
	while ($this->res=$this->request->FetchRow()) {
		$this->company_name =  $this->res['name'];
		$this->company_id= $this->res['company_id'];
		$this->result_string .="<option value=\"".$this->company_id." \">".$this->company_name."</option>";
	}
	$this->result_string .= "</select>";
    return $this->result_string;
  }



  //------------------------------------------------------------------------------

  function getPlanOfContractAsString($contract_id) {
  	global $db;
  	$debug=FALSE;
  	($debug) ? $db->debug=TRUE : $db->debug=FALSE;
  	$this->sql="select plan,name
  					from care_tz_insurance
				LEFT JOIN care_tz_insurance_types
					ON care_tz_insurance.plan=care_tz_insurance_types.id
				where care_tz_insurance.id=".$contract_id;
	$this->result = $db->Execute($this->sql);
    if($this->row = $this->result->FetchRow()) {
    	if ($this->row['plan']==-1) {
    		$this->return_value="by invoice";
    	} else {
    		$this->return_value=$this->row['name'];
    	}
    }
    return $this->return_value;
  }

  //------------------------------------------------------------------------------
  function GetPlanOfCompanyIDAsString($company_id) {
  	/*
  	 * Return the ID of the specific plan of this company.
  	 * Note: According to specification (Feb 06): -1 as return -> No Plan -> Poor People fund!
  	 *
  	 */
	global $db;
  	($debug) ? $db->debug=TRUE : $db->debug=FALSE;
  	$this->sql="SELECT
  					plan, name
				FROM care_tz_insurance
				LEFT JOIN care_tz_insurance_types
					ON care_tz_insurance.plan=care_tz_insurance_types.id
						where care_tz_insurance.company_id=".$company_id;
	$result = $db->Execute($this->sql);
    if($row = $result->FetchRow()) {
    	if ($row['plan']==-1) {
    		$return_value="by invoice";
    	} else {
    		$return_value=$this->row['name'];
    	}
    }
    return $return_value;

  }

  //------------------------------------------------------------------------------

  function is_company_just_invoiced($company_id) {
  	/*
  	 *  Gives TRUE back if this company-id is just invoiced. FALSE if not.
  	 * invoice-flag means that this company does not have any ceiling, all will be billed to the company
  	 */
  	global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="SELECT invoice_flag FROM care_tz_company WHERE id=".$company_id;
    $this->result = $db->Execute($this->sql);
    $sum=0;
    if($this->row and $this->row = $this->result->FetchRow()) {
    	if ($this->row[invoice_flag]==1) {
    		$this->return_value=TRUE;
    	} else {
    		$this->return_value=FALSE;
    	}
    }
    if ($debug) echo "return value of is_company_just_invoiced($company_id) is: $this->return_value";
  	return $this->return_value;
  }

  function is_poor_people_company($company_id) {
  	/*
  	 * RETURN TRUE if this is a company for poor people (plan==-1)
  	 */
  	 global $db;
  	 $sql="SELECT plan FROM care_tz_insurance WHERE company_id=$company_id";
  	 $result=$db->Execute($sql);
  	 if ($row=$result->FetchRow()) {
  	 	if ($row['plan']=="-1") {
  	 		return TRUE;
  	 	} else {
  	 		return FALSE;
  	 	}
  	 }
  	 return FALSE;
  }

  //------------------------------------------------------------------------------
  function is_patient_insured($pid) {
  	global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	$this->sql="SELECT insurance_1.company_id,  insurance_2.pid  FROM care_tz_insurance insurance_1
							INNER JOIN care_tz_company ON care_tz_company.id=insurance_1.company_id
									AND insurance_1.parent = -1
									AND ( insurance_1.start_date <= UNIX_TIMESTAMP() AND insurance_1.end_date >= UNIX_TIMESTAMP())
							INNER JOIN care_tz_insurance insurance_2 ON insurance_2.parent=insurance_1.id
									AND insurance_2.pid=$pid
									AND insurance_2.cancel_flag=0";
	$this->result = $db->Execute($this->sql);
	if ($this->result) {
		if($this->result->RecordCount()>0)
	  		return TRUE;
	  	else
	  		return FALSE;
    	}
	else
    	return FALSE;
	}

	//------------------------------------------------------------------------------

	function GetName_insurance_from_pid($pid) {
  	global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	$this->sql="SELECT care_tz_company.name FROM care_tz_insurance insurance_1
							INNER JOIN care_tz_company ON care_tz_company.id=insurance_1.company_id
									AND insurance_1.parent = -1
									AND ( insurance_1.start_date <= UNIX_TIMESTAMP() AND insurance_1.end_date >= UNIX_TIMESTAMP())
							INNER JOIN care_tz_insurance insurance_2 ON insurance_2.parent=insurance_1.id
									AND insurance_2.pid=$pid";
	$this->result = $db->Execute($this->sql);
	$return_value="";
	while ($this->row=$this->result->FetchRow()) {
		$return_value.=$this->row['name'];
	}
	return $return_value;
	}
	 //------------------------------------------------------------------------------

	function GetName_insurance_from_id($id) {
  	global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;

	
	$this->sql="SELECT name FROM care_tz_company where id=".$id;
	$this->result = $db->Execute($this->sql);
	$return_value="";
	while ($this->row=$this->result->FetchRow()) {
		$return_value.=$this->row['name'];
	}
	return $return_value;
	}
	 //------------------------------------------------------------------------------

	function is_contract_cancelled($pid) {
	  	global $db;
	    $debug=FALSE;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
		$this->sql="SELECT * from care_tz_insurance where PID=$pid and cancel_flag=1";
		$this->result = $db->Execute($this->sql);
		if($this->result->RecordCount()>0) {
				if ($debug) echo "is_contract_cancelled($pid): yes";
		  		return TRUE;
			} else {
				if ($debug) echo "is_contract_cancelled($pid): no";
		  		return FALSE;
			 }
		}
	 //------------------------------------------------------------------------------

	function allocatePrescriptionsToinsurance($bill_number, $prescriptions_nr, $insurance_payment,$insurance_id) {
	  	global $db;
	    $debug=FALSE;
	
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    $this->sql = "SELECT ID, amount, price FROM care_tz_billing_elem where nr=$bill_number AND prescriptions_nr=$prescriptions_nr AND is_medicine=1";
	    if ($this->result=$db->Execute($this->sql)) {
	    	while ($this->row=$this->result->FetchRow()) {
				$covered_price=$this->row['amount'] * $this->row['price'];
				$exact_id_of_bill_element=$this->row['ID'];
				$this->sql ="update care_tz_billing_elem SET balanced_insurance='$covered_price', insurance_id=$insurance_id WHERE ID=$exact_id_of_bill_element";
				$db->Execute($this->sql);
	    	}
	    }
		return true;
	}
	 //------------------------------------------------------------------------------
	function allocateLaboratoryItemsToinsurance($bill_number, $labtest_nr, $insurance_payment,$insurance_id) {

	  	global $db;
	    $debug=FALSE;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    $this->sql = "SELECT ID, amount, price FROM care_tz_billing_elem where nr=$bill_number AND is_labtest=1";
	    if ($this->result=$db->Execute($this->sql)) {
	    	while ($this->row=$this->result->FetchRow()) {
				$covered_price=$this->row['amount'] * $this->row['price'];
				$exact_id_of_bill_element=$this->row['ID'];
				$this->sql ="update care_tz_billing_elem SET balanced_insurance='$covered_price', insurance_id=$insurance_id WHERE ID=$exact_id_of_bill_element";
				$db->Execute($this->sql);
	    	}
	    }
		return true;
	}
	 //------------------------------------------------------------------------------
	function allocateRadiologyItemsToinsurance($bill_number,$radtest_nr, $insurance_payment,$insurance_id) {

	  	global $db;
	    $debug=FALSE;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;

	    $this->sql = "SELECT ID, amount, price FROM care_tz_billing_elem where nr=$bill_number AND is_radio_test=1";
	    if ($this->result=$db->Execute($this->sql)) {
	    	while ($this->row=$this->result->FetchRow()) {
				$covered_price=$this->row['amount'] * $this->row['price'];
				$exact_id_of_bill_element=$this->row['ID'];
				$this->sql ="update care_tz_billing_elem SET balanced_insurance='$covered_price', insurance_id=$insurance_id WHERE ID=$exact_id_of_bill_element";
				$db->Execute($this->sql);
	    	}
	    }
		return true;
	}

	//------------------------------------------------------------------------------
	//------------------------------------------------------------------------------
	//------------------------------------------------------------------------------

	function GetNumberOfMembers($company_id,$year=0) {
	/*
	 * Funciton to get the number of Members attached to one company. Retruns either 0 or the number...
	 */

	  	global $db;
		$return_value=0; // Standard return of this method...

	  	if (empty($year)) $year=date("Y"); // if no year is given, take the current year

		$start_timeframe=mktime(0,0,1,1,1,$year); //echo date("D M j G:i:s T Y",$start_timeframe)."<br>";
		$end_timeframe=mktime(0,0,0,12,31,$year);

		//$this->debug = FALSE;

		($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;

		$sql="SELECT count(*) as NumberOfMembers FROM care_tz_insurance where company_id=".$company_id." and cancel_flag=0 and timestamp>=$start_timeframe AND timestamp<=$end_timeframe and (parent<>-1 OR plan=-1)";
		//echo $sql;
		if ($result=$db->Execute($sql)) {
			$row=$result->FetchRow();
			$NumberOfMembers = $row['NumberOfMembers'];
			return $return_vlaue=$NumberOfMembers;
		} // end of if ($result=$db->Execute($sql))

	  	return $return_value;
	  } // end of function GetNumberOfMembers

	 //------------------------------------------------------------------------------

	 function GetCompanylistWithValidContracts(){

	  	global $db;

	  	if (empty($year)) $year=date("Y"); // if no year is given, take the current year

		$start_timeframe=mktime(0,0,1,1,1,$year); //echo date("D M j G:i:s T Y",$start_timeframe)."<br>";
		$end_timeframe=mktime(0,0,0,12,31,$year);
		$return_value[]="id"; // first value is a dummy entry, makes our live later much more easier (array_search behaviour)
		//$this->debug = TRUE;

		($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;

		$sql="SELECT company_id FROM care_tz_insurance where parent=-1 and cancel_flag=0 and timestamp>=$start_timeframe AND timestamp<=$end_timeframe";
		if ($result=$db->Execute($sql)) {
			$row=$result->FetchRow();
			$return_value[] = $row['company_id'];
		} // end of if ($result=$db->Execute($sql))

	  	return (is_array($return_value)) ? $return_value : FALSE;

	 } // end of function GetCompanylistWithValidContracts()

	//------------------------------------------------------------------------------

	 function GetMaximumCeilingForCompany($company_id, $year) {
	 	/*
	 	 * company_id brings us the company out of the table care_tz_insurance - add the year of it then you have the
	 	 * ID of the contract. Next you can have the all members attached to this contract-id.
	 	 */
		global $db;

	  	if (empty($year)) $year=date("Y"); // if no year is given, take the current year

		$start_timeframe=mktime(0,0,1,1,1,$year); //echo date("D M j G:i:s T Y",$start_timeframe)."<br>";
		$end_timeframe=mktime(0,0,0,12,31,$year);
		//$this->debug = TRUE;

		// first section: Get the contract ID:

		($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;

		$sql="SELECT id as contract_id FROM care_tz_insurance where parent=-1 and cancel_flag=0 and timestamp>=$start_timeframe AND timestamp<=$end_timeframe";
		if ($result=$db->Execute($sql)) {

			$row=$result->FetchRow();
			$contract_id = $row['contract_id'];

		} else {

			return -1; // no entry -> retrun with error code!

		} // end of if ($result=$db->Execute($sql))


		// Now we have to look for the members of that contract-id - build a total amount of it's ceiling (depend on the plan)
		$sql = "SELECT
					sum(types.ceiling) as MaximumCeiling
				FROM care_tz_insurance contract
					INNER JOIN care_tz_insurance_types types
						on contract.plan=types.id
				WHERE contract.parent = $company_id";

		if ($result=$db->Execute($sql)) {

			$row=$result->FetchRow();
			return $row['MaximumCeiling'];

		} else {

			return -1; // no entry -> retrun with error code!

		} // end of if ($result=$db->Execute($sql))

	 } // end of function GetMaximumCeilingForCompany($company_id, $year)

	//------------------------------------------------------------------------------



	//------------------------------------------------------------------------------

	function GetUsedAmountForCompany($company_id, $year) {
		global $db;

	  	if (empty($year)) $year=date("Y"); // if no year is given, take the current year

		$start_timeframe=mktime(0,0,1,1,1,$year); //echo date("D M j G:i:s T Y",$start_timeframe)."<br>";
		$end_timeframe=mktime(0,0,0,12,31,$year);
		//$this->debug = TRUE;

		// first section: Get the contract ID:

		($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;

		$sql = "SELECT
					sum(bill_elements.balanced_insurance) as FundUsed
				FROM care_tz_billing_archive bill
					INNER JOIN care_tz_billing_archive_elem bill_elements
						ON bill_elements.nr=bill.id
						AND bill_elements.date_change>=$start_timeframe
						AND bill_elements.date_change<=$end_timeframe
					INNER JOIN care_encounter encounter
						ON encounter.encounter_nr=bill.encounter_nr
					INNER JOIN care_tz_insurance insurance
						ON insurance.PID=encounter.PID
						AND insurance.company_id=$company_id";

		if ($result=$db->Execute($sql)) {

			$row=$result->FetchRow();
			return $row['FundUsed'];

		} else {

			return -1; // no entry -> retrun with error code!

		} // end of if ($result=$db->Execute($sql))

	} // end of function GetUsedAmountForCompany($company_id, $year)

	function GetMembersOfCompany($company_id, $year) {
		global $db;

	  	if (empty($year)) $year=date("Y"); // if no year is given, take the current year

		$start_timeframe=mktime(0,0,1,1,1,$year); //echo date("D M j G:i:s T Y",$start_timeframe)."<br>";
		$end_timeframe=mktime(0,0,0,12,31,$year);
		$this->debug = FALSE;
		($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;

		// is this a company who is getting all invoiced?
		if ($this->GetPlanOfCompanyIDAsString($company_id)=="by invoice") {

			// just the sum:
			$sql="select
					'' AS firstname,
					'' AS lastname,
					count(persons.selian_pid) AS HospitalPID,
					sum(bill_elements.price) AS ToalUsedAmount,
					sum(bill_elements.balanced_insurance) AS TotalUsedInsurance,
					'' AS CompanyID,
					'' AS Ceiling
				FROM care_tz_billing_archive_elem bill_elements
					INNER JOIN  care_tz_billing_archive bill
						ON bill.nr=bill_elements.nr
					INNER JOIN care_encounter encounter
						ON encounter.encounter_nr=bill.encounter_nr
					INNER JOIN care_person as persons
						ON persons.pid=encounter.pid
				WHERE
					bill_elements.date_change>=$start_timeframe AND bill_elements.date_change<=$end_timeframe
					AND bill_elements.insurance_id=$company_id";

			// Including names:
//			$sql="select
//					persons.name_first AS firstname,
//					persons.name_last AS lastname,
//					persons.selian_pid AS HospitalPID,
//					sum(bill_elements.price) AS ToalUsedAmount,
//					sum(bill_elements.balanced_insurance) AS TotalUsedInsurance
//				FROM care_tz_billing_archive_elem bill_elements
//					INNER JOIN  care_tz_billing_archive bill
//						ON bill.nr=bill_elements.nr
//					INNER JOIN care_encounter encounter
//						ON encounter.encounter_nr=bill.encounter_nr
//					INNER JOIN care_person as persons
//						ON persons.pid=encounter.pid
//				WHERE
//					bill_elements.date_change>=$start_timeframe AND bill_elements.date_change<=$end_timeframe
//					AND bill_elements.insurance_id=$company_id
//
//				GROUP BY persons.pid
//				";

		} else {

			$sql="select
						persons.name_first AS firstname,
						persons.name_last AS lastname,
						persons.selian_pid AS HospitalPID,
						sum(bill_elements.price) AS ToalUsedAmount,
						sum(bill_elements.balanced_insurance) AS TotalUsedInsurance,
						plan.ceiling AS Ceiling
					from care_tz_insurance insurance

						INNER JOIN care_person as persons
							ON persons.pid=insurance.PID
						LEFT JOIN care_encounter encounter
							ON encounter.pid=insurance.PID
						LEFT JOIN  care_tz_billing_archive bill
							ON bill.encounter_nr=encounter.encounter_nr
						LEFT JOIN care_tz_billing_archive_elem bill_elements
							ON bill_elements.nr=bill.nr
							AND bill_elements.date_change>=$start_timeframe
							AND bill_elements.date_change<=$end_timeframe
						LEFT JOIN care_tz_insurance_types plan
							ON insurance.plan=plan.id
					where insurance.company_id=$company_id
					GROUP BY persons.pid ";

		} // end of if ($this->GetPlanOfCompanyIDAsString($company_id)=="by invoice")

		$array_index=0;
		if ($result=$db->Execute($sql)) {

			while ($row=$result->FetchRow()) {

				$res_array[$array_index][]=$row['firstname'];
				$res_array[$array_index][]=$row['lastname'];
				$res_array[$array_index][]=$row['HospitalPID'];
				$res_array[$array_index][]=$row['ToalUsedAmount'];
				$res_array[$array_index][]=$row['TotalUsedInsurance'];
				$res_array[$array_index][]=$row['Ceiling'];

				$array_index ++;

			} //end of while ($row=$result->FetchRow())

		} // end of if ($result=$db->Execute($sql))
		return $res_array;
	} // end of function GetMembersOfCompany($company_id, $year)

  function Display_Header($Title){

	global $URL_APPEND, $LDBillingInsurance;

  	echo '<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
			<HTML>
			<HEAD>
			 <TITLE>'.$Title.'</TITLE>
			 <meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
			<meta name="Author" content="Robert Meggle">
			<meta name="Generator" content="various: Quanta, AceHTML 4 Freeware, NuSphere, PHP Coder">
			 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

			<script language="javascript" >
			<!--
			function gethelp(x,s,x1,x2,x3,x4)
			{
			if (!x) x="";
			urlholder="../../main/help-router.php'.URL_APPEND.'&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
			helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
			window.helpwin.moveTo(0,0);
			}
			// -->
			</script>
			<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
			<script language="javascript" src="../../js/hilitebu.js"></script>

			<STYLE TYPE="text/css">
			A:link  {color: #000066;}
			A:hover {color: #cc0033;}
			A:active {color: #cc0000;}
			A:visited {color: #000066;}
			A:visited:active {color: #cc0000;}
			A:visited:hover {color: #cc0033;}
			</style>
			<script language="JavaScript">
			<!--
			function popPic(pid,nm){

			 if(pid!="") regpicwindow = window.open("../../main/pop_reg_pic.php?sid='.$sid.'&lang='.$lang.'&pid="+pid+"&nm="+nm,"regpicwin","toolbar=no,scrollbars,width=180,height=250");

			}
			// -->
			</script>

			  	<script language="javascript">
			<!--
			function closewin()
			{
				location.href=\'startframe.php?sid='.$sid.'&lang='.$lang.'\';
			}
			// -->
			</script>
			</HEAD>';
  	return TRUE;
  }


  function Display_Headline($Headline, $Help_file, $Help_Tag){

	echo '<table cellspacing="0"  class="titlebar" border=0 height="35" width="100%">
	          <tr valign=top  class="titlebar" >
	            <td bgcolor="#99ccff" >&nbsp;&nbsp;<font color="#330066">'.$Headline.'</font></td>
	  	    <td bgcolor="#99ccff" align=right><a
   href="javascript:window.history.back()"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a>';

		if($_SESSION['ispopup']=="true")
	  		$closelink='javascript:window.close();';
	  	else
	  		$closelink='insurance_tz.php?ntid=false&lang=$lang';

	  echo '<a href="javascript:gethelp(\''.$Help_file.'\',\''. $Help_Tag.'\')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a href="insurance_tz.php?ntid=false&lang=$lang" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>  </td>
	 </tr>
	 </table>
	<table width=100% border=0 cellspacing=0 height=80%>
	<tbody class="main">
		<tr valign="middle" align="center">
			<td>';
  	return TRUE;
  }

  function Display_Footer($Headline, $Help_file, $Help_Tag){

	echo '</td></tr></table> <table cellspacing="0" class="titlebar" border=0>
	          <tr valign=bottom class="titlebar">
	            <td bgcolor="#99ccff" >
	                &nbsp;&nbsp;<font color="#330066">'.$Headline.'</font>

	       	    </td>
	  	    <td bgcolor="#99ccff" align=right><a
	   href="javascript:window.history.back()"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a>';

		if($_SESSION['ispopup']=="true")
	  		$closelink='javascript:window.close();';
	  	else
	  		$closelink='insurance_tz.php?ntid=false&lang=$lang';

	  echo '<a
	   href="javascript:gethelp(\' '.$Help_file.'\', \''. $Help_Tag.'\')(\'insurance_reports_companies.php\',\'Insurance Reports :: Company Overview\')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
	   href="insurance_tz.php?ntid=false&lang=$lang" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>  </td>
	 	</tr>
	 </table>';
  	return TRUE;
  }

  function Display_Credits(){
	echo '<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#cfcfcf">
			<tr valign=bottom>
				<td align="center">
 		 			<table width="100%" bgcolor="#ffffff" cellspacing=0 cellpadding=5>
						<tr>
   							<td><div class="copyright">
	<script language="JavaScript">
	<!-- Script Begin
	function openCreditsWindow() {

		urlholder="../../language/$lang/$lang_credits.php?lang=$lang";
		creditswin=window.open(urlholder,"creditswin","width=500,height=600,menubar=no,resizable=yes,scrollbars=yes");

}
//  Script End -->
</script>


 	<a href="http://www.care2x.org" target=_new>CARE2X 2nd Generation pre-deployment 2.0.2</a> :: <a href="../../legal_gnu_gpl.htm" target=_new> License</a> ::
 	<a href=mailto:info@care2x.org>Contact</???a>  :: <a href="../../language/en/en_privacy.htm" target="pp"> Our Privacy Policy </a> ::
 	<a href="../../docs/show_legal.php?lang=$lang" target="lgl"> Legal </a> ::
 	<a href="javascript:openCreditsWindow()"> Credits </a> ::.<br>

							</div>
							</td>
   						<tr>
  					</table>
				</td>
			</tr>
		</table>
	</BODY>
	</html>';
	return true;
  }
}
?>
