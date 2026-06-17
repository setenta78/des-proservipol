var tipoConsulta = "";

var codigo                = "";
var apellidoPaterno       = "";
var apellidoMaterno       = "";
var primerNombre          = "";
var segundoNombre         = "";

var descGrado             = "";

var codUnidadFuncionario  = "";
var tipoUnidadFuncionario = "";
var especialidadUnidadFuncionario = "";
var descUnidadFuncionario = "";

var codUnidadPadreFuncionario = "";

var unidadUsuario         = "";
var tipoUnidadUsuario     = "";
var descUnidadUsuario     = "";

// USUARIO1 => PROSERVIPOL
// USUARIO2 => RRCC

var usuarioFechaDesde1    = "";
var usuarioTipo1          = "";

var usuarioFechaDesde2    = "";
var usuarioTipo2          = "";


function ocultarFondo(){
  document.getElementById('fondo').style.visibility = "visible";
}


function mostrarFondo(){
  document.getElementById('fondo').style.visibility = "hidden";
}


function cambiarClase(objeto, clase){
	objeto.className = clase;
}


function cerrarVentana(){
top.cerrarVentana();
}




//FUNCIONES PROSERVIPOL FUNCIONARIOS


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

function buscaDatosFuncionarioListaUsuarios(codigoLista){

    if(codigoLista != "")
    {
      tipoConsulta = "lista";
      
      document.getElementById("btnBuscarFuncionario").value = "BUSCANDO ...";
      document.getElementById("btnBuscarFuncionario").disabled = "true";

      leedatosFuncionario(codigoLista);
    }
}


function buscaDatosFuncionario(){
	
	var codigoFuncionario	= eliminarBlancos(document.getElementById("textCodigoFuncionario").value.toUpperCase());
	
	limpiaFicha();
	
	if (codigoFuncionario == ""){
		alert("DEBE INDICAR EL CODIGO DE FUNCIONARIO ...... 	     ");
		document.getElementById("textCodigoFuncionario").value="";
		document.getElementById("textCodigoFuncionario").focus();
		return false;
	}
	
	var regExCodigoFun = /^[0-9]{6,6}[A-Z]{1,1}$/;
	var codigoValido = codigoFuncionario.match(regExCodigoFun);
	
	if (!codigoValido){
		alert("EL CODIGO DE FUNCIONARIO INGRESADO NO TIENE UNA ESTRUCTURA VALIDA...... 	     ");
		document.getElementById("textCodigoFuncionario").focus();
		return false;
	}
	
	document.getElementById("btnBuscarFuncionario").value = "BUSCANDO ...";
	document.getElementById("btnBuscarFuncionario").disabled = "true";

	leedatosFuncionario(codigoFuncionario);
}




