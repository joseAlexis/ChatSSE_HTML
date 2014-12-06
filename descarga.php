<?php
if (isset($_GET['archivo'])) {
	$esChat = false;

	$archivoDescargar = $_GET['archivo'];

	if($archivoDescargar == "chat.txt"){
		if(file_exists($archivoDescargar) && filesize($archivoDescargar)){		
			rename("chat.txt", "chat.html");
			$archivoDescargar = "chat.html";
			$esChat = true;
		}
	}

	if(file_exists($archivoDescargar) && filesize($archivoDescargar)){
		header("Content-disposition: attachment; filename=$archivoDescargar");
		header("Content-type: application/octet-stream");
		readfile($archivoDescargar);
	}

	if ($esChat) {
		rename("chat.html", "chat.txt");
	}
}
?>

