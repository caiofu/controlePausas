<?php
   

class Conexao extends Config
{
    ### ATRIBUTOS ###
    private static $conexao;

    #### CONSTRUTOR ####

    public function __construct(){

    }

    #### REALIZA A CONEXÃO UTILIZANDO O PDO ####

    public function conecta()
    {
        try
        {
            if (!isset(self::$conexao)):
                self::$conexao = new pdo("mysql:host={$this->getHostMysql()};dbname={$this->getBdMysql()}","{$this->getUsuarioMysql()}", "{$this->getSenhaMysql()}", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            endif;
        } catch (PDOException $e)
        {
            echo "Não foi possível conectgar ao Banco de Dados! (ERRO:". $e->getCode().")".$this->getSenhaMysql()."-".$this->getUsuarioMysql()."-".$this->getBdMysql();
        }

        return self::$conexao;
    }
}