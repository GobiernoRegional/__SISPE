$(document).ready(function(){
	cargarPolitica();
	cargarPoliticaEdit();
	listar();
});
$('#frmgrabar').submit(function(e){ 
    e.preventDefault();
    
  	$.ajax({
    	url: "../controlador/EstrategiaGrabar.controlador.php",
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
    	url: "../controlador/EstrategiaEditar.controlador.php",
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
	$("#txtpolitica").val(0);
	$("#txtestrategia").val("");
}
function listar(){
	$("#bodyestrategia").empty();
	$.ajax({
    	url: "../controlador/EstrategiaListar.controlador.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
            
      		if(DataJson.state){
       			for(data in DataJson.resultado){
       				$("#bodyestrategia").append("<tr><td>"+DataJson.resultado[data].est_codigo+"</td><td>"+DataJson.resultado[data].pol_descripcion+"</td><td>"+DataJson.resultado[data].est_descripcion+"</td><td><a class='btn btn-warning' data-toggle='modal' data-target='#myModal2' onclick='editar(\""+DataJson.resultado[data].est_codigo+"\")'><i class='glyphicon glyphicon-wrench'></i></a> <a class='btn btn-danger' onclick='eliminar(\""+DataJson.resultado[data].est_codigo+"\")'><i class='glyphicon glyphicon-remove'></i></a></td></tr>");
       			}
      		}else{                           
        		
      		}
          $("#tableestrategia").DataTable();                                                               
    	}
  	})
  	.fail(function(){
    	swal("Ha ocurrido un error", "", "error");
  	});
}
function editar(id){
    	var parametro={
		"codigo":id,
	}
	$.ajax({
    	url: "../controlador/EstrategiaCargarCodigo.controlador.php",
    	type: "post",
    	dataType: "json",
    	data: parametro,
    	success: function(DataJson){
      	if(DataJson.state){
            $("#txtcodigo").val(DataJson.resultado.est_codigo);
            $("#txtestrategiaedit").val(DataJson.resultado.est_descripcion);
            $("#txtpoliticaedit").val(DataJson.resultado.est_cod_politica);
      	}else{                           
        		
      	}                                                           
    	}
  	})
  	.fail(function(){
    	swal("Ha ocurrido un error", "", "error");
  	});
}
function cargarPolitica(){
	$.ajax({
    	url: "../controlador/PoliticaRegionListar.controlador.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
            
      		if(DataJson.state){
       			for(data in DataJson.resultado){
//                            alert(data);Numero de registros
       				$("#txtpolitica").append("<option value="+DataJson.resultado[data].pol_codigo+">"+DataJson.resultado[data].pol_descripcion+"</option>");
       			}
      		}else{                           
        		
      		}                                                            
    	}
  	})
  	.fail(function(){
    	//swal("Ha ocurrido un error", "", "error");
  	});
}
function cargarPoliticaEdit(){
	$.ajax({
    	url: "../controlador/PoliticaRegionListar.controlador.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
            
      		if(DataJson.state){
       			for(data in DataJson.resultado){
//                            alert(data);Numero de registros
       				$("#txtpoliticaedit").append("<option value="+DataJson.resultado[data].pol_codigo+">"+DataJson.resultado[data].pol_descripcion+"</option>");
       			}
      		}else{                           
        		
      		}                                                            
    	}
  	})
  	.fail(function(){
    	//swal("Ha ocurrido un error", "", "error");
  	});
}
function eliminar(id){
	var parametro={
		"codigo":id,
	}
	$.ajax({
    	url: "../controlador/EstrategiaEliminar.controlador.php",
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