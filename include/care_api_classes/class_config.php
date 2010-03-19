<?php
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
require_once($root_path.'include/care_api_classes/class_userconfig.php');


if($_SESSION['sess_level2_logged'] && $_SESSION['sess_level2_user_id']) {
    $user_id = $_SESSION['sess_level2_user_id'];
} elseif ($_SESSION['sess_level1_logged'] && $_SESSION['sess_level1_user_id']) {
    $user_id = $_SESSION['sess_level1_user_id'];
} elseif ($_SESSION['sess_user_id']) {
    $user_id = $_SESSION['sess_user_id'];
} else {
    $user_id = $_COOKIE['ck_config'];
}
?>
