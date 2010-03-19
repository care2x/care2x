<?php
require_once('xmlrpc/lib/xmlrpc.inc');

class weberp {

	var $weberpcalls = array (
		'getCustomer'=>"weberp.xmlrpc_GetCustomer",
		'insertCustomer'=>"weberp.xmlrpc_InsertCustomer",
		'insertBranch'=>"weberp.xmlrpc_InsertBranch",
		'modifyCustomer'=>"weberp.xmlrpc_ModifyCustomer" ,
		'searchCustomer'=>"weberp.xmlrpc_SearchCustomers" ,
		'getCurrencyList'=>"weberp.xmlrpc_GetCurrencyList" ,
		'getCurrencyDetails'=>"weberp.xmlrpc_GetCurrencyDetails",
		'getSalesTypeList'=>"weberp.xmlrpc_GetSalesTypeList" ,
		'getSalesTypeDetails'=>"weberp.xmlrpc_GetSalesTypeDetails",
		'insertSalesType'=>"weberp.xmlrpc_InsertSalesType",
		'getHoldReasonList'=>"weberp.xmlrpc_GetHoldReasonList" ,
		'getHoldReasonDetails'=>"weberp.xmlrpc_GetHoldReasonDetails" ,
		'getPaymentTermsList'=>"weberp.xmlrpc_GetPaymentTermsList" ,
		'getPayemtTermsDetails'=>"weberp.xmlrpc_GetPaymentTermsDetails",
		'insertStockItem'=>"weberp.xmlrpc_InsertStockItem" ,
		'modfiyStockItem'=>"weberp.xmlrpc_ModifyStockItem",
		'getStockItem'=>"weberp.xmlrpc_GetStockItem" ,
		'searchStockItems'=>"weberp.xmlrpc_SearchStockItems" ,
		'getStockBalance'=>"weberp.xmlrpc_GetStockBalance" ,
		'insertSalesInvoice'=>"weberp.xmlrpc_InsertSalesInvoice" ,
		'insertSalesCredit'=>"weberp.xmlrpc_InsertSalesCredit" ,
		'modifyBranch'=>"weberp.xmlrpc_ModifyBranch" ,
		'getStockReorderLevel'=>"weberp.xmlrpc_GetStockReorderLevel",
		'setStockReorderLevel'=>"weberp.xmlrpc_SetStockReorderLevel",
		'stockCatPropertyList'=>"weberp.xmlrpc_StockCatPropertyList",
		'getAllocatedStock'=>"weberp.xmlrpc_GetAllocatedStock",
		'getOrderedStock'=>"weberp.xmlrpc_GetOrderedStock",
		'setStockPrice'=>"weberp.xmlrpc_SetStockPrice",
		'getStockPrice'=>"weberp.xmlrpc_GetStockPrice",
		'getCustomerBranch'=>"weberp.xmlrpc_GetCustomerBranch",
		'insertSalesOrderHeader'=>"weberp.xmlrpc_InsertSalesOrderHeader",
		'modifySalesOrderHeader'=>"weberp.xmlrpc_ModifySalesOrderHeader",
		'insertSalesOrderLine'=>"weberp.xmlrpc_InsertSalesOrderLine",
		'modifySalesOrderLine'=>"weberp.xmlrpc_ModifySalesOrderLine",
		'insertGLAccount'=>"weberp.xmlrpc_InsertGLAccount",
		'insertGLAccountSection'=>"weberp.xmlrpc_InsertGLAccountSection",
		'insertGLAccountGroup'=>"weberp.xmlrpc_InsertGLAccountGroup",
		'getLocationList'=>"weberp.xmlrpc_GetLocationList",
		'getLocationDetails'=>"weberp.xmlrpc_GetLocationDetails",
		'getShipperList'=>"weberp.xmlrpc_GetShipperList",
		'getShipperDetails'=>"weberp.xmlrpc_GetShipperDetails",
		'getSalesAreasList'=>"weberp.xmlrpc_GetSalesAreasList",
		'getSalesAreaDetails'=>"weberp.xmlrpc_GetSalesAreaDetails",
		'getSalesAreaDetailsFromName'=>"weberp.xmlrpc_GetSalesAreaDetailsFromName",
		'insertSalesArea'=>"weberp.xmlrpc_InsertSalesArea",
		'getSalesmanList'=>"weberp.xmlrpc_GetSalesmanList",
		'getSalesmanDetails'=>"weberp.xmlrpc_GetSalesmanDetails",
		'getSalesmanDetailsFromName'=>"weberp.xmlrpc_GetSalesmanDetailsFromName",
		'insertSalesman'=>"weberp.xmlrpc_InsertSalesman",
		'getTaxGroupList'=>"weberp.xmlrpc_GetTaxgroupList",
		'getTaxGroupDetails'=>"weberp.xmlrpc_GetTaxgroupDetails",
		'getCustomerTypeList'=>"weberp.xmlrpc_GetCustomerTypeList",
		'getCustomerTypeDetails'=>"weberp.xmlrpc_GetCustomerTypeDetails",
		'insertStockCategory'=>"weberp.xmlrpc_InsertStockCategory",
		'modifyStockCategory'=>"weberp.xmlrpc_ModifyStockCategory",
		'getStockCategory'=>"weberp.xmlrpc_GetStockCategory",
		'searchStockCategories'=>"weberp.xmlrpc_SearchStockCategories",
		'getGLAccountList'=>"weberp.xmlrpc_GetGLAccountList",
		'getGLAccountDetails'=>"weberp.xmlrpc_GetGLAccountDetails",
		'getStockTaxRate'=>"weberp.xmlrpc_GetStockTaxRate",
		'insertSupplier'=>"weberp.xmlrpc_InsertSupplier",
		'modifySupplier'=>"weberp.xmlrpc_ModifySupplier",
		'getSupplier'=>"weberp.xmlrpc_GetSupplier",
		'searchSuppliers'=>"weberp.xmlrpc_SearchSuppliers",
		'stockAdjustment'=>"weberp.xmlrpc_StockAdjustment",
		'workOrderIssue'=>"weberp.xmlrpc_WorkOrderIssue",
		'searchWorkOrders'=>"weberp.xmlrpc_SearchWorkOrders",
		'insertPurchData'=>"weberp.xmlrpc_InsertPurchData",
		'modifyPurchData'=>"weberp.xmlrpc_ModifyPurchData",
		'insertWorkOrder'=>"weberp.xmlrpc_InsertWorkOrder",
		'workOrderReceive'=>"weberp.xmlrpc_WorkOrderReceive",
		'getBatches'=>"weberp.xmlrpc_GetBatches",
		'getDefaultDateFormat'=>"weberp.xmlrpc_GetDefaultDateFormat",
		'getDefaultCurrency'=>"weberp.xmlrpc_GetDefaultCurrency",
		'getDefaultPriceList'=>"weberp.xmlrpc_GetDefaultPriceList",
		'getDefaultLocation'=>"weberp.xmlrpc_GetDefaultLocation"
	);

