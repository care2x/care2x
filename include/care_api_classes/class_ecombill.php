<?php
/**
 * @package care_api
 */

/**
 */
require_once($root_path.'include/care_api_classes/class_core.php');
/**
 *  Billing Methods methods.
 *  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance.
 * @author Gjergj Sheldija
 * @version beta 0.1
 * @copyright 2009,2010 Gjergj Sheldija
 * @package care_api
 */
class eComBill extends Core {

	var $billingArchive 	= 'care_billing_archive';
	var $billingBill 		= 'care_billing_bill';
	var $billItem 			= 'care_billing_bill_item';
	var $finalBill			= 'care_billing_final';
	var $billableItem		= 'care_billing_item';
	var $billPayment		= 'care_billing_payment';


	function createBillableItem($testCode, $testName, $testPrice, $testType, $testDiscount) {
		$this->sql = "INSERT INTO $this->billableItem VALUES('". $testCode ."','".$testName."',".$testPrice.",'".$testType."',".$testDiscount.")";
		return $this->Transact();
	}
	
	function listServiceItemsByType($type){
		global $db;
		$this->sql="SELECT * FROM $this->billableItem WHERE item_type='". $type ."'";
		if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        return $this->result;
			}else{return false;}
		}else{return false;}		
	}
	
	function listServiceItems(){
		global $db;
		$this->sql="SELECT * FROM $this->billableItem";
		if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        return $this->result;
			}else{return false;}
		}else{return false;}		
	}
	
	function listServiceItemsByCode($code){
		global $db;
		$this->sql="SELECT * FROM $this->billableItem WHERE item_code='". $code ."'";
		if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        return $this->result;
			}else{return false;}
		}else{return false;}		
	}
	
	function updateServiceItem($itemDescription, $itemCost, $itemDiscount, $itemCode) {
		$this->sql = "UPDATE $this->billableItem SET 
							item_description= '".$itemDescription."', 
							item_unit_cost= ".$itemCost.", 
							item_discount_max_allowed= ".$itemDiscount." 
						WHERE item_code='".$itemCode."'";
		return $this->Transact();
	}
	
	function checkFinalBillExist($patient_no){
		global $db;
		$this->sql="SELECT * FROM $this->finalBill WHERE final_encounter_nr='". $patient_no ."'";
		if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        return $this->result;
			}else{return false;}
		}else{return false;}		
	}	
	
	function listBillsByEncounter($patient_no){
		global $db;
		$this->sql="SELECT * FROM $this->billItem WHERE bill_item_encounter_nr='". $patient_no ."'  AND bill_item_status IN ('0','')";
		if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        return $this->result;
			}else{return false;}
		}else{return false;}		
	}	
	
	function checkBillExist($patient_no){
		global $db;
		$this->sql="SELECT * FROM $this->billItem WHERE bill_item_encounter_nr='". $patient_no ."'";
		if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        return $this->result;
			}else{return false;}
		}else{return false;}		
	}	

	function checkBillByBillId($billid){
		global $db;
		$this->sql="SELECT bill_item_code,bill_item_unit_cost,bill_item_units,bill_item_amount 
					FROM $this->billItem 
					WHERE bill_item_bill_no='$billid' and bill_item_status='1'";
		if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        return $this->result;
			}else{return false;}
		}else{return false;}		
	}	
	
	function checkPaymentExist($patient_no){
		global $db;
		$this->sql="SELECT * FROM $this->billPayment WHERE payment_encounter_nr='". $patient_no ."'";
		if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        return $this->result;
			}else{return false;}
		}else{return false;}		
	}
	
	function listPayments(){
		global $db;
		$this->sql="SELECT payment_receipt_no FROM $this->billPayment ORDER BY payment_receipt_no DESC'";
		if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        return $this->result;
			}else{return false;}
		}else{return false;}		
	}

	function listFinalBills(){
		global $db;
		$this->sql="SELECT final_bill_no FROM $this->finalBill ORDER BY final_bill_no DESC LIMIT 1'";
		if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        return $this->result;
			}else{return false;}
		}else{return false;}		
	}

	function getBilledItemsByEncounter($patientno){
		global $db;
		$this->sql="SELECT bill_item_code,bill_item_units FROM $this->billItem  WHERE bill_item_encounter_nr='". $patientno ."'";
		if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        return $this->result;
			}else{return false;}
		}else{return false;}			
	}
	
	function createBillItem($patientno, $labcode, $unitcost, $no_units, $totalamt, $presdatetime){
		$this->sql = "INSERT INTO $this->billItem (bill_item_encounter_nr,bill_item_code,bill_item_unit_cost,bill_item_units,bill_item_amount,bill_item_date) 
						VALUES($patientno,'$labcode',$unitcost,$no_units,$totalamt,'$presdatetime')";
		
		if(!$this->Transact($this->sql)) return $this->getLastQuery();
		return true;
	}
	
	function createPaymentItem($patientno,$receipt_no,$presdatetime,$amtcash,$chkno,$amtcheque,$cdno,$amtcc,$totalamount){
		$this->sql = "INSERT INTO $this->billPayment (payment_encounter_nr,payment_receipt_no,payment_date,payment_cash_amount,payment_cheque_no,payment_cheque_amount,payment_creditcard_no,payment_creditcard_amount,payment_amount_total) 
						VALUES($patientno,$receipt_no,'$presdatetime',$amtcash,$chkno,$amtcheque,$cdno,$amtcc,$totalamount)";
		
		if(!$this->Transact($this->sql)) return $this->getLastQuery();
		return true;
	}
	
	function createBill($patientno,$presdatetime,$totalamt,$outstanding) {
		$this->sql = "INSERT INTO $this->billingBill (bill_encounter_nr,bill_date_time,bill_amount,bill_outstanding) 
						VALUES($patientno,'$presdatetime',$totalamt,$outstanding)";
		
		if(!$this->Transact($this->sql)) return $this->getLastQuery();
		return true;		
	}
	
	function createFinalBill($patientno, $final_bill_no, $presdate, $totalbill,$discount, $paidamt,$amtdue,$currentamt) {
		$this->sql = "INSERT INTO $this->finalBill (final_encounter_nr, final_bill_no,final_date,final_total_bill_amount,final_discount,final_total_receipt_amount,final_amount_due,final_amount_recieved)
						VALUES($patientno,$final_bill_no,'$presdate','$totalbill','$discount','$paidamt','$amtdue','$currentamt')";
		
		if(!$this->Transact($this->sql)) return $this->getLastQuery();
		return true;		
	}

	function listCurrentPayments($patient_no){
		global $db;
		$this->sql="SELECT * FROM $this->billPayment WHERE payment_encounter_nr='" . $patient_no ."' ORDER BY payment_date DESC";
		if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        return $this->result;
			}else{return false;}
		}else{return false;}		
	}
	
	function listCurrentPaymentsByRecipeNr($receiptid){
		global $db;
		$this->sql="SELECT * FROM $this->billPayment WHERE payment_receipt_no='" . $receiptid ."'";
		if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        return $this->result;
			}else{return false;}
		}else{return false;}		
	}
	
	function billAmountPaymentbyEncounter($patientno){
		global $db;
		$this->sql="SELECT SUM(payment_amount_total) AS total_payment_amount 
					FROM $this->billPayment WHERE payment_encounter_nr='" . $patientno ."'";
		if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        return $this->result;
			}else{return false;}
		}else{return false;}		
	}

	function billAmountByEncounter($patientno){
		global $db;
		$this->sql="SELECT SUM(bill_amount) AS total_amount, SUM(bill_outstanding) AS total_outstanding 
					FROM $this->billingBill WHERE bill_encounter_nr='" . $patientno ."'";
		if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        return $this->result;
			}else{return false;}
		}else{return false;}		
	}
		
	function listCurrentBills($patient_no){
		global $db;
		$this->sql="SELECT * FROM $this->billingBill WHERE bill_encounter_nr='" . $patient_no ."'";
		if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        return $this->result;
			}else{return false;}
		}else{return false;}		
	}
		
	function listAllBills(){
		global $db;
		$this->sql="SELECT bill_bill_no FROM $this->billingBill ORDER BY bill_bill_no DESC";
		if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        return $this->result;
			}else{return false;}
		}else{return false;}		
	}	
}