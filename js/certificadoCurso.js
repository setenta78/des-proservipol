textCodFuncionario.addEventListener('input', obtenerListaFuncionarios);

function obtenerListaFuncionarios(){
    listado.style.visibility = 'collapse';
    axios.get('http://proservipol.carabineros.cl/API/buscarFuncionariosCapacitadosPorCodigo/', {
        params: {
            'codigoFuncionario': textCodFuncionario.value,
            'limite'           : 5
        }
    })
    .then(function(res) {
        asignarValoresFucionarios(res.data.data);
    })
    .catch(function(err) {
        //console.log(err);
        if(err.response.status == 500){
            console.log('No se encontran funcionarios');
        }
    });
}

function asignarValoresFucionarios(data){
    listadoFuncionariosCapacitados.innerHTML = "<ul>";
    data.map((funcionario) => {
        let nombreCompleto = funcionario.grado+", "+funcionario.primerApellido+" "+funcionario.segundoApellido+" "+funcionario.nombre+" "+funcionario.nombre2+" <div style=\"grid-column:2;\">"+funcionario.perfil+"</div>";
        listadoFuncionariosCapacitados.innerHTML += "<li style=\"cursor:pointer;margin:5px;display:grid;\" onclick='buscarCapacitaciones(\""+funcionario.codFuncionario+"\")'>"+nombreCompleto+"</li>";
    });
    listadoFuncionariosCapacitados.innerHTML += "</ul>";
}

function buscarCapacitaciones(codFuncionario){
    console.log(codFuncionario);
    textCodFuncionario.value = codFuncionario;
    obtenerListaFuncionarios();
    obtenerListaCapacitaciones();
}

function obtenerListaCapacitaciones(){
    axios.get('http://proservipol.carabineros.cl/API/buscarCapacitacionesPorCodigo/', {
        params: {
            'codigoFuncionario': textCodFuncionario.value
        }
    })
    .then(function(res) {
        asignarValoresCapacitaciones(res.data.data);
    })
    .catch(function(err) {
        console.log(err);
        if(err.response.status == 500){
            console.log('No se encontran funcionarios');
        }
    });
}

function asignarValoresCapacitaciones(data){
    listado.style.visibility = 'visible';
    let div = "";
    let id = 1;
    div = "<table width='100%' cellspacing='1' cellpadding='1'>";
    data.map((capacitacion) => {
        let onclick = (capacitacion.codigoVerificacion != '') ? "<a href=\"./imprimible/capacitacion/certificadoAprobacion.php?codVerificacion="+capacitacion.codigoVerificacion+"\" target='_blank' ><img src=\"img/certificado.png\" width='20' height='20'></a>": "";
        let fondoLinea = ((id%2) ? "linea1" : "linea2")
        div += "<tr id='"+id+"' OnMouseOver=\"cambiarClase(this, 'lineaMarcada')\" OnMouseOut=\"cambiarClase(this, '"+fondoLinea+"')\" class='"+fondoLinea+"' >";
            div += "<td width='5%' align='center' >"+id+"</td>";
            div += "<td width='35%' align='center' >"+capacitacion.curso+"</td>";
            div += "<td width='20%' align='center' >"+capacitacion.fechaCapacitacion+"</td>";
            div += "<td width='10%' align='center' >"+capacitacion.notaProservipol+"</td>";
            div += "<td width='20%' align='center' >"+capacitacion.codigoVerificacion+"</td>";
            div += "<td width='10%' align='center' >"+onclick+"</td>";
        div += "</tr>";
        id++;
    });
    div += "</table>";
    listadoCapacitaciones.innerHTML = div;
}
