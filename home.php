<?php

include_once dirname(__FILE__) . '/admin/config.php';

?><div id="home">
	<div class="left_home1">
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
	</div>
    <div class="right_home1">
        <div id="slideshow" class="pics">
            <a href="noticias/1/titulo_noticia" title="Catedral São João Batista"><img width="620" height="465" src="images/banner2.jpg" /></a>
            <a href="noticias/1/titulo_noticia" title="Catedral São João Batista"><img width="620" height="465" src="images/banner1.jpg" /></a>
            
        <?php
            /*$x = 1;
            foreach ($rows as $r) {
            //do {
                echo '<a id="banner' . $x . '" href="noticias/' . $r['id'] . '/' . urls_amigaveis_formata_string($r['titulo']) . '" title="' . htmlentities($r['titulo']) . '"><img class="img" height="266" src="admin/download_image.php?wh=noticias_miniaturas&fn=' . $r['file_name_disk_miniatura'] . '&h=266" /></a>';
                $x++;
                $ids_noticias_descartar[] = $r['id'];
            } //while ($r = $q->fetch());*/
        ?></div>
        <div id="nav_cycle"></div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    
    <div class="news_home">
    	<a href="#" title="Prefeitura inicia construção de seu novo portal de Internet.">
        	<img width="140" height="140" src="images/img_news_home2.jpg" />
            <span class="right">
                <b>ADMINISTRAÇÃO</b>
                <b class="align1">10 de dezembro 2012</b>
                <div class="clear"></div>
                <p>Telmo Kirst é eleito prefeito em Santa Cruz do Sul, RS.</p>
                <span class="btn_plus"></span>
            </span>
        </a>
        <a class="align1" href="#" title="Campis participa do encontro estadual dos catadores.">
        	<img width="140" height="140" src="images/img_news_home2.jpg" />
            <span class="right">
                <b>DESENVOLVIMENTO SOCIAL</b>
                <b class="align1">18 de outubro 2012</b>
                <div class="clear"></div>
                <p>Telmo Kirst é eleito prefeito em Santa Cruz do Sul, RS.</p>
                <span class="btn_plus"></span>
            </span>
        </a>
    	<a class="no_img" href="#" title="Santa Cruz do Sul registra alto índice de desenvolvimento.">
            <span class="right">
                <b>DESENVOLVIMENTO ECONÔMICO</b>
                <b class="align1">04 de dezembro 2012</b>
                <div class="clear"></div>
                <p>Santa Cruz do Sul registra alto índice de desenvolvimento.</p>
                <p class="align1">Divulgado neste último sábado (01), o Índice Firjan de Desenvolvimento...</p>
                <span class="btn_plus"></span>
            </span>
        </a>
    	<a class="align1 no_img" href="#" title="Prefeitura conclui edital para a concessão do transporte coletivo urbano.">
            <span class="right">
                <b>MUNICIPAL DE FAZENDA</b>
                <b class="align1">06 de julho 2012</b>
                <div class="clear"></div>
                <p>Prefeitura conclui edital para a concessão do transporte coletivo urbano.</p>
                <p class="align1">Em entrevista realizada no Gabinete do Executivo Municipal durante a...</p>
                <span class="btn_plus"></span>
            </span>
        </a>
        <div class="clear"></div>
    </div>

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
    <a class="btn_box transporte_urbano" href="transporte-urbano" title="Transporte Urbano">
        <span class="img"></span>
        <p class="txt3 align1">Transporte Urbano</p>
    </a>
    <div class="clear"></div>

    <div class="news_home left">
    	<a class="no_img2" href="#" title="Prefeitura inicia construção de seu novo portal de Internet.">
        	<span class="right">
                <b>EDUCAÇÃO E CULTURA</b>
                <b class="align1">06 de julho 2012</b>
                <div class="clear"></div>
                <p>Projeto saboreando poesia continua levando poesia para trabalhadores.</p>
	            <span class="bar"></span>
            </span>
        </a>
	    <div class="clear"></div>
    	<a class="no_img2" href="#" title="Prefeitura inicia construção de seu novo portal de Internet.">
        	<span class="right">
                <b>EDUCAÇÃO E CULTURA</b>
                <b class="align1">06 de julho 2012</b>
                <div class="clear"></div>
                <p>Projeto saboreando poesia continua levando poesia para trabalhadores.</p>
	            <span class="bar"></span>
            </span>
        </a>
	    <div class="clear"></div>
    	<a class="no_img2" href="#" title="Prefeitura inicia construção de seu novo portal de Internet.">
        	<span class="right">
                <b>EDUCAÇÃO E CULTURA</b>
                <b class="align1">06 de julho 2012</b>
                <div class="clear"></div>
                <p>Projeto saboreando poesia continua levando poesia para trabalhadores.</p>
	            <span class="bar"></span>
            </span>
        </a>
	    <div class="clear"></div>
    	<a class="no_img2" href="#" title="Prefeitura inicia construção de seu novo portal de Internet.">
        	<span class="right">
                <b>EDUCAÇÃO E CULTURA</b>
                <b class="align1">06 de julho 2012</b>
                <div class="clear"></div>
                <p>Projeto saboreando poesia continua levando poesia para trabalhadores.</p>
	            <span class="bar"></span>
            </span>
        </a>
	    <div class="clear"></div>
    	<a class="no_img2" href="#" title="Prefeitura inicia construção de seu novo portal de Internet.">
        	<span class="right">
                <b>EDUCAÇÃO E CULTURA</b>
                <b class="align1">06 de julho 2012</b>
                <div class="clear"></div>
                <p>Projeto saboreando poesia continua levando poesia para trabalhadores.</p>
	            <span class="bar"></span>
            </span>
        </a>
	    <div class="clear"></div>
        <a class="see_more" href="noticias" title="Ver todas as notícias">Ver todas as <span class="bold">notícias</span></a>
	</div>
    
    <div class="tourism_home">
	    <a href="pontos-turisticos/1/titulo_ponto_turistico" title="Fritz e Frida"><img width="152" height="160" src="images/img_ponto_turistico1.jpg" /></a>
	    <a href="pontos-turisticos/1/titulo_ponto_turistico" title="Fritz e Frida"><img width="152" height="160" src="images/img_ponto_turistico2.jpg" /></a>
	    <a class="align1" href="pontos-turisticos/1/titulo_ponto_turistico" title="Fritz e Frida"><img width="153" height="160" src="images/img_ponto_turistico3.jpg" /></a>
	    <a href="pontos-turisticos/1/titulo_ponto_turistico" title="Fritz e Frida"><img width="152" height="160" src="images/img_ponto_turistico4.jpg" /></a>
	    <a href="pontos-turisticos/1/titulo_ponto_turistico" title="Fritz e Frida"><img width="152" height="160" src="images/img_ponto_turistico5.jpg" /></a>
	    <a class="align1" href="pontos-turisticos/1/titulo_ponto_turistico" title="Fritz e Frida"><img width="152" height="160" src="images/img_ponto_turistico6.jpg" /></a>
	    <a href="pontos-turisticos/1/titulo_ponto_turistico" title="Fritz e Frida"><img width="152" height="160" src="images/img_ponto_turistico7.jpg" /></a>
	    <a href="pontos-turisticos/1/titulo_ponto_turistico" title="Fritz e Frida"><img width="152" height="160" src="images/img_ponto_turistico8.jpg" /></a>
	    <a class="align1" href="pontos-turisticos/1/titulo_ponto_turistico" title="Fritz e Frida"><img width="152" height="160" src="images/img_ponto_turistico9.jpg" /></a>
		<div class="clear"></div>
        <a class="see_more" href="pontos-turisticos" title="Ver todas os pontos turísticos">Ver todos os pontos <span class="bold">turísticos</span></a>
    </div>
    <div class="clear"></div>
    
    <div class="events_home">
    	<a class="event1" href="eventos/titulo_evento" title="Festa de Reivellon">
        	<span class="box">
                <b>31</b>
                <p>DEZ</p>
            </span>
            <span class="right">
            	<b>Festa de Reivellon</b>
                <b>Local: <span class="normal">Clube União (Santa Cruz do Sul)</span></b>
			</span>
		</a>
    	<a class="event1" href="eventos/titulo_evento" title="Festa de Reivellon">
        	<span class="box">
                <b>31</b>
                <p>DEZ</p>
            </span>
            <span class="right">
            	<b>Festa de Reivellon</b>
                <b>Local: <span class="normal">Clube União (Santa Cruz do Sul)</span></b>
			</span>
		</a>
    	<a class="event1 align1" href="eventos/titulo_evento" title="Festa de Reivellon">
        	<span class="box">
                <b>31</b>
                <p>DEZ</p>
            </span>
            <span class="right">
            	<b>Festa de Reivellon</b>
                <b>Local: <span class="normal">Clube União (Santa Cruz do Sul)</span></b>
			</span>
		</a>
        <a class="btn_all" href="eventos" title="Ver todos os eventos">Ver todos os <span class="bold">eventos</span></a>
        <div class="clear"></div>
    </div>

	<div class="btns_home">
        <a class="btn_box portal_transparencia" href="portal-da-transparencia" title="Portal da Transparência">
            <span class="img"></span>
            <p class="txt3 align1">Portal da Transparência</p>
        </a>
        <a class="btn_box camara" href="camara" title="Câmara">
            <span class="img"></span>
            <p class="txt2">Câmara</p>
        </a>
        <div class="clear"></div>
        <a class="btn_box pontos_turisticos" href="pontos-turisticos" title="Pontos Turísticos">
            <span class="img"></span>
            <p class="txt1 align1">Pontos</p>
            <p class="txt2">Turísticos</p>
        </a>
        <a class="btn_box feira_do_livro" href="feira-do-livro" title="Feira do Livro">
            <span class="img"></span>
            <p class="txt3 align2">Feira do Livro</p>
        </a>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>