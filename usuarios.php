<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$nombreArchivo = "usuarios.txt";

if(file_exists($nombreArchivo) && filesize($nombreArchivo)){
	$archivo = fopen($nombreArchivo, "r") or die ("No es posible abrir el archivo!");
	$contenido = fread($archivo, filesize($nombreArchivo));
	fclose($archivo);
}
else {
	$contenido = "";	
}

echo "data: {$contenido}\n\n";
flush();
?>