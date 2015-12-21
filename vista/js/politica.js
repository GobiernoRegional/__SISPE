$(document).ready(function(){
    listar();
    cargarSector();
    cargarSectorEditar();
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
       			$('#myModal').modal('hide');
       			limpiarFormulario();
      		}else{
      			swal("Ha ocurrido un error", "", "error");                           
        		listar();
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
       			$('#myModal2').modal('hide');
      		}else{
      			swal("Ha ocurrido un error", "", "error");                           
        		listar();
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
	$("#txtsector").val(0);
	$("#txtnombre").val("");
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
       				$("#bodypolitica").append("<tr><td>"+DataJson.resultado[data].pol_codigo+"</td><td>"+DataJson.resultado[data].tse_nombre+"</td><td>"+DataJson.resultado[data].pol_descripcion+"</td><td><a class='btn btn-warning' data-toggle='modal' data-target='#myModal2' onclick='editar(\""+DataJson.resultado[data].pol_codigo+"\")'><i class='glyphicon glyphicon-wrench'></i></a> <a class='btn btn-danger' onclick='eliminar(\""+DataJson.resultado[data].pol_codigo+"\")'><i class='glyphicon glyphicon-remove'></i></a></td></tr>");
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

function cargarSector(){
  $.ajax({
      url: "../controlador/SectorListar.controlador.php",
      type: "post",
      dataType: "json",
      success: function(DataJson){
          if(DataJson.state){
            for(data in DataJson.resultado){
              $("#txtsector").append("<option value="+DataJson.resultado[data].tse_codigo+">"+DataJson.resultado[data].tse_nombre+"</option>");
            }
          }else{                           
            
          }                                                            
      }
    })
    .fail(function(){
      //swal("Ha ocurrido un error", "", "error");
    })
}
function cargarSectorEditar(){
  $.ajax({
      url: "../controlador/SectorListar.controlador.php",
      type: "post",
      dataType: "json",
      success: function(DataJson){
          if(DataJson.state){
            for(data in DataJson.resultado){
              $("#txtsectoredit").append("<option value="+DataJson.resultado[data].tse_codigo+">"+DataJson.resultado[data].tse_nombre+"</option>");
            }
          }else{                           
            
          }                                                            
      }
    })
    .fail(function(){
      //swal("Ha ocurrido un error", "", "error");
    })
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
            $("#txtcodigo").val(DataJson.resultado.pol_codigo);
            $("#txtnombreedit").val(DataJson.resultado.pol_descripcion);
            $("#txtsectoredit").val(DataJson.resultado.pol_sec_codigo);
      	}else{                           
        		
      	}                                                           
    	}
  	})
  	.fail(function(){
    	swal("Ha ocurrido un error", "", "error");
  	});
}
function eliminar(id){
	var parametro={
		"codigo":id,
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
      		}else{                           
        		
      		}                                                           
    	}
  	})
  	.fail(function(){
    	swal("Ha ocurrido un error", "", "error");
  	});
}