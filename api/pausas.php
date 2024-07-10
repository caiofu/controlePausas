<?php
include "../classes/Autoload.php";
$retorno = array();
    if($_POST['usuario'] != null)
    {
        $PausasView = new DadosRegistroPausaVIEW();
        $PausasView->select("*", "dataRegistro = DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND nomeUsuario='{$_POST['usuario']}'");
        $PausasView->contaRegistros("dataRegistro = DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND nomeUsuario='{$_POST['usuario']}'");
        array_push($retorno, ["codigo" => 1, "nomeUsusario" => $PausasView->getNomeUsuario(),
                                    "dataRegistro" => $PausasView->getDataRegistro(),
                                    "qtdPausas" => $PausasView->getQtdRegistros()]);
    }
    else
    {
        array_push($retorno, ["codigo" => 2, "mensagem" => "Nenhum dado retornado" ]);
    }
echo json_encode($retorno, JSON_PRETTY_PRINT |  JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);