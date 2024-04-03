<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//L función debe retornar si o si una instancia de mysqli
function conectarDB() : mysqli{
    $db =new mysqli('localhost', 'root', '07092002fake', 'bienesraices_crud');

    if (!$db) {
        echo 'Error no se pudo conectar';
        exit; //Detiene la ejecución
    }

    return $db; //retornamos la conexión
}