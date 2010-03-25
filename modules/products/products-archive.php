<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','products.php');
$local_user='ck_prod_arch_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

//$db->debug=1;

if(!isset($mode)) $mode='';
if(!isset($keyword)) $keyword='';

$thisfile='products-archive.php';
$searchfile=$thisfile;
switch($cat) {
	case 'pharma':	
				$title="$LDPharmacy $LDOrderArchive";
				$dbtable='care_pharma_orderlist';
				$breakfile=$root_path.'modules/pharmacy/apotheke.php'.URL_APPEND;
				break;
	case 'medlager':
				$title="$LDMedDepot $LDOrderArchive";
				$dbtable='care_med_orderlist';
				$breakfile=$root_path.'modules/med_depot/medlager.php'.URL_APPEND;
				break;
	default:  {header('Location:'.$root_path.'language/'.$lang.'/lang_'.$lang.'_invalid-access-warning.php'); exit;}; 
}

if($mode=='search')
{
	$keyword=trim($keyword);
	//if(($keyword=='')||($keyword=='%')||($keyword=='_')||(strlen($keyword)<2)) { header("location:$thisfile".URL_REDIRECT_APPEND."&invalid=1&cat=$cat&userck=$userck"); exit;}
	if(($keyword=='')||($keyword=='%')||($keyword=='_')) { header("location:$thisfile".URL_REDIRECT_APPEND."&invalid=1&cat=$cat&userck=$userck"); exit;}
	if($lang=='de')
	{
		if(stristr($keyword,'eilig')) $keyword='urgent';
	}
	if(!$ofset) $ofset=0;
	if(!$nrows) $nrows=20;
}

$linecount=0;

//this is the search module
if((($mode=='search')||$update)&&($keyword!=''))
{
	/* Load date & time formatter */
	include_once($root_path.'include/core/inc_date_format_functions.php');


	if($such_date)
	{
		switch(strtolower($date_format))
		{
			case 'yyyy-mm-dd' : $separator='-'; break;
			case 'mm/dd/yyyy' : $separator='/'; break;
			case 'dd.mm.yyyy' : $separator='.';
			default: $separator='';
		}

		$pc=substr_count($keyword,$separator);
			//echo $pc;
		if($pc)
		{
		/*
		switch($pc)
			{
				case 1:$sdt='%'.implode('.%',array_reverse(explode('.',$keyword)));break;
				case 2:$sdt='%'.implode('.%',array_reverse(explode('.',$keyword)));break;
				default:$sdt='%$keyword';
			}
		*/
		/*
			$sdt=formatDate2Std($keyword,$date_format);
			if(!empty($sdt)) $sdt='%'.$sdt;
		*/
		}
		elseif(strlen($keyword)>2)
		{
			$sdt=$keyword;
		}
		else
		{
			$sdt="________$keyword"; // 8 x _ to fill yyyy.mm.
		}

			$sdt=formatDate2Std($keyword,$date_format);
			if(!empty($sdt)) $sdt='%'.$sdt;

	}
	else
	{
		$sdt='';
	}

	($such_dept)? $sdp=$keyword : $sdp='';

	($such_prio)?  $spr=$keyword : $spr='';

	$sql="SELECT o.* FROM $dbtable AS o  LEFT JOIN care_department AS d  ON o.dept_nr=d.nr
								WHERE (";
	if($sdt) $sql = $sql."o.order_date = '$sdt'
											OR";
	$sql = $sql." o.dept_nr = ".(int)$sdp."
											OR ((d.name_formal = '$sdp' OR d.id = '$sdp') AND d.nr=o.dept_nr)
											OR o.priority = '$spr' )
											AND o.status='archive'
											ORDER BY o.order_date DESC,  o.order_time DESC";
											//LIMIT $ofset, $nrows";
	//echo $sql;

	if($ergebnis=$db->SelectLimit($sql,$nrows,$ofset)) $linecount=$ergebnis->RecordCount();			//count rows=linecount
	//reset result
	if(!$linecount)
	{
		($such_date && $dt)? $sdt.='%' : $sdt='';
		($such_dept)? $sdp.='%' : $sdp='';
		($such_prio)?  $spr.='%' : $spr='';

		$sql="SELECT o.* FROM $dbtable AS o  LEFT JOIN care_department AS d ON o.dept_nr=d.nr
									WHERE (";
		if($sdt) $sql = $sql."o.order_date $sql_LIKE '$sdt'
												OR";
		$sql = $sql." o.dept_nr $sql_LIKE '$sdp'
												OR ((d.name_formal $sql_LIKE '$sdp%' OR d.id $sql_LIKE '$sdp%') AND d.nr=o.dept_nr)
												OR o.priority $sql_LIKE '$spr')
												AND o.status='archive'
												ORDER BY o.order_date DESC,  o.order_time DESC";
												//LIMIT $ofset, $nrows";
		$linecount=0;
		if($ergebnis=$db->SelectLimit($sql,$nrows,$ofset)) {
			$linecount=$ergebnis->RecordCount();
		}
	}
	//echo $sql;
}// end of if(mode==search)

