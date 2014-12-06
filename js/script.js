// var uploadFile = false;
/*----------------Conexion al servidor----------------*/

if(typeof(EventSource)!=="undefined")
{
	
	var source = new EventSource("chat.php");
	var source2 = new EventSource("usuarios.php");

  	source.onmessage=function(event){
  		var contenido = event.data.split("<br>");
  		document.getElementById("txtChat").innerHTML = "";
  		
  		for (var i = 0; i <= contenido.length - 1; i++) {	

  			var user = document.getElementById("idUsuario").value;
  			if(user != null){
	  			var posFinal = contenido[i].indexOf(':');
	  			var nuevaCadena = contenido[i].substring(3, posFinal - 4);
	  			
	 			if(nuevaCadena.trim() == user.trim()){
	 				contenido[i] = "<div style='background-color:gray'>"+contenido[i]+"</div>";
	 			}
	 		}
			document.getElementById("txtChat").innerHTML += contenido[i] + "<br>";
		}	
		document.getElementById("txtChat").scrollTop = document.getElementById("txtChat").scrollHeight;	
    };

   source2.onmessage=function(event){
  		
  		var usuarios = document.getElementById("idUsuarios");
  		
  		usuarios.innerHTML = event.data;
		usuarios.scrollTop = usuarios.scrollHeight;		
   };
}
else{
	document.getElementById("txtChat").innerHTML="Lo sentimos, su navegador no soporta el SSE (Server Sent Events)";
}

/********************************************************************************************************************************************/

/*----------------Funcion que valida que no hallan palabras vulgares----------------*/
function validarPalabras() {	
	var sentencia = document.getElementById("txtTexto").value;
	var usuario = document.getElementById("idUsuario").value;

	if(usuario != ""){

		if(sentencia == "Me gusta el rojo"){
			var nuevoFondo = document.getElementById("idFondo");
			nuevoFondo.value = "rojo";
		}
		
		var resultado = new Array();	
		var emoticonos = new Array();
		resultado = sentencia.split(" ");
		
		var palabrasReservadas = new Array("picha", "hijueputa", "mierda", "malparido", "malparida","playo", "loca", "cagon", "gay", "puto", "puta", "putas");
		var nuevaSentencia = "";
		var sentenciaEnviar = "";
		
		for (var i = 0; i < resultado.length; i++) {
			
			for (var j = 0; j < palabrasReservadas.length; j++) {
					
					if(resultado[i] == palabrasReservadas[j]){
						resultado[i] = "*censurado*";
					}
					else{
						if (resultado[i] == "^.^") {
							resultado[i] = "<img src='imagenes/1.gif'>"
						}
						else if (resultado[i] == "zZz") {
							resultado[i] = "<img src='imagenes/2.gif'>"	
						}
						else if (resultado[i] == ":)") {
							resultado[i] = "<img src='imagenes/3.gif'>"
						}
						else if (resultado[i] == "o.O") {
							resultado[i] = "<img src='imagenes/4.gif'>"
						}
						else if (resultado[i] == "xD") {
							resultado[i] = "<img src='imagenes/5.gif'>"
						}
					}
			}
			nuevaSentencia += resultado[i] + " ";
		}
		var latitud = document.getElementById("idLatitud").value;
		var longitud = document.getElementById("idLongitud").value;

		document.getElementById('frmChat').action = "index.php?comentario=" + nuevaSentencia +"&ubicacion="+ latitud +";"+longitud;
	}
	else{
		alert("Debe escribir un nombre de usuario!...");
	}
}



function getLocation(){
	if (navigator.geolocation)
    {
    	navigator.geolocation.getCurrentPosition(showPosition);
    }
}

function showPosition(position){
	var x = document.getElementById("idLatitud");
	var y= document.getElementById("idLongitud");

  	x.value = position.coords.latitude;
  	y.value = position.coords.longitude;	
}

function obtenerFondo(){
	var fondo = document.getElementById("idCombo");
	var seleccion = fondo.options[fondo.selectedIndex].value;
	
	var nuevoFondo = document.getElementById("idFondo");

	nuevoFondo.value = seleccion;
}

function cambiaColor(){
	var color = document.getElementById("idColor").value;
	document.getElementById("txtTexto").style.color = color;
}

function agregarEmoticon1() {
	var sentencia = document.getElementById("txtTexto").value;

	var msj = sentencia + " ^.^ ";

	document.getElementById("txtTexto").value = msj;
}

function agregarEmoticon2() {
	var sentencia = document.getElementById("txtTexto").value;

	var msj = sentencia + " zZz ";

	document.getElementById("txtTexto").value = msj;
}

function agregarEmoticon3() {
	var sentencia = document.getElementById("txtTexto").value;

	var msj = sentencia + " :) ";

	document.getElementById("txtTexto").value = msj;
}

function agregarEmoticon4() {
	var sentencia = document.getElementById("txtTexto").value;

	var msj = sentencia + " o.O ";

	document.getElementById("txtTexto").value = msj;
}

function agregarEmoticon5() {
	var sentencia = document.getElementById("txtTexto").value;

	var msj = sentencia + " xD ";

	document.getElementById("txtTexto").value = msj;
}

function confirmarSalida(){
	var salir = confirm("Realmente desea salir?");
	var exit = document.getElementById("linkSalir");
	var user = document.getElementById("idUsuario").value;

	if (salir) {
		exit.href = "index.php?salir=s&usuarioAbandona=" + user;
		// document.getElementById('frmChat').action = "index.php?salir=s";
	}
	else{
		exit.href = "#index.php";
	}
}

function cerrar(){
	var win = window.open("","_self"); 
	win.close();
}

function mostrarEmoticonos(){
	var menu = document.getElementById("menuEmoticonos");

	if (menu.style.visibility == 'visible') {
		menu.style.visibility = 'hidden';
	}
	else{
		menu.style.visibility = 'visible';	
	}
}

