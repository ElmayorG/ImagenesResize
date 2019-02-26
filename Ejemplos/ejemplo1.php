<?php
	include_once '../imgsinbase.php';
	$imagen = new ImagenResize(400,400,'img/img.jpg');
	$imagen->generaImagen();
?>