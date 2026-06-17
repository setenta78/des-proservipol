function ltrim(s) {  
	return s.replace(/^\s+/, "");
}

function rtrim(s) {  
	return s.replace(/\s+$/, "");
}

function trim(s) {  
	return rtrim(ltrim(s));
}

function eliminarBlancos(texto){
	texto = trim(texto);
	if (texto.length >0)
	{
			cont = 0;
			for (i=0; i<texto.length;i++)
			{
					if (texto.charAt(i) == " ") cont++;
			}
			if (cont == texto.length) texto = "";
	}
	
	return texto;
}


function cambiarClase(objeto, clase){
	objeto.className = clase;
}

function actualizarTamanoLista(idObjeto){
	
	//alert(document.getElementById(idObjeto).style.height);
	if (/MSIE 6.0/i.test(navigator.userAgent)) var valorRestar = 300;
	else var valorRestar = 260;
	
	var tamanoPantalla 	= window.document.body.parentNode.offsetHeight;
	var altura 			= tamanoPantalla - valorRestar;
				
	document.getElementById(idObjeto).style.height= altura+"px";
}   


function abrirVentana(titulo, ancho, alto, pagina, nroLinea, estado, posX, posY){
		
		var win = new Window({className	  : "mac_os_x", 
							  title		  : titulo, 
							  width		  : ancho, 
							  height	  : alto, 
							  top		  : posX,
							  left		  : posY,
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
    	win.show(estado); 
    	//win.setStatusBar('Cargando ... '); 
    	
    	//var oldClase = document.getElementById(nroLinea).className;
		//if (nroLinea != "") {
		//	document.getElementById(nroLinea).className  = "lineaDatos1Click";
		//	document.getElementById(nroLinea).onmouseout = "";
		//}
}
	
function closeAllModalWindows() {
    Windows.closeAllModalWindows();
    return true;
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

function ordenar(o) {
    var v=new Array();
    for (var i=0; i<o.options.length; i++) {
        v[v.length]=new Array(o[i].text,o[i].value);
    }
    v.sort(compara);
    for (var i=0; i<o.options.length; i++) {
        o[i]=new Option(v[i][0],v[i][1],false,false);
    }
}

function compara(a, b) {
    return (a[0]<b[0]?"-1":"1");
}


function limitarTextArea(objeto, tamanoMax){
	//alert(objeto.value.length);
	if (objeto.value.length>(tamanoMax+1)){
		alert("HA SUPERADO EL TAMAÑO MÁXIMO PERMITIDO ...          ");
		objeto.value = objeto.value.substr(0,tamanoMax);
	}
}

function php_serialize(obj)
{
    var string = '';

    if (typeof(obj) == 'object') {
        if (obj instanceof Array) {
            string = 'a:';
            tmpstring = '';
            var count = 0;
            //for (var key in obj) {
            //    tmpstring += php_serialize(key);
            //    tmpstring += php_serialize(obj[key]);
            //    count++;
            //}
            //count = obj.length; 
            //alert(count);
            for (var key=0; key<obj.length; key++) {
                tmpstring += php_serialize(key);
                tmpstring += php_serialize(obj[key]);
                count++;
            }
            
            string += count + ':{';
            string += tmpstring;
            string += '}';
        } else if (obj instanceof Object) {
            classname = obj.toString();

            if (classname == '[object Object]') {
                classname = 'StdClass';
            }

            string = 'O:' + classname.length + ':"' + classname + '":';
            tmpstring = '';
            count = 0;
            for (var key in obj) {
                tmpstring += php_serialize(key);
                if (obj[key]) {
                    tmpstring += php_serialize(obj[key]);
                } else {
                    tmpstring += php_serialize('');
                }
                count++;
            }
            string += count + ':{' + tmpstring + '}';
        }
    } else {
        switch (typeof(obj)) {
            case 'number':
                if (obj - Math.floor(obj) != 0) {
                    string += 'd:' + obj + ';';
                } else {
                    string += 'i:' + obj + ';';
                }
                break;
            case 'string':
                string += 's:' + obj.length + ':"' + obj + '";';
                break;
            case 'boolean':
                if (obj) {
                    string += 'b:1;';
                } else {
                    string += 'b:0;';
                }
                break;
        }
    }

    return string;
}


function IsNumeric(expression){
     return (String(expression).search(/^\d+$/) != -1);  
} 
