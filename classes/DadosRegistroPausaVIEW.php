<?php


class DadosRegistroPausaVIEW
{
    #### ATRIBUTOS ####
    private $idRegistroPausas;
    private $idUsuario;
    private $nomeUsuario;
    private $nomeCompleto;
    private $idTipoPausa;
    private $nomeTipoPausas;
    private $tempoLimite;
    private $horarioInicio;
    private $horarioTermino;
    private $dataRegistro;
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
        $this->tabela = "dadosregistrospausas";
    }

    public function getIdRegistroPausas()
    {
        return $this->idRegistroPausas;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }


    public function getNomeUsuario()
    {
        return $this->nomeUsuario;
    }

    public function getNomeCompleto()
    {
        return $this->nomeCompleto;
    }

    public function getIdTipoPausa()
    {
        return $this->idTipoPausa;
    }


    public function getNomeTipoPausas()
    {
        return $this->nomeTipoPausas;
    }


    public function getTempoLimite()
    {
        return $this->tempoLimite;
    }


    public function getHorarioInicio()
    {
        return $this->horarioInicio;
    }

    public function getHorarioTermino()
    {
        return $this->horarioTermino;
    }


    public function getDataRegistro()
    {
        return $this->dataRegistro;
    }


    public function getQtdRegistros()
    {
        return $this->qtdRegistros;
    }


    public function getBusca()
    {
        return $this->busca;
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
        $this->idRegistroPausas     = $resultado->idRegistroPausas;
        $this->idUsuario             = $resultado->idUsuario;
        $this->nomeUsuario          = $resultado->nomeUsuario;
        $this->nomeCompleto         = $resultado->nomeCompleto;
        $this->idTipoPausa          = $resultado->idTipoPausa;
        $this->nomeTipoPausas       = $resultado->nomeTipoPausas;
        $this->tempoLimite          = $resultado->tempoLimite;
        $this->horarioInicio        = $resultado->horarioTermino;
        $this->dataRegistro         = $resultado->dataRegistro;



    }


    #### QUANTIDADE DE REGISTROS ####

    public function contaRegistros($where=null) {
        $this->where        = $where;
        $busca              = $this->crud->select($campos = array("count(*) AS qtdRegistros"),$this->tabela,$this->where,"","");
        $resultado          = $busca->fetchObject();
        $this->qtdRegistros = $resultado->qtdRegistros;
    }

}