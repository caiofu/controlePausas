<?php

/*
    CLASSE:         CRUD
    FUNÇÃO:         Responsável por realizar CRUD no banco

*/

class Crud extends Conexao{

    #### CONSTRUTOR ####

    public function __construct(){

    }

    #### DELETE ####

    public function deleta($tabela, $where){

        $query = "DELETE FROM {$tabela} WHERE {$where}";
        $this->conecta()->exec($query);

    }

    #### INSERT ####

    public function insert(array $campos, $tabela){

        $valor = array_values($campos);

        $valorTratado = array(null);

        $i = 0;

        while($i<=sizeof($valor)-1){

            $valorTratadoTemp = array($i => addslashes($valor[$i]));

            if($valorTratado != null){
                $valorTratado = array_replace($valorTratado,$valorTratadoTemp);
            }

            $i++;
        }

        $coluna = implode(", ", array_keys($campos));
        $valor  = "'".implode("', '", array_values($valorTratado))."'";

        $query = "INSERT INTO {$tabela} ({$coluna}) VALUES ({$valor})";

        $this->conecta()->exec($query);

    }

    #### UPDATE ####

    public function update(array $set, $tabela, $where){

        foreach($set as $chave => $valor){
            $valor    = addslashes($valor);
            $campos[] = "{$chave}='{$valor}'";
        };

        $campos = implode(", ", $campos);

        $query  = "UPDATE {$tabela} SET {$campos} WHERE {$where}";

        $this->conecta()->exec($query);

    }

    #### SELECT ####

    public function select(array $select, $tabela, $where = null, $order = null, $limit = null, $group = null){

        $where = ($where == null) ? null : "WHERE {$where}";

        if($select != "*"){
            $select = implode(", ", $select);
        }
        else{
            $select = "*";
        };

        $group = ($group == null) ? null : "GROUP BY {$group}";
        $order = ($order == null) ? null : "ORDER BY {$order}";
        $limit = ($limit == null) ? null : "LIMIT {$limit}";

        $consulta = "SELECT {$select} FROM {$tabela} {$where} {$group} {$order} {$limit}";

        $result = $this->conecta()->prepare($consulta);

        $result->execute();

        return $result;

    }
}