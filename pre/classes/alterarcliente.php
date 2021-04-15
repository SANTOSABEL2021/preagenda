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
 		<h3>PRÉ AGENDAMENTO ESPECIALIZADO DE PORTO DE MOZ</h3>
 	</div>

 </div>
 <div class="conteiner">
 	<div class="lado">
 	</div>
 	<div class="area">

 		<?php 
 		if(isset($_GET['acao']) && $_GET['acao'] =='alterar'):
 			$id2 = $_GET["idcliente"];
 			
 			$cliente = new clientes();
 			$resultado2=$cliente->exibircliente($id2);
 			$row = $resultado2->fetch_assoc();
 		endif;

 		if(isset($_GET['voltar']) && $_GET['voltar'] == 'CANCELAR'):
 	 	   $id = $_GET["idcliente"];
 	 	   $nome=$_GET["nome"];
 	 	   header("location: ../pesquisar.php?cliente_form2=$nome&acao2=consultar");
 	 	endif;

 	 	if(isset($_GET['editar']) && $_GET['editar'] == 'EDITAR'):
 	 	   $id = $_GET["id"];
 	 	   $cns = $_GET["cns"];
 	 	   $nome=$_GET["nome"];
 	 	   $sexo=$_GET["sexo"];
 	 	   $pai=$_GET["pai"];
 	 	   $mae=$_GET["mae"];
 	 	   $datanascimento = $_GET["data"];

 	 	   $cliente = new clientes();
 	 	   $cliente->alterarCliente($id,$cns,$datanascimento,$sexo,$nome,$pai,$mae);
 	 	   header("location: ../pesquisar.php?cliente_form2=$nome&acao2=consultar");
 	 	endif;

 	 		if(isset($_GET['cancelar']) && $_GET['cancelar'] == 'cancelar'):
 	    	$nome=$_GET['nome'];
 	    	header("location: ../pesquisar.php?cliente_form2=$nome&acao2=consultar");
 	    	
 	    endif;
 				 ?>

 		<form action="" method="GET">
 			<?php  ?>
 			<table>
 				<tr>
 					<td colspan="4"><center><h3>ALTERAR DADOS DE PACIENTE</h3></center></td>
 				</tr>
 				<tr>
 					<td>NOME</td>
 					<TD><input type="text" name="nome" value="<?php echo $row["nome_cliente"]; ?>" size="60"></TD>
 					<TD>CARTÃO DO SUS</TD>
 					<TD>
 						<input type="hidden" name="cns" value=" <?php echo $row["cns_cliente"]; ?> ">
 					 <?php echo $row["cns_cliente"]; ?> 


 					</TD>
 				</tr>
 				<tr>
 					<td>DATA DE NASCIMENTO</td>
 					<TD><input type="date" name="data" value="<?php echo $row['data_nascimento']; ?>"></TD>
 					<TD>SEXO</TD>
 					<TD>
 								
 						<select name="sexo" >
 							<?php 
 							$selsexo = new clientes();
 							$resultsexo=$selsexo->exibirsexo();
 							 ?>
 									
 		 				<?php 
	 						while($linha = $resultsexo->fetch_assoc()) {
	 						if($row['sexo_cliente'] == $linha['id_sexo']){
	 							$selecao = "selected";
 						}
	 						else{
	 							$selecao = "nada";
 						}
 					 	?>
							<option value="<?php echo $linha['id_sexo'];?>" <?php echo $selecao; ?>  ><?php echo $linha['detalhe_sexo']; ?></option>
    					
  						<?php 
  						}
 						 ?>
 						</select>

 					</TD>

 				</tr>
 				<TR>
 					<TD>MAE</TD>
 					<TD><input type="text" name="mae" value="<?php echo $row['mae_cliente']; ?>" size="60"></TD>
 					<TD>PAI</TD>
 					<TD><input type="text" name="pai" value="<?php echo $row['pai_cliente']; ?>" size="60"></TD>
 				</TR>
 				<TR>
 					<TD></TD>
 					<TD colspan = "3">
 						<input type="hidden" name="id" value="<?php echo $row['id_cliente']; ?>">
 						<input type="submit" name="editar" value="EDITAR">
 						<input type="submit" name="voltar" value="CANCELAR">
 					</TD>
 				</TR>
 			</table>
 			
 			
 		</form>
 		

 </div>
 </body>
 </html>