function leedatosFuncionario(codigoFuncionario){

	limpiaFicha();
	// MENSAJE CARGANDO
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlDatosFuncionario.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoFuncionario="+codigoFuncionario)); 
	
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4)
		{       
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				
				//alert(objHttpXMLFuncionarios.responseText);		

				var xml                   = objHttpXMLFuncionarios.responseXML.documentElement;
				//var xml                   = objHttpXMLFuncionarios.responseText;
        //alert(xml);

								
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){

					codigo	 		  		    = xml.getElementsByTagName('codigo')[i].text;

					descGrado		 	  		  = xml.getElementsByTagName('descGrado')[i].text;
					
					apellidoPaterno	  		= xml.getElementsByTagName('apellidoPaterno')[i].text;
					apellifoMaterno   		= xml.getElementsByTagName('apellidoMaterno')[i].text;
					primerNombre 	  		  = xml.getElementsByTagName('nombre')[i].text;
					segundoNombre 	  		= xml.getElementsByTagName('nombre2')[i].text;

					codUnidadFuncionario 	= xml.getElementsByTagName('codUnidadFuncionario')[i].text;
          tipoUnidadFuncionario = xml.getElementsByTagName('tipoUnidadFuncionario')[i].text;
          especialidadUnidadFuncionario = xml.getElementsByTagName('especialidadUnidadFuncionario')[i].text;
					descUnidadFuncionario = xml.getElementsByTagName('descUnidadFuncionario')[i].text;

          codUnidadPadreFuncionario = xml.getElementsByTagName('codUnidadPadreFuncionario')[i].text;

					codUnidadUsuario 			= xml.getElementsByTagName('codUnidadUsuario')[i].text;
          tipoUnidadUsuario     = xml.getElementsByTagName('tipoUnidadUsuario')[i].text;
          descUnidadUsuario     = xml.getElementsByTagName('descUnidadUsuario')[i].text;

					usuarioFechaDesde1 		= xml.getElementsByTagName('usuarioFechaDesde1')[i].text;
					usuarioTipo1          = xml.getElementsByTagName('usuarioTipo1')[i].text;

					usuarioFechaDesde2 		= xml.getElementsByTagName('usuarioFechaDesde2')[i].text;
					usuarioTipo2          = xml.getElementsByTagName('usuarioTipo2')[i].text;


					document.getElementById("textCodigoFuncionario").value	    = codigo;

					document.getElementById("labelGrado").innerHTML             = descGrado;

					document.getElementById("labelApellidoPaterno").innerHTML   = apellidoPaterno;
					document.getElementById("labelApellidoMaterno").innerHTML   = apellifoMaterno;
					document.getElementById("labelNombres").innerHTML		        = primerNombre+" "+segundoNombre;

					document.getElementById("labelUnidad").innerHTML            = descUnidadFuncionario;




    document.getElementById("labelcheckPROSERVIPOL").disabled = false;
    document.getElementById("checkPROSERVIPOL").disabled = false;


//if(codUnidadFuncionario == "")
//{
//    document.getElementById("selTipoUsuarioPROSERVIPOL").options[0] = new Option('','0',"","");
//    document.getElementById("selTipoUsuarioPROSERVIPOL").options[1] = new Option('NACIONAL','60',"","");
//    document.getElementById("selTipoUsuarioPROSERVIPOL").options[2] = new Option('ZONA','50',"","");
//    document.getElementById("selTipoUsuarioPROSERVIPOL").options[3] = new Option('PREFECTURA','40',"","");
//}

if(codUnidadFuncionario == "")
{
    document.getElementById("selTipoUsuarioPROSERVIPOL").options[0] = new Option('','0',"","");
    document.getElementById("selTipoUsuarioPROSERVIPOL").options[1] = new Option('PREFECTURA - TITULAR','45',"","");
    //document.getElementById("selTipoUsuarioPROSERVIPOL").options[2] = new Option('PREFECTURA - SUPLENTE','110',"","");
    document.getElementById("selTipoUsuarioPROSERVIPOL").options[2] = new Option('VALIDADOR - PREFECTURA','80',"","");
   
}


else
{
  if(especialidadUnidadFuncionario == "")
  {
      document.getElementById("labelcheckRRCC").disabled = false;
      document.getElementById("checkRRCC").disabled = false;
  }

  //if(tipoUnidadFuncionario == "50")
  //{
  //    document.getElementById("selTipoUsuarioPROSERVIPOL").options[0] = new Option('','0',"","");
  //    document.getElementById("selTipoUsuarioPROSERVIPOL").options[1] = new Option('TITULAR','10',"","");
  //    document.getElementById("selTipoUsuarioPROSERVIPOL").options[2] = new Option('SUPLENTE','20',"","");
  //    document.getElementById("selTipoUsuarioPROSERVIPOL").options[3] = new Option('FISCALIZADOR','30',"","");
  //    document.getElementById("selTipoUsuarioPROSERVIPOL").options[4] = new Option('VALIDADOR (UNIDAD BASE)','70',"","");
  //}
  
    if(tipoUnidadFuncionario == "30")
  {
      document.getElementById("selTipoUsuarioPROSERVIPOL").options[0] = new Option('','0',"","");
      document.getElementById("selTipoUsuarioPROSERVIPOL").options[1] = new Option('PREFECTURA - TITULAR','45',"","");
      //document.getElementById("selTipoUsuarioPROSERVIPOL").options[2] = new Option('PREFECTURA - SUPLENTE','110',"","");
       document.getElementById("selTipoUsuarioPROSERVIPOL").options[2] = new Option('VALIDADOR - PREFECTURA','80',"","");
      //document.getElementById("selTipoUsuarioPROSERVIPOL").options[3] = new Option('VALIDADOR - PREFECTURA','80',"","");
    
  }else
  {
      //document.getElementById("selTipoUsuarioPROSERVIPOL").options[0] = new Option('','0',"","");
      //document.getElementById("selTipoUsuarioPROSERVIPOL").options[1] = new Option('TITULAR','10',"","");
      //document.getElementById("selTipoUsuarioPROSERVIPOL").options[2] = new Option('SUPLENTE','20',"","");
      //document.getElementById("selTipoUsuarioPROSERVIPOL").options[3] = new Option('VALIDADOR','80',"","");
      
      document.getElementById("selTipoUsuarioPROSERVIPOL").options[0] = new Option('','0',"","");
      document.getElementById("selTipoUsuarioPROSERVIPOL").options[1] = new Option('PREFECTURA - TITULAR','45',"","");
        document.getElementById("selTipoUsuarioPROSERVIPOL").options[2] = new Option('PREFECTURA - VALIDADOR','80',"","");
  }
}


if(usuarioTipo1 != "")
{
    document.getElementById("checkPROSERVIPOL").checked = true;
    document.getElementById("selTipoUsuarioPROSERVIPOL").value = usuarioTipo1;

    habilitaVentana("PROSERVIPOL");

    if(codUnidadFuncionario == "")
    {
      cargaUnidadUsuario(usuarioTipo1);
      document.getElementById("selUnidadUsuario").value = codUnidadUsuario;
    }
    
    document.getElementById("textFechaUsuarioPROSERVIPOL").innerHTML = usuarioFechaDesde1;
}


if(usuarioTipo2 != "")
{
    document.getElementById("checkRRCC").checked = true;
    habilitaVentana("RRCC");
    
    document.getElementById("textFechaUsuarioRRCC").innerHTML = usuarioFechaDesde2;
}
					
          document.getElementById("btnBuscarFuncionario").value     = "BUSCAR";
					document.getElementById("btnBuscarFuncionario").disabled  = false;
						
						
					}
									
				}
			
			
			else {

          alert ("NO EXISTE ...");

					document.getElementById("textCodigoFuncionario").focus();
					document.getElementById("btnBuscarFuncionario").value = "BUSCAR";
					document.getElementById("btnBuscarFuncionario").disabled = "";
			}
			}
		}
}




