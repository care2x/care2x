<?php

function StdHeader()
{
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php
}

function StdCopyright()
{

    global $lang;
   
    if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php')) include('../language/'.$lang.'/'.$lang.'_copyrite.php');
    else include('../language/en/en_copyrite.php');
}

function StdFooter()
{
?>
</BODY>
</HTML>
<?php
}
?>


