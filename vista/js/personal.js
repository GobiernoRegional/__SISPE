$(document).ready(function(){
	$("#divacceso").hide();
	listar();
	cargarCargo();
	cargarArea();
	cargarCargoEdit();
	cargarAreaEdit();
});
$('#frmgrabar').submit(function(e){ 
    e.preventDefault();
    
  	$.ajax({
    	url: "../controlador/grabarPersonal.controlador.php",
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
    	url: "../controlador/editarPersonal.controlador.php",
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
function limpiarFormulario(){
  $("#txtnombres").val("");
  $("#txtapellidos").val("");
  $("#txtdni").val("");
  $("#txtfechanacimiento").val("");
  $("#txtdireccion").val("");
  $("#txtsexo").val(1);
  $("#txtemail").val("");
  $("#txttelefono").val("");
  $("#txtcargo").val(0);
  $("#txtarea").val(0);
  $("#txtacceso").val(1);
  $("#divacceso").hide();
  $("#txtusuario").val("");
  $("#txtpassword").val("");
}
function visible(id){
	if (id==1) {
		$("#divacceso").hide();
	}else{
		$("#divacceso").show();
	}
}
function camposMayus(field){
  	field.value=field.value.toUpperCase();
}
function listar(){
	$("#bodypersonal").empty();
	$.ajax({
    	url: "../controlador/listarPersonal.controlador.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
      		if(DataJson.state){
       			for(data in DataJson.resultado){
       				$("#bodypersonal").append("<tr><td>"+DataJson.resultado[data].per_codigo+"</td><td>"+DataJson.resultado[data].per_apellido+" "+DataJson.resultado[data].per_nombre+"</td><td>"+DataJson.resultado[data].are_nombre+"</td><td>"+DataJson.resultado[data].car_nombre+"</td><td>"+DataJson.resultado[data].per_dni+"</td><td>"+DataJson.resultado[data].per_correo+"</td><td>"+DataJson.resultado[data].per_telefono+"</td><td><a class='btn btn-warning' data-toggle='modal' data-target='#myModal2' onclick='editar(\""+DataJson.resultado[data].per_codigo+"\")'><i class='glyphicon glyphicon-wrench'></i></a> <a class='btn btn-danger' onclick='eliminar(\""+DataJson.resultado[data].per_codigo+"\")'><i class='glyphicon glyphicon-remove'></i></a></td></tr>");
       			}
      		}else{                           
        		
      		}
          $("#tablepersonal").DataTable();                                                               
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
    	url: "../controlador/cargarPersonalCodigo.controlador.php",
    	type: "post",
    	dataType: "json",
    	data: parametro,
    	success: function(DataJson){
      		if(DataJson.state){
   				$("#txtcodigo").val(DataJson.resultado.per_codigo);
   				$("#txtnombresedit").val(DataJson.resultado.per_nombre);
   				$("#txtapellidosedit").val(DataJson.resultado.per_apellido);
   				$("#txtdniedit").val(DataJson.resultado.per_dni);
   				$("#txtfechanacimientoedit").val(DataJson.resultado.per_fnac);
   				$("#txtdireccionedit").val(DataJson.resultado.per_direccion);
   				$("#txtsexoedit").val(DataJson.resultado.per_sexo);
   				$("#txtemailedit").val(DataJson.resultado.per_correo);
   				$("#txttelefonoedit").val(DataJson.resultado.per_telefono);
   				$("#txtcargoedit").val(DataJson.resultado.per_car_codigo);
   				$("#txtareaedit").val(DataJson.resultado.per_are_codigo);
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
    	url: "../controlador/eliminarPersonal.controlador.php",
    	type: "post",
    	dataType: "json",
    	data: parametro,
    	success: function(DataJson){
      		if(DataJson.state){
       			swal("Correcto", "", "success");
            	listar();
      		}else{                           
        		
      		}                                                           
    	}
  	})
  	.fail(function(){
    	swal("Ha ocurrido un error", "", "error");
  	});
}
function cargarCargo(){
	$.ajax({
    	url: "../controlador/listarcargo.controlador.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
      		if(DataJson.state){
       			for(data in DataJson.resultado){
       				$("#txtcargo").append("<option value="+DataJson.resultado[data].car_codigo+">"+DataJson.resultado[data].car_nombre+"</option>");
       			}
      		}else{                           
        		
      		}                                                              
    	}
  	})
  	.fail(function(){
    	//swal("Ha ocurrido un error", "", "error");
  	})
}
function cargarArea(){
	$.ajax({
    	url: "../controlador/AreaListar.controlador.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
      		if(DataJson.state){
       			for(data in DataJson.resultado){
       				$("#txtarea").append("<option value="+DataJson.resultado[data].are_codigo+">"+DataJson.resultado[data].are_nombre+"</option>");
       			}
      		}else{                           
        		
      		}                                                            
    	}
  	})
  	.fail(function(){
    	//swal("Ha ocurrido un error", "", "error");
  	})
}
function cargarCargoEdit(){
	$.ajax({
    	url: "../controlador/listarcargo.controlador.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
      		if(DataJson.state){
       			for(data in DataJson.resultado){
       				$("#txtcargoedit").append("<option value="+DataJson.resultado[data].car_codigo+">"+DataJson.resultado[data].car_nombre+"</option>");
       			}
      		}else{                           
        		
      		}                                                              
    	}
  	})
  	.fail(function(){
    	//swal("Ha ocurrido un error", "", "error");
  	})
}
function cargarAreaEdit(){
	$.ajax({
    	url: "../controlador/AreaListar.controlador.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
      		if(DataJson.state){
       			for(data in DataJson.resultado){
       				$("#txtareaedit").append("<option value="+DataJson.resultado[data].are_codigo+">"+DataJson.resultado[data].are_nombre+"</option>");
       			}
      		}else{                           
        		
      		}                                                            
    	}
  	})
  	.fail(function(){
    	//swal("Ha ocurrido un error", "", "error");
  	})
}
