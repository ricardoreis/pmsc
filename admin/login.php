<?php

include_once dirname(__FILE__) . '/config.php';

if (!logado()) {
	?><body id="login-bg">
		<div id="login-holder"><?php
			//	Mostra mensagem de erro	//
			if ($tentou_se_logar) {
				?><span class="message-box error">
					<span class="right"><a href="#" title="Fechar">Fechar</a></span>
					<span class="left">Login incorreto.</span>
					<span class="clear"></span>
				</span><?php
			}
			//	=======================	//

			?><div id="logo-login">
				<a href="/home"><img src="../images/logo_header.png" alt="" /></a><br/><br/>
			</div>

			<div class="clear"></div>

			<div id="loginbox">
				<div id="login-inner">
					<form action="login" method="post">
						<input type="hidden" name="continue" value="<?php echo htmlentities($_SERVER['HTTP_REFERER']) ?>" />

						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<th>Login</th>
								<td><input type="text" name="login" value="<?php echo htmlentities($login) ?>" title="Digite seu login" class="login-inp" /></td>
							</tr>
							<tr>
								<th>Senha</th>
								<td><input type="password" name="senha" value="<?php echo htmlentities($senha) ?>" title="Digite sua senha" class="login-inp" /></td>
							</tr>
							<tr>
								<th></th>
								<td>
									<a href="#" class="submit">Logar</a>
									<span class="submit_loading"><img src="images/login/submit_loading.gif" alt="Efetuando login..." /></span>
								</td>
							</tr>
						</table>
					</form>
				</div>

				<div class="clear"></div>
			 </div>
		</div>
	</body><?php
} else {
	//include_once dirname(__FILE__) . '/home.php';

	$url = $_root_url . $admin_root . 'home';

	@header('location: ' . $url);

	?><script type="text/javascript">
	<!--
		location.href = '<?php echo $url ?>';
	-->
	</script><?php
}
?>