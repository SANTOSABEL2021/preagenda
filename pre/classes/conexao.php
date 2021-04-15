<?php 
class conexao{

	public $servidor = "localhost";
	public $usuario = "root";
	public $senha = "";
	public $banco = "bd_pre";
	public $conexao ="";

	function conexao(){
	$this->conexao = new mysqli($this->servidor, $this->usuario, $this->senha,$this->banco);
	}

}

 ?>