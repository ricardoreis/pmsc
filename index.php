<?php

include_once dirname(__FILE__) . '/admin/config.php';

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo $title ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="title" content="Prefeitura de Santa Cruz do Sul"/>
	<meta name="description" content=""/>
	<meta name="keywords" content="prefeitura, santa cruz, santa cruz do sul, turismo santa cruz, pontos turísticos santa cruz, licitação" />
	<meta name="author" content="Wolker Wegner - contato@wolker.com.br"/>
	<meta name="copyright" content="Drop Web"/>
	<meta name="language" content="pt-br"/>
	<meta name="robots" content="index,follow"/>
	
	<!--start Facebook Open Graph Protocol-->
    <meta property="og:url" content="<?php echo $_root_url ?>"/>
    <meta property="og:title" content="Prefeitura de Santa Cruz do Sul" />
    <meta property="og:description" content="Prefeitura de Santa Cruz do Sul." />
    <meta property="og:image" content="<?php echo $_root_url . 'images/logo_loading.jpg' ?>" />
    <!--end Facebook Open Graph Protocol-->

	<base href="<?php echo $_root_url ?>" />
    
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
    
    <!--	Fonte	-->
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,900,400italic,900italic' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" type="text/css" href="css/styles.css" />
    
    <!--[if IE 6]>
		<link rel="stylesheet" type="text/css" href="css/ie7.css" />
    <![endif]-->
    <!--[if IE 7]>
	    <link rel="stylesheet" type="text/css" href="css/ie7.css" />
    <![endif]-->
    <!--[if IE 8]>
    	<link rel="stylesheet" type="text/css" href="css/ie8.css" />
    <![endif]-->

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>

    <!--	jQuery Cycle	-->
	<script type="text/javascript" src="js/cycle/chili-1.7.pack.js"></script>
    <script type="text/javascript" src="js/cycle/jquery.cycle.all.js?v2.23"></script>

	<script type="text/javascript" src="js/funcoes.php"></script>

	<!--	Google Analytics	-->
    <script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-21044498-29']);
		_gaq.push(['_trackPageview']);
		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
</head>

