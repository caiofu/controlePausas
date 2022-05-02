<?php

/*
    CLASSE:          Form
    FUNCAO:          Classe responsável por realizar diversas operações em formulários do sistema.
    PROGRAMADA POR:  Guilherme Pacheco Aparício - Email: guiaparicio@gmail.com
    DATA DE CRIACAO: 16/02/2016
*/

class Form{

    #### ATRIBUTOS ####

    private $optionsSelect;
    private $optionsSelectSubOptions;

    #### POPULA SELECT DO FORM (SEM SUB OPTIONS) ####

    public function populaSelect($valueSelected,$array){

        $this->optionsSelect = null;

        if($array != null) {

            foreach ($array as $key => $value) {

                if (($key != $valueSelected) OR ($key == 0 AND $valueSelected == null)) {
                    $this->optionsSelect .= "<option value=\"{$key}\">{$value}</option>";
                } else {
                    $this->optionsSelect .= "<option value=\"{$key}\" selected=\"selected\">{$value}</option>";
                }

            }

        }

        return $this->optionsSelect;
    }

    #### POPULA SELECT DO FORM (COM SUB OPTIONS) ####

    public function populaSelectSubOptions($idPai, $nivel, $nomeCampoIdFilho, $nomeCampoIdPai, $nomeCampoExibicao, $campoNulo, $valueSelected, $array, $limpaOptions=null){

        if($limpaOptions == 1){
            $this->optionsSelectSubOptions = null;
        }

        for ($i = 1; $i <= count($array); $i++){

            if($array[$i]["{$nomeCampoIdPai}"] == $idPai){

                $html = null;

                if($nivel > 0){
                    for($x = 0; $x < $nivel; $x++){
                        $html .= "⊢";
                    }
                }else{
                    if($campoNulo == 1){
                        $this->optionsSelectSubOptions .= "<option value=''></option>";
                        $campoNulo = 0;
                    }
                }

                if($array[$i]["{$nomeCampoIdFilho}"] != $valueSelected){
                    $this->optionsSelectSubOptions .= "{$nivel}<option value='{$array[$i]["{$nomeCampoIdFilho}"]}'>{$html}{$array[$i]["{$nomeCampoExibicao}"]}</option>";
                }else{
                    $this->optionsSelectSubOptions .= "<option value='{$array[$i]["{$nomeCampoIdFilho}"]}' selected>{$html}{$array[$i]["{$nomeCampoExibicao}"]}</option>";
                }

                // busca as subcategorias da categoria atual
                $this->populaSelectSubOptions($array[$i]["{$nomeCampoIdFilho}"], $nivel+1, $nomeCampoIdFilho, $nomeCampoIdPai, $nomeCampoExibicao, $campoNulo, $valueSelected, $array);

            }

        }

        return $this->optionsSelectSubOptions;

    }
}