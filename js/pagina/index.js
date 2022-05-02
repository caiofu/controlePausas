function VerificaLogin()
{
    let usuario = document.getElementById("usuario").value;
    let senha   = document.getElementById("senha").value;

    //Verifica campos vazios
    if (usuario == "" || senha == "")
    {
        console.log("preencher campos")
    }
    else
    {
        var campos = new FormData();
        campos.append("usuario", usuario);
        campos.append("senha", senha);

        $.ajax({
            url: "paginas/verificaLogin.php",
            type: "POST",
            data: campos,
            contentType: false,
            processData: false,
            success: function(resposta)
            {
                console.log(resposta)
                document.getElementById('formLogin').style.display = 'none';
                document.getElementById('carregandoLogin').style.display = 'block';

                setTimeout(function()
                {
                    if (resposta == "logado")
                    {
                        /*
                        document.getElementById("msgLogin").style.display = 'none';
                        document.getElementById('carregandoLogin').style.display = 'none';
                        document.getElementById('formLogin').style.display = 'block'; */

                        window.location.href = "/controlePausas/paginas/dashboard.php";
                    }
                    else
                    {
                        document.getElementById('carregandoLogin').style.display = 'none';
                        document.getElementById('formLogin').style.display = 'block';
                        document.getElementById("msgLogin").style.display = 'block';
                    }

                },1500);

            }
        });
    }
}

function CadastraFuncionario()
{
    let nomeCompleto        = document.getElementById("nomeCompleto");
    let tipoUsuario         = document.getElementById("tipoUsuario");
    let usuarioM            = document.getElementById("usuarioM");
    let senhaM              = document.getElementById("senhaM");
    let confirmaSenhaM      = document.getElementById('confirmaSenhaM');

    if (nomeCompleto.value != "" && tipoUsuario.value != "" && usuarioM.value != "" && senhaM.value != "" && confirmaSenhaM.value != "")
    {

        nomeCompleto.style.borderColor = "";
        tipoUsuario.style.borderColor = "";
        usuarioM.style.borderColor = "";
        senhaM.style.borderColor = "";
        confirmaSenhaM.style.borderColor = "";
        document.getElementById("msgCamposPrencher").style.display = "none";

        //Verifica se senha e confirma senha são iguais
        if (senhaM.value == confirmaSenhaM.value)
        {

            $('#modalRegistro').modal('hide'); //Fecha modal

            var campos = new FormData();
            campos.append("nomeCompleto", nomeCompleto.value);
            campos.append("tipoUsuario", tipoUsuario.value);
            campos.append("usuario", usuarioM.value);
            campos.append("senha", senhaM.value);

            $.ajax({
                url: "../paginas/cadastraFuncionario.php",
                type: "POST",
                data: campos,
                contentType: false,
                processData: false,
                success: function (resposta)
                {
                    console.log(resposta)
                    let timerInterval
                    Swal.fire({
                        title: 'Cadastrando',
                        html: 'Aguarde um instante...',
                        timerProgressBar: true,
                        allowOutsideClick: false,
                        timer: 3500,
                        didOpen: () => {
                            Swal.showLoading()

                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer)
                        {
                            if (resposta > 0)
                            {
                                $('#modalRegistro').on('hidden', function() {
                                    $(':input', this).val('');
                                });

                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Cadastrado com sucesso',
                                    allowOutsideClick: false,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                            else
                            {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    allowOutsideClick: false,
                                    text: 'Usuário ja cadastrado!'
                                })
                            }
                        }
                        else
                        {

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                allowOutsideClick: false,
                                text: 'Não foi possivel cadastrar!'
                            })
                        }
                    })
                }
            });

            //Zerando campos
            nomeCompleto.value = "";
             tipoUsuario.value = "";
             usuarioM.value = "";
             senhaM.value = "";
             confirmaSenhaM.value = "";

        }
        else
        {
            senhaM.style.borderColor = "red";
            confirmaSenhaM.style.borderColor = "red";
            document.getElementById("smallMsg").innerHTML = "Senha e confirmar senha não são iguais!"
            document.getElementById("msgCamposPrencher").style.display = "block";
        }
    }
    else
    {
        nomeCompleto.style.borderColor = "red";
        tipoUsuario.style.borderColor = "red";
        usuarioM.style.borderColor = "red";
        senhaM.style.borderColor = "red";
        confirmaSenhaM.style.borderColor = "red";

        document.getElementById("smallMsg").innerHTML = "Você deve preencher todos os campos!"
        document.getElementById("msgCamposPrencher").style.display = "block";

    }


}

function  AlterarSenha()
{
    let novaSenha                       = document.getElementById('novaSenha');
    let confirmarNovaSenha              = document.getElementById('confirmarNovaSenha');
    let smallMsgAlterarSenha            = document.getElementById('smallMsgAlterarSenha');
    let msgCamposPrencherAlteraSenha    = document.getElementById('msgCamposPrencherAlteraSenha');

    if(novaSenha.value != "" && confirmarNovaSenha.value != "")
    {
        novaSenha.style.borderColor = "";
        confirmarNovaSenha.style.borderColor = "";
        msgCamposPrencherAlteraSenha.style.display = "none";

        if (novaSenha.value == confirmarNovaSenha.value)
        {
            $('#modalAlterarSenha').modal('hide'); //Fecha modal

            var campos = new FormData();
            campos.append("novaSenha", novaSenha.value);


            $.ajax({
                url: "../paginas/alterarSenha.php",
                type: "POST",
                data: campos,
                contentType: false,
                processData: false,
                success: function (resposta) {
                    let timerInterval
                    Swal.fire({
                        title: 'Alerando senha',
                        html: 'Aguarde um instante...',
                        timerProgressBar: true,
                        allowOutsideClick: false,
                        timer: 3500,
                        didOpen: () => {
                            Swal.showLoading()

                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer)
                        {
                            if (resposta == 1)
                            {
                              /*  $('#modalRegistro').on('hidden', function() {
                                    $(':input', this).val('');
                                });*/

                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Senha alterada com sucesso',
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                    timer: 1500
                                })
                            }
                        }
                        else
                        {

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                allowOutsideClick: false,
                                text: 'Não foi possivel cadastrar!'
                            })
                        }
                    })
                }
            });
        }
        else
        {
            novaSenha.style.borderColor = "red";
            confirmarNovaSenha.style.borderColor = "red";
            msgCamposPrencherAlteraSenha.style.display = "block";
            smallMsgAlterarSenha.innerHTML = "Nova senha e confirma senha não são iguais !"
        }

    }
    else
    {
        novaSenha.style.borderColor = "red";
        confirmarNovaSenha.style.borderColor = "red";
        msgCamposPrencherAlteraSenha.style.display = "block";
        smallMsgAlterarSenha.innerHTML = "Você deve preencher todos os campos !"
    }
}



