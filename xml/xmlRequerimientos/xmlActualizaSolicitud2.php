<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbRequerimientos.php");
	require("../../objetos/solicitudRequerimiento.class.php");
	//require("../../objetos/estadoAnimal.class.php");
	//require("../../objetos/unidad.class.php");
	//require("../../objetos/tipoAnimal.class.php");

	 $fecha2 = date("d-m-Y");
	//$codigoVehiculo			= $_POST['codigoVehiculo'];			
	

	//$codigoTipoVehiculo 	= $_POST['tipoVehiculo'];
	
	//$codigoEstado	  		= $_POST['estado'];
  //$fechaNuevoEstado	  	= $_POST['fechaNuevoEstado'];

	//$numeroBCU				= $_POST['numeroBCU'];
	
	//$codigoUnidadAgregado	= $_POST['codigoUnidadAgregado'];
	
	$codigo		= $_POST['codigo'];
	$observ		= strtoupper($_POST['observ']);
	  $codigoUsuario		= $_POST['codigoUsuario'];
	  $tipoMovimiento2 = $_POST['movimiento'];
	  $respuesta = strtoupper($_POST['respuesta']);
	//$id1			= $_POST['id1'];
	//$id2		  = $_POST['id2'];
	
	//$tipoAnimal       = $_POST['tipoAnimal'];
	
	//$verificar     = $_POST['verificar'];  
	//$verificaOculto = $_POST['verificaOculto'];  
	
	
	//$codigoUnidad			= "610040000000";
	session_start();                                                 
  $codigoUnidad			= $_SESSION['USUARIO_CODIGOUNIDAD'];   	 
    
	//$unidad = new unidad;
	//$unidad->setCodigoUnidad($codigoUnidad);
	//$unidad->setDescripcionUnidad("");
	
	//$unidadAgregado = new unidad;
	//$unidadAgregado->setCodigoUnidad($codigoUnidadAgregado);
	//$unidadAgregado->setDescripcionUnidad("");
                        
	
	//$estado = new estadoAnimal;
	//$estado->setCodigo($codigoEstado);
	//$estado->setDescripcion("");
	
 $idUnidad= $_POST['idUnidad'];	 
 $idUnidad2= $_POST['idUnidad2'];	
 $idUnidad3= $_POST['idUnidad3'];	
 $idFecha= $_POST['idFecha'];	      
 $idFecha2= $_POST['idFecha2'];	      
 $idFecha3= $_POST['idFecha3'];	      
 $idFecha4 = $_POST['idFecha4'];	    
 $idFecha5= $_POST['idFecha5'];	      
 $idFecha6= $_POST['cidFecha6'];	      
 $idServicio = $_POST['idServicio'];	   
 $idFuncionario = $_POST['idFuncionario'];	
 $idFuncionario2 = $_POST['idFuncionario2'];	
 $idRut = $_POST['idRut'];	        
 $idNombre = $_POST['idNombre'];	     
 $idUsuario  = $_POST['idUsuario'];	   
 $idUsuario2  = $_POST['idUsuario2'];	  
 $idFolio = $_POST['idFolio'];	      
 $idBCU = $_POST['idBCU'];	        
 $idTipoAnimal = $_POST['idTipoAnimal'];	 
 $idBCU2 = $_POST['idBCU2'];	       
 $idPatente = $_POST['idPatente'];	
 $idPatente2 = $_POST['idPatente2'];	
 $idPatente3 = $_POST['idPatente3'];	
 $idSerie = $_POST['idSerie'];	     
 $idTarjeta = $_POST['idTarjeta'];	   
 $idSerie2= $_POST['idSerie2'];	   
 $idSerie3= $_POST['idSerie3'];	  
 $idSerie4= $_POST['idSerie4'];	
 $idSerie5= $_POST['idSerie5'];	
 $idSerie6= $_POST['idSerie6'];	
 $idSerie7= $_POST['idSerie7'];
 $idSerie8= $_POST['idSerie8'];
 $idModelo = $_POST['idModelo'];	     
 $idDescUnidad= $_POST['idDescUnidad'];	 
 $idDescUnidad2 = $_POST['idDescUnidad2'];
 $idFuncionario2  = $_POST['idFuncionario2']; 
 $idFuncionario3  = $_POST['idFuncionario3']; 
 $idRut2          = $_POST['idRut2'];         
 $idFuncionario4  = $_POST['idFuncionario4']; 
 $idRut3          = $_POST['idRut3'];         
 $idFuncionario5  = $_POST['idFuncionario5']; 
 $idFuncionario6  = $_POST['idFuncionario6']; 
 $idUnidad3       = $_POST['idUnidad3'];      
 $idFuncionario7  = $_POST['idFuncionario7']; 
 $idFuncionario8  = $_POST['idFuncionario8']; 
 $idFuncionario9  = $_POST['idFuncionario9']; 
 $idFuncionario10 = $_POST['idFuncionario10']; 
 $idFuncionario11 = $_POST['idFuncionario11']; 
 $idFolio2 = $_POST['idFolio2'];	
 $idBCU3 = $_POST['idBCU3'];	
 $idBCU4 = $_POST['idBCU4'];	
 $idBCU5 = $_POST['idBCU5'];
 $idBCU6 = $_POST['idBCU6'];
 $idBCU7 = $_POST['idBCU7'];
 $idBCU8 = $_POST['idBCU8'];
 
