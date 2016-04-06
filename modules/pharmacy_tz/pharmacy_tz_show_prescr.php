<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');

require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
*
* elpidio@care2x.org, meggle@merotech.de
*
* See the file "copy_notice.txt" for the licence notice
*/

//define('NO_2LEVEL_CHK',1);
define('LANG_FILE','lang_en_billing.php');
$lang_tables[]='billing.php';
$lang_tables[]='aufnahme.php';
$lang_tables[]='pharmacy.php';
$lang_tables[]='nursing.php';
require($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_tz_insurance.php');
$insurance_tz = New Insurance_tz();

$debug=FALSE;
($debug==TRUE)?$db->debug=true:$db->debug=false;


?>

<table border=0>
	<tr valign="top">
		<!-- Here begins the form  -->

			<?php $ward_nr = $_GET['nr'];



			if ($ward_nr =='')
			{	//global $db;
				$coreObj = new Core;
				$sql = "select * from care_ward";
				$coreObj->result=$db->Execute($sql);
				$row=$coreObj->result->FetchRow();
				$ward_nr = $row['nr'];
			}


			//define array of the GET-variables
			$variables = array('insurance_ID', 'name', 'id_insurer', 'max_pay',  'contact_person', 'po_box', 'city', 'phone', 'email', 'status');

			//fill array '$values_act' with current GET-variables
			$values_act =array();
			foreach($variables as $val)
			{
				array_push($values_act, $_GET[$val]);
				$val = $_GET[$val];
			}


     		// $status: '1' means 'active insurances'

     		if (isset($toggle))
     		{
     			$status = !$status;
     		}

     		$show=true;

     		if (isset($treeLink))
     		{
     			$status = !$status;
     			$show = false;
     		}


     		// DELETE active insurance
			if (isset($_GET['deletebutton']) )
			{

				$sql_add=", deleted_hist=".$insurance_tz->ConcatFieldString("deleted_hist", "deleted on ".date('Y-m-d H:i:s')." by ".$_SESSION['sess_user_name']." \n");
				$coreObj->sql="UPDATE care_tz_insurances_admin SET deleted=1".$sql_add." WHERE insurance_ID=$delete";
				$db->execute($coreObj->sql);

				$show = true;
				$insurance_ID = '';

			}

			// REACTIVATE deleted insurance
			if (isset($_GET['reactivatebutton']) )
			{

				$sql_add=", deleted_hist=".$insurance_tz->ConcatFieldString("deleted_hist", "reactivated on ".date('Y-m-d H:i:s')." by ".$_SESSION['sess_user_name']." \n");
				$coreObj->sql="UPDATE care_tz_insurances_admin SET deleted=0".$sql_add." WHERE insurance_ID=$reactivate";

				$db->execute($coreObj->sql);

				$show = true;
				$insurance_ID = '';
			}

			//create three different arrays for insurances depending on their status

			$coreObj->sql="SELECT DISTINCT insurance_ID FROM care_tz_insurances_admin order by deleted, name asc";
			$result = $db->Execute($coreObj->sql);

			$name_insurer_array_act = array();//active insurances
			$name_insurer_array_del = array();//deleted insurances
			$name_insurer_array_all = array();//active and deleted insurances


			while($row=$result->FetchRow())
			{
				$nr = $row['insurance_ID'];

				if ($nr != -1)
				{
				$coreObj->sql="SELECT * FROM care_tz_insurances_admin WHERE insurance_ID=$nr";


				$ergebnis = $db->Execute($coreObj->sql);
				$row = $ergebnis->FetchRow();
				$arrayTemp = array("name"=> $row['name'], "insurance_ID"=>$nr, "deleted"=>$row['deleted'], "id_insurer"=>$row['insurer'], "max_pay"=>$row['max_pay'],
									"contact_person"=>$row['contact_person'], "po_box"=>$row['po_box'], "city"=>$row['city'], "phone"=>$row['phone'], "email"=>$row['email'] );

				array_push($name_insurer_array_all, $arrayTemp);

				if ($row['deleted'] == 1)
					array_push($name_insurer_array_del, $arrayTemp);
				else
					array_push($name_insurer_array_act, $arrayTemp);

				}
			}

			// SAVE-Option
			if (isset($_GET['save']))
			{
				$show = false;
     			$name = trim($name);

				if ($max_pay == null)
				{
					$max_pay = 0;
				}

				$insuranceParentSame = false;

				if ($insurance_ID == $id_insurer)
				{
					$insuranceParentSame = true;
				}

				$wrong_max_pay = false;

				if (($insurance_ID != '') && !$insuranceParentSame && (!$wrong_max_pay))
				{ //update existing insurance

					$values_old =array();
					foreach($variables as $val)
						array_push($values_old, $_GET[$val.'_old']);

					$sql_arr = array();

					$addition = '';

					for ($i = 1; $i < 9; ++$i)
					{
						if ($values_old[$i] != $values_act[$i])
						{
							$bezeichner = $variables[$i].'_hist';
							if ($values_old[$i] == '')
								$values_old[$i] = '-';
							$wert = $bezeichner.'='.$insurance_tz->ConcatFieldString($bezeichner, "Update from ".$values_old[$i]." to ".$values_act[$i]." / ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']." \n").", ";
						}
						else $wert = ' ';

						$addition.=$wert;
					}

					if (!is_numeric($max_pay) )
					{
						$wrong_max_pay = true;
						$show = false;
					}
					else{

						//$coreObj->sql="UPDATE care_tz_insurances_admin SET name=\"$name\",".$sql_1.$sql_2.$sql_3.$sql_4.$sql_5.$sql_6.$sql_7.$sql_8." insurer=$id_insurer, max_pay=$max_pay, contact_person=\"$contact_person\", po_box=\"$po_box\", city=\"$city\", phone=\"$phone\", email=\"$email\" WHERE insurance_ID=$insurance_ID";
						$coreObj->sql="UPDATE care_tz_insurances_admin SET name=\"$name\",".$addition." insurer=$id_insurer, max_pay=$max_pay, contact_person=\"$contact_person\", po_box=\"$po_box\", city=\"$city\", phone=\"$phone\", email=\"$email\" WHERE insurance_ID=$insurance_ID";
						$db->execute($coreObj->sql);
					}
				}

				else if(!$insuranceParentSame)
				{   //create a new insurance


					$insuranceExists = false;
					$noInsuranceName = false;

					if ($name == '')
					{
						//is there an insurance name at all?
						$noInsuranceName = true;

					}
					else{	// does name of the insurance already exist?

							foreach($name_insurer_array_all as $row)
							{

								if ($row['name'] == $name)
								{
									$insuranceExists = true;
									$show = false;
									break;
								}
							}
						}

					if (!is_numeric($max_pay) )
					{
						$wrong_max_pay = true;
						$show = false;
					}


					// actual creation of the new insurance
					if(!$insuranceExists && (!$noInsuranceName) &&(!$wrong_max_pay))
					{

						for ($i = 2; $i < 9; ++$i)
						{

							$var_hist = $variables[$i].'_hist';
							$var = $variables[$i];

							if ($$var != '')
							{
								$$var_hist = $$var.'\\n';
							}
							else $$var_hist = '-\\n';

						}

						$coreObj->sql="INSERT INTO care_tz_insurances_admin SET insurer=$id_insurer, creation=".$insurance_tz->ConcatFieldString("creation", "Creation ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']." \n").", " .
								"      name='$name', max_pay=$max_pay, max_pay_hist='$max_pay_hist', id_insurer_hist='$id_insurer_hist', name_hist='$name \n', deleted_hist='-\n'," .
								"      contact_person='$contact_person', po_box='$po_box', city='$city', phone='$phone', email='$email'," .
								"      contact_person_hist='$contact_person_hist', po_box_hist='$po_box_hist', city_hist='$city_hist', phone_hist='$phone_hist', email_hist='$email_hist', deleted=0";
						$db->execute($coreObj->sql);
						$show = true;

					}
				}
			}

			//CLEAR-Option
			if (isset($_GET['clear']))
			{
				foreach ($variables as $v)
					$$v = '';

			}	//SHOW-Option

				else if ( (($insurance_ID == '')||isset($toggle))&&$show)

				{	// when you first enter the menu:
					// show first entry of the Insurance-db

					if ($status != 1)
						$arrayTemp = $name_insurer_array_act;
					else $arrayTemp = $name_insurer_array_del;

					$row = $arrayTemp[0];

					for ($i = 0; $i<9; ++$i)
					{
						$$variables[$i] = $row[$variables[$i]];
					}
			}

			?>
		</td>
	</tr>
</table>

<?php require ("gui/gui_pharmacy_tz_show_prescr.php");?>
