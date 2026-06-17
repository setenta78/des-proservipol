var tipoBusqueda = 0;
var tipoAcceso = 0;

btnCerrarFicha.onclick = () => {
    fichaClaveUsuario.className='fichaOculta';
    BuscarUsuario.style.display = '';
    fichaContenedor.style.width = '28%';
    btnBuscar.disabled = '';
    btnBuscar.value = 'BUSCAR';
    btnBuscar.style.display = '';
    txtCodFuncionario.value = '';
    DatosUsuario.style.display = 'none';
    buscarUnidadNombre.value = '';
    let data = {
        rutFuncionario          : '',
        codigoFuncionario       : '',
        password                : '',
        descripcionGrado        : '',
        apellidoFuncionario     : '',
        nombreFuncionario       : '',
        tipoUsuarioCodigo       : '',
        codigoUnidad            : '',
        codigoPadre             : '',
        descripcionUnidad       : '',
        captura                 : '',
        unidadOrigen            : '',
        unidadOrigenDescripcion : ''
    }
    contrasenaBloq = false;
    imgContrasena.onclick();
    asignarDatosUsuario(data);
}

btnBuscar.onclick = (e) => {
    if(txtCodFuncionario.value==''){
        alert('Indique el Codigo Funcionario');
        txtCodFuncionario.focus();
        return;
    }
    e.srcElement.disabled = 'true';
    e.srcElement.value = 'Buscando...';
    obtenerDatosUsuario();
}

var contrasenaBloq = true;
imgContrasena.onclick = () => {
    if(contrasenaBloq){
        imgContrasena.src = 'images/eyeOpen.png';
        contrasenaBloq = false;
        textContrasena.type = 'text';
    }
    else{
        imgContrasena.src = 'images/eyeClose.png';
        contrasenaBloq = true;
        textContrasena.type = 'password';
    }
}

btnGuardar.onclick = (e) => {
    if(!validarFichaUsuario()) return;
    if(tipoUsuario.value==0){
        nuevoUsuario();
    }
    else {
        modificaUsuario();
    }
}

btnEliminar.onclick = (e) => {
    let codFuncionario = textCodigoFuncionario.value;
    if(codFuncionario!='') eliminarUsuario(codFuncionario);
}

selUnidades.ondblclick = (e) => {
    let unidad = e.srcElement.value.split('-');
    let nombre = e.srcElement.innerText;
    if(unidad[1]=='X'){
        obtenerDatosUnidad(unidad[0]);
        return;
    }
    if(tipoAcceso==0 || (tipoAcceso==1 && unidad[2]==1)){
        asignarValorUnidad(unidad[0], nombre, e.srcElement.value);
        return;
    }
}

btnAsignarUnidad.onclick = () => {
    if(selUnidades.value=='') return;
    let unidad = selUnidades.value.split('-');
    let nombre = selUnidades.options[selUnidades.selectedIndex].text;
    if(nombre=='...' || (tipoAcceso==1 && unidad[2]==0)) return;
    asignarValorUnidad(unidad[0], nombre, selUnidades.value);
}

buscarUnidadNombre.onkeyup = (e) => {
    (e.srcElement.value=='') ? obtenerDatosUnidad(20) : obtenerDatosUnidadPorNombre(e.srcElement.value);    
}

selTipoUsuario.onchange = (e) => {
    tipoAcceso = (e.srcElement.value == 10 || e.srcElement.value == 20) ? 1 : 0;
    if(tipoBusqueda) obtenerDatosUnidadPorNombre(buscarUnidadNombre.value);
}

function cambiarVista(){
    BuscarUsuario.style.display = 'none';
    DatosUsuario.style.display = '';
    fichaContenedor.style.width = '60%';
}

function asignarDatosUsuario(data){
	console.log(data);
    textRutFuncionario.value = data.rutFuncionario;
    textCodigoFuncionario.value = data.codigoFuncionario;
    textContrasena.value = data.password;
    textContrasenaOld.value = data.password;
    textGrado.value = data.descripcionGrado;
    textApellido.value = data.apellidoFuncionario;
    textNombre.value = data.nombreFuncionario;
    selTipoUsuario.value = data.tipoUsuarioCodigo;
    tipoAcceso = (data.tipoUsuarioCodigo == 10 || data.tipoUsuarioCodigo == 20) ? 1 : 0;
    textBuscarUnidad.value = data.descripcionUnidad;
    codBuscarUnidad.value = data.codigoPadre;
    codUnidadPadre.value = data.codigoPadre;
    codBuscarUnidadAll.value = data.codigoUnidad+'X'+data.captura;
    tipoUsuario.value = data.tipoUsuarioCodigo;
    unidadUsuario.value = data.codigoUnidad;
    unidadUsuarioCaptura.value = data.captura;
    codUnidadOrigen.value = data.unidadOrigen;
    descUnidadOrigen.value = data.unidadOrigenDescripcion;
    obtenerDatosUnidad(codBuscarUnidad.value);
    codBuscarUnidad.value = data.unidadOrigen;
}

