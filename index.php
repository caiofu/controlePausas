<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Controle de Pausa</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="css/pagina/index.css">
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-8 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5" style="min-height: 308px; display: none;" id="carregandoLogin">
                                    <div align="center" style="margin-top: 70px;">
                                        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">

                                        </div>
                                        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">

                                        </div>
                                        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">

                                        </div>
                                    </div>
                                </div>
                                <div class="p-5" id="formLogin">


                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Controle de Pausa</h1>
                                    </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="usuario" 
                                                placeholder="Usuário">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" id="senha" class="form-control form-control-user"
                                                id="senha" placeholder="Senha">
                                        </div>
                                        
                                        <a  class="btn btn-primary btn-user btn-block" onclick="VerificaLogin();">
                                            Entrar
                                        </a>
                                        <hr>
                                        <div style="background-color: red; text-align: center; display: none;" id="msgLogin"><small style="font-weight: bold; color: white;" >Não foi possivel entrar!</small></div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script>
        //Usuario login
        document.getElementById('usuario').addEventListener('keyup', (ev) => {
            const input = ev.target;
            input.value = input.value.toUpperCase();
        });
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.js"></script>

    <script src="js/pagina/index.js"></script>

</body>

</html>