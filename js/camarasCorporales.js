window.onload = (e) => {
    actualizarTamanoLista('listado');
    (subMenu.value!="agregados") ? leeCamaras('CODIGO_CAMARA', 'ASC') : leeCamarasAgregadas('CODIGO_CAMARA', 'ASC');
    leeMarcaCamara('selMarca');
    leeProcedenciaCamara('selOrigen');
    leeEstadosRecursos('selEstado','CAM');
}

function leeCamaras(valColumna, valOrdenar){
    axios.get('http://proservipol.carabineros.cl/API/camaras/listaCamaras/', {
        params: {
            codigoUnidad: unidadUsuario.value,
            columna: valColumna,
            ordernar: valOrdenar,
            nrSerie: textBuscar.value
        }
    })
    .then(function(res) {
        asignarDatosListaCamaras(res.data.data);
    })
    .catch(function() {
        alert('No se encontraron camaras');
    });
}

function leeCamarasAgregadas(valColumna, valOrdenar){
    axios.get('http://proservipol.carabineros.cl/API/camaras/listaCamarasAgregadas/', {
        params: {
            codigoUnidad: unidadUsuario.value,
            columna: valColumna,
            ordernar: valOrdenar,
            nrSerie: textBuscar.value
        }
    })
    .then(function(res) {
        asignarDatosListaCamaras(res.data.data);
    })
    .catch(function() {
        alert('No se encontraron camaras');
    });
}

function asignarDatosListaCamaras(data){
    var listadoCamaras = "<table width='100%' cellspacing='1' cellpadding='1' >";
    if(!data) listadoCamaras += "<tr><td>NO EXISTEN CAMARAS CORPORALES "+((subMenu.value=="agregados") ? "AGREGADAS" : "ASIGNADAS")+" A LA UNIDAD</td></tr>";
    for(i=0;i<data.length;i++){
        var fondoLinea = (i%2==0) ? "linea1" : fondoLinea = "linea2";
        listadoCamaras += "<tr id='"+(i+1)+"' OnMouseOver=\"cambiarClase(this, 'lineaMarcada')\" OnMouseOut=\"cambiarClase(this, '"+fondoLinea+"')\" class='"+fondoLinea+"' onDblClick='abrirFichaCamara(\""+data[i]['codigoCamara']+"\")' >";
        listadoCamaras += "<td width='4%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
        listadoCamaras += "<td width='15%' align='center' title='"+data[i]['codEquipo']+"' align='center'><div id='valorColumna'>"+data[i]['codEquipo']+"</div></td>";
        listadoCamaras += "<td width='15%' align='center' title='"+data[i]['marca']+"' ><div id='valorColumna'>"+data[i]['marca']+"</div></td>";
        listadoCamaras += "<td width='15%' align='center' title='"+data[i]['modelo']+"'><div id='valorColumna'>"+data[i]['modelo']+"</div></td>";
        listadoCamaras += "<td width='15%' align='center' title='"+data[i]['nroSerie']+"'><div id='valorColumna'>"+data[i]['nroSerie']+"</div></td>";
        listadoCamaras += (subMenu.value!="agregados") ? "<td width='18%' align='center' title='"+data[i]['estado']+"'><div id='valorColumna'>"+((data[i]['estado']!='AGREGADO') ? data[i]['estado'] : data[i]['estado']+" A "+data[i]['unidad'])+"</div></td>" : "<td width='18%' align='center' title='"+data[i]['estado']+"'><div id='valorColumna'>"+data[i]['estado']+", "+data[i]['unidad']+"</div></td>";
        listadoCamaras += "</tr>";
    }
    listadoCamaras += "</table>";
    listadoCamarasCorporales.innerHTML = listadoCamaras;
}

function cambiaOrdenLista(valColumna,valOrdenar){
    var valOrdenarNuevo = (valOrdenar=='ASC') ? 'DESC' : 'ASC';
    switch(valColumna){
        case 'codigo':
            document.getElementById("labColCodigoEquipo").innerHTML = "CODIGO EQUIPO&nbsp;<img src='./img/"+valOrdenar+"_order.gif'>";
            document.getElementById("labColMarca").innerHTML = "MARCA";
            document.getElementById("labColModelo").innerHTML = "MODELO";
            document.getElementById("labColNroSerie").innerHTML = "NRO SERIE";
            document.getElementById("labColEstado").innerHTML = "ESTADO";
            document.getElementById("colCodigoEquipo").onmousedown = function(){cambiaOrdenLista(valColumna,valOrdenarNuevo)};
            leeCamaras('COD_EQUIPO', valOrdenar);
        break;
        case 'marca':
            document.getElementById("labColCodigoEquipo").innerHTML = "CODIGO EQUIPO";
            document.getElementById("labColMarca").innerHTML = "MARCA&nbsp;<img src='./img/"+valOrdenar+"_order.gif'>";
            document.getElementById("labColModelo").innerHTML = "MODELO";
            document.getElementById("labColNroSerie").innerHTML = "NRO SERIE";
            document.getElementById("labColEstado").innerHTML = "ESTADO";
            document.getElementById("colMarca").onmousedown = function(){cambiaOrdenLista(valColumna,valOrdenarNuevo)};
            leeCamaras('MARCA', valOrdenar);
        break;
        case 'modelo':
            document.getElementById("labColCodigoEquipo").innerHTML = "CODIGO EQUIPO";
            document.getElementById("labColMarca").innerHTML = "MARCA";
            document.getElementById("labColModelo").innerHTML = "MODELO&nbsp;<img src='./img/"+valOrdenar+"_order.gif'>";
            document.getElementById("labColNroSerie").innerHTML = "NRO SERIE";
            document.getElementById("labColEstado").innerHTML = "ESTADO";
            document.getElementById("colModelo").onmousedown = function(){cambiaOrdenLista(valColumna,valOrdenarNuevo)};
            leeCamaras('MODELO', valOrdenar);
        break;
        case 'nroserie':
            document.getElementById("labColCodigoEquipo").innerHTML = "CODIGO EQUIPO";
            document.getElementById("labColMarca").innerHTML = "MARCA";
            document.getElementById("labColModelo").innerHTML = "MODELO";
            document.getElementById("labColNroSerie").innerHTML = "NRO SERIE&nbsp;<img src='./img/"+valOrdenar+"_order.gif'>";
            document.getElementById("labColEstado").innerHTML = "ESTADO";
            document.getElementById("colNroSerie").onmousedown = function(){cambiaOrdenLista(valColumna,valOrdenarNuevo)};
            leeCamaras('NRO_SERIE', valOrdenar);
        break;
        case 'estado':
            document.getElementById("labColCodigoEquipo").innerHTML = "CODIGO EQUIPO";
            document.getElementById("labColMarca").innerHTML = "MARCA";
            document.getElementById("labColModelo").innerHTML = "MODELO";
            document.getElementById("labColNroSerie").innerHTML = "NRO SERIE";
            document.getElementById("labColEstado").innerHTML = "ESTADO&nbsp;<img src='./img/"+valOrdenar+"_order.gif'>";
            document.getElementById("colEstado").onmousedown = function(){cambiaOrdenLista(valColumna,valOrdenarNuevo)};
            leeCamaras('ESTADO', valOrdenar);
        break;
    }
}