	public $client;
	private $DebugLevel;
	private $ServerURL;
	private $user;
	private $password;
	public $response;
	public $parms;
 	public $defaultDateFormat;
 	public $defaultLocation;
 	public $defaultCurrency;
 	public $defaultPriceList;

	function weberp() {

		$this->DebugLevel = 2;
		$this->ServerURL = "http://localhost/webERP/api/api_xml-rpc.php";


			$this->user = php_xmlrpc_encode("admin");
			$this->password = php_xmlrpc_encode("haydom");
			$this->client = new xmlrpc_client($this->ServerURL);
			$this->client->setDebug($this->DebugLevel);

	    	$dateFormat=$this->transfer(null, $this->weberpcalls['getDefaultDateFormat']);
	    	if ($dateFormat[0]==0) {
	    		$this->defaultDateFormat=$dateFormat[1]['confvalue'];
	    	} else {
	    		$this->defaultDateFormat='d/m/Y';
	    	}
	    	$location=$this->transfer(null, $this->weberpcalls['getDefaultLocation']);
	    	if ($location[0]==0) {
	    		$this->defaultLocation=$location[1]['defaultlocation'];
	    	} else {
	    		$this->defaultLocation='';
	    	}
	    	$currency=$this->transfer(null, $this->weberpcalls['getDefaultCurrency']);
	    	if ($currency[0]==0) {
	    		$this->defaultCurrency=$currency[1]['currencydefault'];
	    	} else {
	    		$this->defaultCurrency='GBP';
	    	}
	    	$pricelist=$this->transfer(null, $this->weberpcalls['getDefaultPriceList']);
	    	if ($pricelist[0]==0) {
	    		$this->defaultPriceList=$this->verifyPriceList($pricelist[1]['confvalue']);
	    	} else {
	    		$this->defaultPriceList='0';
	    	}



	}



	function params($call) {
		if (isset($this->parms[$call])) {
			$answer[0]=$this->parms[$call];
			return $answer[0];
		}
		$msg = new xmlrpcmsg("system.methodSignature", array(php_xmlrpc_encode($call)));
		$client = new xmlrpc_client($this->ServerURL);
		$client->setDebug($this->DebugLevel);
		$response = $client->send($msg);
		$answer = php_xmlrpc_decode($response->value());
		$this->parms[$call]=$answer[0];
		return $answer[0];
	}

