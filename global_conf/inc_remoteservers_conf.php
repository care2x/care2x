<?php
# 
# Main domain or ip address
# for example, default is "localhost"
#
//$main_domain="192.168.0.9";

# 
# main ip addres of foto server 
# for example , default is "localhost"
#
//$fotoserver_ip="192.168.0.9";

#
# Http protocol, either http or https for ssl layer. Default is http (normal).
#
$httprotocol='http';

# Source mode of photos and images
# Set to 0 if fotos come via ftp server, set to 1 if fotos come from local  drive directory, default is 1
$disc_pix_mode=1; 

#
# FTP username and password for remote files and webcam images
#

$ftp_user="";
$ftp_pw="";

#######################################################################################
# Main url
$main_url="$httprotocol://$main_domain";

/*
this is the server address of the http foto server for patients, required for the preview, displaying, etc.
*/
//$fotoserver_http="http://".$fotoserver_ip."/fotos/";

$fotoserver_http="$httprotocol://$main_domain/fotos/";

/*
this is the server address of the ftp foto server for patients, required for probing the pics filenames, number, etc.
*/
//$fotoserver_ftp="ftp://192.168.0.2:21";

$fotoserver_ftp="ftp://".$fotoserver_ip.":21";

$fotoserver_localpath="fotos/encounter/";

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

$xray_film_server_http="$httprotocol://".$fotoserver_ip."/radiology/xrayfilms/";
$xray_diagnosis_server_http="$httprotocol://".$fotoserver_ip."/radiology/diagnosis/";

$xray_film_localpath="../../radiology/xrayfilms/";
$xray_diagnosis_localpath="../../radiology/diagnosis/";

$dicom_img_localpath='radiology/dicom_img/';

# Dicom path used for the Nagoya java applet dicom viewer
$dicom_img_http="$main_url/imed/radiology/dicom_img/";
/*
webcam http server address... the webcam files are deposited to this server through one or
several ftp servers with different ports
*/
$cam_http_1="http://192.168.11.158/view/index.shtml";
$cam_http_2="$httprotocol://$fotoserver_ip/iMed/modules/video_monitor/cam_img/";
$cam_http_3="$httprotocol://$fotoserver_ip/iMed/modules/video_monitor/cam_img/";
$cam_http_4="$httprotocol://$fotoserver_ip/iMed/modules/video_monitor/cam_img/";
$cam_http_5="";
$cam_http_6="";
$cam_http_7="";
$cam_http_8="";

/*
webcam ftp servers addresses for receiving webcam files from one or several webcamera upload servers
*/

?>
