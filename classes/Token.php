<?php
include "Autoload.php";
/*
	CLASSE:         Token
	FUNÇÃO:         Classe reponsavel por gerar e verificar token
	Programada por: Guilherme Pacheco Aparício - Email: guiaparicio@gmail.com
	Data:           22/05/2014
*/

class Token{

    #### ATRIBUTOS ####

    private $token;
    private $usuario;
    private $senha;
    private $codigoSeguranca;
    private $statusToken;
    private $senhaChave;
    private $chave;
    private $tokenEncrypt;
    private $tokenDecrypt;
    private $senhaEncrypt;
    private $senhaDecrypt;

    #### CONSTRUTOR ####

    public function __construct(){


        // CRIA O OBJETO DE CONFIGURAÇÃO
        $this->config = new Config();

        // COLETA A CHAVE DE SEGURANÇA
        $this->codigoSeguranca = substr(md5($this->config->getChaveSeguranca()),5,5);

        // CRIA O OBJETO DE CRUD
        $this->crud   = new Crud();

        // MONTA O NOME DA TABELA
        $this->tabela = "usuario";



    }

    #### MÉTODOS ACESSORES ####

    public function setToken($token){
        $this->token = $token;
    }

    public function getToken(){
        return $this->token;
    }

    public function getStatusToken(){
        return $this->statusToken;
    }

    public function getChave(){
        return $this->chave;
    }

    public function setSenhaChave($senhaChave){
        $this->senhaChave = $senhaChave;
    }

    public function getSenhaChave(){
        return $this->senhaChave;
    }

    public function getTokenEncrypt(){
        return $this->tokenEncrypt;
    }

    public function getTokenDecrypt(){
        return $this->tokenDecrypt;
    }


    public function getSenhaEncrypt()
    {
        return $this->senhaEncrypt;
    }


    public function setSenhaEncrypt($senhaEncrypt)
    {
        $this->senhaEncrypt = $senhaEncrypt;
    }

    public function getSenhaDecrypt()
    {
        return $this->senhaDecrypt;
    }


    public function setSenhaDecrypt($senhaDecrypt)
    {
        $this->senhaDecrypt = $senhaDecrypt;
    }



    #### DESCRIPTOGRAFA decodebinhex ####

    private function decodebinhex($hexdata) {
        $res = '';
        $ar = str_split($hexdata,2);
        foreach ($ar as $ch) {
            $res .= chr(hexdec($ch));
        }
        return $res;
    }

    #### GERA TOKEN ####

    public function geraToken($usuario,$senha){

        $this->usuario = substr(md5($usuario),0,5);
        $this->senha = substr(md5($senha),5,5);

        $this->token = $this->usuario."-".$this->senha."-".$this->codigoSeguranca;
    }

    #### GERA TOKEN ####

    public function verificaToken($token,$usuario){

        $this->token = $token;
        $this->usuario = $usuario;

        $busca       = $this->crud->select($campos = array('idUsuario, nomeUsuario'),$this->tabela,"token = '".$this->token."' ",'','');
        $resultado   = $busca->fetchObject();

        // VERIFICACAO DE QUE O TOKEN EXISTE E PERTENCE AO USUARIO INFORMADO
        if($resultado->nomeUsuario == $this->usuario){
            $tokenExistente = 1;
        }

        // VERIFICA SE O TOKEN PASSOU POR TODOS AS VERIFICAÇÕES
        if($tokenExistente == 1){
            $this->statusToken = 1;
        }
        else{
            $this->statusToken = 0;
        }
    }

    #### GERA CHAVE ####

    public function geraChave($senhaChave){
        $this->stringInicial = substr(str_shuffle(str_repeat("NDRlMzg3MDZkOTVlZDYyMDI5Y2ZiZTJkNjVhNDcxOWFbc2NyaXB0XSojKC9zY3J", 5)), 0, 5);
        $this->stringFinal   = substr(str_shuffle(str_repeat("Vm05anc2b2dZV05vWVNCeGRXVWdkbUZwSUdOdmJuTmxaM1ZwY2lCdWIzTWdhVzUyWVdScGNqOGdTMHRMU3c9PQ*+8237497", 5)), 0, 5);
        $this->chave         = $senhaChave;
        $this->chave         = base64_encode($this->stringInicial.$this->chave.$this->stringFinal);
        $this->chave         = base64_encode($this->chave);
        $this->chave         = bin2hex($this->chave);
        $this->chave         = base64_encode($this->chave);
    }

