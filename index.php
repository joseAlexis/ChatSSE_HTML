<!DOCTYPE html>
<html>

<head>
	<script type="text/javascript" src="js/script.js"></script>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>

<header>
		<img src="imagenes/wechat-logo.png" alt="" id="logo">
</header>

<?php 	/****** CAMBIAR EL COLOR DEL FONDO ******/
	
	$upload = "";
	
	if (isset($_POST['txtFondo'])){
		$imgFondo = $_POST['txtFondo'];
		
		if ($imgFondo != "") {

			if ($imgFondo == 1) {
				echo '<body id="body" onload="getLocation()" background="imagenes/1.jpg">';
			}
			elseif ($imgFondo == 2) {
				echo '<body id="body" onload="getLocation()" background="imagenes/2.jpg">';
			}
			elseif ($imgFondo == 3) {
				echo '<body id="body" onload="getLocation()" background="imagenes/3.jpg">';
			}
			elseif ($imgFondo ==4) {
				echo '<body id="body" onload="getLocation()"';
			}
			elseif ($imgFondo == "rojo") {
				echo '<body id="body" onload="getLocation()" class="bodyRojo">';
			}
		}
	}
	else{
		echo '<body id="body" onload="getLocation()" onunload="confirmarSalida()"';
	}

	if (!empty($_FILES['archivo'])) {
		if ($_FILES["archivo"]["size"] > 0) {
			if ($_FILES["archivo"]["error"] > 0) {
				echo "Error: ".$_FILES["archivo"]["error"]."<br>";
			}
			else{
				if (file_exists('upload/'.$_FILES["archivo"]["error"])) {
					echo "Error! El archivo ya existe";
				}
				else{
					$upload = $_FILES["archivo"]["name"];
					$ubicacionArchivo = 'upload/'.$upload;
					$tipoArchivo = $_FILES["archivo"]["type"];
					move_uploaded_file($_FILES["archivo"]["tmp_name"], $ubicacionArchivo);
				}
			}
		}
	}
