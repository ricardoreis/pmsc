<?php

/*	Configurações que alteram de servidor para servidor	*/
//	Servidor de Teste	//
$db_type = 'Pdo_Mysql';
$db_host = 'localhost';
$db_user = 'pmscs';
$db_pass = '83MZ6841dcF4WT';
$db_name = 'pmscs';

$mail_host = 'ssl://smtp.gmail.com';
$mail_port = 465;
$mail_user = 'google@dropweb.com.br';
$mail_pass = 'drop0908';

$_root_url = 'http://' . $_SERVER['HTTP_HOST'] . '/clientes/pmscs.rs.gov.br/';
//	=================	//

/*//	Servidor local	//
$db_type = 'Pdo_Mysql';
$db_host = 'localhost';
$db_user = 'root';
$db_pass = 'r300469';
$db_name = 'rossattogarden';

$mail_host = 'ssl://smtp.gmail.com';
$mail_port = 465;
$mail_user = 'google@dropweb.com.br';
$mail_pass = 'drop0908';

$_root_url = 'http://' . $_SERVER['HTTP_HOST'] . '/clientes/rossattogardencenter.com.br/';
//	==============	//*/
/*	======================	*/

//$mail_from = 'noreply@pmscs.rs.gov.br';
$mail_from = 'atendimento@dropweb.com.br';
$mail_from_name = utf8_decode('Prefeitura de Santa Cruz do Sul');

//@define('PRODUTOS_FOTOS_DIR', dirname(__FILE__) . '/uploads/produtos/fotos/');

$admin_root = "admin/";

include dirname(__FILE__) . '/funcoes.php';

?>