function habilitaVentana(tipoVentana)
{

    if(tipoVentana == "PROSERVIPOL")
    {
      document.getElementById("labelTipoUsuario"+tipoVentana).disabled = false;
      document.getElementById("selTipoUsuario"+tipoVentana).disabled = false;
      
      if(document.getElementById("selTipoUsuario"+tipoVentana).value == 40 || document.getElementById("selTipoUsuario"+tipoVentana).value == 50)
      {
        document.getElementById("labelUnidadUsuario").disabled  = false;
        document.getElementById("selUnidadUsuario").disabled  = false;
      }
    }

    if(tipoVentana == "PROSERVIPOL" && usuarioTipo1 != "")
    {
        document.getElementById("btnRestablecer"+tipoVentana).disabled = false;
        document.getElementById("labelFechaUsuario"+tipoVentana).disabled = false;
        document.getElementById("textFechaUsuario"+tipoVentana).disabled = false;
    }

    else if(tipoVentana == "RRCC" && usuarioTipo2 != "")
    {
        document.getElementById("btnRestablecer"+tipoVentana).disabled = false;
        document.getElementById("labelFechaUsuario"+tipoVentana).disabled = false;
        document.getElementById("textFechaUsuario"+tipoVentana).disabled = false;
    }
}




function deshabilitaVentana(tipoVentana)
{

    if(tipoVentana == "PROSERVIPOL")
    {
      document.getElementById("labelTipoUsuario"+tipoVentana).disabled = true;
      document.getElementById("selTipoUsuario"+tipoVentana).disabled = true;

      document.getElementById("selUnidadUsuario").disabled = true;
      document.getElementById("labelUnidadUsuario").disabled = true;
    }


    document.getElementById("btnRestablecer"+tipoVentana).disabled = true;
    document.getElementById("labelFechaUsuario"+tipoVentana).disabled = true;
    document.getElementById("textFechaUsuario"+tipoVentana).disabled = true;
}


// FIN FUNCIONES PROSERVIPOL FUNCIONARIOS


