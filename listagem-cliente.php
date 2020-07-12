<?php

    include("php/conexao.php");session_start();

    
    if(!$_SESSION['usuarioEmail']){
        header('Location: pagin-login.php');
        exit();
    }

        $sql_code = "SELECT * FROM CLIENTE";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linha = $sql_query->fetch_assoc();

        

              
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Listagem de Funcionários</title>

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
                    <li><a href="dadosdiarios.html"><i class="fa fa-user"></i> Dados Diários </a></li>
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
                    <h3>Listagem de Clientes</h3>
                </div>
            </div>
        </div>
        <!--page header end-->


        <!--start page content-->
        <div class="row">
        <a href="cadastrocliente.php">Cadastrar</a>
 <p class=espaco></p>
 <table border=1 cellpading=10>
<table>
    <tr class=titulo>
        <td><h5>Nome Completo</h5></td>
        <td><h5>Data de Nascimento</h5></td>
        <td><h5>Endereço</h5></td>
        <td><h5>Estado</h5></td>
        <td><h5>Cidade</h5></td>
        <td><h5>RG</h5></td>
        <td><h5>CPF</h5></td>
        <td><h5>Num Celular</h5></td>
        <td><h5>Telefone Fixo</h5></td>
        <td><h5>Nome do idoso</h5></td>
        <td><h5>Parentesco</h5></td>
        <td><h5>Email</h5></td>
        <td><h5>Senha</h5></td>
    </tr>
    <?php
    do{
    ?>
    <tr>
        <td><?php echo $linha['nome_cliente']; ?></td>
        <td><?php echo $linha['data_nascimento']; ?></td>
        <td><?php echo $linha['endereco']; ?></td>
        <td><?php echo $linha['estado']; ?></td>
        <td><?php echo $linha['cidade']; ?></td>
        <td><?php echo $linha['rg']; ?></td>
        <td><?php echo $linha['cpf']; ?></td>
        <td><?php echo $linha['num_celu']; ?></td>
        <td><?php echo $linha['tel_fixo']; ?></td>
        <td><?php echo $linha['nome_paciente']; ?></td>
        <td><?php echo $linha['parentesco']; ?></td>
        <td><?php echo $linha['email']; ?></td>
        <td><?php echo $linha['senha']; ?></td>
        <td>
        <a href="editar-cliente.php?id_cliente=<?php echo $linha['id_cliente']; ?>">Editar </a>
            <a href="javascript: if(confirm('Tem certeza que deseja deletar o cliente <?php echo $linha['nome_cliente']; ?>'))
            location.href='deletar-cliente.php?id_cliente=<?php echo $linha['id_cliente']; ?>';">Deletar </a>
        </td>
    </tr>
    
    <?php } while($linha = $sql_query->fetch_assoc()); ?>



</table>
        </div>
        <!--end page content-->


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









 