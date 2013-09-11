<?php

@header('Content-Type: text/html; charset=utf-8');

/*	Inicializa o Zend Framework	*/
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] . '/ZendFramework/library');
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] . '/ZendFramework/extras/library');

require_once 'Zend/Db.php';
require_once 'Zend/Feed.php';
/*	===========================	*/

/*	Classes e arquivos a serem utilizados pelos scripts	*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/class.phpmailer.php';

/*	Conecta-se ao banco de dados	*/
try {
	$DBConn = Zend_Db::factory($db_type, array('host' => $db_host,
											   'username' => $db_user,
											   'password' => $db_pass,
											   'dbname' => $db_name));
} catch (Zend_Db_Adapter_Exception $e) {
	echo 'Erro no sistema! ' . $e->getMessage();
	exit();
}
/*	============================	*/

if (!function_exists('get_id_usuario')) {
/*	Funções para retornar e setar o ID do usuário	*/
function get_id_usuario () { global $_SESSION; return (int)(@$_SESSION['id_usuario']); }
function set_id_usuario ($id_usuario) { global $_SESSION; return ($_SESSION['id_usuario'] = $id_usuario); }
/*	=============================================	*/

/*	Funções para login	*/
function login ($login, $senha) {
	global $DBConn;

	$sql = "SELECT id_usuarios id_usuario
			FROM usuarios
			WHERE (login = " . $DBConn->quote($login) . " OR email = " . $DBConn->quote($login) . ") AND
				  senha = " . $DBConn->quote($senha);

	if (strlen($login) && strlen($senha) && ($q = $DBConn->query($sql)) && ($r = $q->fetch())) {
		$id_usuario = $r['id_usuario'];
	} else {
		$id_usuario = NULL;
	}

	set_id_usuario($id_usuario);

	return logado();
}

function logout () {
	global $_root_url, $admin_root;

	set_id_usuario(NULL);
	header('location: ' . $_root_url . $admin_root . 'login');
	exit();
}

function logado () { return get_id_usuario() > 0; }

function autorizado ($modulo) {
	global $DBConn;

	$result = false;

	if (logado()) {
		$sql = "SELECT 1
				FROM usuarios_permissoes
				WHERE id_usuarios = " . $DBConn->quote(get_id_usuario()) . " AND
					  modulo = " . $DBConn->quote($modulo);

		$result = ($q = $DBConn->query($sql)) && ($r = $q->fetch());
	}

	return $result;
}

function verifica_logado () {
	if (!logado()) {
		$qs = $_SERVER['QUERY_STRING'];
		header('location: login.php?continue=' . rawurlencode(basename($_SERVER['PHP_SELF']) . (strlen($qs) ? '?' . $qs : '')));
		exit();
	}
}

function get_usuario_data () {
	global $DBConn;

	$sql = "SELECT u.nome,
				   u.email
			FROM usuarios u
			WHERE u.id_usuarios = " . $DBConn->quote(get_id_usuario());

	return logado() && ($q = $DBConn->query($sql)) && ($r = $q->fetch()) ? $r : false;
}
/*	===================	*/

/*	Função para converter tamanho de arquivo em formato legível para o usuário	*/
function PHP_Conf_convert_filesize ($fs) {
	$l = substr($fs, -1);
	$ret = (int)($fs);

	switch (strtoupper($l)) {
		case 'Y': $ret *= 1024;
		case 'P': $ret *= 1024;
		case 'T': $ret *= 1024;
		case 'G': $ret *= 1024;
		case 'M': $ret *= 1024;
		case 'K': $ret *= 1024; break;
	}

	return $ret;
}

function get_user_readable_filesize ($fs) {
	$fsl = array('bytes', 'KB', 'MB', 'GB', 'PB', 'YB');
	$y = 0;
	while ($fs >= 1024) {
		$fs /= 1024;
		$y++;
	}
	return number_format($fs, $y ? 2 : 0, ',', '.') . ' ' . $fsl[$y];
}
/*	==========================================================================	*/

/*	Função para criar lista de números de páginas para navegação nas telas de busca	*/
function get_paginacao_links_paginas ($sql, $url) {
	global $DBConn, $pagina, $paginacao;

	//	Variáveis a serem utilizadas pelo script	//
	$result = '';
	$pre = -1;
	//	========================================	//

	//	Calcula o número de páginas	//
	$n = is_numeric($sql) ? $sql : (is_string($sql) && ($q = $DBConn->query($sql)) && ($rows = count($q->fetchAll())) ? ceil($rows / $paginacao) : 0);

	//	Cria os números de páginas que servirão para criar os links de paginação	//
	$np = array();
	for ($i=1; $i<=3; $i++) if (!in_array($i, $np) && $i > 0 && $i <= $n) $np[] = $i;
	for ($i=$pagina-3; $i<=$pagina+3; $i++) if (!in_array($i, $np) && $i > 0 && $i <= $n) $np[] = $i;
	for ($i=$n-2; $i<=$n; $i++) if (!in_array($i, $np) && $i > 0 && $i <= $n) $np[] = $i;
	//	========================================================================	//

	//	Cria o HTML dos links das setas na parte esquerda dos números de páginas	//
	if ($pagina > 1) {
		if ($pagina > 2) $result .= '<a href="' . $url . '/pagina/' . 1 . '" title="' . 1 . '">' . '&lt;&lt;' . '</a> ';
		$result .= '<a href="' . $url . '/pagina/' . ($pagina-1) . '" title="' . ($pagina-1) . '">' . '&lt;' . '</a> ';
	}
	//	========================================================================	//

	//	Cria o HTML dos links dos números de páginas	//
	foreach ($np as $k => $i) {
		if (is_integer(@$np[$pre]) && $i - $np[$pre] > 1) $result .= '<a>...</a>';

		$result .= '<a href="' . $url . '/pagina/' . $i . '" title="' . $i . '"' . ($i == $pagina ? ' class="atual"' : '') . '>' . $i . '</a>';

		$pre = $k;
	}
	//	============================================	//

	//	Cria o HTML dos links das setas na parte direita dos números de páginas	//
	if ($pagina < $n) {
		$result .= ' <a href="' . $url . '/pagina/' . ($pagina+1) . '" title="' . ($pagina+1) . '">' . '&gt;' . '</a>';
		if ($n - $pagina > 1) $result .= ' <a href="' . $url . '/pagina/' . $n . '" title="' . $n . '">' . '&gt;&gt;' . '</a>';
	}
	//	=======================================================================	//

	$result .= '<div class="clear"></div>';

	return $result;
}
/*	===============================================================================	*/

/*	Formata o string para utlização em URL amigável	*/
function urls_amigaveis_formata_string ($s) {
	$s = preg_replace('/[\-]+$/', '', strtr(trim($s), "()!$'?: ,&+-/.", "--------------"));

	$s = htmlentities($s);
	$s = strtolower($s);
	$s = preg_replace("/&([a-z])[a-z]+;/i", "$1", $s);
	$s = str_replace("--", "-", $s);

	return $s;
}
/*	===============================================	*/

/*	Funções para validação de CPF e CNPJ	*/
function validaCPF ($cpf) {
	// Verifiva se o número digitado contém todos os digitos
    $cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
	
	// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
    if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' ||
							  $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') return false;
	else {   // Calcula os números para verificar se o CPF é verdadeiro
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;

            if ($cpf{$c} != $d) return false;
        }

        return true;
    }
}

