	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="nuevoCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo conductor</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_cliente" name="guardar_cliente">
			<div id="resultados_ajax"></div>
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Cédula</label>
				<div class="col-sm-8">
				  <input type="number" class="form-control" id="cedula" name="cedula" required>
				</div>
			  </div>
                <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombre" name="nombre" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="apellido" class="col-sm-3 control-label">Apellido</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="apellido" name="apellido" >
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="licencia" class="col-sm-3 control-label">Número Licencia</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="licencia" name="licencia" >
				  
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="fecha_ingreso" class="col-sm-3 control-label">Fecha Ingreso</label>
				<div class="col-sm-8">
					<input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" >
				</div>
			  </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-warning" id="guardar_datos">Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>