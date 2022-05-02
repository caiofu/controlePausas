<?php
    function IntervaloHoras($inicio, $termino)
    {
        $inicio     = date_create_from_format('H:i:s',$inicio );
        $termino    = date_create_from_format('H:i:s',$termino );


        //Resultado do calculo de horas
        $intervalo =$inicio->diff($termino);
        $intervalo = $intervalo->format('%H:%I:%S');
        return $intervalo;
    }

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
    function CalculaAtraso($inicio, $termino, $limite)
    {
            $intervalo = IntervaloHoras($inicio, $termino);

            if(strtotime($intervalo) >  strtotime($limite))
            {
                return 'Atraso';
            }
            else
            {
                return  'Sem atraso';
            }


    }
