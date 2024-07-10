<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Pausas</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/pagina/index.css">
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 60px;">
            <div class="col-md-4 col-sm-12" style="border: 1px solid grey; border-radius: 20px; padding: 30px;">
                <div class="titulo-login" style="text-align: center;">
                    <span>Controle de Pausas</span>
                </div>
                <hr>

                    <div class="mb-3">
                      <label for="usuario" class="form-label">Usuário</label>
                      <input type="text" class="form-control" id="usuario" aria-describedby="usuario">
                      <!--<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>-->
                    </div>
                    <div class="mb-3">
                      <label for="senha" class="form-label">Senha</label>
                      <input type="password" class="form-control" id="senha">
                    </div>
              
                    <button type="button" onclick="VerificaLogin();" class="btn btn-primary">Entrar</button>

            </div>
        </div>
    </div>
    <script src="js/pagina/index.js"></script>
    <script src="js/pagina/jquery-3.6.0.min.js"></script>
</body>
</html>