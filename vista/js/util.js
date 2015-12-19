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