function limpiaFicha()
{

  document.getElementById("selTipoUsuarioPROSERVIPOL").innerHTML = "";
  document.getElementById("selUnidadUsuario").innerHTML = "";
  document.getElementById("labelUnidadUsuario").innerHTML = "ZONA&nbsp;/&nbsp;PREFECTURA&nbsp;:&nbsp;";

  codigo                = "";
  apellidoPaterno       = "";
  apellidoMaterno       = "";
  primerNombre          = "";
  segundoNombre         = "";
  descGrado             = "";
  codUnidadFuncionario     = "";
  tipoUnidadFuncionario = "";
  especialidadUnidadFuncionario = "";
  descUnidadFuncionario = "";
  codUnidadPadreFuncionario = "";
  unidadUsuario         = "";
  tipoUnidadUsuario     = "";
  descUnidadUsuario     = "";
  usuarioFechaDesde1    = "";
  usuarioTipo1          = "";
  usuarioFechaDesde2    = "";
  usuarioTipo2          = "";

  document.getElementById("checkPROSERVIPOL").checked = false;
  document.getElementById("checkRRCC").checked = false;


  document.getElementById("labelcheckRRCC").disabled = true;
  document.getElementById("checkRRCC").disabled = true;

  document.getElementById("labelcheckPROSERVIPOL").disabled = true;
  document.getElementById("checkPROSERVIPOL").disabled = true;

  document.getElementById("labelUnidadUsuario").disabled  = true;
  document.getElementById("selUnidadUsuario").disabled  = true;

  deshabilitaVentana("PROSERVIPOL");
  deshabilitaVentana("RRCC");
  
  document.getElementById("textFechaUsuarioRRCC").innerHTML = "";
  document.getElementById("textFechaUsuarioPROSERVIPOL").innerHTML = "";



  document.getElementById("textCodigoFuncionario").value	    = "";
  document.getElementById("labelGrado").innerHTML             = "";
  document.getElementById("labelApellidoPaterno").innerHTML   = "";
  document.getElementById("labelApellidoMaterno").innerHTML   = "";
  document.getElementById("labelNombres").innerHTML		        = "";
  document.getElementById("labelUnidad").innerHTML            = "";



}




function habilitaCheck(tipoVentana)
{
    if(document.getElementById("check"+tipoVentana).checked)
    {
      habilitaVentana(tipoVentana);
    }

    else
    {
      deshabilitaVentana(tipoVentana);
    }
}



