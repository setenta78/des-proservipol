
function cargarVideo(video, nombre){
	
	var div	= document.getElementById("popup-contenedor");
  var contenido	= "";
  contenido += "<h2><b>"+nombre+"<b></h2>";
  contenido += "<a class='popup-cerrar' onclick='cerrarVideos();'>X</a><br>";
  /*
	contenido += "<object type='video/x-ms-wmv' data='http://www.domain.com/path/to/winmovie.wmv' width='100%' height='70%'>";
	contenido += "<param name='src' value='videos/"+video+".mp4' />";
	contenido += "<param name='controller' value='true' />";
	contenido += "<param name='autostart' value='true' />";
	contenido += "</object>";
	*/
	contenido += "<embed type='audio/x-pn-realaudio-plugin' src='videos/"+video+".mp4' width='100%' height='70%' allowfullscreen='true' autostart='false' controls='all' console='video'>";
	//contenido += "<embed type='application/x-mplayer2' src='videos/"+video+".mp4' name='MediaPlayer'";
	//contenido += " width='450' height='300' ShowControls='all' autostart='0'> </embed>";
	//contenido += "<video width='100%' height='70%' controls> <source src='videos/"+video+".mp4' type='video/mp4'> </video>";
	div.innerHTML = contenido;
	
}

function mostrarVideos(video, nombre){
	
	cargarVideo(video, nombre);
	document.getElementById('popup').className='modal-wrapperTarget';
	
}

function cerrarVideos(){
	
	var div	= document.getElementById("popup-contenedor");
	div.innerHTML = "";
	document.getElementById('popup').className='modal-wrapper';
	
}
