<?php

    include("php/conexao.php");session_start();

    
    if(!$_SESSION['usuarioEmail']){
        header('Location: pagin-login.php');
        exit();
    }

    $nome_paciente = $_GET['nome_paciente'];

    $sql_code = "SELECT * FROM CLIENTE WHERE (id_paciente is null)";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    $linha = $sql_query->fetch_assoc();


    $sql_code_clie = "SELECT * FROM PACIENTE WHERE (parentesco is null)";
    $sql_query_clie = $mysqli->query($sql_code_clie) or die($mysqli->error);
    $cliente = $sql_query_clie->fetch_assoc();

    

    //1- Registro dos dados do cliente
    if(isset($_POST['incluir_paciente'])){
        session_start();

        $id_paciente = $_SESSION[id_paciente];
        foreach ($_POST as $chave=>$valor){
            $_SESSION[$chave] = $mysqli->real_escape_string($valor);
        }

        // 2 - Validação dos dados
        if(strlen($_SESSION['id_paciente'])== 0 )
            $erro[] = "Prencha o nome do paciente";

        if(strlen($_SESSION['id_cliente']) == 0)
            $erro[] = "Prencha o nome do cliente";

        // 3 Inserção no banco de dados
        if(count($erro) == 0){

                $sql_code = "UPDATE CLIENTE SET
                 nome_paciente = '$nome_paciente',
                 id_paciente = $_SESSION[id_paciente],
                 parentesco = '$_SESSION[parentesco]'
                 WHERE id_cliente = '$_SESSION[id_cliente]';
                ";
                $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
                


                $sql_code_ = "SELECT nome_cliente FROM CLIENTE WHERE id_cliente = '$_SESSION[id_cliente]'";
                $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
                $nome_cliente = $sql_query;
                

                $sql_code_cl = "UPDATE PACIENTE SET
                    nome_cliente = '$nome_cliente',
                    id_cliente = $_SESSION[id_cliente],
                    parentesco = '$_SESSION[parentesco]'
                    WHERE id_paciente = '$_SESSION[id_paciente]';
                ";
                $sql_query = $mysqli->query($sql_code_cl) or die($mysqli->error);

             echo "<script> location.href='cadastropaciente3.php?id_paciente=$_SESSION[id_paciente]';</script>";   
    }
  } 

    $id_paciente = $_SESSION[id_paciente];
    
    
    
    if(isset($_POST['incluir_restricao'])){
        
        

        foreach ($_POST as $chave=>$valor){
            $_SESSION[$chave] = $mysqli->real_escape_string($valor);
        }

        // 2 - Validação dos dados
        if(strlen($_SESSION['nome_restricao'])== 0 )
           $erro[] = "Digite a enfermidade";

        // 3 Inserção no banco de dados
        if(count($erro) == 0){

            
            $sql_code = "INSERT INTO RESTRICAO_PACIENTE(
                id_restricao,
                nome_restricao,
                id_paciente)
                VALUES(
                 id_restricao,
                '$_SESSION[nome_restricao]',
                '$id_paciente')";

           

        $confirma = $mysqli->query($sql_code) or die($mysqli->error);
        
        
            

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
                <form style="margin: 1%;" method="POST" action="cadastropaciente2.php">  
                        <div class="form-row form-group col-md-6">     
                            <table class="table table-hover">
                                <thead >
                                    <tr>
                                        <th scope="col">Código</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Parentesco</th>
                                        
                                    </tr>
                                </thead>
                                <tbody >
                                    
                                    <tr>
                                       <td><?php echo $_SESSION['id_cliente'];?></td> 
                                       <td><?php echo $nome_cliente;?></td> 
                                       <td><?php echo $_SESSION['parentesco'];?></td> 
                                    </tr>
                                    
                                </tbody>
                            </table>
                            <input class="btn btn-primary" type="submit"  value="Excluir">

                        </div>
                   
                        <div class="col-md-3 mb-1">
                            <p>Responsavel</p>
                            <select name="id_cliente" id="id_cliente" required class="form-control m-bv required">
                                                    <option><font style="vertical-align: inherit;"></font></option>
                                                    <?php

                                                        do{
                                                            ?>

                                                    <option value="<?php echo $linha['id_cliente']?>" name="id_cliente"><?php echo $linha['nome_cliente']; ?></option> 
                                                               

                                                        
                                                    <?php } while($linha = $sql_query->fetch_assoc());?>
                                                </select>
                                                        
                            <p>(*) Obrigatório</p>
                            
                        </div>
                         
                        <div class="col-md-3 mb-1">
                            <p>Selecione o paciente</p>
                            <select name="id_paciente" id="id_paciente" required class="form-control m-bv required">
                                                    <option><font style="vertical-align: inherit;"></font></option>
                                                    <?php

                                                        do{
                                                            ?>

                                                    <option value="<?php echo $cliente['id_paciente']?>" name="id_paciente"><?php echo $cliente['nome_paciente']; ?></option> 
                                                               

                                                        
                                                    <?php } while($cliente = $sql_query_clie->fetch_assoc());?>
                                                </select>
                                                        
                            <p>(*) Obrigatório</p>
                            
                        </div>

                        <div class="col-md-3 mb-3">
                            <p>Grau de Parentesco</p>
                            <select name="parentesco" required class="form-control m-bv required" id="parentesco">
                                                    <option><font style="vertical-align: inherit;"></font></option>
                                                    <option><font style="vertical-align: inherit;" value="filho">Filho</font></option>
                                                    <option><font style="vertical-align: inherit;" value="filha">Filha</font></option>
                                                    <option><font style="vertical-align: inherit;" value="sobrinho">Sobrinho(a)</font></option>
                                                    <option><font style="vertical-align: inherit;" value="outros">Outros</font></option>
                                                </select>
                            <p>(*) Obrigatório</p>
                           
                        </div>
                        <input type="submit" name="incluir_paciente" value="Salvar" >
                    
                </form>

                
        
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