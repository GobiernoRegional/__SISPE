<?php

    require_once '../negocio/personal.class.php';
    require_once '../util/funciones/Funciones.class.php';    
      
    $objPersonal= new Personal(); 
    try {
        $registros = $objPersonal->listar();
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
                    <th>APELLIDOS</th>
                    <th>NOMBRES</th>
                    <th>DNI</th>
                    <th>SEXO</th>
                    <th>F. NACIMIENTO</th>
                    <th>DIRECCIÓN</th>
                    <th>CORREO</th>
                    <th>ÁREA</th>
                    <th>CARGO</th>
                    <th>CIUDAD</th>
                    <th>TELÉFONO</th>
                    <th>ESTADO</th>
                    <th>OPCIÓN</th>
                   
            </tr>
    </thead>
    <tbody>
        <?php
            for ($i=0; $i<count($registros);$i++) {
                
                echo '<tr>';
                    echo "<td align=\"center\">"
                            . "<input type=\"checkbox\"  name=\"seleccion\" id=\"seleccion\""
                            . " value='".$registros[$i]["per_codigo"]."'>
                              </form>                                
                          </td>";
                    echo '<td>'.$registros[$i]["per_codigo"].'</td>';
                    echo '<td>'.$registros[$i]["per_apellido"].'</td>';
                    echo '<td>'.$registros[$i]["per_nombre"].'</td>';
                    echo '<td>'.$registros[$i]["per_dni"].'</td>';
                    echo '<td>'.$registros[$i]["per_sexo"].'</td>';     
                    echo '<td>'.$registros[$i]["per_fnac"].'</td>';  
                    echo '<td>'.$registros[$i]["per_direccion"].'</td>';  
                    echo '<td>'.$registros[$i]["per_correo"].'</td>';  
                    echo '<td>'.$registros[$i]["are_nombre"].'</td>';  
                    echo '<td>'.$registros[$i]["car_nombre"].'</td>';  
                    echo '<td>'.$registros[$i]["udi_nombre"].'</td>';  
                    echo '<td>'.$registros[$i]["per_telefono"].'</td>';  
                    echo '<td>'.$registros[$i]["per_estado"].'</td>';  
                    echo "
                        <td>
                            <a href=\"javascript:void();\" onClick = \"editarPersonal('".$registros[$i]["per_codigo"]."')\" data-toggle=\"modal\" data-target=\"#myModal\"> <i class=\"fa fa-edit text-green\" ></i></a>
                            <a href=\"javascript:void();\" onClick = \"eliminarPersonal('".$registros[$i]["per_codigo"]."')\"> <i class=\"fa fa-trash text-orange\" ></i></a>
                        </td>
                        ";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

    
    