		$(document).ready(function(){
			load(1);
			
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/buscar_facturas.php?action=ajax&page='+page+'&q='+q,
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
            url: "./ajax/buscar_facturas.php",
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
    
    let file_runt = document.getElementById("inputRUNTConsulta");
    let file_simit = document.getElementById("inputSIMITConsulta");
    let file_procuraduria = document.getElementById("inputPROCURADURIAConsulta");
    let file_contraloria = document.getElementById("inputCONTRALORIAConsulta");
    
    var file_r = file_runt.file;
    var file_s = file_simit.file;
    var file_p = file_procuraduria.file;
    var file_c = file_contraloria.file;
    
    var data = new FormData();
    
    data.append('file_runt',file_r);
    
    $.ajax({
        data: data,
        url: "ajax/registro_verificar.php",
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
            $("#resultado").html(datos);
            $('#btnAprobar').attr("disabled", false);
            $('#btnNoAprobar').attr("disabled", false);
        }
    });
    
}


