<?php
    include "../classes/Autoload.php";
    session_start();

    if ($_POST['pausa'] == 'inicio')
    {

        $dataAtual = date("Y-m-d");
        $RegistroPausas = new RegistroPausas();
        $RegistroPausas->setHorarioInicio($_POST['horarioInicio']);
        $RegistroPausas->setIdUsuario($_SESSION['cp_idUsuario']);
        $RegistroPausas->setIdTipoPausa($_POST['idTipoPausa']);
        $RegistroPausas->setDataRegistro($dataAtual);
        $RegistroPausas->insert();


       //Retornar o id do registro para poder fazer um update no mesmo registro com o horario do termino
        $_SESSION['idUltimoRegistro'] = $RegistroPausas->getIdRegistroPausas();
        echo $RegistroPausas->getIdRegistroPausas();



        //$_SESSION['nomeUsuario']
        //$_SESSION['usuario']
       // $_SESSION['idUsuario']

    }

    if ($_POST['pausa'] == 'termino')
    {
        $RegistroPausas = new RegistroPausas();
        $RegistroPausas->update(["horarioTermino" =>$_POST['horarioTermino']], "idRegistroPausas={$_POST['idUltimoRegistro']}");

        //Verifica se foi atualizado e retorna o valor
        $RegistroPausas->select("*","idRegistroPausas={$_POST['idUltimoRegistro']}");
        echo $RegistroPausas->getHorarioTermino();
    }

