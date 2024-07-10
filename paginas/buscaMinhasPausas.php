<?php
include "../classes/Autoload.php";
include "Funcoes.php";
session_start();

if ($_POST['dataPausa']) {
    //Carrega registro de pausas
    $CarregaRegistros = new DadosRegistroPausaVIEW();

    $CarregaRegistros->select("*", " idUsuario = {$_SESSION['cp_idUsuario']} AND horarioTermino > 0 AND dataRegistro = '{$_POST['dataPausa']}' ", "idRegistroPausas DESC");
    if ($CarregaRegistros->getIdRegistroPausas() != 0) {
        $CarregaRegistros->contaRegistros("idUsuario = {$_SESSION['cp_idUsuario']} AND horarioTermino > 0 AND dataRegistro = '{$_POST['dataPausa']}' ");
        $qtdPausas = $CarregaRegistros->getQtdRegistros();
        $retorno = array();

        //Total de horas
        $TotalHoras = new DadosRegistroPausaVIEW();
        $TotalHoras->select(
            "TIME_FORMAT( SEC_TO_TIME( SUM( TIME_TO_SEC( CASE WHEN horarioInicio < horarioTermino THEN TIMEDIFF(horarioTermino, horarioInicio) ELSE TIMEDIFF(horarioInicio, horarioTermino) END ) ) ), '%H:%i:%s' ) AS totalHoras ",
            " idUsuario = {$_SESSION['cp_idUsuario']} AND horarioTermino > 0 AND dataRegistro = '{$_POST['dataPausa']}' ",
            "idRegistroPausas DESC"
        );
        $retornoTotalHoras = $TotalHoras->getBusca()->fetch(PDO::FETCH_ASSOC);
        $horas = $retornoTotalHoras['totalHoras'];
        while ($resultado = $CarregaRegistros->getBusca()->fetch(PDO::FETCH_ASSOC)) {
            $intervaloHoras = IntervaloHoras($resultado['horarioInicio'], $resultado['horarioTermino']);
            $respostaAtraso = CalculaAtraso($resultado['horarioInicio'], $resultado['horarioTermino'], $resultado['tempoLimite']);

            if ($respostaAtraso == 'Atraso') {
                $bordaEstilo = "border-left-danger";
                $corDeFundo = "  background-color:#f95b4f2e  ;";
                $bordaTd = "style='border-right: 1px solid #e74a3b'";
            } else if ($respostaAtraso == 'Sem atraso') {
                $bordaEstilo = "border-left-success";
                $corDeFundo = "  background-color:#4caf502b  ;";
                $bordaTd = "style='border-right: 1px solid #1cc88a;'";
            }


            array_push(
                $retorno,
                [
                    'nomeTipoPausa'     => $resultado['nomeTipoPausas'],
                    'horarioInicio'     => date("H:i", strtotime($resultado['horarioInicio'])),
                    'horarioTermino'    => date("H:i", strtotime($resultado['horarioTermino'])),
                    'intervaloHoras'    => $intervaloHoras,
                    'bordaEstilo'       => $bordaEstilo,
                    'corDeFundo'        => $corDeFundo,
                    'bordaTd'           => $bordaTd,
                    'bordaEstilo'       => $bordaEstilo,
                    'qtdPausas'         => $qtdPausas,
                    'respostaAtraso'    => $respostaAtraso,
                    'totalHoras'        => $horas


                ]
            );
        }
        echo json_encode($retorno, JSON_PRETTY_PRINT);
    }
}
