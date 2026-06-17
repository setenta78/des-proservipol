//localStorage.setItem('token', 'cebade108e72ed4fb72d5b369b426a4e6b2a149a3f75cff2d61a46dae1ad8a3d55ffe9d94d0d2d06a645ab5bf8fc01e15945b43ae517b15364a82821ee558f75');
//sessionStorage.setItem('token', 'cebade108e72ed4fb72d5b369b426a4e6b2a149a3f75cff2d61a46dae1ad8a3d55ffe9d94d0d2d06a645ab5bf8fc01e15945b43ae517b15364a82821ee558f75');
validateToken();

function validateToken(){
    let token = sessionStorage.getItem('token');
    console.log("Validar");
    /*
    axios.post('https://api-cil.hoscar.cl/api/v1/login', {
            usuario: 'proservipol',
            clave: '49epRYJrTzse'
        },
        { headers: { 
            'Access-Control-Allow-Origin': '*',
            'Authorization': 'Bearer '+token,
            'Accept': 'application/json'}})
    .then(function(res) {
        if(res.status==200) {
            console.log(res);
        }
    })
    .catch(function(err) {
        console.log(err);
    });
    */
   console.log(token);
}

function eliminarToken(){
    sessionStorage.removeItem('token');
}
