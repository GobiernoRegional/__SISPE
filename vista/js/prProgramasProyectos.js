$(document).ready(function(){
	cargarPolitica();
	cargarPoliticaEdit();
	listar();
});
$('#frmgrabar').submit(function(e){ 
    e.preventDefault();
    
  	$.ajax({
    	url: "../controlador/ProgramaProyectoGrabar.controlador.php",
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
    	url: "../controlador/ProgramaProyectoEditar.controlador.php",
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
	$("#txtprograma").val("");
}
function editar(id){
    	var parametro={
		"codigo":id,
	}
	$.ajax({
    	url: "../controlador/ProgramaProyectoCargarCodigo.controlador.php",
    	type: "post",
    	dataType: "json",
    	data: parametro,
    	success: function(DataJson){
      	if(DataJson.state){
            $("#txtcodigo").val(DataJson.resultado.prp_codigo);
            $("#txtprogramaedit").val(DataJson.resultado.prp_nombre);
            $("#txtpoliticaedit").val(DataJson.resultado.pro_cod_politica);
      	}else{                           
        		
      	}                                                           
    	}
  	})
  	.fail(function(){
    	swal("Ha ocurrido un error", "", "error");
  	});
}
function listar(){
	$("#bodyprograma").empty();
	$.ajax({
    	url: "../controlador/ProgramaProyectoListar.controlador.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
            
      		if(DataJson.state){
       			for(data in DataJson.resultado){
       				$("#bodyprograma").append("<tr><td>"+DataJson.resultado[data].prp_codigo+"</td><td>"+DataJson.resultado[data].pol_descripcion+"</td><td>"+DataJson.resultado[data].prp_nombre+"</td><td><a class='btn btn-warning' data-toggle='modal' data-target='#myModal2' onclick='editar(\""+DataJson.resultado[data].prp_codigo+"\")'><i class='glyphicon glyphicon-wrench'></i></a> <a class='btn btn-danger' data-toggle='modal' data-target='#myModale' onclick='eliminar(\""+DataJson.resultado[data].prp_codigo+"\")'><i class='glyphicon glyphicon-remove'></i></a></td></tr>");
       			}
      		}else{                           
        		
      		}
          $("#tableprograma").DataTable();                                                               
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
    	 url: "../controlador/ProgramaProyectoEliminar.controlador.php",
    	type: "post",
    	dataType: "json",
    	data: parametro,
    	success: function(DataJson){
      		if(DataJson.state){
       			swal("Correcto", "", "success");
            	listar();
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