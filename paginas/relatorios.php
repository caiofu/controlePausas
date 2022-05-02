<!-- Todas as minhas pausas -->
<?php
include "../classes/Autoload.php";
include "../paginas/Funcoes.php";
session_start();
$dataAtual = date("Y-m-d");
?>

<div class="row">
    <div class="col-xl-12 col-md-12 mb-4">
        <div class="card  shadow h-100 py-2 bg-gradient-primary">
            <div style="text-align: center; color: white; font-weight: bold;">Relatórios</div>
        </div>
    </div>
</div>

<!-- Filtro -->
<div class="row">
    <div class="col-xl-12 col-md-12 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Filtro de busca
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <label for="funcionario">Funcionario</label>
                                <select name="funcidonario" id="funcionario" class="form-control">
                                    <option value="0">Todos</option>
                                    <?php
                                        $Usuarios = new Usuarios();
                                        $Usuarios->select("*","idTipoUsuario = 2");

                                    while($resultado = $Usuarios->getBusca()->fetch(PDO::FETCH_ASSOC))
                                    {
                                      echo "<option value='{$resultado['idUsuario']}'>{$resultado['nomeCompleto']}</option>";
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="col-2">

                                <label for="data">Data Inicial:</label>
                                <input type="date" id="dataInicial" class="form-control">
                            </div>

                            <div class="col-2">

                                <label for="data">Data Final:</label>
                                <input type="date" id="dataFinal" class="form-control">
                            </div>
                            <div class="col-3" style=" margin-top: 30px;">
                                <!-- Botao iniciar -->

                                <a href="#" class="btn btn-success btn-icon-split" id="btnInicio" onclick="BuscaDados();" >
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-search"></i>
                                                        </span>
                                    <span class="text">Buscar Registros</span>
                                </a>
                            </div>


                            <div id="msgRelatorio" style="margin-top: 16px; background-color: red; width: 100%; text-align: center; display: none;"><small style="color: white; font-weight: bold; ">Escolha uma data inicial e final!</small></div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-4">
                    <input type="checkbox" id="pesquisaDetalhada" value="1" onchange="AtivaPesquisaDetalhada();"> Pesquisa detalhada
                </div>

                <div class="col-4" id="divTipoPausa" style="display: none;">
                    <br>
                    <select class="form-control" name="selectTipoPausa" id="selectTipoPausa">
                        <option value="" disabled selected>Selecione um tipo de pausa</option>
                       <?php
                        $TiposPausa = new TipoPausas();
                        $TiposPausa->select("*");
                       while($resultado = $TiposPausa->getBusca()->fetch(PDO::FETCH_ASSOC))
                       {
                           echo "<option value='{$resultado['idTipoPausas']}'>{$resultado['nomeTipoPausas']}</option>";
                       }
                       ?>
                    </select>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Todas as pausas -->
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Minhas Pausas</h6>

                <span class="font-weight-bold  text-primary">Total de Pausas:</span>
            </div>
            <!-- Card Body -->

                <table id="registros" class="table table-bordered ">
                    <thead id="tableTheadRegistros">

                    </thead>
                    <tbody id="tableRegistros">

                    </tbody>
                </table>
        </div>
    </div>
</div>
