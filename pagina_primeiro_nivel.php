<?php

include_once dirname(__FILE__) . '/admin/config.php';

$link = trim(isset($g['link']) ? $g['link'] : '');

?><div id="page_links"><?php
	/*	Recupera os links da página	*/
	$sql = "SELECT id_links_menu
			FROM links_menu
			WHERE link = " . $DBConn->quote($link);
	if (($q = $DBConn->query($sql)) && ($r = $q->fetch())) $id_link = $r['id_links_menu'];
	
	$sql = "SELECT p.titulo,
				   l.link,
				   l.id_pai
			FROM paginas p,
				 links_menu l
			WHERE l.id_links_menu = p.id_links_menu AND
				  l.id_pai = " . $DBConn->quote($id_link) . " AND
				  l.status = " . $DBConn->quote('A') . "
			ORDER BY l.id_links_menu";
	
	if (($q = $DBConn->query($sql)) && count($rows = $q->fetchAll())) {
		$aux = true;
		foreach ($rows as $r) {
			$id_pai = $r['id_pai'];
			$titulo2 = htmlentities($r['titulo']);
			$link2 = htmlentities($r['link']);
			$link_eh_externo = (preg_match('(^http:\/\/|^https:\/\/)', $link2));
			
			if ($aux) {
				$sql = "SELECT titulo,
							   link
						FROM links_menu
						WHERE id_links_menu = " . $DBConn->quote($id_pai);
				$q = $DBConn->query($sql);
				$r = $q->fetch();
				$link_nivel_acima = $r['link'];
				$titulo_nivel_acima = htmlentities($r['titulo']);
				//$link_completo = $link_nivel_acima . '/' . $link;
				$aux = false;
				echo '<b>' . $titulo_nivel_acima . '</b>';
			}
			echo '<a href="' . (!$link_eh_externo ? $link_nivel_acima . '/' : '') . $link2 . '" title="' . $titulo2 . '">' . $titulo2 . '</a><br/>';
		}
		echo '<br/>';
	}
	/*	===========================	*/
    ?>
</div>