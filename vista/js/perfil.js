$(document).ready(function (){
//     $('#txttelefono').css('display', 'none');
//     $('#txtcorreo').css('display', 'block');

    $('#btnperfil').css('display', 'none');
    document.getElementById("txttelefono").disabled='false'; 
    document.getElementById("txtcorreo").disabled='false'; 
    document.getElementById("txtdireccion").disabled='false'; 
});

//TELEFONO
$(document).on("dblclick", "#txttelefono", function(){    
    document.getElementById('txttelefono').disabled="";
    $('#txttelefono').css('background', '#FFFFFF');
    $('#btnperfil').css('display', 'block');
});

$(document).on("keypress", "#txttelefono", function(evento){
    if (evento.which === 13){
        document.getElementById("txttelefono").disabled='false';
        $('#txttelefono').css('background', '#D9EDF7');
        $('#btnperfil').css('display', 'block');
    }else{
       return validarNumeros(evento);
    }
});

//CORREO
$(document).on("dblclick", "#txtcorreo", function(){    
    document.getElementById('txtcorreo').disabled="";
    $('#txtcorreo').css('background', '#FFFFFF');
    $('#btnperfil').css('display', 'block');
});

$(document).on("keypress", "#txtcorreo", function(evento){
    if (evento.which === 13){
        document.getElementById("txtcorreo").disabled='false';
        $('#txtcorreo').css('background', '#D9EDF7');
        $('#btnperfil').css('display', 'block');
    }
});

//DIRECCIÓN
$(document).on("dblclick", "#txtdireccion", function(){    
    document.getElementById('txtdireccion').disabled="";
    $('#txtdireccion').css('background', '#FFFFFF');
    $('#btnperfil').css('display', 'block');
});

$(document).on("keypress", "#txtdireccion", function(evento){
    if (evento.which === 13){
        document.getElementById("txtdireccion").disabled='false';
        $('#txtdireccion').css('background', '#D9EDF7');
        $('#btnperfil').css('display', 'block');
    }
});

function GrabarPerfil(){

    $.ajax({
    	url: "../controlador/PerfilEditar.controlador.php",
    	type: "post",
    	dataType: "json",
    	data:$("#frmgrabar").serialize() ,

    	success: function(DataJson){
            
      		if(DataJson.state){
                    
      			swal("Modificación Correcta", "", "success");
       			location.href="../controlador/cerrarSesion.php";
      		}else{
      			swal("Ha ocurrido un error", "", "error");                         
        		
        		
      		}                                                           
    	}
  	})
  	.fail(function(){
    	swal("Ha ocurrido un error", "", "error");
  	});
    
}