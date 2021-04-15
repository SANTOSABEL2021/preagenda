<?php 
		include_once "clientes.php";
		
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
    	$cns = $_GET["cns_form"];
 		 		

 		if(isset($_GET['cadastrar']) && $_GET['cadastrar'] == 'cadastrar'):
	 	 	$cartao = $_GET['cartao'];
	 	 	$datanascimento = $_GET['data'];
	 	 	$sexo=$_GET['sexo'];
	 	 	$nome=$_GET['nome'];
	 	 	$pai=$_GET['pai'];
	 	 	$mae=$_GET['mae'];
	 	 	$cliente = new clientes();
	 	  	$processar = $cliente->cadastrarCliente($cartao,$datanascimento,$sexo,$nome,$pai,$mae);
	 	 	header("location: ../pesquisar.php?cliente_form2=$nome&acao2=consultar");
 	    endif;
 	    if(isset($_GET['cancelar']) && $_GET['cancelar'] == 'cancelar'):
 	    	$nome="";
	 	 	header("location: ../pesquisar.php");
 	    endif;
 	    

 		?>

 	 

 	<form method="GET" onsubmit="return valida_form(this)" >
 		<table>
 			<tr>
 				<td colspan="4"><center><img src="img/cadastropaciente.png"></center></td>
 			</tr>

 			<tr>
 				<td><label>CARTÃO DO SUS</label></td>
 				<TD><?php echo $cns; ?>
 				<input type="hidden" name="cartao" value="<?php echo $cns; ?>">
 				 </TD>
 				<TD><LABEL>NOME</LABEL></TD>
 				<TD><input type="text" name="nome" id="nome" size="60"></TD>
 				
 			</tr>
 			<tr>
 				<td><label>DATA DE NASCIMENTO</label></td>
 				<td><input type="date" name="data" id="data" size="10"></td>
 				<td>SEXO</td>
 				<td>
 					<select name="sexo">
 					<?php 
 					$clisexo = new clientes();
 					$listasexo = $clisexo->exibirsexo();
 					if($listasexo->num_rows>0){
                      while ($linha=$listasexo->fetch_assoc()) {
 					 ?>
 					
 						<option value="<?php echo $linha['id_sexo']; ?>"><?php echo $linha['detalhe_sexo']; ?></option>
 					
 					<?php 
 						}}
 					 ?>
 					 </select>

 				</td>
 			</tr>
 			<TR>
 				<TD><label>MAE</label></TD>
 				<td><input type="text" name="mae" id="mae" size="60"></td>
 				<td><label>PAI</label></td>
 				<td><input type="text" name="pai" size="60"></td>
 			</TR>
 			<tr>
 				
 				<td colspan="4">
 					<input type="submit" name="cadastrar" value="cadastrar">
 					<input type="reset" name="limpar" value="limpar">
 				</td>
 			</tr>
 			</form>
 			<tr>
 				<td colspan="4">
 					<form method="GET">
 						<input type="submit" name="cancelar" value="cancelar">
 					</form>
 				</td>
 			</tr>
 		</table>
 		
 	
 	 </div>



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