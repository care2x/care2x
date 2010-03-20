<?PHP

require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require($root_path.'global_conf/inc_remoteservers_conf.php');
$local_user='ck_fotolab_user';


require_once($root_path.'include/care_api_classes/class_image.php');

$img=new Image;
$disc_pix_mode = true;

if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');
if(!$dblink_ok) {
  print "ERROR: db not ready.\n";
  exit;
}

$userid = $_REQUEST['userid'];
$keyword = $_REQUEST['keyword'];


// if $GUI not set, use text/plain for answers
if( !isset($_REQUEST['GUI']) ){
     header( "Content-Type: text/plain" );
     $CRLF = "\n";
} else {
  $CRLF = "<br />\n";
}
	

$sql='SELECT * FROM care_users WHERE login_id="'.addslashes($userid).'"';
if($ergebnis=$db->Execute($sql))
{
  $zeile=$ergebnis->FetchRow();  
  if( !(($zeile['password']==md5($keyword))&&($zeile['login_id']==$userid)) )
    {
      print "ERROR: Authorization failed$CRLF";
      if( !isset($_REQUEST['GUI']) )
	  exit;
    }
}



if( $_REQUEST["function"]=="save" )
{

  // check for encounter
  $sql = "SELECT * FROM care_encounter ".
    " WHERE encounter_nr='".$_REQUEST["encounter_nr"]."'";
  $result = $db->Execute( $sql );
  if( !($row = $result->FetchRow()) )
    {
      print "ERROR$CRLF".
	"no patient folder for encounter no '".$_REQUEST["encounter_nr"]."'$CRLF";
      if( !isset($_REQUEST['GUI']) )
	  exit;
    }
  else
    {
      // Set the encounter as the directory name		
      $picdir = $_REQUEST["encounter_nr"];
      
      if($disc_pix_mode){
	$d = $root_path.$fotoserver_localpath.$picdir;
      }
      
      //DEBUG: print "saving to $d ... $CRLF";
     // $db->debug=true;

      if( $img->isValidUploadedImage($_FILES['imagefile']) )
	{ 
	  $data=array('encounter_nr'=>$_REQUEST["encounter_nr"],
		      'upload_date'=>date('Y-m-d'),
		      'history'=>"Upload ".date('Y-m-d H:i:s')." ".$userid."\n",
		      'modify_time'=>0,
		 	'create_id'=>$userid,
		      'create_time'=>date('YmdHis'));

	  $picext = strtolower($img->UploadedImageMimeType());
	  if(stristr($picext,'gif')||stristr($picext,'jpg')||stristr($picext,'png'))
	    {
	      $data['shot_date'] = date("Y-m-d");
	      $data['shot_nr']   = 1;
	      $data['mime_type'] = $picext;
	 
	      if($pknr = $img->saveImageData($data)){
		
	      	# Find the last inserted primary key based on the db type
		/*switch($dbtype){
			case "postgres": $picnr=$img->postgre_Insert_ID('care_encounter_image','nr',$pknr); break;
			case "postgres7": $picnr=$img->postgre_Insert_ID('care_encounter_image','nr',$pknr); break;
			# default is mysql $picnr == $picnr;
		}*/
		$picnr = $img->LastInsertPK('nr',$pknr);

		$picfilename = $picnr.'.'.$picext;
	   
		if($disc_pix_mode)
		  {
		    if(!is_dir($d)){
		      // if $d directory not exist create it with CHMOD 777
		      mkdir($d,0777); 
		      // Copy the trap files to this new directory
		      copy($root_path.'fotos/encounter/donotremove/index.htm', 
			   $d.'/index.htm');
		      copy($root_path.'fotos/encounter/donotremove/index.php', 
			   $d.'/index.php');
		    }
		    // Store to the newly created directory
		    $dir_path = $d.'/';
		  }
		else
		  {
		    // Store to cache directory
		    $dir_path = $root_path.'cache/';
		  }
		// Save the uploaded image
		$img->saveUploadedImage( $_FILES['imagefile'],
					 $dir_path, $picfilename );
	   
		print "saved to $dir_path$picfilename$CRLF";
	      } else {
		echo $img->getLastQuery();
	      }
	    }
	  
	  
	  if( !isset($_REQUEST['GUI']) )
	    exit;
	} else {
	  echo "Possible file upload attack:";
	}
    }
} 

else if( $_REQUEST["function"]=="getinfo" )
{
  // check for encounter
  $sql = "SELECT e.encounter_nr, e.pid, e.encounter_date, ".
    "            p.name_first, p.name_last, p.date_birth ".
    " FROM care_encounter e, care_person p ".
    " WHERE p.pid=e.pid ".
    " AND e.encounter_nr='".$_REQUEST["encounter_nr"]."'";

  $result = $db->Execute( $sql );
if(is_object($result)){
  if( ($row = $result->FetchRow()) )
    {
      print "PID: ".$row['pid']."$CRLF".
	$row['name_first']." ".$row['name_last']." (".
	$row['date_birth'].")$CRLF".
	"at: ".$row['encounter_date']."$CRLF";
      if( !isset($_REQUEST['GUI']) )
	  exit;
    }
  else
    {
      print "ERROR: no encounter with id='".$_REQUEST["encounter_nr"]."'$CRLF";
      if( !isset($_REQUEST['GUI']) )
	  exit;
    }
  }else{
  	echo "Encounter nr. not found";
	exit;
  }
}



?>

<hr>

<h3>uplaod image</h3>

<form method="post" enctype="multipart/form-data">
<INPUT type="hidden" name="GUI" value="yes">
<input type=radio name="function" value="getinfo">info
<input type=radio name="function" value="save">save<br />
encounter_nr: <input name="encounter_nr" value=""><br />
<input type=file size=40 maxlength=2000000 name='imagefile' accept='image/*'><br />
<input type=submit>
</form>
