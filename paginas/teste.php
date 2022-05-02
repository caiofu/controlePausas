<?php
include "../classes/Autoload.php";
//include "../paginas/Funcoes.php";
$RegistroPausas = new DadosRegistroPausaVIEW();
$RegistroPausas->select("*", "horarioTermino = 0");

date_default_timezone_set('America/Sao_Paulo');
$horaAtual = date("H:i:s");
$dataAtual = date("Y-m-d");
$hora =0;
$retorno = array();
while($resultado = $RegistroPausas->getBusca()->fetch(PDO::FETCH_ASSOC))
{
    $horaInico ="{$resultado['dataRegistro']} {$resultado['horarioInicio']}";
    /*$horaInicio = new DateTime($horaInico);
    $horaAtual = new DateTime();

    $data1  = $horaInicio->format('Y-m-d H:i:s');
    $data2  = $horaAtual->format('Y-m-d H:i:s');

    $diff = $horaInicio->diff($horaAtual);
    $horas = $diff->h + ($diff->days * 24);
    $minutos   = $diff->i;
    echo "{$horas}:{$minutos}:00";
    echo "<br>"; */

   $te =  IntervaloHorasAberto($horaInico);
   var_dump(strtotime($dataAtual)."EEEE". strtotime($resultado['dataRegistro']));
if(strtotime($dataAtual) > strtotime($resultado['dataRegistro']))
{
    echo "é maior<br>";
}
else
{
    echo "nao e maior <br>";
}

}
//$hor = '2022-04-14 15:51:40';
/*
$horaInicio = new DateTime($horaInico);
$horaAtual = new DateTime();

$data1  = $horaInicio->format('Y-m-d H:i:s');
$data2  = $horaAtual->format('Y-m-d H:i:s');

$diff = $horaInicio->diff($horaAtual);
$horas = $diff->h + ($diff->days * 24);
$minutos   = $diff->i;
echo "{$horas}:{$minutos}:00";*/

function IntervaloHorasAberto($horaInicio)
{
    $horaInicio = new DateTime($horaInicio);
    $horaAtual = new DateTime();

    $data1  = $horaInicio->format('Y-m-d H:i:s');
    $data2  = $horaAtual->format('Y-m-d H:i:s');

    $diff = $horaInicio->diff($horaAtual);
    $horas = $diff->h + ($diff->days * 24);
    $minutos   = $diff->i;
    $intevalo = "{$horas}:{$minutos}:00";
    return $intevalo;

}