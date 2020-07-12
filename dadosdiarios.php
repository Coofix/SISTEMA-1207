<?php

	
    include("php/conexao.php"); 

    session_start();

    if(!$_SESSION['usuarioEmail']){
        header('Location: pagin-login.php');
        exit();
    }


    foreach ($_POST as $chave => $valor) {
        $_SESSION[$chave] = $mysqli->real_escape_string($valor);
    }

    $sql_code_clie = "SELECT * FROM PACIENTE ";
    $sql_query_clie = $mysqli->query($sql_code_clie) or die($mysqli->error);
    $cliente = $sql_query_clie->fetch_assoc();

    //$id_paciente = isset($_POST[id_paciente]);

    
    //$id_paciente = filter_input(INPUT_POST, 'id_paciente', FILTER_SANITIZE_STRING);
    $id_paciente = isset($_SESSION[id_paciente]);
    
    $sql_code_pac = "SELECT * FROM PACIENTE  WHERE id_paciente = '$id_paciente'";
    $sql_query_pac = $mysqli->query($sql_code_pac) or die($mysqli->error);
    //$paciente_nome = $sql_query_pac->fetch_assoc();
    $paciente = $sql_query_pac->fetch_assoc();
    $paciente_nome = $paciente['nome_paciente'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dados Diarios</title>

    <!-- Common plugins -->
    <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="plugins/simple-line-icons/simple-line-icons.css" rel="stylesheet">
    <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="plugins/pace/pace.css" rel="stylesheet">
    <link href="plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/nano-scroll/nanoscroller.css">
    <link rel="stylesheet" href="plugins/metisMenu/metisMenu.min.css">
    <!--jquery steps-->
    <link rel="stylesheet" href="plugins/jquery-steps/jquery-steps.css">
    <!--template css-->
    <link href="css/style.css" rel="stylesheet">
    <link href="plugins/iCheck/blue.css" rel="stylesheet">

</head>

<body>

    <!--top bar start-->
    <div class="top-bar light-top-bar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-6">
                    <a href="index.php" class="admin-logo">
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
                    <li><a href="gerenciamento.php"><i class="fa fa-server"></i> Gerenciamento </a></li>
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
                    <h4>Dados diários</h4>
                </div>

            </div>
        </div>
        <!--page header end-->

        <!--start page content-->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form id="example-form" method="POST" action="processa.php">
                            <div>
                                <h3>Paciente</h3>
                                <section>
                                    <label for="userName">*Selecione o paciente que você quer adicionar informações na ficha diaria do pacinete</label>

                                    <select name="id_paciente" class="form-control m-bv" required >
                                            <option><font style="vertical-align: inherit;"></font></option>
                                            
                                            <?php
                                                do{
                                                    ?>
                                                    <option value="<?php echo $cliente['id_paciente']?>" name="id_paciente"><?php echo $cliente['nome_paciente']; ?></option>
                                                
                                                    <?php } while($cliente = $sql_query_clie->fetch_assoc());?>
                                            
                                        </select>
                                    <p>(*) Obrigatório</p>
                                </section>
                                <!-- GUIA2 -->

                                <h3>Perfil</h3>
                                <section>
                                    <div class="col-md-6">
                                        <label for="name">Nome completo</label>
                                        <input id="nome_paciente" name="name" type="text" value="<?php echo $cliente['id_paciente']; ?>" disabled="">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="idade">Idade</label>
                                        <input id="idade" name="idade" type="text" width="100%" value="85" disabled="">
                                    </div>

                                    <!-- remedios -->
                                    <div class="col-md-3">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Enfermidades</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Diabetes</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Hipertenção</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- alergias -->
                                    <div class="col-md-3">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Restrição alimentar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Amendoim</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Frutos do mar</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Medicação</th>
                                                    <th>Dose</th>
                                                    <th>Intervalo</th>
                                                    <th>Observação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Arodois 50mg</td>
                                                    <td>1 comprimido</td>
                                                    <td>12hs</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Anlodipino 5mg</td>
                                                    <td>1 comprimido</td>
                                                    <td>24hs</td>
                                                    <td>Noite</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Acetilicisteina 600mg</td>
                                                    <td>1 comprimido</td>
                                                    <td>24hs</td>
                                                    <td>Diluir em 1/2 copo de água à noite.</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>

                                    <!-- parentes -->
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Principal</th>
                                                    <th>Código</th>
                                                    <th>Nome</th>
                                                    <th>Parentesco</th>
                                                    <th>Telefone</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>999999</td>
                                                    <td>Nome do primeiro responsável</td>
                                                    <td>Filho</td>
                                                    <td>(99) 9 9999-9999</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>999999</td>
                                                    <td>Nome do segundo responsável</td>
                                                    <td>Nora</td>
                                                    <td>(99) 9 9999-9999</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>999999</td>
                                                    <td>Nome do terceiro responsável</td>
                                                    <td>Neto</td>
                                                    <td>(99) 9 9999-9999</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </section>


                                <h3>Alimentação</h3>
                                <section>
                                    <div class="col-md-12">
                                        

                                        <div class="col-md-12 painel2 ">
                                            <h3> Cadastrar Alimentação</h3>
                                            <hr>
                                            <div class="novoReg text-center letrap">
                                                <form id="frmAdd" >

                                                    <div class="col-md-3" style="margin-top:1%">
                                                        <strong>Tipo de refeição </strong>
                                                        <select name="tipo_ref" class="form-control m-bv ">
                                                                <option selected="1" disabled><font style="vertical-align: inherit;">Selecione...</font></option>
                                                                <option><font style="vertical-align: inherit;">Café da manhã</font></option>
                                                                <option><font style="vertical-align: inherit;">Eventual</font></option>
                                                                <option><font style="vertical-align: inherit;">Almoço</font></option>
                                                                <option><font style="vertical-align: inherit;">Café da tarde</font></option>
                                                                <option><font style="vertical-align: inherit;">Jantar</font></option>
                                                            </select>
                                                    </div>
                                                    <div class="col-md-3" style="margin-top:1%">
                                                        <strong>Tipo de acompanhamento </strong>
                                                        <select name="tipo_acom" class="form-control m-bv ">
                                                                <option selected="1" disabled><font style="vertical-align: inherit;">Selecione...</font></option>
                                                                <option><font style="vertical-align: inherit;">Bebida</font></option>
                                                                <option><font style="vertical-align: inherit;">Refeição</font></option>
                                                                <option><font style="vertical-align: inherit;">Sobremesa</font></option>
                                                            </select>
                                                    </div>
                                                    <div class="col-md-4" style="margin-top:1%">
                                                        <strong>Descrição </strong>
                                                        <input id="desc" name="descricao" type="text" width="100%" value="">
													</div>

                                               
                                            </div>
                                                </form>
                                        </div>
                                    </div>
                                </section>


                                <h3>Remedios</h3>
                                <section>
                                    <div class="col-md-12 letrap">

										<div class="col-md-2">
                                            <strong>Horário </strong>
                                            <input name="hora" id="inpt" class="inp0 tam_input" type="time" >
                                        </div>
										

										 <div class="col-md-2">
                                            <strong>Medicação </strong>
                                            <input name="medicacao" id="inptSenha" class="inp0 tam_input" type="text" >
                                        </div>
										

                                        <div class="col-md-2">
                                            <strong>Dosagem </strong>
                                            <input name="dosagem" id="inptSenha" class="inp0 tam_input" type="text">
                                        </div>

                                        <div class="col-md-2">
                                            <strong>Intervalo </strong>
                                            <input name="intervalo" id="inptSenha" class="inp0 tam_input" type="text" >
                                        </div>

                                        <div class="col-md-2">
                                            <strong>Observação </strong>
                                            <input name="observacao" id="inptSenha" class="inp0 tam_input" type="text" >
                                        </div>
										<input type="submit" value="Atualizar">
                                    </div>
									
                                </section>
                            </div>
								
								
                        </form>
                        </div>
                    </div>
                </div>
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

    <!--jquery steps-->
    <script src="plugins/jquery-steps/jquery.steps.min.js"></script>
    <script src="plugins/jquery-validate/jquery.validate.min.js"></script>
    <script>
        $("#example-basic").steps({
            headerTag: "h3",
            bodyTag: "section",

            autoFocus: true
        });
        //steps with form
        var form = $("#example-form");
        form.validate({
            errorPlacement: function errorPlacement(error, element) {
                element.before(error);
            },
            rules: {
                confirm: {
                    equalTo: "#password"
                }
            }
        });
        form.children("div").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            onStepChanging: function(event, currentIndex, newIndex) {
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinishing: function(event, currentIndex) {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function(event, currentIndex) {
                alert("Submitted!");
            }
        });
    </script>

</body>

</html>