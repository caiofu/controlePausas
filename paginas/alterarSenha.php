<?php
    include "../classes/Autoload.php";
    session_start();

    $Token      = new Token();
    $Usuario    = new Usuarios();

    $senha = $_POST['novaSenha'];

    $Usuario->select("*", "idUsuario={$_SESSION['idUsuario']}");
    $tokenAntigo = $Usuario->getToken();

    $Token->geraToken($_SESSION['usuario'], $senha);

    $Token->encryptSenha($_POST['novaSenha']);

    $Usuario->update(["senha" =>$Token->getSenhaEncrypt(), "token" => $Token->getToken()], "idUsuario={$_SESSION['idUsuario']}");

    //Validando se foi alterado
    $Usuario->select("*", "idUsuario={$_SESSION['idUsuario']}");
    if ($Usuario->getToken() != $tokenAntigo)
    {
        echo 1;
    }
    else
    {
        echo 0;
    }