    $(document).ready(function(){
        load(1);
        $("#cedula").keypress(function(){
    		
            soloNumeros($("#cedula").val());
	   });
    });



		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/buscar_conductores.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}

	
		
			function eliminar (id)
		{
			var q= $("#q").val();
		if (confirm("Realmente deseas eliminar el conductor")){	
		$.ajax({
        type: "GET",
        url: "./ajax/buscar_conductores.php",
        data: "id="+id,"q":q,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		load(1);
		}
			});
		}
            
		}
		
		
	
$( "#guardar_cliente" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_conductor.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('#guardar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

$( "#editar_cliente" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_conductor.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax2").html(datos);
			$('#actualizar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

	function obtener_datos(id){
			var nombre_conductor = $("#nombre_conductor"+id).val();
			var apellido_conductor = $("#apellido_conductor"+id).val();
			var licencia_conductor = $("#licencia_conductor"+id).val();
			var fecha_ingreso_conductor_str = $("#fecha_ingreso_conductor"+id).val();
        
            var parts = fecha_ingreso_conductor_str.split('/');
        
            var mydate = new Date(parts[2],parts[0]-1,parts[1]);
        
			$("#mod_nombre").val(nombre_conductor);
			$("#mod_apellido").val(apellido_conductor);
			$("#mod_licencia").val(licencia_conductor);
			$("#mod_fecha_ingreso").val(parts[2]+'-'+parts[1]+'-'+parts[0]);
			$("#mod_cedula").val(id);
            $("#mod_id").val(id);
		
		}
	
function soloNumeros(e) 
{ 
var key = window.Event ? e.which : e.keyCode 
return ((key >= 48 && key <= 57) || (key==8)) 
}
		
		

