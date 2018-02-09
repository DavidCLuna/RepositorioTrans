$(document).ready(function(){
    loadVehiculosCargues(1);

});

let placa_vehiculo_seleccionada;
let idTRGlobal;

function seleccionarFilaVehiculos(idTR,acumulador,placa){
    
    idTRGlobal = idTR;
    placa_vehiculo_seleccionada = placa;
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
  $('#guardar_cargue').attr("disabled", true);
  
    var accion = confirm('¿Realmente deseas vincular este vehículo?, esta acción no se podrá revertir.');
    if(accion){
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
                $('#guardar_cargue').attr("disabled", false);
                loadVehiculosCargues(1);
              }
        });
      event.preventDefault();
    }
})

$("#btn_registrar_cargue1").click(function(){
    registrar_cargue();
})

$("#btn_registrar_cargue2").click(function(){
    registrar_cargue();
})

function registrar_cargue(){
    let cedula = document.getElementById("valor_cedula_conductores_vehiculos").value;
    let destino = document.getElementById("destino_cargue").value;
    let placa = placa_vehiculo_seleccionada;

    var idFactura = [];
    var dataDocument = new FormData();
    var inputFileDocument;
    var check_factura = [];

    


for (var i = 0; i <= contadorFilas; i++) {

    idFactura[i] = document.getElementById("id_factura"+i.toString()).value;
    inputFileDocument = document.getElementById("adjunto"+i.toString());
    
    var file = inputFileDocument.files[0];
    dataDocument.append('documento'+i.toString(),file);


    if(document.getElementById("check_factura"+i.toString()).checked){
        check_factura[i] = "true"
    }else{
        check_factura[i] = "false"
    }

}

$.ajax({
    data: /*dataDocument,*/{ 'idFactura':JSON.stringify(idFactura),  'check_factura':JSON.stringify(check_factura),'cedula':cedula, 'placa':placa, 'destino_cargue':destino,'contadorFilas':contadorFilas},
    url: "ajax/nuevo_cargue.php",
    type: "post",
    beforeSend: function(){
        $("#resultado_registro_cargue").html("Mensaje: Cargando...");
        $('#btn_registrar_cargue1').attr("disabled", true);
        $('#btn_registrar_cargue2').attr("disabled", true);

    },
    success: function(datos){
            $("#resultado_registro_cargue").html(datos);
            $('#btn_registrar_cargue1').attr("disabled", false);
            $('#btn_registrar_cargue2').attr("disabled", false);
           // if(idTRGlobal != null && idTRGlobal != ""){
            //    seleccionarFilaVehiculos(idTRGlobal);
           // }
          }
})   

}

/*
    https://www.facebook.com/davidhurtadotv/videos/455870698131986/
*/ 



