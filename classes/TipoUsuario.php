<?php
include "Autoload.php";

class TipoUsuario
{
    private $idTipoUsuario;
    private $nomeTipoUsuario;
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
        $this->tabela = "tipousuario";
    }


    public function getIdTipoUsuario()
    {
        return $this->idTipoUsuario;
    }


    public function setIdTipoUsuario($idTipoUsuario)
    {
        $this->idTipoUsuario = $idTipoUsuario;
    }


    public function getNomeTipoUsuario()
    {
        return $this->nomeTipoUsuario;
    }


    public function setNomeTipoUsuario($nomeTipoUsuario)
    {
        $this->nomeTipoUsuario = $nomeTipoUsuario;
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

        $this->crud->insert($campos = array('idTipoUsuario'     => $this->idTipoUsuario,
                                            'nomeTipoUsuario'   => $this->nomeTipoUsuario), $this->tabela,'','','');

        $busca     = $this->crud->select($campos = array("*"),$this->tabela,"","idTipoUsuario DESC",'1');
        $resultado = $busca->fetchObject();


        // RESULTADOS
        $this->idTipoUsuario       = $resultado->idTipoUsuario;
        $this->nomeTipoUsuario     = $resultado->nomeTipoUsuario;



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
        $this->idTipoUsuario       = $resultado->idTipoUsuario;
        $this->nomeTipoUsuario     = $resultado->nomeTipoUsuario;

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