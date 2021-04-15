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
	<title>PRE AGENDAMENTO MUNICIPAL</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
<div class="login">
	<h1>Agenda/LOGIN</h1>
    <form method="post">
    	<input type="text" name="u" placeholder="Usuário" required="required" />
        <input type="password" name="p" placeholder="Senha" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large">Acessar</button>
    </form>
</div>
</body>
</html>
