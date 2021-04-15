<?php 

include_once "clientes.php";
include_once "endereco_paciente.php";


 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>AGENDA/Pesquisar</title>
 	<link rel="stylesheet" type="text/css" href="../estilopaginas.css">
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
 			$id = $_GET["idcliente"];
 			
 			$cliente = new clientes();
 			$resultado2=$cliente->exibircliente($id);
 			$row = $resultado2->fetch_assoc();
 			

 		if(isset($_GET['cadastrar']) && $_GET['cadastrar'] == 'cadastrar'):

	 	 	$id_paciente= $_GET["idcliente"];
	 	 	$logradouro = $_GET['rua'];
	 	 	$nr=$_GET['nr'];
	 	 	$bairro=$_GET['bairro'];
	 	 	$id_cidade=$_GET['cidade'];
	 	 	$telefone=$_GET['telefone'];


	 	 	$objendereco = new endereco_paciente();
	 	 	$objendereco->cadastrarEndereco($logradouro,$nr,$bairro,$id_cidade,$id_paciente,$telefone);
 	 	header("location: cadastrarendereco.php?idcliente=$id_paciente");
 	    endif;

 	   
 	     if(isset($_GET['excluir']) && $_GET['excluir'] == 'excluir'):
 	    	$id=$_GET['idendereco'];
 	    	$id_paciente=$_GET['idcliente'];
 	    	$end = new endereco_paciente();
 	    	
 	    	if ($resuldado=$end->excluir($id) === TRUE) {
 	    		header("location: cadastrarendereco.php?idcliente=$id_paciente");
			} else {
			  echo "falha ao excluir: " ;
			}

 	    
 	    	
 	    endif;


 			 		 ?>

 		<form method="GET" onsubmit="return valida_form(this)">
 			<table>
 				<TR>
 					<TD colspan="4"><center><img src="img/paciente.png"></center></TD>
 				</TR>
 				<tr>
 					<td><label>PACIENTE</label></td>
 					<TD><?php echo $row['nome_cliente']; ?>
 						<input type="hidden" name="nome" value="<?php echo $row['nome_cliente']; ?>">

 					</TD>
 					<TD><LABEL>CARTÃO DO SUS</LABEL></TD>
 					<TD><?php echo $row['cns_cliente']; ?></TD>
 				</tr>
 				<TR>
 					<TD colspan="4"><center><img src="img/cadastropaciente.png"></center></TD>
 				</TR>
 				<tr>
 					<td><label>RUA</label></TD>
 					<td><input type="text" name="rua" size="60" id="rua"></td>
 					<TD><LABEL>Nº</LABEL></TD>
 					<TD><input type="text" name="nr" id="nr"></TD>
 				</tr>
 				<TR>
 					<TD><label>BAIRRO</label></TD>
 					<TD><input type="text" name="bairro" id="bairro"></TD>
 					<td><label>CIDADE</label></td>
 					<TD>
 						<select name="cidade">
 							<?php 
                            $cidade = new endereco_paciente();
                            $res=$cidade->exibircidade(); 
                            if($res->num_rows>0){
                            	while ($linha=$res->fetch_assoc()) {
                            		
                            
	 						?>
 						<option value="<?php echo $linha['id_cidade'] ?>"><?php echo $linha['descricao_cidade']; ?></option>

 						<?php  }}?>
 						</select>
 					
 					</TD>
 				</TR>
 				<tr>
 					<td></td>
 					<td></td>
 					<td><label>TELEFONE:</label></td>
 					<TD><input type="text" name="telefone">

 						<input type="hidden" name="idcliente" value="<?php echo $row['id_cliente']; ?>">
 					</TD>
 				</TR>
 				<tr>

 					<td colspan="2"><input type="submit" name="cadastrar" value="cadastrar" ><input type="reset" name="limpar" value="limpar">
 						
 					</td>
 					<td colspan="2">
 						<a href="../pesquisar.php?cliente_form2=null&acao2=consultar">VOLTAR</a>
 					</td>
 				</tr>
 				
 			</table>
 		</form>

 		<?php 
 			
 			$endereco = new endereco_paciente();
 			$result = $endereco->exibirEndereco($id);

 						
 			
 		 ?>
 		 <table>
 		 	<tr>
 		 		<td colspan="3"><center><img src="img/enderecocadastrado.png"></center></td>
 		 	</tr>
 		 	<?php 
 		 	if ($result->num_rows > 0) {
 		 	while($row = $result->fetch_assoc()) {
 		 	?>
 		 	 
 		 	<tr>
 		 		<td><?php echo "Endereço: ".$row['id_endereco_paciente']; ?></td>
 		 		<TD><?php echo $row['logradouro_paciente'].",Número: ".$row['nr_endereco_paciente']." ,Bairro: ".$row['bairro_paciente']. " e Telefone: ".$row['telefone_cliente']; ?></TD>
 		 		<td>
 		 			<form method="GET">
 		 				<input type="hidden" name="idcliente" value="<?php echo $row['id_paciente']; ?>">
 		 				<input type="hidden" name="idendereco" value="<?php echo $row['id_endereco_paciente']; ?>">
 		 				<input type="submit" name="excluir" value="excluir">
 		 			</form>

 		 		</td>
 		 		
 		 	</tr>


 		 <?php } 

 		}else{
 			echo "nunhum endereço cadastrado";
 		}
 		?>
 		 </table>
 		
 </div>
 </body>
 <script type="text/javascript" language="javascript">
	function valida_form (){
	if(document.getElementById("rua").value == ""){
	alert('Por favor, preencha o campo logradouro');
	document.getElementById("rua").focus();
	return false;
	}
	if(document.getElementById("nr").value == ""){
	alert('Por favor, preencha o campo numero');
	document.getElementById("nr").focus();
	return false;
	}
	if(document.getElementById("bairro").value == ""){
	alert('Por favor, preencha o campo bairro');
	document.getElementById("bairro").focus();
	return false;
	}
			
	}
	
	
  </script>
 </html>