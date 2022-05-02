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
        <div style="text-align: center; color: white; font-weight: bold;">Todas minhas pausas</div>
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

                            <div class="col-3">

                                <label for="data">Data:</label>
                                <input type="date" class="input-data" id="dataPausa">
                            </div>
                            <div class="col-3">
                                <!-- Botao iniciar -->
                                <a href="#" class="btn btn-success btn-icon-split" id="btnInicio" onclick="BuscaMinhasPausas();">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-search"></i>
                                                        </span>
                                    <span class="text">Buscar Registros</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Todas as pausas -->
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div  class="card-header py-3 d-flex flex-row align-items-center justify-content-between" id="divMinhasPausasHeader" style="display: none !important;">
                <h6 class="m-0 font-weight-bold text-primary">Minhas Pausas</h6>

                <span class="font-weight-bold  text-primary">Total de Pausas: <span id="nTotalPausas"></span></span>
            </div>
            <!-- Card Body -->
            <div id="divTodasMinhasPausas">

            </div>

        </div>
    </div>
</div>