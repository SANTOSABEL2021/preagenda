<?php

include_once "conexao.php";

    
  class clientes extends conexao{

     
      function cadastrarCliente($cns,$datanascimento,$sexo,$nome,$pai,$mae){
        $sql = "INSERT INTO tb_clientes (id_cliente,cns_cliente, data_nascimento,sexo_cliente,nome_cliente,pai_cliente,mae_cliente)
        VALUES (NULL, '$cns', '$datanascimento',$sexo,'$nome','$pai','$mae' )";

        if ($this->conexao->query($sql) === TRUE) {
         echo "incluido com sucesso";
      } else {
        echo "falha na inclusão: " . $sql . "<br>" . $conn->error;
      }
    }

      function exibircliente($id){
         $sql = "SELECT * FROM tb_clientes WHERE id_cliente = $id";
        $resultado=$this->conexao->query($sql);
        return $resultado;
      }
      


      function alterarCliente($id,$cns,$datanascimento,$sexo,$nome,$pai,$mae){
        $sql = "UPDATE tb_clientes SET cns_cliente='$cns',data_nascimento = '$datanascimento', sexo_cliente = $sexo, nome_cliente = '$nome', pai_cliente = '$pai', mae_cliente = '$mae' WHERE id_cliente=$id";

      if ($this->conexao->query($sql) === TRUE) {
        echo "alteração realizada com sucesso";
      } else {
        echo "Falha em realizar alteração: ";
      }
      }


      function consultaNomeCliente($nome){
        $sql = "SELECT * FROM tb_clientes WHERE nome_cliente LIKE '%$nome%' LIMIT 10";
        $resultado=$this->conexao->query($sql);
        return $resultado;
      }


      function consultaCNS($cns){
        $sql = "SELECT * FROM tb_clientes WHERE cns_cliente LIKE '%$cns%' ";
        $resultado=$this->conexao->query($sql);
        return $resultado;
      }

      function exibirsexo(){
        $sql = "SELECT * FROM tb_sexos";
        $resultadosexo=$this->conexao->query($sql);
        return $resultadosexo;
      }

     
      
  }
  
    
?>