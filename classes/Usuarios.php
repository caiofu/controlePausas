<?php

    include "Autoload.php";

/*
    NOME: Usuarios
    FUNÇÃO: Classe responsavel por fazer , select, insert update e delete na tabela cut_usuarios
    PROGRAMADA POR: Caio Furegati - E-mail: caiofu@hotmail.com
    DATA: 02/12/2020
 */

class Usuarios
{
    ### ATRIBUTOS ###
    private $idUsuario;
    private $nomeUsuario;
    private $nomeCompleto;
    private $senha;
    private $idTipoUsuario;
    private $token;
    private $qtdRegistros;
    private $busca;
    private $campos;
    private $where;
    private $order;
    private $limite;

    #### METODO CONSTRUTOR ####
    public function __construct()
    {
        $this->config = new Config();
        $this->crud   = new Crud();
        $this->tabela = "usuario";
    }

    #### METODOS ACESSORES ####

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }


    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }


    public function getNomeUsuario()
    {
        return $this->nomeUsuario;
    }


    public function setNomeUsuario($nomeUsuario)
    {
        $this->nomeUsuario = $nomeUsuario;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }


    public function getIdTipoUsuario()
    {
        return $this->idTipoUsuario;
    }


    public function setIdTipoUsuario($idTipoUsuario)
    {
        $this->idTipoUsuario = $idTipoUsuario;
    }


    public function getQtdRegistros()
    {
        return $this->qtdRegistros;
    }


    public function setQtdRegistros($qtdRegistros)
    {
        $this->qtdRegistros = $qtdRegistros;
    }


    public function getNomeCompleto()
    {
        return $this->nomeCompleto;
    }


    public function setNomeCompleto($nomeCompleto)
    {
        $this->nomeCompleto = $nomeCompleto;
    }


    public function getToken()
    {
        return $this->token;
    }


    public function setToken($token)
    {
        $this->token = $token;
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

        $this->crud->insert($campos = array('idUsuario'        => $this->idUsuario,
                                            'nomeUsuario'      => $this->nomeUsuario,
                                            'nomeCompleto'     => $this->nomeCompleto,
                                            'senha'            => $this->senha,
                                            'token'            => $this->token,
                                            'idTipoUsuario'    => $this->idTipoUsuario), $this->tabela,'','','');

        $busca     = $this->crud->select($campos = array("*"),$this->tabela,"","idUsuario DESC",'1');
        $resultado = $busca->fetchObject();

        // RESULTADOS
        $this->idUsuario               = $resultado->idUsuario;
        $this->nomeUsuario             = $resultado->nomeUsuario;
        $this->nomeCompleto            = $resultado->nomeCompleto;
        $this->senha                   = $resultado->senha;
        $this->idTipoUsuario           = $resultado->idTipoUsuario;
        $this->token                   = $resultado->token;


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
        $this->idUsuario               = $resultado->idUsuario;
        $this->nomeUsuario             = $resultado->nomeUsuario;
        $this->nomeCompleto            = $resultado->nomeCompleto;
        $this->senha                   = $resultado->senha;
        $this->idTipoUsuario           = $resultado->idTipoUsuario;
        $this->token                   = $resultado->token;


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