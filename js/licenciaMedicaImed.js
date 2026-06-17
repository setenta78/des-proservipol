ListaTipo.addEventListener('change', () => {
    switch(ListaTipo.value){
        case '0':
            BuscarLicenciaFolio.style.display = '';
            checkImed.disabled = false;
        break;
        case 'PP':
            BuscarLicenciaFolio.style.display = '';
            checkImed.checked = false;
            checkImed.disabled = true;
        break;
        case 'PV':
            BuscarLicenciaFolio.style.display = 'none';
            txtFolioI.value = '';
            checkImed.checked = false;
            checkImed.disabled = true;
        break;
        case 'MP':
            BuscarLicenciaFolio.style.display = '';
            checkImed.checked = false;
            checkImed.disabled = true;
        break;
        case 'RL':
            BuscarLicenciaFolio.style.display = '';
            checkImed.checked = false;
            checkImed.disabled = true;
        break;
    }
});

Buscar.addEventListener('click', () => {

    if(txtRutI.value==''){
        alert('Indique el Rut');
        txtRutI.focus();
        return;
    }
    
    if(txtFolioI.value==''&&BuscarLicenciaFolio.style.display==''){
        alert('Indique el Folio');
        txtFolioI.focus();
        return;
    }
    
    if(!formato_rut(txtRutI)) return;

    if(!checkImed.checked){
        if(txtRutI.value.length<12) txtRutI.value = '0'+txtRutI.value;
        txtrut.value = txtRutI.value;
        txtfolio.value = txtFolioI.value;
		buscaDatosFuncionario();
        cambiarOrigenLicencia();
        cambiarVistaFicha();
        
        return;
    }

    Buscar.disabled = 'true';
    Buscar.value = 'Buscando...';

    if(!validaImed(txtFolioI)){
        console.log('INVALIDO');
        Buscar.disabled = '';
        Buscar.value = 'BUSCAR';
        return;
    }

    txtFolioI.value = formatearFolioImed();
    obtenerToken();
});

cboLicencia.addEventListener('change', () => {
    seccionA2b.style.display = (cboLicencia.value != 162) ? 'none' : '';
});

txtdias.addEventListener('input', () => {
    if(txtdias.value<1 || txtdias.value>150) txtdias.value = '';
});

Listcolor.addEventListener('change', () => {
    txtcolor.value = Listcolor.value;
});

function cambiarVistaFicha(){
    BuscarLicencia.style.display = 'none';
    DatosLicencia.style.display = '';
    fichaContenedor.style.width = '60%';
}

function cerrarFicha(){
   fichaLicenciaMedica.className='fichaOculta';
   BuscarLicencia.style.display = '';
   DatosLicencia.style.display = 'none';
   fichaContenedor.style.width = '28%';
   resetFormulario();
}

function resetFormulario(){
    
	let optionReposo = document.getElementsByName("optionReposo");
	let optionRecup = document.getElementsByName("optionRecup");
	let optionInvalidez = document.getElementsByName("optionInvalidez");
	
    Buscar.disabled = '';
    Buscar.value = 'BUSCAR';

    txtRutI.value = '';
    txtFolioI.value = '';
    checkImed.checked = false;
    checkImed.disabled = false;
    Listcolor.disabled = false;
    optionInicio.checked = false;
    ListaTipo.value = 0;
    BuscarLicenciaFolio.style.display = '';
    seccionMensaje.style.display = '';
    Mensaje.innerHTML = '';

    seccionA2b.style.display = 'none';
    calendarioFecha3.disabled = '';
    txtruth.disabled = '';

    Listcolor.value = '';
    txtcolor.value = '';
    txtfolio.value = '';
    txtape1.value = '';
    txtape2.value = '';
    txtnom.value = '';
    txtrut.value = '';

    txtdias.value = '';
    txtfechaO.value = '';
    txtfechaI.value = '';
    textFechaTermino.value = '';
    fechaInicioReal.value = '';
    txtfecF.value = '';
    txtrutp.value = '';
    cboReposo.value = '';
    
    txtruth.value = '';
    txtfec3.value = '';

    txtfecF.value = '';
    cboLicencia.value = 0;

    seccionA2.style.display = '';
    seccionA3.style.display = '';
    seccionA0a.style.display = '';
    seccionA2.style.display = '';
    seccionA3.style.display = '';
    seccionA4.style.display = '';
    seccion5r1c2.style.display = '';
    seccion5r2c2.style.display = '';
    seccion5r3c1.style.display = '';
    seccion5r1c1.style.display = '';

    Listcolor.disabled = false;
    txtdias.disabled = false;
    calendarioFechaO.disabled = false;
    calendarioFechaI.disabled = false;
    cboLicencia.disabled = false;
    optionRecup[0].disabled = false;
    optionRecup[1].disabled = false;
    optionInvalidez[0].disabled = false;
    optionInvalidez[1].disabled = false;
    cboReposo.disabled = false;
    optionReposo[0].disabled = false;
    optionReposo[1].disabled = false;
    optionReposo[2].disabled = false;
    txtrutp.disabled = false;
    optionMed.disabled = false;
    optionDent.disabled = false;
    optionMat.disabled = false;
    optionAte.disabled = false;
    optionAte2.disabled = false;
    cboEspecialidad.disabled = false;
    optionFueraPlazo.disabled = true;
    optionFueraPlazo.checked = false;
    cargaEspecialidades();
}

