<?php

include_once dirname(__FILE__) . '/config.php';

if (autorizado('paginas')) {
//	Exclui registros selecionados	//
foreach ($delete as $v) {
	$DBConn->query("DELETE FROM paginas WHERE id_paginas = " . $DBConn->quote($v));
}
//	=============================	//

$sql = "SELECT id_paginas id,
			   id_links_menu,
			   titulo,
			   texto,
			   data,
			   data_atualizacao
		FROM paginas
		WHERE (titulo " . $sl . " OR texto " . $sl . " OR data " . $sl . " OR data_atualizacao " . $sl . ")
		GROUP BY id,
				 titulo,
				 texto";

$numero_registros = ($q = $DBConn->query($sql)) && is_array($rows = $q->fetchAll()) ? count($rows) : 0;
$numero_paginas = ceil($numero_registros / $paginacao);
if ($numero_paginas > 0 && $pagina > $numero_paginas) $pagina = $numero_paginas;

$sql_limit = " LIMIT " . (($pagina - 1) * $paginacao) . ", " . $paginacao;
$sql_order_by = " ORDER BY " . (strlen($order_by) ? $order_by : "id") . " " . strtoupper($order_by_order);

$url_busca = 'paginas/busca/' . $qs_busca;
$url_order = $url_busca . ORDER_BY_TEMPLATE . $qs_paginacao . $qs_pagina;

$form_title = 'Páginas';

include_once dirname(__FILE__) . '/interface_busca_header.php';

?><tr>
	<th class="table-header-check align-center"><a href="#" class="toggle-all" title="Marcar / desmarcar todos">&nbsp;</a></th>
	<th class="table-header-repeat align-center line-left minwidth-2"><a href="<?php echo sprintf($url_order, 'titulo', $order_by == 'titulo' && $order_by_order == ORDER_BY_ASC ? ORDER_BY_DESC : ORDER_BY_ASC) ?>"<?php echo ($order_by == 'titulo' ? ' class="order-by-' . $order_by_order . '"' : '') ?>>Título</a></th>
	<th class="table-header-repeat align-center line-left minwidth-2"><a href="<?php echo sprintf($url_order, 'data', $order_by == 'data' && $order_by_order == ORDER_BY_ASC ? ORDER_BY_DESC : ORDER_BY_ASC) ?>"<?php echo ($order_by == 'data' ? ' class="order-by-' . $order_by_order . '"' : '') ?>>Data</a></th>
	<th class="table-header-repeat align-center line-left minwidth-2"><a href="<?php echo sprintf($url_order, 'data_atualizacao', $order_by == 'data_atualizacao' && $order_by_order == ORDER_BY_ASC ? ORDER_BY_DESC : ORDER_BY_ASC) ?>"<?php echo ($order_by == 'data_atualizacao' ? ' class="order-by-' . $order_by_order . '"' : '') ?>>Última atualização</a></th>
	<th class="table-header-options align-center line-left"><a href="#">Op&ccedil;&otilde;es</a></th>
</tr><?php

if (($tem_registros = ($q = $DBConn->query($sql . $sql_order_by . $sql_limit)) && is_array($rows = $q->fetchAll()) && count($rows))) {
	$x = 0;
	$max = 50;

	foreach ($rows as $r) {
		$caracteristicas = preg_replace('|[\r\n]+|', ' ', $r['caracteristicas']);
		$caracteristicas = ($len = strlen($caracteristicas)) ? trim(substr($caracteristicas, 0, $max)) . ($len > $max ? '...' : '') : '';
		
		$data = array();
		preg_match('/^(\d+)-(\d+)-(\d+)/', $r['data'], $data);
		$data = $data[3] . '/' . $data[2] . '/' . $data[1];
		
		$data_atualizacao = array();
		preg_match('/^(\d+)-(\d+)-(\d+)/', $r['data_atualizacao'], $data_atualizacao);
		$data_atualizacao = $data_atualizacao[3] . '/' . $data_atualizacao[2] . '/' . $data_atualizacao[1];

		?><tr<?php echo (!(++$x % 2) ? ' class="alternate-row"' : '') ?>>
			<td class="align-center"><input type="checkbox" name="delete[]" value="<?php echo $r['id'] ?>" class="toggle-all" /></td>
			<td class="align-left"><?php echo htmlentities($r['titulo']) ?></td>
			<td class="align-left"><?php echo htmlentities($data) ?></td>
			<td class="align-left"><?php echo htmlentities($data_atualizacao) ?></td>
			<td class="options-width">
				<a href="paginas/<?php echo $r['id'] ?>/edit" class="" title="Editar">Editar</a>
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