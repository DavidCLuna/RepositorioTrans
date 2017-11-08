<?php
	/*-------------------------
	Autores: David Casadiegos & Samuel Sanchez
	Mail: david.2818@outlook.com
	---------------------------*/

	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	
	$active_facturas="active";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$title="Verificar | Coagrotransporte";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("head.php");?>
          
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="libraries/granim/dist/granim.js"></script>
      <script src="libraries/granim/dist/granim.min.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <link rel="stylesheet" href="libraries/dropzone.css">
      
      <script src="libraries/dropzone.js"></script>
      <script type="text/javascript" src="js/cargarPaginas.js"></script>
  </head>
    
  <body class="home">
	<?php
	include("navbar.php");
	?>  
      
    <div class="container">
		<div class="panel panel-info">
		<div class="panel-heading">
		    <!--<div class="btn-group pull-right">
				<a  href="nueva_factura.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Nueva Factura</a>
			</div>-->
			<h4><i class='glyphicon glyphicon-search'></i> Verificar Transportador</h4>
		</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Consulta Transportador</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Digite el nombre o # de cédula del transportador" onkeyup='load(1);'>
							</div>
														
							<div class="col-md-3">
								<button type="button" class="btn btn-default" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>
							
						</div>
                    
                    <div id="resultados"></div><!-- Carga los datos ajax -->
				    <div class='outer_div'></div><!-- Carga los datos ajax -->
			</form>
				
			</div>
            
		</div>	
		
	</div>
      <canvas id="canvas-radial"></canvas>
      
      <div class="container">
          
  <!-- Modal -->  
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Consulta Transportador</h4>
        </div>
        <div class="modal-body">
          <p>Debes verificar cada uno de las páginas que se han abierto, después clickear en 'Aprobar Transporte' si es el caso o 'No aprobar Transporte' sino cumple con los requisitos.<br/>
              Si das clic en 'No aprobar transporte' tienes la posbilidad de digitar una observación.<br/>
          Antes de cargar los archivos verifica bien si son correctos, ya que esta acción no se podrá restablecer.</p>
           
            <hr>
               <!-- <ul class="list-group">
                    <li class="list-group-item">
                        Estado RUNT
                        <div class="material-switch pull-right">
                            <input type="checkbox" id="checkboxRUNTConsulta" name="checkboxRuntConsulta" checked />
                        </div>
                    </li>
                    <li class="list-group-item">
                        Estado SIMIT
                        <div class="material-switch pull-right">
                            <input type="checkbox" id="checkboxSIMITConsulta" name="checkboxSIMITConsulta" checked/>
                        </div>
                    </li>
                    <li class="list-group-item">
                        Estado Procuraduría
                        <div class="material-switch pull-right">
                            <input type="checkbox" id="checkboxPROCURADURIAConsulta" name="checkboxPROCURADURIAConsulta" checked/>
                        </div>
                    </li>
                    <li class="list-group-item">
                        Estado Contraloría
                        <div class="helper pull-right">
                            <input type="checkbox" id="checkboxCONTRALORIAConsulta" name="checkboxCONTRALORIAConsulta" checked/>
                        </div>
                    </li>
                </ul>
            -->
          
          </div>
          <h4 class="text-center">Da clic o arrastra y suelta tus archivos<h4>
            <!--<div class="padding-10">
              <form action="upload.php" id = "divUploadDocuments" class="dropzone db">    
            </div>-->

          <form action="upload.php" class="dropzone padding-15">
            <div class="fallback">
              <input name="file" type="file" id="fm-dropzone" multiple />
            </div>
          </form>
          
            <div class="form-group">
                <button id="btnNoAprobar" type="button" class="btn btn-danger btn-lg" style="margin: 5px;" data-toggle="modal" data-target="#modalObservaciones">No aprobar Transporte</button>
                <button id="btnAprobar" type="button" class="btn btn-success btn-lg">Aprobar Transporte</button>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
      </div>
    </div>
  </div>
     
        
        
        <!-- Modal -->  
  <div class="modal fade" id="modalObservaciones" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Consulta Transportador</h4>
        </div>
        <div class="modal-body">

        <form action="" method="">
            <div class="form-group">
                <div class="form-group">
                    <label for="comment">Observaciones:</label>
                    <textarea class="form-control" rows="3" id="comment"></textarea>
                </div>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-default text-right" data-dismiss="modal">Guardar y enviar <span class="glyphicon glyphicon-ok" ></span></button>
            </div>

        </form>
      </div>
    </div>
  </div>
        
</div>
      
      <style>
        #divConsultaPagina{
            margin-bottom: 10px;
        }
      </style>
	<hr>

	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/facturas.js"></script>
      
  </body>
</html>