	function transfer_invoice_to_weberp($invoicedata) {
 		$transmit = $this->transfer($invoicedata,$this->weberpcalls['insertSalesInvoice']);
 		if($transmit == 0) {
	    	return true;
	    } else {
	    	return false;
	    }
	}

	function transfer_customer_to_weberp($customerdata, $branchdata) {
    	$transmit=$this->transfer($customerdata,$this->weberpcalls['insertCustomer']);
		$transmit=$this->transfer($branchdata,$this->weberpcalls['insertBranch']);
		if($transmit == 0) {
	    	return true;
	    } else if($transmit == 1001) {
	    	return true;
	    } else {
	    	return false;
	    }

	}

	function transfer_workorder_to_weberp($woData) {
    	$transmit=$this->transfer($woData,$this->weberpcalls['insertWorkOrder']);
    	if ($transmit[0]==0) {
    		return $transmit[1];
    	} else {
    		return false;
    	}
	}

	function issue_to_workorder_in_weberp($woIssueData) {
    	$transmit=$this->transfer($woIssueData,$this->weberpcalls['workOrderIssue']);
    	if ($transmit[0]==0) {
    		return $transmit[1];
    	} else {
    		return false;
    	}
	}

	function receive_workorder_in_weberp($woReceiveData) {
    	$transmit=$this->transfer($woReceiveData,$this->weberpcalls['workOrderReceive']);
    	if ($transmit[0]==0) {
    		return $transmit[1];
    	} else {
    		return false;
    	}
	}

    function create_stock_item_in_webERP($stockData) {
    	$transmit=$this->transfer($stockData,$this->weberpcalls['insertStockItem']);
    	if ($transmit[0]==0) {
    		return $transmit[0];
    	} else {
    		return false;
    	}
    }

    function modify_stock_item_in_webERP($stockData) {
    	$transmit=$this->transfer($stockData,$this->weberpcalls['modifyStockItem']);
    	if ($transmit[0]==0) {
    		return $transmit[0];
    	} else {
    		return false;
    	}
    }

    function get_stock_item_from_webERP($stockID) {
    	$transmit=$this->transfer($stockID,$this->weberpcalls['getStockItem']);
    	if ($transmit[0]==0) {
    		return $transmit[1];
    	} else {
    		return false;
    	}
    }

    function search_stock_items_in_webERP($field, $criteria) {
    	$searchData[0]=$field;
    	$searchData[1]=$criteria;
    	$transmit=$this->transfer($searchData,$this->weberpcalls['searchStockItems']);
    	if ($transmit[0]==0) {
    		return $transmit[1];
    	} else {
    		return false;
    	}
    }

    function get_stock_balance_webERP($stockID) {
    	$transmit=$this->transfer($stockID,$this->weberpcalls['getStockBalance']);
    	if ($transmit[0]==0) {
    		return $transmit[1];
    	} else {
    		return false;
    	}
    }

    function get_stock_reorder_level_in_webERP($stockID) {
    	$transmit=$this->transfer($stockID,$this->weberpcalls['getStockReorderLevel']);
    	if ($transmit[0]==0) {
    		return $transmit[1];
    	} else {
    		return false;
    	}
    }

    function get_stock_items_from_category_property($property, $category) {
    	$catdata[0]=$property;
    	$catdata[1]=$category;
    	$transmit=$this->transfer($catdata,$this->weberpcalls['stockCatPropertyList']);
    	if ($transmit[0]==0) {
    		return $transmit[1];
    	} else {
    		return false;
    	}
    }

    function set_stock_reorder_level_in_webERP($StockID, $Location, $ReorderLevel) {
    	$reorderData[0]=$StockID;
    	$reorderData[1]=$Location;
    	$reorderData[2]=$ReorderLevel;
    	$transmit=$this->transfer($reorderData,$this->weberpcalls['setStockReorderLevel']);
    	if ($transmit[0]==0) {
    		return $transmit[1];
    	} else {
    		return false;
    	}
    }

    function get_allocated_stock_in_webERP($stockID) {
    	$transmit=$this->transfer($stockID,$this->weberpcalls['getAllocatedStock']);
    	if ($transmit[0]==0) {
    		return $transmit[1];
    	} else {
    		return false;
    	}
    }

    function get_ordered_stock_in_webERP($stockID) {
    	$transmit=$this->transfer($stockID,$this->weberpcalls['getOrderedStock']);
    	if ($transmit[0]==0) {
    		return $transmit[1];
    	} else {
    		return false;
    	}
    }

    function stock_adjustment_in_webERP($StockID, $Location, $Quantity, $TranDate) {
    	$adjustmentData[0]=$StockID;
    	$adjustmentData[1]=$Location;
    	$adjustmentData[2]=$Quantity;
    	$adjustmentData[3]=$TranDate;
    	$transmit=$this->transfer($adjustmentData,$this->weberpcalls['stockAdjustment']);
    	if ($transmit[0]==0) {
    		return $transmit[1];
    	} else {
    		return false;
    	}
    }

