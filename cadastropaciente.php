<?php

    include("php/conexao.php");session_start();

    
    if(!$_SESSION['usuarioEmail']){
        header('Location: pagin-login.php');
        exit();
    }

    //1- Registro dos dados do cliente
    if(isset($_POST['incluir_paciente'])){
        session_start();

        foreach ($_POST as $chave=>$valor){
            $_SESSION[$chave] = $mysqli->real_escape_string($valor);
        }

        // 2 - Validação dos dados
        if(strlen($_SESSION['nome_paciente'])== 0 )
            $erro[] = "Prencha o nome do paciente";

        if(strlen($_SESSION['data_nascimento']) == 0)
            $erro[] = "Preencha a data de nasciento";

        if(strlen($_SESSION['endereco']) == 0)
            $erro[] = "Preencha a data de nasciento";
            
        if(strlen($_SESSION['estado']) == 0)
            $erro[] = "Preencha a data de nasciento";

        if(strlen($_SESSION['cidade']) == 0)
            $erro[] = "Preencha a cidade";

        if(strlen($_SESSION['rg']) == 0)
            $erro[] = "Preencha a rg";
            
        if(strlen($_SESSION['cpf']) == 0)
            $erro[] = "Preencha a cpf";


        // 3 Inserção no banco de dados
        if(count($erro) == 0){

            $sql_code = "INSERT INTO PACIENTE (
                id_paciente,
                nome_paciente,
                data_nascimento,
                endereco,
                estado,
                cidade,
                rg,
                cpf)
                VALUES(
                 id_paciente,
                '$_SESSION[nome_paciente]',
                '$_SESSION[data_nascimento]',
                '$_SESSION[endereco]',
                '$_SESSION[estado]',
                '$_SESSION[cidade]',
                '$_SESSION[rg]',
                '$_SESSION[cpf]')";


        $confirma = $mysqli->query($sql_code) or die($mysqli->error);
        echo "<script> location.href='cadastropaciente2.php?nome_paciente=$_SESSION[nome_paciente]';</script>";
        if(!$confirma){
            $erro[] =$confirma;
        
        }else{
            echo "USUARIO CADASTRADO COM SUCESSO";
        }
            

    }
  } 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Cadastro Paciente</title>

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
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
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
                    <h4>Cadastro Paciente</h4>
                </div>

            </div>
        </div>
        <!--page header end-->

        <!--start page content-->
    <div class="row">
    <?php
            if(count($erro) > 0){
                echo "<div class='erro'>";
                foreach($erro as $valor) 
                  echo "$valor <br>";

                echo"</div>";
            }

        ?>
        <div class="panel panel-default">
                <form style="margin: 1%;" method="POST" action="cadastropaciente.php">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label >Nome Completo</label>
                            <input type="text" class="form-control" name="nome_paciente" value="<?php echo $_SESSION[nome_paciente]; ?>" required>
                        </div>
                        <div class="col-md-3 mb-1">
                            <label >ID</label>
                            <input type="text" class="form-control" value="<?php echo $_SESSION[id_paciente]; ?>" disabled>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label >Data de nascimento</label>
                            <input type="date" class="form-control" name="data_nascimento" value="<?php echo $_SESSION[data_nascimento]; ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label >Endereço</label>
                            <input type="text" class="form-control" name="endereco" value="<?php echo $_SESSION[endereco]; ?>">
                        </div>
                        <div class="col-md-3 mb-1">
                            <label >Estado</label>
                            <input type="text" class="form-control" name="estado" value="<?php echo $_SESSION[estado]; ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label ">Cidade</label>
                            <input type="text" class="form-control" name="cidade" value="<?php echo $_SESSION[cidade]; ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label >RG</label>
                            <input type="text" class="form-control" name="rg" value="<?php echo $_SESSION[rg]; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label >CPF</label>
                            <input type="text" class="form-control" name="cpf" value="<?php echo $_SESSION[cpf]; ?>" required>
                        </div>
                    </div>

                    
                    <div align="right" style="margin: 2%;">
                        <input type="submit" name="incluir_paciente" value="Salvar" href="'cadastropaciente2.php?nome_paciente=<?php echo $_SESSION['nome_paciente']; ?>';">
                        
                    </div>
                

                                    <!-- INCLUSION PACIENT END -->
                                
        </div>
    </div>

        <!--Start footer-->
        <footer class="footer">
            <span>Copyright &copy; 2020. Float</span>
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