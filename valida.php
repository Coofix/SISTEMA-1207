<?php
	session_start();	
	//Incluindo a conexão com banco de dados
	include_once("conexao.php");	
	//O campo usuário e senha preenchido entra no if para validar
	if((isset($_POST['email'])) && (isset($_POST['senha']))){
		$email = mysqli_real_escape_string($conn, $_POST['email']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
		$senha = mysqli_real_escape_string($conn, $_POST['senha']);
			
		//Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
		$result_funcionario = "SELECT * FROM FUNCIONARIO WHERE email = '$email' && senha = '$senha' LIMIT 1";
		$result_cliente = "SELECT * FROM CLIENTE WHERE email = '$email' && senha = '$senha' LIMIT 1";
		
		$resultado_funcionario = mysqli_query($conn, $result_funcionario);
		$resultado_cliente = mysqli_query($conn, $result_cliente);
		
		$resultado = mysqli_fetch_assoc($resultado_funcionario);
		$resultado_cli = mysqli_fetch_assoc($resultado_cliente);
		
		//Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
		if(isset($resultado_cli) ){
			$_SESSION['usuarioId'] = $resultado_cli['id'];
			$_SESSION['usuarioNome'] = $resultado_cli['nome'];
			$_SESSION['usuarioNiveisAcessoId'] = $resultado_cli['niveis_acesso_id'];
			$_SESSION['usuarioEmail'] = $resultado_cli['email'];
			header("Location: index.php");
			//if($_SESSION['usuarioNiveisAcessoId'] == "1"){
			//	header("Location: administrativo.php");
			//}elseif($_SESSION['usuarioNiveisAcessoId'] == "2"){
			//	header("Location: colaborador.php");
			//}else{
				
			//}
		
		}elseif(isset($resultado)){
			$_SESSION['usuarioId'] = $resultado['id'];
			$_SESSION['usuarioNome'] = $resultado_['nome'];
			$_SESSION['usuarioNiveisAcessoId'] = $resultado['niveis_acesso_id'];
			$_SESSION['usuarioEmail'] = $resultado['email'];
			if($_SESSION['usuarioNiveisAcessoId'] == "1"){
				header("Location: administrativo.php");
			}elseif($_SESSION['usuarioNiveisAcessoId'] == "2"){
				header("Location: colaborador.php");
			}else{
				header("Location: index.php");
			}
			//Não foi encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
		//redireciona o usuario para a página de login
		}else{	
			//Váriavel global recebendo a mensagem de erro
			$_SESSION['loginErro'] = "Email ou senha Inválido,.";
			header("Location: pagin-login.php");
		}
	//O campo usuário e senha não preenchido entra no else e redireciona o usuário para a página de login
	}else{
		$_SESSION['loginErro'] = "Digite o Email ou senha";
		header("Location: pagin-login.php");
	}
?>