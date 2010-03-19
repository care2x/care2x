<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

# Define to TRUE if you want to echo the actions
# Note: might be useless in case of large number of persons.
define('ECHO_ACTION',FALSE);

# Crude protection to avoid robots from starting the script
if(!isset($max)||($max<0)||!isset($sex)){
	//header('Location:../');
	echo "finished or invalid";
	exit;
}

# Set the maximum nr of persons created  defaults to 1000
if(isset($max)&&(empty($max)||!$max)){
	$max=1000; # <== Set this value for default
}

# default to male sex
if(isset($sex)&&empty($sex)||($sex!='m'&&$sex!='f')) $sex='m';

# seed the random generator
srand ((double) microtime() * 1000000);

$inmax=180;

define('LANG_FILE','specials.php');
//$local_user='aufnahme_user';
define('NO_CHAIN',1);
require_once($root_path.'include/inc_front_chain_lang.php');


# Retrieve all available persons from the table according to selected sex

$sql1="select date_reg, name_first,name_last,date_birth,blood_group,addr_str,addr_str_nr,addr_zip,phone_1_nr,civil_status,sex,title from care_person where sex='$sex' ";

if($pool=$db->Execute($sql1)){
	if($poolcount=$pool->RecordCount()){
		
		if($max<$inmax) $inmax=$max;
		if($poolcount<$inmax) $inmax=$poolcount;
		
		# Loop to create the new values
		for($x=0,$n=0;$x<$inmax;$x++,$n++){
			# get a first random value
			$rd1= rand(0,$poolcount-1);
			# get a second random value;
			$rd2= rand(0,$poolcount-1);
			# if rd1 == rd2 try getting a different rd2
			while($rd1==$rd2){
				$rd2=rand(0,$poolcount-1);
			}
			# Move cursor to first random nr.
			$pool->Move($rd1);
			# Fetch this row
			$person1=$pool->FetchRow();
			# Move cursor to second random nr.
			$pool->Move($rd2);
			# Fetch this row
			$person2=$pool->FetchRow();
			
			# Check if date registration is usable, default to today
			if($person1['date_reg']=='0000-00-00 00:00:00'){
				if($person2['date_reg']=='0000-00-00 00:00:00'){
					$date_reg=date('Y-m-d H:i:s'); # This is today
				}else{
					$date_reg=$person2['date_reg'];
				}
			}else{
				$date_reg=$person1['date_reg'];
			}
			
			# generate random blood group
			$rd3=rand(1,4);
			switch($rd3){
				case 1:	$blood_group='A';break;
				case 2: $blood_group='B';break;
				case 3: $blood_group='O';break;
				default : $blood_group='AB';
			}		
			# generate random civil status
			$rd4=rand(1,5);
			switch($rd4){
				case 4:	$civil_status='single';break;
				case 2: $civil_status='married';break;
				case 3: $civil_status='divorced';break;
				case 1: $civil_status='widowed';break;
				default : $civil_status='separated';
			}		
			# Create combined person
			$sql2="insert into care_person 
						(date_reg,
						name_first,
						name_last,
						date_birth,
						blood_group,
						addr_str,
						addr_str_nr,
						addr_zip,
						phone_1_nr,
						civil_status,
						sex,
						title,
						status,
						history,
						modify_id,
						modify_time,
						create_id,
						create_time) 
						values 
						('".$date_reg."',
						'".$person2['name_first']."',
						'".$person1['name_last']."',
						'".$person2['date_birth']."',
						'".$blood_group."',
						'".$person2['addr_str']."',
						'".$person1['addr_str_nr']."',
						'".$person2['addr_zip']."',
						'".$person1['phone_1_nr']."',
						'".$civil_status."',
						'".$sex."',
						'".$person1['title']."',
						'',
						'Create: ".date('Y-m-d H:i:s')." generator',
						'generator',
						'".date('YmdHis')."',
						'generator',
						'".date('YmdHis')."')";
			
			# for debugging
			if(defined('ECHO_ACTION')&&ECHO_ACTION){
				echo "<p>random 1: $rd1, random 2: $rd2<p>";
				echo $person1['name_first'].' '.$person1['name_last'].' '.$person1['date_birth'].'<br>';
				echo $person2['name_first'].' '.$person2['name_last'].' '.$person2['date_birth'].'<br>';
			
				//echo "<br>$sql2";
			}
			
			# Insert the new person in the table
			# Comment out the following line if you want to simulate the generation without saving into the table

			$db->BeginTrans();
			$ok=$db->Execute($sql2);
			if($ok) {
			    $db->CommitTrans();
				if($n>50||(defined('ECHO_ACTION')&&ECHO_ACTION)){
					//echo "<p>$x<br>$sql2";
					$n=0;
				}
			}else{
			     $db->RollbackTrans();
				 //echo  "insert failed<p>";
			}
		}
		//echo "<br>$x<br>";
		$totmax=$max-$inmax;
		if(!$totmax||$totmax<0){
			echo "finished";
			exit;
		}else{

			header("Location:makeperson.php?max=$totmax&sex=$sex");
			exit;
		}
	}else{
		echo "nothing found! <p> $sql1<p>";
	}
}else{
	echo "sql query failed! <p> $sql1<p>";
}



?>