	function getAreaCode($district) {
    	$areadetails=$this->transfer($district, $this->weberpcalls['getSalesAreaDetailsFromName']);
		if ($areadetails[0]==0) {
			return $areadetails[1]['areacode'];
		} else if ($areadetails[0]==1156) {
			$i=0;
			$area['areacode']=substr($district,0,2).$i;
			$area['areadescription']=$district;
    		$transmit=$this->transfer($area, $this->weberpcalls['insertSalesArea']);
    		while ($transmit[0]!=0) {
    			$i++;
				$area['areacode']=substr($district,0,2).$i;
    			$transmit=$this->transfer($area, $this->weberpcalls['insertSalesArea']);
    		}
    		if ($transmit[0]==0) {
    			return $area['areacode'];
    		} else {
    			return -1;
    		}
		} else {
			return -1;
		}
	}

	function getSalesmanCode() {
    	$salesmandetails=$this->transfer('Default', $this->weberpcalls['getSalesmanDetailsFromName']);
		if ($salesmandetails[0]==0) {
			return $salesmandetails[1]['salesmancode'];
		} else if ($salesmandetails[0]==1157) {
			$salesman['salesmancode']='1';
			$salesman['salesmanname']='Default';
    		$transmit=$this->transfer($salesman, $this->weberpcalls['insertSalesman']);
    		if ($transmit[0]==0) {
    			return $salesman['salesmancode'];
    		} else {
    			return -1;
    		}
		} else {
			return -1;
		}
	}

	function verifyPriceList($pricelist) {
		$pricelistdetails=$this->transfer($pricelist, $this->weberpcalls['getSalesTypeDetails']);
		if ($pricelistdetails[0]==0) {
			return $pricelistdetails[1]['typeabbrev'];
		} else if ($pricelistdetails[0]==1005) {
			$pricelistdata['typeabbrev']=$pricelist;
			$pricelistdata['sales_type']='Default';
			$transmit=$this->transfer($pricelistdata, $this->weberpcalls['insertSalesType']);
    		if ($transmit[0]==0) {
    			return $pricelist;
    		} else {
    			return -1;
    		}
		} else {
			return -1;
		}
	}

	function delete_empty_data_entries($data) {
		foreach ($data as $key => $value) {
			if ($value<>'' ||  is_numeric ($value) ) {
				$dataDetails[$key] = $value;
			}
		}
		return $dataDetails;
	}

	function transfer($data,$call) {
		$parameters = $this->params($call);
		$parameter_number=sizeOf($parameters)-3;
		if ($parameter_number==0) {
			$msg = new xmlrpcmsg($call, array($this->user, $this->password));
		} else if ($parameter_number==1) {
			$details = php_xmlrpc_encode($data);
			$msg = new xmlrpcmsg($call, array($details, $this->user, $this->password));
		} else if ($parameter_number==2) {
			for ($i=0; $i<$parameter_number; $i++) {
				$details[$i] = php_xmlrpc_encode($data[$i]);
			}
			$msg = new xmlrpcmsg($call, array($details[0], $details[1], $this->user, $this->password));
		} else if ($parameter_number==3) {
			for ($i=0; $i<$parameter_number; $i++) {
				$details[$i] = php_xmlrpc_encode($data[$i]);
			}
			$msg = new xmlrpcmsg($call, array($details[0], $details[1], $details[2], $this->user, $this->password));
		} else if ($parameter_number==4) {
			for ($i=0; $i<$parameter_number; $i++) {
				$details[$i] = php_xmlrpc_encode($data[$i]);
			}
			$msg = new xmlrpcmsg($call, array($details[0], $details[1], $details[2], $details[3], $this->user, $this->password));
		} else if ($parameter_number==5) {
			for ($i=0; $i<$parameter_number; $i++) {
				$details[$i] = php_xmlrpc_encode($data[$i]);
			}
			$msg = new xmlrpcmsg($call, array($details[0], $details[1], $details[2], $details[3], $details[4], $this->user, $this->password));
		} else if ($parameter_number==6) {
			for ($i=0; $i<$parameter_number; $i++) {
				$details[$i] = php_xmlrpc_encode($data[$i]);
			}
			$msg = new xmlrpcmsg($call, array($details[0], $details[1], $details[2], $details[3], $details[4], $details[5], $this->user, $this->password));
		}
		$this->client->setDebug($this->DebugLevel);
		//$this->client->setDebug(2);
		$response = $this->client->send($msg);
		$error_code= php_xmlrpc_decode($response->value());
		return $error_code;
	}

}
?>