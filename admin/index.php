<?php

include_once dirname(__FILE__) . '/config.php';

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sistema de Administra&ccedil;&atilde;o - Prefeitura Municipal de Santa Cruz do Sul</title>

<base href="<?php echo $_root_url . $admin_root ?>" />

<link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />

<link rel="stylesheet" type="text/css" media="screen" title="default" href="css/screen.css" />

<!--[if IE]>
<link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
<![endif]-->

<script type="text/javascript" src="/jquery/jquery.js"></script>
<script type="text/javascript" src="/jquery/jquery.bind.js"></script>
<script type="text/javascript" src="/jquery/jquery.pngfix.js"></script>

<script type="text/javascript" src="/jquery-ui/widgets.js"></script>
<script type="text/javascript" src="/jquery-ui/interactions.js"></script>
<script type="text/javascript" src="/jquery-ui/effects.js"></script>
<script type="text/javascript" src="/jquery-ui/i18n/jquery.ui.datepicker-pt-BR.js"></script>
<link rel="stylesheet" type="text/css" href="/jquery-ui/css/blitzer/styles.css" />

<script type="text/javascript" src="/jquery-ui/checkbox.js"></script>

<script type="text/javascript" src="/jquery/jquery.filestyle.js"></script>

<script type="text/javascript" src="/jquery/jquery.tooltip.js"></script>
<script type="text/javascript" src="/jquery/jquery.dimensions.js"></script>
<script type="text/javascript" src="/jquery/jquery.selectbox.js"></script>

<script type="text/javascript" src="/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript" src="js/funcoes.php"></script>
</head>
<?php include_once dirname(__FILE__) . '/interface.php' ?>
</html>