function cargaUnidadUsuario(cargaTipo)
{

    if(cargaTipo == 60 || cargaTipo == 0)
    {
      document.getElementById("labelUnidadUsuario").innerHTML = "ZONA&nbsp;/&nbsp;PREFECTURA&nbsp;:&nbsp;";
      document.getElementById("selUnidadUsuario").innerHTML = "";
      document.getElementById("labelUnidadUsuario").disabled  = true;
      document.getElementById("selUnidadUsuario").disabled  = true;
    }



    else if(cargaTipo == 50)
    {
      document.getElementById("labelUnidadUsuario").innerHTML = "ZONA&nbsp;:&nbsp;";
      document.getElementById("selUnidadUsuario").innerHTML = "";
      document.getElementById("selUnidadUsuario").options[0] = new Option('','0',"","");

      document.getElementById("selUnidadUsuario").options[1] = new Option('ZONA CARABINEROS ANTOFAGASTA','130',"","");
      document.getElementById("selUnidadUsuario").options[2] = new Option('ZONA CARABINEROS ATACAMA','220',"","");
      document.getElementById("selUnidadUsuario").options[3] = new Option('ZONA CARABINEROS COQUIMBO','310',"","");
      document.getElementById("selUnidadUsuario").options[4] = new Option('ZONA CARABINEROS VALPARAISO','410',"","");
      document.getElementById("selUnidadUsuario").options[5] = new Option('ZONA CARABINEROS MAULE','830',"","");
      document.getElementById("selUnidadUsuario").options[6] = new Option('ZONA CARABINEROS BIO-BIO','1030',"","");
      document.getElementById("selUnidadUsuario").options[7] = new Option('ZONA CARABINEROS LOS RIOS','1550',"","");
      document.getElementById("selUnidadUsuario").options[8] = new Option('ZONA CARABINEROS LOS LAGOS','7510',"","");
      document.getElementById("selUnidadUsuario").options[9] = new Option('ZONA CARABINEROS AYSEN','1840',"","");
      document.getElementById("selUnidadUsuario").options[10] = new Option('ZONA CARABINEROS MAGALLANES','1900',"","");
      document.getElementById("selUnidadUsuario").options[11] = new Option('ZONA CARABINEROS ARICA Y PARINACOTA','120',"","");
      document.getElementById("selUnidadUsuario").options[12] = new Option('ZONA CARABINEROS TARAPACA','8730',"","");
      document.getElementById("selUnidadUsuario").options[13] = new Option('ZONA CARABINEROS ARAUCANIA','1350',"","");
      document.getElementById("selUnidadUsuario").options[14] = new Option('ZONA CARABS. LIB. B. OHIGGINS','700',"","");


      document.getElementById("selUnidadUsuario").options[15] = new Option('JEFATURA ZONA ESTE','9620',"","");
      document.getElementById("selUnidadUsuario").options[16] = new Option('JEFATURA ZONA OESTE','9630',"","");
//      document.getElementById("selUnidadUsuario").options[17] = new Option('JEFATURA DE ZONA METROPOLITANA','1950',"","");

      document.getElementById("labelUnidadUsuario").disabled  = false;
      document.getElementById("selUnidadUsuario").disabled  = false;
    }
    
    else if(cargaTipo == 40 || cargaTipo == 45 || cargaTipo == 80)
    {
        document.getElementById("labelUnidadUsuario").innerHTML = "PREFECTURA&nbsp;:&nbsp;";
        document.getElementById("selUnidadUsuario").innerHTML = "";
        document.getElementById("selUnidadUsuario").options[0] = new Option('','0',"","");

        document.getElementById("selUnidadUsuario").options[1] = new Option('PREF. ANTOFAGASTA','140',"","");
        document.getElementById("selUnidadUsuario").options[2] = new Option('PREF. EL LOA','200',"","");
        document.getElementById("selUnidadUsuario").options[3] = new Option('PREF. ATACAMA','230',"","");
        document.getElementById("selUnidadUsuario").options[4] = new Option('PREF. COQUIMBO','320',"","");
        document.getElementById("selUnidadUsuario").options[5] = new Option('PREF. ACONCAGUA','420',"","");
        document.getElementById("selUnidadUsuario").options[6] = new Option('PREF. VINA DEL MAR','480',"","");
        document.getElementById("selUnidadUsuario").options[7] = new Option('PREF. VALPARAISO','570',"","");
        document.getElementById("selUnidadUsuario").options[8] = new Option('PREF. SAN ANTONIO','660',"","");
        document.getElementById("selUnidadUsuario").options[9] = new Option('PREF. CURICO','840',"","");
        document.getElementById("selUnidadUsuario").options[10] = new Option('PREF. TALCA','900',"","");
        document.getElementById("selUnidadUsuario").options[11] = new Option('PREF. LINARES','960',"","");
        document.getElementById("selUnidadUsuario").options[12] = new Option('PREF. NUBLE','1040',"","");
        document.getElementById("selUnidadUsuario").options[13] = new Option('PREF. CONCEPCION','1110',"","");
        document.getElementById("selUnidadUsuario").options[14] = new Option('PREF. TALCAHUANO','1180',"","");
        document.getElementById("selUnidadUsuario").options[15] = new Option('PREF. ARAUCO','1230',"","");
        document.getElementById("selUnidadUsuario").options[16] = new Option('PREF. BIO BIO','1280',"","");
        document.getElementById("selUnidadUsuario").options[17] = new Option('PREF. VALDIVIA','1560',"","");
        document.getElementById("selUnidadUsuario").options[18] = new Option('PREF. OSORNO','1630',"","");
        document.getElementById("selUnidadUsuario").options[19] = new Option('PREF. LLANQUIHUE','1690',"","");
        document.getElementById("selUnidadUsuario").options[20] = new Option('PREF. CHILOE','1770',"","");


        document.getElementById("selUnidadUsuario").options[21] = new Option('PREF. FF. EE.','2100',"","");
        document.getElementById("selUnidadUsuario").options[22] = new Option('PREF. STGO. CENTRAL','2150',"","");
        document.getElementById("selUnidadUsuario").options[23] = new Option('PREF. SANTIAGO NORTE','2200',"","");
        document.getElementById("selUnidadUsuario").options[24] = new Option('PREF. STGO. OCCIDENTE','2270',"","");
        document.getElementById("selUnidadUsuario").options[25] = new Option('PREF. R.P. E INTERVENCION POLICIAL','2420',"","");
        
        document.getElementById("selUnidadUsuario").options[26] = new Option('PREF. DEL TRANSITO Y CARRETERAS','9650',"","");
        
        document.getElementById("selUnidadUsuario").options[27] = new Option('PREF. SANTIAGO ORIENTE','2430',"","");
        document.getElementById("selUnidadUsuario").options[28] = new Option('PREF. CORDILLERA','2520',"","");
        document.getElementById("selUnidadUsuario").options[29] = new Option('PREF. SANTIAGO SUR','2600',"","");
        document.getElementById("selUnidadUsuario").options[30] = new Option('PREF. AYSEN','1850',"","");
        document.getElementById("selUnidadUsuario").options[31] = new Option('PREF. MAGALLANES','1910',"","");
        document.getElementById("selUnidadUsuario").options[32] = new Option('PREF. ARICA','8740',"","");
        document.getElementById("selUnidadUsuario").options[33] = new Option('PREF. IQUIQUE','70',"","");
        document.getElementById("selUnidadUsuario").options[34] = new Option('PREF. MALLECO','1360',"","");
        document.getElementById("selUnidadUsuario").options[35] = new Option('PREF. CAUTIN','1430',"","");

        document.getElementById("selUnidadUsuario").options[36] = new Option('PREF. COSTA','9640',"","");
        document.getElementById("selUnidadUsuario").options[37] = new Option('PREF. CACHAPOAL','710',"","");
        document.getElementById("selUnidadUsuario").options[38] = new Option('PREF. COLCHAGUA','790',"","");
        document.getElementById("selUnidadUsuario").options[39] = new Option('PREF. VILLARRICA','9790',"","");
        
        document.getElementById("selUnidadUsuario").options[40] = new Option('PREF. DE LIMARI','9850',"","");
        document.getElementById("selUnidadUsuario").options[41] = new Option('PREF. MARGA MARGA','9860',"","");
        document.getElementById("selUnidadUsuario").options[42] = new Option('PREF. STGO. CENTRAL SUR','9870',"","");
        document.getElementById("selUnidadUsuario").options[43] = new Option('PREF. STGO. RINCONADA','9890',"","");
        document.getElementById("selUnidadUsuario").options[44] = new Option('PREF. SANTIAGO ANDES','10070',"","");
        
        document.getElementById("selUnidadUsuario").options[45] = new Option('PREF. DEL MAIPO','10230',"","");
        document.getElementById("selUnidadUsuario").options[46] = new Option('PREF. DE FAMILIA E INFANCIA','10360',"","");
        document.getElementById("selUnidadUsuario").options[47] = new Option('PREF. PREV. Y MEDIDAS DE PROTECCION','10260',"","");
        document.getElementById("selUnidadUsuario").options[48] = new Option('SUBPREF. PREV. Y MEDIDAS DE PROTECCION','10270',"","");
        
            



        document.getElementById("labelUnidadUsuario").disabled  = false;
        document.getElementById("selUnidadUsuario").disabled  = false;
    }
    
}




