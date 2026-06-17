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
    alert('DEBE INGRESAR EL FOLIO DE LA LICENCIA MEDICA');
    // seleccionamos el campo incorrecto
    document.formulario.texto2.focus();
    return false;
  }
  
  if(formulario.mes.value == 0){
    // informamos del error
    alert('DEBE SELECCIONAR EL MES.');
    // seleccionamos el campo incorrecto
    document.formulario.mes.focus();
    return false;
  }
    if(formulario.anno.value == 0){
    // informamos del error
    alert('DEBE SELECCIONAR EL AGNO.');
    // seleccionamos el campo incorrecto
    document.formulario.anno.focus();
    return false;
  }
   document.formulario.submit();
   return true;
}