function camposObligatorios(){
    if(codigoFuncionario.value=="") return;
    obligatorio1.innerHTML = '(*)'+obligatorio1.innerHTML;
    obligatorio2.innerHTML = '(*)'+obligatorio2.innerHTML;
    obligatorio3.innerHTML = '(*)'+obligatorio3.innerHTML;
    obligatorio4.innerHTML = '(*)'+obligatorio4.innerHTML;
    obligatorio5.innerHTML = '(*)'+obligatorio5.innerHTML;
    obligatorio6.innerHTML = '(*)'+obligatorio6.innerHTML;
    obligatorio7.innerHTML = '(*)'+obligatorio7.innerHTML;
    obligatorio8.innerHTML = '(*)'+obligatorio8.innerHTML;
    obligatorio9.innerHTML = '(*)'+obligatorio9.innerHTML;
    obligatorio10.innerHTML = '(*)'+obligatorio10.innerHTML;
    obligatorio11.innerHTML = '(*)'+obligatorio11.innerHTML;
    obligatorio12.innerHTML = '(*)'+obligatorio12.innerHTML;
}

function obtenerToken(){
    let loading = document.getElementById('mensajeCargando');
    loading.style.display = 'block';

    axios.post('https://api-cil.hoscar.cl/api/v1/login', {
    usuario: 'proservipol',
    clave: '49epRYJrTzse'
    },
    {
        headers: { 
            'Access-Control-Allow-Origin': '*'}
    })
    .then(function(res) {
        if(res.status==200) {
            token = res.data.access_token;
            obtenerDatosImed(token);
            //consultarImed(token);
        }
    })
    .catch(function(err) {
        console.log(err);
        //alert('No es posible conectar con IMED');
        Buscar.disabled = '';
        Buscar.value = 'BUSCAR';
        alert('No es posible conectar con IMED \nError: '+err.response.status+' '+err.response.statusText);
    });
}

function consultarImed(token){
    let folio = txtFolioI.value;
    let datos = obtenerDatosImed(token,folio);
    //console.log(datos);
    //asignarValoresImed(res.data.licencia[0]);
}

function obtenerDatosImed(token){
    axios.post('https://api-cil.hoscar.cl/api/v1/licByFolio', {
        'folio': txtFolioI.value
    },
    {
        headers: { 
            'Content-type': 'application/json',
            'Authorization': 'Bearer '+token }
    }
    )
    .then(function(res) {
        asignarValoresImed(res.data.licencia[0]);
    })
    .catch(function(err) {
		console.log(err);
        if(err.response.status == 500){
            alert('No se encontro el Folio indicado');
            txtFolioI.focus();
        }
    });
}

