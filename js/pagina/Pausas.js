var btnInicio   = document.getElementById("btnInicio");
var btnTermino  = document.getElementById("btnTermino");
var inicoContador
let segundos = 0;
let minutos = 0;
let horas   = 0;

$( document ).ready(function() {
    const urlParametro = new URLSearchParams(window.location.search);
    const parametro = urlParametro.get('tempoReal');

    if (parametro != 1)
    {
        //Colocando valores no contador caso usuario seja desconectado e nao finalize  a contagem
        let intervaloHoras = document.getElementById("intervaloHoras").value;
        let intervaloSeparado = intervaloHoras.split(":");

        if(intervaloHoras != 0)
        {
            btnInicio.style.display = "none"
            btnTermino.style.display = "inline-block"
            document.getElementById('contador').style.display = "block";

            console.log(intervaloHoras+'--'+ intervaloSeparado[0])
            horas       = intervaloSeparado[0];
            minutos     = intervaloSeparado[1];
            segundos    = intervaloSeparado[2];

            document.getElementById('minuto').innerHTML=minutos
            document.getElementById('hora').innerHTML=horas
            document.getElementById('segundos').innerHTML=segundos

            inicoContador = setInterval(function(){ segundo() },1000);

        }
    }
    else if (parametro == 1)
    {
        PausasEmTempoReal();
    }



});

//Inicio do contador
 function InicioContador ()
{
    var data = new Date();
    let idTipoPausa = document.getElementById("tipoPausa");


    if (idTipoPausa.value == "")
    {
        idTipoPausa.style.borderColor= 'red';
        document.getElementById('msgTipoPausa').style.display = 'block'
    }
    else
    {
        document.getElementById('msgTipoPausa').style.display = 'none'
        document.getElementById("tipoPausa").style.borderColor= '';
        btnInicio.style.display = "none"
        btnTermino.style.display = "inline-block"

        if(!inicoContador)
        {
            var horaAtual    = data.getHours();
            var minAtual     = data.getMinutes();
            var segAtual     = data.getSeconds();
            var tempoInicio = horaAtual+':'+minAtual+':'+segAtual;


            var campos = new FormData();

            campos.append("horarioInicio", tempoInicio);
            campos.append("idTipoPausa", idTipoPausa.value);
            campos.append("pausa", "inicio");

            $.ajax({
                url: "../paginas/registraPausa.php",
                type: "POST",
                data: campos,
                contentType: false,
                processData: false,
                success: function(resposta)
                {

                    if(resposta != 0)
                    {
                        document.getElementById('contador').style.display = "block";
                        document.getElementById('idUltimoRegistro').setAttribute('value', resposta)

                        inicoContador = setInterval(function(){ segundo() },1000);
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Pausa iniciada!',
                            showConfirmButton: false,
                            timer: 2500,
                            allowOutsideClick: false,
                            timerProgressBar: true
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                console.log('Fechando a janela')
                            }
                        })
                    }
                    else
                    {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            allowOutsideClick: false,
                            text: 'Algo deu errado ao finalzar sua pausa!'
                        })
                    }
                }
            });

        }
    }

}

//Termino do Contador
function TerminoContador()
{
    var data = new Date();
    btnInicio.style.display = "inline-block"
    btnTermino.style.display = "none"
    segundos = 0;
    minuto = 0;
    horas = 0;

    let horaAtual    = data.getHours();
    let minAtual     = data.getMinutes();
    let segAtual     = data.getSeconds();
    let tempoTermino = horaAtual+':'+minAtual+':'+segAtual;

    let idUltimoRegistro = document.getElementById('idUltimoRegistro').value;

 let campos = new FormData();

    campos.append("horarioTermino", tempoTermino);
    campos.append("idUltimoRegistro", idUltimoRegistro);
    campos.append("pausa", "termino");

    $.ajax({
        url: "../paginas/registraPausa.php",
        type: "POST",
        data: campos,
        contentType: false,
        processData: false,
        success: function(resposta)
        {
            console.log(resposta)
            if(resposta != 0)
            {
                document.getElementById('contador').style.display = "none";
                clearInterval(inicoContador);
                inicoContador= null;

                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Pausa finalizada!',
                    showConfirmButton: false,
                    timer: 2500,
                    allowOutsideClick: false,
                    timerProgressBar: true
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = "../paginas/dashboard.php";
                    }
                })



            }
            else
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    allowOutsideClick: false,
                    text: 'Algo deu errado ao finalzar sua pausa!'

                })
            }
        }
    });

}



function segundo()
{

    //incrementa os segundos
    segundos++;
    if(segundos==60){
        //incrementa os minutos
        minutos++;
        //Zerar os segundos
        segundos=0;
        //escreve os minutos
        document.getElementById('minuto').innerHTML=minutos
    }

    if(minutos == 60)
    {
        horas++;
        minutos = 0;
        document.getElementById('hora').innerHTML=horas
    }
    //escreve os segundos
    document.getElementById('segundos').innerHTML=segundos


}

function PausasEmTempoReal()
{
    RequisicaoPausaEmAberto();

    setInterval(function()
    {
        RequisicaoPausaEmAberto();
    }, 60000);
}

function RequisicaoPausaEmAberto()
{
    console.log('caio')
    var horaAtual = new Date();
    document.getElementById('ultimaAtt').innerHTML  =  horaAtual.getHours()+":"+horaAtual.getMinutes();
   document.getElementById('tablePausas').innerHTML = ""//resetando
    $.ajax({
        url: "../paginas/buscaPausasTempoReal.php",
        type: "POST",

        success: function (retorno)
        {

            let dados = JSON.parse(retorno);

            if (dados.length > 0)
            {
                document.getElementById('tablePausasHead').style.display = "table";

               for (let i =0; i < dados.length; i++)
                {
                    document.getElementById('tablePausas').innerHTML += "<tr style='text-align: center; font-size: 14px;'>" +
                           "<td "+dados[i].bordaEstilo+" style='"+dados[i].corDeFundo+"'>"+dados[i].nomeTipoPausa+"</td>" +
                        "<td style='"+dados[i].corDeFundo+"'>"+dados[i].nomeCompleto+"</td>" +
                        "<td style='"+dados[i].corDeFundo+"'>"+dados[i].horarioInicio+"</td>" +
                        "<td style='"+dados[i].corDeFundo+"'>"+dados[i].tempoDecorrido+"</td>" +
                        "<td style='"+dados[i].corDeFundo+"'>"+dados[i].tempoLimite+"</td>" +
                        "<td style='"+dados[i].corDeFundo+"'>"+dados[i].respostaAtraso+"</td>" +
                               "</tr> "+
                    "<tr><td colspan='5'></td></tr>";
                }
            }
            else
            {
                document.getElementById('tablePausasHead').style.display = "none";
            }

        }

    });
}
