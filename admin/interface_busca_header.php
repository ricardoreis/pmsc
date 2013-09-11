<?php

include_once dirname(__FILE__) . '/config.php';

?><div id="page-heading"><h1><?php echo $form_title ?></h1></div>

<table border="0" cellpadding="0" cellspacing="0" id="content-table">
	<tr>
		<th rowspan="3" class="sized left">&nbsp;</th>
		<th class="topleft"></th>
		<td id="tbl-border-top">&nbsp;</td>
		<th class="topright"></th>
		<th rowspan="3" class="sized right">&nbsp;</th>
	</tr>
	<tr>
		<td id="tbl-border-left"></td>
		<td>
			<div id="content-table-inner">
				<form action="<?php echo $url_busca . $qs_order_by . $qs_paginacao . $qs_pagina ?>" method="post">
				<div id="table-content">
					<table border="0" width="100%" cellpadding="0" cellspacing="0" id="search-table">