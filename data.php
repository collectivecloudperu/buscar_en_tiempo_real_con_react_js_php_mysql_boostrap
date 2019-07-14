<?php

    // Conectamos a la Base de Datos MySQL con PHP e imprimimos los items, cerramos la Conexion por seguridad.

        $mysqli = new mysqli('localhost','user','password','BD');
        $mysqli->query("SET NAMES 'utf8'");

        if ($mysqli->connect_error) {
            die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
        }

            $results = $mysqli->query("SELECT id, nombre, precio, stock FROM postres");
                      
            echo "var datosTabla=[";
            while($row = $results->fetch_object()) {
            echo "{";
            echo "id:'".$row->id."',";
            echo "nombre:'". $row->nombre."',";
            echo "precio:'". $row->precio."',";
            echo "stock:'". $row->stock."'},";           
            }

            echo "];";

             $mysqli->close();

?>
