function ejecutarMostrar(){
    setTimeout(() => {
        mostrarCantidadMatriculados();
        ejecutarMostrar();
    }, 10000);
}

async function buscarFuncionario(){	
    const fecha = new Date();
    const fechaInicio = new Date(2026, 2, 10, 0, 0, 0);   // 16/03/2026 10:00
    const fechaLimite = new Date(2026, 2, 10, 23, 59, 59); // 27/03/2026 23:59
    
    if(fecha < fechaInicio || fecha > fechaLimite){
        alert("Inscripción cerrada. El período de inscripción es del 16 al 27 de marzo de 2026.");
        return;
    }

    let dataPersonal = await buscarFuncionarioPersonal();
    if(dataPersonal && dataPersonal.data){
        let estaMatriculado = await buscarFuncionarioMatriculado();
        let estaAprobado = await buscarFuncionarioAprobado();
        
        if(!estaMatriculado.data && !estaAprobado.data){
            asignarValores(dataPersonal);
            textCodFuncionario.value = textCodFuncionarioBusqueda.value;
            formularioBusqueda.style.display = "none";
            formularioRegistro.style.display = "block";
            return;
        }
        if(estaMatriculado.data) alert("El Funcionario ya se encuentra matriculado");
        if(estaAprobado.data) alert("El Funcionario ya se encuentra aprobado");
        textCodFuncionarioBusqueda.value = "";
        return;
    }
    alert("Código de Funcionario no encontrado, verifique y reintente");
    textCodFuncionarioBusqueda.value = "";
}

function volver(){
    borrarValores();
    formularioBusqueda.style.display = "block";
    formularioRegistro.style.display = "none";
}

function borrarValores(){
    textCodFuncionarioBusqueda.value = "";
    formularioMatricula.reset();
}

function asignarValores(valores){
    rut.value               = valores.data[0]['rut'];
    textNombre1.value       = valores.data[0]['primerNombre'];
    textNombre2.value       = valores.data[0]['segundoNombre'];
    textApellido1.value     = valores.data[0]['apellidoPaterno'];
    textApellido2.value     = valores.data[0]['apellidoMaterno'];
    codEscalafon.value      = valores.data[0]['codEscalafon'];
    codGrado.value          = valores.data[0]['codGrado'];
    textGrado.value         = valores.data[0]['grado'];
    textDotacion.value      = valores.data[0]['dotacion'];
    textReparticionD.value  = valores.data[0]['reparticionDependiente'];
    textReparticionA.value  = valores.data[0]['altaReparticion'];
    textEmail.value         = textCodFuncionarioBusqueda.value + '@carabineros.cl';
}

function validaFormulario(){
    if(tipoCurso.value === ""){
        alert("Debe seleccionar un Curso");
        tipoCurso.focus();
        return false;
    }
    return true;
}

async function matricular(){
    btnRegistrar.disabled = true;
    const fecha = new Date();
    const fechaLimite = new Date(2026, 2, 10, 23, 59, 59); // 27/03/2026 23:59
    
    if(fecha > fechaLimite){
        alert("Inscripción cerrada. El periodo de inscripción terminó.");
        btnRegistrar.disabled = false;
        return;
    }

    if(!validaFormulario()) {
        btnRegistrar.disabled = false;
        return;
    }

    let matriculado = await matricularFuncionario();
    if(matriculado && matriculado.data){
        alert("Funcionario matriculado correctamente");
        borrarValores();
        formularioBusqueda.style.display = "block";
        formularioRegistro.style.display = "none";
        btnRegistrar.disabled = false;
        return;
    }
    btnRegistrar.disabled = false;
}

async function buscarFuncionarioMatriculado(){
    try {
        let response = await fetch('http://proservipol.carabineros.cl/API/buscarFuncionarioMatricula/?codFuncionario='+textCodFuncionarioBusqueda.value);
        if(response.status === 200) return await response.json();
        if(response.status === 412) alert('Debe indicar el Código de Funcionario');
        if(response.status === 404) alert('Error de conexión');
    } catch (e) {
        console.error(e);
    }
    return null;
}

async function buscarFuncionarioAprobado(){
    try {
        let response = await fetch('http://proservipol.carabineros.cl/API/buscarFuncionarioAprobado/?codFuncionario='+textCodFuncionarioBusqueda.value);
        if(response.status === 200) return await response.json();
        if(response.status === 412) alert('Debe indicar el Código de Funcionario');
        if(response.status === 404) alert('Error de conexión');
    } catch (e) {
        console.error(e);
    }
    return null;
}

async function buscarFuncionarioPersonal(){
    try {
        let response = await fetch('http://proservipol.carabineros.cl/API/buscarFuncionarioPersonal/?codFuncionario='+textCodFuncionarioBusqueda.value);
        if(response.status === 200) return await response.json();
        if(response.status === 412) alert('Debe indicar el Código de Funcionario');
        if(response.status === 404) alert('Error de conexión');
    } catch (e) {
        console.error(e);
    }
    return null;
}

async function matricularFuncionario(){
    try {
        let response = await fetch('http://proservipol.carabineros.cl/API/matricularFuncionario/index.php', {
            method: 'POST',
            body: new FormData(formularioMatricula)
        });
        if(response.status === 200) return await response.json();
        if(response.status === 412) alert('Debe llenar el formulario');
        if(response.status === 404) alert('Ocurrió un error al registrar la matrícula');
    } catch (e) {
        console.error(e);
    }
    return null;
}

async function cantidadMatriculados(){
    try {
        let response = await fetch('http://proservipol.carabineros.cl/API/cantidadMatriculados/index.php');
        if(response.status === 200) return await response.json();
    } catch (e) {
        console.error(e);
    }
    return 0;
}

async function mostrarCantidadMatriculados(){
    let dataMatriculados = await cantidadMatriculados();
    mostrarMatriculados.innerHTML = "Matriculados: " + Intl.NumberFormat("de-DE").format(dataMatriculados) + " de 3.000";
    if(dataMatriculados >= 3000) cupoMatriculasLlena();
}

function cupoMatriculasLlena(){
    btnBuscar.disabled = true;
    btnRegistrar.disabled = true;
    textCodFuncionarioBusqueda.disabled = true;
    mensajeCuposLlenos.innerHTML = 'MATRÍCULAS COMPLETAS PARA EL PERIODO ACTUAL DE CAPACITACIONES';
}