function asignarDatosUnidad(data){
    selUnidades.length = null;
    if(!data) return;
    let datosOpcion = new Option('NACIONAL', 20+'- -0', '', '');
    if(data[0].codAbuelo) datosOpcion = new Option('...', data[0].codAbuelo+'-X-0', '', '');
    selUnidades.options[0] = datosOpcion;
    for(i=0;i<data.length;i++){
        let codigoUnidad        = (data[i].conHijos==1) ? data[i].codUnidad+'-X-'+data[i].captura : data[i].codUnidad+'- -'+data[i].captura;
        let descripcionUnidad   = data[i].descUnidad;
        let datosOpcion = new Option(descripcionUnidad, codigoUnidad, '', '');
        selUnidades.options[i+1] = datosOpcion;
    }
}

function asignarValorUnidad(unidad, nombre, unidadAll){
    codBuscarUnidad.value = unidad;
    textBuscarUnidad.value = nombre;
    codBuscarUnidadAll.value = unidadAll;
}

function validarFichaUsuario(){
    if(tipoUsuario.value == selTipoUsuario.value && unidadUsuario.value == codBuscarUnidad.value && textContrasenaOld.value == textContrasena.value){
        alert('Sin Cambios');
        return false;
    }
    if(selTipoUsuario.value == '0'){
        alert('Seleccione tipo');
        return false;
    }
    if(codBuscarUnidad.value == ''){
        alert('Seleccione Unidad');
        return false;
    }
    if(unidadUsuario.value == codBuscarUnidad.value && (tipoAcceso==1 && unidadUsuarioCaptura.value==0)){
        alert('Seleccione una Unidad con Proservipol');
        return false;
    }
    let unidad = codBuscarUnidadAll.value.split('-');
    if(tipoAcceso==1 && unidad[2]==0){
        alert('Seleccione una Unidad con Proservipol');
        return false;
    }
    if((codUnidadOrigen.value!=codBuscarUnidad.value && (selTipoUsuario.value!=90 && selTipoUsuario.value!=100))&&(codUnidadPadre.value!=codBuscarUnidad.value&&selTipoUsuario.value==80)){
        alert('El funcionario pertenece a: '+descUnidadOrigen.value+' , aun no le puede asignar clave');
        return false;
    }
    return true;
}

function nuevoUsuario(){
    axios.get('http://proservipol.carabineros.cl/API/crearUsuario/', {
        params: {
            codFuncionario: txtCodFuncionario.value,
            codigoUnidad: codBuscarUnidad.value,
            tipoUsuario: selTipoUsuario.value,
            password: textContrasena.value
        }
    })
    .then(function() {
        alert('Usuario Creado');
        btnCerrarFicha.onclick();
    })
    .catch(function() {
        alert('Error al crear usuario');
    });
}

function obtenerDatosUsuario(){
    axios.get('http://proservipol.carabineros.cl/API/buscarUsuario/', {
        params: {
            codigoFuncionario: txtCodFuncionario.value
        }
    })
    .then(function(res) {
        asignarDatosUsuario(res.data.data[0]);
        cambiarVista();
    })
    .catch(function() {
        alert('No se encontro Funcionario');
        btnBuscar.value = 'BUSCAR';
        btnBuscar.disabled = '';
        txtCodFuncionario.focus();
    });
}

function obtenerDatosUnidadPorNombre(buscar){
    tipoBusqueda = 1;
    axios.get('http://proservipol.carabineros.cl/API/buscarUnidad/', {
        params: {
            'descUnidad': buscar,
            'captura' : tipoAcceso
        }
    })
    .then(function(res) {
        asignarDatosUnidad(res.data.data);
    })
    .catch(function(err) {
        console.log(err);
        if(err.response.status == 500){
            console.log('No se encontra unidad');
        }
    });
}

function obtenerDatosUnidad(codUnidad){
    tipoBusqueda = 0;
    if(!codUnidad) return;
    axios.get('http://proservipol.carabineros.cl/API/buscarUnidad/', {
        params: {
            'codUnidad': (codUnidad) ? codUnidad : 20
        }
    })
    .then(function(res) {
        asignarDatosUnidad(res.data.data);
    })
    .catch(function(err) {
        if(err.response.status == 500){
            console.log('No se encontra unidad');
        }
    });
}

function modificaUsuario(){
    axios.get('http://proservipol.carabineros.cl/API/modificarUsuario/', {
        params: {
            codFuncionario: txtCodFuncionario.value,
            codigoUnidad: codBuscarUnidad.value,
            tipoUsuario: selTipoUsuario.value,
            password: textContrasena.value
        }
    })
    .then(function() {
        alert('Usuario Modificado');
        btnCerrarFicha.onclick();
    })
    .catch(function() {
        alert('Error al crear usuario');
    });
}

function eliminarUsuario(codFuncionario){
    axios.get('http://proservipol.carabineros.cl/API/eliminarUsuario/', {
        params: {
            'codFuncionario': codFuncionario
        }
    })
    .then(function() {
        alert('Usuario Eliminado');
        btnCerrarFicha.onclick();
    })
    .catch(function(err) {
        console.log('error');
    });
}