<?php
    include "../classes/Autoload.php";
    session_start();

    $Token      = new Token();
    $Usuario    = new Usuarios();

    $senha = "123456";

    $Usuario->select("*", "idUsuario=39");
    $tokenAntigo = $Usuario->getToken();

    $Token->geraToken('MICHELE.SANTOS', $senha);

    $Token->encryptSenha('123456');

    $Usuario->update(["senha" =>$Token->getSenhaEncrypt(), "token" => $Token->getToken()], "idUsuario=22");

    //Validando se foi alterado
    $Usuario->select("*", "idUsuario=39");
    if ($Usuario->getToken() != $tokenAntigo)
    {
        echo 1;
    }
    else
    {
        echo 0;
    }