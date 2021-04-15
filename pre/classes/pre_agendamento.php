<?php

include_once "conexao.php";
    
  class pre_agendamento extends conexao{

    function exibirAgenda($idpaciente){
      //vai precisas de inner join
      $sql = "SELECT * FROM tb_pre_agendamentos where id_cliente = $idpaciente";
        $resultado=$this->conexao->query($sql);
        return $resultado;
		   }

    function exibiragendapre($idpre){
       $sql = "SELECT * FROM tb_pre_agendamentos where id_pre_agendamento = $idpre";
        $resultado=$this->conexao->query($sql);
        $linha  = $resultado->fetch_assoc();
        return $linha;
       }

    function listarPrioridade(){
       $sql = "SELECT * FROM tb_prioridades";
        $resultado=$this->conexao->query($sql);
        return $resultado;
       }

    function listarPrioridadeLista($idprioridade){
       $sql = "SELECT * FROM tb_prioridades WHERE id_prioridade = $idprioridade";
        $resultado=$this->conexao->query($sql);
        return $resultado;
      }

    function listarStatus(){
       $sql = "SELECT * FROM tb_status";
        $resultado=$this->conexao->query($sql);
        return $resultado;
        }

    function listarStatusLista($isstatus){
       $sql = "SELECT * FROM tb_status WHERE id_status = $isstatus";
        $resultado=$this->conexao->query($sql);
        return $resultado;
        }


  	function preAgendar($idcli,$idstatus,$idpri,$idcota){
       $sql = "INSERT INTO tb_pre_agendamentos 
       (id_pre_agendamento,id_cliente,id_status,id_prioridade,id_cota)
       VALUES (NULL,$idcli,$idstatus,$idpri,$idcota)";

        if ($this->conexao->query($sql) === TRUE) {
            $this->darBaixaVaga($idcota);
        header("location:../classes/preagendar.php?idcliente=$idcli&acao=exibir");
        } else {
        echo "falha na inclusão: " . $sql . "<br>" . $conn->error;
        }
  	}

  	function alterarPreAgenda($idpre,$idstatus,$idpri){
      $sql = "UPDATE tb_pre_agendamentos SET id_status = $idstatus, id_prioridade = $idpri WHERE id_pre_agendamento=$idpre";
      if ($this->conexao->query($sql) === TRUE) {
        echo "alteração realizada com sucesso";
      } else {
        echo "Falha em realizar alteração: ";
      }
  	}

  	
  	function darBaixaVaga($idcota){
      $sql = "UPDATE tb_cotas SET qte_disponivel = qte_disponivel - 1, qte_usada = qte_usada + 1 WHERE id_cota=$idcota";
       if ($this->conexao->query($sql) === TRUE) {
        echo "cota dado baixa";
      } else {
        echo "Falha em realizar alteração: ";
      }
  	}

  	function estornarBaixaVaga($idcota){
     $sql = "UPDATE tb_cotas SET qte_disponivel = qte_disponivel + 1, qte_usada = qte_usada - 1 WHERE id_cota=$idcota";
       if ($this->conexao->query($sql) === TRUE) {
        echo "cota dado baixa";
      } else {
        echo "Falha em realizar alteração: ";
      }
  	}

  	function excluirPreAgendar($idpre,$idcota){
     $sql = "DELETE FROM tb_pre_agendamentos WHERE id_pre_agendamento=$idpre";
     if ($this->conexao->query($sql) === TRUE) {
       $this->estornarBaixaVaga($idcota);
       echo "agendamento excluido com sucesso";
     } else {
      echo "falha ao alterar: " . $this->conexao->error;
    }
     $this->conexao->close();
  	}

    function exibirUnidade(){
       $sql = "SELECT * FROM tb_unidades";
       $resultado=$this->conexao->query($sql);
       return $resultado;
    }

    function listarProcedimentos($q){
        $sql="SELECT pro.descricao_procedimento AS descpro, pro.id_procedimento AS idpro
        FROM tb_unidades AS unidade
        INNER JOIN tb_cotas AS cota 
        ON unidade.id_unidade = cota.id_executante
        INNER JOIN tb_procedimentos AS pro 
        ON pro.id_procedimento = cota.id_procedimento
        INNER JOIN tb_status_cotas AS statuscota
        ON cota.id_status_cota = statuscota.id_status_cota
        WHERE unidade.id_unidade = $q AND statuscota.id_status_cota = 1 ";
        $result=$this->conexao->query($sql);
        return $result;
      }

    function listarpreagenda($idcliente){
        $sql = "SELECT * FROM tb_pre_agendamentos WHERE id_cliente = $idcliente";
        $resultado=$this->conexao->query($sql);
        return $resultado;
        }

    function listarAgendamento($cota,$cliente){
        $sql="SELECT pro.descricao_procedimento AS descpro, cota.mes AS mes, cota.ano AS ano, pre.id_pre_agendamento AS idpre
        FROM tb_unidades AS unidade
        INNER JOIN tb_cotas AS cota 
        ON unidade.id_unidade = cota.id_executante
        INNER JOIN tb_procedimentos AS pro 
        ON pro.id_procedimento = cota.id_procedimento
        INNER JOIN tb_pre_agendamentos AS pre 
        ON pre.id_cota = cota.id_cota 
        INNER JOIN tb_clientes AS cli 
        ON cli.id_cliente = pre.id_cliente
        WHERE cota.id_cota = $cota AND cli.id_cliente = $cliente ";
        $result=$this->conexao->query($sql);
        return $result;
    }


    function cotadisponivel($procedimento){
        $sql="SELECT cota.qte_disponivel AS qte, cota.mes AS mes, cota.ano AS ano, pro.descricao_procedimento AS descproc,cota.id_cota AS idcota
          FROM  tb_cotas AS cota
          INNER JOIN tb_procedimentos AS pro 
          ON cota.id_procedimento = pro.id_procedimento
          INNER JOIN tb_status_cotas AS statcota 
          ON statcota.id_status_cota = cota.id_status_cota
          WHERE pro.id_procedimento = $procedimento AND cota.id_status_cota = 1 AND cota.qte_disponivel>0";

          $result=$this->conexao->query($sql);
          return $result;
    }

       
    function exibirPaciente($id){
         $sql = "SELECT * FROM tb_clientes WHERE id_cliente = $id";
         $resultado=$this->conexao->query($sql);
         return $resultado;
       }

  	function agendarTC(){
  	 }

  	function agendarUSG(){
  	 }

  	function agendarRX(){
  	 }


}
  
  


  
?>