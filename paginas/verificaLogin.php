<?php
    include "../classes/Autoload.php";

    if($_POST['usuario'] != null && $_POST['senha'] != null)
    {
        $Token = new Token();
        $Token->geraToken($_POST['usuario'], $_POST['senha']);

        $Token->verificaToken($Token->getToken(), $_POST['usuario']);



        $Usuario = new Usuarios();
        $Usuario->select("*","nomeUsuario='{$_POST['usuario']}'  ");



        if ($Token->getStatusToken() == 1)
        {
            session_start();
            $_SESSION['cp_logado']         = true;
            $_SESSION['cp_nomeUsuario']    = $Usuario->getNomeCompleto();
            $_SESSION['cp_usuario']        = $Usuario->getNomeUsuario();
            $_SESSION['cp_idUsuario']      = $Usuario->getIdUsuario();
            $_SESSION['cp_tipoUsuario']    = $Usuario->getIdTipoUsuario();

          echo "logado";
        }
        else
        {
           echo "erro";
        }
    }