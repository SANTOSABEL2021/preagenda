<?php

include_once "conexao.php";

    
  class endereco_paciente extends conexao{

    function exibirEndereco($id){
	    $sql="SELECT * FROM tb_endereco_pacientes WHERE id_paciente = $id";
      $resultado = $this->conexao->query($sql);
      return $resultado;
     }

     function exibircidade(){
      $sql="SELECT * FROM tb_cidades";
      $resultado = $this->conexao->query($sql);
      return $resultado;
     }

      function excluir($id){
      $sql="DELETE FROM tb_endereco_pacientes WHERE id_endereco_paciente = $id";
      $resultado = $this->conexao->query($sql);
      return $resultado;
     }
          
  

    function cadastrarEndereco($logradouro,$nr,$bairro,$id_cidade,$id_paciente,$telefone){
      $sql = "INSERT INTO tb_endereco_pacientes (id_endereco_paciente,logradouro_paciente,nr_endereco_paciente,bairro_paciente,id_cidade,id_paciente,telefone_cliente)
        VALUES (NULL, '$logradouro','$nr','$bairro',$id_cidade,$id_paciente,'$telefone' )";

        if ($this->conexao->query($sql) === TRUE) {
         echo "endereco incluido com sucesso";
      } else {
        echo "falha na inclusão de endereco: "  . "<br>" . $this->conexao->error;
      }

    }

    
    function alterarEndereco($id,$logradouro,$nr,$bairro,$id_cidade,$id_paciente,$telefone){
       $sql = "UPDATE tb_endereco_pacientes SET logradouro_paciente = '$logradouro',nr_endereco_paciente = '$nr',bairro_paciente = '$bairro',id_cidade = $id_cidade,id_paciente = id_paciente,telefone_cliente = '$telefone' WHERE id_endereco_paciente=$id";

      if ($this->conexao->query($sql) === TRUE) {
        echo "alteração realizada com sucesso";
      } else {
        echo "Falha em realizar alteração: ";
      }

    }
}
  
  


  
?>