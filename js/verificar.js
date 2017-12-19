		$(document).ready(function(){
			load(1);
			
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/buscar_verificar.php?action=ajax&page='+page+'&q='+q,
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

	
		
function eliminar (id){
    var q= $("#q").val();
    if (confirm("Realmente deseas eliminar la factura")){	
        $.ajax({
            type: "GET",
            url: "./ajax/buscar_verificar.php",
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

function imprimir_factura(id_factura){
    VentanaCentrada('./pdf/documentos/ver_factura.php?id_factura='+id_factura,'Factura','','1024','768','true');
}

$("#btn_guardar_enviar").click(function(){
    registrar_verificacion();
})

$("#btnAprobar").click(function(){
    registrar_verificacion();
})

function registrar_verificacion(){
    
    var file_runt = $('#inputRUNTConsulta').prop('files')[0];   
    var file_simit = $('#inputSIMITConsulta').prop('files')[0];   
    var file_procuraduria = $('#inputPROCURADURIAConsulta').prop('files')[0];   
    var file_contraloria = $('#inputCONTRALORIAConsulta').prop('files')[0];   
    var cedula = $("#cedula_conductor").text();
    var id_factura = $("#id_factura_cargue").text();
    
    var form_data = new FormData();                  
    form_data.append('file_runt', file_runt);
    form_data.append('file_simit', file_simit);
    form_data.append('file_procuraduria', file_procuraduria);
    form_data.append('file_contraloria', file_contraloria);
    
    $.ajax({
        data: form_data,
        url: "ajax/registro_verificar.php?cedula="+cedula+"&id_factura="+id_factura,
        type: "post",
        processData:false,
        cache:false,
        contentType:false,
        beforeSend: function(){
            $("#resultado").html("Mensaje: Cargando...");
            $('#btnAprobar').attr("disabled", true);
            $('#btnNoAprobar').attr("disabled", true);
        },
        success: function(datos){
            $("#resultado_cargar_datos").html(datos);
            $('#btnAprobar').attr("disabled", false);
            $('#btnNoAprobar').attr("disabled", false);
            load(1);
        }
    });
}

function asigarCedulaIdFacturaCampo(cedula, idFactura){
    $("#cedula_conductor").text(cedula);
    $("#id_factura_cargue").text(idFactura);
}
