<?php 
require 'ControladoresBD.php';
	//Getting the page number which is to be displayed  
	$page = $_GET['page'];	
	
	//Initially we show the data from 1st row that means the 0th row 
	$start = 0; 
	
	//Limit is 3 that means we will show 3 items at once
	$limit = 3; 
	
	//Importing the database connection 
	require_once('mysql_login.php');

	//Counting the total item available in the database 
	$total = mysqli_num_rows(mysqli_query($con, "SELECT id from noticias "));
	
	//We can go atmost to page number total/limit
	$page_limit = $total/$limit; 

	//If the page number is more than the limit we cannot show anything 
	if($page<=$page_limit){
		
		//Calculating start for every given page number 
		$start = ($page - 1) * $limit; 
//	print "start= ".$start." limit= ".$limit;
		
		//SQL query to fetch data of a range 
		$sql = "SELECT * from noticias order by fecha_hora desc limit $start, $limit";

		//Getting result 
		$result = mysqli_query($con,$sql); 
		
		//Adding results to an array 
		$res = array(); 

		while($row = mysqli_fetch_array($result)){
			array_push($res, array(
				"img_url"=>$row['img_url'],
				"fecha_hora"=>Controlador::calcularFechaPublicacion($row['fecha_hora']),
				"tipo"=>$row['tipo'],
				"descripcion"=>$row['descripcion'])
				);
		}
		//Displaying the array in json format 
		echo json_encode($res);
	}else{
		if($total > 0){

		$start = ($page - 1) * $limit;
		$limit = $total - $start;
//		print "start= ".$start." limit= ".$limit;
			if($start <> $limit){
				//SQL query to fetch data of a range
        		        $sql = "SELECT * from noticias order by fecha_hora desc limit $start, $total";

        	        	//Getting result
		                $result = mysqli_query($con,$sql);

        	        	//Adding results to an array
                		$res = array();

		                while($row = mysqli_fetch_array($result)){
	        	                array_push($res, array(
                	                	"img_url"=>$row['img_url'],
                    	    		        "fecha_hora"=>Controlador::calcularFechaPublicacion($row['fecha_hora']),
                        	        	"tipo"=>$row['tipo'],
	        	                        "descripcion"=>$row['descripcion'])
        		                        );
	                	}
	                	//Displaying the array in json format
				if($res){
        		        	echo json_encode($res);
				}else{
			//		echo "over";
				}
			}else{
			//	echo "over";
			}
		}else{
			//echo "over";
		}
    }
