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
    
        if($("#txtnombres").val()==="" || $("#txtapellidos").val()==="" || $("#txtdni").val()===""
                || $("#txtfechanacimiento").val()===""|| $("#txtdireccion").val()===""|| $("#txtsexo").val()==="0"
                || $("#txtemail").val()===""|| $("#txttelefono").val()===""|| $("#txtcargo").val()===""
                || $("#txtarea").val()===""|| $("#txtacceso").val()==="0"){
            swal("Complete los campos", "", "error");
            return 0;  
        }
    
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
    
        if($("#txtnombresedit").val()==="" || $("#txtapellidosedit").val()==="" || $("#txtdniedit").val()===""
                || $("#txtfechanacimientoedit").val()===""|| $("#txtdireccionedit").val()===""|| $("#txtsexoedit").val()==="0"
                || $("#txtemailedit").val()===""|| $("#txttelefonoedit").val()===""|| $("#txtcargoedit").val()===""
                || $("#txtareaedit").val()===""){
            swal("Complete los campos", "", "error");
            return 0;  
        }
    
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
       				$("#bodypersonal").append("<tr><td>"+DataJson.resultado[data].per_codigo+"</td><td>"+DataJson.resultado[data].per_apellido+" "+DataJson.resultado[data].per_nombre+"</td><td>"+DataJson.resultado[data].are_nombre+"</td><td>"+DataJson.resultado[data].car_nombre+"</td><td>"+DataJson.resultado[data].per_dni+"</td><td>"+DataJson.resultado[data].per_correo+"</td><td>"+DataJson.resultado[data].per_telefono+"</td><td><a class='btn btn-warning' data-toggle='modal' data-target='#myModal2' onclick='editar(\""+DataJson.resultado[data].per_codigo+"\")'><i class='glyphicon glyphicon-wrench'></i></a> <a class='btn btn-danger' data-toggle='modal' data-target='#myModale' onclick='eliminar(\""+DataJson.resultado[data].per_codigo+"\")'><i class='glyphicon glyphicon-remove'></i></a></td></tr>");
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
	$("#txtcodigoeliminar").val(id);	
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


function eliminardato(valor){
//    alert($("#txtcodigoeliminar").val());    
    if(valor ==="no"){
        return 0;
    }else{
        var parametro={
		"codigo":  $("#txtcodigoeliminar").val(),
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
//            	cargarCodigo();
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

///Validaciones
$(document).on("keypress", "#txtnombres", function(){
    if($("#txtnombres").val().length < 300){
        return true;
    }else{
        return false;
    }
});

$(document).on("keypress", "#txtnombresedit", function(){
    if($("#txtnombresedit").val().length < 300){
        return true;
    }else{
        return false;
    }
});

$(document).on("keypress", "#txtapellidos", function(){
    if($("#txtnombres").val().length < 300){
        return true;
    }else{
        return false;
    }
});

$(document).on("keypress", "#txtapellidosedit", function(){
    if($("#txtnombresedit").val().length < 300){
        return true;
    }else{
        return false;
    }
});

$(document).on("keypress", "#txtfechanacimiento", function(){
    if($("#txtnombres").val().length < 300){
        return true;
    }else{
        return false;
    }
});

$(document).on("keypress", "#txtfechanacimientoedit", function(){
    if($("#txtfechanacimientoedit").val().length < 300){
        return true;
    }else{
        return false;
    }
});

$(document).on("keypress", "#txtdireccion", function(){
    if($("#txtdireccion").val().length < 300){
        return true;
    }else{
        return false;
    }
});

$(document).on("keypress", "#txtdireccionedit", function(){
    if($("#txtdireccionedit").val().length < 300){
        return true;
    }else{
        return false;
    }
});

$(document).on("keypress", "#txtemail", function(){
    if($("#txtemail").val().length < 300){
        return true;
    }else{
        return false;
    }
});

$(document).on("keypress", "#txtemailedit", function(){
    if($("#txtemailedit").val().length < 300){
        return true;
    }else{
        return false;
    }
});

