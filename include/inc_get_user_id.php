<?php
 /* Get the current user id depending on currently logged user  */
if($_SESSION['sess_level2_logged'] && $_SESSION['sess_level2_user_id']) {
    $user_id = $_SESSION['sess_level2_user_id'];
} elseif ($_SESSION['sess_level1_logged'] && $_SESSION['sess_level1_user_id']) {
    $user_id = $_SESSION['sess_level2_user_id'];
} elseif ($_SESSION['sess_user_id']) {
    $user_id = $_SESSION['sess_user_id'];
} else {
    $user_id = $_COOKIE['ck_config'];
}
?>
