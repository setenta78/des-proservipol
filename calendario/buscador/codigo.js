const aplicacion = document.querySelector(".contenedor")

//const url = "https://jsonplaceholder.typicode.com/users"

const url = "http://proservipol.carabineros.cl/API/listaEstadoVehiculo/?fecha=20200501"

fetch(url)
//mode:"cors"
.then(res => res.json())
.then (data =>{
	data.forEach(usuario =>	{
		const p = document.createElement("p")
		//p.innerHTML = usuario.name
		p.innerHTML = usuario.ZONA
		aplicacion.appendChild(p)
	});
})
.catch(err => console.log(err))

