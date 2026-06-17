<link href="./css/Modal.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<script>
/*------------------------------------------------------------------------------*/
/*---- Barra de progreso y boton ---*/
function habilitarBotonCerrar(element){
	element.style.display = 'block';
}

function move(time,myBar,element){
	if(time==0){
		habilitarBotonCerrar(element);
		return;
	}
	var elem = myBar;
	var width = 1;
	var id = setInterval(frame, time);
	function frame() {
		if (width < 100) {
			width++;
			elem.style.width = width + "%";
		} else {
			clearInterval(id);
			habilitarBotonCerrar(element);
		}
	}
}
/*------------------------------------------------------------------------------*/
/*---- Paginacion de Mensajes, boton anterior y siguiente ---*/
function anterior(n){
	page[n].style.display = 'none';
	page[n-1].style.display = '';
}

function siguiente(n){
	page[n].style.display = 'none';
	page[n+1].style.display = '';
}

/*-------------------------------------------------------------------------*/
</script>
<?
require_once("./inc/configV4.inc.php");
require_once("./baseDatos/Conexion.class.php");
require_once("./baseDatos/dbMensaje.class.php");
require_once("./objetos/mensaje.class.php");

$objDBMensajes = new dbMensaje;
$objDBMensajes->mensajesActuales(&$mensajes);

for ($i=0; $i<count($mensajes); $i++){
	$titulo		= $mensajes[$i]->getTitulo();
	$contenido	= $mensajes[$i]->getContenido();
	$tiempo		= $mensajes[$i]->getTiempo();
	$habilitado	= $mensajes[$i]->buscarUnidad($_SESSION['USUARIO_CODIGOUNIDAD_ORIGEN']);
	$unidades	= $mensajes[$i]->getUnidades();
	
	if($_SESSION['USUARIO_CODIGOFUNCIONARIO_ORIGEN']=='007174T') $habilitado = TRUE;
	
	if($habilitado&&$_GET['login']){
		echo "<div class='modal-wrapper' id='popup{$i}'>
				<div class='popup-contenedor-min' >
					<div class='popup-header' ><div class='popup-header-text'>{$titulo}</div><div id='myProgress' class='myProgres'><div id='myBar{$i}' class='myBar'></div></div></div>
					<div id='contenido'><br>{$contenido}</div>
					<a id='botonCerrarMensaje{$i}' class='popup-cerrar' onclick='document.getElementById(\"popup{$i}\").className=\"modal-wrapper\";'>X</a>
				</div>
			</div>
			<script>
				document.getElementById(\"popup{$i}\").className=\"modal-wrapperTarget\";
				document.getElementById(\"botonCerrarMensaje{$i}\").style.display = 'none';
				move({$tiempo},myBar{$i},botonCerrarMensaje{$i});
			</script>";
	}
}
?>