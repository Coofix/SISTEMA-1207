<?php

    include("php/conexao.php");
    session_start();

    
    if(!$_SESSION['usuarioEmail']){
        header('Location: pagin-login.php');
        exit();
    }

    if(isset($_POST['confirmar'])){

        // 1 - Registro dos dados

        if(!isset($_SESSION))
            session_start();

            foreach ($_POST as $chave => $valor) {
                $_SESSION[$chave] = $mysqli->real_escape_string($valor);
            }


        // 2 - Validação de dados
        
        if(strlen($_SESSION['nome_cliente']) == 0)
            $erro[] = "Preencha o nome";

        if(strlen($_SESSION['data_nascimento']) == 0)
            $erro[] = "Preencha a data de nascimento";
        
        if(strlen($_SESSION['endereco']) == 0)
            $erro[] = "Preencha o seu endereço";

        if(strlen($_SESSION['estado']) == 0)
            $erro[] = "Preencha o seu estado"; 
        
        if(strlen($_SESSION['cidade']) == 0)
            $erro[] = "Preencha a sua cidade";    

        if(strlen($_SESSION['cpf']) == 0)
            $erro[] = "Preencha o cpf corretamente"; 
        
        if(strlen($_SESSION['rg']) == 0)
            $erro[] = "Preencha o seu rg corretamente";  

        if(strlen($_SESSION['num_celu']) == 0)
            $erro[] = "Preencha com seu numero"; 
        
        if(substr_count($_SESSION['email'], '@') !=1 || substr_count($_SESSION['email'], '.') <1 || substr_count($_SESSION['email'], '.') >2)
            $erro[] = "Preencha o email corretamente";   
    
        if(strlen($_SESSION['senha']) == 0)
            $erro[] = "Preencha a senha corretamente";

        // 3 - Inserção no banco de dados e redicionamento
        if(count($erro) == 0){


            $sql_code = "INSERT INTO CLIENTE (
                nome_cliente,
                data_nascimento,
                endereco,
                estado,
                cidade,
                rg,
                cpf,
                num_celu,
                tel_fixo,
                email,
                senha)
                VALUES(
                '$_SESSION[nome_cliente]',
                '$_SESSION[data_nascimento]',
                '$_SESSION[endereco]',
                '$_SESSION[estado]',
                '$_SESSION[cidade]',
                '$_SESSION[rg]',
                '$_SESSION[cpf]',
                '$_SESSION[num_celu]',
                '$_SESSION[tel_fixo]',
                '$_SESSION[email]',
                '$_SESSION[senha]'
                )";

            $confirma = $mysqli ->query($sql_code) or die($mysqli->error);
            
            if($confirma){
                unset($_SESSION[nome_cliente],
                $_SESSION[data_nascimento],
                $_SESSION[endereco],
                $_SESSION[estado],
                $_SESSION[cidade],
                $_SESSION[rg],
                $_SESSION[cpf],
                $_SESSION[num_celu],
                $_SESSION[tel_fixo],
                $_SESSION[email],
                $_SESSION[senha]);

                echo "<script> location.href='listagem-cliente.php';</script>";

            }else
                $erro[]=$confirma;

        }    
    }

    
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro cliente</title>

    <!-- Common plugins -->
    <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="plugins/simple-line-icons/simple-line-icons.css" rel="stylesheet">
    <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="plugins/pace/pace.css" rel="stylesheet">
    <link href="plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/nano-scroll/nanoscroller.css">
    <link rel="stylesheet" href="plugins/metisMenu/metisMenu.min.css">
    <link href="plugins/iCheck/blue.css" rel="stylesheet">
    <!--template css-->
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <!--top bar start-->
    <div class="top-bar light-top-bar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-6">
                    <a href="index.html" class="admin-logo">
                        <h1><img src="images/logo-dark.png" alt=""></h1>
                    </a>
                    <div class="left-nav-toggle visible-xs visible-sm">
                        <a href="">
                            <i class="glyphicon glyphicon-menu-hamburger"></i>
                        </a>
                    </div>
                    <!--end nav toggle icon-->

                </div>
                <div class="col-xs-6">
                    <ul class="list-inline top-right-nav">
                        <li class="dropdown avtar-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="images/avtar-1.jpg" class="img-circle" width="30" alt="">
                            </a>
                            <ul class="dropdown-menu top-dropdown">
                                <!-- <li><a href="javascript: void(0);"><i class="icon-bell"></i> Activities</a></li>
                                        <li><a href="javascript: void(0);"><i class="icon-user"></i> Profile</a></li>
                                        <li><a href="javascript: void(0);"><i class="icon-settings"></i> Settings</a></li>
                                        <li class="divider"></li> -->
                                <li><a href="javascript: void(0);"><i class="icon-logout"></i> Sair</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- top bar end-->

    <!--left navigation start-->
    <aside class="float-navigation light-navigation">
        <div class="nano">
            <div class="nano-content">
                <ul class="metisMenu nav" id="menu">
                    <li class="nav-heading"><span></span></li>
                    <li><a href="dadosdiarios.php"><i class="fa fa-user"></i> Dados Diários </a></li>
                    <li><a href="page-calendar.html"><i class="fa fa-calendar"></i> Historico paciente </a></li>
                    <li><a href="gerenciamento.html"><i class="fa fa-server"></i> Gerenciamento </a></li>
                    <li><a href="sair10.php"><i class="fa fa-sign-in"></i> Sair </a></li>
                </ul>
            </div>
            <!--nano content-->
        </div>
        <!--nano scroll end-->
    </aside>
    <!--left navigation end-->

    <!--main content start-->
    <section class="main-content">

        <!--page header start-->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Cadastro Cliente</h3>
                </div>
            </div>
        </div>
        <!--page header end-->

        <!-- page body start -->
        <div class="panel panel-default">

        <?php
            if(count($erro) > 0){
                echo "<div class='erro'>";
                foreach($erro as $valor)
                    echo "$valor <br>";

                echo"</div>";
            }


        ?>

            <form style="margin: 1%;" action="cadastrocliente.php" method="POST">
                <div class="form-row">
                    <!-- informações sobre cliente start -->
                    <div class="col-md-6 mb-3">
                        <label for="nome_cliente">Nome Completo</label>
                        <input type="text" class="form-control" id="nome_cliente" name="nome_cliente" required>
                    </div>
                    <div class="col-md-3 mb-1">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" id="id_cliente" name="id_cliente" disabled>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="data_nascimento">Data de Nascimento</label>
                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" require>
                    </div>
                </div>


                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="endereco">Endereço</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" required>
                    </div>
                    <div class="col-md-3 mb-1">
                        <label for="estado">Estado</label>
                        <input type="text" class="form-control" id="estado" name="estado" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cidade">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="rg">RG</label>
                        <input type="text" class="form-control" id="rg" name="rg" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cpf">CPF</label>
                        <input type="number" class="form-control" id="cpf" name="cpf" required>
                    </div>
                </div>

                

                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label for="validationDefault03">Numero de Celular</label>
                        <input type="number" class="form-control" id="num_celu" name="num_celu" required>
                    </div>
                    <div class="col-md-3 mb-1">
                        <label for="validationDefault04">Telefone Fixo</label>
                        <input type="number" class="form-control" id="tel_fixo" name="tel_fixo">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationDefault05">Nome do paciente internado</label>
                        <input type="text" class="form-control" id="nome_paciente" name="nome_paciente" disabled>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="validationDefault05">ID do paciente internado</label>
                        <input type="text" class="form-control" id="id_paciente" name="id_paciente"  disabled>
                    </div>
                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Parentesco</label>
                        <input type="text" class="form-control" id="parentesco" name="parentesco" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputPassword4">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha">
                    </div>
                    <!--informações do cliente end-->
                </div>

                <div class="form-row">
                    <div align="right">
                        <button type="submit" class="btn  btn-primary" name="confirmar" id=>Registrar</button>
                    </div>
                </div>
            </form>
        </div>



        <!--Start footer-->
        <footer class="footer">
            <span>Copyright &copy; 2020. Coofix</span>
        </footer>
        <!--end footer-->

    </section>
    <!--end main content-->




    <!--Common plugins-->
    <script src="plugins/jquery/dist/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/pace/pace.min.js"></script>
    <script src="plugins/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
    <script src="plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="plugins/nano-scroll/jquery.nanoscroller.min.js"></script>
    <script src="plugins/metisMenu/metisMenu.min.js"></script>
    <script src="js/float-custom.js"></script>
    <!-- iCheck for radio and checkboxes -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue'
            });
        });
    </script>

</body>

</html>