function restablecerContrasena(tipoVentana)
{
	document.getElementById("btnRestablecer"+tipoVentana).disabled = true;
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./baseDatos/dbRestablece"+tipoVentana+".php",false);
	
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

	objHttpXMLFuncionarios.send(encodeURI("codigoFuncionario="+codigo));


	
  if (objHttpXMLFuncionarios.responseText == "OK")
  {
    alert("CONTRASEÑA RESTABLECIDA PARA MODULO "+tipoVentana);
    document.getElementById("btnRestablecer"+tipoVentana).disabled = false;
  }
  
  else
  {
    alert("PROBLEMAS CON LA BASE DE DATOS");
    cerrarVentana();
  }


}




function borrarContrasena(tipoVentana)
{

	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./baseDatos/dbBorra"+tipoVentana+".php",false);
	
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

	objHttpXMLFuncionarios.send(encodeURI("codigoFuncionario="+codigo));
	
			if (objHttpXMLFuncionarios.responseText != "OK")
			{
      alert("PROBLEMAS CON LA BASE DE DATOS");
      cerrarVentana();
      //alert(objHttpXMLFuncionarios.responseText);
    }
      else
      {
          alert("DATOS ACTUALIZADOS CORRECTAMENTE");
      }
    
}





function creaContrasena(tipoVentana)
{
		
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();

	objHttpXMLFuncionarios.open("POST","./baseDatos/dbCrea"+tipoVentana+".php",false);
	
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");


  if(tipoVentana == "RRCC")
  {
      objHttpXMLFuncionarios.send("codigoFuncionario="+codigo+"&unidadFuncionario="+codUnidadFuncionario);
  }

  else
  {
      if(document.getElementById("selTipoUsuarioPROSERVIPOL").value == 30 || document.getElementById("selTipoUsuarioPROSERVIPOL").value == 70)
      {
          objHttpXMLFuncionarios.send("codigoFuncionario="+codigo+"&unidadUsuario="+codUnidadPadreFuncionario+"&tipoUsuario="+document.getElementById("selTipoUsuarioPROSERVIPOL").value);
      }
      
      else if(document.getElementById("selTipoUsuarioPROSERVIPOL").value == 60)
      {
          objHttpXMLFuncionarios.send("codigoFuncionario="+codigo+"&unidadUsuario=20&tipoUsuario="+document.getElementById("selTipoUsuarioPROSERVIPOL").value);
        
      }
      
      else if(document.getElementById("selTipoUsuarioPROSERVIPOL").value == 45 || document.getElementById("selTipoUsuarioPROSERVIPOL").value == 80)
      {
          objHttpXMLFuncionarios.send("codigoFuncionario="+codigo+"&unidadUsuario="+document.getElementById("selUnidadUsuario").value+"&tipoUsuario="+document.getElementById("selTipoUsuarioPROSERVIPOL").value);
          //objHttpXMLFuncionarios.send("codigoFuncionario="+codigo+"&unidadUsuario="+document.getElementById("selUnidadUsuario").value+"&tipoUsuario="+document.getElementById("selTipoUsuarioPROSERVIPOL").value);
      }

      else if(document.getElementById("selTipoUsuarioPROSERVIPOL").value == 40 || document.getElementById("selTipoUsuarioPROSERVIPOL").value == 50)
      {
          objHttpXMLFuncionarios.send("codigoFuncionario="+codigo+"&unidadUsuario="+document.getElementById("selUnidadUsuario").value+"&tipoUsuario="+document.getElementById("selTipoUsuarioPROSERVIPOL").value);
      }

      else
      {
          objHttpXMLFuncionarios.send("codigoFuncionario="+codigo+"&unidadUsuario="+codUnidadFuncionario+"&tipoUsuario="+document.getElementById("selTipoUsuarioPROSERVIPOL").value);
      }
  }

			if (objHttpXMLFuncionarios.responseText != "OK"){
      alert("PROBLEMAS CON LA BASE DE DATOS");
      cerrarVentana();
      //alert(objHttpXMLFuncionarios.responseText);
    }
    
      else
      {
          alert("DATOS ACTUALIZADOS CORRECTAMENTE");
      }
}



