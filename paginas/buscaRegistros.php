<?php

    include "../classes/Autoload.php";
    include "Funcoes.php";

    if($_POST['dataInicial'] != "" && $_POST['dataFinal'] != "" && $_POST['idUsuario'] != "")
    {
        $campoTipoPausa = "";
        if($_POST['tipoPausa'] != "")
        {
            $tipoPausa = " AND idTipoPausa = {$_POST['tipoPausa']}";
            $campoTipoPausa = "nomeTipoPausas,";
        }
        $RegistroPausas =  new DadosRegistroPausaVIEW();

        //Verifica se foi selecionado um usuario especifico ou não
        if($_POST['idUsuario'] == 0)
        {
            $RegistroPausas->select("dataRegistro, nomeCompleto, {$campoTipoPausa}
                                time_format( SEC_TO_TIME(SUM( TIME_TO_SEC(TIMEDIFF(horarioInicio,horarioTermino)))),'%H:%i:%s') 
                                AS totalHoras
                                , COUNT(idTipoPausa) AS QtdPausas","dataRegistro BETWEEN '{$_POST['dataInicial']}' AND '{$_POST['dataFinal']}' AND horarioTermino != 0 {$tipoPausa}","","","dataRegistro, nomeCompleto");
        }
        else
        {
            $RegistroPausas->select("dataRegistro, nomeCompleto, {$campoTipoPausa}
            time_format( SEC_TO_TIME(SUM( TIME_TO_SEC(TIMEDIFF(horarioInicio,horarioTermino)))),'%H:%i:%s') 
            AS totalHoras
            , COUNT(idTipoPausa) AS QtdPausas"," idUsuario = {$_POST['idUsuario']} AND dataRegistro BETWEEN '{$_POST['dataInicial']}' AND '{$_POST['dataFinal']}' AND horarioTermino != 0 {$tipoPausa}","","","dataRegistro, nomeCompleto");
        }


        $retorno = array();

        while($resultado = $RegistroPausas->getBusca()->fetch(PDO::FETCH_ASSOC))
        {

            array_push($retorno,
                [   'dataRegistro'      => date("d/m/Y",strtotime($resultado['dataRegistro'])),
                    'nomeCompleto'       => $resultado['nomeCompleto'],
                    'ContaPausa'         => $resultado['QtdPausas'],
                    'totalHoras'        => str_replace("-","", $resultado['totalHoras']),
                    'nomeTipoPausa'         => $resultado['nomeTipoPausas']

                ]);
        }
        echo json_encode($retorno, JSON_PRETTY_PRINT);
    }