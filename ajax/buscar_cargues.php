<?php

	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$numero_factura=intval($_GET['id']);
		$del1="delete from facturas where numero_factura='".$numero_factura."'";
		$del2="delete from detalle_factura where numero_factura='".$numero_factura."'";
		if ($delete1=mysqli_query($con,$del1) and $delete2=mysqli_query($con,$del2)){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se puedo eliminar los datos
			</div>
			<?php
			
		}
	}

	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		  
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:3;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		//$row= mysqli_fetch_array($count_query);
		$numrows = "11";
		$total_pages = ceil($numrows/$per_page);
		$reload = './cargues.php';
		//main query to fetch the data
		$sql="call procedure_cargues($q,$offset,$per_page)";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			echo mysqli_error($con);
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="info">
					<th class="text-center"># Factura</th>
					<th class="text-center">Cédula</th>
                    <th class="text-center">Nombre Completo</th>
                    <th class="text-center">Placa</th>
					<th class="text-center">Estado</th>
                    <th class="text-center">Modificación</th>
					<th class="text-center">Consultar</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_factura_cargue=$row['id_factura_cargue'];
						
                        $cedula_conductor=$row['cedula_conductor'];
                    
                        $nombre_completo_conductor=$row['nombre_conductor']." ".$row['apellido_conductor'];
						$placa_vehiculo=$row['placa_vehiculo'];
					
                    $estado_cargue=$row['estado_cargue'];
                    
                    $fecha_hora_cargue=date("d/m/Y H/m/s", strtotime($row['fecha_hora_cargue']));
						
					?>
					<tr>
						<td class="text-center"><?php echo $id_factura_cargue; ?></td>
						<td class="text-center"><?php echo $cedula_conductor; ?></td>
						<td class="text-center"><?php echo $nombre_completo_conductor; ?></td>
                        <td class="text-center"><?php echo $placa_vehiculo; ?></td>
                        <td class="text-center"><?php echo $estado_cargue; ?></td>
                        <td class="text-center"><?php echo $fecha_hora_cargue; ?></td>
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=7><span class="pull-right"><?
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>