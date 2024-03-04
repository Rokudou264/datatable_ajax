<?php
include_once 'class/database.php';
$conexion = new Database();
if( (isset($_POST['valores']) && !empty($_POST['valores'])) ):

    $json  = $_POST['valores'];
    $filas = json_decode($_POST['valores'], true);
    $data  = json_decode($json);
    // Construct the query for inserting the products of the order
     foreach ($filas as $fila):
            $ced  = $fila['ci'];
            if( (isset($ced) && !empty($ced))   ):
           
            else:
                echo "405"; //problema valores detalles
            endif;
    endforeach;
                       
    


    


endif;  