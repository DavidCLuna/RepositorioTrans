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
		$id_producto=intval($_GET['id']);
		$query=mysqli_query($con, "select * from detalle_cotizacion_demo where id_producto='".$id_producto."'");
		$count=mysqli_num_rows($query);
		if ($count==0){
			if ($delete1=mysqli_query($con,"DELETE FROM products WHERE id_producto='".$id_producto."'")){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
			<?php
			
		}
			
		} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se pudo eliminar éste  producto. Existen cotizaciones vinculadas a éste producto. 
			</div>
			<?php
		}
		
		
		
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('placa_vehiculo');//Columnas de busqueda
		 $sTable = "vehiculos";
		 $sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by placa_vehiculo desc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './productos.php';
		//main query to fetch the data
		$sql="SELECT placa_vehiculo, marca_vehiculo,modelo_vehiculo,tipo_vehiculo,soat_vehiculo,tecnicomecanico_vehiculo,observaciones_vehiculo,fecha_creacion_vehiculo,TIMESTAMPDIFF(YEAR, soat_vehiculo, CURDATE()) as estado_soat FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table" >
				<tr  class="success text-center">
					<th class="text-center">Placa</th>
					<th class="text-center">Marca</th>
					<th class="text-center">Modelo</th>
                    <th class="text-center">Tipo</th>
                    <th class="text-center">SOAT</th>
                    <th class="text-center">Tecnicomecánico</th>
                    <th class="text-center">observaciones</th>
					<th class='text-right'>Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$placa_vehiculo=$row['placa_vehiculo'];
						$marca_vehiculo=$row['marca_vehiculo'];
						$modelo_vehiculo=$row['modelo_vehiculo'];
						$tipo_vehiculo=$row['tipo_vehiculo'];
                        $soat_vehiculo=$row['soat_vehiculo'];
                        $tecnicomecanico_vehiculo=$row['tecnicomecanico_vehiculo'];
                        $observaciones_vehiculo=$row['observaciones_vehiculo'];
                       
                        $estado_soat=$row['estado_soat'];
						if ($estado_soat=="1"){
                            $class="danger";
                        }
						else {$class="";}
					?>
					
					<input type="hidden" value="<?php echo $placa_vehiculo;?>" id="placa_vehiculo<?php echo $placa_vehiculo;?>">
					<input type="hidden" value="<?php echo $marca_vehiculo;?>" id="marca_vehiculo<?php echo $placa_vehiculo;?>">
                    <input type="hidden" value="<?php echo $modelo_vehiculo;?>" id="modelo_vehiculo<?php echo $placa_vehiculo;?>">
                    <input type="hidden" value="<?php echo $tipo_vehiculo;?>" id="tipo_vehiculo<?php echo $placa_vehiculo;?>">
                    <input type="hidden" value="<?php echo $soat_vehiculo;?>" id="soat_vehiculo<?php echo $placa_vehiculo;?>">
                    <input type="hidden" value="<?php echo $tecnicomecanico_vehiculo;?>" id="tecnicomecanico_vehiculo<?php echo $placa_vehiculo;?>">
                    <input type="hidden" value="<?php echo $observaciones_vehiculo;?>" id="observaciones_vehiculo<?php echo $placa_vehiculo;?>">
                  
                  
					<input type="hidden" value="<?php echo $modelo_vehiculo;?>" id="estado<?php echo $id_producto;?>">
					<input type="hidden" value="<?php echo number_format($precio_producto,2,'.','');?>" id="precio_producto<?php echo $id_producto;?>">
					<tr class="<?php  $class; ?> text-center" >
						<td><?php echo $placa_vehiculo; ?></td>
						<td ><?php echo $marca_vehiculo; ?></td>
                        <td ><?php echo $modelo_vehiculo; ?></td>
                        <td ><?php echo $tipo_vehiculo; ?></td>
                        <td><?php echo $soat_vehiculo; ?></td>
                        <td ><?php echo $tecnicomecanico_vehiculo; ?></td>
                        <td ><?php echo $observaciones_vehiculo; ?></td>
					<td ><span class="pull-right">
					<a href="#" class='btn btn-default' title='Editar producto' onclick="obtener_datos('<?php echo $id_producto;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> 
					<a href="#" class='btn btn-default' title='Borrar producto' onclick="eliminar('<?php echo $id_producto; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=6><span class="pull-right"><?
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>