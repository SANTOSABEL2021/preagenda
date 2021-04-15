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
 </head>
 <body>
 <div class="painel"> 
 	
 	<div class="descricao">
 	<img src="img/logo.png">
 		
 	</div>

 </div>
 <div class="conteiner">
 	
 	<div class="lado">
 		

 	</div>
 	<div class="area">
 		
 		<?php 
 		//AREA DE CONTROLE DE PROCESSAMENTO

 		if(isset($_GET['editar']) && $_GET['editar'] == 'editar'){

 			$idcliente = $_GET['id'];
	       	$idcota = $_GET['idcota'];
	     	$idpreagenda = $_GET['idpre'];

	     	$prio2 = new pre_agendamento();
	     	$resultprio = $prio2->exibiragendapre($idpreagenda);

	     	$cliente = new clientes();
	 		$result  = $cliente->exibircliente($idcliente);
	 		$linha   = $result->fetch_assoc();
 		     	     		
 		}

 		if(isset($_GET['alterar']) && $_GET['alterar'] == 'ALTERAR'){

 			$idclientenovo = $_GET['idcliente'];
 			$idpreagendanovo = $_GET['idpreagenda'];
 			$prioridadenovo = $_GET['prioridade'];
 			$statusnovo = $_GET['status'];

 			$alterar = new pre_agendamento();
 			$alterar->alterarPreAgenda($idpreagendanovo,$statusnovo,$prioridadenovo);
 			header("location:../classes/preagendar.php?idcliente=$idclientenovo&acao=exibir");

 			 			
       	}

 		 ?>

 		 <form action="" method="GET">
 		 	<table>
 		 		<tr>
 		 			<td colspan="2"><center><label><B>ALTERAR PRE AGENDAMENTO</B></label></center></td>
 		 		</tr>
 		 		<tr>
 		 			<td><label>ID CLIENTE:</label></td>
 		 			<td><?php echo 	$idcliente; ?> </td>
 		 			<input type="hidden" name="idcliente" value="<?php echo $idcliente; ?>">
 		 			<input type="hidden" name="idpreagenda" value="<?php echo $idpreagenda;'' ?>">
 		 		</tr>
 		 		<tr>
 		 			<td><label>CLIENTE:</label></td>
 		 			<td><?php echo $linha['nome_cliente']; ?></td>
 		 		</tr>
 		 		<tr>
 		 			<td><label>CNS</label></td>
 		 			<td><?php echo $linha['cns_cliente']; ?></td>
 		 		</tr>
 		 		<tr>
 		 			<td colspan="2"><center><b>PRIORIDADE/STATUS</b></center></td>

 		 		</tr>
 		 		<tr>
 		 			<td><label>PRIORIDADE:</label></td>
 		 			<td>
 		 				
 		 			<?php 
 		 			$prio = new pre_agendamento();
 		 			$listaprioridade = $prio->listarPrioridade();
		 			 ?>
 		 			 <select name="prioridade">
 		 			 
					 <?php while($lin = $listaprioridade->fetch_assoc()) {
					 	
					 	if($resultprio['id_prioridade'] == $lin['id_prioridade']){
	 							$selecao = "selected";
 						}
	 						else{
	 							$selecao = "nada";
 						}

					 		?>
									<option value="<?php echo $lin['id_prioridade'];  ?>"  <?php echo $selecao; ?>>
										<?php echo $lin['nome_prioridade']; ?>

									</option>; 
								<?php }?>	
 		 			 </select>
 		 			</td>

 		 		</tr>
 		 		<TR>
 		 			<TD><label>STATUS:</label></TD>
 		 			<TD>
 		 				
 		 			<?php 
 		 			$status = new pre_agendamento();
 		 			$listastatus = $status->listarStatus();
		 			 ?>
 		 			 <select name="status">
 		 			
					 <?php while($lin3 = $listastatus->fetch_assoc()) {

					 		if($resultprio['id_status'] == $lin3['id_status']){
	 							$selecao = "selected";
 						}
	 						else{
	 							$selecao = "nada";
 						}

					 	
									?>
									<option value="<?php echo $lin3['id_status'];  ?>" <?php echo $selecao; ?>>
										<?php echo $lin3['descricao_status']; ?>
									</option>; 
								<?php }?>	
 		 			 </select>	
 		 			</TD>
 		 		</TR>

 		 		<tr>
 		 			<td colspan="2"><input type="submit" name="alterar" value="ALTERAR"></td>
 		 		</tr>
 		 	</table>
 		 	
 		 </form>

 	
 		
 </div>
 </body>
 </html>