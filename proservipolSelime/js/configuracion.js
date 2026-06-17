function mostrarCuadrantes(){
	if (document.getElementById('btnMostrarCuadrantes').value == "MOSTRAR >>>"){
		document.getElementById('muestraCuadrantes').style.visibility = "visible";
		document.getElementById('btnMostrarCuadrantes').value = "<<< OCULTAR";
	} else {
		document.getElementById('muestraCuadrantes').style.visibility = "hidden";
		document.getElementById('btnMostrarCuadrantes').value = "MOSTRAR >>>";
	}
}
