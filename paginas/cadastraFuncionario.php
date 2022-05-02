<?php
    include "../classes/Autoload.php";

    if($_POST['nomeCompleto'] != "" && $_POST['tipoUsuario'] != "" && $_POST['usuario'] != "" && $_POST['senha'] != "")
    {
        //Verifica se usuario ja existe
        $Usuarios = new Usuarios();

        $Usuarios->contaRegistros("nomeUsuario = '{$_POST['usuario']}'");

        if($Usuarios->getQtdRegistros() == 0)
        {
            //Gera um token
            $Token = new Token();
            $Token->geraToken($_POST['usuario'], $_POST['senha']);


            //Senha
            $Token->encryptSenha($_POST['senha']);


            $Usuarios = new Usuarios();
            $Usuarios->setNomeCompleto($_POST['nomeCompleto']);
            $Usuarios->setNomeUsuario($_POST['usuario']);
            $Usuarios->setSenha($Token->getSenhaEncrypt());
            $Usuarios->setToken($Token->getToken());
            $Usuarios->setIdTipoUsuario($_POST['tipoUsuario']);
            $Usuarios->insert();


            echo $Usuarios->getIdUsuario();
        }
        else
        {
            echo 0;
        }


    }


