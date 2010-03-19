<?php

require_once($root_path.'include/inc_environment_global.php');
require_once('class_weberp.php');

function new_weberp() {
	global $sid, $is_transmit_to_weberp_enable;

	if($is_transmit_to_weberp_enable == 1)
	{
		$cache_filename = 'object_data.inc';
		if (!file_exists(sys_get_temp_dir().'/'.$_SERVER['HTTP_HOST'])) {
			mkdir(sys_get_temp_dir().'/'.$_SERVER['HTTP_HOST'], 0700);
		}
		$cachefile_full_filename = sys_get_temp_dir().'/'.$_SERVER['HTTP_HOST'].'/'.$cache_filename;
		if(file_exists($cachefile_full_filename)){
			$object_data = unserialize(file_get_contents($cachefile_full_filename));
		} else {
			$object_data = new weberp_c2x;
		}
		return $object_data;
	}
	else
	{
		return false;
	}


}

function destroy_weberp($obj_weberp) {
	global $sid;
	$cache_filename = 'object_data.inc';
	if (!file_exists(sys_get_temp_dir().'/'.$_SERVER['HTTP_HOST'])) {
		mkdir(sys_get_temp_dir().'/'.$_SERVER['HTTP_HOST'], 0700);
	}
	$cachefile_full_filename = sys_get_temp_dir().'/'.$_SERVER['HTTP_HOST'].'/'.$cache_filename;
	file_put_contents($cachefile_full_filename, serialize($obj_weberp));
	return true;
}

class weberp_c2x extends weberp {


    function transfer_bill_to_webERP_asSalesInvoice($pid,$bill_number,$billelems)
    {
 		$billdata[ovamount]= $billelems[price]*$billelems[amount];
 	    $billdata[consignment]=$billelems[User_Id];
 		$billdata[bill_nr]= $bill_number;
 		$billdata[pid] = $pid;
 		$billdata[partcode] = 'TREATMENT';
 		$this->transfer_invoice_to_weberp($this->generateWebERPCustSalesInvoiceData($billdata));
    }

    function transfer_patient_to_webERP_asCustomer($pid,$persondata)
    {
    	$customerdata=$this->generateWebERPCustomerData($persondata);
    	$branchdata=$this->generateWebERPCustBranchData($persondata);
    	$this->transfer_customer_to_weberp($customerdata,$branchdata);
    }

    function make_patient_workorder_in_webERP($treatmentID)
    {
    	$woData['loccode']=$this->defaultLocation;
    	$woData['requiredby']=date('Y-m-d');
    	$woData['startdate']=date('Y-m-d');
    	$woData['costissued']=0;
    	$woData['closed']=0;
    	$woData['stockid']='TREATMENT';
    	$woData['qtyreqd']=1;
    	$woData['qtyrecd']=0;
    	$woData['stdcost']=0;
    	$woData['nextlotsnref']=$treatmentID;
    	$this->transfer_workorder_to_weberp($woData);
    }

    function issue_to_patient_workorder_in_weberp($SerialNumber, $StockID, $Location, $Quantity, $Batch)
    {
    	$woSearchData[0]='nextlotsnref';
    	$woSearchData[1]=$SerialNumber;
    	$answer=$this->transfer($woSearchData,$this->weberpcalls['searchWorkOrders']);
    	$woIssueData[0]=$answer[0];
    	if (!$this->get_stock_item_from_webERP($StockID))
    	{
    		$stockData=$this->get_stock_info_for_webERP($StockID);
			$this->create_stock_item_in_webERP($stockData);
    	}
    	$woIssueData[1]=$StockID;
    	$woIssueData[2]=$Location;
    	$woIssueData[3]=$Quantity;
    	$woIssueData[4]=date('Y-m-d');
    	$woIssueData[5]=$Batch;
    	$this->issue_to_workorder_in_weberp($woIssueData);
    }

    function receive_patient_workorder_in_weberp($WONumber)
    {
    	$woReceiveData[0]=$WONumber;
    	$woReceiveData[1]='TREATMENT';
    	$woReceiveData[2]=$this->defaultLocation;
    	$woReceiveData[3]=1;
    	$woReceiveData[4]=date($this->defaultDateFormat);
    	$this->receive_workorder_in_weberp($woReceiveData);
    }

