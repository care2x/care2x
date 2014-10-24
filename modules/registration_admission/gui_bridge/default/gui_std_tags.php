<?php

function StdHeader()
{
	global $lang;
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php
}

function StdCopyright()
{

    global $lang, $root_path;
   
    if(file_exists($root_path.'language/'.$lang.'/'.$lang.'_copyrite.php')) include($root_path.'language/'.$lang.'/'.$lang.'_copyrite.php');
    else include($root_path.'language/en/en_copyrite.php');
}

function StdFooter()
{
?>
</BODY>
</HTML>
<?php
}
?>


