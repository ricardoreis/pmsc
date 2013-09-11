<?php

include_once dirname(__FILE__) . '/config.php';

if (autorizado('noticias')) {

$apertou_botao_cadastrar = isset($p['id']);

//	Carrega os dados do registro	//
$sql = "SELECT id_noticias,
			   titulo,
			   id_secretarias,
			   id_categorias,
			   texto,
			   data,
			   data_atualizacao,					
			   status
		FROM noticias
		WHERE id_noticias = " . $DBConn->quote($id);

$editando_registro = ($q = $DBConn->query($sql)) && ($dados_originais = $q->fetch());
/////////////////////////////////////////

if (!$apertou_botao_cadastrar) {
	if ($editando_registro) {
		$p = $dados_originais;
	}
}



//	Verifica os dados enviados pelo formulário	//

//$id = trim(isset($p['id_noticias']) ? $p['id_noticias'] : '');
$titulo = trim(isset($p['titulo']) ? $p['titulo'] : '');
$id_secretarias = trim(isset($p['id_secretarias']) ? $p['id_secretarias'] : '');
$id_categorias = trim(isset($p['id_categorias']) ? $p['id_categorias'] : '');
$texto = trim(isset($p['texto']) ? $p['texto'] : '');
$data = trim(isset($p['data']) ? $p['data'] : date('d/m/Y'));
$data_db = array();
preg_match('/^(\d+)\/(\d+)\/(\d+)$/', $data, $data_db);
$data_db = $data_db[3] . '-' . $data_db[2] . '-' . $data_db[1];
$data_atualizacao = date('Y-m-d');
$status = trim(isset($p['status']) ? $p['status'] : '');


//	==========================================	//

//	Carrega as opções do SELECT de SECRETARIAS	//
$opcoes_select_id_secretarias = array();
$sql = "SELECT s.id,
			   s.nome
		FROM secretarias s
		ORDER BY s.nome ASC";
$q = $DBConn->query($sql);
while (($r = $q->fetch())) $opcoes_select_id_secretarias[$r['id']] = $r['nome'];
//	========================================	//

//	Carrega as opções do SELECT de CATEGORIAS	//
$opcoes_select_id_categoria = array();
$sql = "SELECT c.id,
			   c.nome
		FROM categorias c
		ORDER BY c.nome ASC";
$q = $DBConn->query($sql);
while (($r = $q->fetch())) $opcoes_select_id_categoria[$r['id']] = $r['nome'];
//	========================================	//


$q = $DBConn->query($sql);
$r = $q->fetch();

//	Verifica se os dados já estão cadastrados	//

$sql2 = "SELECT id_noticias FROM noticias WHERE titulo = " . $DBConn->quote($titulo);
$titulo_existe = ($q = $DBConn->query($sql2)) && ($dados_categorias = $q->fetch());

//	=========================================	//

//	Verifica mensagens de erro	//
$titulo_erro = $id_erro = false;
$ok = true;

$message_box_type = 'error';
$message_box_text = '';
/////////////////////////////////////


if ($apertou_botao_cadastrar) {
	if (!strlen($titulo)) { $titulo_erro = 'Este campo &eacute; obrigat&oacute;rio.'; $ok = false; }
	elseif ($titulo_existe) { $titulo_erro = 'Esta Notícia j&aacute; est&aacute; cadastrada.'; $ok = false; }
	
	if ($ok) {
		//	Insere o cadastro no banco de dados	//
		$tabela = "noticias";

		$campos = array("titulo" => $titulo, "id_secretarias" => $id_secretarias, "id_categorias" => $id_categorias, "texto" => $texto, "data" => $data_db, "data_atualizacao" => $data_atualizacao, "status" => $status);

		if ($editando_registro) {
			$DBConn->update($tabela, $campos, "id_noticias = " . $DBConn->quote($id));
			$id_registro = $id;
			$ok = true;
		} else {
			$ok = $DBConn->insert($tabela, $campos);
			$id_registro = $DBConn->lastInsertId();
		}
		//	===================================	//

		if ($ok) {
			if (!$editando_registro) {
				$message_box_text = 'Notícia ' . ($editando_registro ? 'alterada' : 'adicionada') . ' com sucesso.';
				$id = $titulo = '';
			}

			$message_box_type = 'ok';
			
		} else {
			$message_box_text = 'Houve um erro no armazenamento do seu cadastro. Aguarde alguns momentos e tente novamente.';
		}
	} else {
		$message_box_text = 'Existem problemas no seu cadastro. Preencha o formul&aacute;rio corretamente e o envie novamente.'. $id . '-' . $titulo;
	}
}
//	==========================	//

$form_title = ($editando_registro ? 'Editar' : ($acao == 'add' ? 'Adicionar' : '')) . ' notícias';
$form_action = 'noticias/' . ($editando_registro ? $id . '/edit' : 'add');

include_once dirname(__FILE__) . '/interface_form_header.php';

?>

<tr>
	<th>Notícia da Secretaria:</th>
	<td>
		<select name="id_secretarias" class="selectbox_form_1">
			<option value="">Escolha a Secretaria</option>
			<?php foreach ($opcoes_select_id_secretarias as $k => $v) { ?><option value="<?php echo htmlentities($k) ?>"<?php echo ($id_secretarias == $k ? ' selected="selected"' : '') ?>><?php echo htmlentities($v) ?></option><?php } ?>
		</select>
		<?php echo ($id_secretarias_erro ? '<span class="message error"><span class="text">' . $id_cretarias_erro . '</span></span>' : '') ?>
		<span class="clear"></span>
	</td>
</tr>
<tr>
	<!-- 
    	<th>Categoria da Notícia:</th>
		<td>
		<select name="id_categorias" class="selectbox_form_1">
			<option value="">Escolha a Categoria</option>
			<?php 
			/*
				foreach ($opcoes_select_id_categoria as $k => $v) { ?><option value="<?php echo htmlentities($k) ?>"<?php echo ($id_secretarias == $k ? ' selected="selected"' : '') ?>><?php echo htmlentities($v) ?></option><?php } ?>
				</select>
				<?php echo ($id_secretarias_erro ? '<span class="message error"><span class="text">' . $id_cretarias_erro . '</span></span>' : '') 
			*/
			?>
		<span class="clear"></span>
		</td>
     -->
    
</tr>
<tr>
	<th>T&iacute;tulo da Notícia:</th>
	<td><input type="text" name="titulo" value="<?php echo htmlentities($titulo) ?>" class="input<?php echo ($titulo_erro ? ' error' : '') ?>" /><?php echo ($titulo_erro ? '<span class="message error"><span class="text">' . $titulo_erro . '</span></span>' : '') ?><span class="clear"></span></td>
</tr>
<tr>
	<th>Conteúdo da Notícia:</th>
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
</tr>

<?php

include_once dirname(__FILE__) . '/interface_form_footer.php';
}

?>