<body>
	<!--<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=218542958279587";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>-->
    
    <div class="site_content">
        <div id="top_header">
            <a class="btn_top facebook" href="#" title="Facebook"></a>
            <a class="btn_top twitter" href="#" title="Twitter"></a>
            <div class="btn_top"></div>
            <p>51 3713 8100</p>
            <div class="clear"></div>
        </div>
	</div>
    
    <div class="site_background">
        <div id="header">
            <a href="home" title="Prefeitura de Santa Cruz"><img width="336" height="71" src="images/logo_header.png" alt="Prefeitura de Santa Cruz" /></a>
            <form action="busca.php" method="post" onsubmit="busca_autocomplete(); return false" id="form_search">
                <div>
	                <a class="btn_search" href="#" onclick="busca_autocomplete(); return false" title="Procurar"></a>
                    <input class="textfield1" type="text" name="s" value="Procurar..." id="form_search_s" title="Digite o que você procura" onkeydown="busca_autocomplete_timeout_cancel()" onkeyup="busca_autocomplete_timeout_set()" onfocus="if (this.value == this.defaultValue) this.value = ''; else this.select()" onblur="if (this.value == '') this.value = this.defaultValue; busca_show_results_container(false)">
                    <div id="autocomplete_search_results_container"></div>
                </div>
            </form>
            <div class="clear"></div>

            <ul id="nav" class="level1">
				<li><a class="<?php echo ($aquivo == 'home' ? 'active' : 'align1') ?>" href="home" title="Principal">Principal</a></li><?php
				
				/*	Recupera os links do menu do sistema	*/
                $sql = "SELECT id_links_menu id,
							   titulo,
							   link
						FROM links_menu
						WHERE nivel = 1
						ORDER BY id_links_menu";
				if (($q = $DBConn->query($sql)) && count($rows = $q->fetchAll())) {
					$x = 0;
					foreach ($rows as $r) {
						$html = '';
						$tem_submenu = false;
						$id = $r['id'];
						$titulo = htmlentities($r['titulo']);
						$link = htmlentities($r['link']);
						
						/*	Recupera os links do submenu do sistema	*/
						//$id_aux = $id;
						//for ($x = 2; $x < $nivel_maximo_submenu; $x++) {
							$sql2 = "SELECT id_links_menu,
											titulo,
											link
									 FROM links_menu
									 WHERE nivel = " . $DBConn->quote('2') . " AND
										   id_pai = " . $DBConn->quote($id) . " AND
										   status = " . $DBConn->quote('A') . "
									 ORDER BY id_links_menu";
							if (($q2 = $DBConn->query($sql2)) && count($rows2 = $q2->fetchAll())) {
								$tem_submenu = true;
								$html .= '<ul class="level2">';
								foreach ($rows2 as $r2)  {
									$novo_id = htmlentities($r2['id_links_menu']);
									$titulo2 = htmlentities($r2['titulo']);
									$link2 = htmlentities($r2['link']);
									$link_eh_externo = (preg_match('(^http:\/\/|^https:\/\/)', $link2));
									$html_botao = ' href="' . (!$link_eh_externo ? $link . '/' . $link2 : $link2) . '" ' . ($link_eh_externo ? 'target="_blank"' : '') . ' title="' . $titulo2 . '">' . $titulo2 . '</a>';
									
									$sql3 = "SELECT id_links_menu,
													titulo,
													link
											 FROM links_menu
											 WHERE nivel = " . $DBConn->quote('3') . " AND
												   id_pai = " . $DBConn->quote($novo_id) . " AND
												   status = " . $DBConn->quote('A') . "
											 ORDER BY id_links_menu";
									if (($q3 = $DBConn->query($sql3)) && count($rows3 = $q3->fetchAll())) {
										$tem_submenu = true;
										$html .= '<li><a class="submenu ' . ($aquivo == $link2 ? 'active' : '') . '"' . $html_botao;
										$html .= '<ul class="level3">';
										foreach ($rows3 as $r3)  {
											$titulo3 = htmlentities($r3['titulo']);
											$link3 = htmlentities($r3['link']);
											$link_eh_externo = (preg_match('(^http:\/\/|^https:\/\/)', $link3));
											$html .= '<li><a class="' . ($aquivo == $link3 ? 'active' : '') . '" href="' . (!$link_eh_externo ? $link . '/' . $link3 : $link3) . '" ' . ($link_eh_externo ? 'target="_blank"' : '') . ' title="' . $titulo3 . '">' . $titulo3 . '</a></li>';
										}
										$html .= '</ul>';
									} else $html .= '<li><a class="' . ($aquivo == $link2 ? 'active' : '') . '"' . $html_botao;
									$html .= '</li>';
								}
								$html .= '</ul>';
							}
						//}
						/*	=======================================	*/
						echo '<li><a class="' . ($tem_submenu ? 'submenu ' : '') . ($aquivo == $link ? 'active' : ((($x++) < 6) ? 'align1' : '')) . '" href="links/' . $link . '" title="' . $titulo . '">' . $titulo . '</a>' . $html . '</li>';
					}
				}
				/*	====================================	*/

				?><!--<li>
                	<a class="submenu <?php echo ($aquivo == 'cidade' ? 'active' : 'align1') ?>" href="cidade" title="Cidade">Cidade</a>
                     <ul class="level2">
                        <li><a class="<?php echo ($aquivo == 'historico-do-municipal' ? 'active' : '') ?>" href="historico-do-municipio" title="Histórico do Município">Histórico do Município</a></li>
                        <li><a class="<?php echo ($aquivo == 'brasao' ? 'active' : '') ?>" href="brasao" title="Brasão Municipal">Brasão</a></li>
                        <li><a class="<?php echo ($aquivo == 'hino-do-municipio' ? 'active' : '') ?>" href="hino-do-municipio" title="Hino do Município">Hino do Município</a></li>
                        <li><a class="<?php echo ($aquivo == 'mapa-do-municipio' ? 'active' : '') ?>" href="mapa-do-municipio" title="Mapa da Cidade">Mapa da Cidade</a></li>
                        <li><a class="<?php echo ($aquivo == 'pontos-turisticos' ? 'active' : '') ?>" href="pontos-turisticos" title="Pontos turísticos">Pontos turísticos</a></li>
                     </ul>
				</li>
				<li><a class="<?php echo ($aquivo == 'governo' ? 'active' : 'align1') ?>" href="governo" title="Governo">Governo</a></li>
				<li><a class="<?php echo ($aquivo == 'secretarias' ? 'active' : 'align1') ?>" href="secretarias" title="Secretarias">Secretarias</a></li>
				<li><a class="<?php echo ($aquivo == 'servicos' ? 'active' : 'align1') ?>" href="subprefeituras" title="Subprefeituras">Subprefeituras</a></li>
				<li><a class="<?php echo ($aquivo == 'noticias' ? 'active' : 'align1') ?>" href="noticias" title="Notícias">Notícias</a></li>
				<li><a class="<?php echo ($aquivo == 'empresas' ? 'active' : 'align1') ?>" href="empresas" title="Empresas">Empresas</a></li>
				<li><a class="<?php echo ($aquivo == 'investidor' ? 'active' : 'align1') ?>" href="investidor" title="Investidor">Investidor</a></li>
				<li><a class="<?php echo ($aquivo == 'turismo' ? 'active' : '') ?>" href="turismo" title="Turismo">Turismo</a></li>
				<li><a class="<?php echo ($aquivo == 'servidor' ? 'active' : '') ?>" href="servidor" title="Servidor">Servidor</a></li>
				<li><a class="<?php echo ($aquivo == 'orgaos' ? 'active' : '') ?>" href="orgaos" title="Orgãos">Orgãos</a></li>
				<li><a class="<?php echo ($aquivo == 'contato' ? 'active' : '') ?>" href="contato" title="Contato">Contato</a></li>-->
            </ul>
            <div class="clear"></div>
        </div>
    
        <div id="dynamic_content"><?php
            include dirname(__FILE__) . '/' . $arquivo . '.php';
        ?></div>
	    <div class="clear"></div>
    
        <div id="footer">
        	<div class="box">
            	<div class="top">
                	<a <?php echo ($aquivo == 'a-prefeitura' ? 'class="active"' : 'align1') ?> href="a-prefeitura" title="Sobre a Prefeitura">Sobre a Prefeitura</a>
                	<a class="<?php echo ($aquivo == 'relações-publicas' ? 'active' : 'align1') ?>" href="relações-publicas" title="Relações Públicas">Relações Públicas</a>
                	<a class="<?php echo ($aquivo == 'concurso-pulico' ? 'active' : 'align1') ?>" href="concurso-pulico" title="Concurso Púlico">Concurso Púlico</a>
                	<a class="<?php echo ($aquivo == 'tomadas-de-precos' ? 'active' : 'align1') ?>" href="tomadas-de-precos" title="Tomadas de Preços">Tomadas de Preços</a>
                	<a class="<?php echo ($aquivo == 'portal-da-transparencia' ? 'active' : '') ?>" href="portal-da-transparencia" title="Portal da Transparência">Portal da Transparência</a>
                	<a class="<?php echo ($aquivo == 'secretaria-de-turismo' ? 'active' : '') ?>" href="secretaria-de-turismo" title="Secretaria de Turismo">Secretaria de Turismo</a>
                	<a class="<?php echo ($aquivo == 'ouvidoria' ? 'active' : '') ?>" href="ouvidoria" title="Ouvidoria">Ouvidoria</a>
                </div>
                <div class="left">
                    <p class="txt1">Endereço</p>
                    <p class="txt2">Rua Borges Medeiros, 650  - Centro<br/>
                       Santa Cruz do Sul - RS<br/>
                       CEP  96810-130<br/>
                       51 3713 8100</p>
                </div>
                <div class="middle">
                    <p class="txt1">Mais acessados</p>
                    <p class="txt2">
                    	<a href="concurso-pulico" title="Concurso Púlico">Concurso Púlico</a><br/>
                    	<a href="tomadas-de-precos" title="Tomadas de Preços">Tomadas de Preços</a><br/>
                        <a href="portal-da-transparencia" title="Portal da Transparência">Portal da Transparência</a><br/>
                        <a href="secretaria-de-turismo" title="Secretaria de Turismo">Secretaria de Turismo</a><br/>
                        <a href="governo" title="Governo">Governo</a><br/>
                        <a href="noticias" title="Notícias">Notícias</a><br/>
                        <a href="empresas" title="Empresas">Empresas</a><br/>
                        <a href="investidor" title="Investidor">Investidor</a><br/>
                        <a href="turismo" title="Turismo">Turismo</a><br/>
                        <a href="servidor" title="Servidor">Servidor</a><br/>
                        <a href="orgaos" title="Orgãos">Orgãos</a>
					</p>
                </div>
                <div class="right">
                    <p class="txt1">Entre em contato</p>
                    <form action="home" method="post" onsubmit="form_message_send(); return false" id="form_message">
                        <div>
                            <input class="textfield2" type="text" name="name" value="Seu nome" title="Digite seu nome" onblur="if (this.value == '') this.value = this.defaultValue" onfocus="if (this.value == this.defaultValue) this.value = ''" />
                            <input class="textfield2" type="text" name="email" value="Seu e-mail" title="Digite seu e-mail" onblur="if (this.value == '') this.value = this.defaultValue" onfocus="if (this.value == this.defaultValue) this.value = ''" />
                            <textarea class="textarea1" rows="" cols="" name="message" title="Digite sua mensagem" onblur="if (this.value == '') this.value = this.defaultValue" onfocus="if (this.value == this.defaultValue) this.value = ''">Digite sua mensagem</textarea>
                            <div class="answer"></div>
                            <a class="btn_send" href="#" onclick="form_message_send(); return false" title="Enviar">Enviar</a>
                            <div class="clear"></div>
                        </div>
                    </form>
                </div>
	            <div class="clear"></div>
            </div>
        </div>

        <a class="logo_footer" href="home" title="Prefeitura de Santa Cruz"><img width="212" height="45" src="images/logo_footer.png" alt="Prefeitura de Santa Cruz" /></a>
        <a class="btn_bottom facebook" href="#" title="Facebook"></a>
        <a class="btn_bottom" href="#" title="Twitter"></a>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <a class="logo_drop" href="http://www.dropweb.com.br" title="Desenvolvido por DROP"><img width="111" height="10" src="images/logo_drop.png" alt="Desenvolvido por DROP" /></a>
</body>
</html>