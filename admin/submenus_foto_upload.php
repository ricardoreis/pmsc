<?php

include_once dirname(__FILE__) . '/config.php';

if (autorizado('paisagismo')) {
	$HTML = '';

	$fotos = is_array($x = @$_SESSION['paisagismo'][$id]['fotos']) ? $x : array();

	$fez_upload_foto = ($tentou_enviar_foto = ($foto = @$f['foto'])) &&
					   ($foto_temp_name = @$foto['tmp_name']) &&
					   ($foto_file_name = @$foto['name']) &&
					   ($foto_file_type = @$foto['type']) &&
					   ($foto_file_contents = @file_get_contents($foto_temp_name)) &&
					   (function_exists('exif_imagetype') ? exif_imagetype($foto_temp_name) == IMAGETYPE_JPEG : $foto_file_type == 'image/jpeg') &&
					   ($foto_file_ext = 'jpg');

	if ($tentou_enviar_foto) {
		if ($fez_upload_foto) {
			$x = ($y = count($fotos)) < 4 ? $y : 3;

			$fotos[$x] = array('file_name' => $foto_file_name,
							   'file_type' => $foto_file_type,
							   'file_ext' => $foto_file_ext,
							   'file_size' => filesize($foto_temp_name),
							   'file_contents' => $foto_file_contents);
		}
	} elseif ($remover && $indice >= 0) {
		unset($fotos[$indice]);
		$fotos = array_values($fotos);
	}

	$x = count($fotos);
	for ($i = 0; $i < ($x ? $x : 1); $i++) {
		$existe = isset($fotos[$i]);

		$HTML.= '<span class="imagem">' .
					'<img src="download_image.php?wh=paisagismo/fotos&amp;fn=session&amp;id=' . $id . '&amp;indice=' . $i . '&amp;h=130&amp;var=' . mt_rand() . '" alt="Preview" />' .
					($existe ? '<a href="paisagismo_foto_upload.php?id=' . $id . '&amp;indice=' . $i . '&amp;remover=1" target="paisagismo_fotos_upload" class="excluir">Excluir</a>' : '') .
				'</span>';
	}

	$HTML.= '<span class="clear"></span>';

	$_SESSION['paisagismo'][$id]['fotos'] = $fotos;

	echo '<script type="text/javascript">
		<!--
			parent.paisagismo_fotos_show(\'' . addcslashes($HTML, "'") . '\');
		-->
		</script>';
}

?>