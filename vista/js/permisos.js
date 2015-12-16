
function cargarCampos(){
    var usuario=$("#txtcodigocorreo").val();
  
    var tablas  = ["ano", "institucion", "cargos","digitalizacion","periodos",
        "personal","plantillas","requisitos","ruta","tramite"];

    $.post(
            "../controlador/permisos.usuario.controlador.php",
            {
                p_nom_usuario: usuario
            }
          ).done(function(resultado){
             
              var ano=0;
              var obj ;
            for (var i = 0;i<tablas.length;i++){
                ano++;
            $.post(
                "../controlador/permisos.controlador.php",
                {
                    p_nom_tabla: tablas[i],
                    p_cod_usuario: resultado
                }                        
                ).done(function(resul){
                  
                       obj = $.parseJSON ( resul );
                       var tablasss=obj;
//                
                        var va1=tablasss["ano"];   
                       
                        if(va1==="1"){
                            var tbl="#ano"
                            $(tbl).css("display", "block");
                        }if(va1==="0"){
                            var tbl="#ano"
                           $(tbl).css("display", "none");
                        }                        
                        //año
                        var va2=tablasss["institucion"];                       
                        if(va2==="1"){                            
                            var tbl="#institucion"
                            $(tbl).css("display", "block");
                        }if(va2==="0"){
                            var tbl="#institucion"
                           $(tbl).css("display", "none");
                        }
//                        //año
                        var va3=tablasss["cargos"];
                        if(va3==="1"){
                            var tbl="#cargos"
                            $(tbl).css("display", "block");
                        }if(va3==="0"){
                            var tbl="#cargos"
                           $(tbl).css("display", "none");
                        }
                        //año
                        var va4=tablasss["digitalizacion"];
                        if(va4==="1"){
                            var tbl="#digitalizacion"
                            $(tbl).css("display", "block");
                        }if(va4==="0"){
                            var tbl="#digitalizacion"
                           $(tbl).css("display", "none");
                        }
                        //año
                        var va5=tablasss["periodos"];
                        if(va5==="1"){
                            var tbl="#periodos"
                            $(tbl).css("display", "block");
                        }if(va5==="0"){
                            var tbl="#periodos"
                           $(tbl).css("display", "none");
                        }
                        //año
                        var va6=tablasss["personal"];
                        if(va6==="1"){
                            var tbl="#personal"
                            $(tbl).css("display", "block");
                        }if(va6==="0"){
                            var tbl="#personal"
                           $(tbl).css("display", "none");
                        }
                        //año
                        var va7=tablasss["plantillas"];
                        if(va7==="1"){
                            var tbl="#plantillas"
                            $(tbl).css("display", "block");
                        }if(va7==="0"){
                            var tbl="#plantillas"
                           $(tbl).css("display", "none");
                        }
                        //año
                        var va8=tablasss["requisitos"];
                        if(va8==="1"){
                            var tbl="#requisitos"
                            $(tbl).css("display", "block");
                        }if(va8==="0"){
                            var tbl="#requisitos"
                           $(tbl).css("display", "none");
                        }
                        //año
                        var va9=tablasss["ruta"];
                        if(va9==="1"){
                            var tbl="#ruta"
                            $(tbl).css("display", "block");
                        }if(va9==="0"){
                            var tbl="#ruta"
                           $(tbl).css("display", "none");
                        }
                        //año
                        var va10=tablasss["tramite"];
                        if(va10==="1"){
                            var tbl="#tramite"
                            $(tbl).css("display", "block");
                        }if(va10==="0"){
                            var tbl="#tramite"
                           $(tbl).css("display", "none");
                        }
         
                  
            }
                    );
            
          }
          
      });

}

function Pintar(){    
    var idantiguo="";
    var control=0;
    
    $("a").click(function() {        
                var idnuevo = $(this).attr("id");
                var idarchivo="#"+idnuevo;
                
                //Funcion al Pasar el Mause         
                
                $(idarchivo).hover(function(){
                $(idarchivo).css("color", "white");
                }, function(){
                $(idarchivo).css("color", "#B8C7CE");
                });
                //Fin del mause
                
                //Método para pintar el item seleccionado
                if(control===0){
                  $(idarchivo).css({
                    background:"#0746F2",
                    color: "#00FF00"
                });                 
                idantiguo=idarchivo;
                control=1;
                }
                
                if(idarchivo!==idantiguo){
                 $(idantiguo).css({
                      background:"#2C3B3B",
                      color: "#B8C7CE"
                });               
                control=0;
                }
                
                if(idarchivo!==idantiguo &&control===0 ) {
                    $(idarchivo).css({
                    background:"#FF0000",
                    color: "#00FF00"
                }); 
                 idantiguo=idarchivo;
                 control=1;
                }                
                //Fin del Mètodo Pintar                
    });
}



