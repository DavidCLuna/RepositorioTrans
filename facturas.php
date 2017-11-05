<?php
	/*-------------------------
	Autor: INNOVAWEBSV
	Web: www.innovawebsv.com
	Mail: info@innovawebsv.com
	---------------------------*/


/*
--------------------------------
https://consulta.simit.org.co/Simit/verificar/contenido_verificar_pago_linea.jsp
 
https://www.runt.com.co/consultaCiudadana/#/consultaPersona
 
https://www.procuraduria.gov.co/CertWEB/Certificado.aspx?tpo=2
 
http://cfiscal.contraloria.gov.co/siborinternet/certificados/certificadosPersonaNatural.asp
--------------------------------
*/

	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	
	$active_facturas="active";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$title="Facturas | Simple Invoice";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("head.php");?>
          <script type="text/javascript" src="js/cargarPaginas.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<script src="libraries/dropzone.js"></script>
<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">-->
<script src="libraries/ToogleButton/dist/js/bootstrap-checkbox.min.js" defer></script>
      
  </head>
  <body>
	<?php
	include("navbar.php");
	?>  
    <div class="container">
		<div class="panel panel-info">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<a  href="nueva_factura.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Nueva Factura</a>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Verificar Transportador</h4>
		</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Consulta Transportador</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Digite el nombre del transportador" onkeyup='load(1);'>
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
          <p>Debes verificar cada uno de las páginas que se han abierto, después clickear en 'Aprobar Transporte' si es el caso o 'No aprobar Transporte' sino cumple con los requisitos.</p>
           
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
            <div class="dz-preview dz-file-preview">
  <div class="dz-details">
    <div class="dz-filename"><span data-dz-name></span></div>
    <div class="dz-size" data-dz-size></div>
    <img data-dz-thumbnail />
  </div>
  <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
  <div class="dz-success-mark"><span>✔</span></div>
  <div class="dz-error-mark"><span>✘</span></div>
  <div class="dz-error-message"><span data-dz-errormessage></span></div>
</div>
            
</div>
            
        </div>
          <div class="form-group">
           <button id="btnNoAprobar" type="button" class="btn btn-danger">No aprobar Transporte</button>
            <button id="btnAprobar" type="button" class="btn btn-success">Aprobar Transporte</button>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
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
      
          <script>
    $(function() {

        $('input[type="checkbox"]').checkboxpicker({

        // OPTIONS

        });

    });
              
              // Dropzone class:
var myDropzone = new Dropzone("div#myId", { url: "/file/post"});
              
    </script>
    <style>
        style: false,

defaultClass: 'btn-default',

disabledCursor: 'not-allowed',

offClass: 'btn-danger',

onClass: 'btn-success',

offLabel: 'No',

onLabel: 'Yes',

offTitle: false,

onTitle: false,


// Event key codes:

// 13: Return

// 32: Spacebar

toggleKeyCodes: [13, 32],

 

warningMessage: 'Please do not use Bootstrap-checkbox element in label element.'
    </style>
	<?php
	include("footer.php");
	?>
      <script>
      $(':checkbox').checkboxpicker();
      </script>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/facturas.js"></script>
      
  </body>
</html>