<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
?>
<script language="javascript" src="../../js/datetimepicker.js"></script>
<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">


	<tr>

	  <td  valign="top" align="middle" height="35">
		   <table width="770" border=0 align="center" cellspacing="0"  class="titlebar">
 <tr valign=top  class="titlebar" >
  <td width="423" bgcolor="#99ccff" >
    &nbsp;&nbsp;<font color="#330066">BLOCK PAYMENT SUMMARY REPORT</font></td>
  <td width="238" align=right bgcolor="#99ccff">
   <a href="javascript: history.back();"><img src="../../gui/img/control/default/en/en_back2.gif" /></a>
   <td width="103" bgcolor="#99ccff" ><a href="<?php echo $root_path;?>modules/reporting_tz/reporting_main_menu.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a></td>
   </td>
    </tr>
 </table>
<p>&nbsp; </p>
			 
<form id="form1" name="form1" method="post" action="">
  <table width="596" border="0" align="center" bgcolor="#CCCCFF">
    <tr>
      <td width="81">FROM:</td>
      <td width="144"><input type="text" id="dfrom" name="dfrom" /></td>
      <td width="98"><a href="javascript:NewCal('dfrom','ddmmyyyy')"><img src="../../gui/img/common/default/calendar.gif" /></a></td>
      <td width="47">TO:</td>
      <td width="144"><input type="text" id="dto" name="dto" /></td>
      <td width="56"><a href="javascript:NewCal('dto','ddmmyyyy')"><img src="../../gui/img/common/default/calendar.gif" /></a></td><td><input type="submit" name="show" value="SHOW" /></td>
    </tr>
  </table>
</form>
<?php
$dfrom       =   $_POST['dfrom'];
$dto         =   $_POST['dto'];
//if(empty($datefrom) || empty($dto)) echo 'Please Enter Date Range';  

$dfrom_timestamp =  strtotime($dfrom);
$dto_timestamp   =  strtotime($dto);

//CREATE TEMPORARY TABLE WHICH PULL ALL THE NEEDED COLUMNS FROM THE DATABASE
$sql_temp = "CREATE TEMPORARY TABLE block_temp SELECT date_change, description, price FROM care_tz_billing_archive_elem WHERE insurance_id=0 AND description LIKE 'cons%'";
$sql_temp_result= $db->Execute($sql_temp);

//PULL DATA FROM TEMPORARY TABLE ($sql_temp) WITHIN THE DEFINED DATE RANGE
$sql_temp_date_range="SELECT date_change,description,SUM(price) as total FROM block_temp WHERE date_change BETWEEN $dfrom_timestamp AND $dto_timestamp GROUP BY description";
$sql_temp_date_range_result = $db->Execute($sql_temp_date_range);

if(!$sql_temp_date_range_result){
	echo "SELECT DATE RANGE";
	exit;
	}

 ?>
 <form id="form2" name="form2" method="post" action="">
 <table width="605" border="0" >
 <?php
 //$dto minus one day
 $newdateto = strtotime('-1 day', strtotime($dto));
 $newdateto = date('j-m-Y',$newdateto);
 
  ?>
 <tr><td>Start Date:<?php echo $dfrom;?></td><td>End Date:<?php echo $newdateto;?></td></tr>
 
 <tr>
 
   <!--  <td width="174" bgcolor="#CCCCFF">DATE</td> -->
    <td width="224" bgcolor="#CCCCFF">Item Description </td>
    <td width="185" bgcolor="#CCCCFF">Sub-Total </td>
  </tr>
<?php
//PUT DATA IN THE LOOP READY TO DISPLAY

  while($rows= $sql_temp_date_range_result->FetchRow()){
  	

  echo '<tr><td width="224">'.$rows['description'].'</td></br>';
  echo '<td width="185">'.number_format($rows['total'],2).'</td><br></tr>';
  
   
  
  }
  
    
  ?>
  
  
  <?php
  //SUM TOTAL OF ALL BLOCK PAYMENT
  $sql = "SELECT SUM(price) AS grand_total FROM block_temp WHERE date_change BETWEEN $dfrom_timestamp AND $dto_timestamp ";
  $sql_result = $db->Execute($sql);
  while($r=$sql_result->FetchRow()){
  	$sum = $r['grand_total'];
  	$formatted_sum = number_format($sum, 2);
  	
  	 
  	}
  ?>
  
 
   
  
  
  
  
   
</table>
<table width="605" height="25" border="0" bgcolor="#CCCCFF">
  <tr>
    <td width="224"><strong>Sum</strong></td>
    <td width="185"><?php echo $formatted_sum; ?></td>
    
  </tr>
</table>
<input type="button" name="print" value="PRINT" onclick="window.print()" />

</form>
