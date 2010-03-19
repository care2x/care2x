 <?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('inc_products_db_save_mod.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

if(isset($cat)&&($cat=='pharma')) $dbtable='care_pharma_products_main';
	else $dbtable='care_med_products_main';


// if mode is save then save the data
if(isset($mode)&&($mode=='save')){

    $saveok=false;
    $error=false;
    $error_bnum=false;
    $error_name=false;
    $error_besc=false;
    $error_minmax=false;

    $bestellnum=trim($bestellnum);
	if ($bestellnum=='') { $error_bnum=true; $error=true;};
    $artname=trim($artname); 
	if ($artname=='') { $error_name=true; $error=true; };
    $besc=trim($besc);
	if ($besc=='') { $error_besc=true; $error=true; };
	
	if(!is_numeric($minorder)) $minorder=NULL;
	if(!is_numeric($maxorder)) $maxorder=NULL;
	$proorder=(int)$proorder;
	
	if($maxorder&&$minorder>$maxorder){ $error_minmax=true; $error=true;}
	# Default nr.of pcs. pro order is 1
	if(!$proorder) $proorder=1;
	
    if(!$update){	
		# check if order number exists
		if($product_obj->ProductExists($bestellnum,$cat)){
			$error='order_nr_exists';
			$bestellnum='';
		}
	}

	if(!$error){	
		//clean and check input data variables

		$encoder=trim($encoder); 
		if($encoder=='') 	$encoder=$ck_prod_db_user; 
		// save the uploaded picture
		// if a pic file is uploaded move it to the right dir
		if(is_uploaded_file($HTTP_POST_FILES['bild']['tmp_name']) && $HTTP_POST_FILES['bild']['size']){
			$picext=substr($HTTP_POST_FILES['bild']['name'],strrpos($HTTP_POST_FILES['bild']['name'],'.')+1);
			# Check if the file format is allowed
			if(stristr($picext,'gif')||stristr($picext,'jpg')||stristr($picext,'png'))
			{
			    $n=0;
			    $picfilename=$HTTP_POST_FILES['bild']['name'];
			    list($f,$x)=explode('.',$picfilename);
			    $idx=substr($picfilename,strpos($picfilename,'[')+1);
			    if($idx)
				{
				    $cf=substr($picfilename,0,strpos($picfilename,'['));
					$lx=substr($idx,0,strpos($idx,']'));
					$n=$lx;
				}			
			   while(file_exists($imgpath.$picfilename))
			   {
				   $n++;
				   if($lx) $picfilename=$cf."[$n]".".".$x;
					else $picfilename=$f."[$n]".".".$x;
			    }
				
				# Prepend the order nr to the filename
				$picfilename=$bestellnum.'_'.$picfilename;
				# Now save the image to the hard drive
			  	copy($HTTP_POST_FILES['bild']['tmp_name'],$imgpath.$picfilename);
		    }
			else
			{
			   $picext='';
			}
		}

			$oktosql=true;
					
			if(!($update)){
			  
				$data=array('bestellnum'=>$bestellnum,
							'artikelnum'=>$artnum,
							'industrynum'=>$indusnum,
							'artikelname'=>$artname,
							'generic'=>$generic,
							'description'=>$besc,
							'picfile'=>$picfilename,
							'packing'=>$pack,
							'dose'=>$dose,
							'minorder'=>$minorder,
							'maxorder'=>$maxorder,
							'proorder'=>$proorder,
							'encoder'=>$_SESSION['sess_user_name'],
							'enc_date'=>$dstamp,
							'enc_time'=>$tstamp,
							'lock_flag'=>$lockflag,
							'medgroup'=>$medgroup,
							'cave'=>$caveflag,
							'minpcs'=>$minpcs,
							'history'=>"Created ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n",
							'create_id'=>$_SESSION['sess_user_name'],
							'create_time'=>date('YmdHis')
							 );
							
							# Set core to main products
							$product_obj->useProduct($cat);
							$product_obj->setDataArray($data);
							$saveok=$product_obj->insertDataFromInternalArray();			
									
							$oktosql=false;
			}else{
					 	$updateok=true;
					 	$tail="generic='$generic',
							description='$besc',
							packing='$pack',
							dose='$dose',
							minorder='$minorder',
							maxorder='$maxorder',
							proorder='$proorder',
							minpcs='$minpcs',";
						
						# If the image filename extension is empty do not update picfile
						
						if($picext!="") $tail.="picfile='$picfilename',";

						$tail.="encoder='$encoder',
							enc_date='$dstamp',
							enc_time='$tstamp',
							lock_flag='".(int)$lockflag."',
							medgroup='$medgroup',
							cave='$caveflag',
							history=".$product_obj->ConcatHistory("Update ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n").",
							create_id = '".$_SESSION['sess_user_name']."',
							create_time = '".date('YmdHis')."'";

						$sql="UPDATE $dbtable SET ";

						if($ref_bnum==$bestellnum)
							$sql=$sql."artikelnum='$artnum', industrynum='$indusnum', artikelname='$artname', $tail  WHERE bestellnum='$bestellnum'";
							else if ($ref_artnum==$artnum)
								$sql=$sql."bestellnum='$bestellnum', industrynum='$indusnum', artikelname='$artname', $tail WHERE artikelnum='$artnum'";
								else if($ref_indusnum==$indusnum)
									$sql=$sql."bestellnum='$bestellnum', artikelnum='$artnum', artikelname='$artname', $tail WHERE industrynum='$indusnum'";
									else if($ref_artname==$artname)
									$sql=$sql."bestellnum='$bestellnum', artikelnum='$artnum', industrynum='$indusnum', $tail WHERE artikelname='$artname'";
									else
									{	$updateok=false; $oktosql=false;}
							if($updateok) $keyword=$bestellnum;else  $keyword=$ref_bnum;
			}
			// echo $sql;
			if($oktosql){
				if($product_obj->Transact($sql)){
					$saveok=true;
				}else{print "no save<p>".$sql."<p>$LDDbNoSave";};
 			}
	}
}
?>
