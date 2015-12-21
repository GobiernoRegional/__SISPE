$(document).ready(function(){
	listar();
});
function listar(){
	$("#bodyejeestrategico").empty();
	$.ajax({
    	url: "../controlador/EjeEstrategicoListar.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
      		if(DataJson.state){
       			for(data in DataJson.resultado){
       				$("#bodyejeestrategico").append("<tr><td>"+DataJson.resultado[data].eje_codigo+"</td><td>"+DataJson.resultado[data].eje_nombre+"</td></tr>");
       			}
      		}else{                           
        		
      		}
          $("#tablejeestrategico").DataTable();                                                               
    	}
  	})
  	.fail(function(){
    	//swal("Ha ocurrido un error", "", "error");
  	})
}