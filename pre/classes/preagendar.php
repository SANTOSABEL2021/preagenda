<?php 
		include_once "clientes.php";
		include_once "usuarios.php";
		include_once "cotas.php";
		include_once "pre_agendamento.php";
		include_once "endereco_paciente.php";
?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>AGENDA/Pesquisar</title>
 	<link rel="stylesheet" type="text/css" href="../estilopaginass.css">

 	<script>
	function showUser(str) {
  		if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    	return;
  }
  	var xmlhttp=new XMLHttpRequest();
  	xmlhttp.onreadystatechange=function() {
    	if (this.readyState==4 && this.status==200) {
    document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","listarprocedimento.php?acao=procedimento&idunidade="+str,true);
  xmlhttp.send();
}

function buscarVaga(str) {
  		if (str=="") {
        document.getElementById("vagas").innerHTML="";
    	return;
        }
  	var xmlhttp = new XMLHttpRequest();
  	xmlhttp.onreadystatechange=function() {
    	if (this.readyState==4 && this.status==200) {
        document.getElementById("vagas").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","listarprocedimento.php?acao=vaga&q2="+str,true);
  xmlhttp.send();
}

function buscarPrioridade(str) {
  		if (str=="") {
    	document.getElementById("retornoprioridade").innerHTML="";
    	return;
  }
  	var xmlhttp=new XMLHttpRequest();
  		xmlhttp.onreadystatechange=function() {
    	if (this.readyState==4 && this.status==200) {
    	document.getElementById("retornoprioridade").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","listarprocedimento.php?acao=prioridade&q3="+str,true);
  xmlhttp.send();
}
function buscarStatus(str) {
  		if (str=="") {
    	document.getElementById("retornoStatus").innerHTML="";
    	return;
  }
  	var xmlhttp=new XMLHttpRequest();
  		xmlhttp.onreadystatechange=function() {
    	if (this.readyState==4 && this.status==200) {
    	document.getElementById("retornoStatus").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","listarprocedimento.php?acao=status&q4="+str,true);
  xmlhttp.send();
}

</script>
</head>
 <body>
 <div class="painel"> 
 	
 	<div class="descricao">
 		<img src="../classes/img/logo.png">
 	</div>

 </div>
 <div class="conteiner">
 	
 	<div class="lado">
 		

 	</div>
 	<div class="area">

 		<?php
 		if(isset($_GET['editar']) && $_GET['editar'] == 'editar'): 
 			$id=$_GET['idcliente'];
 			$idcota = $_GET['idcota'];
 			$idpre = $_GET['idpre'];

 			//idcliente=11&idcota=282&idpre=1942&editar=editar
     	 header("location:../classes/alterarpreagendamento.php?editar=editar&id=$id&idcota=$idcota&idpre=$idpre");

     	 endif;



    	if(isset($_GET['acao']) && $_GET['acao'] == 'exibir'):      
     	 $id = $_GET['idcliente'];
     	 $exibir = new pre_agendamento();
     	 $resultado=$exibir->exibirPaciente($id);
     	 $linha=$resultado->fetch_assoc();
     	 endif;

     	
    	if(isset($_GET['acao']) && $_GET['acao'] == 'AGENDAR'):      
	     	 
	    	$idcliente = $_GET['id'];
	    	$idstatus = $_GET['status'];
	    	$idprioridade = $_GET['prioridade'];
	    	$idcota = $_GET['cota'];

	    	

	    	$agenda = new pre_agendamento();
	    	$agenda->preAgendar($idcliente,$idstatus,$idprioridade,$idcota);

     	 endif;

     	 if(isset($_GET['excluir']) && $_GET['excluir'] == 'excluir'):      
	     	
	     	$idclient = $_GET['idcliente']; 
	    	$idpre = $_GET['idpre'];
	    	$idcota = $_GET['idcota'];
 	
	    	$agenda2 = new pre_agendamento();
	    	$agenda2->excluirPreAgendar($idpre,$idcota);

	    	header("location:../classes/preagendar.php?idcliente=$idclient&acao=exibir");
	  
	    	

     	 endif;


 	    
 		?>



 		<fieldset>
 	 	<table>
 	 		<tr>
 	 		   <td><label><b>Paciente:<p></b></label>	</td>
 	 		   <td><?php echo $linha['nome_cliente'] ?> </td>
 	 		   <td><label><b>CNS <p></b></label>        </td>
 	 		   <td><?php echo $linha['cns_cliente'] ?>  </td>
 	 		</tr>
 	 	</table>
		</fieldset>

	<h4>CADASTRO PRE AGENDAMENTO</h4>

	<form action="" method="GET" onsubmit=" return valida_form(this)" >
		
		
			<input type="hidden" name="id" value="<?php echo $id; ?>">
		<table>
				<tr>
					<td>
						<LABEL>
							<B>UNIDADE EXECUTANTE</B>
						</LABEL>
					
				</td>
					
					<td>
						<?php 
						 $unidade = new pre_agendamento();
						 $resultUnidade=$unidade->exibirUnidade();
						 ?>

					            <select name = "unidade" onchange="showUser(this.value)" id ="unidade" >

								<option value="">SELECIONE</option>
								<?php while($lin = $resultUnidade->fetch_assoc()) {
									?>
									<option value="<?php echo $lin['id_unidade'];  ?>">
										<?php echo $lin['detalhe_unidade']; ?>
									</option>; 
								<?php }?>
								

								</select>	


					</td>
				</tr>
				<tr>
					<td><LABEL><B>PROCEDIMENTO</B></LABEL></td>
					<td>
						<div id = "txtHint" > </div>	
					</td>
				</tr>
				
				<tr>
					<td>
					<DIV>
						<b>VAGAS</b>
					</DIV>	
					
					</td>

					<TD>

						<DIV id = "vagas"></DIV>

					</TD>
				</tr>

				<tr>
					<td><label><b>PRIORIDADE:</b></label></td>
					<td>
						<div id = "retornoprioridade"></div>
						
					</td>

				</tr>
				<tr>
					<td><label><b>STATUS:</b></label></td>
					<TD><DIV id = "retornoStatus"></DIV></TD>
				</tr>
				
				<tr>
					<td></td>

					<td><input type="submit" name="acao" value="AGENDAR" ><input type="reset" name="" value="LIMPAR"> </td>

				</tr>
			</table>

			<table>
				<tr>
					    <td colspan="5"><center><label><b>PROCEDIMENTO(S) AGENDADO(S)</b></label></center></td>

				</tr>
				<tr>
					
						<td>  PROCEDIMENTO  </td>
						<td>  PREVISAO      </td>
						<td>  PRIORIDADE    </td>
						<td>  STATUS        </td>
						<td>  <CENTER>OPÇÕES       </CENTER> </td>
				</tr>
				
				<?php 

				$idcliente = $id;
				$obagenda = new pre_agendamento();
				$listapre = new pre_agendamento();
				$resultadoagenda = $obagenda->listarpreagenda($idcliente);

				if($resultadoagenda->num_rows>0){

                    while ($linha=$resultadoagenda->fetch_assoc()) {
                	       $listapreag = $listapre->listarAgendamento($linha['id_cota'],$idcliente);
 					       ?>
 				 	<tr>
 					 	
 					 	<?php  while ($linha2=$listapreag->fetch_assoc()) {
 					  ?>

 					<td>      <?php echo $linha2['descpro']; ?>                             </td>
 					<td>  <center><?php echo $linha2['mes']."/".$linha2['ano']; ?></center> </td>

 					<?php } ?>

 					<?php 
 						$prio = new pre_agendamento();
 						$resultprioridade = $prio->listarPrioridadeLista($linha['id_prioridade']);
 						$lin = $resultprioridade->fetch_assoc();
 						$status = new pre_agendamento();
 						$resultstatus = $status->listarStatusLista($linha['id_status']);
 						$lin3 = $resultstatus->fetch_assoc();
 						?>
						<td><?php echo $lin['nome_prioridade']; ?>   </td>
						<td><?php echo $lin3['descricao_status']; ?> </td>
					
						<td>
							<form action="" method="GET">
								<input type="hidden" name="idcliente" value="<?php echo $linha['id_cliente']; ?>">
								<input type="hidden" name="idcota" value="<?php echo $linha['id_cota']; ?>">
								<input type="hidden" name="idpre" value="<?php echo $linha['id_pre_agendamento']; ?>">
								<input type="submit" name="editar" value="editar">
								<input type="submit" name="excluir" value="excluir">
							</form>
						</td>
 						
				        </tr>
 					
 					<?php 
 						}
 					}
 					else{
 						echo "agendamento não localizado";
 					}
 					 ?>
 					

			
					
				
			</table>

		
 </body>

 <script type="text/javascript" language="javascript">
	function valida_form (){
	if(document.getElementById("nome").value == ""){
	alert('Por favor, preencha o campo de pesquisa com o nome do paciente');
	document.getElementById("nome").focus();
	return false;
	}
	if(document.getElementById("data").value == ""){
	alert('Por favor, preencha o campo de pesquisa com a data de nascimento do paciente');
	document.getElementById("data").focus();
	return false;
	}
	if(document.getElementById("mae").value == ""){
	alert('Por favor, preencha o campo de pesquisa com o nome da mãe do paciente');
	document.getElementById("mae").focus();
	return false;
	}
				
	}
	
		
  </script>
 </html>