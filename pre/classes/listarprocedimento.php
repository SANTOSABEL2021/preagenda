<?php
require_once "conexao.php";		
require_once "pre_agendamento.php";

 

  if(isset($_GET['acao']) && $_GET['acao'] == 'procedimento'):
    
    $q = intval($_GET['idunidade']);

       
     $proc = new pre_agendamento();
     $result=$proc->listarProcedimentos($q);

       

      echo "<SELECT name='procedimento' onchange='buscarVaga(this.value)' id ='procedimento'>";
        echo '<option value="">'
          ."Selecione procedimento".
          '</option>'
          ;
      while($row = mysqli_fetch_array($result)){
     
      echo '<option value="'.$row['idpro'].'">'
          .$row['descpro'].
          '</option>' ; }

      echo "</SELECT>";

     
      endif;

    if(isset($_GET['acao']) && $_GET['acao'] == 'vaga'):      

      $q2 = intval($_GET['q2']);
      $proc2 = new pre_agendamento();
      $result2=$proc2->cotadisponivel($q2);

       

      echo "<SELECT name='cota'  onchange='buscarPrioridade(this.value)' id ='prioridade'>";
       echo '<option value="">'
          ."Selecione vaga disponivel".
          '</option>'
          ;
      while($row2 = mysqli_fetch_array($result2)){
     
      echo '<option value="'.$row2['idcota'].'">'
          .$row2['descproc']."   (".$row2['mes']."/".$row2['ano'].") --- ( ". $row2['qte']." vaga(s))".
          '</option>'
          ;
        
      }
      echo "</SELECT>";
    endif;


    if(isset($_GET['acao']) && $_GET['acao'] == 'prioridade'):      

      $q3 = intval($_GET['q3']);
      $proc3 = new pre_agendamento();
      $result3=$proc3->listarPrioridade();

       

      echo "<SELECT name='prioridade' onchange='buscarStatus(this.value)' id ='status' >";
       echo '<option value="">'
          ."Selecione a prioridade".
          '</option>'
          ;
      while($row3 = mysqli_fetch_array($result3)){
     
      echo '<option value="'.$row3['id_prioridade'].'">'
          .$row3['detalhe_prioridade'].
          '</option>'
          ;
        
      }
      echo "</SELECT>";
    endif;


    if(isset($_GET['acao']) && $_GET['acao'] == 'status'):      

      $q4 = intval($_GET['q4']);
      $proc4 = new pre_agendamento();
      $result4=$proc4->listarStatus();

       

      echo "<SELECT name='status' >";
       echo '<option value="">'
          ."Selecione o status".
          '</option>'
          ;
      while($row4 = mysqli_fetch_array($result4)){
     
      echo '<option value="'.$row4['id_status'].'">'
          .$row4['descricao_status'].
          '</option>'
          ;
        
      }
      echo "</SELECT>";
    endif;





     


?>