//echo $sql;

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

 # Title in the title bar
 $smarty->assign('sToolbarTitle',$title);

 # href for the back button
// $smarty->assign('pbBack',$returnfile);

 # href for the help button
 $smarty->assign('pbHelp',"javascript:gethelp('products.php','arch','','$cat')");

 # href for the close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$title);

 # Assign Body Onload javascript code
 $smarty->assign('sOnLoadJs','onLoad="document.suchform.keyword.select()"');

 # Collect javascript code
 ob_start()

?>

<script language="javascript" >
<!--

function pruf(d)
{
	kw=d.keyword;
	var k=kw.value; 
	//if(k=="") return false;
	if((k=="")||(k==" ")||(!(k.indexOf('%')))||(!(k.indexOf('&'))))
	{
		kw.value="";
		kw.focus();
		return false;
	}
	return true;
}
function show_order(d,o)
{
	urlholder="products-archive-orderlist-showcontent.php?sid=<?php echo "$sid&lang=$lang&userck=$userck"; ?>&cat=<?php echo $cat ?>&dept="+d+"&order_nr="+o;
	window.location.href=urlholder;
	}

// -->
</script> 

<?php 

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

?>

<ul>
<FONT size=3 color="#990000">
<?php if($from=="archivepass")
{
echo '<img '.createMascot($root_path,'mascot1_r.gif','0','bottom','absmiddle').'>';
$curtime=date('H.i');
if ($curtime<'9.00') echo $LDGoodMorning;
if (($curtime>'9.00')and($curtime<'18.00')) echo $LDGoodDay;
if ($curtime>'18.00') echo $LDGoodEvening;
echo ' '.$_COOKIE[$local_user.$sid];
}else echo '<br>';
?>
</font>
<p>

<?php require('included/inc_products_archive_search_form.php'); ?>

