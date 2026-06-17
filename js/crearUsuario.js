var search = document.querySelector('#myprod');
var results = document.querySelector('#listprod');
var templateContent = document.querySelector('#listtemplate').content;
obtenerDatosUnidad(20);

search.addEventListener('keyup', function handler(event) {
    while (results.children.length) results.removeChild(results.firstChild);
    var inputVal = new RegExp(search.value.trim(), 'i');
    var set = Array.prototype.reduce.call(templateContent.cloneNode(true).children, function searchFilter(frag, item, i) {
        if (inputVal.test(item.value) && frag.children.length < 6) frag.appendChild(item);
        return frag;
    }, document.createDocumentFragment());
    results.appendChild(set);
});

function obtenerDatosUnidad(codUnidad){
    console.log(codUnidad);
    axios.get('http://proservipol.carabineros.cl/API/buscarUnidad/', {
        params: {
            'codUnidad': codUnidad
        }
    })
    .then(function(res) {
        asignarDatosUnidad(res.data.data);
    })
    .catch(function(err) {
        console.log(err);
        if(err.response.status == 500){
            console.log('No se encontra usuario');
        }
    });
}

function asignarDatosUnidad(data){
    console.log(data);
    console.log(listtemplate);
    let datosOpcion = new Option('NACIONAL', 20, '', '');
    listtemplate.options = datosOpcion;
    /*
    templateContent.length = null;
    let datosOpcion = new Option('NACIONAL', 20, '', '');
    if(data[0].codAbuelo) datosOpcion = new Option('...', data[0].codAbuelo+'-X', '', '');
    templateContent.options[0] = datosOpcion;
    for(i=0;i<data.length;i++){
        let codigoUnidad        = (data[i].conHijos==1) ? data[i].codUnidad+'-X' : data[i].codUnidad;
        let descripcionUnidad   = data[i].descUnidad;
        let datosOpcion = new Option(descripcionUnidad, codigoUnidad, '', '');
        templateContent.options[i+1] = datosOpcion;
    }
    */
}