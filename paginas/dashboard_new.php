<?php
include "../classes/Autoload.php";
include "../paginas/Funcoes.php";
    session_start();
    if($_SESSION['cp_logado'] != 1)
    {
        header('Location:http://localhost/controlePausas/index.php ');
    }
    date_default_timezone_set('America/Sao_Paulo');

  
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Controle de Pausas - Dashboard</title>
    <link rel="stylesheet" href="../css/pagina/index.css">
    <!-- Custom fonts-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


    <!-- Custom styles-->
    <link href="../css/sb-admin-2.css" rel="stylesheet">

    <!-- Sweet Alert -->
    <script src="../js/sweetalert2.js"></script>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="">
                        <img src="../imagens/icone.png" width="50" alt="">
                    </i>
                </div>
                <div class="sidebar-brand-text mx-3">Controle De Pausas</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <i class="fa fa-home"></i>
                    <span>Home</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Recursos
            </div>

            <!-- Nav Item - Todas Minhas Pausas -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="todasMinhasPausas.php" onclick="$('#conteudo').load(this.href); return false;" >
                    <i class="fas fa-fw fa-table"></i>
                    <span>Todas Minhas pausas</span>
                </a>
            </li>

            <!-- Administrador -->
            <?php
                if( $_SESSION['cp_tipoUsuario'] == 1)
                {

                    echo '<li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="modal" data-target="#modalRegistro" >
                                <i class="fas fa-fw fa-id-card"></i>
                                <span>Cadastrar Funcionario</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="dashboard.php?tempoReal=1"   >
                                <i class="fas fa-fw fa-clock"></i>
                                <span>Pausas Tempo Real</span>
                            </a>
                        </li>';?>
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="relatorios.php"   onclick="$('#conteudo').load(this.href); return false;" >
                                <i class="fas fa-fw fa-table"></i>
                                <span>Relatórios</span>
                            </a>
                        </li>';
            <?php    }
            ?>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Opções
            </div>

            <!-- Nav Item - Alterar Senha-->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="modal" data-target="#modalAlterarSenha" >
                    <i class="fas fa-fw fa-edit"></i>
                    <span>Alterar Senha</span>
                </a>

            </li>

            <!-- Nav Item - Sair -->
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw"></i>
                    <span>Sair</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>



                    <!-- Barra Top Nav -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav - Informações do Usuário -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['cp_nomeUsuario']; ?></span>
                                <i class="fa fa-2x fa-user-circle "></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <!--<a class="dropdown-item" href="#">
                                   <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                   Profile
                               </a>
                               <a class="dropdown-item" href="#">
                                   <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                   Settings
                               </a>
                               <a class="dropdown-item" href="#">
                                   <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                   Activity Log
                               </a>-->
                               <div class="dropdown-divider"></div>
                               <a class="dropdown-item" href="logout.php" >
                                   <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                   Sair
                               </a>
                           </div>
                       </li>
                   </ul>

               </nav>
               <!-- End of Topbar -->

                <!-- CONTEUDO PRINCIPAL -->
                <div class="container-fluid" id="conteudo">

                    <!-- BOX PAUSAS TEMPO REAL -->
                    <?php
                        if ($_GET['tempoReal'] == 1)
                        {
                    ?>
                            <div class="col-xl-12 col-lg-12">
                                <div class="card shadow mb-4">
                                    <div
                                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Pausas em tempo real</h6>

                                        <span class="font-weight-bold  text-primary">Ultima atualizacao: <span style="margin-left: 5px;" id="ultimaAtt"></span></span>
                                    </div>
                                    <!-- Card Body -->

                                    <div id="boxPausas">
                                        <div style="text-align: center;"><small>Atualizado a cada 1 minuto</small></div>
                                        <table class="table tablePausas" id="tablePausasHead" style="display: none;">
                                            <thead>
                                                <tr>
                                                 <th>Pausa</th>
                                                 <th>Nome completo</th>
                                                 <th>Horário de Inicio</th>
                                                 <th>Tempo decorrido</th>
                                                 <th>Tempo limite</th>
                                                 <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tablePausas">

                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                            </div>
               <?php    }
                        else
                        {

                    ?>

                    <!-- BOX REGISTRAR PAUSA-->
                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Registrar Pausa
                                            </div>
                                            <hr>
                                            <div class="row">

                                                <div class="col-md-3 col-sm-6" style="margin-bottom: 7px;">
                                                    <?php
                                                    // CRIAR UMA VERIFICAÇAO PARA VOLTAR CONTADOR CASO A SESSAO TENHA EXPIRADO
                                                    $dataAtual = date("Y-m-d");
                                                    $RegistroPausa = new RegistroPausas();
                                                    @$RegistroPausa->select("*","idUsuario={$_SESSION['cp_idUsuario']} AND horarioTermino = 0 ORDER BY idRegistroPausas DESC LIMIT 1 ");
                                                    @$RegistroPausa->contaRegistros("idUsuario={$_SESSION['cp_idUsuario']}  AND horarioTermino = 0 ORDER BY idRegistroPausas DESC LIMIT 1");

                                                    if ($RegistroPausa->getQtdRegistros() > 0)
                                                    {

                                                        $inicio = date_create_from_format('H:i:s',$RegistroPausa->getHorarioInicio() );
                                                        $termino = new DateTime();

                                                        //Resultado do calculo de horas
                                                        $intervalo =$inicio->diff($termino);
                                                        $intervalo = $intervalo->format('%H:%I:%S');

                                                        $idUltimoRegistroPausa = $RegistroPausa->getIdRegistroPausas();
                                                        $desabilitaSelectOption = "disabled";
                                                    }

                                                    ?>

                                                    <select name="tipoPausa" id="tipoPausa" class="form-control" <?php echo $desabilitaSelectOption; ?>>
                                                        <option value="" disabled selected style="background-color: #b0b0b0">Selecione o tipo da pausa</option>
                                                        <?php


                                                         //OPTIONS DO INPUT SELECT TIPO DE PAUSA
                                                            $TipoPausas = new TipoPausas();
                                                            $TipoPausas->select("*");

                                                            while($resultado = $TipoPausas->getBusca()->fetch(PDO::FETCH_ASSOC))
                                                            {
                                                                $tempoLimite = date('H:i:s', strtotime($resultado['tempoLimite']));
                                                                //Caso esteja em aberto ainda
                                                                if($RegistroPausa->getIdTipoPausa() == $resultado['idTipoPausas'])
                                                                {
                                                                    echo "<option value='{$resultado["idTipoPausas"]}' selected>{$resultado["nomeTipoPausas"]}  --- {$tempoLimite} </option>";
                                                                }
                                                                else
                                                                {
                                                                    echo "<option value='{$resultado["idTipoPausas"]}'>{$resultado["nomeTipoPausas"]}  --- {$tempoLimite} </option>";
                                                                }

                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 col-sm-6">
                                                    <!-- Botao iniciar -->
                                                    <a href="#" class="btn btn-success btn-icon-split" id="btnInicio" onclick="InicioContador();">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-check"></i>
                                                        </span>
                                                        <span class="text">Iniciar Pausa</span>
                                                    </a>

                                                    <!-- Botao termino-->
                                                    <a href="#" class="btn btn-danger btn-icon-split" id="btnTermino" onclick="TerminoContador();" style="display: none; margin-bottom: 7px;">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-calendar-check"></i>
                                                        </span>
                                                        <span class="text">Finalizar Pausa</span>
                                                    </a>


                                                    <!-- Campos para passar valores -->
                                                    <input type="hidden" value="<?php echo @$intervalo; ?>" id="intervaloHoras">
                                                    <input type="hidden" value="<?php echo @$idUltimoRegistroPausa; ?>" id="idUltimoRegistro">
                                                </div>
                                                <div class="col-md-3 col-sm-6 contador" id="contador">

                                                    <span id="hora">00</span><span>:</span><span id="minuto">00</span><span>:</span><span id="segundos">00</span>
                                                </div>
                                            </div>
                                            <div>
                                                <small style="color: red; display: none; " id="msgTipoPausa">Você não selecionou o tipo da pausa</small>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BOX MINHAS PAUSAS -->

                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Minhas Pausas</h6>
                                    <?php
                                      $CarregaRegistros = new DadosRegistroPausaVIEW();
                                      $CarregaRegistros->contaRegistros("dataRegistro='{$dataAtual}' AND idUsuario = {$_SESSION['cp_idUsuario']}");
                                      ?>
                                    <span class="font-weight-bold  text-primary">Total de Pausas: <?php echo $CarregaRegistros->getQtdRegistros(); ?></span>
                                </div>
                                <!-- Card Body -->

                                            <?php
                                                //Carrega registro de pausas
                                                $CarregaRegistros = new DadosRegistroPausaVIEW();

                                                $CarregaRegistros->select("*","dataRegistro='{$dataAtual}' AND idUsuario = {$_SESSION['cp_idUsuario']} AND horarioTermino > 0","idRegistroPausas DESC");
                                                    if ($CarregaRegistros->getIdRegistroPausas() != 0)
                                                    {
                                                        while($resultado = $CarregaRegistros->getBusca()->fetch(PDO::FETCH_ASSOC))
                                                        {
                                                          $intervaloHoras =   IntervaloHoras($resultado['horarioInicio'], $resultado['horarioTermino']);
                                                          $respostaAtraso = CalculaAtraso($resultado['horarioInicio'], $resultado['horarioTermino'], $resultado['tempoLimite']);
                                                            if($respostaAtraso == 'Atraso')
                                                            {
                                                                $bordaEstilo = "border-left-danger";
                                                                $corDeFundo  = "  background-color:#f95b4f2e  ;";
                                                                $bordaTd = "style='border-right: 1px solid #e74a3b'";
                                                            }
                                                            else if($respostaAtraso == 'Sem atraso')
                                                            {
                                                                $bordaEstilo = "border-left-success";
                                                                $corDeFundo  = "  background-color:#4caf502b  ;";
                                                                $bordaTd = "style='border-right: 1px solid #1cc88a;'";
                                                            }

                                                            echo "<div class='card-body' style='padding: 0.6rem !important;'>
                                                                    <div class='card mb-12  {$bordaEstilo}'>
                                                                        <div class='card-body' id='divMeusRegistros' style='padding: 0 !important; {$corDeFundo}'>
                                                                            <table class='tbMinhasPausas '>
                                                                               
                                                                                <tr>
                                                                                    <td {$bordaTd}><span>Pausa:</span>{$resultado['nomeTipoPausas']}</td>
                                                                                    <td {$bordaTd}><span>Horário de Inicio</span>{$resultado['horarioInicio']}</td>
                                                                                    <td {$bordaTd}><span>Horário de Término</span>{$resultado['horarioTermino']}</td>
                                                                                    <td {$bordaTd}><span>Total tempo</span>{$intervaloHoras}</td>
                                                                                    <td {$bordaTd}><span>{$respostaAtraso}</span></td>
                                                                                </tr>
                                                                                   </table>
                                                                        </div>
                                                                    </div>
                                                                </div>";
                                                        }

                                                    }
                                                    else
                                                    {
                                                        echo "<div style='text-align: center;padding: 10px'>Nenhum registro de pausa até o momento</div>";
                                                    }

                                            ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Hospital de Amor</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Modal CADASTRAR FUNCIONARIO-->
    <div class="modal fade" id="modalRegistro" data-backdrop="static" tabindex="-1" aria-labelledby="modalRegistroLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar Funcionário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="nomeCompleto" placeholder="Nome completo">
                                </div>
                                <div class="form-group">
                                    <select name="tipoUsuario" id="tipoUsuario" class="form-control" <?php echo $desabilitaSelectOption; ?>>
                                        <option value="" disabled selected style="background-color: #b0b0b0">Selecione o tipo de Usuario</option>
                                        <?php


                                        //OPTIONS DO INPUT SELECT TIPO DE USUARIO
                                        $TipoUsuarios = new TipoUsuario();

                                        $TipoUsuarios->select("*");

                                        while($resultado = $TipoUsuarios->getBusca()->fetch(PDO::FETCH_ASSOC))
                                        {
                                            echo "<option value='{$resultado["idTipoUsuario"]}'>{$resultado["nomeTipoUsuario"]} </option>";

                                        }
                                        ?>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="usuarioM" placeholder="Usuário" >
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="senhaM" placeholder="Senha">
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="confirmaSenhaM" placeholder="Confirmar Senha">
                                </div>
                              <div style="text-align: center; color: white; font-weight: bold; background-color: red; display: none;" id="msgCamposPrencher">
                                  <small style="font-weight: bold;" id="smallMsg" ></small>
                              </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onclick="CadastraFuncionario();">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal ALTERAR SENHA-->
    <div class="modal fade" id="modalAlterarSenha" data-backdrop="static" tabindex="-1" aria-labelledby="modalAlterarSenhaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Alterar Senha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12">

                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="novaSenha" placeholder="Senha">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="confirmarNovaSenha" placeholder="Confirmar nova senha">
                            </div>


                            <div style="text-align: center; color: white; font-weight: bold; background-color: red; display: none;" id="msgCamposPrencherAlteraSenha">
                                <small style="font-weight: bold;" id="smallMsgAlterarSenha" ></small>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onclick="AlterarSenha();">Alterar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        //Passar para letra maiuscula
        //-------------------------------------
        //Usuario
        document.getElementById('usuarioM').addEventListener('keyup', (ev) => {
            const input = ev.target;
            input.value = input.value.toUpperCase();
        });
        //Nome Completo
        document.getElementById('nomeCompleto').addEventListener('keyup', (ev) => {
            const input = ev.target;
            input.value = input.value.toUpperCase();
        });
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.js"></script>

    <script src="../js/pagina/Pausas.js"></script>
    <script src="../js/pagina/Relatorio.js"></script>
    <script src="../js/pagina/TodasMinhasPausas.js"></script>
    <script src="../js/pagina/index.js"></script>
    <!-- Data Table -->
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>




</body>

</html>