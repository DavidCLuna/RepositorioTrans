$(document).ready(function(){
    loadVehiculosCargues(1);

});

function seleccionarFilaVehiculos(idTR,acumulador,placa){
    
    for (let i = 1; i <= acumulador; i++ ){
        var elemento = document.getElementById('tr'+i);
        elemento.className -= " success";
    }
    var elemento = document.getElementById(idTR);
    elemento.className += " success";
    document.getElementById('placa_vehiculo_tabla').innerHTML = placa;
    
}

function loadVehiculosCargues(page){
        let valor_cedula = document.getElementById('valor_cedula_conductores_vehiculos').value;
        $("#loader").fadeIn('slow');
        $.ajax({
            url:'./ajax/buscar_conductores_vehiculos.php?action=ajax&page='+page+'&cedula='+valor_cedula,
             beforeSend: function(objeto){
             $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
          },
            success:function(data){
                $(".outer_div").html(data).fadeIn('slow');
                $('#loader').html('');
                $('[data-toggle="tooltip"]').tooltip({html:true}); 

            }
        })
    
}





$( "#formulario_vinculacion_cargue" ).submit(function( event ) {
  $('#vincular_cargue').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/buscar_conductores_vehiculos.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados").html(datos);
			$('#guardar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

