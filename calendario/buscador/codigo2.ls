

    fetch("http://proservipol.carabineros.cl/API/listaEstadoVehiculo/?fecha=20200501")
            .then(response=>response.json())
            .then(datos=>console.log(datos));
