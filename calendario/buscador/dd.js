
 //   const promesa1=window.fetch("http://proservipol.carabineros.cl/API/listaEstadoVehiculo/?fecha=20210928");
   // const promesa2=promesa1.then(response=>response.json());
   // promesa2.then(datos=>console.log(datos));
   
   
//fetch("http://proservipol.carabineros.cl/API/listaEstadoVehiculo/?fecha=20210928")
//.then(r =>  r.json().then(data => ({status: r.status, body: data})))
//.then(obj => console.log(obj));

fetch('../../API/listaEstadoVehiculo/index.php?fecha=20210928')
  .then(response => response.json())
  .then(commits => alert(commits[0].zona.prefectura));