function asignarValoresImed(data){
    //console.log(data);
    let rutImed = data.RUT_FUNC;
	let optionReposo = document.getElementsByName("optionReposo");
    rutImed = rutImed.replaceAll('-','');
	rutImed = rutImed.replaceAll('.','');

    txtRutI.value = txtRutI.value.replaceAll('-','');
	txtRutI.value = txtRutI.value.replaceAll('.','');
    if(txtRutI.value.substr(0, 1)=='0') txtRutI.value = txtRutI.value.substr(1, 9);

    if(txtRutI.value != rutImed){
        alert('Rut no coincide con la Licencia Medica.');
        txtRutI.focus();
        return;
    }

    txtfolio.value = txtFolioI.value;
    txtfechaO.value = formatearFecha(data.FECHA_EMISION);
    txtfechaI.value = formatearFecha(data.FECHA_INICIO_REPOSO+' 00:00:01');
    textFechaTermino.value = formatearFecha(data.FECHA_FIN_REPOSO);
    txtdias.value = data.DIAS;
    activarInicioReal();
    activarFueraPlazo();
    cboLicencia.value = 0;
    switch(data.LREP_ID){
        case '1':
            optionReposo[0].checked = true;
        break;
        case '2':
            optionReposo[1].checked = true;
        break;
        case '3':
            optionReposo[2].checked = true;
        break;
    }

    switch(data.TLIC_ID){
        case '1':
            cboLicencia.value = 633;
        break;
        case '2':
            cboLicencia.value = 632;
        break;
        case '3':
            cboLicencia.value = 170;
        break;
        case '4':
            cboLicencia.value = 162;
            seccionA2b.style.display = '';
            calendarioFecha3.disabled = 'true';
            txtruth.disabled = 'true';
            txtruth.value = data.RUT_HIJO_FUNC.replaceAll('-','');
            formato_rut(txtruth);
            txtfec3.value = data.HIJO_FECHA_NAC;
        break;
        case '5':
            cboLicencia.value = 718;
        break;
        case '6':
            cboLicencia.value = 630;
        break;
        case '7':
            cboLicencia.value = 631;
        break;
    }

    cboReposo.value = data.TREP_ID;

	if(rutImed.length<9) rutImed = '0'+rutImed;
    txtrut.value = rutImed;

    txtrutp.value = data.RUT_PROF;

    formato_rut(txtrut);
    formato_rut(txtrutp);
	
	optionAte.checked = (data.TIPO_ATENCION=="INSTITUCIONAL");
	optionAte2.checked = (data.TIPO_ATENCION=="EXTRA INSTITUCIONAL");
	
    cargaEspecialidadesImed(data.PESP_ID, data.PESP_DESCRIPCION);
    
    txtcolor.value = 'IM';
    buscaDatosFuncionario();
    cambiarVistaFicha();

    bloquearFichaImed()
    cambiarOrigenLicencia();
}

function bloquearFichaImed(){
	let optionReposo = document.getElementsByName("optionReposo");
	let optionRecup = document.getElementsByName("optionRecup");
	let optionInvalidez = document.getElementsByName("optionInvalidez");
    Listcolor.disabled = true;
    seccionA0a.style.display = 'none';
    seccionA5.style.display = 'none';
    txtdias.disabled = true;
    calendarioFechaO.disabled = true;
    calendarioFechaI.disabled = true;
    cboLicencia.disabled = true;
    optionRecup[0].disabled = true;
    optionRecup[1].disabled = true;
    optionInvalidez[0].disabled = true;
    optionInvalidez[1].disabled = true;
    cboReposo.disabled = true;
    optionReposo[0].disabled = true;
    optionReposo[1].disabled = true;
    optionReposo[2].disabled = true;
    txtrutp.disabled = true;
    optionMed.disabled = true;
    optionDent.disabled = true;
    optionMat.disabled = true;
    optionAte.disabled = true;
    optionAte2.disabled = true;
    cboEspecialidad.disabled = true;
}

function formatearFecha(fecha){
    let formatoFecha = new Date(fecha);
    let anno = formatoFecha.getFullYear();
    let mes = formatoFecha.getMonth() + 1;
    let dia = formatoFecha.getDate();
    if (mes < 10) mes = '0' + mes;
    if (dia < 10) dia = '0' + dia;
    return dia + '-' + mes + '-' + anno;
}

function formatearFolioImed(){
    let test = txtFolioI.value.replace('-', '');
    return Number(test.substring(0,test.length - 1))+'-'+test.slice(-1);
}