function validaCNPJ ($cnpj) { 
	$cnpj = preg_replace('/[^\d]/', '', $cnpj);

	if (strlen($cnpj) <> 14) return false;

	$soma1 = ($cnpj[0] * 5) + ($cnpj[1] * 4) + ($cnpj[2] * 3) + ($cnpj[3] * 2) + ($cnpj[4] * 9) + ($cnpj[5] * 8) + ($cnpj[6] * 7) + ($cnpj[7] * 6) + 
			 ($cnpj[8] * 5) + ($cnpj[9] * 4) + ($cnpj[10] * 3) + ($cnpj[11] * 2);

	$resto = $soma1 % 11;
	$digito1 = $resto < 2 ? 0 : 11 - $resto;

	$soma2 = ($cnpj[0] * 6) + ($cnpj[1] * 5) + ($cnpj[2] * 4) + ($cnpj[3] * 3) + ($cnpj[4] * 2) + ($cnpj[5] * 9) + ($cnpj[6] * 8) + ($cnpj[7] * 7) +
			 ($cnpj[8] * 6) + ($cnpj[9] * 5) + ($cnpj[10] * 4) + ($cnpj[11] * 3) + ($cnpj[12] * 2);

	$resto = $soma2 % 11;
	$digito2 = $resto < 2 ? 0 : 11 - $resto;

	return (int)(preg_replace('|^[0]+$|', '', $cnpj)) != 0 && $cnpj[12] == $digito1 && $cnpj[13] == $digito2;
}