    #### DESCRIPTOGRAFA CHAVE ####

    public function descriptChave($chave){
        $this->senhaChave = $chave;
        $this->senhaChave = base64_decode($this->senhaChave);
        $this->senhaChave = $this->decodebinhex($this->senhaChave);
        $this->senhaChave = base64_decode($this->senhaChave);
        $this->senhaChave = base64_decode($this->senhaChave);
        $parte1 = substr($this->senhaChave,0,5);
        $parte2 = substr($this->senhaChave,-5,5);
        $this->senhaChave = str_replace($parte2, "",str_replace($parte1, "", $this->senhaChave));
        $this->chave = $this->senhaChave;
    }

    #### CRIPTOGRAFAR TOKEN ####

    public function encryptToken($token){

        $this->tokenEncrypt = explode("-",$token);

        $this->stringInicial = substr(str_shuffle(str_repeat("NDRlMzg3MDZkOTVlZDYyMDI5Y2ZiZTJkNjVhNDcxOWFbc2NyaXB0XSojKC9zY3J", 5)), 0, 5);
        $this->stringFinal   = substr(str_shuffle(str_repeat("Vm05anc2b2dZV05vWVNCeGRXVWdkbUZwSUdOdmJuTmxaM1ZwY2lCdWIzTWdhVzUyWVdScGNqOGdTMHRMU3c9PQ*+8237497", 5)), 0, 5);

        $this->tokenEncrypt = $this->stringInicial."-".$this->tokenEncrypt[1]."-".$this->tokenEncrypt[0]."-".$this->tokenEncrypt[2]."-".$this->stringFinal;
        $this->tokenEncrypt = base64_encode($this->tokenEncrypt);
        $this->tokenEncrypt = bin2hex($this->tokenEncrypt);

    }

    #### CRIPTOGRAFAR TOKEN ####

    public function decryptToken($token){

        $this->tokenDecrypt = $token;
        $this->tokenDecrypt = $this->decodebinhex($this->tokenDecrypt);
        $this->tokenDecrypt = base64_decode($this->tokenDecrypt);

        $parte1 = substr($this->tokenDecrypt,0,6);
        $parte2 = substr($this->tokenDecrypt,-6,6);
        $this->tokenDecrypt = str_replace($parte2, "",str_replace($parte1, "", $this->tokenDecrypt));

        $this->tokenDecrypt = explode("-",$this->tokenDecrypt);

        $this->tokenDecrypt = $this->tokenDecrypt[1]."-".$this->tokenDecrypt[0]."-".$this->tokenDecrypt[2];

    }


    #### CRIPTOGRAFAR SENHA ####

    public function encryptSenha($senha){

        $this->senhaEncrypt = $senha;//explode("-",$senha);

        $this->stringInicial = substr(str_shuffle(str_repeat("NDRlMzg3MDZkOTVlZDYyMDI5Y2ZiZTJkNjVhNDcxOWFbc2NyaXB0XSojKC9zY3J", 5)), 0, 5);
        $this->stringFinal   = substr(str_shuffle(str_repeat("Vm05anc2b2dZV05vWVNCeGRXVWdkbUZwSUdOdmJuTmxaM1ZwY2lCdWIzTWdhVzUyWVdScGNqOGdTMHRMU3c9PQ*+8237497", 5)), 0, 5);

        $this->senhaEncrypt  = $this->stringInicial."-".$this->senhaEncrypt."-".$this->stringFinal;
        $this->senhaEncrypt  = base64_encode($this->senhaEncrypt );
        $this->senhaEncrypt  = bin2hex($this->senhaEncrypt );

    }

    #### DESCRIPTOGRAFAR SENHA ####

    public function decryptSenha($senha){

        $this->senhaDecrypt = $senha;
        $this->senhaDecrypt = $this->decodebinhex($this->senhaDecrypt);
       $this->senhaDecrypt = base64_decode($this->senhaDecrypt);

               $parte1 = substr($this->senhaDecrypt,0,6);
               $parte2 = substr($this->senhaDecrypt,-6,6);
               $this->senhaDecrypt = str_replace($parte2, "",str_replace($parte1, "", $this->senhaDecrypt));

              // $this->senhaDecrypt = explode("-",$this->senhaDecrypt);

               $this->senhaDecrypt =$this->senhaDecrypt;

    }

}