<label>
<?php echo $LDDateFrom; ?>
</label>

<input name="date_from" type="text" size=10 maxlength=10 value="<?php echo $_POST['date_from']?>">
<a href="javascript:show_calendar('form1.date_from','<?php echo $date_format ?>')">
    <img <?php echo createComIcon($root_path, 'show-calendar.gif', '0', 'absmiddle'); ?>></a>

<label>
<?php echo $LDDateTo; ?>
</label>
<input name="date_to" type="text" size=10 maxlength=10 value="<?php echo $_POST['date_to']?>" >
<a href="javascript:show_calendar('form1.date_to','<?php echo $date_format ?>')">
    <img <?php echo createComIcon($root_path, 'show-calendar.gif', '0', 'absmiddle'); ?>></a>

<font size=1>[<?php
$dfbuffer = "LD_" . strtr($date_format, ".-/", "phs");
echo $$dfbuffer;
?>]
<select name="paytype">
   <option value=0>CASH</option>
   <option value=1>CREDIT</option>
</select>

<?php
switch($_POST['paytype']){
   case 0:
    $payment_type="CASH";
    break;

   case 1:
     $payment_type="CREDIT";
     break;

   default:
     $payment_type="UNKNOWN";
     break;
     
}
$sql_loc  ="SELECT loccode, locationname FROM locations";
$result   =$db->execute($sql_loc);

$data=array();
while($row_loc=$result->FetchRow()){
      $data['loc'][]=$row_loc; 
}
$row_qty=count($data['loc']);


if(isset($_POST['show'])){
    $sql_selected="SELECT loccode, locationname FROM locations WHERE loccode='".$_POST['stockloc']."'";
    $result_selected=$db->Execute($sql_selected);
    if($row_selected=$result_selected->FetchRow()){
       $first_option='<option value='.$row_selected['loccode'].'>'.$row_selected['locationname'].'</option>';
       $first_option.='<option value="all">'.ALL.'</option>';
       }else{
          $first_option='<option value="all">'.ALL.'</option>';
        }

}else{
   $first_option='<option value="all">'.ALL.'</option>';
 }

?>
<select name="stockloc">
<?php 
echo $first_option;
for($i=0; $i<$row_qty; $i++){
echo $options='<option value='.$data['loc'][$i]['loccode'].'>'.$data['loc'][$i]['locationname'].'</option>';

} 
?>
</select>	
 <label><input type="submit" name="show" value="<?php echo $LDShow;?>"</label>
    

				



