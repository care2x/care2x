 <?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr($_SERVER['SCRIPT_NAME'],'inc_supplier_db_save_mod.php')) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

else $dbtable='care_supplier';


// if mode is save then save the data
if(isset($mode)&&($mode=='save')){

    $saveok=false;
    $error=false;
    $error_bnum=false;
    $error_name=false;
    $error_besc=false;
    $error_minmax=false;

    $supplier=trim($supplier);
	if ($supplier=='') { $error_supplier=true; $error=true;};
    $representative=trim($representative); 
	
	
    if(!$update){	
		# check if order number exists
		
		if($supplier_obj->SupplierExists($supplier,$cat)){
			$error='supplier_exists';
			$supplier='';
		}
	}

	if(!$error){	
		//clean and check input data variables

		$encoder=trim($encoder); 
		if($encoder=='') 	$encoder=$ck_prod_db_user; 

			$oktosql=true;
					
			if(!($update)){
			  
				$data=array('supplier'=>$supplier,
							'address'=>$address,
							'telephone'=>$telephone,
							'fax'=>$fax,
							'postal_code'=>$postal_code,
							'representative'=>$representative,
							'history'=>"Created ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n",
							'create_id'=>$_SESSION['sess_user_name'],
							'create_time'=>date('YmdHis')
							 );
							
							# Set core to main products
							$supplier_obj->useSupplier($cat);
							$supplier_obj->setDataArray($data);
							$saveok=$supplier_obj->insertDataFromInternalArray();			
									
							$oktosql=false;
			}else{
					 	$updateok=true;
					 	$tail="address='$address',
							telephone='$telephone',
							postal_code='$postal_code',
							representative='$representative',";
						
						# If the image filename extension is empty do not update picfile
						

						$tail.="address='$address',
							telephone='$telephone',
							postal_code='$postal_code',
							representative='$representative',
							history=".$supplier_obj->ConcatHistory("Update ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n").",
							create_id = '".$_SESSION['sess_user_name']."',
							create_time = '".date('YmdHis')."'";

						$sql="UPDATE $dbtable SET ";

						if($ref_bnum==$supplier)
							$sql=$sql."supplier='$supplier', $tail  WHERE bestellnum='$bestellnum'";
						else {	
							$updateok=false; 
							$oktosql=false;
						}
						if($updateok) 
							$keyword=$supplier;
						else  
							$keyword=$ref_bnum;
			}
			//echo $sql;
			if($oktosql){
				if($supplier_obj->Transact($sql)){
					$saveok=true;
				}else{print "no save<p>".$sql."<p>$LDDbNoSave";};
 			}
	}
}
?>
