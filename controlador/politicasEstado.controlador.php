<?php

    require_once '../negocio/politicasEstado.class.php';
    require_once '../util/funciones/Funciones.class.php';
    
      
    $objpolitica = new Politica();
    try {
        $registros = $objpolitica->listar();
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
                    <th>TIPO DE POLÍTICA</th>
                    <th>NOMBRE</th>
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
                    echo '<td>'.$registros[$i]["0"].'</td>';
                    echo '<td>'.$registros[$i]["1"].'</td>';                    
                    echo '<td>'.$registros[$i]["2"].'</td>'; 
                    echo "
                        <td>
                            <a href=\"javascript:void();\" onClick = \"editarPoliticasEstado('".$registros[$i]["0"]."')\" data-toggle=\"modal\" data-target=\"#myModal\"> <i class=\"fa fa-edit text-green\" ></i></a>
                            <a href=\"javascript:void();\" onClick = \"eliminarPoliticas('".$registros[$i]["0"]."')\"> <i class=\"fa fa-trash text-orange\" ></i></a>
                        </td>
                        ";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

    
    