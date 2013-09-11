<?php

include_once dirname(__FILE__) . '/config.php';

if (autorizado('categorias')) {
//	Exclui registros selecionados	//
foreach ($delete as $v) {
	$DBConn->query("DELETE FROM categorias WHERE id = " . $DBConn->quote($v));
}
//	=============================	//

$sql = "SELECT id,
			   nome
		FROM categorias
		WHERE id > 0 AND
			  (nome " . $sl . " OR id " . $sl . ")
		GROUP BY nome";

$numero_registros = ($q = $DBConn->query($sql)) && is_array($rows = $q->fetchAll()) ? count($rows) : 0;
$numero_paginas = ceil($numero_registros / $paginacao);
if ($numero_paginas > 0 && $pagina > $numero_paginas) $pagina = $numero_paginas;

$sql_limit = " LIMIT " . (($pagina - 1) * $paginacao) . ", " . $paginacao;
$sql_order_by = " ORDER BY " . (strlen($order_by) ? $order_by : "id") . " " . strtoupper($order_by_order);

$url_busca = 'categorias/busca/' . $qs_busca;
$url_order = $url_busca . ORDER_BY_TEMPLATE . $qs_paginacao . $qs_pagina;

$form_title = 'Categorias';

include_once dirname(__FILE__) . '/interface_busca_header.php';

?><tr>
	<th class="table-header-check align-center"><a href="#" class="toggle-all" title="Marcar / desmarcar todos">&nbsp;</a></th>
	<th class="table-header-repeat align-center line-left minwidth-2"><a href="<?php echo sprintf($url_order, 'nome', $order_by == 'nome' && $order_by_order == ORDER_BY_ASC ? ORDER_BY_DESC : ORDER_BY_ASC) ?>"<?php echo ($order_by == 'nome' ? ' class="order-by-' . $order_by_order . '"' : '') ?>>Secretaria</a></th>
	<th class="table-header-options align-center line-left"><a href="#">Op&ccedil;&otilde;es</a></th>
</tr><?php

if (($tem_registros = ($q = $DBConn->query($sql . $sql_order_by . $sql_limit)) && is_array($rows = $q->fetchAll()) && count($rows))) {
	$x = 0;
	$max = 50;

	foreach ($rows as $r) {
	
		?><tr<?php echo (!(++$x % 2) ? ' class="alternate-row"' : '') ?>>
			<td class="align-center"><input type="checkbox" name="delete[]" value="<?php echo $r['id'] ?>" class="toggle-all" /></td>
			<td class="align-left"><?php echo htmlentities($r['nome']) ?></td
			><td class="options-width">
				<a href="categorias/<?php echo $r['id'] ?>/edit" class="icon-1 info-tooltip" title="Editar">Editar</a>
			</td>
		</tr><?php
	}
} else {
	?><tr>
		<td class="align-center" colspan="11">Nenhum registro encontrado.</td>
	</tr><?php
}
	?></table>
</div><?php

include_once dirname(__FILE__) . '/interface_busca_footer.php';
}

?>