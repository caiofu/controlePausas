<?php
    include "Autoload.php";

class TipoPausas
{
    private $idTipoPausas;
    private $nomeTipoPausas;
    private $tempoLimite;
    private $qtdRegistros;
    private $busca;
    private $campos;
    private $where;
    private $order;
    private $limite;

    public function __construct()
    {
        $this->config = new Config();
        $this->crud   = new Crud();
        $this->tabela = "tipopausas";
    }

    public function getIdTipoPausas()
    {
        return $this->idTipoPausas;
    }


    public function setIdTipoPausas($idTipoPausas)
    {
        $this->idTipoPausas = $idTipoPausas;
    }


    public function getNomeTipoPausas()
    {
        return $this->nomeTipoPausas;
    }


    public function setNomeTipoPausas($nomeTipoPausas)
    {
        $this->nomeTipoPausas = $nomeTipoPausas;
    }


    public function getTempoLimite()
    {
        return $this->tempoLimite;
    }

    public function setTempoLimite($tempoLimite)
    {
        $this->tempoLimite = $tempoLimite;
    }


    public function getQtdRegistros()
    {
        return $this->qtdRegistros;
    }


    public function setQtdRegistros($qtdRegistros)
    {
        $this->qtdRegistros = $qtdRegistros;
    }


    public function getBusca()
    {
        return $this->busca;
    }


    public function setBusca($busca)
    {
        $this->busca = $busca;
    }



    #### INSERT ####

    public function insert()
    {

        $this->crud->insert($campos = array('idTipoPausas'     => $this->idTipoPausas,
                                            'nomeTipoPausas'   => $this->nomeTipoPausas,
                                            'tempoLimite'      => $this->tempoLimite), $this->tabela,'','','');

        $busca     = $this->crud->select($campos = array("*"),$this->tabela,"","idTipoPausas DESC",'1');
        $resultado = $busca->fetchObject();


        // RESULTADOS
        $this->idTipoPausas        = $resultado->idTipoPausas;
        $this->nomeTipoPausas      = $resultado->nomeTipoPausas;
        $this->tempoLimite         = $resultado->tempoLimite;


    }

    #### SELECT ####

    public function select($campos,$where=null,$order=null,$limite=null,$group=null) {

        $this->campos = $campos;
        $this->where  = $where;
        $this->order  = $order;
        $this->limite = $limite;
        $this->group  = $group;

        $busca     = $this->crud->select($campos = array($this->campos),$this->tabela,$this->where,$this->order,$this->limite,$this->group);
        $resultado = $busca->fetchObject();

        $busca_todos = $this->crud->select($campos = array($this->campos),$this->tabela,$this->where,$this->order,$this->limite,$this->group);
        $this->busca = $busca_todos;

        // RESULTADOS
        $this->idTipoPausas        = $resultado->idTipoPausas;
        $this->nomeTipoPausas      = $resultado->nomeTipoPausas;
        $this->tempoLimite         = $resultado->tempoLimite;

    }

    #### UPDATE ####

    public function update(array $campos,$where=null){
        $this->where  = $where;
        $this->campos = $campos;
        $this->crud->update($this->campos,$this->tabela,$this->where);
    }

    #### DELETE ####

    public function delete($where=null){
        $this->where = $where;
        $this->crud->deleta($this->tabela, $this->where);
    }


    #### QUANTIDADE DE REGISTROS ####

    public function contaRegistros($where=null) {
        $this->where        = $where;
        $busca              = $this->crud->select($campos = array("count(*) AS qtdRegistros"),$this->tabela,$this->where,"","");
        $resultado          = $busca->fetchObject();
        $this->qtdRegistros = $resultado->qtdRegistros;
    }


}