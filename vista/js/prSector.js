$(document).ready(function(){
  listar();
});
$('#frmgrabar').submit(function(e){ 
    e.preventDefault();
  
      if($("#txtsector").val()===""){
          swal("Complete los campos", "", "error");
          return 0;  
      }

    $.ajax({
      url: "../controlador/SectorGrabar.controlador.php",
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


    if($("#txtsectoredit").val()!==""){
        swal("Complete los campos", "", "error");
        return 0;  
        
    }
    $.ajax({
      url: "../controlador/SectorEditar.controlador.php",
      type: "post",
      dataType: "json",
      data:$("#frmeditar").serialize() ,

      success: function(DataJson){
          if(DataJson.state){
            swal("Registro Correcto", "", "success");
            listar();
            $('#myModal2').modal('hide');
            limpiarFormulario();
          }else{
            swal("Ha ocurrido un error", "", "error");                           
            listar();
            $('#myModal2').modal('hide');
            limpiarFormulario();
          }                                                           
      }
    })
    .fail(function(){
      swal("Ha ocurrido un error", "", "error");
    });
});
function editar(id){
  var parametro={
    "codigo":id,
  }
  $.ajax({
      url: "../controlador/SectorCargarCodigo.controlador.php",
      type: "post",
      dataType: "json",
      data: parametro,
      success: function(DataJson){
        if(DataJson.state){
          $("#txtcodigo").val(DataJson.resultado.tse_codigo);
          $("#txtsectoredit").val(DataJson.resultado.tse_nombre);
        }else{                           
          
        }                                                           
      }
    })
    .fail(function(){
      swal("Ha ocurrido un error", "", "error");
    });
}
function camposMayus(field){
  field.value=field.value.toUpperCase();
}
function limpiarFormulario(){
  $("#txteje").val(0);
  $("#txtsector").val("");
}
function listar(){
  $("#bodysector").empty();
  $.ajax({
      url: "../controlador/SectorListar.controlador.php",
      type: "post",
      dataType: "json",
      success: function(DataJson){
          if(DataJson.state){
            for(data in DataJson.resultado){
              $("#bodysector").append("<tr><td>"+DataJson.resultado[data].tse_codigo+"</td><td>"+DataJson.resultado[data].tse_nombre+"</td><td><a class='btn btn-warning' data-toggle='modal' data-target='#myModal2' onclick='editar(\""+DataJson.resultado[data].tse_codigo+"\")'><i class='glyphicon glyphicon-wrench'></i></a> <a class='btn btn-danger' data-toggle='modal' data-target='#myModale' onclick='eliminar(\""+DataJson.resultado[data].tse_codigo+"\")'><i class='glyphicon glyphicon-remove'></i></a></td></tr>");
            }
          }else{                           
            
          }
          $("#tablesector").DataTable();                                                               
      }
    })
    .fail(function(){
      //swal("Ha ocurrido un error", "", "error");
    })
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
    	url: "../controlador/SectorEliminar.controlador.php",
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

//VALIDACIONES

$(document).on("keypress", "#txtsector", function(){
    if($("#txtsector").val().length < 300){
        return true;
    }else{
        return false;
    }
});

$(document).on("keypress", "#txtsectoredit", function(){
    if($("#txtsectoredit").val().length < 300){
        return true;
    }else{
        return false;
    }
});