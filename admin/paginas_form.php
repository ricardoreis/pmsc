<?php

include_once dirname(__FILE__) . '/config.php';

if (autorizado('paginas')) {

$apertou_botao_cadastrar = isset($p['titulo']);

//	Carrega os dados do registro	//
$sql = "SELECT id_paginas id,
			   id_links_menu,
			   titulo,
			   texto,
			   data,
			   data_atualizacao
		FROM paginas
		WHERE id_paginas = " . $DBConn->quote($id) . "
		GROUP BY id,
				 titulo,
				 texto";

$editando_registro = ($q = $DBConn->query($sql)) && ($dados_originais = $q->fetch());
if ($editando_registro) {
	$data = array();
	preg_match('/^(\d+)-(\d+)-(\d+)/', $dados_originais['data'], $data);
	$dados_originais['data'] = $data[3] . '/' . $data[2] . '/' . $data[1];
}
//	============================	//

if (!$apertou_botao_cadastrar) {
	if ($editando_registro) {
		$p = $dados_originais;
	}
}

//	Verifica os dados enviados pelo formulário	//
$id_links_menu = trim(isset($p['id_links_menu']) ? $p['id_links_menu'] : '');
$titulo = trim(isset($p['titulo']) ? $p['titulo'] : '');
$texto = trim(isset($p['texto']) ? $p['texto'] : '');
$data = trim(isset($p['data']) ? $p['data'] : date('d/m/Y'));
$data_db = array();
preg_match('/^(\d+)\/(\d+)\/(\d+)$/', $data, $data_db);
$data_db = $data_db[3] . '-' . $data_db[2] . '-' . $data_db[1];
$data_atualizacao = date('Y-m-d');
//	==========================================	//

//	Carrega as opções do SELECT de id pai	//
$opcoes_select_id_links_menu = array();
$sql = "SELECT l.id_links_menu id,
			   l.titulo
		FROM links_menu l
		WHERE l.id_links_menu
		NOT IN (SELECT p.id_links_menu
				FROM paginas p
				WHERE p.id_links_menu != " . $DBConn->quote($id_links_menu) . ")
		ORDER BY l.titulo ASC";
$q = $DBConn->query($sql);
while (($r = $q->fetch())) $opcoes_select_id_links_menu[$r['id']] = $r['titulo'];
//	========================================	//


$q = $DBConn->query($sql);
$r = $q->fetch();

//	Verifica se os dados já estão cadastrados	//
$sql2 = "SELECT id_paginas id FROM paginas WHERE titulo = " . $DBConn->quote($titulo) . ($editando_registro ? " AND id_paginas <> " . $DBConn->quote($id) : "");
$titulo_existe = ($q = $DBConn->query($sql2)) && ($dados_pagina = $q->fetch());

$sql3 = "SELECT id_paginas id FROM paginas WHERE texto = " . $DBConn->quote($texto) . ($editando_registro ? " AND id_paginas <> " . $DBConn->quote($id) : "");
$texto_existe = ($q = $DBConn->query($sql3)) && ($dados_pagina = $q->fetch());
//	=========================================	//

//	Verifica mensagens de erro	//
$tem_link_externo = $id_link_menu_erro = $titulo_erro = $texto_erro = $data_erro = false;
$ok = true;

$message_box_type = 'error';
$message_box_text = '';

/*	Testa se tem link externo já pré cadastrado	*/
$sql_link = "SELECT link
			 FROM links_menu
			 WHERE id_links_menu = " . $DBConn->quote($id_links_menu);
$q_link = $DBConn->query($sql_link);
$r_link = $q_link->fetch();
$tem_link_externo = preg_match('(^http:\/\/|^https:\/\/)', $r_link['link']);
/*	===========================================	*/

if ($apertou_botao_cadastrar) {
	if ($tem_link_externo) { $id_link_menu_erro = 'Link pai com link externo j&aacute; criado.'; $ok = false; }
	
	if ($id_links_menu <= 0 && !$tem_link_externo) { $id_link_menu_erro = 'Este campo &eacute; obrigat&oacute;rio.'; $ok = false; }

		if (!strlen($titulo)) { $titulo_erro = 'Este campo &eacute; obrigat&oacute;rio.'; $ok = false; }
	elseif ($titulo_existe) { $titulo_erro = 'Este t&iacute;tulo j&aacute; est&aacute; cadastrado.'; $ok = false; }

		if (!strlen($texto)) { $texto_erro = 'Este campo &eacute; obrigat&oacute;rio.'; $ok = false; }
	elseif ($texto_existe) { $texto_erro = 'Este texto j&aacute; est&aacute; cadastrado.'; $ok = false; }

		if (!strlen($data)) { $data_erro = 'Este campo &eacute; obrigat&oacute;rio.'; $ok = false; }

	/*if (!strlen($familia)) { $familia_erro = 'Este campo &eacute; obrigat&oacute;rio.'; $ok = false; }
	if (!strlen($origem)) { $origem_erro = 'Este campo &eacute; obrigat&oacute;rio.'; $ok = false; }
	if (!strlen($porte)) { $porte_erro = 'Este campo &eacute; obrigat&oacute;rio.'; $ok = false; }
	if (!strlen($caracteristicas)) { $caracteristicas_erro = 'Este campo &eacute; obrigat&oacute;rio.'; $ok = false; }*/

	if ($ok) {
		//	Insere o cadastro no banco de dados	//
		$tabela = "paginas";

		$campos = array("id_links_menu" => $id_links_menu,
						"titulo" => $titulo,
						"texto" => $texto,
						"data" => $data_db,
						"data_atualizacao" => $data_atualizacao);

		if ($editando_registro) {
			$DBConn->update($tabela, $campos, "id_paginas = " . $DBConn->quote($id));
			$id_registro = $id;
			$ok = true;
		} else {
			$ok = $DBConn->insert($tabela, $campos);
			$id_registro = $DBConn->lastInsertId();
		}
		//	===================================	//

		if ($ok) {
			if (!$editando_registro) {
				$id = $id_links_menu = $titulo = $texto =  '';
				$data = date('d/m/Y');
				$data_atualizacao = date('Y-m-d');
			}

			$message_box_type = 'ok';
			$message_box_text = 'P&aacute;gina ' . ($editando_registro ? 'alterada' : 'adicionada') . ' com sucesso.';
		} else {
			$message_box_text = 'Houve um erro no armazenamento do seu cadastro. Aguarde alguns momentos e tente novamente.';
		}
	} else {
		$message_box_text = 'Existem problemas no seu cadastro. Preencha o formul&aacute;rio corretamente e o envie novamente.';
	}
}
//	==========================	//

$form_title = ($editando_registro ? 'Editar' : ($acao == 'add' ? 'Adicionar' : '')) . ' P&aacute;gina';
$form_action = 'paginas/' . ($editando_registro ? $id . '/edit' : 'add');

include_once dirname(__FILE__) . '/interface_form_header.php';

?><tr>
	<th>P&aacute;gina:</th>
	<td>
		<select name="id_links_menu" class="selectbox_form_1">
			<option value="">Escolha a página</option>
			<?php foreach ($opcoes_select_id_links_menu as $k => $v) { ?><option value="<?php echo htmlentities($k) ?>"<?php echo ($id_links_menu == $k ? ' selected="selected"' : '') ?>><?php echo htmlentities($v) ?></option><?php } ?>
		</select>
		<?php echo ($id_link_menu_erro ? '<span class="message error"><span class="text">' . $id_link_menu_erro . '</span></span>' : '') ?>
		<span class="clear"></span>
	</td>
</tr>
<tr>
	<th>T&iacute;tulo:</th>
	<td><input type="text" name="titulo" value="<?php echo htmlentities($titulo) ?>" class="input<?php echo ($titulo_erro ? ' error' : '') ?>" /><?php echo ($titulo_erro ? '<span class="message error"><span class="text">' . $titulo_erro . '</span></span>' : '') ?><span class="clear"></span></td>
</tr>
<tr>
	<th>Texto:</th>
    <td>
		<!-- TinyMCE -->
		<script type="text/javascript" src="/tiny_mce/tiny_mce.js"></script>
        <script type="text/javascript">
        <!--
            tinyMCE.init( { mode : "textareas",
                            theme : "advanced",
                            plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager,filemanager",
                            theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,cut,copy,paste,pastetext,pasteword",
                            theme_advanced_buttons2 : "search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                            theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                            theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
                            theme_advanced_toolbar_location : "top",
                            theme_advanced_toolbar_align : "left",
                            theme_advanced_statusbar_location : "bottom",
                            theme_advanced_resizing : true,
                            relative_urls : false,
                            file_browser_callback : "ajaxfilemanager" });
        
            function ajaxfilemanager(field_name, url, type, win) {
                switch (type) {
                    case "image":
                        break;
                    case "media":
                        break;
                    case "flash": 
                        break;
                    case "file":
                        break;
                    default:
                        return false;
                }
        
                tinyMCE.activeEditor.windowManager.open({
                    url: "/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php?editor=tinymce",
                    title: "Ajax File Manager",
                    width: 782,
                    height: 440,
                    inline : "yes",
                    close_previous : "no"
                },{
                    window : win,
                    input : field_name,
                    editor_id : tinyMCE.selectedInstance.editorId
                });
        
                return false;
            }
        -->
        </script>
        <!-- /TinyMCE -->

		<textarea name="texto" rows="40" cols="10" class="textarea<?php echo ($texto_erro ? ' error' : '') ?>"><?php echo htmlentities($texto) ?></textarea>
		<?php echo ($texto_erro ? '<span class="message error"><span class="text">' . $texto_erro . '</span></span>' : '') ?>
        <span class="clear"></span>
	</td>
    <!--<td><textarea name="texto" rows="40" cols="10" class="textarea<?php echo ($texto_erro ? ' error' : '') ?>"><?php echo htmlentities($texto) ?></textarea><?php echo ($texto_erro ? '<span class="message error"><span class="text">' . $texto_erro . '</span></span>' : '') ?><span class="clear"></span></td>-->
</tr>
<tr>
	<th>Data:</th>
	<td><input type="text" name="data" value="<?php echo htmlentities($data) ?>" class="input data<?php echo ($data_erro ? ' error' : '') ?>" /><?php echo ($data_erro ? '<span class="message error"><span class="text">' . $data_erro . '</span></span>' : '') ?><span class="clear"></span></td>
</tr><?php

include_once dirname(__FILE__) . '/interface_form_footer.php';
}

?>