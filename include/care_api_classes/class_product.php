<?php
/**
* @package care_api
*/
/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');
/**
*  Product methods. 
*
* Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Product extends Core {
	/**#@+
	* @access private
	* @var string
	*/
	/**
	* Table name for pharmay order lists
	*/
	var $tb_polist='care_pharma_orderlist'; 
	/**
	* Table name for pharmay order lists sub table
	*/
	var $tb_polist_sub='care_pharma_orderlist_sub'; 
	/**
	* Table name for pharmacy order catalog
	*/
	var $tb_pocat='care_pharma_ordercatalog'; 
	/**
	* Table name for pharmacy main products
	*/
	var $tb_pmain='care_pharma_products_main';
	/**
	* Table name for medical depot order lists
	*/
	var $tb_molist='care_med_orderlist';
	/**
	* Table name for medical depot order catalog
	*/
	var $tb_mocat='care_med_ordercatalog';
	/**
	* Table name for medical depot main products
	*/
	var $tb_mmain='care_med_products_main';
	/**
	* Table name for medical depot main products administration
	*/
	var $tb_mmain_sub='care_med_products_main_sub';	
	/**
	 * Table name form pharmacy product administration
	 */
	var $tb_pmain_sub='care_pharma_products_main_sub';
	/**
	 * Table name of the encounter prescription
	 */
	var $tb_prescription='care_encounter_prescription';
	/**
	 * Table name of the encounter prescription sub
	 */
	var $tb_prescription_sub='care_encounter_prescription_sub';
	/**#@-*/
	
	/**
	* Field names of care_pharma_ordercatalog or care_med_ordercatalog tables
	* @var array
	*/
	var $fld_ocat=array('item_no',
						'dept_nr',
						'hit',
						'artikelname',
						'bestellnum',
						'minorder',
						'maxorder',
						'proorder',
						'supplier_nr',
						'sasi',
						'price',
						'vlere',
						'expiry_date',
						'dose',
						'packing');
	/**
	* Field names of care_pharma_products_main or care_med_products_main tables
	* @var array
	*/
	var $fld_prodmain=array('bestellnum',
							'artikelnum',
							'industrynum',
							'artikelname',
							'generic',
							'description',
							'packing',
							'dose',
							'minorder',
							'maxorder',
							'proorder',
							'picfile',
							'encoder',
							'enc_date',
							'enc_time',
							'lock_flag',
							'medgroup',
							'cave',
							'status',
							'history',
							'modify_id',
							'modify_time',
							'create_id',
							'create_time',
							'warehouse',
							'minpcs');
	/**
	* Field names of care_med_products_main_sub
	* @var array
	*/
	var $fld_prodmain_sub=array('id',
								'pcs',
								'expiry_date',
								'price',
								'bestellnum',
								'idcare_supply',
								'create_time');
										
	/**
	* Field names of care_pharma_products_main_sub
	* @var array
	*/
	var $fld_pharmamain_sub=array('id',
									'pcs',
									'expiry_date',
									'price',
									'bestellnum',
									'idcare_pharma',
									'create_time');
	
	/**
	* Field names of care_encounter_prescription table
	* @var int
	*/
	var $fld_presc_sub=array('nr', 
							'prescription_nr',
							'prescription_type_nr',
							'bestellnum',
							'article',
							'drug_class',
							'dosage',
							'admin_time',
							'quantity',
							'application_type_nr',
							'sub_speed',
							'notes_sub',
							'color_marker',
							'is_stopped',
							'stop_date',
							'status',
							'companion');		
	/**
	* Constructor
	*/				
	function Product(){
	}
	/**
	* Sets the core object to point  to either care_pharma_orderlist or care_med_orderlist table and field names.
	*
	* The table is determined by the parameter content. 
	* @access public
	* @param string Determines the final table name 
	* @return boolean.
	*/
	function useOrderList($type){
		if($type=='pharma'){
			$this->coretable=$this->tb_polist;
		}elseif($type=='medlager'){
			$this->coretable=$this->tb_molist;
		}else{return false;}
	}
	/**
	* Sets the core object to point  to either care_pharma_ordercatalog or care_med_ordercatalog table and field names.
	*
	* The table is determined by the parameter content. 
	* @access public
	* @param string Determines the final table name 
	* @return boolean.
	*/
	function useOrderCatalog($type){
		if($type=='pharma'){
			$this->coretable=$this->tb_pocat;
			$this->ref_array=$this->fld_ocat;
		}elseif($type=='medlager' or $type=='supply'){
			$this->coretable=$this->tb_mocat;
			$this->ref_array=$this->fld_ocat;
		}else{return false;}
	}
	/**
	* Sets the core object to point  to either care_pharma_products_main or care_med_products_main table and field names.
	*
	* The table is determined by the parameter content. 
	* @access public
	* @param string Determines the final table name 
	* @return boolean.
	*/
	function useProduct($type){
		if($type=='pharma'){
			$this->coretable=$this->tb_pmain;
			$this->ref_array=$this->fld_prodmain;
		}elseif($type=='medlager' or $type='supply'){
			$this->coretable=$this->tb_mmain;
			$this->ref_array=$this->fld_prodmain;
		}else{return false;}
	}
	/**
	* Deletes an order.
	* @access public
	* @param int Order number
	* @param string Determines the final table name 
	* @return boolean.
	*/
	function DeleteOrder($order_nr,$type){
		$this->useOrderList($type);
		$this->sql="DELETE  FROM $this->coretable WHERE order_nr='$order_nr'";
       	return $this->Transact();
	}
	/**
	* Deletes an order by a supplier.
	* @access public
	* @param int Order number
	* @param string Determines the final table name 
	* @return boolean.
	*/
	function DeleteOrderSupplier($idcare_supply,$type){
		//$this->useOrderList($type);
		$this->sql="DELETE FROM care_supply WHERE idcare_supply='$idcare_supply'";
		return $this->Transact();
	}	
	/**
	* Returns the actual order catalog of a department.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains catalog  data with  index keys as outlined in the <var>$fld_ocat</var> array.
	* @access public
	* @param int Department number
	* @param string Determines the final table name 
	* @return mixed adodb record object or boolean
	*/
	function ActualOrderCatalog($dept_nr,$type=''){
		global $db;
		if(empty($type)||empty($dept_nr) ) return false;	
		$this->useOrderCatalog($type);
		$this->sql="SELECT * FROM $this->coretable WHERE dept_nr='$dept_nr' ORDER BY hit DESC";
		if($this->res['aoc']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['aoc']->RecordCount()) {
				return $this->res['aoc'];
			} else { return false; }
		} else { return false; }
	}
	/**
	* Returns the actual order catalog of a pharmacy.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains catalog  data with  index keys as outlined in the <var>$fld_ocat</var> array.
	* @access public
	* @param int Department number
	* @param string Determines the final table name 
	* @return mixed adodb record object or boolean
	*/
	function ActualOrderCatalogPharma($type='',$bestellnum, $pharma){
		global $db;
		if(empty($type)||empty($bestellnum)) return false;
		$this->useOrderCatalog($type);
		$this->sql="SELECT * FROM care_pharma_products_main_sub WHERE bestellnum='$bestellnum' AND pcs > 0  AND idcare_pharma = $pharma ORDER BY expiry_date ASC";
		if($this->res['aoc']=$db->Execute($this->sql)) {
			if($this->rec_count=$this->res['aoc']->RecordCount()) {
				return $this->res['aoc'];
			} else { return false; }
		} else { return false; }
	}	
	/**
	* Returns the actual pcs for the selected product.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains catalog  data with  index keys as outlined in the <var>$fld_ocat</var> array.
	* @access public
	* @param int Department number
	* @param string Determines the final table name 
	* @return mixed adodb record object or boolean
	*/
	function ActualOrderCatalogProducts($type='',$bestellnum){
		global $db;
		if(empty($type)||empty($bestellnum)) return false;
		$this->useOrderCatalog($type);
		$this->sql="SELECT * FROM care_med_products_main_sub WHERE bestellnum='$bestellnum' AND pcs > 0 ORDER BY  expiry_date ASC";
		if($this->res['aoc']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['aoc']->RecordCount()) {
				return $this->res['aoc'];
			} else { return false; }
		} else { return false; }
	}	
	/**
	* Returns the actual order catalog of supplier.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains catalog  data with  index keys as outlined in the <var>$fld_ocat</var> array.
	* @access public
	* @param int Department number
	* @param string Determines the final table name 
	* @return mixed adodb record object or boolean
	*/
	function ActualOrderCatalogSupply($supplier_nr,$type=''){
		global $db;
		$this->sql="SELECT DISTINCT * FROM care_med_ordercatalog WHERE supplier_nr='$supplier_nr' ORDER BY hit DESC";
		if($this->res['aoc']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['aoc']->RecordCount()) {
				return $this->res['aoc'];
			} else { return false; }
		} else { return false; }
	}	
	/**
	* Saves (inserts)  an item in the order catalog.
	*
	* The data must be passed by reference with associative array.
	* Data must have the index keys as outlined in the <var>$fld_ocat</var> array.
	* @access public
	* @param array Data to save
	* @param string Determines the final table name 
	* @return boolean
	*/
	function SaveCatalogItem(&$data,$type){
		if(empty($type)) return false;
		$this->useOrderCatalog($type);
		$this->data_array=&$data;
		return $this->insertDataFromInternalArray();
	}
	/**
	* Saves (inserts)  an item in the order catalog of the suplier.
	*
	* The data must be passed by reference with associative array.
	* Data must have the index keys as outlined in the <var>$fld_ocat</var> array.
	* @access public
	* @param array Data to save
	* @param string Determines the final table name 
	* @return boolean
	*/	
	function SaveCatalogItemSupply(&$data,$type){
		if(empty($type)) return false;
		$this->useOrderCatalog($type);
		$this->data_array=&$data;
		return $this->insertDataFromInternalArray();
	}	
	/**
	* Deletes a catalog item based on its item number key.
	* @access public
	* @param int Item number
	* @param string Determines the final table name 
	* @return boolean
	*/
	function DeleteCatalogItem($item_nr,$type){
		if(!$item_nr||!$type) return false;
		$this->useOrderCatalog($type);
		$this->sql="DELETE FROM $this->coretable WHERE item_no='$item_nr'";
       	return $this->Transact();
	}
	/**
	* Returns all orders of a department marked as draft or are still unsent.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains order  data with the following index keys:
	* - order_nr = order's primary key number
	* - dept_nr = department number      
	* - order_date = date of ordering
	* - order_time = time of ordering   
	* - articles = ordered articles                
	* - extra1 = extra notes                
	* - extra2 = extra notes                
	* - validator = validator's name                
	* - ip_addr = IP address of the workstation that send the order            
	* - priority = priority level                
	* - status = record's status                
	* - history = record's history                
	* - modify_id = name of user                
	* - modify_time = modify time stamp in yyyymmddhhMMss format              
	* - create_id = name of use                
	* - create_time = creation time stamp in yyyymmddhhMMss format    
	* - sent_datetime = date and time sent in yyyy-mm-dd hh:MM:ss format              
	* - process_datetime = date and time processed in yyyy-mm-dd hh:MM:ss format              

	* @access public
	* @param int Department number
	* @param string Determines the final table name 
	* @return mixed adodb record object or boolean
	*/
	function OrderDrafts($dept_nr,$type){
		global $db;
		if(empty($type)||empty($dept_nr)) return false;
		$this->useOrderList($type);
		$this->sql="SELECT * FROM $this->coretable
						WHERE sent_datetime = '".DBF_NODATETIME."'
						AND validator=''
						AND (status='draft' OR status='')
						AND dept_nr=$dept_nr
						ORDER BY order_date";

        if($this->res['od']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['od']->RecordCount()) {
				return $this->res['od'];
			} else { return false; }
		} else { return false; }
	}
	/**
	* Returns all orders of a suplier marked as draft or are still unsent.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains order  data with the following index keys:
	* - order_nr = order's primary key number
	* - supplier_nr = suplier number      
	* - order_date = date of ordering
	* - order_time = time of ordering   
	* - articles = ordered articles                
	* - extra1 = extra notes                
	* - extra2 = extra notes                
	* - validator = validator's name                
	* - ip_addr = IP address of the workstation that send the order            
	* - priority = priority level                
	* - status = record's status                
	* - history = record's history                
	* - modify_id = name of user                
	* - modify_time = modify time stamp in yyyymmddhhMMss format              
	* - create_id = name of use                
	* - create_time = creation time stamp in yyyymmddhhMMss format    
	* - sent_datetime = date and time sent in yyyy-mm-dd hh:MM:ss format              
	* - process_datetime = date and time processed in yyyy-mm-dd hh:MM:ss format              

	* @access public
	* @param int Suplier number
	* @param string Determines the final table name 
	* @return mixed adodb record object or boolean
	*/
	function OrderDraftsSupplier($supplier_nr,$type){
		global $db;
		if(empty($type)||empty($supplier_nr)) return false;
		//$this->useOrderList($type);
		$this->sql="SELECT * FROM care_supply
						WHERE sent_datetime = '".DBF_NODATETIME."'
						AND (status='draft' OR status='')
						AND idcare_supplier=$supplier_nr
						ORDER BY order_date";

        if($this->res['od']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['od']->RecordCount()) {
				return $this->res['od'];
			} else { return false; }
		} else { return false; }
	}	
	/**
	* Returns all pending orders or orders with  "acknowledge and print" status. 
	*
	* These orders are marked in the table as "pending" or "ack_print".
	* For detailed structure of the returned data, see <var>OrderDrafts()</var> method.
	* @access public
	* @param string Determines the final table name 
	* @return mixed adodb record object or boolean
	*/
	function PendingOrders($type){
		global $db;
		if(empty($type)) return false;
		$this->useOrderList($type);
		$this->sql="SELECT * FROM $this->coretable WHERE status='pending' OR status='ack_print' ORDER BY sent_datetime DESC";

        if($this->res['po']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['po']->RecordCount()) {
				return $this->res['po'];
			} else { return false; }
		} else { return false; }
	}
	/**
	* Checks if the product exists based on its primary key number.
	* @access public
	* @param int Item number
	* @param string Determines the final table name 
	* @return boolean
	*/
	function ProductExists($nr=0,$type=''){
		global $db;
		if(empty($type)||!$nr) return false;
		$this->useProduct($type);
		$this->sql="SELECT bestellnum FROM $this->coretable WHERE bestellnum='$nr'";

        if($buf=$db->Execute($this->sql)) {
            if($buf->RecordCount()) {
				return true;
			} else { return false; }
		} else { return false; }
	}
	/**
	* Checks if the product exists based on its name.
	* @access public
	* @param int Item number
	* @param string Determines the final table name 
	* @return boolean
	*/
	function ProductNameExists($artikelname='',$table=''){
		global $db;
		if(empty($type)||!$nr) return false;
		$this->useProduct($type);
		$this->sql="SELECT artikelname FROM care_med_pharma_main WHERE artikelname='$artikelname'";
        if($buf=$db->Execute($this->sql)) {
            if($buf->RecordCount()) {
				return true;
			} else { return false; }
		} else { return false; }
	}
	/**
	* Checks if the product exists based on its name.
	* @access public
	* @param int Item number
	* @param string Determines the final table name 
	* @return boolean
	*/
	function ProductInformation($idsub='',$type){
		global $db;
		if(!$idsub) return false;
		if(!$type) return false;
		if($type=='pharma') {
			$tbmain = 'care_pharma_products_main';
			$tbsub = 'care_pharma_products_main_sub';
		} else {
			$tbmain = 'care_med_products_main';
			$tbsub = 'care_med_products_main_sub';			
		}
		$this->sql="SELECT *
                    FROM $tbmain
                         INNER JOIN $tbsub ON (
                         $tbmain.bestellnum =
                          $tbsub.bestellnum)
                    WHERE $tbsub.id = '$idsub'";
	    if($buf = $db->Execute($this->sql)) {
        	if($buf->RecordCount()) {
				return $buf->fields;
			} else { return false; }
		} else { return false; }
	}
	/**
	 * Return the orders made by the given department
	 *
	 * @param int $dept_nr Department number
	 */
	function getWaitingDeptOrders($dept_nr) {
		global $db;
		if(empty($dept_nr)||!$dept_nr) return false;
		//cleanup things a bit
		$this->sql = "DELETE FROM $this->tb_pocat WHERE $this->tb_pocat.dept_nr = $dept_nr";
		$db->Execute($this->sql);
		$this->coretable=$this->tb_prescription_sub;
		$this->ref_array=$this->fld_presc_sub;
		$this->sql="INSERT INTO $this->tb_pocat(bestellnum, quantity, artikelname,
                     minorder, maxorder, proorder, dose, packing, dept_nr)
                    SELECT $this->tb_prescription_sub.bestellnum,
                           SUM($this->tb_prescription_sub.quantity) AS quantity,
                           $this->tb_pmain.artikelname,
                           $this->tb_pmain.minorder,
                           $this->tb_pmain.maxorder,
                           $this->tb_pmain.proorder,
                           $this->tb_pmain.dose,
                           $this->tb_pmain.packing,
                           care_encounter_prescription.dept_nr
                    FROM $this->tb_pmain
                         INNER JOIN $this->tb_prescription_sub ON (
                         $this->tb_pmain.bestellnum = $this->tb_prescription_sub.bestellnum)
                         INNER JOIN care_encounter_prescription ON (
                         $this->tb_prescription_sub.prescription_nr = care_encounter_prescription.nr)
                    WHERE care_encounter_prescription.dept_nr = $dept_nr AND $this->tb_prescription_sub.status = 'printed'
                    GROUP BY $this->tb_prescription_sub.bestellnum,
                             $this->tb_pmain.artikelname,
                             $this->tb_pmain.minorder,
                             $this->tb_pmain.maxorder,
                             $this->tb_pmain.proorder,
                             $this->tb_pmain.dose,
                             $this->tb_pmain.packing,
                             care_encounter_prescription.dept_nr
                    ORDER BY $this->tb_prescription_sub.companion DESC";
        if($this->res['od']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['od']->RecordCount()) {
				return $this->res['od'];
			} else { return false; }
		} else { return false; }
				
	}
	/**
	 * function to update the prices of the medicaments on the prescription table
	 * since i'm not so good with sql i've done a 3 step process
	 * 1. get the actual bestellnum & the correspondin price
	 * 2. update prescription sub with the prices
	 * 3. update the status to 'done' in prescription
	 *
	 * @param int $dept_nr Department number 
	 * @return bool true / false
	 */
	function updatePrescriptionPrices($dept_nr){
		global $db;
		$doneUpdate = false;
		if(empty($dept_nr)||!$dept_nr) return false;
		
		//get the actual prices of the mediaments
		$this->sql = "SELECT $this->tb_polist.dept_nr,
                           $this->tb_polist.status,
                           AVG ($this->tb_polist_sub.price) AS price,
                           $this->tb_polist_sub.bestellnum
                    FROM $this->tb_polist
                         INNER JOIN $this->tb_polist_sub ON ($this->tb_polist.order_nr =
                          $this->tb_polist_sub.order_nr_sub)
                    WHERE $this->tb_polist.dept_nr = $dept_nr AND
                          $this->tb_polist.status = 'pending'
                    GROUP BY $this->tb_polist_sub.bestellnum";
		if($buf = $db->Execute($this->sql)) {
            if($this->rec_count=$buf->RecordCount()) {
				$actualPrices = $buf;
			} else { return false; }
		} else { return false; } 
		
		//update the prices for the prescriptions
		while($actualProduct = $actualPrices->fetchRow()) {
			$price = $actualProduct['price'];
			$bnum = $actualProduct['bestellnum'];
			$this->sql = "UPDATE $this->tb_prescription,
                               $this->tb_prescription_sub
                        SET $this->tb_prescription_sub.price = $price, 
                        	$this->tb_prescription_sub.status = 'done'
                        WHERE $this->tb_prescription.nr =
                         $this->tb_prescription_sub.prescription_nr AND
                              $this->tb_prescription_sub.bestellnum = $bnum AND
                              $this->tb_prescription_sub.status = 'printed' AND
                              $this->tb_prescription.dept_nr = $dept_nr AND
                              $this->tb_prescription.status = 'printed'";
			if($db->Execute($this->sql))
				$doneUpdate = true;
		}
		//finaly i update the status of the actual prescriptions
		$db->Execute("UPDATE $this->tb_prescription SET $this->tb_prescription.status = 'done' WHERE $this->tb_prescription.dept_nr = $dept_nr");
		if($doneUpdate == true)
			return true;
		else
			return false;
	}
}
?>
