<?php
	$servidor = "localhost";
	$usuario = "root";
	$senha = "MMallf@@1520";
	$dbname = "oldlove";
	
	//Criar a conexao
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
	
	if(!$conn){
		die("Falha na conexao: " . mysqli_connect_error());
	}
	
?>