<?php

include_once dirname(__FILE__) . '/admin/config.php';

/*	Testa se página existe	*/
$link = trim(isset($g['link']) ? $g['link'] : '');

$sql = "SELECT p.titulo,
			   p.texto,
			   l.titulo titulo2,
			   l.link,
			   l.id_pai,
			   p.data_atualizacao
		FROM paginas p,
			 links_menu l
		WHERE l.id_links_menu = p.id_links_menu AND
			  l.link = " . $DBConn->quote($link) . " AND
			  l.status = " . $DBConn->quote('A');
if (($q = $DBConn->query($sql)) && ($r = $q->fetch())) {
	$titulo = htmlentities($r['titulo']);
	$titulo2 = htmlentities($r['titulo2']);
	$texto = $r['texto'];
	$id_pai = $r['id_pai'];
	$data_atualizacao = $r['data_atualizacao'];
	$data = array();
	preg_match('/^(\d+)-(\d+)-(\d+)/', $data_atualizacao, $data);
	$data_atualizacao_formatada = $codigo = sprintf('%02d', preg_replace('|[^\d]|', '', $data[3])) . ' de ' . $months[$data[2]] . ' de ' . $data[1];
	
	/*	Pega dados do nível acima	*/
	$sql = "SELECT titulo,
				   link,
				   id_pai
			FROM links_menu
			WHERE id_links_menu = " . $DBConn->quote($id_pai);
	$q = $DBConn->query($sql);
	$r = $q->fetch();
	$id_pai_nivel_acima = $r['id_pai'];
	$link_nivel_acima = $r['link'];
	$titulo_nivel_acima = htmlentities($r['titulo']);
	/*	=========================	*/
	
	/*	Pega dados do primeiro nível, caso exista	*/
	$sql = "SELECT titulo,
				   link
			FROM links_menu
			WHERE id_links_menu = " . $DBConn->quote($id_pai_nivel_acima);
	if (($q = $DBConn->query($sql)) && ($r = $q->fetch())) {
		$link_nivel_acima2 = $r['link'];
		$titulo_nivel_acima2 = htmlentities($r['titulo']);
	}
	$link_completo = (strlen($link_nivel_acima2) ? $link_nivel_acima2 : $link_nivel_acima) . '/' . $link;
	/*	=========================================	*/

	?><div id="pattern_page">
		<div id="page_nav"><?php
			echo '<div class="page_nav">' . 
				  (strlen($link_nivel_acima2) ? '<a href="' . $link_nivel_acima2 . '" title="' . $titulo_nivel_acima2 . '">' . $titulo_nivel_acima2 . '</a> > ' : '') . 
				  '<a href="' . (strlen($link_nivel_acima2) ? $link_nivel_acima2 . '/' : '') . $link_nivel_acima . '" title="' . $titulo_nivel_acima . '">' . $titulo_nivel_acima . '</a> >
				   <a href="' . $link_completo . '" title="' . $titulo2 . '">' . $titulo2 . '</a></div>';
		?></div>
	
		<div class="left_page"><?php
			echo '<b class="title">' . $titulo . '</b>
			<small class="bottom_title">Última atualização em, ' . $data_atualizacao_formatada . '</small>
			<div class="txt_pattern1">' . $texto . '</div>';
			
			?>
		    <div class="horizontal_bar1"></div>
            <b class="txt_share">Compartilhe:</b>
           
            <!--start Facebook Open Graph Protocol-->
            <meta property="og:site_name" content="Prefeitura Municipal de Santa Cruz do Sul" />
            <meta property="og:title" content="<?php echo $title  ?>" />
            <meta property="og:url" content="<?php echo $_root_url . $link_nivel_acima2 ?>"/>
            <meta property="og:image" content="http://www.pmscs.rs.gov.br/images/img_brasao1.jpg"/>
			<!--end Facebook Open Graph Protocol-->

			<!-- Script Facebook -->
            <div id="fb-root"></div>
			<script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=408967525823934";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

            <fb:like class="btn_facebook" href="<?php echo $_root_url . $link_nivel_acima2 ?>" send="true" layout="button_count" width="160" show_faces="false"></fb:like>
            <a href="https://twitter.com/share" class="twitter-share-button btn_twitter" data-url="<?php echo $_root_url . $link_nivel_acima2 ?>" data-lang="pt">Tweetar</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            <div class="btn_g_plus"><g:plusone size="medium"></g:plusone></div>
            <script type="text/javascript">
              (function() {
                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                po.src = 'https://apis.google.com/js/plusone.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
              })();
            </script>
            <div class="clear"></div>
		</div>
	
		<div class="right_page">
			<a class="btn_box cidadao" href="cidadao" title="Cidadão">
				<span class="img"></span>
				<p class="txt1">Acesso rápido para:</p>
				<p class="txt2">Cidadão</p>
			</a>
			<a class="btn_box empresa" href="empresa" title="Empresa">
				<span class="img"></span>
				<p class="txt1">Acesso rápido para:</p>
				<p class="txt2">Empresa</p>
			</a>
			<div class="clear"></div>
			<a class="btn_box licitacao" href="licitacoes" title="Licitações">
				<span class="img"></span>
				<p class="txt3">Licitações</p>
			</a>
			<div class="clear"></div>
			<a class="btn_box turista" href="turista" title="Turista">
				<span class="img"></span>
				<p class="txt1">Acesso rápido para:</p>
				<p class="txt2">Turista</p>
			</a>
			<a class="btn_box servidor" href="servidor" title="Servidor">
				<span class="img"></span>
				<p class="txt1">Acesso rápido para:</p>
				<p class="txt2">Servidor</p>
			</a>
			<div class="clear"></div>
			<a class="btn_box concurso_publico" href="concursos-publicos" title="Concursos Públicos">
				<span class="img"></span>
				<p class="txt3 align1">Concursos Públicos</p>
			</a>
			<a class="btn_box autodromo" href="autodromo" title="Autódromo">
				<span class="img"></span>
				<p class="txt2 align1">Autódromo</p>
			</a>
			<a class="btn_box semmas" href="semmas" title="S.E.M.M.A.S.">
				<span class="img"></span>
				<p class="txt2 align2">S.E.M.M.A.S.</p>
			</a>
			<div class="clear"></div>
			<a class="btn_box transporte_urbano" href="transporte-urbano" title="Transporte Urbano">
				<span class="img"></span>
				<p class="txt3 align1">Transporte Urbano</p>
			</a>
			<div class="clear"></div>
			<a class="btn_box feira_do_livro" href="feira-do-livro" title="Feira do Livro">
				<span class="img"></span>
				<p class="txt3 align2">Feira do Livro</p>
			</a>
			<div class="clear"></div>
			<a class="btn_box pontos_turisticos" href="pontos-turisticos" title="Pontos Turísticos">
				<span class="img"></span>
				<p class="txt1 align1">Pontos</p>
				<p class="txt2">Turísticos</p>
			</a>
			<a class="btn_box camara" href="camara" title="Câmara">
				<span class="img"></span>
				<p class="txt2">Câmara</p>
			</a>
			<div class="clear"></div>
			<a class="btn_box portal_transparencia" href="portal-da-transparencia" title="Portal da Transparência">
				<span class="img"></span>
				<p class="txt3 align1">Portal da Transparência</p>
			</a>
		</div>
	</div><?php

} else {
	?><div id="pattern_page">
		<p class="txt_pattern1"><br/>Página não encontrada.<br/><br/></p>
	</div><?php
}
/*	======================	*/

?>