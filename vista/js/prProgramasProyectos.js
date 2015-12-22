$(document).ready(function(){
	cargarPolitica();
	cargarPoliticaEdit();
});
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