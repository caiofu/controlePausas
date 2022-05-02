<?php
    include "../classes/Autoload.php";
    include "Funcoes.php";

    $RegistroPausas = new DadosRegistroPausaVIEW();
    $RegistroPausas->select("*", "horarioTermino = 0","dataRegistro DESC");

    date_default_timezone_set('America/Sao_Paulo');
    $horaAtual = date("H:i:s");
    $dataAtual = date("Y-m-d");
    $hora =0;
    $retorno = array();

   while($resultado = $RegistroPausas->getBusca()->fetch(PDO::FETCH_ASSOC))
    {
        $intervaloHoras =   IntervaloHoras($resultado['horarioInicio'],$horaAtual);
        $respostaAtraso = CalculaAtraso($resultado['horarioInicio'], $horaAtual, $resultado['tempoLimite']);
        if($respostaAtraso == 'Atraso')
        {
            $bordaEstilo = "class='border-left-danger'";
            $corDeFundo  = "  background-color:#f95b4f2e  ;border-right:1px solid #e74a3b;";
            $bordaTd = "#e74a3b";
        }
        else if($respostaAtraso == 'Sem atraso')
        {
            $bordaEstilo = " class ='border-left-success'";
            $corDeFundo  = "  background-color:#4caf502b  ; border-right: 1px solid #1cc88a;";
            $bordaTd = "#1cc88a";
        }
            $horaInico ="{$resultado['dataRegistro']} {$resultado['horarioInicio']}";

            //VERIFICA SE É EM UMA DATA ANTERIOR PARA MUDAR A FUNÇÃO
            if(  strtotime($resultado['dataRegistro']) < strtotime($dataAtual))
            {
                $tempoDecorrido = IntervaloHorasAberto($horaInico);

            }
            else
            {
                $tempoDecorrido= IntervaloHoras($resultado['horarioInicio'], $horaAtual);

            }

       //$tempoDecorrido= IntervaloHoras($resultado['horarioInicio'], $horaAtual);

        array_push($retorno,
                ['nomeCompleto'     => $resultado['nomeCompleto'],
                'nomeTipoPausa'     => $resultado['nomeTipoPausas'],
                'horarioInicio'     =>  date("H:i", strtotime($resultado['horarioInicio'])),
                'tempoDecorrido'    => $tempoDecorrido ,
                'bordaEstilo'       => $bordaEstilo,
                'corDeFundo'        => $corDeFundo,
                'bordaTd'           => $bordaTd,
                'bordaEstilo'       => $bordaEstilo,
                'tempoLimite'       => date("H:i", strtotime($resultado['tempoLimite'])),
                'respostaAtraso'    => $respostaAtraso,
                    'teste'         => $horaInico

                    ]);

    }
    echo json_encode($retorno, JSON_PRETTY_PRINT);