if($tipoMovimiento2==100){

//IDENTIFICADOR1
 if($idUnidad!="" and  $idFecha!=""){
 	$identificador1=$idUnidad;
  $identificador2= $idFecha;
  $etiqueta1="UNIDAD";
  $etiqueta2="FECHA";
  $tipoMovimiento=100;
}elseif($idUnidad!=""){
	$identificador1=$idUnidad;
  $identificador2= "NULL";
  $etiqueta1="UNIDAD";
  $etiqueta2="NULL";
  $tipoMovimiento=100;
}elseif($idFecha!="")	{
	$identificador1="NULL";
  $identificador2=$idFecha;
   $etiqueta1="NULL";
  $etiqueta2="FECHA";
  $tipoMovimiento=100;
}
//IDENTIFICADOR2
if($idUnidad2!="" and  $idServicio!=""){
 	$identificador1=$idUnidad2;
  $identificador2=$idServicio;
  $etiqueta1="UNIDAD";
  $etiqueta2="SERVICIO";
  $tipoMovimiento=100;
}elseif($idUnidad2!=""){
	$identificador1=$idUnidad2;
  $identificador2= "NULL";
  $etiqueta1="UNIDAD";
  $etiqueta2="NULL";
  $tipoMovimiento=100;
}elseif($idServicio!="")	{
	$identificador1="NULL";
  $identificador2=$idServicio;
  $etiqueta1="NULL";
  $etiqueta2="SERVICIO";
  $tipoMovimiento=100;
}
//IDENTIFICADOR3
if($idFuncionario!="" and  $idRut!=""){
 	$identificador1=$idFuncionario;
  $identificador2=$idRut;
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="RUT";
  $tipoMovimiento=100;
}elseif($idFuncionario!=""){
	$identificador1=$idFuncionario;
  $identificador2= "NULL";
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="NULL";
  $tipoMovimiento=100;
}elseif($idRut!="")	{
	$identificador1="NULL";
  $identificador2=$idRut;
  $etiqueta1="NULL";
  $etiqueta2="RUT";
  $tipoMovimiento=100;
}

//IDENTIFICADOR4
if($idFuncionario2!="" and  $idFecha2!=""){
 	$identificador1=$idFuncionario2;
  $identificador2=$idFecha2;
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="FECHA";
  $tipoMovimiento=100;
}elseif($idFuncionario2!=""){
	$identificador1=$idFuncionario2;
  $identificador2= "NULL";
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="NULL";
  $tipoMovimiento=100;
}elseif($idFecha2!="")	{
	$identificador1="NULL";
  $identificador2=$idFecha2;
  $etiqueta1="NULL";
  $etiqueta2="FECHA";
  $tipoMovimiento=100;
}

//IDENTIFICADOR5
if($idFuncionario3!="" and $idRut2!=""){
 	$identificador1=$idFuncionario3;
  $identificador2=$idRut2;
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="RUT";
  $tipoMovimiento=100;
}elseif($idFuncionario3!=""){
	$identificador1=$idFuncionario3;
  $identificador2= "NULL";
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="NULL";
  $tipoMovimiento=100;
}elseif($idRut2!="")	{
	$identificador1="NULL";
  $identificador2=$idRut2;
  $etiqueta1="NULL";
  $etiqueta2="RUT";
  $tipoMovimiento=100;
}


//IDENTIFICADOR6
if($idFuncionario4!="" and $idRut3!=""){
 	$identificador1=$idFuncionario4;
  $identificador2=$idRut3;
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="RUT";
  $tipoMovimiento=100;
}elseif($idFuncionario4!=""){
	$identificador1=$idFuncionario4;
  $identificador2= "NULL";
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="NULL";
  $tipoMovimiento=100;
}elseif($idRut3!="")	{
	$identificador1="NULL";
  $identificador2=$idRut3;
  $etiqueta1="NULL";
  $etiqueta2="RUT";
  $tipoMovimiento=100;
}

//IDENTIFICADOR7
if($idFuncionario5!="" and $idNombre!=""){
 	$identificador1=$idFuncionario5;
  $identificador2=$idNombre;
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="RUT";
  $tipoMovimiento=100;
}elseif($idFuncionario5!=""){
	$identificador1=$idFuncionario5;
  $identificador2= "NULL";
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="NULL";
  $tipoMovimiento=100;
}elseif($idNombre!="")	{
	$identificador1="NULL";
  $identificador2=$idNombre;
  $etiqueta1="NULL";
  $etiqueta2="RUT";
  $tipoMovimiento=100;
}

//IDENTIFICADOR8
if($idFuncionario6!="" and $idUnidad3!=""){
 	$identificador1=$idFuncionario6;
  $identificador2=$idUnidad3;
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="RUT";
  $tipoMovimiento=100;
}elseif($idFuncionario6!=""){
	$identificador1=$idFuncionario6;
  $identificador2= "NULL";
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="NULL";
  $tipoMovimiento=100;
}elseif($idUnidad3!="")	{
	$identificador1="NULL";
  $identificador2=$idUnidad3;
  $etiqueta1="NULL";
  $etiqueta2="RUT";
  $tipoMovimiento=100;
}

//IDENTIFICADOR9
if($idFuncionario7!="" and $idUsuario!=""){
 	$identificador1=$idFuncionario7;
  $identificador2=$idUsuario;
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="RUT";
  $tipoMovimiento=100;
}elseif($idFuncionario7!=""){
	$identificador1=$idFuncionario7;
  $identificador2= "NULL";
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="NULL";
  $tipoMovimiento=100;
}elseif($idUsuario!="")	{
	$identificador1="NULL";
  $identificador2= $idUsuario;
  $etiqueta1="NULL";
  $etiqueta2="RUT";
  $tipoMovimiento=100;
}

//IDENTIFICADOR10
if($idFuncionario8!="" and $idUsuario2!=""){
 	$identificador1=$idFuncionario8;
  $identificador2=$idUsuario2;
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="RUT";
  $tipoMovimiento=100;
}elseif($idFuncionario8!=""){
	$identificador1=$idFuncionario8;
  $identificador2= "NULL";
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="NULL";
  $tipoMovimiento=100;
}elseif($idUsuario2!="")	{
	$identificador1="NULL";
  $identificador2= $idUsuario2;
  $etiqueta1="NULL";
  $etiqueta2="RUT";
  $tipoMovimiento=100;
}

//IDENTIFICADOR11
if($idFuncionario9!="" and $idUsuario!=""){
 	$identificador1=$idFuncionario9;
  $identificador2=$idUsuario;
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="RUT";
  $tipoMovimiento=100;
}elseif($idFuncionario9!=""){
	$identificador1=$idFuncionario9;
  $identificador2= "NULL";
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="NULL";
  $tipoMovimiento=100;
}elseif($idUsuario!="")	{
	$identificador1="NULL";
  $identificador2= $idUsuario;
  $etiqueta1="NULL";
  $etiqueta2="RUT";
  $tipoMovimiento=100;
}

//IDENTIFICADOR12
if($idFuncionario10!="" and $idFolio!=""){
 	$identificador1=$idFuncionario10;
  $identificador2=$idFolio;
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="FOLIO";
  $tipoMovimiento=100;
}elseif($idFuncionario10!=""){
	$identificador1=$idFuncionario10;
  $identificador2= "NULL";
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="NULL";
  $tipoMovimiento=100;
}elseif($idFolio!="")	{
	$identificador1="NULL";
  $identificador2= $idFolio;
  $etiqueta1="NULL";
  $etiqueta2="FOLIO";
  $tipoMovimiento=100;
}

//IDENTIFICADOR13
if($idFuncionario11!="" and $idFolio2!=""){
 	$identificador1=$idFuncionario11;
  $identificador2=$idFolio2;
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="FOLIO";
  $tipoMovimiento=100;
}elseif($idFuncionario11!=""){
	$identificador1=$idFuncionario11;
  $identificador2= "NULL";
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="NULL";
  $tipoMovimiento=100;
}elseif($idFolio2!="")	{
	$identificador1="NULL";
  $identificador2= $idFolio2;
  $etiqueta1="NULL";
  $etiqueta2="FOLIO";
  $tipoMovimiento=100;
}

//IDENTIFICADOR14
if($idBCU!="" and $idTipoAnimal!=""){
 	$identificador1=$idBCU;
  $identificador2=$idTipoAnimal;
  $etiqueta1="BCU";
  $etiqueta2="ANIMAL";
  $tipoMovimiento=100;
}elseif($idBCU!=""){
	$identificador1=$idBCU;
  $identificador2= "NULL";
  $etiqueta1="BCU";
  $etiqueta2="NULL";
  $tipoMovimiento=100;
}elseif($idTipoAnimal!="")	{
	$identificador1="NULL";
  $identificador2= $idTipoAnimal;
  $etiqueta1="NULL";
  $etiqueta2="ANIMAL";
  $tipoMovimiento=100;
}

//IDENTIFICADOR15
if($idBCU2!="" and  $idFecha3!=""){
 	$identificador1=$idBCU2;
  $identificador2= $idFecha3;
  $etiqueta1="BCU";
  $etiqueta2="FECHA";
  $tipoMovimiento=100;
}elseif($idBCU!=""){
	$identificador1=$idBCU2;
  $identificador2= "NULL";
  $etiqueta1="BCU";
  $etiqueta2="NULL";
  $tipoMovimiento=100;
}elseif($idFecha3!="")	{
	$identificador1="NULL";
  $identificador2=  $idFecha3;
  $etiqueta1="NULL";
  $etiqueta2="FECHA";
  $tipoMovimiento=100;
} 

   


if($identificador1==""){ 
$identificador1="NULL";
$tipoMovimiento=100;
}

if($identificador2==""){ 
$identificador2="NULL";
$tipoMovimiento=100;
}

if($etiqueta1=="") $etiqueta1="NULL";
if($etiqueta2=="") $etiqueta2="NULL";


if($etiqueta1=="") $etiqueta1="";
if($etiqueta2=="") $etiqueta2="";

}else{
	//IDENTIFICADOR1
 if($idUnidad!="" and  $idFecha!=""){
 	$identificador1=$idUnidad;
  $identificador2= $idFecha;
  $etiqueta1="UNIDAD";
  $etiqueta2="FECHA";
  $tipoMovimiento=20;
  $respuesta=$observ;
}elseif($idUnidad!=""){
	$identificador1=$idUnidad;
  $identificador2= "NULL";
  $etiqueta1="UNIDAD";
  $etiqueta2="NULL";
  $tipoMovimiento=10;
}elseif($idFecha!="")	{
	$identificador1="NULL";
  $identificador2=$idFecha;
   $etiqueta1="NULL";
  $etiqueta2="FECHA";
  $tipoMovimiento=10;
}
//IDENTIFICADOR2
if($idUnidad2!="" and  $idServicio!=""){
 	$identificador1=$idUnidad2;
  $identificador2=$idServicio;
  $etiqueta1="UNIDAD";
  $etiqueta2="SERVICIO";
  $tipoMovimiento=20;
  $respuesta=$observ;
}elseif($idUnidad2!=""){
	$identificador1=$idUnidad2;
  $identificador2= "NULL";
  $etiqueta1="UNIDAD";
  $etiqueta2="NULL";
  $tipoMovimiento=10;
}elseif($idServicio!="")	{
	$identificador1="NULL";
  $identificador2=$idServicio;
  $etiqueta1="NULL";
  $etiqueta2="SERVICIO";
  $tipoMovimiento=10;
}
//IDENTIFICADOR3
if($idFuncionario!="" and  $idRut!=""){
 	$identificador1=$idFuncionario;
  $identificador2=$idRut;
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="RUT";
  $tipoMovimiento=20;
  $respuesta=$observ;
}elseif($idFuncionario!=""){
	$identificador1=$idFuncionario;
  $identificador2= "NULL";
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="NULL";
  $tipoMovimiento=10;
}elseif($idRut!="")	{
	$identificador1="NULL";
  $identificador2=$idRut;
  $etiqueta1="NULL";
  $etiqueta2="RUT";
  $tipoMovimiento=10;
}

//IDENTIFICADOR4
if($idFuncionario2!="" and  $idFecha2!=""){
 	$identificador1=$idFuncionario2;
  $identificador2=$idFecha2;
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="FECHA";
  $tipoMovimiento=20;
  $respuesta=$observ;
}elseif($idFuncionario2!=""){
	$identificador1=$idFuncionario2;
  $identificador2= "NULL";
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="NULL";
  $tipoMovimiento=10;
}elseif($idFecha2!="")	{
	$identificador1="NULL";
  $identificador2=$idFecha2;
  $etiqueta1="NULL";
  $etiqueta2="FECHA";
  $tipoMovimiento=10;
}

//IDENTIFICADOR5
if($idFuncionario3!="" and $idRut2!=""){
 	$identificador1=$idFuncionario3;
  $identificador2=$idRut2;
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="RUT";
  $tipoMovimiento=20;
  $respuesta=$observ;
}elseif($idFuncionario3!=""){
	$identificador1=$idFuncionario3;
  $identificador2= "NULL";
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="NULL";
  $tipoMovimiento=10;
}elseif($idRut2!="")	{
	$identificador1="NULL";
  $identificador2=$idRut2;
  $etiqueta1="NULL";
  $etiqueta2="RUT";
  $tipoMovimiento=10;
}


//IDENTIFICADOR6
if($idFuncionario4!="" and $idRut3!=""){
 	$identificador1=$idFuncionario4;
  $identificador2=$idRut3;
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="RUT";
  $tipoMovimiento=20;
  $respuesta=$observ;
}elseif($idFuncionario4!=""){
	$identificador1=$idFuncionario4;
  $identificador2= "NULL";
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="NULL";
  $tipoMovimiento=10;
}elseif($idRut3!="")	{
	$identificador1="NULL";
  $identificador2=$idRut3;
  $etiqueta1="NULL";
  $etiqueta2="RUT";
  $tipoMovimiento=10;
}

//IDENTIFICADOR7
if($idFuncionario5!="" and $idNombre!=""){
 	$identificador1=$idFuncionario5;
  $identificador2=$idNombre;
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="RUT";
  $tipoMovimiento=20;
  $respuesta=$observ;
}elseif($idFuncionario5!=""){
	$identificador1=$idFuncionario5;
  $identificador2= "NULL";
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="NULL";
  $tipoMovimiento=10;
}elseif($idNombre!="")	{
	$identificador1="NULL";
  $identificador2=$idNombre;
  $etiqueta1="NULL";
  $etiqueta2="RUT";
  $tipoMovimiento=10;
}

//IDENTIFICADOR8
if($idFuncionario6!="" and $idUnidad3!=""){
 	$identificador1=$idFuncionario6;
  $identificador2=$idUnidad3;
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="RUT";
  $tipoMovimiento=20;
  $respuesta=$observ;
}elseif($idFuncionario6!=""){
	$identificador1=$idFuncionario6;
  $identificador2= "NULL";
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="NULL";
  $tipoMovimiento=10;
}elseif($idUnidad3!="")	{
	$identificador1="NULL";
  $identificador2=$idUnidad3;
  $etiqueta1="NULL";
  $etiqueta2="RUT";
  $tipoMovimiento=10;
}

//IDENTIFICADOR9
if($idFuncionario7!="" and $idUsuario!=""){
 	$identificador1=$idFuncionario7;
  $identificador2=$idUsuario;
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="RUT";
  $tipoMovimiento=20;
  $respuesta=$observ;
}elseif($idFuncionario7!=""){
	$identificador1=$idFuncionario7;
  $identificador2= "NULL";
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="NULL";
  $tipoMovimiento=10;
}elseif($idUsuario!="")	{
	$identificador1="NULL";
  $identificador2= $idUsuario;
  $etiqueta1="NULL";
  $etiqueta2="RUT";
  $tipoMovimiento=10;
}

//IDENTIFICADOR10
if($idFuncionario8!="" and $idUsuario2!=""){
 	$identificador1=$idFuncionario8;
  $identificador2=$idUsuario2;
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="RUT";
  $tipoMovimiento=20;
  $respuesta=$observ;
}elseif($idFuncionario8!=""){
	$identificador1=$idFuncionario8;
  $identificador2= "NULL";
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="NULL";
  $tipoMovimiento=10;
}elseif($idUsuario2!="")	{
	$identificador1="NULL";
  $identificador2= $idUsuario2;
  $etiqueta1="NULL";
  $etiqueta2="RUT";
  $tipoMovimiento=10;
}

//IDENTIFICADOR11
if($idFuncionario9!="" and $idUsuario!=""){
 	$identificador1=$idFuncionario9;
  $identificador2=$idUsuario;
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="RUT";
  $tipoMovimiento=20;
}elseif($idFuncionario9!=""){
	$identificador1=$idFuncionario9;
  $identificador2= "NULL";
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="NULL";
  $tipoMovimiento=10;
}elseif($idUsuario!="")	{
	$identificador1="NULL";
  $identificador2= $idUsuario;
  $etiqueta1="NULL";
  $etiqueta2="RUT";
  $tipoMovimiento=10;
}

//IDENTIFICADOR12
if($idFuncionario10!="" and $idFolio!=""){
 	$identificador1=$idFuncionario10;
  $identificador2=$idFolio;
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="FOLIO";
  $tipoMovimiento=20;
  $respuesta=$observ;
}elseif($idFuncionario10!=""){
	$identificador1=$idFuncionario10;
  $identificador2= "NULL";
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="NULL";
  $tipoMovimiento=10;
}elseif($idFolio!="")	{
	$identificador1="NULL";
  $identificador2= $idFolio;
  $etiqueta1="NULL";
  $etiqueta2="FOLIO";
  $tipoMovimiento=10;
}

//IDENTIFICADOR13
if($idFuncionario11!="" and $idFolio2!=""){
 	$identificador1=$idFuncionario11;
  $identificador2=$idFolio2;
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="FOLIO";
  $tipoMovimiento=20;
  $respuesta=$observ;
}elseif($idFuncionario11!=""){
	$identificador1=$idFuncionario11;
  $identificador2= "NULL";
  $etiqueta1="FUNCIONARIO";
  $etiqueta2="NULL";
  $tipoMovimiento=10;
}elseif($idFolio2!="")	{
	$identificador1="NULL";
  $identificador2= $idFolio2;
  $etiqueta1="NULL";
  $etiqueta2="FOLIO";
  $tipoMovimiento=10;
}

//IDENTIFICADOR14
if($idBCU!="" and $idTipoAnimal!=""){
 	$identificador1=$idBCU;
  $identificador2=$idTipoAnimal;
  $etiqueta1="BCU";
  $etiqueta2="ANIMAL";
  $tipoMovimiento=20;
  $respuesta=$observ;
}elseif($idBCU!=""){
	$identificador1=$idBCU;
  $identificador2= "NULL";
  $etiqueta1="BCU";
  $etiqueta2="NULL";
  $tipoMovimiento=10;
}elseif($idTipoAnimal!="")	{
	$identificador1="NULL";
  $identificador2= $idTipoAnimal;
  $etiqueta1="NULL";
  $etiqueta2="ANIMAL";
  $tipoMovimiento=10;
}

//IDENTIFICADOR15
if($idBCU2!="" and  $idFecha3!=""){
 	$identificador1=$idBCU2;
  $identificador2= $idFecha3;
  $etiqueta1="BCU";
  $etiqueta2="FECHA";
  $tipoMovimiento=20;
  $respuesta=$observ;
}elseif($idBCU!=""){
	$identificador1=$idBCU2;
  $identificador2= "NULL";
  $etiqueta1="BCU";
  $etiqueta2="NULL";
  $tipoMovimiento=10;
}elseif($idFecha3!="")	{
	$identificador1="NULL";
  $identificador2=  $idFecha3;
  $etiqueta1="NULL";
  $etiqueta2="FECHA";
  $tipoMovimiento=10;
} 

   


if($identificador1==""){ 
$identificador1="NULL";
$tipoMovimiento=10;
}

if($identificador2==""){ 
$identificador2="NULL";
$tipoMovimiento=10;
}

if($etiqueta1=="") $etiqueta1="NULL";
if($etiqueta2=="") $etiqueta2="NULL";


if($etiqueta1=="") $etiqueta1="";
if($etiqueta2=="") $etiqueta2="";
}


	

	
	$vehiculo = new requerimiento;
	$vehiculo->setCodigoSolicitud($codigo);
	$vehiculo->setObservacion($observ);
	$vehiculo->setIdentificador1($identificador1);
	$vehiculo->setIdentificador2($identificador2);
	$vehiculo->setEtiqueta1($etiqueta1);
	$vehiculo->setEtiqueta2($etiqueta2);
	$vehiculo->setTipoMovimiento($tipoMovimiento);
	$vehiculo->setFechaMovimiento($fecha2);
	$vehiculo->setFuncionario($codigoUsuario);
	$vehiculo->setTextoMovimiento($respuesta);


	
	$objDBVehiculos = new dbRequerimiento;
	$resultado = $objDBVehiculos->updateSolicitud($vehiculo);

    //$vehiculo->setCodigoSolicitud($idNuevo);	
	
	if ($fecha2 != ""){
		$fechaPaso 		= explode("-",$fecha2);
   	$fechaIngresar2  = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
   	$resultado = $objDBVehiculos->updateEstadoSolicitud($vehiculo, $fechaIngresar2);
		$resultado = $objDBVehiculos->insertMovimiento($vehiculo, $fechaIngresar2);
	}
	
	
	//if ($fechaNuevoEstado != ""){
	//	$fechaPaso 		= explode("-",$fechaNuevoEstado);
  // 		$fechaIngresar  = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	//	$resultado = $objDBVehiculos->updateEstadoAnimal($vehiculo, $fechaIngresar);
	//	$resultado = $objDBVehiculos->insertEstadoAnimal($vehiculo, $fechaIngresar);
	//}elseif($fechaNuevoEstado == "" && $verificaOculto == "NO"){
	//	$resultado = $objDBVehiculos->updateAnimal($vehiculo);
	//}			
			
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
 ?>