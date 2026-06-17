<!DOCTYPE html>
<html lang="en">
<head>
  <title>EDICIÓN DE FUNCIONARIOS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script type="" src="assets/js/main.js"></script>
</head>
<? //require_once('dbcon.php');?>
<body>
<div class="container">
<br>
<div class="card">
  <div class="card-header">
    REGISTRO  Y EDITOR DE FUNCIONARIOS
  </div>
  <div class="card-body">

 <form class="form-horizontal" id="clienteForm">
  	<div class="form-group row">
      <label class="control-label col-sm-2" for="codigo">Codigo:</label>
      <div class="col-sm-10">          
        <input type="text" name="codigo" class="form-control" id="codigo" placeholder="Ingrese codigo">
      </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-sm-2" for="rut">Rut:</label>
      <div class="col-sm-10">
        <input type="rut" class="form-control" id="rut" placeholder="Ingrese rut" name="rut">
      </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-sm-2" for="escalafon">escalafon:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="escalafon" placeholder="Ingrese escalafon" name="escalafon">
      </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-sm-2" for="grado">Grado:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="grado" placeholder="Ingrese grado" name="grado">
      </div>
    </div>
    <div class="form-group row">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary" id="registro">Registrar cliente</button>
      </div>
    </div>
  </form>

  </div>
</div>
 

  <div id="tableData">
  		
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title" id="exampleModalLabel"><b>Editar funcionario</b></h2>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div id="editarForm"> 
               
            </div>
          </div>
      </div>
  </div> 
</div>

</body>
</html>