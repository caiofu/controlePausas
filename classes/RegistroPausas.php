<?php
    include "Autoload.php";

class RegistroPausas
{
    #### ATRIBUTOS ####

    private $idRegistroPausas;
    private $idUsuario;
    private $idTipoPausa;
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
        $this->tabela = "registropausas";
    }


    public function getIdRegistroPausas()
    {
        return $this->idRegistroPausas;
    }


    public function setIdRegistroPausas($idRegistroPausas)
    {
        $this->idRegistroPausas = $idRegistroPausas;
    }


    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }


    public function getIdTipoPausa()
    {
        return $this->idTipoPausa;
    }

    public function setIdTipoPausa($idTipoPausa)
    {
        $this->idTipoPausa = $idTipoPausa;
    }


    public function getHorarioInicio()
    {
        return $this->horarioInicio;
    }


    public function setHorarioInicio($horarioInicio)
    {
        $this->horarioInicio = $horarioInicio;
    }


    public function getHorarioTermino()
    {
        return $this->horarioTermino;
    }


    public function setHorarioTermino($horarioTermino)
    {
        $this->horarioTermino = $horarioTermino;
    }


    public function getDataRegistro()
    {
        return $this->dataRegistro;
    }


    public function setDataRegistro($dataRegistro)
    {
        $this->dataRegistro = $dataRegistro;
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

        $this->crud->insert($campos = array('idRegistroPausas'      => $this->idRegistroPausas,
                                            'idUsuario'             => $this->idUsuario,
                                            'idTipoPausa'           => $this->idTipoPausa,
                                            'horarioInicio'         => $this->horarioInicio,
                                            'horarioTermino'        => $this->horarioTermino,
                                            'dataRegistro'      => $this->dataRegistro), $this->tabela,'','','');

        $busca     = $this->crud->select($campos = array("*"),$this->tabela,"","idRegistroPausas DESC",'1');
        $resultado = $busca->fetchObject();


        // RESULTADOS
        $this->idRegistroPausas        = $resultado->idRegistroPausas;
        $this->idUsuario               = $resultado->idUsuario;
        $this->idTipoPausa             = $resultado->idTipoPausa;
        $this->horarioInicio           = $resultado->horarioInicio;
        $this->horarioTermino          = $resultado->horarioTermino;
        $this->dataRegistro            = $resultado->dataRegistro;



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
        $this->idRegistroPausas        = $resultado->idRegistroPausas;
        $this->idUsuario               = $resultado->idUsuario;
        $this->idTipoPausa             = $resultado->idTipoPausa;
        $this->horarioInicio           = $resultado->horarioInicio;
        $this->horarioTermino          = $resultado->horarioTermino;
        $this->dataRegistro            = $resultado->dataRegistro;

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