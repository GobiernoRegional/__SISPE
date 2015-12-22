function validarNumeros(evento){
    var tecla = (evento.which) ? evento.which : evento.keyCode;
    if (tecla >= 48 && tecla <= 57){
      return true;
    }    
    return false;
}

function validarLetras(evento){
    var tecla = (evento.which) ? evento.which : evento.keyCode;
    if ((tecla >= 65 && tecla <= 90)||(tecla >= 97 && tecla <= 122)){
      return true;
    }    
    return false;
}

function soloLetras(e){
       var key = e.keyCode || e.which;
       var tecla = String.fromCharCode(key).toLowerCase();
       var letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       var especiales = "8-37-39-46";

       var tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
function soloNumeros(e) {
    var key = e.keyCode || e.which;
    var tecla = String.fromCharCode(key).toLowerCase();
    var letras = "0123456789,.%";
    var especiales = [8, 37, 39, 46];

    var tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}


$(document).on("keypress", "#txtEmpruc", function(){
    if($("#txtEmpruc").val().length < 11){
        return true;
    }else{
        return false;
    }
});