<?php

include_once "conexao.php";

    
  class cotas extends conexao{

    function exibirCota(){
		      $sql="SELECT * FROM tb_cotas";
      $resultado=$this->conexao->query($sql);
      return $resultado;
    }

    function cadastrarCota($idproc,$idstatus,$qteliberada, $mes,$ano,$idexec){
        $qteusada = 0;
        $qtedisponivel = $qteliberada;
        $sql="INSERT INTO tb_cotas (id_cota,id_procedimento,id_status_cota,qte_liberada,qte_disponivel,qte_usada,mes,ano,id_executante)
        VALUES (NULL, $idproc,$idstatus, $qteliberada,$qtedisponivel,$qteusada,'$mes','$ano',$idexec )";
        $resultado=$this->conexao->query($sql);
        return $resultado;
    }

    function alterarCota($id,$idstatuscota,$idqteliberada){
    	  $sql="UPDATE tb_cotas SET id_status_cota = $idstatuscota, qte_liberada = $idqteliberada WHERE id_cota=$id";
          $resultado=$this->conexao->query($sql);
          return $resultado;
    }
    
    function listarCotaMesAno($mes, $ano){
          $sql="SELECT * FROM tb_cotas WHERE mes = $mes AND ano = $ano";
          $resultado=$this->conexao->query($sql);
          return $resultado;
    }

}
 
   
?>