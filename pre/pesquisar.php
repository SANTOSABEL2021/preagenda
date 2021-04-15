<?php 
include_once "./classes/clientes.php";
include_once "./classes/usuarios.php";
include_once "./classes/cotas.php";
include_once "./classes/pre_agendamento.php";
include_once "./classes/endereco_paciente.php";

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>AGENDA/Pesquisar</title>
 	<link rel="stylesheet" type="text/css" href="estilopaginass.css">
 </head>
 <body>


 <div class="painel"> 
 	
 	<div class="descricao">
 		<img src="classes/img/logo.png">
 	<?php 

 	 if(isset($_GET['alterar']) && $_GET['alterar'] == 'ALTERAR'):
 	 	$id= $_GET["idcliente"];
 	 	$alter = "alterar";
 	 	header("location: ./classes/alterarcliente.php?idcliente=$id&acao=$alter");
 	 endif;

 	  if(isset($_GET['cadastrarendereco']) && $_GET['cadastrarendereco'] == 'ENDEREÇO'):
 	 	$id= $_GET["idcliente"];
 	 	header("location: ./classes/cadastrarendereco.php?idcliente=$id");
 	 endif;

 	 if(isset($_GET['preagendar']) && $_GET['preagendar'] == 'PRE AGENDAR'):
 	 	$id= $_GET["idcliente"];
 	 	header("location: ./classes/preagendar.php?idcliente=$id&acao=exibir");
 	 endif;

 	
 	 if(isset($_GET['acao']) && $_GET['acao'] == 'cadastrar'):
			$cns = $_GET['cliente_form'];
			$cliente = new clientes();
			$resultadopesquisacns = $cliente->consultaCNS($cns);
						
		
			if($resultadopesquisacns->num_rows > 0){
				$row = $resultadopesquisacns->fetch_assoc();
				$cartaocliente=$row['cns_cliente'];
				$nome=$row['nome_cliente'];
			
				header("location:pesquisar.php?cliente_form2=$nome&acao2=consultar");
				//echo  "<p style='color:red;'>AVISO!! o cartão do SUS nº $cartaocliente do(a) cliente $nome já cadastrado</p>";
							
			}else{
			
				//echo "cliente ainda não cadastrado";					
				header("location:classes/cadastrarcliente.php?acao=cadastrar&cns_form=$cns");
			
			}
			endif;
	?>
 		
 	</div>

 </div>
 <div class="conteiner">
 	
 	<div class="lado">
 		<div class="item">
 			<a href="home.php"><p>Home</p></a>
 			</div>
 		<div class="item">
 			<a href="pesquisar.php"><p>Pesquisar</p></a>
 			</div>
 		<div class="item">
 			<a href="resumo.php"><p>Resumo</p></a>
 			</div>
 		<div class="item">
 			<a href="relatorio.php"><p>Relatórios</p></a>
 			</div>
 		<div class="item">
 			<a href="admcotas.php"><p>Adm/Cotas</p></a>
 		</div>

 	</div>
 			<div class="area">
 				<table>
 				<tr>
 					<td colspan="2"><center><H1>PESQUISAR</H1></center></td>
 				</tr>
 				<form name="form" action="" method="GET"	onsubmit="return valida_form(this)" >
 				<tr>
 					<td><label>Digite Cartão do SUS:</label></td>
 					<td><input type='text' name="cliente_form" id="cliente_form" size='20' maxlength="15" ></td>
 				</tr>
 				<tr>
 					<td></td>
 					<td>
 						<input type="submit" name="acao" value="cadastrar">
 						<input type="reset" value="limpar">

 					</td>
 				</tr>
			</form>
				
			<form name="Consultar" action="" method="GET" onsubmit="return valida_form2(this)">
				<tr>
					<td><label>Escolha o nome do Cliente:</label></td>
					<td><input type="text" id= "cliente_form2" name="cliente_form2"  size="60"></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" name="acao2" value="consultar">
						<input type="reset" value="limpar">
					</td>
				</tr>
								
			</form>
 			</table>
 			<table>
 				<tr>
 					<td>CNS</td>
 					<td>NOME</td>
 					<td>IDADE</td>
 					<td>OPÇÕES</td>
 				</tr>
				<?php 

 				if(isset($_GET['acao2']) && $_GET['acao2'] == 'consultar'):
				$nome = $_GET['cliente_form2'];
				$cliente = new clientes();
				$resultadopesquisanome = $cliente->consultaNomeCliente($nome);
				 			 			
 				if ($resultadopesquisanome->num_rows > 0) {
			 	while($row = $resultadopesquisanome->fetch_assoc()) {
			 		?>
			 	<tr>
			 	<td>
			    <?php echo $row["cns_cliente"]; ?>
			   </td>
			   <td>
			   <?php echo $row["nome_cliente"]; ?> 
			   </td>
			   <?php 
			   		//calculo de idade	
					$data =  $row["data_nascimento"];
					// separando yyyy, mm, ddd
					list($ano, $mes, $dia) = explode('-', $data);
					// data atual
					$hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
					// Descobre a unix timestamp da data de nascimento do fulano
					$nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
					// cálculo
					$idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
					//fim do calculo de idade
			    ?>
			    <td>
			    <?php echo $idade." "."ano(s)"; ?>
			    </td>
			    <td>
			    	<form method="GET">
			    		<input type="hidden" name="idcliente" value="<?php echo $row["id_cliente"]; ?>">
			    		<input type="submit" name="alterar" value="ALTERAR">
			    		<input type="submit" name="cadastrarendereco" value="ENDEREÇO">
			    		<input type="submit" name="preagendar" value="PRE AGENDAR">
			    		
			    	</form>
 				</td>
				</tr>
			    	<?php 
		   
			  }

			} else {
			  echo "<tr>";
			  echo "<td colspan='4'>";
			  echo "CLIENTE NÃO LOCALIZADO, REFAZER A PESQUISA OU CADASTRAR.";
			  echo "</td>";
			  echo "</tr>";
			}
			endif;
			 ?>
 			</table>
 			</div>
 	 </body>

 <script type="text/javascript" language="javascript">
	function valida_form (){
	if(document.getElementById("cliente_form").value == ""){
	alert('Por favor, preencha o campo de pesquisa com CNS do cliente');
	document.getElementById("cliente_form").focus();
	return false;
	}
			if( isNaN( document.getElementById("cliente_form").value) ) {
			alert('O CNS do paciente deve possuir somente digitos numericos.');
			document.getElementById("cliente_form").focus();
			return false;
		}
			if ( document.getElementById("cliente_form").value.length != 15  ){
			alert('O CNS deve possuir 15 digitos.');
			document.getElementById("cliente_form").focus();
			return false;
		}
		if ( (cns_validar( document.getElementById("cliente_form").value ) == false) && (document.getElementById("cliente_form").value.length == 15) ){
			alert('O CNS informado nao e valido.');
			document.getElementById("cliente_form").focus();
			return false;
		}
	}
	
	function valida_form2 (){
	if(document.getElementById("cliente_form2").value == ""){
	alert('Por favor, preencha o campo de pesquisa');
	document.getElementById("cliente_form2").focus();
	return false
	}
	}
	
  </script>
 </html>