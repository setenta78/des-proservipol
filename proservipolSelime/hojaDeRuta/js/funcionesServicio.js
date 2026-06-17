function abrirVentana(pagina){

		var win = new Window({
                className	  : "mac_os_x", 
							  title		    : 'HOJA DE RUTA ...', 
							  width		    : '970',
							  height	    : '460', 
							  top		      : '5',
							  left		    : '5',
							  minimizable : false, 
							  maximizable : false,
							  closable	  : false,
							  draggable	  : true,
							  resizable	  : false,
							  url		  : pagina}); 

		//showEffect  : Effect.Appear, 							  
		//hideEffect  : Effect.Fade,							  
							  
    	//win.getContent().update("<h1>Listado con Todos los Indicadores </h1>");
    	//win.getContent().innerHTML = "../descripcionIndicadores.php"}); 
    	//win.showCenter(estado);    
    	//win.showCenter(true);    
    	//win.showModal();
    	win.show(); 
    	//win.setStatusBar('Cargando ... '); 
    	
    	//var oldClase = document.getElementById(nroLinea).className;
		//if (nroLinea != "") {
		//	document.getElementById(nroLinea).className  = "lineaDatos1Click";
		//	document.getElementById(nroLinea).onmouseout = "";
		//}
}


function cerrarVentana(){
	Windows.closeAll();
	return true;
}



 function cerrarAplicacion(){
		var caduca=new Date(); 

		
		//setCookie('USUARIO_NOMBRE','',caduca);          
		//alert();
		//setCookie('USUARIO_CODIGOFUNCIONARIO','',caduca);
		//setCookie('USUARIO_DESCRIPCIONUNIDAD','',caduca);
		//
		////window.document.write = "unset($_COOKIE['USUARIO_UNIDAD'])";
		//alert();
		window.location.replace("logout.php");
		
}