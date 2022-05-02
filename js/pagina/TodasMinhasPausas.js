function  BuscaMinhasPausas()
{
    let dataPausa = document.getElementById('dataPausa');

    if (dataPausa.value != "")
    {
        dataPausa.style.borderColor = "";
        let campos = new FormData();

        campos.append("dataPausa", dataPausa.value);


        $.ajax({
            url: "../paginas/buscaMinhasPausas.php",
            type: "POST",
            data: campos,
            contentType: false,
            processData: false,
            success: function (resposta) {
                document.getElementById('divTodasMinhasPausas').innerHTML  = "" //Resetando
                if (resposta != 0) {
                    let dados = JSON.parse(resposta);
                    document.getElementById('divMinhasPausasHeader').style.display = 'block';
                    document.getElementById('nTotalPausas').innerHTML =  dados[0].qtdPausas;


                    for (let i = 0; i < dados.length; i++)
                    {
                        document.getElementById('divTodasMinhasPausas').innerHTML += "<div class='card-body' style='padding: 0.6rem !important;'>\n" +
                            "                                                                    <div class='card mb-12  "+dados[i].bordaEstilo+"'>\n" +
                            "                                                                        <div class='card-body' id='divMeusRegistros' style='padding: 0 !important; "+dados[i].corDeFundo+"'>\n" +
                            "                                                                            <table class='tbMinhasPausas '>\n" +
                            "                                                                               \n" +
                            "                                                                                <tr>\n" +
                            "                                                                                    <td "+dados[i].bordaTd+"><span>Pausa:</span>"+dados[i].nomeTipoPausa+"</td>\n" +
                            "                                                                                    <td "+dados[i].bordaTd+"><span>Horário de Inicio</span>"+dados[i].horarioInicio+"</td>\n" +
                            "                                                                                    <td "+dados[i].bordaTd+"><span>Horário de Término</span>"+dados[i].horarioTermino+"</td>\n" +
                            "                                                                                    <td "+dados[i].bordaTd+"><span>Total tempo</span>"+dados[i].intervaloHoras+"</td>\n" +
                            "                                                                                    <td "+dados[i].bordaTd+"}><span>"+dados[i].respostaAtraso+"</span></td>\n" +
                            "                                                                                </tr>\n" +
                            "                                                                                   </table>\n" +
                            "                                                                        </div>\n" +
                            "                                                                    </div>\n" +
                            "                                                                </div>"


                    }


                } else
                    {
                        document.getElementById('nTotalPausas').innerHTML =  0;
                        document.getElementById('divTodasMinhasPausas').innerHTML += "<div class='card-body' style='padding: 0.6rem !important;'>\n" +
                            "                                                                    <div class='card mb-12  '>\n" +
                            "                                                                        <div class='card-body' id='divMeusRegistros' style='padding: 0 !important; '>\n" +
                            "                                                                            <div style='text-align: center;'>Sem registros</div>" +
                            "                                                                        </div>\n" +
                            "                                                                    </div>\n" +
                            "                                                                </div>"
                }
            }
        });
    }
    else
    {
        dataPausa.style.borderColor = "red";
    }
}