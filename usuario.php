<?php

// importar conexión
require 'includes/app.php';
$db  = conectarDB();
//crear email y pasword
$email = 'jjv20618@gmail.com';
$password = '123456';

//Función que hashea un password
$passwordhash = password_hash($password, PASSWORD_BCRYPT);

var_dump($passwordhash);
//query
$query = "INSERT INTO usuario(email, password) VALUES  ( '$email', '$passwordhash')";
echo $query;
//agregar a la base de datos
mysqli_query($db, $query);