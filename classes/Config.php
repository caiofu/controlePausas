<?php


class Config
{

    //SESSÃO DE USUÁRIO LOGADO
    private $sessaoLogadoName = 'logado';

 // MYSQL
    private $hostMysql      = 'localhost';
    private $usuarioMysql   = 'root';
    private $senhaMysql     = '';
    private $bdMysql        = 'controlepausa';

 //CHAVE DE SEGURANÇA
    private $chaveSeguranca          = 'XuRup1t4$G4l0p4nt302*?';


    ### ACESSORES ###

    public function getSessaoLogadoName()
    {
        return $this->sessaoLogadoName;
    }

    public function getHostMysql()
    {
        return $this->hostMysql;
    }


    public function getUsuarioMysql()
    {
        return $this->usuarioMysql;
    }


    public function getSenhaMysql()
    {
        return $this->senhaMysql;
    }

    public function getBdMysql()
    {
        return $this->bdMysql;
    }

    public function getPrefixoTable()
    {
        return $this->prefixoTable;
    }


    public function getChaveSeguranca()
    {
        return $this->chaveSeguranca;
    }


    public function setChaveSeguranca($chaveSeguranca)
    {
        $this->chaveSeguranca = $chaveSeguranca;
    }



}