function actualizaContrasena(tipoVentana)
{

	var objHttpXMLFuncionarios = new AJAXCrearObjeto();

	objHttpXMLFuncionarios.open("POST","./baseDatos/dbActualiza"+tipoVentana+".php",false);
	
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");


  if(document.getElementById("selTipoUsuarioPROSERVIPOL").value == 30 || document.getElementById("selTipoUsuarioPROSERVIPOL").value == 70)
  {
      objHttpXMLFuncionarios.send(encodeURI("codigoFuncionario="+codigo+"&unidadUsuario="+codUnidadPadreFuncionario+"&tipoUsuario="+document.getElementById("selTipoUsuarioPROSERVIPOL").value));
  }
      
  else if(document.getElementById("selTipoUsuarioPROSERVIPOL").value == 60)
  {
      objHttpXMLFuncionarios.send("codigoFuncionario="+codigo+"&unidadUsuario=20&tipoUsuario="+document.getElementById("selTipoUsuarioPROSERVIPOL").value); 
  }
  
     else if(document.getElementById("selTipoUsuarioPROSERVIPOL").value == 45 || document.getElementById("selTipoUsuarioPROSERVIPOL").value == 80)
      {
          objHttpXMLFuncionarios.send("codigoFuncionario="+codigo+"&unidadUsuario="+document.getElementById("selUnidadUsuario").value+"&tipoUsuario="+document.getElementById("selTipoUsuarioPROSERVIPOL").value);
          //objHttpXMLFuncionarios.send("codigoFuncionario="+codigo+"&unidadUsuario="+document.getElementById("selUnidadUsuario").value+"&tipoUsuario="+document.getElementById("selTipoUsuarioPROSERVIPOL").value);
      }

  else if(document.getElementById("selTipoUsuarioPROSERVIPOL").value == 40 || document.getElementById("selTipoUsuarioPROSERVIPOL").value == 50)
  {
      objHttpXMLFuncionarios.send("codigoFuncionario="+codigo+"&unidadUsuario="+document.getElementById("selUnidadUsuario").value+"&tipoUsuario="+document.getElementById("selTipoUsuarioPROSERVIPOL").value);
  }

  else
  {
      objHttpXMLFuncionarios.send("codigoFuncionario="+codigo+"&unidadUsuario="+codUnidadFuncionario+"&tipoUsuario="+document.getElementById("selTipoUsuarioPROSERVIPOL").value);
      //objHttpXMLFuncionarios.send("codigoFuncionario="+codigo+"&unidadUsuario="+document.getElementById("selUnidadUsuario").value+"&tipoUsuario="+document.getElementById("selTipoUsuarioPROSERVIPOL").value);
  }



	
			if (objHttpXMLFuncionarios.responseText != "OK"){
      alert("PROBLEMAS CON LA BASE DE DATOS");
      cerrarVentana();
      //alert(objHttpXMLFuncionarios.responseText);
    }
      else
      {
          alert("DATOS ACTUALIZADOS CORRECTAMENTE");
      }
}







