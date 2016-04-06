<?php
function connect_db()
{
	$linkdb=mysql_connect("localhost","root","") or
	die ("<META http-equiv='refresh' content='0'>");
	mysql_select_db ("caredb") or
	die ("<META http-equiv='refresh' content='0'>");
	
}

function connect_db1()
{
	$linkdb=mysql_connect("localhost","root","") or
	die ("<META http-equiv='refresh' content='0'>");
	mysql_select_db ("caredb") or
	die ("<META http-equiv='refresh' content='0'>");
	
}
function disconnect_db()
{
	
	$linkdb=mysql_connect("","root","");
       	mysql_close($linkdb) or
	die ("<META http-equiv='refresh' content='0' >");
   

}
?>
