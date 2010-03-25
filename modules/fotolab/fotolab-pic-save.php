<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','specials.php');
$local_user='ck_fotolab_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

# Load date formatter
include_once($root_path.'include/core/inc_date_format_functions.php');
				
# If data incomplete go back to select page
if(!$patnum||!$firstname||!$lastname||!$bday||!$maxpic)	{
	header("Location:fotolab-dir-select.php?sid=$sid&lang=$lang&maxpic=$maxpic&nopatdata=1"); 
	exit;
}; 
require($root_path.'global_conf/inc_remoteservers_conf.php');

require_once($root_path.'include/care_api_classes/class_image.php');
$img=new Image;


$dirselectfile='fotolab-dir-select.php';
$breakfile="javascript:window.parent.location.replace('".$root_path."main/spediens.php?sid=$sid&lang=$lang')";

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDFotoLab);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('fotolab.php','save','')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDFotoLab);

# Collect js code

ob_start();
?>

<script language="javascript">
<!-- 

function previewpic(fn) {
if(fn=="") return;
else parent.PREVIEWFRAME.document.previewpic.src=fn;

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

<p>

<?php	
echo "[$patnum] $lastname, $firstname ($bday)<p>";
echo "<font color=\"#cc0000\">$LDPicsSaved</font>";
 ?><p>


<?php
$picfilename=array();
if($maxpic){
?>
<table border=0>
<?php

	# Set the encounter as the directory name		
		$picdir=$patnum;
		
		if($disc_pix_mode){
			$d=$root_path.$fotoserver_localpath.$picdir;
		}
		
		$data=array('encounter_nr'=>$patnum,
									'upload_date'=>date('Y-m-d'),
									'history'=>"Upload ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n",
									'modify_id'=>'',
									'modify_time'=>0,
									'create_id'=>$_SESSION['sess_user_name'],
									'create_time'=>date('YmdHis'));
		
		for ($i=0;$i<$maxpic;$i++)
		{
		   $picfile='picfile'.$i;
		   $shotdate='sdate'.$i;
		   $shotnr='nr'.$i;//echo $shotnr."<br>";
		   //echo $picfile.' '.$shotdate.' '.$shotnr;
		   # Check the image
		   if(!$img->isValidUploadedImage($_FILES[$picfile])) continue;
		   # Get the file extension
		  $picext=$img->UploadedImageMimeType();

		   $picext=strtolower($picext);
		   if(stristr($picext,'gif')||stristr($picext,'jpg')||stristr($picext,'png'))
		   {
				$data['shot_date']=formatDate2Std($$shotdate,$date_format);
				$data['shot_nr']=$$shotnr;
				$data['mime_type']=$picext;
									
				if($insid=$img->saveImageData($data)){

			 	# Get the last inserted primary key
				
				$picnr = $img->LastInsertPK('nr',$insid);

				$picfilename[$i]=$picnr.'.'.$picext;
		
		      		echo '<tr><td>'.$_FILES[$picfile]['name'].'</td><td> <img '.createComIcon($root_path,'fwd.gif','0','absmiddle').'> ';
		       		if($disc_pix_mode)
		       		{
			      		if(!is_dir($d)){
							# if $d directory not exist create it with CHMOD 777
							mkdir($d,0777); 
							# Copy the trap files to this new directory
							copy($root_path.'uploads/photos/encounter/donotremove/index.htm',$d.'/index.htm');
							copy($root_path.'uploads/photos/encounter/donotremove/index.php',$d.'/index.php');
						}
						# Store to the newly created directory
						$dir_path=$d.'/';
		       		}
		       		else
		       		{
						# Store to cache directory
						$dir_path=$root_path.'cache/';
			   		}
					# Save the uploaded image
					$img->saveUploadedImage($_FILES[$picfile],$dir_path,$picfilename[$i]);
					
		       		echo '<font color="#cc0000"><a href="javascript:previewpic(\'';
		       		if($disc_pix_mode) echo $root_path.$fotoserver_localpath; else echo $fotoserver_http;
		       		echo $picdir.'/'.$picfilename[$i].'\')">'.$picfilename[$i].'</a></font>';
 		       		echo '</td></tr>';	
 		       		//echo '<hr>';	
			   }else{
			   		echo $img->getLastQuery();
				}
		   }
		}
	
$filelist=array();

/**
* If the variable disc_pix_mode in the inc_remoteservers_conf.php file is not set
* send the pictures to a  server via ftp protocol
* Note: the ftp server address must set configured in the inc_remoteservers_conf.php
*/
if(!$disc_pix_mode)
 {
 	# The ftp username and password should be set here
	$user='maryhospital_fotolabor';
	$pw='bong';
	
	$conn_id = ftp_connect($ftp_server); 
	if($conn_id)
	{
		// login with username and password
		$login_result = ftp_login($conn_id, $user, $pw); 

		if($login_result)
		{ 
			$curdir=ftp_pwd($conn_id);
			//ftp_chdir($conn_id,"$curdir/");
			//echo $curdir."<br>";
			// now attempt to cd to picdir
			$filelist=ftp_nlist($conn_id,"$curdir/");
			if($filelist)
			{
				//while(list($x,$v)=each($filelist)) echo $v."<br>";
				if(in_array(strtolower($picdir),$filelist))
			 	{
					if(ftp_chdir($conn_id,"$picdir/"))	$cdok=1;
					else
					{
						if(ftp_mkdir($conn_id,$picdir))
						{
						 	if(ftp_chdir($conn_id,"$picdir/"))	$cdok=1;
						}
					}			
				}
				else
				{
					if(ftp_mkdir($conn_id,$picdir))
					{
					 	if(ftp_chdir($conn_id,"$picdir/"))	$cdok=1;
					}
				}	
				if($cdok)
				{
					reset($picfilename);
					for($i=0;$i<$maxpic;$i++)	
					{
						if($picfilename[$i]=='') continue;
					 	if (ftp_put($conn_id,$picfilename[$i],$root_path.'cache/'.$picfilename[$i],FTP_BINARY))
						 {
			 				if(empty($mainidx)||($i<>$mainidx))
							{
								# If the ftp save was successful, remove the image file from the cache
								$removefile='unlink("'.$root_path.'cache/'.$picfilename[$i].'");';
								eval($removefile);
							}
						}		
					}
				}
			}
		  	else	echo $LDLinkBroken;
			ftp_quit($conn_id); 
		}
	}
 }
?>
</table>
<?php
}
?>
&nbsp;
<p>
<font color="#cc0000"><b><?php echo "$LDSave $LDOptions:" ?></b></font>
<form action="<?php echo $dirselectfile ?>" method="post">
<img <?php echo createComIcon($root_path,'video.gif','0') ?>><br><?php echo "$LDSave " ?><?php echo $LDAdditional ?> 
<input type="text" name="maxpic" size=1 maxlength=2 value="<?php echo $maxpic ?>"> <?php echo $LDMorePics ?>:<input type="submit" value="<?php echo $LDGO ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="patnum" value="<?php echo $patnum ?>">
<input type="hidden" name="lastname" value="<?php echo $lastname ?>">
<input type="hidden" name="firstname" value="<?php echo $firstname ?>">
<input type="hidden" name="bday" value="<?php echo $bday ?>">
<input type="hidden" name="lastnr" value="<?php $lastnr='nr'.($maxpic-1); echo $$lastnr; ?>">
<input type="hidden" name="same_pat" value="1">

</form>
<p>

<form action="upload_search_patient.php" method="post">
<img <?php echo createComIcon($root_path,'video.gif','0') ?>><br><?php echo $LDSave ?><input type="text" name="aux1" size=1 maxlength=2 value="<?php echo $maxpic ?>">
<?php echo $LDNewPics ?>:<input type="submit" value="<?php echo $LDGO ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
</form>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign page output to the mainframe template

$smarty->assign('sMainFrameBlockData',$sTemp);
 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