function validaImed(Objeto){
	var tmpstr = "";
	var intlargo = Objeto.value
	
	if(intlargo.length> 0){
		crut = Objeto.value
		largo = crut.length;
		if( largo <2 ){
			alert('codigo inv\u00E1lido')
			Objeto.focus()
			return false;
		}
		
		for( i=0; i <crut.length ; i++ )
		
		if( crut.charAt(i) != ' ' && crut.charAt(i) != '.' && crut.charAt(i) != '-' ){
			tmpstr = tmpstr + crut.charAt(i);
		}
		rut = tmpstr;
		crut=tmpstr;
		largo = crut.length;
 
		if( largo> 2 )
			rut = crut.substring(0, largo - 1);
		else
			rut = crut.charAt(0);

		dv = crut.charAt(largo-1);
 
		if( rut == null || dv == null )
		return 0;

		var dvr = '0';
		suma = 0;
		mul  = 2;

		for(i= rut.length-1 ; i>= 0; i--){
			suma = suma + rut.charAt(i) * mul;
			if (mul == 7)
				mul = 2;
			else
				mul++;
		}

		res = suma % 11;
		if(res==1)
			dvr = 'k';
		else if (res==0)
			dvr = '0';
		else{
			dvi = 11-res;
			dvr = dvi + "";
		}
		
		if( dvr != dv.toLowerCase() ){
			alert('El codigo es invalido');
			Objeto.value="";
			Objeto.focus();
			return false;
		}
		
		//Objeto.disabled = true;
		return true;
	}
}

function cambiarOrigenLicencia(){
    //console.log(ListaTipo.value);
    switch(ListaTipo.value){
        case 0:
            //console.log('Licencia');
            Listcolor.value = '';
			seccionMensaje.style.display = '';
			Mensaje.innerHTML = '';
        break;
        case 'PP':
            Listcolor.disabled = true;
            txtcolor.value = 'PP';
            seccionA0a.style.display = 'none';
            seccionA2.style.display = 'none';
            seccionA3.style.display = 'none';
            seccionA4.style.display = 'none';
            seccionMensaje.style.display = '';
            Mensaje.innerHTML = '(*) El permiso postnatal parental, no se trata de una licencia m\u00E9dica, pero se podr\u00E1 ingresar dentro de este m\u00F3dulo para facilitar su registro y mantener un control del mismo.';
            //correlativoPermisoParental();
        break;
        case 'PV':
            Listcolor.disabled = true;
            txtcolor.value = 'PV';
            seccionA0a.style.display = 'none';
            seccionA0b.style.display = 'none';
            seccionA2.style.display = 'none';
            seccionA3.style.display = 'none';
            seccionA4.style.display = 'none';
            seccionMensaje.style.display = '';
            'Mensaje'.innerHTML = '(*) El permiso parental preventivo, no se trata de una licencia m\u00E9dica, pero se podr\u00E1 ingresar dentro de este m\u00F3dulo para facilitar su registro y mantener un control del mismo.';
            correlativoPermisoParentalPreventivo();
        break;
        case 'MP':
            txtfolio.value = new Date().getFullYear()+'-'+txtfolio.value;
            Listcolor.disabled = true;
            txtcolor.value = 'MP';
            seccionA0a.style.display = 'none';
            seccionA2.style.display = 'none';
            seccionA3.style.display = 'none';
            seccionA4.style.display = 'none';
			seccionMensaje.style.display = '';
			Mensaje.innerHTML = '(*) El reposo indicado por medicina preventiva, deber\u00E1 ingresarse a trav\u00E9s de este m\u00F3dulo, ya que para efectos de registro ser\u00E1 tratada como una licencia m\u00E9dica.';
        break;
        case 'RL':
            Listcolor.disabled = true;
            txtcolor.value = 'RL';
            seccionA0a.style.display = 'none';
            seccionA2.style.display = 'none';
            seccionA3.style.display = 'none';
            seccionA0a.style.display = 'none';
            seccion5r1c2.style.display = 'none';
            seccion5r2c2.style.display = 'none';
            seccion5r3c1.style.display = 'none';
            seccion5r1c1.style.display = '';
			seccionMensaje.style.display = '';
			document.getElementById("Mensaje").innerHTML = "(*) Orden de reposo por contacto estrecho Covid-19 Laboral.";
        break;
    }
    //Listcolor.value = ListaTipo.value;
    //seccion1uno.style.display = 'none';
}

function cargaEspecialidadesImed(codigo,descripcion){
    var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", "", "", "");
    cboEspecialidad.options[0] = datosOpcion;
    var datosOpcion = new Option(descripcion, codigo, "", "");
    cboEspecialidad.options[1] = datosOpcion;
    cboEspecialidad.value = codigo;
}
