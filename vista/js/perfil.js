function cargarDatos(){
    $('#btnperfil').css('display', 'none');
    $("#txttelefonoedit").val($("#txttelefono").val());
    $("#txtcorreoedit").val($("#txtcorreo").val());
    $("#txtdireccionedit").val($("#txtdireccion").val());
    
    $("#txttelefonocont").val($("#txttelefono").val());
    $("#txtcorreocont").val($("#txtcorreo").val());
    $("#txtdireccioncont").val($("#txtdireccion").val());    
    
    document.getElementById("txttelefono").disabled='false'; 
    document.getElementById("txtcorreo").disabled='false'; 
    document.getElementById("txtdireccion").disabled='false'; 
}
function validaDobleClick(campo){
    document.getElementById(campo).disabled="";
    $('#'+campo).css('background', '#FFFFFF');
    $('#btnperfil').css('display', 'none');
    $('#txtcontrol').val(parseInt($("#txtcontrol").val())+1); 
}

function validaKeyPress(campo){
    $('#txtcontrol').val(parseInt($('#txtcontrol').val())-1);
    $('#'+campo).css('background', '#D9EDF7');
    
    if( $('#txtcontrol').val()==='0'){ 
        if(
        $("#txttelefonoedit").val()!== $("#txttelefonocont").val() ||
        $("#txtcorreoedit").val()!== $("#txtcorreocont").val() ||
        $("#txtdireccionedit").val()!== $("#txtdireccioncont").val()){
        
        $('#btnperfil').css('display', 'block');  
        }
    }else{
           $('#btnperfil').css('display', 'none'); 
    }

    document.getElementById(campo).disabled='false';    
}


$(document).ready(function (){
    cargarDatos();
    alert("perfil");
});

//TELEFONO
$(document).on("dblclick", "#txttelefono", function(){    
    validaDobleClick("txttelefono");
});

$(document).on("keypress", "#txttelefono", function(evento){
    if (evento.which === 13){
       $("#txttelefonoedit").val($("#txttelefono").val()); 
        validaKeyPress("txttelefono");        
    }else{
       return validarNumeros(evento);
    }
});

//CORREO
$(document).on("dblclick", "#txtcorreo", function(){       
    validaDobleClick("txtcorreo");    
});

$(document).on("keypress", "#txtcorreo", function(evento){
    if (evento.which === 13){  
        $("#txtcorreoedit").val($("#txtcorreo").val()); 
        validaKeyPress("txtcorreo");        
    }
});

//DIRECCIÓN
$(document).on("dblclick", "#txtdireccion", function(){    
    validaDobleClick("txtdireccion");   
});

$(document).on("keypress", "#txtdireccion", function(evento){
    if (evento.which === 13){
        $("#txtdireccionedit").val($("#txtdireccion").val());
        validaKeyPress("txtdireccion");   
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