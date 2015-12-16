<?php

    require_once '../negocio/dependencia.class.php';
    require_once '../util/funciones/Funciones.class.php';    
      
    $objDependencia = new Dependencia(); 
    try {
        $registros = $objDependencia->listar();
//        echo '<pre>';
//        print_r($registros);
//        echo '</pre>';
    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }    
?>

<table id="tabla-listado" class="table table-bordered table-striped">
    <thead>
            <tr>
                
                    <th>&nbsp;</th>    
                    <th>CODIGO</th>
                    <th>NOMBRE DEPENDENCIA</th>
                    <th>TELEFONO</th>
                    <th>CIUDAD</th>
                    <th>OPCIÓN</th>
                   
            </tr>
    </thead>
    <tbody>
        <?php
            for ($i=0; $i<count($registros);$i++) {
                
                echo '<tr>';
                    echo "<td align=\"center\">"
                            . "<input type=\"checkbox\"  name=\"seleccion\" id=\"seleccion\""
                            . " value='".$registros[$i]["0"]."'>
                              </form>                                
                          </td>";
                    echo '<td>'.$registros[$i]["dep_codigo"].'</td>';
                    echo '<td>'.$registros[$i]["dep_nombre"].'</td>';
                    echo '<td>'.$registros[$i]["dep_telefono"].'</td>';
                    echo '<td>'.$registros[$i]["udi_nombre"].'</td>';
                    echo "
                        <td>
                            <a href=\"javascript:void();\" onClick = \"editarDependencia('".$registros[$i]["0"]."')\" data-toggle=\"modal\" data-target=\"#myModal\"> <i class=\"fa fa-edit text-green\" ></i></a>
                            <a href=\"javascript:void();\" onClick = \"eliminarDependencia('".$registros[$i]["0"]."')\"> <i class=\"fa fa-trash text-orange\" ></i></a>
                        </td>
                        ";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

    
    