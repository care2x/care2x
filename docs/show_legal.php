<?php
if(file_exists('../language/'.$_GET['lang'].'/'.$_GET['lang'].'_legal.htm')) {
    $page = '../language/'.$_GET['lang'].'/'.$_GET['lang'].'_legal.htm';
} else {
	$page = '../language/en/en_legal.htm';
}

header("Location: $page");
exit;
	
?>
