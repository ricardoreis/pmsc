<?php

include_once dirname(__FILE__) . '/config.php';

if (logado()) {
	?><body> 
	<!-- Start: page-top-outer -->
	<div id="page-top-outer">    
		<!-- Start: page-top -->
		<div id="page-top">
			<!-- start logo -->
			<div id="logo">
			<a href="home"><img src="../images/logo_header.png" alt="" /></a></div>
			<!-- end logo -->

			<!--  start top-search -->
			<div id="top-search">
				<form action="busca" method="post">
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td><input type="text" name="s" value="<?php echo htmlentities(strlen($s) ? $s : S_DEFAULT, ENT_QUOTES) ?>" class="top-search-inp" /></td>
						<td>
							<select name="url" class="top-search-url">
								<option value="submenus"<?php echo ($arquivo == 'submenus' ? ' selected="selected"' : '') ?>>Submenus</option>
								<option value="paginas"<?php echo ($arquivo == 'paginas' ? ' selected="selected"' : '') ?>>Páginas</option>
                                <option value="noticias"<?php echo ($arquivo == 'noticias' ? ' selected="selected"' : '') ?>>Notícias</option>
								<!--<option value="cursos"<?php echo ($arquivo == 'cursos' ? ' selected="selected"' : '') ?>>Cursos</option>
								<option value="dicas"<?php echo ($arquivo == 'dicas' ? ' selected="selected"' : '') ?>>Dicas</option>
								<option value="paisagismo"<?php echo ($arquivo == 'paisagismo' ? ' selected="selected"' : '') ?>>Paisagismo</option>-->
							</select>
						</td>
						<td>
							<a href="#" class="search">Buscar</a>
						</td>
					</tr>
				</table>
				</form>
			</div>
			<!--  end top-search -->
			<div class="clear"></div>
		</div>
		<!-- End: page-top -->
	</div>
	<!-- End: page-top-outer -->

	<div class="clear">&nbsp;</div>

	<!--  start nav-outer-repeat................................................................................................. START -->
	<div class="nav-outer-repeat"> 
		<!--  start nav-outer -->
		<div class="nav-outer">
			<!-- start nav-right -->
			<div id="nav-right">
				<a href="logout">Logout</a>
				<div class="clear">_</div>
			</div>
			<!-- end nav-right -->

			<!--  start nav -->
			<div class="nav">
				<div class="table">
					<?php if (autorizado('submenus')) { ?><ul class="<?php echo ($arquivo == 'submenus' ? 'current' : 'select') ?>">
						<li>
							<a href="submenus"><b>Submenus</b><!--[if IE 7]><!--></a><!--<![endif]-->
							<!--[if lte IE 6]><table><tr><td><![endif]-->
							<div class="select_sub">
								<ul class="sub">
									<li<?php echo ($arquivo == 'submenus' && $acao == 'busca' ? ' class="sub_show"' : '') ?>><a href="submenus/busca">Listar</a></li>
									<li<?php echo ($arquivo == 'submenus' && $acao == 'add' ? ' class="sub_show"' : '') ?>><a href="submenus/add">Adicionar</a></li>
								</ul>
							</div>
							<!--[if lte IE 6]></td></tr></table></a><![endif]-->
						</li>
					</ul><?php } ?>
                    
                    <?php if (autorizado('paginas')) { ?><ul class="<?php echo ($arquivo == 'paginas' ? 'current' : 'select') ?>">
						<li>
							<a href="paginas"><b>Páginas</b><!--[if IE 7]><!--></a><!--<![endif]-->
							<!--[if lte IE 6]><table><tr><td><![endif]-->
							<div class="select_sub">
								<ul class="sub">
									<li<?php echo ($arquivo == 'paginas' && $acao == 'busca' ? ' class="sub_show"' : '') ?>><a href="paginas/busca">Listar</a></li>
									<li<?php echo ($arquivo == 'paginas' && $acao == 'add' ? ' class="sub_show"' : '') ?>><a href="paginas/add">Adicionar</a></li>
								</ul>
							</div>
							<!--[if lte IE 6]></td></tr></table></a><![endif]-->
						</li>
					</ul><?php } ?>
                    
                    
                    
                    
                     <?php if (autorizado('noticias')) { ?><ul class="<?php echo ($arquivo == 'noticias' ? 'current' : 'select') ?>">
						<li>
							<a href="noticias"><b>Notícias</b><!--[if IE 7]><!--></a><!--<![endif]-->
							<!--[if lte IE 6]><table><tr><td><![endif]-->
							<div class="select_sub">
								<ul class="sub">
									<li<?php echo ($arquivo == 'noticias' && $acao == 'busca' ? ' class="sub_show"' : '') ?>><a href="noticias/busca">Listar</a></li>
									<li<?php echo ($arquivo == 'noticias' && $acao == 'add' ? ' class="sub_show"' : '') ?>><a href="noticias/add">Adicionar</a></li>
								</ul>
							</div>
							<!--[if lte IE 6]></td></tr></table></a><![endif]-->
						</li>
					</ul><?php } ?>
                    
                    
                      <?php if (autorizado('secretarias')) { ?><ul class="<?php echo ($arquivo == 'secretarias' ? 'current' : 'select') ?>">
						<li>
							<a href="secretarias"><b>Secretarias</b><!--[if IE 7]><!--></a><!--<![endif]-->
							<!--[if lte IE 6]><table><tr><td><![endif]-->
							<div class="select_sub">
								<ul class="sub">
									<li<?php echo ($arquivo == 'secretarias' && $acao == 'busca' ? ' class="sub_show"' : '') ?>><a href="secretarias/busca">Listar</a></li>
									<li<?php echo ($arquivo == 'secretarias' && $acao == 'add' ? ' class="sub_show"' : '') ?>><a href="secretarias/add">Adicionar</a></li>
								</ul>
							</div>
							<!--[if lte IE 6]></td></tr></table></a><![endif]-->
						</li>
					</ul><?php } ?>
                    
                    
                    
                       <?php if (autorizado('categorias')) { ?><ul class="<?php echo ($arquivo == 'categorias' ? 'current' : 'select') ?>">
						
					</ul><?php } ?>

					<?php /*if (autorizado('cursos')) { ?><ul class="<?php echo ($arquivo == 'cursos' ? 'current' : 'select') ?>">
						<li>
							<a href="cursos"><b>Cursos</b><!--[if IE 7]><!--></a><!--<![endif]-->
							<!--[if lte IE 6]><table><tr><td><![endif]-->
							<div class="select_sub">
								<ul class="sub">
									<li<?php echo ($arquivo == 'cursos' && $acao == 'busca' ? ' class="sub_show"' : '') ?>><a href="cursos/busca">Listar</a></li>
									<li<?php echo ($arquivo == 'cursos' && $acao == 'add' ? ' class="sub_show"' : '') ?>><a href="cursos/add">Adicionar</a></li>
								</ul>
							</div>
							<!--[if lte IE 6]></td></tr></table></a><![endif]-->
						</li>
					</ul><?php } ?>

					<?php if (autorizado('dicas')) { ?><ul class="<?php echo ($arquivo == 'dicas' ? 'current' : 'select') ?>">
						<li>
							<a href="dicas"><b>Dicas</b><!--[if IE 7]><!--></a><!--<![endif]-->
							<!--[if lte IE 6]><table><tr><td><![endif]-->
							<div class="select_sub">
								<ul class="sub">
									<li<?php echo ($arquivo == 'dicas' && $acao == 'busca' ? ' class="sub_show"' : '') ?>><a href="dicas/busca">Listar</a></li>
									<li<?php echo ($arquivo == 'dicas' && $acao == 'add' ? ' class="sub_show"' : '') ?>><a href="dicas/add">Adicionar</a></li>
								</ul>
							</div>
							<!--[if lte IE 6]></td></tr></table></a><![endif]-->
						</li>
					</ul><?php } ?>

					<?php if (autorizado('paisagismo')) { ?><ul class="<?php echo ($arquivo == 'paisagismo' ? 'current' : 'select') ?>">
						<li>
							<a href="paisagismo"><b>Paisagismo</b><!--[if IE 7]><!--></a><!--<![endif]-->
							<!--[if lte IE 6]><table><tr><td><![endif]-->
							<div class="select_sub">
								<ul class="sub">
									<li<?php echo ($arquivo == 'paisagismo' && $acao == 'busca' ? ' class="sub_show"' : '') ?>><a href="paisagismo/busca">Listar</a></li>
									<li<?php echo ($arquivo == 'paisagismo' && $acao == 'add' ? ' class="sub_show"' : '') ?>><a href="paisagismo/add">Adicionar</a></li>
								</ul>
							</div>
							<!--[if lte IE 6]></td></tr></table></a><![endif]-->
						</li>
					</ul><?php } */?>

					<div class="clear"></div>
				</div>

				<div class="clear"></div>
			</div>
			<!--  start nav -->
		</div>

		<div class="clear"></div>
		<!--  start nav-outer -->
	</div>
	<!--  start nav-outer-repeat................................................... END -->

	<div class="clear"></div>

	<!-- start content-outer ........................................................................................................................START -->
	<div id="content-outer">
		<!-- start content -->
		<div id="content">
			<?php include_once dirname(__FILE__) . '/' . $arquivo . '.php'; ?>
			<div class="clear">&nbsp;</div>
		</div>
		<!--  end content -->

		<div class="clear">&nbsp;</div>
	</div>
	<!--  end content-outer........................................................END -->

	<div class="clear">&nbsp;</div>

	<!-- start footer -->         
	<div id="footer">
	<!-- <div id="footer-pad">&nbsp;</div> -->
		<!--  start footer-left -->
		<div id="footer-left">
			Ag&ecirc;ncia Digital Drop <a href="http://www.dropweb.com.br" onClick="window.open(this); return false">www.dropweb.com.br</a>
		</div>
		<!--  end footer-left -->
		<div class="clear">&nbsp;</div>
	</div>
	<!-- end footer -->

	</body><?php
} else {
	include_once dirname(__FILE__) . '/login.php';
}

?>