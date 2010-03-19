<?php
 // get a  page into an array and print it out
 $fcontents = file ('copyrite.htm');
 while (list ($li, $line) = each ($fcontents)) {
     echo $line;
 }
 ?>
