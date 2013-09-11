<?php

include_once dirname(__FILE__) . '/config.php';

if (autorizado('submenus')) {
//	Exclui registros selecionados	//
foreach ($delete as $v) {
	$DBConn->query("DELETE FROM links_menu WHERE id_links_menu = " . $DBConn->quote($v));
}
//	=============================	//

$sql = "SELECT id_links_menu id,
			   id_pai,
			   titulo,
			   link,
			   nivel,
			   status
		FROM links_menu
		WHERE nivel > 1 AND
			  (titulo " . $sl . " OR link " . $sl . " OR nivel " . $sl . ")
		GROUP BY id,
				 id_pai,
				 titulo,
				 link,
				 nivel";

$numero_registros = ($q = $DBConn->query($sql)) && is_array($rows = $q->fetchAll()) ? count($rows) : 0;
$numero_paginas = ceil($numero_registros / $paginacao);
if ($numero_paginas > 0 && $pagina > $numero_paginas) $pagina = $numero_paginas;

$sql_limit = " LIMIT " . (($pagina - 1) * $paginacao) . ", " . $paginacao;
$sql_order_by = " ORDER BY " . (strlen($order_by) ? $order_by : "id") . " " . strtoupper($order_by_order);

$url_busca = 'submenus/busca/' . $qs_busca;
$url_order = $url_busca . ORDER_BY_TEMPLATE . $qs_paginacao . $qs_pagina;

$form_title = 'Submenus';

include_once dirname(__FILE__) . '/interface_busca_header.php';

?><tr>
	<th class="table-header-check align-center"><a href="#" class="toggle-all" title="Marcar / desmarcar todos">&nbsp;</a></th>
	<!--<th class="table-header-repeat align-center line-left minwidth-1"><a href="<?php echo sprintf($url_order, 'id', $order_by == 'id' && $order_by_order == ORDER_BY_ASC ? ORDER_BY_DESC : ORDER_BY_ASC) ?>"<?php echo ($order_by == 'id' ? ' class="order-by-' . $order_by_order . '"' . '"' : '') ?>>C&oacute;digo</a></th>-->
	<th class="table-header-repeat align-center line-left minwidth-2"><a href="<?php echo sprintf($url_order, 'titulo', $order_by == 'titulo' && $order_by_order == ORDER_BY_ASC ? ORDER_BY_DESC : ORDER_BY_ASC) ?>"<?php echo ($order_by == 'titulo' ? ' class="order-by-' . $order_by_order . '"' : '') ?>>Título</a></th>
	<th class="table-header-repeat align-center line-left minwidth-2"><a href="<?php echo sprintf($url_order, 'link', $order_by == 'link' && $order_by_order == ORDER_BY_ASC ? ORDER_BY_DESC : ORDER_BY_ASC) ?>"<?php echo ($order_by == 'link' ? ' class="order-by-' . $order_by_order . '"' : '') ?>>Link</a></th>
	<th class="table-header-repeat align-center line-left minwidth-2"><a href="<?php echo sprintf($url_order, 'status', $order_by == 'status' && $order_by_order == ORDER_BY_ASC ? ORDER_BY_DESC : ORDER_BY_ASC) ?>"<?php echo ($order_by == 'status' ? ' class="order-by-' . $order_by_order . '"' : '') ?>>Status</a></th>
	<th class="table-header-options align-center line-left"><a href="#">Op&ccedil;&otilde;es</a></th>
</tr><?php

if (($tem_registros = ($q = $DBConn->query($sql . $sql_order_by . $sql_limit)) && is_array($rows = $q->fetchAll()) && count($rows))) {
	$x = 0;
	$max = 50;

	foreach ($rows as $r) {
		$caracteristicas = preg_replace('|[\r\n]+|', ' ', $r['caracteristicas']);
		$caracteristicas = ($len = strlen($caracteristicas)) ? trim(substr($caracteristicas, 0, $max)) . ($len > $max ? '...' : '') : '';

		?><tr<?php echo (!(++$x % 2) ? ' class="alternate-row"' : '') ?>>
			<td class="align-center"><input type="checkbox" name="delete[]" value="<?php echo $r['id'] ?>" class="toggle-all" /></td>
			<!--<td class="align-center"><?php echo htmlentities($r['id']) ?></td>-->
			<td class="align-left"><?php echo htmlentities($r['titulo']) ?></td>
			<td class="align-left"><?php echo htmlentities($r['link']) ?></td>
			<td class="align-left"><?php echo (htmlentities($r['status']) == 'A' ? 'Ativo' : 'Inativo') ?></td>
			<td class="options-width">
				<a href="submenus/<?php echo $r['id'] ?>/edit" class="icon-1 info-tooltip" title="Editar">Editar</a>
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