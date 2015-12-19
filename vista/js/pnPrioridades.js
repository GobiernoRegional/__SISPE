$(document).ready(function(){
	listar();
	cargarEje();
	cargarEjeEditar();
	CKEDITOR.replace("txtprioridades");
	CKEDITOR.replace("txtprioridadesedit");
});

$('#frmgrabar').submit(function(e){ 
    e.preventDefault();
    var parametro={
    	"txteje":$("#txteje").val(),
    	"txtprioridades": CKEDITOR.instances['txtprioridades'].getData(),
    }
  	$.ajax({
    	url: "../controlador/PrioridadGrabar.controlador.php",
    	type: "post",
    	dataType: "json",
    	data:parametro ,

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
    var parametro={
    	"txtcodigoedit":$("#txtcodigo").val(),
    	"txtejeedit":$("#txtejeedit").val(),
    	"txtprioridadedit": CKEDITOR.instances['txtprioridadesedit'].getData(),
    }
    $.ajax({
      url: "../controlador/PrioridadEditar.controlador.php",
      type: "post",
      dataType: "json",
      data:parametro ,

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
    })
});
function limpiarFormulario(){
  $("#txteje").val(0);
  $("#txtprioridades").val("");
}
function listar(){
	$("#bodyprioridades").empty();
	$.ajax({
    	url: "../controlador/PrioridadListar.controlador.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
      		if(DataJson.state){
       			for(data in DataJson.resultado){
       				$("#bodyprioridades").append("<tr><td>"+DataJson.resultado[data].pri_codigo+"</td><td>"+DataJson.resultado[data].eje_nombre+"</td><td>"+DataJson.resultado[data].pri_nombre+"</td><td><a class='btn btn-warning' data-toggle='modal' data-target='#myModal2' onclick='editar(\""+DataJson.resultado[data].pri_codigo+"\")'><i class='glyphicon glyphicon-wrench'></i></a> <a class='btn btn-danger' onclick='eliminar(\""+DataJson.resultado[data].pri_codigo+"\")'><i class='glyphicon glyphicon-remove'></i></a></td></tr>");
       			}
      		}else{                           
        		
      		}
          $("#tableprioridades").DataTable();                                                               
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
      url: "../controlador/PrioridadCargarCodigo.controlador.php",
      type: "post",
      dataType: "json",
      data: parametro,
      success: function(DataJson){
        if(DataJson.state){
          $("#txtcodigo").val(DataJson.resultado.pri_codigo);
          $("#txtejeedit").val(DataJson.resultado.pri_eje_codigo);
          CKEDITOR.instances['txtprioridadesedit'].setData(DataJson.resultado.pri_nombre)
          //$("#txtprioridadesedit").val(DataJson.resultado.pri_nombre);
        }else{                           
          
        }                                                           
      }
    })
    .fail(function(){
      swal("Ha ocurrido un error", "", "error");
    });
}
function cargarEje(){
	$.ajax({
    	url: "../controlador/EjeEstrategicoListar.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
      		if(DataJson.state){
       			for(data in DataJson.resultado){
       				$("#txteje").append("<option value="+DataJson.resultado[data].eje_codigo+">"+DataJson.resultado[data].eje_nombre+"</option>");
       			}
      		}else{                           
        		
      		}                                                            
    	}
  	})
  	.fail(function(){
    	//swal("Ha ocurrido un error", "", "error");
  	})
}
function cargarEjeEditar(){
	$.ajax({
    	url: "../controlador/EjeEstrategicoListar.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
      		if(DataJson.state){
       			for(data in DataJson.resultado){
       				$("#txtejeedit").append("<option value="+DataJson.resultado[data].eje_codigo+">"+DataJson.resultado[data].eje_nombre+"</option>");
       			}
      		}else{                           
        		
      		}                                                            
    	}
  	})
  	.fail(function(){
    	//swal("Ha ocurrido un error", "", "error");
  	})
}
function eliminar(id){
  var parametro={
    "codigo":id,
  }
  $.ajax({
      url: "../controlador/PrioridadEliminar.controlador.php",
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