<?php
/*
 * Created on Aug 16, 2005
 *
 * Example version file for application installer
 */
 
$versions = new VersionSet();

$version_0_2 = new Version('0.2');
$version_0_2->collectData('db_user', 'Database Username', 'text', 'root');
$version_0_2->collectData('db_password', 'Database Password', 'text', '');
$version_0_2->collectData('db_server', 'Database Server', 'text', 'localhost');
$version_0_2->collectData('db_port', 'Database Port', 'text', '3306');
$version_0_2->collectData('db_database', 'Database Name', 'text', '');
$version_0_2->addTest('PHPVersionOver', array('4.2.0'));
$version_0_2->addTest('PHPExtension', array('mysql', 'gd'));
$version_0_2->addTest('WritableLocation', array(dirname(__FILE__).'/test_replacement.txt', realpath(dirname(__FILE__).'/tmp')));
$version_0_2->addTest('MysqlVersionOver', array(
'username_field' => 'db_user',
'password_field' => 'db_password',
'server_field' => 'db_server',
'port_field' => 'db_port',
'version' => '4.0.1'));
$version_0_2->addAction('AcceptText', array(dirname(__FILE__).'/LICENSE'));
$version_0_2->addAction('SQLFile', array(
'username_field' => 'db_user',
'password_field' => 'db_password',
'server_field' => 'db_server',
'port_field' => 'db_port',
'db_field' => 'db_database',
'files' => array(realpath(dirname(__FILE__).'/sql').'/sureinvoice.sql')));
$version_0_2->addAction('ReplaceString', array(
'message' => "Saved database configuration information!",
'files' => array(dirname(__FILE__).'/test_replacement.txt'),
'fields' => array('INSTALL_DB_USERNAME' => 'db_user', 'INSTALL_DB_PASSWORD' => 'db_password'),
'strings' => array('TEST_STRING' => 'This is my test string text!')
));

$versions->add($version_0_2);

$version_0_3 = new Version('0.3');
$version_0_3->addAction('SQLFile', array(
'username_field' => 'db_user',
'password_field' => 'db_password',
'server_field' => 'db_server',
'port_field' => 'db_port',
'db_field' => 'db_database',
'files' => array(realpath(dirname(__FILE__).'/sql').'/update-0.2-0.3.sql')));
$versions->add($version_0_3);

$version_0_4 = new Version('0.4');
$version_0_4->addAction('SQLFile', array(
'username_field' => 'db_user',
'password_field' => 'db_password',
'server_field' => 'db_server',
'port_field' => 'db_port',
'db_field' => 'db_database',
'files' => array(realpath(dirname(__FILE__).'/sql').'/update-0.3-0.4.sql')));
$versions->add($version_0_4);
?>
