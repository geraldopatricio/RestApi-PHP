<?php

$host = "localhost";
$dbname = "nome_banco_aqui";
$username = "usuario_aki";
$password = "senha_aki";

$method = $_SERVER['REQUEST_METHOD'];

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
