<?php

//include_once dirname(__FILE__) . '/produtos.php';

$url = $_root_url . $admin_root . 'submenus';

@header('location: ' . $url);

?><script type="text/javascript">
<!--
	location.href = '<?php echo $url ?>';
-->
</script><?php

?>