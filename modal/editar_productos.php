	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar vehículo</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_producto" name="editar_producto">
			<div id="resultados_ajax2"></div>
                
			  <div class="form-group">
				<label for="mod_placa" class="col-sm-3 control-label">Placa</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control upperCase" id="mod_placa" name="mod_placa" placeholder="Placa del vehículo" required>
					<input type="hidden" name="mod_id" id="mod_id">
				</div>
			  </div>
                
			   <div class="form-group">
				<label for="mod_marca" class="col-sm-3 control-label">Marca</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control upperCase" id="mod_marca" name="mod_marca" placeholder="Marca del vehículo" required>
				</div>
			  </div>
                
                <div class="form-group">
				<label for="mod_modelo" class="col-sm-3 control-label">Modelo</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control upperCase" id="mod_modelo" name="mod_modelo" placeholder="Modelo del vehículo" required>
				</div>
			  </div>
                
                <div class="form-group">
				<label for="mod_tipo" class="col-sm-3 control-label">Tipo</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control upperCase" id="mod_tipo" name="mod_tipo" placeholder="Modelo del vehículo" required>
				</div>
			  </div>
			  
                <div class="form-group">
				<label for="mod_soat" class="col-sm-3 control-label">Soat</label>
				<div class="col-sm-8">
				  <input type="date" class="form-control" id="mod_soat" name="mod_soat"  required>
				</div>
			  </div>
                
                <div class="form-group">
				<label for="mod_tecnicomecanico" class="col-sm-3 control-label">Tecnicomecánico</label>
				<div class="col-sm-8">
				  <input type="date" class="form-control" id="mod_tecnicomecanico" name="mod_tecnicomecanico" required>
				</div>
			  </div>
                
                <div class="form-group">
				<label for="mod_observaciones" class="col-sm-3 control-label">Observaciones</label>
				<div class="col-sm-8">
				  <textarea class="form-control upperCase" id="mod_observaciones" name="mod_observaciones" placeholder="Observaciones del vehículo" required></textarea>
				</div>
			  </div>
			 
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-warning" id="actualizar_datos">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>