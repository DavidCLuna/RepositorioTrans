<?php

	/*-------------------------
	Autor: David Casadiegos
	---------------------------*/
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

    if (isset($_POST['cedula']) && isset($_POST['placa'])){
        
            $cedula_conductor = mysqli_real_escape_string($con,(strip_tags($_POST['cedula'], ENT_QUOTES)));
            $placa_vehiculo = mysqli_real_escape_string($con,(strip_tags($_POST['placa'], ENT_QUOTES)));
        
            $query=mysqli_query($con, "select * from conductores where cedula_conductor ='".$cedula_conductor."'");
            $rw_user=mysqli_fetch_array($query);
            $count=$count=mysqli_num_rows($query);
        
            if ($count>=1){
                $query=mysqli_query($con, "select * from vehiculos where placa_vehiculo ='".$placa_vehiculo."'");
                $rw_user=mysqli_fetch_array($query);
                $count=$count=mysqli_num_rows($query);
        
                if ($count>=1){

                    if ($count>=1){
                        $query=mysqli_query($con, "select * from conductores_vehiculos where cedula_conductor ='".$cedula_conductor."' and placa_vehiculo ='".$placa_vehiculo."'");
                        $rw_user=mysqli_fetch_array($query);
                        $count=$count=mysqli_num_rows($query);

                        if ($delete1=mysqli_query($con,"INSERT INTO conductores_vehiculos(cedula_conductor, placa_vehiculo) FROM conductores_vehiculos WHERE cedula_conductor='".$cedula_conductor."' and placa_vehiculo='".$placa_vehiculo."'")){
                            ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <strong>Aviso!</strong> Se ha vinculado en vehículo exitosamente.
                            </div>
                            <?php 
                        }else {
                            ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <strong>Error!</strong> Ocurrió un error al vincular el vehiculo
                            </div>
                            <?php
                        }
                    } else {
                    ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Error!</strong> Ocurrió un error, este vehículo ya se encuentra vinculado 
                    </div>
                    <?php
                }
                } else {
                    ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Error!</strong> Ocurrió un error, la placa no se encuentra registrada 
                    </div>
                    <?php
                }

            } else {
                ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Error!</strong> Ocurrió un error, la cédula no se encuentra registrada 
                </div>
                <?php
            }
        }

	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
        
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
		$reload = './registrar_cargues.php';
		//main query to fetch the data
		$sql="select vehi.* from vehiculos vehi join conductores_vehiculos con_vehi on vehi.placa_vehiculo=con_vehi.placa_vehiculo where con_vehi.cedula_conductor= '".$cedula_conductor."' order by placa_vehiculo";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			echo mysqli_error($con);
			?>
			<div class="table-responsive">
			  <table class="table">
				<thead>
                    <tr  class="">
                        <th class="text-center">Placa</th>
                        <th class="text-center">Marca</th>
                        <th class="text-center">Modelo</th>
                        <th class="text-center">Tipo</th>
                        <th class="text-center">SOAT</th>
                        <th class="text-center">Tecnicomecánico</th>
                        <th class="text-center">Observaciones</th>
                        <th class="text-center">Seleccionar</th>
                    </tr>
                </thead>
              <input type="hidden" id="cedula_cliente" name="cedula_cliente" value="<?php echo $cedula_conductor;?>">
                <tbody>
				<?php
				while ($row=mysqli_fetch_array($query)){
					$placa_vehiculo = $rw['placa_vehiculo'];
                    $marca_vehiculo = $rw['marca_vehiculo'];
                    $modelo_vehiculo = $rw['modelo_vehiculo'];
                    $tipo_vehiculo = $rw['tipo_vehiculo'];
                    $soat_vehiculo = $rw['soat_vehiculo'];
                    $tecnicomecanico_vehiculo = $rw['tecnicomecanico_vehiculo'];
                    $observaciones_vehiculo = $rw['observaciones_vehiculo'];

                    ?>
                    <tr>
                        <td class="text-center"><?php echo $placa_vehiculo ?></td>
                        <td class="text-center"><?php echo $marca_vehiculo ?></td>
                        <td class="text-center"><?php echo $modelo_vehiculo ?></td>
                        <td class="text-center"><?php echo $tipo_vehiculo ?></td>
                        <td class="text-center"><?php echo $soat_vehiculo ?></td>
                        <td class="text-center"><?php echo $tecnicomecanico_vehiculo ?></td>
                        <td class="text-center"><?php echo $observaciones_vehiculo ?></td>
                        <td class="text-center"><input type="checkbox"></td>
                    </tr>
					<?php
				}
				?>
                  </tbody>
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