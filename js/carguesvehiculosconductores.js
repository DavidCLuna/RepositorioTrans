$(document).ready(function(){
    loadVehiculosCargues(1);

});

function loadVehiculosCargues(page){
        $("#loader").fadeIn('slow');
        $.ajax({
            url:'./ajax/buscar_conductores_vehiculos.php?action=ajax&page='+page,
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

