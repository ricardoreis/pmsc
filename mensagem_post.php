<?php

include_once dirname(__FILE__) . '/admin/config.php';

$name = utf8_decode(trim(isset($p['name']) ? $p['name'] : ''));
$email = utf8_decode(trim(isset($p['email']) ? $p['email'] : ''));
$message = utf8_decode(trim(isset($p['message']) ? $p['message'] : ''));

$data_hora = date('Y-m-d H:i:s');
$answer_mensagem = '';
$email_enviado = false;

if (isset($p['send'])) {
		if (!strlen($name) || $name == 'Seu nome') $answer_mensagem = 'Preencha o campo <strong>nome</strong> corretamente.';
	elseif (!preg_match($mask_email, $email) || $email == 'Seu e-mail') $answer_mensagem = 'Preencha o campo <strong>e-mail</strong> corretamente.';
	elseif (!strlen($message) || $message == 'Digite sua mensagem') $answer_mensagem = 'Preencha o campo <strong>mensagem</strong> corretamente.';
	else {
		$subject = 'Mensagem pelo site';

		$body = '<html><head></head><body>' .
				'Uma nova mensagem foi enviada pelo formul&aacute;rio "mensagem".<br/><br/>' .
				'Nome: ' . $name . '<br/>' .
				'E-mail: ' . $email . '<br/>' .
				'<div style="margin: 0px auto; width: 100%; text-align: left">' . str_repeat('-', 100) . '<br/>' .
				nl2br($message) . '<br/>' .
				str_repeat('-', 100) . '</div>' . '<br/>' .
				'Hor&aacute;rio: ' . $data_hora .
				'</body></html>';

		$mail = new PHPMailer();
 
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPDebug = false;

		$mail->Host = $mail_host;
		$mail->Port = $mail_port;
		$mail->Username = $mail_user;
		$mail->Password = $mail_pass;

		$mail->From = $mail_from;
		$mail->FromName = $mail_from_name;
 
		$mail->AddReplyTo($email, $name);
		$mail->SetFrom($mail_from, $mail_from_name);
		//$mail->AddAddress($mail_from_form, $mail_from_name);
		$mail->AddAddress('wolker@dropweb.com.br', $mail_from_name);

		$mail->IsHTML(true);

		$mail->Subject = $subject;
		$mail->Body = $body;
		$mail->AltBody = 'Para visualizar esta mensagem, por favor, utilize um leitor de e-mails compatível com HTML.';

		@ob_start();
		$email_enviado = $mail->Send();
		@ob_end_clean();

		$smtp_error = $mail->ErrorInfo;

		$mail->ClearAllRecipients();
		$mail->ClearAttachments();

		$answer_mensagem = $email_enviado ? '<div class="ok">Sua mensagem foi enviada com sucesso.</div>' : '<div class="erro">Sua mensagem n&atilde;o p&ocirc;de ser enviada. Verifique os dados preenchidos e tente novamente. ' . $smtp_error . '</div>';
		/*	=======================================================	*/
	}
}

if (strlen($answer_mensagem)) {
	if (!preg_match('/<div class="ok">/', $answer_mensagem)) $answer_mensagem = '<div class="erro">' . $answer_mensagem . '</div>';

	echo $answer_mensagem;
}

?>