<?php

include_once "conexao.php";
  
    class usuarios extends conexao{

      function exibir(){
		
        $sql="SELECT * FROM tb_usuarios";
        $resultado=$this->conexao->query($sql);
        return $resultado;
      }

      function validar($usuario, $senha){
        $sql= "SELECT * FROM tb_usuarios WHERE chave = \"$usuario\" AND senha = \"$senha\"";
        $resultado=$this->conexao->query($sql);
        if($resultado->num_rows > 0){
          echo "ACESSO PERMITIDO";
        }else{
          echo "ACESSO NEGADO";
        }

      
      } 

      function cadastrarUsuario($nome,$idcargo,$chave,$senha,$nivel){
       $sql = "INSERT INTO tb_usuarios (id_usuario, nome_usuario, id_cargo, chave, senha, id_nivel_acesso) VALUES (NULL, '$nome', '$idcargo', '$chave', '$senha', $nivel)";

      if ($this->conexao->query($sql) === TRUE) {
          echo "New record created successfully";
      } else {
      echo "Error: " . $sql . "<br>" . $this->conexao->error;
      }

      $this->conexao->close();



      } 
      function alterarUsuario($id,$nome,$idcargo,$chave,$senha,$idnivel){
        $sql = "UPDATE tb_usuarios SET nome_usuario = '$nome',id_cargo=$idcargo,chave='$chave', senha='$senha', id_nivel_acesso = $idnivel WHERE tb_usuarios.id_usuario = $id";

      if ($this->conexao->query($sql) === TRUE) {
          echo "Alteração realizado com sucesso";
      } else {
      echo "Falha em alterar usuario: " . $sql . "<br>" . $this->conexao->error;
      }

      $this->conexao->close();

          }
      function excluirUsuario($id){
        $sql = "DELETE FROM tb_usuarios WHERE tb_usuarios.id_usuario = $id";
       if ($this->conexao->query($sql) === TRUE) {
        echo "Record deleted successfully";
      } else {
        echo "Error deleting record: " . $this->conexao->error;
      }

      $this->conexao->close();    
      }                         
       
    }
    
  
?>