    function get_stock_info_for_webERP($StockID)
    {
		global $db;
	  	$sql="SELECT * FROM care_tz_drugsandservices where item_number='".$StockID."'";
  		$result=$db->Execute($sql);
  		$myrow=$result->FetchRow();
		$StockData['stockid']=$StockID;
		$StockData['description']=$myrow['item_description'];
		$StockData['longdescription']=$myrow['item_full_description'];
		if ($myrow['purchasing_class']=="service")
		{
			$StockData['mbflag'] = 'D';
		}
		if (($myrow['is_pediatric']+$myrow['is_adult']+$myrow['is_other']+$myrow['is_consumable']+$myrow['is_labtest'])==0)
		{
			$StockData['categoryid']='ZZ';
		}
		return $StockData;
    }

	function generateWebERPCustSalesInvoiceData($saleInvoiceData)
	{

		$webERPCustSalesInvoiceData = array (

			debtorno=>$saleInvoiceData[pid],
			branchcode=>$saleInvoiceData[pid],
			trandate=>date($this->defaultDateFormat),
			settled=>"",
			reference=>"",
			tpe=>"",
			order_=>"",
			rate=>"1",
			ovamount=>$saleInvoiceData[ovamount],
			ovgst=>"",
			ovfreight=>"",
			ovdiscount=>"",
			diffonexch=>"",
			alloc=>"0",
			invtext=>"",
			shipvia=>"",
			edisent=>"",
			consignment=>$saleInvoiceData[consignment],
			partcode=>'TREATMENT',
			salesarea=>"Ar0"

	);


	$webERPCustSalesInvoiceData = $this->delete_empty_data_entries($webERPCustSalesInvoiceData);

	return $webERPCustSalesInvoiceData;
	}

	function generateWebERPCustBranchData($customerdata)
	{
		$webERPCustBranchData = array (

			branchcode=>$customerdata[pid],
			debtorno=>$customerdata[pid],
			brname=>"".$customerdata[name_first]." ".$customerdata[name_last]."",
			braddress1=>"",
			braddress2=>"",
			braddress3=>"",
			braddress4=>"",
			braddress5=>"",
			braddress6=>"",
			estdeliverydays =>"",
			area=>$this->getAreaCode($customerdata[district]),
			salesman=>$this->getSalesmanCode(),
			fwddate=>"",
			phoneno=>"",
			faxno=>"",
			contactname=>"",
			email=>"",
			defaultlocation=>$this->defaultLocation,
			taxgroupid=>"1",
			defaultshipvia=>"",
			deliverblind=>"",
			disabletrans=>"0",
			brpostaddr1=>"",
			brpostaddr2=>"",
			brpostaddr3=>"",
			brpostaddr4=>"",
			brpostaddr5=>"",
			brpostaddr6=>"",
			specialinstructions=>"",
			custbranchcode=>""

		);
		$webERPCustBranchData = $this->delete_empty_data_entries($webERPCustBranchData);

		return $webERPCustBranchData;
	}

	function generateWebERPCustomerData($patientdata){
		$webERPCustomerData = array (

			debtorno=>$patientdata[pid],
			name=>"".$patientdata[name_first]." ".$patientdata[name_last]."",
			address1=>"",
			address2=>"",
			address3=>"",
			address4=>"",
			address5=>"",
			address6=>"",
			currcode=>$this->defaultCurrency,
			salestype=>$this->defaultPriceList,
			clientsince=>date($this->defaultDateFormat),
			holdreason=>"1",
			paymentterms=>"CA",
			discount=>"",
			pymtdiscount=>"",
			lastpaid=>"",
			lastpaiddate=>"",
			creditlimit=>"",
			invaddrbranch=>"",
			discountcode=>"",
			ediinvoices=>"",
			ediorders=>"",
			edireference=>"",
			editransport=>"",
			ediaddress=>"",
			ediserveruser=>"",
			ediserverpwd=>"",
			taxref=>"",
			customerpoline => "0"

		);

		$webERPCustomerData = $this->delete_empty_data_entries($webERPCustomerData);
		return $webERPCustomerData;
	}

}
?>