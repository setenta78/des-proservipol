//Marcar o desmarcar todos los checkbox
function marcar(source) 
 {
        checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
        for(i=0;i<checkboxes.length;i++) //recorremos todos los controles
        {
            if(checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
            {
                checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
            }
        }
  }
  


//Mensaje de confirmacion  
function confirmar ( mensaje ) {
return confirm( mensaje );
}

//Validar checkbox
function validate(form){ 
for(var i = 0; i < form.desv.length; i++){ 
if(form.desv[i].checked)return true; 
} 
alert('DEBE DESVALIDAR AL MENOS UN DIA.'); 
return false; 
} 


//Volver
function goBack() {
    window.history.back()
  //alert("Prueba.");
}

//Validar
function validar(){
  // primera comprobación
  if(formulario.texto2.value == ''){
    // informamos del error
    alert('DEBE INGRESAR EL CÓDIGO DE FUNCIONARIO.');
    // seleccionamos el campo incorrecto
    document.formulario.texto2.focus();
    return false;
  }

  
    if(formulario.dateArrival1.value == 0 || formulario.dateArrival1.value == ''){
    // informamos del error
    alert('DEBE SELECCIONAR LA FECHA 1');
    // seleccionamos el campo incorrecto
    document.formulario.dateArrival1.focus();
    return false;
  }
  
    if(formulario.dateArrival2.value == 0 || formulario.dateArrival2.value == ''){
    // informamos del error
    alert('DEBE SELECCIONAR LA FECHA 2');
    // seleccionamos el campo incorrecto
    document.formulario.dateArrival2.focus();
    return false;
  }
  
   document.formulario.submit();
   return true;
}

