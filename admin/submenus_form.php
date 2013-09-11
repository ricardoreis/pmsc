<?php

include_once dirname(__FILE__) . '/config.php';

if (autorizado('submenus')) {

$apertou_botao_cadastrar = isset($p['id_pai']);

//	Carrega os dados do registro	//
$sql = "SELECT id_links_menu id,
			   id_pai,
			   titulo,
			   link,
			   nivel,
			   status
		FROM links_menu
		WHERE id_links_menu = " . $DBConn->quote($id) . " AND
			  nivel > 1
		GROUP BY id,
				 id_pai,
				 titulo,
				 link";

$editando_registro = ($q = $DBConn->query($sql)) && ($dados_originais = $q->fetch());
if (isset($dados_originais['link']) && !preg_match('(^http:\/\/|^https:\/\/)', $dados_originais['link'])) unset($dados_originais['link']);
//	============================	//

if (!$apertou_botao_cadastrar) {
	if ($editando_registro) {
		$p = $dados_originais;
	}
}

//	Carrega as opções do SELECT de id pai	//
$opcoes_select_id_pai = array();

$sql = "SELECT id_links_menu id,
			   titulo
		FROM links_menu
		WHERE nivel <= " . $DBConn->quote($nivel_maximo_submenu) . "
		ORDER BY titulo ASC";

$q = $DBConn->query($sql);
while (($r = $q->fetch())) $opcoes_select_id_pai[$r['id']] = $r['titulo'];
//	========================================	//

//	Verifica os dados enviados pelo formulário	//
//$id = sprintf('%06d', preg_replace('|[^\d]|', '', isset($p['id']) ? $p['id'] : ''));

$id_pai = trim(isset($p['id_pai']) ? $p['id_pai'] : '');
$titulo = trim(isset($p['titulo']) ? $p['titulo'] : '');
$link = trim(isset($p['link']) ? $p['link'] : '');
if (strlen($link) && !preg_match('(^http:\/\/|^https:\/\/)', $link)) $link_db = 'http://' . $link;
else if (strlen($link)) $link_db = $link;
if (!strlen($link)) $link_db = urls_amigaveis_formata_string($titulo);
$nivel = trim(isset($p['nivel']) ? $p['nivel'] : '');
$status = trim(isset($p['status']) ? $p['status'] : '');

if ($id_pai) {
	$sql = "SELECT nivel
			FROM links_menu
			WHERE id_links_menu = " . $DBConn->quote($id_pai);
	$q = $DBConn->query($sql);
	$r = $q->fetch();
	if ($r['nivel']) $nivel = $r['nivel'] + 1;
	else $nivel = 2;
}
//	==========================================	//

//	Verifica se os dados já estão cadastrados	//
/*$sql1 = "SELECT id_links_menu id FROM links_menu WHERE id_links_menu = " . $DBConn->quote($id) . ($editando_registro ? " AND id_links_menu <> " . $DBConn->quote($id) : "");
$id_existe = ($q = $DBConn->query($sql1)) && ($dados_submenu = $q->fetch());*/

$sql2 = "SELECT id_links_menu id FROM links_menu WHERE titulo = " . $DBConn->quote($titulo) . ($editando_registro ? " AND id_links_menu <> " . $DBConn->quote($id) : "");
$titulo_existe = ($q = $DBConn->query($sql2)) && ($dados_submenu = $q->fetch());

$sql3 = "SELECT id_links_menu id FROM links_menu WHERE link = " . $DBConn->quote($link_db) . ($editando_registro ? " AND id_links_menu <> " . $DBConn->quote($id) : "");
$link_existe = ($q = $DBConn->query($sql3)) && ($dados_submenu = $q->fetch());
//	=========================================	//

//	Verifica mensagens de erro	//
$nivel_erro = $titulo_erro = $link_erro = $id_pai_erro = false;
$ok = true;

$message_box_type = 'error';
$message_box_text = '';

/*	Testa se tem link externo já pré cadastrado	*/
if ($editando_registro && strlen($link)) {
	echo $sql_link = "SELECT id_paginas
				 FROM paginas
				 WHERE id_links_menu = " . $DBConn->quote($id);
	$tem_pagina = ($q_link = $DBConn->query($sql_link)) && count($rows_link = $q_link->fetchAll());
}
/*	===========================================	*/

if ($apertou_botao_cadastrar) {
	if ($id_pai <= 0) { $id_pai_erro = 'Este campo &eacute; obrigat&oacute;rio.'; $ok = false; }
	
	if ($nivel > $nivel_maximo_submenu) { $nivel_erro = 'O submenu pode ter apenas ' . $nivel_maximo_submenu . ' n&iacute;veis.'; $ok = false; }

		if (!strlen($titulo)) { $titulo_erro = 'Este campo &eacute; obrigat&oacute;rio.'; $ok = false; }
	elseif ($titulo_existe) { $titulo_erro = 'Este t&iacute;tulo j&aacute; est&aacute; cadastrado.'; $ok = false; }
	
		if ($tem_pagina && $editando_registro) { $link_erro = 'N&atilde;o pode ser cadastrada uma p&aacute;gina externa pois j&aacute; existe uma p&aacute;gina criada.'; $ok = false; }
	elseif ($link_existe) { $link_erro = 'Este link j&aacute; est&aacute; cadastrado.'; $ok = false; }
	
	if (!strlen($status)) { $status_erro = 'Este campo &eacute; obrigat&oacute;rio.'; $ok = false; }

	/*if (!strlen($familia)) { $familia_erro = 'Este campo &eacute; obrigat&oacute;rio.'; $ok = false; }
	if (!strlen($origem)) { $origem_erro = 'Este campo &eacute; obrigat&oacute;rio.'; $ok = false; }
	if (!strlen($porte)) { $porte_erro = 'Este campo &eacute; obrigat&oacute;rio.'; $ok = false; }
	if (!strlen($caracteristicas)) { $caracteristicas_erro = 'Este campo &eacute; obrigat&oacute;rio.'; $ok = false; }*/

	if ($ok) {
		//	Insere o cadastro no banco de dados	//
		$tabela = "links_menu";

		$campos = array("id_pai" => $id_pai,
						"titulo" => $titulo,
						"link" => $link_db,
						"nivel" => $nivel,
						"status" => $status);

		if ($editando_registro) {
			$DBConn->update($tabela, $campos, "id_links_menu = " . $DBConn->quote($id));
			$id_registro = $id;
			$ok = true;
		} else {
			$ok = $DBConn->insert($tabela, $campos);
			$id_registro = $DBConn->lastInsertId();
		}
		//	===================================	//

		if ($ok) {
			if (!$editando_registro) {
				$id = $id_pai = $titulo = $link = $link_db = $nivel = $status = '';
			}

			$message_box_type = 'ok';
			$message_box_text = 'Submenu ' . ($editando_registro ? 'alterado' : 'adicionado') . ' com sucesso.';
		} else {
			$message_box_text = 'Houve um erro no armazenamento do seu cadastro. Aguarde alguns momentos e tente novamente.';
		}
	} else {
		$message_box_text = 'Existem problemas no seu cadastro. Preencha o formul&aacute;rio corretamente e o envie novamente.';
	}
}
//	==========================	//

$form_title = ($editando_registro ? 'Editar' : ($acao == 'add' ? 'Adicionar' : '')) . ' Submenu';
$form_action = 'submenus/' . ($editando_registro ? $id . '/edit' : 'add');

include_once dirname(__FILE__) . '/interface_form_header.php';

?><tr>
	<th>Link Pai:</th>
	<td>
		<select name="id_pai" class="selectbox_form_1">
			<option value="">Escolha o link pai</option>
			<?php foreach ($opcoes_select_id_pai as $k => $v) { ?><option value="<?php echo htmlentities($k) ?>"<?php echo ($id_pai == $k ? ' selected="selected"' : '') ?>><?php echo htmlentities($v) ?></option><?php } ?>
		</select>
		<?php echo ($id_pai_erro || $nivel_erro ? '<span class="message error"><span class="text">' . ($id_pai_erro ? $id_pai_erro : $nivel_erro) . '</span></span>' : '') ?>
		<span class="clear"></span>
	</td>
</tr>
<tr>
	<th>T&iacute;tulo:</th>
	<td><input type="text" name="titulo" value="<?php echo htmlentities($titulo) ?>" class="input<?php echo ($titulo_erro ? ' error' : '') ?>" /><?php echo ($titulo_erro ? '<span class="message error"><span class="text">' . $titulo_erro . '</span></span>' : '') ?><span class="clear"></span></td>
</tr>
<tr>
	<th>Página externa ao site:</th>
	<td><input type="text" name="link" value="<?php echo htmlentities($link) ?>" class="input<?php echo ($link_erro ? ' error' : '') ?>" /><?php echo ($link_erro ? '<span class="message error"><span class="text">' . $link_erro . '</span></span>' : '') ?><span class="clear"></span></td>
</tr>
<tr>
	<th>Status:</th>
	<td><input type="radio" name="status" value="A" <?php echo htmlentities($status) != 'I' ? 'CHECKED' : '' ?> /> Ativo&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="status" value="I" <?php echo htmlentities($status) == 'I' ? 'CHECKED' : '' ?> /> Inativo<?php echo ($status_erro ? '<span class="message error"><span class="text">' . $status_erro . '</span></span>' : '') ?><span class="clear"></span></td>
</tr><br/><br/>
<!--<tr>
	<th>Caracter&iacute;sticas:</th>
	<td><textarea name="caracteristicas" rows="40" cols="10" class="textarea<?php echo ($caracteristicas_erro ? ' error' : '') ?>"><?php echo htmlentities($caracteristicas) ?></textarea><?php echo ($caracteristicas_erro ? '<span class="message error"><span class="text">' . $caracteristicas_erro . '</span></span>' : '') ?><span class="clear"></span></td>
</tr>--><?php

include_once dirname(__FILE__) . '/interface_form_footer.php';
}

?>