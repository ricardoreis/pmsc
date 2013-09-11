<?php

include_once dirname(__FILE__) . '/config.php';

			if ($tem_registros) {
				?><div id="actions-box">
					<a href="#" class="action-slider">A&ccedil;&otilde;es</a>
					<div id="actions-box-slider">
						<a href="#" class="action-delete">Excluir</a>
					</div>
					<div class="clear"></div>
				</div><?php
			}

				?></form>

				<form action="<?php echo $url_busca . $qs_order_by . $qs_pagina ?>" method="post">
				<table border="0" cellpadding="0" cellspacing="0" id="paging-table">
					<tr>
						<td>
							<?php if ($pagina > 2) { ?><a href="<?php echo $url_busca . $qs_order_by . $qs_paginacao ?>pagina/1" class="page-far-left" title="P&aacute;gina 1">1</a><?php } ?>
							<?php if ($pagina > 1) { ?><a href="<?php echo $url_busca . $qs_order_by . $qs_paginacao ?>pagina/<?php echo ($pagina - 1) ?>" class="page-left" title="P&aacute;gina <?php echo ($pagina - 1) ?>"><?php echo ($pagina - 1) ?></a><?php } ?>
							<div id="page-info">P&aacute;gina <strong><?php echo $pagina ?></strong> / <?php echo $numero_paginas ?></div>
							<?php if ($pagina < $numero_paginas) { ?><a href="<?php echo $url_busca . $qs_order_by . $qs_paginacao ?>pagina/<?php echo ($pagina + 1) ?>" class="page-right" title="P&aacute;gina <?php echo ($pagina + 1) ?>"><?php echo ($pagina + 1) ?></a><?php } ?>
							<?php if ($pagina < $numero_paginas - 1) { ?><a href="<?php echo $url_busca . $qs_order_by . $qs_paginacao ?>pagina/<?php echo $numero_paginas ?>" class="page-far-right" title="P&aacute;gina <?php echo $numero_paginas ?>"><?php echo $numero_paginas ?></a><?php } ?>
						</td>
						<td>
							<select name="paginacao" class="paginacao_select">
								<option value="">Registros por p&aacute;gina</option><?php
								foreach ($opcoes_select_paginacao as $k => $v) { ?><option value="<?php echo htmlentities($k) ?>"<?php echo ($k == $paginacao ? ' selected="selected"' : '') ?>><?php echo htmlentities($v) ?></option><?php }
							?></select>
							<a href="#" class="paginacao_ok">OK</a>
							<span class="clear"></span>
						</td>
					</tr>
				</table>
				</form>

				<div class="clear"></div>
			</div>
		</td>
		<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
</table>