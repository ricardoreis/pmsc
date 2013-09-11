<?php

include_once dirname(__FILE__) . '/config.php';

?><div id="page-heading"><h1><?php echo $form_title ?></h1></div><?php

//	Mensagem do sistema	//
if (strlen($message_box_text)) {
	?><span class="message-box <?php echo $message_box_type ?>">
		<span class="right"><a href="#" title="Fechar">Fechar</a></span>
		<span class="left"><?php echo $message_box_text ?></span>
		<span class="clear"></span>
	</span><?php
}
//	===================	//

?><form action="<?php echo $form_action ?>" method="post" enctype="multipart/form-data">
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
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
					<tr valign="top">
						<td>
							<input type="hidden" name="id" value="<?php echo htmlentities($id) ?>" />
							<table border="0" cellpadding="0" cellspacing="0" id="form-table">