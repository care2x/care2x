<?php
/**
 * A little helper script that changes department status and activity.
 * when finished, redirect to configuration list dept_list_config.php
 *
 *
 * Author: Kurt Brauchli <kurt.brauchli@unibas.ch>
 */

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

# The following 2 lines are for the permission checking: EL - 2004-04-19
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');

//$db->debug=1;

/*  2004-04-19 Elpidio had removed the db link creation coz deprecated */

  $sql = "UPDATE care_department SET ";

  # Detect php version and change to *GET variables for backward compat to php 4.0.x
  # and added security
  #
  # This might need to be optimized ???
  
  if(stristr(substr(PHP_VERSION,0,3),'4.0')){
      if( isset($_GET['status']) )
        $sql .= " status='".$_GET['status']."', ";

      if( isset($_GET['active']) )
        $sql .= " is_inactive='".(1-$_GET['active'])."', ";

      $sql .= " modify_id='".$_SESSION['sess_user_name']."' ".
        " WHERE nr='".$_GET['nr']."'";
  }else{
      if( isset($_REQUEST['status']) )
        $sql .= " status='".$_REQUEST['status']."', ";

      if( isset($_REQUEST['active']) )
        $sql .= " is_inactive='".(1-$_REQUEST['active'])."', ";

      $sql .= " modify_id='".$_SESSION['sess_user_name']."' ".
        " WHERE nr='".$_REQUEST['nr']."'";
  }

  $db->Execute($sql);

# Appended the constant that contains the lang and sid values
header( "Location: dept_list_config.php".URL_REDIRECT_APPEND);
//exit;
?>
