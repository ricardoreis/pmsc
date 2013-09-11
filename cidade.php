<?php

include_once dirname(__FILE__) . '/admin/config.php';

?><div id="page_links">
	<b>Cidade</b><?php

	/*	Recupera os links da página	*/
	$sql = "SELECT p.titulo,
				   l.link
			FROM paginas p,
				 links_menu l
			WHERE l.id_links_menu = p.id_links_menu AND
				  l.id_pai = " . $DBConn->quote('1') . " AND
				  l.nivel = " . $DBConn->quote('2') . " AND
				  l.status = " . $DBConn->quote('A') . "
			ORDER BY l.id_links_menu";
	if (($q = $DBConn->query($sql)) && count($rows = $q->fetchAll())) {
		foreach ($rows as $r) {
			$titulo = htmlentities($r['titulo']);
			$link = htmlentities($r['link']);
			$link_eh_externo = (preg_match('(^http:\/\/|^https:\/\/)', $link));
			echo '<a href="' . (!$link_eh_externo ? 'cidade/' : '') . $link . '" title="' . $titulo . '">' . $titulo . '</a><br/>';
		}
		echo '<br/>';
	}
	/*	===========================	*/
    ?><!--<a href="historico-do-municipio" title="Histórico do Município">Histórico do Município</a><br/>
	<a href="brasao" title="Brasão">Brasão</a><br/>
	<a href="hino" title="Hino">Hino</a><br/>
	<a href="mapa-da-cidade" title="Mapa da Cidade">Mapa da Cidade</a><br/>
	<a href="pontos-turisticos" title="Pontos turísticos">Pontos turísticos</a><br/><br/>-->
</div>