<hr width=80%>
<?php 
if($linecount>0){

	# Create the department object
	include_once($root_path.'include/care_api_classes/class_department.php');
	$dept_obj=new Department;
	if($depts=&$dept_obj->getAllActiveObject()){
		while($buf=$depts->FetchRow()){
			$dept[$buf['nr']]=$buf;
		}
	}

	echo '
			<p> ';
			if ($linecount>1) echo $LDListFoundMany; else echo $LDListFound; 
			 
			echo '.<br> '.$LDClk2SeeEdit.'<br></font><p>';

		$tog=1;
		echo '
				<table border=0 cellspacing=0 cellpadding=0 class="frame">
				<tr>
				<td colspan=2>
				<table border=0 cellspacing=1 cellpadding=3>
  				<tr class="wardlisttitlerow">';
		for ($i=0;$i<sizeof($LDArchindex);$i++)
		echo '
				<td><font color="#000080">'.$LDArchindex[$i].'</td>';
		echo '
				</tr>';	

		$i=$ofset+1;

		while($content=$ergebnis->FetchRow())
 		{
			if($tog)
			{ echo '<tr class="wardlistrow2">'; $tog=0; }else{ echo '<tr  class="wardlistrow1">'; $tog=1; }
			
/*			echo'
				<td>'.$i.'</td>
				<td><a href="javascript:show_order(\''.$content['dept'].'\',\''.$content['order_nr'].'\')"><img '.createComIcon($root_path,'uparrowgrnlrg.gif','0').' alt="'.$LDClk2SeeEdit.'"></a></td>
				<td >'.strtoupper($content['dept']).'</td>
				<td>';
*/			
            echo'
				<td>'.$i.'</td>
				<td><a href="products-archive-orderlist-showcontent.php'.URL_APPEND.'&userck='.$userck.'&cat='.$cat.'&dept_nr='.$content['dept_nr'].'&order_nr='.$content['order_nr'].'"><img '.createComIcon($root_path,'uparrowgrnlrg.gif','0').' alt="'.$LDClk2SeeEdit.'"></a></td>
				<td >';
				
				$buffer=$dept[$content['dept_nr']]['LD_var'];
				if(isset($$buffer)&&!empty($$buffer)) 	echo $$buffer;
					else echo $dept[$content['dept_nr']]['name_formal'];
				
				echo '
				</td>
				<td>';
				
			echo formatDate2Local($content['order_date'],$date_format).'</td>
			
				 <td>'.convertTimeToLocal(str_replace('24','00',$content['order_time'])).'</td>
				<td align="center">';
				
			if($content['status']=='normal')
				echo '&nbsp;';
				else if($content['priority']=='urgent')  echo '<img '.createComIcon($root_path,'warn.gif','0').' alt="'.$LDUrgent.'!">';

			echo '
					</td>';

			echo '
				 <td>'.str_replace('24','00',formatDate2Local($content['process_datetime'],$date_format)).' '.convertTimeToLocal(formatDate2Local($content['process_datetime'],$date_format,1,1)).'</td>
				 <td>'.$content['create_id'].'</td>
				</tr>';
			$i++;

 		}
		echo '
			</table>
			</td></tr><tr bgcolor="'.$cfg['body_bgcolor'].'">
			<td>';
		if($ofset) echo '	<form name=back action="'.$thisfile.'" method=post>
								<input type="hidden" name="keyword" value="'.$keyword.'">
        						<input type="hidden" name="mode" value="search">
        						<input type="hidden" name="such_date" value="'.$such_date.'">
                   				<input type="hidden" name="such_prio" value="'.$such_prio.'">
              					<input type="hidden" name="such_dept" value="'.$such_dept.'">
              					<input type="hidden" name="ofset" value="'.($ofset-$nrows).'">
                   				<input type="hidden" name="nrows" value="'.$nrows.'">
                       			<input type="hidden" name="sid" value="'.$sid.'">           
								<input type="hidden" name="lang" value="'.$lang.'">
                       			<input type="hidden" name="cat" value="'.$cat.'">           
								<input type="submit" value="&lt;&lt; '.$LDBack.'">
								</form>';
		echo "</td><td align=right>";
		if($linecount==$nrows) 
						echo '<form name=forward action="'.$thisfile.'" method=post>
								<input type="hidden" name="keyword" value="'.$keyword.'">
								<input type="hidden" name="mode" value="search">
        						<input type="hidden" name="such_date" value="'.$such_date.'">
              					<input type="hidden" name="such_dept" value="'.$such_dept.'">
                   				<input type="hidden" name="such_prio" value="'.$such_prio.'">
        						<input type="hidden" name="ofset" value="'.($ofset+$nrows).'">
              					<input type="hidden" name="nrows" value="'.$nrows.'">
                   				<input type="hidden" name="sid" value="'.$sid.'">     
								<input type="hidden" name="lang" value="'.$lang.'">
                       			<input type="hidden" name="cat" value="'.$cat.'">           
								<input type="submit" value="'.$LDContinue.' &gt;&gt;">
								</form>';
		echo '
			</td>
			</tr>	
			</table>';                            
}
else
{
if($ofset) echo '	<form name=back action="'.$thisfile.'" method=post>
								<input type="hidden" name="keyword" value="'.$keyword.'">
        						<input type="hidden" name="mode" value="search">
        						<input type="hidden" name="such_date" value="'.$such_date.'">
                   				<input type="hidden" name="such_prio" value="'.$such_prio.'">
              					<input type="hidden" name="such_dept" value="'.$such_dept.'">
              					<input type="hidden" name="ofset" value="'.($ofset-$nrows).'">
                   				<input type="hidden" name="nrows" value="'.$nrows.'">
                       			<input type="hidden" name="sid" value="'.$sid.'">           
                       			<input type="hidden" name="cat" value="'.$cat.'">           
								<input type="hidden" name="lang" value="'.$lang.'">
								<input type="submit" value="&lt;&lt; '.$LDBack.'">
								</form>';
							
if($mode=='search') echo '
	<table border=0>
   <tr>
     <td><img '.createMascot($root_path,'mascot1_r.gif','0','middle').'></td>
     <td>'.$LDNoDataFound.'<br>'.$LDPlsEnterMore.'</td>
   </tr>
 </table>';
 
	
}
if($invalid) echo'

	<table border=0>
   <tr>
     <td> <img '.createMascot($root_path,'mascot1_r.gif','0','middle').'>
		</td>
     <td>'.$LDNoSingleChar.'<br>'.$LDPlsEnterMore.'
</td>
   </tr>
 </table>';
	 ?>
<p><br>

<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  alt="<?php echo $LDClose ?>"></a>

</ul>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign the form template to mainframe

 $smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');
?>
