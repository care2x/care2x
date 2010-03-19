<?php
/**
*  A help function to either create input elements for lab's intern entries or
*  to show the entries in case of status != pending
*  Used in pathology
*/
///$db->debug=true;
function printLabInterns($param)
{
   global $stored_request, $date_format;

		   if($stored_request['status']=="pending")
		   {
	           echo '
	                   <input type="text" name="'.$param.'" size=10 maxlength=10 value="';
			   
			   if($stored_request[$param]) echo $stored_request[$param];
			   
			   echo '">&nbsp;';
		    }
			else 
			{
			   echo '<font face="verdana" size=2 color="#000000">'.$stored_request[$param].'</font>';
			}

}

function printCheckBox($param,$printout=true)
{
   	global $stored_request, $root_path;
	
    if($stored_request[$param]==1) $buffer= '<img '.createComIcon($root_path,'chkbox_chk.gif','0','absmiddle',TRUE).'>';
	  else $buffer= '<img '.createComIcon($root_path,'chkbox_blk.gif','0','absmiddle',TRUE).'>';
	if($printout) echo $buffer;
		else return $buffer;
}

function printRadioButton($param,$value,$printout=true)
{
   	global $stored_request, $root_path;
	
    if($value ) 
	{
	   if($stored_request[$param]) $buffer= '<img '.createComIcon($root_path,'radio_chk.gif','0','absmiddle',TRUE).'>';
	   else $buffer='';
	}
	  elseif(!$stored_request[$param]) $buffer= '<img '.createComIcon($root_path,'radio_chk.gif','0','absmiddle',TRUE).'>';
	    else $buffer='';
	 
	if(empty($buffer)) $buffer= '<img '.createComIcon($root_path,'radio_blk.gif','0','absmiddle',TRUE).'>';
	
	if($printout) echo $buffer;
		else return $buffer;

}

/* The following routine creates the list of pending requests */
?> 

<script language="javascript" src="../../js/wz_tooltip/wz_tooltip.js"></script>

<?php

require_once($root_path.'include/care_api_classes/class_lab.php');
$lab_obj=new Lab();

if(!isset($tracker)||!$tracker) $tracker=1;

if($tracker>1)
{
   $requests->Move($tracker-2);
   $test_request=$requests->FetchRow();
   $requests->MoveFirst();
?>
<a href="<?php echo $thisfile.URL_APPEND."&target=".$target."&subtarget=".$subtarget."&pn=".$test_request['encounter_nr']."&batch_nr=".$test_request['batch_nr']."&user_origin=".$user_origin."&tracker=".($tracker-1); ?>"><img <?php echo createComIcon($root_path,'uparrowgrnlrg.gif','0','left',TRUE) ?> alt="<?php echo $LDPrevRequest ?>"></a>
<?php
}
if($tracker<$batchrows)
{
   $requests->Move($tracker);
   $test_request=$requests->FetchRow();
?>
<a href="<?php echo $thisfile.URL_APPEND."&target=".$target."&subtarget=".$subtarget."&pn=".$test_request['encounter_nr']."&batch_nr=".$test_request['batch_nr']."&user_origin=".$user_origin."&tracker=".($tracker+1); ?>"><img <?php echo createComIcon($root_path,'dwnarrowgrnlrg.gif','0','right',TRUE) ?>  alt="<?php echo $LDNextRequest ?>"></a>
<?php
}

$tracker=1;
echo "<br><br>";
$bgcolor="#D3E3F6";
$send_date="";

/* Display the list of pending requests */
$requests->MoveFirst();
while($test_request=$requests->FetchRow())
{
  //echo $tracker."<br>";
  list($buf_date,$x)=explode(" ",$test_request['send_date']);
  if($buf_date!=$send_date)
  {
     echo "<FONT size=2 color=\"#990000\"><b>".formatDate2Local($buf_date,$date_format)."</b></font><br>";
	 $send_date=$buf_date;
	 $enc_obj->loadEncounterData($test_request['encounter_nr']);
  	 $result=$enc_obj->encounter;
  	 //gjergji ... urgent is available only for chamlabor
  	 if($subtarget == trim('chemlabor') ) {
	  	 $urgent = $lab_obj->GetTestUrgent($test_request['batch_nr']);
	  	 $tmp = $urgent->FetchRow();
	  	 if($tmp['urgent'] == 1) $bgcolor="red"; else $bgcolor = "#D3E3F6";
  	 }
  	 $info = $result['name_last']. " " . $result['name_first'] . "<br>" . $result['encounter_date'] . "<br>" . $result['pid'];
  } 
  if($batch_nr!=$test_request['batch_nr'])
  {
  	   	$enc_obj->loadEncounterData($test_request['encounter_nr']);
  	   	$result=&$enc_obj->encounter;
  	 	//gjergji ... urgent is available only for chamlabor
  	 	if($subtarget == trim('chemlabor') ) {  	   	
		  	$urgent = $lab_obj->GetTestUrgent($test_request['batch_nr']);
		  	$tmp = $urgent->FetchRow();
	  	 	if($tmp['urgent'] == 1) $bgcolor="red"; else $bgcolor = "#D3E3F6";	
  	 	}		
  	   	$info = $result['name_last']. " " . $result['name_first'] . "<br>" . $result['encounter_date'] . "<br>" . $result['pid'];
        echo "<img src=\"".$root_path."gui/img/common/default/pixel.gif\" border=0 width=4 height=7> <a href=\"".$thisfile.URL_APPEND."&target=".$target."&subtarget=".$subtarget."&pn=".$test_request['encounter_nr']."&batch_nr=".$test_request['batch_nr']."&user_origin=".$user_origin."&tracker=".$tracker."\" onmouseover=\"Tip('". $info ."',BGCOLOR,'". $bgcolor ."')\" >".$test_request['batch_nr']." ".$test_request['room_nr']."</a><br>";
   }
   else
   {
   	
        echo "<img ".createComIcon($root_path,'redpfeil.gif','0','',TRUE)."> <FONT onmouseover=\"Tip('". $info ."',BGCOLOR,'". $bgcolor ."')\"  size=1 color=\"red\">".$test_request['batch_nr']." ".$test_request['room_nr']."</font><br>";
        $track_item=$tracker;
   }
   
   /* Check for the barcode png image, if nonexistent create it in the cache */
   if(!file_exists($root_path."cache/barcodes/en_".$test_request['encounter_nr'].".png"))
   {
	  echo "<img src='".$root_path."classes/barcode/image.php?code=".$test_request['encounter_nr']."&style=68&type=I25&width=180&height=50&xres=2&font=5&label=2&form_file=en' border=0 width=0 height=0>";
	}
   
  $tracker++;
}
/* Reset tracker to the actual request being shown */
$tracker=$track_item; 
?>
