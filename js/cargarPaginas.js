/*
   $(document).ready(function() {
       
				$("#btnRunt").click(function(event) {
                    alert('Prueba');
                    var url = 'https://www.runt.com.co/consultaCiudadana/#/consultaPersona';
                    popupCargarPaginas(url);
				});
                
               $("#btnSIMIT").click(function(event) {
                            var url = 'https://consulta.simit.org.co/Simit/verificar/contenido_verificar_pago_linea.jsp';
                            popupCargarPaginas(url);
                        });

               $("#btnProcuraduria").click(function(event) {
                            var url = 'https://www.procuraduria.gov.co/CertWEB/Certificado.aspx?tpo=2';
                            popupCargarPaginas(url);
                        });

               $("#btnContraloria").click(function(event) {
                            var url = 'http://cfiscal.contraloria.gov.co/siborinternet/certificados/certificadosPersonaNatural.asp';
                            popupCargarPaginas(url);
                        });
			});

    function popupCargarPaginas(var url){
        window.open(url,"ventana1","width=960,height=700,margin:0 auto,scrollbars=NO");
    }
*/


function abrirPestanas() {
        //window.open("https://consulta.simit.org.co/Simit/verificar/contenido_verificar_pago_linea.jsp","ventana1");
        //window.open("https://www.runt.com.co/consultaCiudadana/#/consultaPersona","ventana2");
        //window.open("https://www.procuraduria.gov.co/CertWEB/Certificado.aspx?tpo=2","ventana3");
        //window.open("http://cfiscal.contraloria.gov.co/siborinternet/certificados/certificadosPersonaNatural.asp","ventana4");
    return false;
	}

/*
$(document).ready(function() {
       
				$("#btnRunt").click(function(event) {
                    alert('Prueba');
                    var url = 'https://www.runt.com.co/consultaCiudadana/#/consultaPersona';
                    popupCargarPaginas(url);
				});
});
*/
fileList = new Array();
$("#fm-dropzone").dropzone({
  url: siteurl, 
  addRemoveLinks: true, 
  dictRemoveFileConfirmation: "Are you sure you want to remove this File?",     
  success: function(file, serverFileName) {
             fileList[file.name] = {"fid" : serverFileName };
           },
  removedfile: function(file) {
    
            $.post(siteurl + "/removeFile", fid:fileList[file.name].fid).done(function() {
                    file.previewElement.remove();
                }); 
           }
});