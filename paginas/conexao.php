<?php

$host     = 'localhost';
$db       = 'controlepausa';
$user     = 'root';
$password = '';

try{
$conexao = new PDO("mysql:host=localhost;dbname={$db}", $user, $password);
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e){
    $connect = false;
}