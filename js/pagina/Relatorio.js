function BuscaDados()
{
    let idUsuario       = document.getElementById('funcionario');
    let dataInicial     = document.getElementById('dataInicial');
    let dataFinal       = document.getElementById('dataFinal');
    let tableRegistros  = document.getElementById('tableRegistros');
    let checkbox = document.getElementById("pesquisaDetalhada");
    let selectTipoPausa = document.getElementById('selectTipoPausa');


    if (dataInicial.value != "" && dataFinal.value != "")
    {
        if (checkbox.checked && selectTipoPausa.value == "" )
        {
            selectTipoPausa.style.borderColor = "red";
        }
        else {

            dataInicial.style.borderColor = '';
            dataFinal.style.borderColor = '';
            document.getElementById('msgRelatorio').style.display = 'none';

            let campos = new FormData();

            campos.append("dataInicial", dataInicial.value);
            campos.append("dataFinal", dataFinal.value);
            campos.append("idUsuario", idUsuario.value);

            if(selectTipoPausa.value != "")
            {
                campos.append("tipoPausa", selectTipoPausa.value);
            }


            $.ajax({
                url: "../paginas/buscaRegistros.php",
                type: "POST",
                data: campos,
                contentType: false,
                processData: false,
                success: function (resposta) {
                    tableRegistros.innerHTML = "" //Resetando
                    if (resposta != 0) {
                        let dados = JSON.parse(resposta);
                        console.log(dados)

                        //Monta cabeçalho
                        if(selectTipoPausa.value != "")
                        {
                            document.getElementById('tableTheadRegistros').innerHTML = "  <th>Data</th>" +
                                "                    <th>Nome</th>" +
                                "                    <th>Tipo de Pausa</th>" +
                                "                    <th>Qtd. Pausas</th>" +
                                "                    <th>Total de horas</th>";
                        }
                        else
                        {
                            document.getElementById('tableTheadRegistros').innerHTML = "  <th>Data</th>" +
                                "                    <th>Nome</th>" +
                                "                    <th>Qtd. Pausas</th>" +
                                "                    <th>Total de horas</th>";
                        }
                        var contaTotalPausas = 0;
                        for (let i = 0; i < dados.length; i++)
                        {
                            if(selectTipoPausa.value != "")
                            {
                                tableRegistros.innerHTML += "<tr>" +
                                    "<td>" + dados[i].dataRegistro + "</td>" +
                                    "<td>" + dados[i].nomeCompleto + "</td>" +
                                    "<td>" + dados[i].nomeTipoPausa + "</td>" +
                                    "<td>" + dados[i].ContaPausa + "</td>" +
                                    "<td>" + dados[i].totalHoras + "</td>" +
                                    "</tr>"
                            }
                            else
                            {
                                tableRegistros.innerHTML += "<tr>" +
                                    "<td>" + dados[i].dataRegistro + "</td>" +
                                    "<td>" + dados[i].nomeCompleto + "</td>" +
                                    "<td>" + dados[i].ContaPausa + "</td>" +
                                    "<td>" + dados[i].totalHoras + "</td>" +
                                    "</tr>"
                            }

                            contaTotalPausas = parseInt(contaTotalPausas) + parseInt(dados[i].ContaPausa);
                            
                        }
                        tableRegistros.innerHTML += "<tr><td colspan='4' style='font-weight: bold; text-align: center;'>TOTAL DE PAUSAS: "+contaTotalPausas+"</td></tr>"



                    } else {
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
    else

    {
        dataInicial.style.borderColor   = 'red';
        dataFinal.style.borderColor     = 'red';
        document.getElementById('msgRelatorio').style.display = 'block';
    }


}

function AtivaPesquisaDetalhada()
{
    let checkbox = document.getElementById("pesquisaDetalhada");


    if (checkbox.checked)
    {
        document.getElementById('divTipoPausa').style.display = "block";
    }
    else
    {
        document.getElementById('divTipoPausa').style.display = "none";
        document.getElementById('selectTipoPausa').value = "";
    }
}