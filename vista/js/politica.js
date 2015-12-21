$(document).ready(function(){
    listar();
    cargarCodigo();
});
$('#frmgrabar').submit(function(e){ 
    e.preventDefault();
    
  	$.ajax({
    	url: "../controlador/PoliticaRegionGrabar.controlador.php",
    	type: "post",
    	dataType: "json",
    	data:$("#frmgrabar").serialize() ,

    	success: function(DataJson){
      		if(DataJson.state){
      			swal("Registro Correcto", "", "success");
       			listar();
       			cargarCodigo();
       			$('#myModal').modal('hide');
       			limpiarFormulario();
      		}else{
      			swal("Ha ocurrido un error", "", "error");                           
        		listar();
        		cargarCodigo();
        		$('#myModal').modal('hide');
        		limpiarFormulario();
      		}                                                           
    	}
  	})
  	.fail(function(){
    	swal("Ha ocurrido un error", "", "error");
  	})
});
$('#frmeditar').submit(function(e){ 
    e.preventDefault();
    
  	$.ajax({
    	url: "../controlador/PoliticaRegionEditar.controlador.php",
    	type: "post",
    	dataType: "json",
    	data:$("#frmeditar").serialize() ,

    	success: function(DataJson){
      		if(DataJson.state){
      			swal("Editar Correcto", "", "success");
       			listar();
       			cargarCodigo();
       			$('#myModal2').modal('hide');
      		}else{
      			swal("Ha ocurrido un error", "", "error");                           
        		listar();
        		cargarCodigo();
        		$('#myModal2').modal('hide');
        		
      		}                                                           
    	}
  	})
  	.fail(function(){
    	swal("Ha ocurrido un error", "", "error");
  	})
});
function camposMayus(field){
  field.value=field.value.toUpperCase();
}
function limpiarFormulario(){
  $("#txtnombre").val("");
}
function limpiarFormularioEditar(){
	$("#txtcodigoedit").val("");
	$("#txtnombreedit").val("");
}
function listar(){
	$("#bodypolitica").empty();
	$.ajax({
    	url: "../controlador/PoliticaRegionListar.controlador.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
            
      		if(DataJson.state){
       			for(data in DataJson.resultado){
//                            alert(data);Numero de registros
       				$("#bodypolitica").append(
                                        '<tr>' +
                                            '<td>'
                                                +DataJson.resultado[data].pol_codigo+                                        
                                            '</td>'+
                                            
                                            '<td>'
                                                +DataJson.resultado[data].pol_descripcion+
                                            '</td>'+
                                            
                                            '<td> '+
                                                "<a class='btn btn-warning' data-toggle='modal' data-target='#myModal2' onclick='editar(\""+DataJson.resultado[data].pol_codigo+"\")'> \n\
                                                  <i class='glyphicon glyphicon-wrench'></i>\n\
                                                </a>"+
                                                "<a class='btn btn-danger' data-toggle='modal' data-target='#myModale' onclick='eliminar(\""+DataJson.resultado[data].pol_codigo+"\")'>\n\
                                                <i class='glyphicon glyphicon-remove'></i>\n\
                                                </a>"+
                                            '</td>'+
                                        '</tr>');
       			}
      		}else{                           
        		
      		}
          $("#tablepolitica").DataTable();                                                               
    	}
  	})
  	.fail(function(){
    	//swal("Ha ocurrido un error", "", "error");
  	});
}


function cargarCodigo(){
	$.ajax({
    	url: "../controlador/PoliticaObtenerCodigo.controlador.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
            if(DataJson.state){
                $("#txtcodigo").val(DataJson.resultado);
            }                                                           
    	}
  	});
}
function editar(id){
    	var parametro={
		"codigo":id,
	}
	$.ajax({
    	url: "../controlador/PoliticaRegionCargarCodigo.controlador.php",
    	type: "post",
    	dataType: "json",
    	data: parametro,
    	success: function(DataJson){
      	if(DataJson.state){
            $("#txtcodigoedit").val(DataJson.resultado.pol_codigo);
            $("#txtnombreedit").val(DataJson.resultado.pol_descripcion);
      	}else{                           
        		
      	}                                                           
    	}
  	})
  	.fail(function(){
    	swal("Ha ocurrido un error", "", "error");
  	});
}
function eliminar(id){
	$("#txtcodigoeliminar").val(id);	
}

function eliminardato(valor){
//    alert($("#txtcodigoeliminar").val());    
    if(valor ==="no"){
        return 0;
    }else{
        var parametro={
		"codigo":  $("#txtcodigoeliminar").val(),
	}
	$.ajax({
    	url: "../controlador/PoliticaRegionEliminar.controlador.php",
    	type: "post",
    	dataType: "json",
    	data: parametro,
    	success: function(DataJson){
      		if(DataJson.state){
       			swal("Correcto", "", "success");
            	listar();
            	cargarCodigo();
                $("#btncerrareliminar").click();
      		}else{                           
        		
      		}                                                           
    	}
  	})
  	.fail(function(){
    	swal("Ha ocurrido un error", "", "error");
  	});
    }
	
}