function telefone_formata ($t) {
	$result = false;
	$x = array();

	$mask1 = '|^(\d{2})(\d{4})(\d{4})$|';
	$mask2 = '|^(\d{2})(\d{5})(\d{4})$|';
	$mask3 = '|^(\d{4})(\d{4})$|';

		if (preg_match($mask1, $t, $x)) $result = '(' . $x[1] . ') ' . $x[2] . '-' . $x[3];
	elseif (preg_match($mask2, $t, $x)) $result = '(' . $x[1] . ') ' . $x[2] . '-' . $x[3];
	elseif (preg_match($mask3, $t, $x)) $result = $x[1] . '-' . $x[2];

	return $result;
}
/*	====================================	*/

/*	Função para transformar os strings de um array em UTF8 decoded	*/
function is_utf8 ($str) {
    $len = strlen($str);

    for ($i=0; $i<$len; $i++){
        $c = ord($str[$i]);

        if ($c > 128) {
	            if ($c > 247) return false;
            elseif ($c > 239) $bytes = 4;
            elseif ($c > 223) $bytes = 3;
            elseif ($c > 191) $bytes = 2;
            else return false;

            if (($i + $bytes) > $len) return false;

            while ($bytes > 1) {
                $i++;
                $b = ord($str[$i]);
                if ($b < 128 || $b > 191) return false;
                $bytes--;
            }
        }
    }

    return true;
}

function string_utf8_decode ($s) { return is_string($s) && is_utf8($s) ? utf8_decode($s) : $s; }

function array_utf8_decode ($a) {
	foreach ($a as $k => $v) {
		$a[$k] = is_array($v) ? array_utf8_decode($v) : string_utf8_decode($v);
	}

	return $a;
}
/*	==============================================================	*/

@define(S_DEFAULT, 'Palavra-chave');

@define('ORDER_BY_TEMPLATE', 'order-by/%s/%s/');
@define('ORDER_BY_ASC', 'asc');
@define('ORDER_BY_DESC', 'desc');

$_POST = array_utf8_decode($_POST);
$_GET = array_utf8_decode($_GET);

if (get_magic_quotes_gpc()) {
	$_POST = array_map('stripslashes', $_POST);
	$_GET = array_map('stripslashes', $_GET);
}
}

$opcoes_select_paginacao = array(5 => '5 registros',
								 10 => '10 registros',
								 15 => '15 registros',
								 20 => '20 registros',
								 25 => '25 registros',
								 50 => '50 registros');

$months = array('01' => 'janeiro',
				'02' => 'fevereiro',
				'03' => 'março',
				'04' => 'abril',
				'05' => 'maio',
				'06' => 'junho',
				'07' => 'julho',
				'08' => 'agosto',
				'09' => 'setembro',
				'10' => 'outubro',
				'11' => 'novembro',
				'12' => 'dezembro');

$mask_email = '/^[^\s]+@[^\.]+\.[^\s]+$/';

$p = $_POST;
$g = $_GET;
$f = $_FILES;

