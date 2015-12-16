$(document).ready(function(){
	$("#menuprdc").attr("class","active");
	$("#menufundamentonormativo").attr("class","active");
	CKEDITOR.replace("txtdescripcioneditor");
	listar();
});

$("#frmRegistroManual").submit(function(e){
	e.preventDefault();
	$.ajax({
    	url: "../controlador/registrarFundamento.php",
    	type: "post",
    	dataType: "json",
    	data:$("#frmRegistroManual").serialize() ,

    	success: function(DataJson){
      		if(DataJson.state){
       			alert("Exito");
      		}else{                           
        		alert("No Exito");
      		}                                                           
    	}
  	})
  	.fail(function(){
    	alert("error");
  	})
});
function listar(){
	$("#creartabledocumento").empty();
	$.ajax({
    	url: "../controlador/listarDocumento.php",
    	type: "post",
    	dataType: "json",

    	success: function(DataJson){
    		$("#creartabledocumento").append("<table class='table table-bordered' id='tabledocumento'><thead><tr><th>Título</th><th>Documento</th><th>Acción</th></tr></thead><tbody id='bodydocumento'></tbody></table>");
      		if(DataJson.state){
       			for(data in DataJson.resultado){
       				$("#bodydocumento").append("<tr><td>"+DataJson.resultado[data].titulo+"</td><td>"+DataJson.resultado[data].documento_texto+"</td><td></td></tr>");
       			}
      		}else{                           
        		
      		}
      		$("#tabledocumento").DataTable();                                                              
    	}
  	})
  	.fail(function(){
    	swal("Ha ocurrido un error", "", "error");
  	})
}