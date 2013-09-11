<?php

include_once dirname(__FILE__) . '/config.php';

if (autorizado('submenus')) {

$apertou_botao_cadastrar = isset($p['id']);

//	Carrega os dados do registro	//
$sql = "SELECT id,
			   nome
		FROM secretarias
		WHERE id = " . $DBConn->quote($id);

$editando_registro = ($q = $DBConn->query($sql)) && ($dados_originais = $q->fetch());
/////////////////////////////////////////

if (!$apertou_botao_cadastrar) {
	if ($editando_registro) {
		$p = $dados_originais;
	}
}



//	Verifica os dados enviados pelo formulário	//

$id = trim(isset($p['id']) ? $p['id'] : '');
$nome = trim(isset($p['nome']) ? $p['nome'] : '');


//	==========================================	//

//	Verifica se os dados já estão cadastrados	//

$sql2 = "SELECT id FROM secretarias WHERE nome = " . $DBConn->quote($nome);
$nome_existe = ($q = $DBConn->query($sql2)) && ($dados_secretarias = $q->fetch());

//	=========================================	//

//	Verifica mensagens de erro	//
$nome_erro = $id_erro = false;
$ok = true;

$message_box_type = 'error';
$message_box_text = '';
/////////////////////////////////////


if ($apertou_botao_cadastrar) {
	if (!strlen($nome)) { $nome_erro = 'Este campo &eacute; obrigat&oacute;rio.'; $ok = false; }
	elseif ($nome_existe) { $nome_erro = 'Esta Secretaria j&aacute; est&aacute; cadastrada.'; $ok = false; }
	
	if ($ok) {
		//	Insere o cadastro no banco de dados	//
		$tabela = "secretarias";

		$campos = array("nome" => $nome);

		if ($editando_registro) {
			$DBConn->update($tabela, $campos, "id = " . $DBConn->quote($id));
			$id_registro = $id;
			$ok = true;
		} else {
			$ok = $DBConn->insert($tabela, $campos);
			$id_registro = $DBConn->lastInsertId();
		}
		//	===================================	//

		if ($ok) {
			if (!$editando_registro) {
				$message_box_text = 'Secretaria ' . ($editando_registro ? 'alterada' : 'adicionada') . ' com sucesso.';
				$id = $nome = '';
			}

			$message_box_type = 'ok';
			
		} else {
			$message_box_text = 'Houve um erro no armazenamento do seu cadastro. Aguarde alguns momentos e tente novamente.';
		}
	} else {
		$message_box_text = 'Existem problemas no seu cadastro. Preencha o formul&aacute;rio corretamente e o envie novamente.'. $id . '-' . $nome;
	}
}
//	==========================	//

$form_title = ($editando_registro ? 'Editar' : ($acao == 'add' ? 'Adicionar' : '')) . ' Secretarias';
$form_action = 'secretarias/' . ($editando_registro ? $id . '/edit' : 'add');

include_once dirname(__FILE__) . '/interface_form_header.php';

?>
<tr>
	<th>Nome</th>
	<td><input type="text" name="nome" value="<?php echo htmlentities($nome) ?>" class="input<?php echo ($nome_erro ? ' error' : '') ?>" /><?php echo ($nome_erro ? '<span class="message error"><span class="text">' . $nome_erro . '</span></span>' : '') ?><span class="clear"></span></td>
</tr>
<?php

include_once dirname(__FILE__) . '/interface_form_footer.php';
}

?>