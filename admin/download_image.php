<?php

include_once dirname(__FILE__) . '/config.php';

$wh = isset($g['wh']) && in_array($g['wh'], array('submenus/fotos', 'dicas/fotos', /*'paisagismo/fotos'*/)) ? $g['wh'] : '';
$fn = trim(isset($g['fn']) ? $g['fn'] : '');
$w = (int)(isset($g['w']) ? $g['w'] : '');
$h = (int)(isset($g['h']) ? $g['h'] : '');

$passou_dimensoes = $w > 0 || $h > 0;
$sessao = $fn == 'session';

switch ($wh) {
	case 'submenus/fotos':  $dir = SUBMENUS_FOTOS_DIR;

							$sql = "SELECT pf.file_name_disk
									 FROM submenus p,
										  submenus_fotos pf
									 WHERE p.id_submenus = " . $DBConn->quote($id) . " AND
									 	   pf.indice = " . $DBConn->quote($indice) . " AND
										   p.id_submenus = pf.id_submenus";

							if (!$sessao && ($q = $DBConn->query($sql)) && ($r = $q->fetch())) {
								$fn = $r['file_name_disk'];
							} elseif ($sessao && strlen($contents = @$_SESSION['submenu'][$id]['fotos'][$indice]['file_contents'])) {
								if (($fp = @fopen($dir . ($fn = 'temp_' . md5(uniqid(rand(), true)) . '.jpg'), 'w')) !== false) {
									@fwrite($fp, $contents);
									@fclose($fp);
								}
							}

							break;

	case 'dicas/fotos': $dir = DICAS_FOTOS_DIR;

						$sql = "SELECT df.file_name_disk
								FROM dicas d,
									 dicas_fotos df
								WHERE d.id_dicas = " . $DBConn->quote($id) . " AND
									  df.indice = " . $DBConn->quote($indice) . " AND
									  d.id_dicas = df.id_dicas";

						if (!$sessao && ($q = $DBConn->query($sql)) && ($r = $q->fetch())) {
							$fn = $r['file_name_disk'];
						} elseif ($sessao && strlen($contents = @$_SESSION['dica'][$id]['fotos'][$indice]['file_contents'])) {
							if (($fp = @fopen($dir . ($fn = 'temp_' . md5(uniqid(rand(), true)) . '.jpg'), 'w')) !== false) {
								@fwrite($fp, $contents);
								@fclose($fp);
							}
						}

						break;

	/*case 'paisagismo/fotos': $dir = PAISAGISMO_FOTOS_DIR;

							$sql = "SELECT pf.file_name_disk
									FROM paisagismo p,
										 paisagismo_fotos pf
									WHERE p.id_paisagismo = " . $DBConn->quote($id) . " AND
										  pf.indice = " . $DBConn->quote($indice) . " AND
										  p.id_paisagismo = pf.id_paisagismo";

							if (!$sessao && ($q = $DBConn->query($sql)) && ($r = $q->fetch())) {
								$fn = $r['file_name_disk'];
							} elseif ($sessao && strlen($contents = @$_SESSION['paisagismo'][$id]['fotos'][$indice]['file_contents'])) {
								if (($fp = @fopen($dir . ($fn = 'temp_' . md5(uniqid(rand(), true)) . '.jpg'), 'w')) !== false) {
									@fwrite($fp, $contents);
									@fclose($fp);
								}
							}

							break;*/
}

if (($no_image = !is_file($filename = $dir . $fn))) $filename = dirname(__FILE__) . '/images/shared/no-image.jpg';

if (is_file($filename)) {
	$ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
	$filetype = 'image/' . ($ext == 'jpg' ? 'jpeg' : $ext);

	if ($passou_dimensoes) {
		list($width_orig, $height_orig) = getimagesize($filename);

		if ($w > $width_orig) $w = $width_orig;
		if ($h > $height_orig) $h = $height_orig;

		if ($w > 0) {
			$width = $w;
			$height = $width * $height_orig / $width_orig;
		} else {
			$height = $h;
			$width = $height * $width_orig / $height_orig;
		}

		$image_p = imagecreatetruecolor($width, $height);

		switch ($ext) {
			case 'gif': $image = imagecreatefromgif($filename); break;
			case 'png': $image = imagecreatefrompng($filename); break;
			default: $image = imagecreatefromjpeg($filename); break;
		}

		@imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

		/*	Pega o conteúdo da imagem	*/
		@ob_start();

		switch ($ext) {
			case 'png': imagepng($image_p, null); break;
			case 'gif': imagegif($image_p, null); break;
			default: imagejpeg($image_p, null, 90); break;
		}

		$image_contents = @ob_get_contents();
		@ob_end_clean();
		/*	=========================	*/
	} else {
		$image_contents = file_get_contents($filename);
	}

	if (ini_get('zlib.output_compression')) ini_set('zlib.output_compression', 'Off'); 

	//	Desabilitar cache	//
	header("Cache-Control: no-cache, must-revalidate");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE") == false) {
		header("Cache-Control: no-cache");
		header("Pragma: no-cache");
	}
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	//	=================	//

	header('Content-type: ' . $filetype);
	header('Content-Disposition: inline; filename="' . $fn . '"');
	header('Content-Length: ' . strlen($image_contents));
	echo $image_contents;

	if ($sessao && !$no_image) @unlink($filename);
}

?>