?>
	<br>
	<br>
	<br>

	<div id="tituloHistorial" >Historial Usuarios</div>
	<br>
	<div id="idUsuarios" class="historialUsuarios"></div>
	<br>

	<div class="textoMostrar" id="txtChat"></div>

	<form method="POST" action="index.php" id="frmChat" enctype="multipart/form-data">
		<div class="areaUsuario">
			<label>Nickname: </label>
			
			<?php /****** MANTENER EL USUARIO EN EL FORMULARIO ******/
				
				if(isset($_POST['txtUsuario'])) {
					$usuario = $_POST['txtUsuario'];
					
					if($usuario == "") {
						echo "<input type='text' name='txtUsuario' id='idUsuario'>";			
					}
					else {
						echo "<input type='text' name='txtUsuario' id='idUsuario' value=".$usuario.">";
					}
				}
				else {
					echo "<input type='text' name='txtUsuario' id='idUsuario'>";			
				}
			?>
		</div>

		<div class="archivo">
			<input type="file" name="archivo" id="archivo" onclick="subirArchivo()">
			<!-- <input type="submit" value="Subir Archivo" name="btnSubir" onclick="subirArchivo()"> -->
		</div>
		
		<br>
		<br>
		
		<div class="areaMensaje">
			
			<label>Selecciona el color de tu mensaje: </label>
			<?php
				if (isset($_POST['txtColor'])) {
					$pick = $_POST['txtColor'];

					if ($pick != "") {
						echo '<input type="color" name="txtColor" id="idColor" value="'.$pick.'">';
					}
					else{
						echo '<input type="color" name="txtColor" id="idColor">';
					}
				}
				else{
					echo '<input type="color" name="txtColor" id="idColor">';
				}
			?>
			<!-- <input type="color" name="txtColor" id="idColor"> -->

			<br>

			<label>Mensaje: </label>
			<input type="text" id="txtTexto" name="texto" onkeypress="cambiaColor()">
				
			<input type="submit" value="Enviar" name="btnEnviar" class="boton" onclick="validarPalabras()">
			
			<?php 	/****** MANTENER LA LATITUD Y LONGITUD EN EL FOMRMULARIO ******/
				
				if (isset($_POST['txtLatitud']) && isset($_POST['txtLongitud'])) {
					$latitud = $_POST['txtLatitud'];
					$longitud = $_POST['txtLongitud'];

					if ($latitud == "" && $longitud == "") {
						echo "<input type='text' name='txtLatitud' id='idLatitud' class='invisible'>";
						echo "<input type='text' name='txtLongitud' id='idLongitud' class='invisible'>";
					}
					else
					{
						echo "<input type='text' name='txtLatitud' id='idLatitud' class='invisible' value=".$latitud.">";
						echo "<input type='text' name='txtLongitud' id='idLongitud' class='invisible' value=".$longitud.">";
					}
				}
				else{
					echo "<input type='text' name='txtLatitud' id='idLatitud' class='invisible'>";
					echo "<input type='text' name='txtLongitud' id='idLongitud' class='invisible'>";
				}
			?>
		<br>

		<input type="button" onclick="mostrarEmoticonos()" value="Emoticonos">
		<div id="menuEmoticonos">
			<a href="#index.php" onclick="agregarEmoticon1()"> <img src="imagenes/1.gif"> </a>
			<a href="#index.php" onclick="agregarEmoticon2()"> <img src="imagenes/2.gif"> </a>
			<a href="#index.php" onclick="agregarEmoticon3()"> <img src="imagenes/3.gif"> </a>
			<a href="#index.php" onclick="agregarEmoticon4()"> <img src="imagenes/4.gif"> </a>
			<a href="#index.php" onclick="agregarEmoticon5()"> <img src="imagenes/5.gif"> </a>
		</div>

		</div>
		
		<label>Cambia tu fondo: </label>
		<select name="ImagenFondo" id="idCombo">
			<option value="1">Fondo1</option>
			<option value="2">Fondo2</option>
			<option value="3">Fondo3</option>
			<option value="4">Ninguno</option>
		</select>
		<input type="submit" value="Cambiar" name="btnCambiar" onclick="obtenerFondo()">
		<!--  -->
		
		<br>

		<?php
		if (isset($_POST['txtFondo'])) {
			$srcFondo = $_POST['txtFondo'];

			if ($srcFondo == "") {
				echo '<input type="text" name="txtFondo" id="idFondo" class="invisible">';
			}
			else{
				echo '<input type="text" name="txtFondo" id="idFondo" class="invisible" value="'.$srcFondo.'">';
			}
		}
		else{
			echo '<input type="text" name="txtFondo" id="idFondo" class="invisible">';
		}
		?>
		<div id="otros">
			<a href="descarga.php?archivo=chat.txt" target="_blank">Exportar Conversacion</a>
			<br>
			<a href="index.php" onclick="confirmarSalida()" id="linkSalir">Salir</a>
			<!-- <input type="submit" onclick="confirmarSalida()" id="linkSalir" value="Salir"> -->
		</div>
	</form>
	
	<?php
	$nombreArchivo = "chat.txt";

	if(isset($_GET['salir'])){
		$salida = $_GET['salir'];

		if($salida == "s"){

			$usuarioSalir = $_GET['usuarioAbandona'];
			
			$salida = "<span style='color:#FF0000'> El usuario ".$usuarioSalir." ha abandonado el chat </span> <br>";

			$gestor = fopen($nombreArchivo, "a") or die ("Problemas en la creacion"); 
						
			fwrite($gestor, $salida);
											
			fclose($gestor);

			echo "<script> cerrar() </script>";
		}
	}



	?>
	<?php /****** ESCRIBIR EN EL ARCHIVO ******/
		if (isset($_POST['btnEnviar'])) {

			if(isset($_POST['txtUsuario'])) {

				$usuario = $_POST['txtUsuario'];		
				
				if ($usuario != "") {

					if(isset($_GET['comentario']) || $upload != "") {
						$contenido = $_GET['comentario'];

						if ($contenido != " " || $upload != "") {

							if(isset($_GET['ubicacion'])) {
						
								$ubicacion = $_GET['ubicacion'];
							
								if ($ubicacion != "") {

									/****** CONTROL DE USUARIOS ******/
									$archivoUsuarios = "usuarios.txt";
									$posicion = -1;

									$fichero = fopen($archivoUsuarios, "a") or die ("Problemas en la creacion"); 

									if(file_exists($archivoUsuarios) && filesize($archivoUsuarios)){
										$contenidoUsuarios = file_get_contents($archivoUsuarios);

										$users = explode("<br>", $contenidoUsuarios);
								
										for ($i = 0; $i < count($users); $i++) { 
											if($users[$i] == $usuario){
												$posicion = $i;
											}
										}	
									}

									fclose($fichero);

									if($posicion == -1){
										$usuario2 = $usuario;
										$gestorUsuarios = fopen($archivoUsuarios, "a") or die ("Problemas en la creacion"); 
										fwrite($gestorUsuarios, $usuario2."<br>");
										fclose($gestorUsuarios);
									}

									/****** ESCRIBIR EL MENSAJE ******/

									if (isset($_POST['txtColor'])) {
										$colorPicker = $_POST['txtColor'];

										if($colorPicker != ""){
											$contenido = "<span style='color:".$colorPicker."'>".$contenido."</span>";
										}
									}
									
									if ($upload != "") {

										$contenido = $contenido."<a href='descarga.php?archivo=".$ubicacionArchivo."' id='msjAdjunto' target='_blank'>&lt;".$upload."&gt;</a>";
									}

									$ubicacion = "(<a href='mapa.php?ubicacion=$ubicacion' target='_blank'>".$ubicacion."</a>)";

									$usuario = "<b>".$usuario."</b>";			
													
									$contenido .= $ubicacion;
									$contenido .= "<br>";
									
									$gestor = fopen($nombreArchivo, "a") or die ("Problemas en la creacion"); 
						
									fwrite($gestor, $usuario.": ".$contenido);
								
									echo "<label class='mensajeEnviado'>Mensaje Enviado!...</label>";
						
									fclose($gestor);
								}
								else{
									echo "<label class='mensajeError'>Hay un problema con la ubicacion!...</label>";
									echo "aqui2 ubicacion";
								}
							}
							else{
								echo "<label class='mensajeError'>Hay un problema con la ubicacion!...</label>";
							}
						}
						else{
							echo "<label class='mensajeError'>Debe escribir un mensaje!...</label>";
						}
					}
					else{
						echo "<label class='mensajeError'>Debe escribir un mensaje!...</label>";
					}
				}
				else{
					echo "<label class='mensajeError'>Debe escribir un Nickname!...</label>";		
				}
			}
			else{
				echo "<label class='mensajeError'>Debe escribir un Nickname!...</label>";		
			}
		}
	?>
</body>
<br>
<br>
<br>
<br>
<footer>
	<b>Hecho por:</b>
	Jose A. Bolanos Bolanos.
</footer>
</html>