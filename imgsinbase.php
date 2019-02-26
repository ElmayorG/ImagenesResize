<?php
	/* Código creado por Edgar A Olvera*/
	class ImagenResize{
		private $largo;
		private $ancho;
		private $imagen;
		private $formato;

		private $error;

		function __construct($largo,$ancho,$imagen){
			$this->largo = $largo;
			$this->ancho = $ancho;
			$this->imagen = $imagen;
			$explode = explode('.',$imagen);
			$contar = count($explode);
			$this->formato= $explode[$contar-1];
		}

		protected function obtenerErrores(){
			if($this->largo <= 0){
				$this->error = "Debe ser mayor a cero el largo";
				return false;
			}else if($this->ancho <= 0){
				$this->error = "El ancho de la imagen debe ser mayor a cero";
				return false;
			}else if($this->formato != 'jpeg' && $this->formato != 'jpg' && $this->formato != 'png'){//Se pueden agregar más archivos
				$this->error = "Formato de archivo no admitido";
				return false;
			}

			return true;

		}

		public function generaImagen()
		{
			if($this->obtenerErrores()){
				if($this->formato == 'jpeg' || $this->formato== 'jpg'){
						header('Content-Type: image/jpeg');
						list($ancho, $alto) = getimagesize($this->imagen);
						$thumb = imagecreatetruecolor($this->ancho, $this->largo);
						$origen = imagecreatefromjpeg($this->imagen);
						// Cambiar el tamaño
						imagecopyresized($thumb, $origen, 0, 0, 0, 0, $this->ancho, $this->largo, $ancho, $alto);
						// Imprimir
						imagejpeg($thumb);
				}else if($this->formato == 'png'){
					header('Content-Type: image/png');
					// Obtener los nuevos tamaños
					list($ancho, $alto) = getimagesize($this->imagen);
					$thumb = imagecreatetruecolor($this->ancho, $this->largo);
					$origen = imagecreatefromjpeg($this->imagen);
					// Cambiar el tamaño
					imagecopyresized($thumb, $origen, 0, 0, 0, 0, $this->ancho, $this->largo, $ancho, $alto);
					// Imprimir la iagen
					imagejpeg($thumb);
				}

				imagedestroy($thumb); //Destruye la imagen
				
			}else{
				header("Content-Type: image/png");
				$im = @imagecreate(512, 30);
				$color_fondo = imagecolorallocate($im, 0, 153, 255);
				$color_texto = imagecolorallocate($im, 255, 255, 255);
				imagestring($im, 10, 5, 5,$this->error, $color_texto);
				imagepng($im);
				imagedestroy($im);
			}
		}

	}
?>