function guardaContrasena(){

	document.getElementById("btnGuardarFicha").disabled = true;
	document.getElementById("btnCerrarFicha").disabled = true;
	document.getElementById("btnLimpiarFicha").disabled = false;

if(validaDatos())
{
  if(usuarioTipo1 != "")
  {
      if(!document.getElementById("checkPROSERVIPOL").checked)
      {
        borrarContrasena('PROSERVIPOL');
      }

      else
      {
        if(document.getElementById("selTipoUsuarioPROSERVIPOL").value == 40 || document.getElementById("selTipoUsuarioPROSERVIPOL").value == 50 || document.getElementById("selTipoUsuarioPROSERVIPOL").value == 60)
        {
          if(usuarioTipo1 != document.getElementById("selTipoUsuarioPROSERVIPOL").value || unidadUsuario != document.getElementById("selUnidadUsuario").value)
          {
              actualizaContrasena('PROSERVIPOL');
          }

        }

        else
        {
          if(usuarioTipo1 != document.getElementById("selTipoUsuarioPROSERVIPOL").value)
          {
              actualizaContrasena('PROSERVIPOL');
          }
        }

      }
  }

  else
  {
      if(document.getElementById("checkPROSERVIPOL").checked)
      {
        creaContrasena('PROSERVIPOL');
      }
  }

  if(codUnidadFuncionario != "")
  {
      if(usuarioTipo2 != "")
      {
          if(!document.getElementById("checkRRCC").checked)
          {
              borrarContrasena('RRCC');
          }
      }

      else
      {
          if(document.getElementById("checkRRCC").checked)
          {
              creaContrasena('RRCC');
          }
      }
  }

  //cerrarVentana();
  limpiaFicha();

  top.limpiarLista();

  //limpiaFicha();

  document.getElementById("textCodigoFuncionario").focus();

  if(tipoConsulta == "lista")
  {
      top.actualizarListarUsuarios();
      cerrarVentana();
  
  }
  else
  {
    top.limpiarLista();
    tipoConsulta = "";
  }

}

	document.getElementById("btnGuardarFicha").disabled = false;
	document.getElementById("btnCerrarFicha").disabled = false;
  document.getElementById("btnLimpiarFicha").disabled = false;

}




function validaDatos(){

    if(document.getElementById("checkPROSERVIPOL").checked)
    {

        if(document.getElementById("selTipoUsuarioPROSERVIPOL").value == 0)
        {
          alert("DEBE SELECCIONAR TIPO USUARIO");
          document.getElementById("selTipoUsuarioPROSERVIPOL").focus();
        }
        
        else if((document.getElementById("selTipoUsuarioPROSERVIPOL").value == 40 || document.getElementById("selTipoUsuarioPROSERVIPOL").value == 50) && document.getElementById("selUnidadUsuario").value == 0)
        {
          alert("DEBE SELECCIONAR UNIDAD");
          document.getElementById("selUnidadUsuario").focus();
        }
        
        else
        {
            return true;
        }
        
        return false;
    }
    
    return true;

/*
    if(document.getElementById("checkRRCC").checked)
    {

        if(document.getElementById("selTipoUsuarioRRCC").value == 0)
        {
          alert("DEBE SELECCIONAR TIPO USUARIO");
          document.getElementById("selTipoUsuarioRRCC").focus();
        }
        
        else
        {
            return true;
        }
        
        return false;
    }
*/
}

function limpiaFichaTotal()
{
  limpiaFicha();

  document.getElementById("textCodigoFuncionario").focus();
}







