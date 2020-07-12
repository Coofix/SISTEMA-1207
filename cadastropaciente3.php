<?php

    include("php/conexao.php");
    session_start();

    
    if(!$_SESSION['usuarioEmail']){
        header('Location: pagin-login.php');
        exit();
    }

    $id_paciente = intval($_GET['id_paciente']);

    $sql_code = "SELECT * FROM ENFERMIDADE WHERE id_paciente = $_SESSION[id_paciente]";
   $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
   $enfermidade = $sql_query->fetch_assoc();


    $sql_code_rest = "SELECT * FROM RESTRICAO WHERE id_paciente = $_SESSION[id_paciente]";
    $sql_query_rest = $mysqli->query($sql_code_rest) or die($mysqli->error);
    $restricao = $sql_query_rest->fetch_assoc();

   $sql_code_reme = "SELECT * FROM REMEDIO WHERE id_paciente = $_SESSION[id_paciente]";
    $sql_query_reme = $mysqli->query($sql_code_reme) or die($mysqli->error);
    $remedio = $sql_query_reme->fetch_assoc();

    


    //1- Registro dos dados do cliente
    if(isset($_POST['incluir_enfermidade'])){
        
        if(!isset($_SESSION))
            session_start();
        
        foreach ($_POST as $chave=>$valor){
            $_SESSION[$chave] = $mysqli->real_escape_string($valor);
        }

        // 2 - Validação dos dados
        if(strlen($_SESSION['enfermidade'])== 0 )
            $erro[] = "Prencha o nome da enfermidade";


        // 3 Inserção no banco de dados
        if(count($erro) == 0){

            $sql_code_incluir = "INSERT INTO ENFERMIDADE (
                nome_enfermidade,
                id_paciente)
                VALUES(
                '$_SESSION[enfermidade]',
                $_SESSION[id_paciente])";

                $confirma = $mysqli->query($sql_code_incluir) or die($mysqli->error);
                echo "<script> location.href='cadastropaciente3.php?id_paciente=$_SESSION[id_paciente]';</script>";
            
    }
  } 

    if(isset($_POST['incluir_restricao'])){
        
        if(!isset($_SESSION))
            session_start();

        foreach ($_POST as $chave=>$valor){
            $_SESSION[$chave] = $mysqli->real_escape_string($valor);
        }

        // 2 - Validação dos dados
        if(strlen($_SESSION['nome_restricao'])== 0 )
           $erro[] = "Digite a restrição";

        // 3 Inserção no banco de dados
        if(count($erro) == 0){

            
            $sql_code_incluir = "INSERT INTO RESTRICAO (
                nome_restricao,
                id_paciente)
                VALUES(
                '$_SESSION[nome_restricao]',
                $_SESSION[id_paciente])";

                $confirma = $mysqli->query($sql_code_incluir) or die($mysqli->error);

                    echo "<script> location.href='cadastropaciente3.php?id_paciente=$_SESSION[id_paciente]';</script>";
                
    }
  } 

  if(isset($_POST['incluir_remedio'])){
    
    if(!isset($_SESSION))
            session_start();
    
    foreach ($_POST as $chave=>$valor){
        $_SESSION[$chave] = $mysqli->real_escape_string($valor);
    }

    // 2 - Validação dos dados
    if(strlen($_SESSION['nome_remedio'])== 0 )
        $erro[] = "Prencha o nome da medicação";

    if(strlen($_SESSION['dose_remedio'])== 0 )
        $erro[] = "Prencha a dose";

    if(strlen($_SESSION['intervalo_remedio'])== 0 )
        $erro[] = "Prencha o intervalo";

    // 3 Inserção no banco de dados
    if(count($erro) == 0){

        $sql_code_incluir = "INSERT INTO REMEDIO (
            nome_remedio,
            dose_remedio,
            intervalo_remedio,
            observacao_remedio,
            id_paciente)
            VALUES(
            '$_SESSION[nome_remedio]',
            '$_SESSION[dose_remedio]',
            '$_SESSION[intervalo_remedio]',
            '$_SESSION[observacao_remedio]',
            $_SESSION[id_paciente]
            )";
            $confirma = $mysqli->query($sql_code_incluir) or die($mysqli->error);

            echo "<script> location.href='cadastropaciente3.php?id_paciente=$_SESSION[id_paciente]';</script>";
    

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
            <form action="cadastropaciente3.php" method="POST">
                        <div class="col-md-12">
                            <div class="col-md-3 mb-1">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            
                                            <th scope="col">Enfermidade</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    <?php
                                             do{
                                      ?>
                                         <tr>
                                              <td><?php echo $enfermidade['nome_enfermidade']; ?></td>
                                          </tr>
    
                                         <?php } while($enfermidade = $sql_query->fetch_assoc()); ?>

                                    </tbody>
                                </table>

                                
                                                    
                                                            
                                <input type="text" class="form-control" name="enfermidade" placeholder="Enfermidade" required>
                                
                                <br>
                                <input type="submit" name="incluir_enfermidade" value="Salvar" >
                                
                            </div>
                </form>
                        <form action="cadastropaciente3.php" method="POST">    
                            <div class="col-md-3 mb-1">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Restrição Alimentar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    <?php
                                        do{ ?>
                                        <tr >
                                           <td  name="nome_restricao"><?php echo $restricao['nome_restricao']; ?> </td>
                                        <?php } while($restricao = $sql_query_rest->fetch_assoc()); ?>
                                    </tbody>
                                </table>
                                <input type="text" class="form-control" name="nome_restricao" placeholder="Restrição">
                                <br>
                                <input type="submit" name="incluir_restricao" value="Salvar" >
                               

                        </form>   

                            </div>
                            <div class="col-md-6 mb-1">
                        <form action="cadastropaciente3.php" method="POST">        
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Medicação</th>
                                            <th scope="col">Dose</th>
                                            <th scope="col">Intervalo</th>
                                            <th scope="col">Observação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                             do{
                                      ?>
                                         <tr>
                                              <td><?php echo $remedio['nome_remedio']; ?></td>
                                              <td><?php echo $remedio['dose_remedio']; ?></td>
                                              <td><?php echo $remedio['intervalo_remedio']; ?></td>
                                              <td><?php echo $remedio['observacao_remedio']; ?></td>
                                          </tr>
    
                                         <?php } while($remedio = $sql_query_reme->fetch_assoc()); ?>
                                        <tr>
                                            
                                            <td> <input type="text" class="form-control" name="nome_remedio" placeholder="Medicação"></td>
                                            <td> <input type="text" class="form-control" name="dose_remedio" placeholder="Dose"></td>
                                            <td> <input type="text" class="form-control" name="intervalo_remedio" placeholder="Intervalo"></td>
                                            <td> <input type="text" class="form-control" name="observacao_remedio" placeholder="Observação"></td>

                                        </tr>
                                        <tr>
                                            <td>
                                            <input type="submit" name="incluir_remedio" value="Salvar" ></td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </form>         
                            <a href="gerenciamento.html" class="btn btn-primary">Finalizar</a>           
                                <br>
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