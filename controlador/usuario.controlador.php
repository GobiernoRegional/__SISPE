<?php

    require_once '../negocio/usuario.class.php';
    require_once '../util/funciones/Funciones.class.php';    
      
    $objUsuario= new Usuario(); 
    try {
        $registros = $objUsuario->listarUsuario();
        echo '<pre>';
        print_r($registros);
        echo '</pre>';
    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }    
?>

<table id="tabla-listado" class="table table-bordered table-striped">
    <thead>
            <tr>
                
                    <th>&nbsp;</th>    
                    <th>CODIGO</th>
                    <th>USUARIO</th>
                    <th>NOMBRE</th>
                    <th>TIPO</th>
                    <th>ESTADO</th>
                    <th>MANTENIMIENTO</th>
                    <th>CARGO</th>
                    <th>INSTITUCIÓN</th>
                    <th>PERSONAL</th>
                    <th>OPCIÓN</th>
                   
            </tr>
    </thead>
    <tbody>
        <?php
            for ($i=0; $i<count($registros);$i++) {
                
                echo '<tr>';
                    echo "<td align=\"center\">"
                            . "<input type=\"checkbox\"  name=\"seleccion\" id=\"seleccion\""
                            . " value='".$registros[$i]["usu_codigo"]."'>
                              </form>                                
                          </td>";
                    echo '<td>'.$registros[$i]["usu_codigo"].'</td>';
                    echo '<td>'.$registros[$i]["usu_nombre"].'</td>';
                    echo '<td>'.$registros[$i]["per_apellido"].'</td>';
                    echo '<td>'.$registros[$i]["usu_tipo"].'</td>';
                    echo '<td>'.$registros[$i]["usu_estado"].'</td>';     
                    echo '<td>'.$registros[$i]["upe_matenimiento"].'</td>';  
                    echo '<td>'.$registros[$i]["upe_cargo"].'</td>';  
                    echo '<td>'.$registros[$i]["upe_institucion"].'</td>';  
                    echo '<td>'.$registros[$i]["upe_personal"].'</td>';  
                    echo "
                        <td>
                            <a href=\"javascript:void();\" onClick = \"editarUsuario('".$registros[$i]["usu_codigo"]."')\" data-toggle=\"modal\" data-target=\"#myModal\"> <i class=\"fa fa-edit text-green\" ></i></a>
                            <a href=\"javascript:void();\" onClick = \"eliminarUsuario('".$registros[$i]["usu_codigo"]."')\"> <i class=\"fa fa-trash text-orange\" ></i></a>
                        </td>
                        ";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

    
    