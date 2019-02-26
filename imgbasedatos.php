<?php
/* Código creado por Edgar A Olvera*/
/* Imagenes usando base de datos*/
require 'def.php';//Para definir la conexión a SQL
$conecta = new mysqli(lugar,user,pass,dat);
if(!empty($_GET)){
	if(isset($_GET['id']) && !isset($_GET['idm'])){	
		$id = $_GET['id'];
		$query = 'SELECT id_tour,imagen_tour,marco FROM tours WHERE id_tour="'.$id.'"';
		if($ejecuta = $conecta->query($query)){
				$datos = $ejecuta->fetch_array(MYSQL_ASSOC);
				// Fichero
				$marco = $datos['marco'];
				$imgTour = explode('/', $datos['imagen_tour']);
				$numeraT = count($imgTour);
				if($numeraT == 3){
					$nombre_fichero = $imgTour[1].'/'.$imgTour[2];
					$tipoImg = explode('.',$imgTour[2]);
					$tipo = $tipoImg[1];
				}else if($numeraT == 4){
					$nombre_fichero = $imgTour[1].'/'.$imgTour[2].'/'.$imgTour[3];
					$tipoImg = explode('.',$imgTour[3]);
					$tipo = $tipoImg[1];
				}else{
					echo "Error contacte al administrador <strong>ERROR:DIRNUL</strong>";
				}
				//echo $nombre_fichero;
				// Tipo de contenido

				if($tipo == 'jpeg' || $tipo == 'jpg'){
					header('Content-Type: image/jpeg');
					if($marco == "1"){
						// Obtener los nuevos tamaños
						list($ancho, $alto) = getimagesize($nombre_fichero);
						list($anchol, $altol) = getimagesize('media/sello_calidad.png');
						$nuevol_ancho = 50;
						$nuevol_alto = 150;
						$nuevo_ancho = 1000;
						$nuevo_alto = 659;
						// Cargar
						$thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
						$origen = imagecreatefromjpeg($nombre_fichero);
						$marco = imagecreatefrompng('media/sello_calidad.png');
						// Cambiar el tamaño
						imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
						
						// Imprimir
						imagejpeg($thumb);
					}else if($marco == "2"){

						// Obtener los nuevos tamaños
						list($ancho, $alto) = getimagesize($nombre_fichero);
						//$nuevo_ancho = 450;
						//$nuevo_alto = 350;
						$nuevo_ancho = 1000;
						$nuevo_alto = 659;
						// Cargar
						$thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
						$origen = imagecreatefromjpeg($nombre_fichero);
					
						// Cambiar el tamaño
						imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
					
						// Imprimir
						imagejpeg($thumb);
					}else{
						// Obtener los nuevos tamaños
						list($ancho, $alto) = getimagesize($nombre_fichero);
						//$nuevo_ancho = 450;
						//$nuevo_alto = 350;
						$nuevo_ancho = 1000;
						$nuevo_alto = 659;
						// Cargar
						$thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
						$origen = imagecreatefromjpeg($nombre_fichero);
					
						// Cambiar el tamaño
						imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
					
						// Imprimir
						imagejpeg($thumb);
					}
				}else if($tipo == 'png'){
					header('Content-Type: image/png');
					// Obtener los nuevos tamaños
					list($ancho, $alto) = getimagesize($nombre_fichero);
					$nuevo_ancho = 450;
					$nuevo_alto = 350;
				
					// Cargar
					$thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
					$origen = imagecreatefrompng($nombre_fichero);
				
					// Cambiar el tamaño
					imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
				
					// Imprimir
					imagepng($thumb);
				}

				imagedestroy($thumb);
				
			}else{
				echo "Error: ".$conecta->error;
			}
	}else if(isset($_GET['id']) && isset($_GET['idm'])){
		$id=$_GET['id'];
		$idm=$_GET['idm'];
		$query = 'SELECT id_tour,id_imagen,urlimg FROM imagenes WHERE id_tour="'.$id.'" AND id_imagen="'.$idm.'"';
		if($ejecuta = $conecta->query($query)){
				$datos = $ejecuta->fetch_array(MYSQL_ASSOC);
				// Fichero
				$imgTour = explode('/', $datos['urlimg']);
				$numeraT = count($imgTour);
				if($numeraT == 3){
					$nombre_fichero = $imgTour[1].'/'.$imgTour[2];
					$tipoImg = explode('.',$imgTour[2]);
					$tipo = $tipoImg[1];
				}else if($numeraT == 4){
					$nombre_fichero = $imgTour[1].'/'.$imgTour[2].'/'.$imgTour[3];
					$tipoImg1 = explode('.jpg',$imgTour[3]);
					$tipoImg2 = explode('.jpeg',$imgTour[3]);
					$tipoImg3 = explode('.png',$imgTour[3]);
					if(count($tipoImg1) > 1){
						$tipo = 'jpg';
					}else if(count($tipoImg2) > 1){
						$tipo = 'jpeg';
					}else if(count($tipoImg3) > 1){
						$tipo = 'png';
					}
				}else{
					echo var_dump($imgTour);
					echo "Error contacte al administrador <strong>ERROR:DIRNUL</strong>";
				}
				// Tipo de contenido
				if($tipo == 'jpeg' || $tipo == 'jpg'){
					header('Content-Type: image/jpeg');
					
					// Obtener los nuevos tamaños
					list($ancho, $alto) = getimagesize($nombre_fichero);
					$nuevo_ancho = 1000;
					$nuevo_alto = 659;
				
					// Cargar
					$thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
					$origen = imagecreatefromjpeg($nombre_fichero);
				
					// Cambiar el tamaño
					imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
				
					// Imprimir
					imagejpeg($thumb);

				}else if($tipo == 'png'){
					header('Content-Type: image/png');
					// Obtener los nuevos tamaños
					list($ancho, $alto) = getimagesize($nombre_fichero);
					$nuevo_ancho = 450;
					$nuevo_alto = 350;
				
					// Cargar
					$thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
					$origen = imagecreatefrompng($nombre_fichero);
				
					// Cambiar el tamaño
					imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
				
					// Imprimir
					imagepng($thumb);
				}

				imagedestroy($thumb);
				
			}else{
				echo "Error: ".$conecta->error;
			}
	}
}else{
	echo "Datos no recividos";
}
?>