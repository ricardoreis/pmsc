-- phpMyAdmin SQL Dump
-- version 2.8.2.4
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost:3306
-- Tempo de Geração: Set 09, 2013 as 05:06 PM
-- Versão do Servidor: 5.0.95
-- Versão do PHP: 5.2.6
-- 
-- Banco de Dados: `pmscs`
-- 

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `dicas`
-- 

CREATE TABLE `dicas` (
  `id_dicas` bigint(20) unsigned NOT NULL auto_increment,
  `titulo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  PRIMARY KEY  (`id_dicas`),
  UNIQUE KEY `titulo` (`titulo`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Extraindo dados da tabela `dicas`
-- 


-- --------------------------------------------------------

-- 
-- Estrutura da tabela `dicas_fotos`
-- 

CREATE TABLE `dicas_fotos` (
  `id_dicas` bigint(20) unsigned NOT NULL,
  `indice` smallint(5) unsigned NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `file_ext` varchar(255) NOT NULL,
  `file_size` bigint(20) unsigned NOT NULL,
  `file_contents` longblob,
  `file_name_disk` varchar(255) NOT NULL,
  PRIMARY KEY  (`id_dicas`,`indice`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Extraindo dados da tabela `dicas_fotos`
-- 


-- --------------------------------------------------------

-- 
-- Estrutura da tabela `links_menu`
-- 

CREATE TABLE `links_menu` (
  `id_links_menu` int(11) NOT NULL auto_increment,
  `id_pai` int(11) default NULL,
  `titulo` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `nivel` int(11) NOT NULL,
  `status` enum('A','I') NOT NULL default 'A',
  PRIMARY KEY  (`id_links_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

-- 
-- Extraindo dados da tabela `links_menu`
-- 

INSERT INTO `links_menu` (`id_links_menu`, `id_pai`, `titulo`, `link`, `nivel`, `status`) VALUES (1, NULL, 'Cidade', 'cidade', 1, 'A'),
(2, NULL, 'Governo', 'governo', 1, 'A'),
(3, NULL, 'Secretarias', 'secretarias', 1, 'A'),
(4, NULL, 'Subprefeituras', 'subprefeituras', 1, 'A'),
(5, NULL, 'Notícias', 'noticias', 1, 'A'),
(6, NULL, 'Empresas', 'empresas', 1, 'A'),
(7, NULL, 'Investidor', 'investidor', 1, 'A'),
(8, NULL, 'Turismo', 'turismo', 1, 'A'),
(9, NULL, 'Servidor', 'servidor', 1, 'A'),
(10, NULL, 'Órgãos', 'orgaos', 1, 'A'),
(15, 1, 'Histórico do Município', 'historico-do-municipio', 2, 'A'),
(16, 1, 'Brasão', 'brasao', 2, 'A'),
(11, NULL, 'Contato', 'contato', 1, 'A'),
(20, 3, 'Secretaria Extraordinária do PAC', 'secretaria-extraordinaria-do-pac', 2, 'A'),
(21, 3, 'Secretaria de Desenvolvimento Econômico', 'secretaria-de-desenvolvimento-economico', 2, 'A'),
(22, 3, 'Secretaria de Administração', 'secretaria-de-administracao', 2, 'A'),
(23, 3, 'Secretaria de Agricultura', 'secretaria-de-agricultura', 2, 'A'),
(24, 3, 'Secretaria de Desenvolvimento Social', 'secretaria-de-desenvolvimento-social', 2, 'A'),
(25, 3, 'Secretaria de Meio Ambiente e Saneamento', 'secretaria-de-meio-ambiente-e-saneamento', 2, 'A'),
(26, 3, 'Secretaria de Educação e Cultura', 'secretaria-de-educacao-e-cultura', 2, 'A'),
(27, 3, 'Secretaria de Fazenda', 'secretaria-de-fazenda', 2, 'A'),
(28, 3, 'Secretaria de Habitação e Conservação', 'secretaria-de-habitacao-e-conservacao', 2, 'A'),
(29, 3, 'Secretarias de Obras e Viação', 'secretarias-de-obras-e-viacao', 2, 'A'),
(30, 3, 'Secretaria de Saúde', 'secretaria-de-saude', 2, 'A'),
(31, 3, 'Secretaria de Planejamento e Coordenação', 'secretaria-de-planejamento-e-coordenacao', 2, 'A'),
(32, 3, 'Secretaria de Transportes e Serviços Públicos', 'secretaria-de-transportes-e-servicos-publicos', 2, 'A'),
(33, 3, 'Secretaria de Turismo, Esporte e Lazer', 'secretaria-de-turismo-esporte-e-lazer', 2, 'A');

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `paginas`
-- 

CREATE TABLE `paginas` (
  `id_paginas` int(11) NOT NULL auto_increment,
  `id_links_menu` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `data` date NOT NULL,
  `data_atualizacao` date NOT NULL,
  PRIMARY KEY  (`id_paginas`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- 
-- Extraindo dados da tabela `paginas`
-- 

INSERT INTO `paginas` (`id_paginas`, `id_links_menu`, `titulo`, `texto`, `data`, `data_atualizacao`) VALUES (1, 15, 'Histórico do Município', '<p>&nbsp;</p>\r\n<p style="text-align: center;"><img src="/uploads/Prefeitura 1892.jpg" alt="" width="600" height="401" /></p>\r\n<p>&nbsp;</p>\r\n<p style="text-align: left;">Imagem registrada em 1892, possivelmente quando Jo&atilde;o Leite Pereira da Cunha assumiu como o primeiro intendente do Munic&iacute;pio.</p>\r\n<p style="text-align: left;"><br />Endere&ccedil;o: pra&ccedil;a da Bandeira, no quarteir&atilde;o formado pelas ruas Marechal Floriano, Sete de Setembro, Tenente Coronel Brito e Borges de Medeiros.<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br />Localizado no centro da Pra&ccedil;a da Bandeira, o pr&eacute;dio da Prefeitura Municipal foi constru&iacute;do em estilo neocl&aacute;ssico, lembrando as formas dos templos gregos. A resolu&ccedil;&atilde;o da constru&ccedil;&atilde;o do edif&iacute;cio da C&acirc;mara na Pra&ccedil;a do Carvalho (hoje Pra&ccedil;a da Bandeira) partiu dos moradores da Vila de S&atilde;o Jo&atilde;o de Santa Cruz atrav&eacute;s de vota&ccedil;&atilde;o realizada em 1886.</p>\r\n<p style="text-align: left;"><br />Com a constru&ccedil;&atilde;o do &ldquo;Pa&ccedil;o da C&acirc;mara e dos Ju&iacute;zes&rdquo;, Santa Cruz do Sul passou a contar com um pr&eacute;dio p&uacute;blico com a mais atual tend&ecirc;ncia arquitet&ocirc;nica da &eacute;poca, o Ecletismo. Foi a C&acirc;mara Municipal que decidiu, por meio de plebiscito, em julho de 1886, deixar a cargo dos moradores da Vila a decis&atilde;o da localiza&ccedil;&atilde;o ideal da edifica&ccedil;&atilde;o que, at&eacute; ent&atilde;o, ocupava um pr&eacute;dio localizado na esquina das Ruas S&atilde;o Pedro, atual Rua Marechal Floriano e 28 de setembro. Foram apresentados dois locais: a Pra&ccedil;a de S&atilde;o Pedro, atual Pra&ccedil;a Get&uacute;lio Vargas, e a pra&ccedil;a do Carvalho, atual Pra&ccedil;a da Bandeira, esta eleita com 70% dos votos. Durante a sess&atilde;o da C&acirc;mara de Vereadores em 30 de julho de 1886, o Sr. Carlos Trein Filho, Presidente da C&acirc;mara e Intendente, recebeu a solicita&ccedil;&atilde;o para apresentar or&ccedil;amento das despesas com a constru&ccedil;&atilde;o do edif&iacute;cio. Para isso, publicou edital nos jornais Reforma e Deutsche Zeitung, de Porto Alegre e Luctador, de Rio Pardo, chamando concorrentes para a obra citada.</p>\r\n<p style="text-align: left;"><br />O pr&eacute;dio foi projetado pelo engenheiro Frederico Guilherme Bartholomay e executado pela construtora Heinrich, Sch&uuml;tz e Gressel. Em mar&ccedil;o de 1889, a Quarta e &uacute;ltima C&acirc;mara do Imp&eacute;rio, que integrava C&acirc;mara de Vereadores e Intend&ecirc;ncia, instalou-se na nova sede, estando apenas revestidos o pavimento inferior e a fachada frontal. Assim permaneceu por quase 20 anos, quando ficou definitivamente conclu&iacute;da ao custo total de 45 contos de r&eacute;is. Neste pr&eacute;dio foram comemoradas importantes conquistas do munic&iacute;pio, como a inaugura&ccedil;&atilde;o da Esta&ccedil;&atilde;o Ferrovi&aacute;ria, em 19 de novembro de 1905 e, na mesma data, a eleva&ccedil;&atilde;o da Vila &agrave; categoria de Cidade, com a realiza&ccedil;&atilde;o de suntuosos bailes no &ldquo;Sal&atilde;o Nobre da Prefeitura&rdquo;, atual Sal&atilde;o Nobre da Prefeitura Municipal. Em julho de 1991, a C&acirc;mara de Vereadores foi transferida para o n&ordm; 567 da Rua J&uacute;lio de Castilhos, antigo Cine Apolo, onde permanece instalada.</p>\r\n<p style="text-align: left;"><br />O quadro de funcion&aacute;rios da Prefeitura possui mais de dois mil funcion&aacute;rios de carreira. A Prefeitura Municipal de Santa Cruz possui ainda as seguintes Secretarias:<br />- Secretaria Municipal de Administra&ccedil;&atilde;o;<br />- Secretaria Municipal de Agricultura;<br />- Secretaria Municipal de Desenvolvimento Social;<br />- Secretaria Municipal de Desenvolvimento Econ&ocirc;mico;<br />- Secretaria Municipal de Educa&ccedil;&atilde;o e Cultura;<br />- Secretaria Municipal de Fazenda;<br />- Secretaria Municipal de Habita&ccedil;&atilde;o e Conserva&ccedil;&atilde;o;<br />- Secretaria Municipal de Meio Ambiente e Saneamento;<br />- Secretaria Municipal de Planejamento e Coordena&ccedil;&atilde;o;<br />- Secretaria Municipal de Sa&uacute;de;<br />- Secretaria Municipal de Transportes e Servi&ccedil;os P&uacute;blicos;<br />- Secretaria Municipal de Turismo, Esportes e Lazer;<br />- Procuradoria-Geral do Munic&iacute;pio.</p>', '2013-01-15', '2013-01-16'),
(2, 16, 'Brasão', '<p><img src="/uploads/img_brasao1.jpg" alt="" width="605" height="567" /></p>\r\n<p>&nbsp;</p>\r\n<p>LEI N&deg; 1140, de 29 de dezembro de 1964.<br />&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; ADOTA O BRAS&Atilde;O MUNICIPAL, COMO S&Iacute;MBOLO DO MUNIC&Iacute;PIO E DA CIDADE.<br />&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; ORLANDO OSCAR BAUMHARDT, Prefeito Municipal de Santa Cruz do Sul. Fa&ccedil;o Saber, em cumprimento ao disposto no artigo 53, inciso II, da Lei Org&acirc;nica do Munic&iacute;pio, que o Poder Legislativo decretou e eu sanciono a seguinte Lei:ART. 1&deg; - Fica adotado como s&iacute;mbolo o Bras&atilde;o de Armas, assim descrito:<br />&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; Escudo Portugu&ecirc;s orlando de ouro, esquartelado por uma cruz de prata, simbolizando o nome do munic&iacute;pio. No primeiro quartel, em campo de goles (vermelho), tr&ecirc;s pinheiros de sua cor tendo, ao fundo em prata, os cerros que formam o perfil geogr&aacute;fico de Santa Cruz do Sul; no segundo quartel, em campo de blau (azul), a figura estilizada de um casal colonos, em ouro; no terceiro, em campo de sinople (verde), um arado antigo, de ouro, simbolizando os trabalhadores pioneiros da agricultura local, obra imortal dos colonos que primeiro devassaram os campos e iniciaram a constru&ccedil;&atilde;o da cidade; no quarto, em campo de goles (vermelho), os s&iacute;mbolos do com&eacute;rcio e da ind&uacute;stria, em prata, emblema do progresso e desenvolvimento crescente do munic&iacute;pio, em marcha para o futuro. Ramos de fumo, florescentes, circulando o bras&atilde;o, como &ldquo;tenentes&rdquo; sustentadores que s&atilde;o, agr&iacute;cola e industrialmente, do desenvolvimento de Santa Cruz do Sul. Ramos e flores em suas cores naturais. Listel de goles (vermelho), carregado das palavras &ldquo;SANTA CRUZ DO SUL&rdquo; &ndash; em prata. Tudo encimado pela coroa mural de quatro torres, de prata.<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ART. 2&deg; - O presente Bras&atilde;o ser&aacute; usado em todos os papeis oficiais do munic&iacute;pio sede municipal e nas escolas municipais, em suas fachadas, e em todas as propriedades municipais em que for poss&iacute;vel afix&aacute;-lo.<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ART. 3&deg; - A presente lei entrar&aacute; em vigor na data de sua publica&ccedil;&atilde;o, revogadas as disposi&ccedil;&otilde;es em contr&aacute;rio.<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Gabinete do Prefeito Municipal de Santa Cruz do Sul, 29 de dezembro de 1964.</p>\r\n<p><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ORLANDO OSCAR BAUMHARDT<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Prefeito</p>', '2013-01-16', '2013-01-16'),
(3, 20, 'Secretaria Extraordinária do Programa de Atendimento Habitacional - Pró-Moradia - do PAC', '<p>Secret&aacute;rio Extraordin&aacute;rio do PAC: Gerri Machado<br /><br />Secret&aacute;ria Executiva: Maria Eliane Noronha <br />Coordenadora de Regulariza&ccedil;&atilde;o Fundi&aacute;ria: Maria Ang&eacute;lica Ferreira <br />Coordenadora&nbsp; Social:&nbsp; M&aacute;rcia Maribel Corr&ecirc;a<br />Coordenadora de Projetos: Rizia Brandenburg<br /><br />Endere&ccedil;o: Rua Galv&atilde;o Costa, 755<br />(fundos do Pavilh&atilde;o Central, Parque da Oktoberfest)</p>\r\n<p>&nbsp;</p>\r\n<p><img src="/uploads/PAC.jpg" alt="PAC" width="602" height="400" /></p>\r\n<p>&nbsp;</p>\r\n<p>SECRETARIA EXTRAORDINARIA DO PAC &ndash; PROGRAMA DE ACELERA&Ccedil;&Atilde;O DO CRESCIMENTO.<br /><br />Foi criada em janeiro de 2010 pela Lei n&ordm; e instalada em de 2010 para gerenciar os programas do PAC &ndash; Programa de Acelera&ccedil;&atilde;o do Crescimento do Governo Federal, nas destina&ccedil;&otilde;es de recursos a Santa Cruz do Sul. Entre os principais projetos captados pelo munic&iacute;pio est&atilde;o o Programa Minha Casa minha Vida e programa Pr&oacute; Moradia, ambos inseridos no PAC.<br /><br />&nbsp;<br /><br />S&atilde;o atribui&ccedil;&otilde;es da Secretaria:<br /><br />&eacute; o &oacute;rg&atilde;o central de planejamento, coordena&ccedil;&atilde;o, articula&ccedil;&atilde;o, gerenciamento, fiscaliza&ccedil;&atilde;o e controle da execu&ccedil;&atilde;o dos projetos, a&ccedil;&otilde;es e obras integrantes do Programa de Atendimento Habitacional &ndash; Pr&oacute;-Moradia com recursos do FGTS -&nbsp; e do programa Minha Casa Minha Vida e tem por compet&ecirc;ncia:<br /><br />I &ndash; coordenar, desenvolver e implementar os projetos, a&ccedil;&otilde;es e obras do PAC;<br /><br />II &ndash; estabelecer parcerias com entidades p&uacute;blicas ou privadas buscando desenvolver os projetos, a&ccedil;&otilde;es e obras do PAC ;<br /><br />III &ndash; promover o relacionamento externo do Executivo Municipal junto aos &oacute;rg&atilde;os do Governo Federal e Estadual referentes ao PAC;<br /><br />IV &ndash; articular e coordenar a integra&ccedil;&atilde;o entre as demais secretarias da administra&ccedil;&atilde;o no &acirc;mbito da elabora&ccedil;&atilde;o dos projetos e desenvolvimento de a&ccedil;&otilde;es e obras do PAC;<br /><br />V &ndash; ordenar despesas relacionadas com o PAC no &acirc;mbito do Executivo Municipal;<br /><br />VI &ndash; acompanhar e fiscalizar a execu&ccedil;&atilde;o dos contratos e dos conv&ecirc;nios do PAC;<br /><br />VII &ndash; fornecer informa&ccedil;&otilde;es gerenciais e executar o registro e o arquivamento da documenta&ccedil;&atilde;o de todas as atividades relacionadas ao PAC;<br /><br />VIII &ndash; planejar, executar e fiscalizar o Cronograma de a&ccedil;&otilde;es, servi&ccedil;os e obras do PAC;<br /><br />IX &ndash; articular junto ao Governo Federal a busca de novos recursos referentes ao PAC;<br /><br />X &ndash; promover e coordenar as negocia&ccedil;&otilde;es junto a Caixa Federal, Tesouro Nacional, Minist&eacute;rios e &oacute;rg&atilde;os Federais, para a libera&ccedil;&atilde;o dos recursos, cronogramas de obras, projetos e outros, referentes PAC;<br /><br />XI &ndash; elaborar e preparar os projetos executivos de obras, projetos de trabalho t&eacute;cnico social, projetos ambientais, solicita&ccedil;&otilde;es de licenciamentos, elabora&ccedil;&atilde;o de termos de refer&ecirc;ncia que instruir&atilde;o os editais de licita&ccedil;&atilde;o e elabora&ccedil;&atilde;o de contratos do PAC;<br /><br />XII &ndash; realizar a apresenta&ccedil;&atilde;o dos projetos e discuss&atilde;o das obras e prioridades do PAC junto a comunidade;<br /><br />XIII &ndash; exercer as atribui&ccedil;&otilde;es que lhe forem delegadas pela Prefeita Municipal de Santa Cruz do Sul; e<br /><br />XIX - desempenhar outras compet&ecirc;ncias afins.<br /><br />A Secretaria Municipal Extraordin&aacute;ria PAC ter&aacute; ainda a incumb&ecirc;ncia de preparar, organizar, gerenciar e capacitar o conjunto do Governo e da Sociedade para a implementa&ccedil;&atilde;o das a&ccedil;&otilde;es e obras previstas no Programa.<br /><br />A Secretaria Municipal Extraordin&aacute;ria Do PAC funcionar&aacute; desde a data da promulga&ccedil;&atilde;o da presente Lei Complementar at&eacute; 31 de dezembro de 2013, ficando extinta em 1&ordm; de janeiro de 2014.</p>', '2013-01-17', '2013-01-17'),
(4, 21, 'Secretaria Municipal do Desenvolvimento Econômico', '<p><img src="/uploads/turis_econ_jurid.jpg" alt="" width="352" height="264" /></p>\r\n<p>&nbsp;</p>\r\n<p>Secretaria Municipal de Desenvolvimento Econ&ocirc;mico<br /><br /><br />Secret&aacute;rio: Ubiratan Trindade<br /><br /><br />Endere&ccedil;o: Rua Galv&atilde;o Costa, 755 - Parque da Oktoberfest<br /><br />CEP: 96810-170<br /><br />Telefone: +55 (51) 2109-9200<br /><br />E-mail: <a title="desenvolvimento@santacruz.rs.gov.br" href="mailto: desenvolvimento@santacruz.rs.gov.br">desenvolvimento@santacruz.rs.gov.br</a></p>', '2013-01-17', '2013-01-17'),
(5, 22, 'Secretaria Municipal de Administração', '<p><img src="/uploads/predio secretaria administracao.jpg" alt="" width="350" height="263" /></p>\r\n<p><a style="height: 50px; background-color: #000; color: red; width: 50px; float: left;" href="/clientes/pmscs.rs.gov.br/secretarias/departamento-atribuicoes?phpMyAdmin=dwy0NUOZmy6OXzMHcsx8RZKGTK6">AQUI</a></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Secretaria Municipal de Administra&ccedil;&atilde;o:</strong><br /><br />Maria Eliane Noronha da Rosa</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Departamento de Atribui&ccedil;&otilde;es</strong>:</p>\r\n<p><a href="/clientes/pmscs.rs.gov.br/secretarias/departamento-atribuicoes?phpMyAdmin=dwy0NUOZmy6OXzMHcsx8RZKGTK6">Clique aqui</a> para acessar.</p>\r\n<p>http://dropweb.com.br/clientes/pmscs.rs.gov.br/secretarias/departamento-atribuicoes</p>\r\n<p><strong>Secret&aacute;rio Executivo:</strong><br /><br />Fernando Jos&eacute; Kothe<br /><br />Endere&ccedil;o: Rua Borges de Medeiros, 650 - 2&ordm; Andar<br /><br />CEP: 96810-130 - Telefone: (51) 3713-8100<br /><br />E-mail: <a title="administracao@santacruz.rs.gov.br" href="mailto: administracao@santacruz.rs.gov.br">administracao@santacruz.rs.gov.br</a></p>', '2013-01-17', '2013-09-05'),
(6, 23, 'Secretaria Municipal de Agricultura', '<p><img src="/uploads/agricultura2.jpg" alt="" width="300" height="225" /></p>\r\n<p>&nbsp;</p>\r\n<p><strong>Secretaria Municipal de Agricultura:</strong><br />Iraci Luisa Paulus<br /><br /><strong>Secret&aacute;rio Executivo:</strong><br />Aldo Welker<br /><br />Endere&ccedil;o: Rua Marechal Floriano Peixoto, 15<br /><br />CEP: 96810-000 - Telefone: (51) 3715-3611<br /><br />E-mail: <a title="agricultura@santacruz.rs.gov.br" href="mailto: agricultura@santacruz.rs.gov.br">agricultura@santacruz.rs.gov.br</a></p>', '2013-01-17', '2013-01-17'),
(7, 24, 'Secretaria Municipal de Desenvolvimento Social', '<p><img src="/uploads/DSC07622.JPG" alt="" width="80" height="80" /></p>\r\n<p>&nbsp;</p>\r\n<p><strong>Secretaria Municipal de Desenvolvimento Social:</strong><br />Jos&eacute; Osmar Ip&ecirc; da Silva<br /><br /><strong>Diretor de Socializa&ccedil;&atilde;o e Integra&ccedil;&atilde;o</strong><br />Candida In&ecirc;s Bel&eacute;ia Farias<br /><br /><strong>Diretor para Assuntos da Mulher</strong><br />Vera Iara Oliveira Hammes<br /><br />Endere&ccedil;o: Rua Carlos Trein Filho, 824<br /><br />CEP: 96810-186 - Telefone: (51) 3715 -1895<br /><br />E-mail: <a title="social@santacruz.rs.gov.br" href="mailto: social@santacruz.rs.gov.br">social@santacruz.rs.gov.br</a></p>', '2013-01-17', '2013-01-17'),
(8, 25, 'Secretaria Municipal de Meio Ambiente e Saneamento', '<p><img src="/uploads/meio_ambiente_1.JPG" alt="" width="300" height="201" /></p>\r\n<p>&nbsp;</p>\r\n<p><strong>Secret&aacute;rio Municipal de Meio Ambiente:</strong><br />Jos&eacute; Francisco Antunes<br /><br />Endere&ccedil;o: Rua Galv&atilde;o Costa, 708<br /><br />CEP: 96810-170 - Telefone: (51) 3902-3611<br /><br />E-mail: <a title="atendimento.semmas@santacruz.rs.gov.br" href="mailto: atendimento.semmas@santacruz.rs.gov.br">atendimento.semmas@santacruz.rs.gov.br</a></p>', '2013-01-17', '2013-01-17'),
(9, 26, 'Secretaria Municipal de Educação e Cultura', '<p><img src="/uploads/educa.jpg" alt="" width="448" height="336" /></p>\r\n<p>&nbsp;</p>\r\n<p><strong>Secretaria Muncipal de Educa&ccedil;&atilde;o e Cultura:</strong><br />Ana Maria Robalo Aranda<br /><br /><strong>Secret&aacute;rio Executivo:</strong><br />Maria das Gra&ccedil;as Correa<br /><br />Endere&ccedil;o: Rua Coronel Oscar Jost, 1551<br /><br />CEP: 96815- 713 - Telefone: (51) 3715-2446<br /><br />E-mail: <a title="educacao@santacruz.rs.gov.br" href="mailto: educacao@santacruz.rs.gov.br">educacao@santacruz.rs.gov.br</a><br /><br /><br /><strong>A SMEC EM N&Uacute;MEROS</strong> (dados de Dezembro/2010):<br /><br />- 29 Escolas Municipais de Ensino Fundamental - EMEFS<br />7.017 alunos<br />- 17 Escolas Municipais de Educa&ccedil;&atilde;o Infantil - EMEIS<br />2.794 crian&ccedil;as<br />- 01 N&uacute;cleo Municipal de Educa&ccedil;&atilde;o de Jovens e Adultos - CEMEJA<br />337 alunos<br />- 01 Centro de Atendimento Especializado - CAE<br />Psic&oacute;logos, Assistente Social, Psicopedagogas, M&eacute;dica Pediatra, M&eacute;dica Neurologista e Orientadora Educacional<br />- 01 N&uacute;cleo de Tecnologia Municipal - NTM<br />- TOTAL DE EDUCANDOS: 10.188<br />- TOTAL DE SERVIDORES DA SMEC: 1.646</p>', '2013-01-17', '2013-01-17'),
(10, 27, 'Secretaria Municipal de Fazenda', '<p><img src="/uploads/administracao2.jpg" alt="" width="300" height="225" /></p>\r\n<p>&nbsp;</p>\r\n<p><strong>Secret&aacute;rio Municipal da Fazenda:</strong><br />Reno Luiz Schuh<br /><br /><strong>Secret&aacute;rio Executivo:</strong><br />Nelsi Hoff Muller<br /><br />Endere&ccedil;o: Rua Borges de Medeiros, 650 - 1&ordm; Andar<br /><br />CEP: 96810-130 - Telefone: 3713-8101<br /><br />E-mail: <a title="fazenda@santacruz.rs.gov.br" href="mailto: fazenda@santacruz.rs.gov.br">fazenda@santacruz.rs.gov.br</a></p>', '2013-01-17', '2013-01-17'),
(11, 28, 'Secretaria de Habitação, Conservação e Segurança', '<p><img src="/uploads/DSC07622.JPG" alt="" width="80" height="80" /></p>\r\n<p>&nbsp;</p>\r\n<p><strong>Secretaria Municipal de Habita&ccedil;&atilde;o e Conserva&ccedil;&atilde;o:</strong><br />Wilson David<br /><br />Endere&ccedil;o: Rua Carlos Trein Filho, 824<br /><br />CEP: 96810-186 - Telefone: (51) 3713 -2070<br /><br />E-mail:<a title="habitacao@santacruz.rs.gov.br" href="mailto: habitacao@santacruz.rs.gov.br">habitacao@santacruz.rs.gov.br</a></p>', '2013-01-17', '2013-01-17'),
(12, 29, 'Secretarias Municipal de Obras e Viação', '<p><img src="/uploads/obras2.jpg" alt="" width="300" height="225" /></p>\r\n<p>&nbsp;</p>\r\n<p><strong>Secretaria Municipal de Obras e Via&ccedil;&atilde;o:</strong><br />Nadir Inacio Hermes<br /><br /><strong>Secretaro Executivo</strong><br />Gleci Fatima Garcia<br /><br />Endere&ccedil;o: BR 471 Km 53<br /><br />CEP: 96845-350 - Telefone: (51) 3715-9344<br /><br />E-mail: <a title="obras@santacruz.rs.gov.br" href="mailto: obras@santacruz.rs.gov.br">obras@santacruz.rs.gov.br</a></p>', '2013-01-17', '2013-01-17'),
(13, 30, 'Secretaria Municipal de Saúde', '<p>Secretaria Municipal de Sa&uacute;de</p>', '2013-01-17', '2013-01-17'),
(14, 31, 'Secretaria Municipal de Planejamento e Coordenação', '<p><img src="/uploads/planejamento2.jpg" alt="" width="300" height="225" /></p>\r\n<p>&nbsp;</p>\r\n<p><strong>Secretaria Municipal de Planejamento e Coordena&ccedil;&atilde;o:</strong></p>\r\n<p>Dorli Pereira da Silva<br /><br />Endere&ccedil;o: Rua Tenente Coronel Brito, 333<br /><br />CEP: 96810-020 - Telefone: (51) 3713-8120<br /><br />E-mail: <a title="planejamento@santacruz.rs.gov.br" href="mailto: planejamento@santacruz.rs.gov.br">planejamento@santacruz.rs.gov.br</a></p>', '2013-01-17', '2013-01-17'),
(15, 32, 'Secretaria Municipal de Transportes e Serviços Públicos', '<p><img src="/uploads/transportes2.jpg" alt="" width="300" height="225" /></p>\r\n<p>&nbsp;</p>\r\n<p><strong>Secret&aacute;rio Municipal de Transportes e Servi&ccedil;os P&uacute;blicos:</strong><br />Aldorino Merchior<br /><br /><strong>Secret&aacute;rio Executivo:</strong><br />Roque Jos&eacute; Rauber<br /><br />Rua Tiradentes, 67<br />CEP: 96815-140<br />Telefone: (51) 3715-3611</p>', '2013-01-17', '2013-09-09'),
(16, 33, 'Secretaria de Turismo, Esporte e Lazer', '<p><img src="/uploads/Catedralboa.jpg" alt="" width="500" height="225" /></p>\r\n<p>&nbsp;</p>\r\n<p><strong>Secret&aacute;rio Municipal de Turismo, Esportes e Lazer:</strong><br />Enio Knak<br /><br /><strong>Secret&aacute;rio Executivo:</strong><br />Zoraia de Jesus Pereira dos Santos<br /><br />Avenida Coronel Oscar Jost, 1576<br /><br />e-mail: <a title="turismo@santacruz.rs.gov.br" href="mailto: turismo@santacruz.rs.gov.br">turismo@santacruz.rs.gov.br</a></p>\r\n<p>&nbsp;</p>\r\n<p><img src="/uploads/Fritz_Frida2.jpg" alt="" width="301" height="217" /></p>', '2013-01-17', '2013-01-17');

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `usuarios`
-- 

CREATE TABLE `usuarios` (
  `id_usuarios` bigint(20) unsigned NOT NULL auto_increment,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY  (`id_usuarios`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Extraindo dados da tabela `usuarios`
-- 

INSERT INTO `usuarios` (`id_usuarios`, `nome`, `email`, `login`, `senha`) VALUES (1, 'Admin', 'wolker@dropweb.com.br', 'drop', 'drop0908'),
(2, 'Prefeitura', '', 'admin', 'PrefeituraStaCruz1000');

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `usuarios_permissoes`
-- 

CREATE TABLE `usuarios_permissoes` (
  `id_usuarios` bigint(20) unsigned NOT NULL,
  `modulo` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Extraindo dados da tabela `usuarios_permissoes`
-- 

INSERT INTO `usuarios_permissoes` (`id_usuarios`, `modulo`) VALUES (1, 'submenus'),
(1, 'paginas'),
(2, 'submenus'),
(2, 'paginas');
