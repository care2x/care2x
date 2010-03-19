<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_remoteservers_conf.php",$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

/* 
main domain or ip address
*/
$main_domain="192.168.0.1";
/* 
main ip addres of foto server 
*/
$disc_pix_mode=0; // set to 0 if fotos come via ftp server, set to 1 if fotos come from local  drive directiory
//$fotoserver_ip="192.168.0.2";
$fotoserver_ip="192.168.0.5";

/*
this is the server address of the http foto server for patients, required for the preview, displaying, etc.
*/

//$fotoserver_http="http://".$fotoserver_ip."/fotos/";
$fotoserver_http="http://".$fotoserver_ip."/fotos/";
//  <META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

/*
this is the server address of the ftp foto server for patients, required for probing the pics filenames, number, etc.
*/
//$fotoserver_ftp="ftp://192.168.0.2:21";
$fotoserver_ftp="ftp://".$fotoserver_ip.":21";

$fotoserver_localpath="../fotos/";
/*
ip address of the ftp server (may be several)
*/
//$ftp_server=$fotoserver_ip;
$ftp_server=$fotoserver_ip;

/*
this is the server addresses of the http xray fotos server for patients, required for the preview, displaying, etc.
*/
//$xray_film_server_http="http://".$fotoserver_ip."/radiology/xrayfilm/";
//$xray_diagnosis_server_http="http://".$fotoserver_ip."/radiology/diagnosis/";
$xray_film_server_http="http://".$fotoserver_ip."/radiology/xrayfilms/";
$xray_diagnosis_server_http="http://".$fotoserver_ip."/radiology/diagnosis/";

/*
webcam http server address... the webcam files are deposited to this server through one or
several ftp servers with differeng ports
*/

/*
webcam ftp servers addresses for receiving webcam files from one or several webcamera upload servers
*/

?>