$continue = str_replace('|\w+://' . preg_replace('/(\.)/', '\\\$1', $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/') . '|i', '', trim(isset($p['continue']) ? $p['continue'] : (isset($g['continue']) ? $g['continue'] : '')));

$acao = in_array($acao = isset($p['acao']) ? $p['acao'] : (isset($g['acao']) ? $g['acao'] : ''), array('add', 'edit')) ? $acao : 'busca';

$arquivo = in_array($arquivo = isset($p['arquivo']) ? $p['arquivo'] : (isset($g['arquivo']) ? $g['arquivo'] : ''), array('home', 'login', 'pagina_primeiro_nivel', 'links/pagina_primeiro_nivel', 'logout', 'pagina_padrao', 'submenus', 'paginas', 'noticias', 'secretarias', 'categorias')) ? $arquivo : 'home';

$id = (int)(preg_replace('/[^\d]/', '', isset($p['id']) ? $p['id'] : (isset($g['id']) ? $g['id'] : '')));
$indice = (int)(preg_replace('/[^\d]/', '', isset($p['indice']) ? $p['indice'] : (isset($g['indice']) ? $g['indice'] : '')));
$remover = (int)(preg_replace('/[^\d]/', '', isset($p['remover']) ? $p['remover'] : (isset($g['remover']) ? $g['remover'] : '')));

$doc = (int)(preg_replace('/[^\d]/', '', isset($p['doc']) ? $p['doc'] : (isset($g['doc']) ? $g['doc'] : '')));

$x = array(); $letra = preg_match('|^([A-Z])-([A-Z])$|i', isset($p['letra']) ? $p['letra'] : (isset($g['letra']) ? $g['letra'] : ''), $x) ? array($x[1], $x[2]) : array();
$x = array(); $numero = preg_match('|^([0-9])-([0-9])$|i', isset($p['numero']) ? $p['numero'] : (isset($g['numero']) ? $g['numero'] : ''), $x) ? array($x[1], $x[2]) : array();
$nome = trim(isset($p['nome']) ? $p['nome'] : (isset($g['nome']) ? $g['nome'] : ''));

$email = trim(($enviou_email = isset($p['email'])) ? $p['email'] : (($enviou_email = isset($g['email'])) ? $g['email'] : ''));
$login = trim(($enviou_login = isset($p['login'])) ? $p['login'] : (($enviou_login = isset($g['login'])) ? $g['login'] : ''));
$senha = trim(($enviou_senha = isset($p['senha'])) ? $p['senha'] : (($enviou_senha = isset($g['senha'])) ? $g['senha'] : ''));
$verification_code = trim(isset($p['vc']) ? $p['vc'] : (isset($g['vc']) ? $g['vc'] : ''));
$unsubscribe = in_array($unsubscribe = isset($p['unsubscribe']) ? $p['unsubscribe'] : (isset($g['unsubscribe']) ? $g['unsubscribe'] : ''), array('n', 'y')) ? $unsubscribe : 'n';
$delete = is_array(@$p['delete']) ? $p['delete'] : (is_array(@$g['delete']) ? $g['delete'] : array());

$cidade = trim(isset($p['cidade']) ? $p['cidade'] : (isset($g['cidade']) ? $g['cidade'] : '')); if ($cidade == '-') $cidade = '';
$uf = trim(isset($p['uf']) ? $p['uf'] : (isset($g['uf']) ? $g['uf'] : '')); if ($uf == '-') $uf = '';

$editando_registro = $id > 0;

$id_categoria = (int)(preg_replace('/[^\d]/', '', isset($p['id_categoria']) ? $p['id_categoria'] : (isset($g['id_categoria']) ? $g['id_categoria'] : '')));

$s = trim(isset($p['s']) ? $p['s'] : (isset($g['s']) ? $g['s'] : '')); if (in_array($s, array(S_DEFAULT, '-'))) $s = '';
$t = trim(isset($p['t']) ? $p['t'] : (isset($g['t']) ? $g['t'] : ''));
$pagina = (int)(preg_replace('/[^\d]/', '', isset($p['pagina']) ? $p['pagina'] : (isset($g['pagina']) ? $g['pagina'] : ''))); if ($pagina < 1) $pagina = 1;
$paginacao = (int)(preg_replace('/[^\d]/', '', isset($p['paginacao']) ? $p['paginacao'] : (isset($g['paginacao']) ? $g['paginacao'] : ''))); if (!in_array($paginacao, array_keys($opcoes_select_paginacao))) $paginacao = 20;

$order_by = preg_replace('|[^\w\-\_]|', '', isset($p['order_by']) ? $p['order_by'] : (isset($g['order_by']) ? $g['order_by'] : '')); if (in_array($order_by, array('-'))) $order_by = '';
$order_by_order = in_array($x = isset($p['order_by_order']) ? $p['order_by_order'] : (isset($g['order_by_order']) ? $g['order_by_order'] : ''), $y = array(ORDER_BY_ASC, ORDER_BY_DESC)) ? $x : $y[0];

/*	Variáveis a serem utilizadas pelos scripts	*/
/*$qs_busca = (strlen($s) ? rawurlencode($s) : '-') . '/';

$qs_order_by = sprintf(ORDER_BY_TEMPLATE, (strlen($order_by) ? rawurlencode($order_by) : '-'), rawurlencode($order_by_order));

$qs_paginacao = 'paginacao/' . rawurlencode($paginacao) . '/';
$qs_pagina = 'pagina/' . rawurlencode($pagina) . '/';

$sq = $DBConn->quote($s);
$sl = "LIKE '%" . preg_replace(array("|^'|", "|'$|"), array('', ''), $sq) . "%'";
/*	==========================================	*/

/*	Inicializa a sessão	*/
@session_start();
$cookie_expire = time() + 60 * 60 * 24 * 30;
$domain_cookie = false;
/*	===================	*/

/*	Efetua o login (admin)	*/
$tentou_se_logar = !logado() && ($enviou_email || $enviou_login) && $enviou_senha;

if ($tentou_se_logar && login($login, $senha)) {
	header("location: " . $continue);
	exit();
}
/*	======================	*/

/*	Efetua o logout (admin)	*/
if ($arquivo == 'logout') {
	logout();
}
/*	=======================	*/

/*	Determina o timezone	*/
date_default_timezone_set('America/Sao_Paulo');
/*	====================	*/
/*	======================================	*/

/*	Determina a quebra de linha nos cabeçalhos do e-mail	*/
$mail_headers_line_break = PATH_SEPARATOR == ";" ? /* Se for Windows */ "\r\n" : /* Se "não for Windows" */ "\n";
/*	====================================================	*/

/*	Define site title	*/
$prefeitura = 'Prefeitura de Santa Cruz do Sul';

$link = trim(isset($g['link']) ? $g['link'] : '');
if (strlen($link)) {
	$sql_titulo = "SELECT p.titulo
			FROM paginas p,
				 links_menu l
			WHERE l.id_links_menu = p.id_links_menu AND
				  l.link = " . $DBConn->quote($link) . " AND
				  l.status = " . $DBConn->quote('A');
	$q_titulo = $DBConn->query($sql_titulo);
	$r_titulo = $q_titulo->fetch();
	$titulo = htmlentities($r_titulo['titulo']);
}

switch ($arquivo) {
	case 'home': $title = $prefeitura; break;
	case 'pagina_padrao': $title = $titulo . ' - ' . $prefeitura; break;
	case 'pagina_primeiro_nivel': $title = ucfirst($link) . ' - ' . $prefeitura; break;
	/*case 'cidade': $title = 'Brasão - ' . $prefeitura; break;
	case 'brasao': $title = 'Brasão - ' . $prefeitura; break;
	cidade|governo|secretarias|subprefeituras|noticias|empresas|investidos|turismo|servidor|orgaos|contato*/
	default: $title = ucfirst($arquivo) . ' - ' . $prefeitura;
}
/*	=================	*/

$nivel_maximo_submenu = 3;

?>