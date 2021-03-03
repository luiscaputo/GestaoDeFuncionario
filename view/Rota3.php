<?php   
    require_once '../core/BD/conection.php';
    if(isset($_POST['addDpt']))
    {
        $namedpt = isset($_POST['newDprtmnt']) ? $_POST['newDprtmnt'] : "Error";
        $descc = isset($_POST['descc']) ? $_POST['descc'] : "Error";
            $verify = $pdo->prepare("SELECT * FROM departament WHERE name = '$namedpt'");
            $verify->execute();
            if($verify->rowCount() > 0)
            {
                echo '<script>alert("Esse departamento já existe no sistema , obrigado")</script>';
            }else
                {
                    $sql = $pdo->prepare("INSERT INTO departament(name, description) VALUES('$namedpt', '$descc')");
                    $sql->execute();
                    if($sql->rowCount() > 0)
                    {
                        echo '<script>alert("Novo depatamento cadastrado, actualize para conferir!")</script>';
                    }else
                        {
                            echo '<script>alert("Não Registrado, tente novamente mais tarde!")</script>';
                        }
                }
        
    }
    if(isset($_POST['addF']))
    {
        $newFunc = isset($_POST['newFunc']) ? $_POST['newFunc'] : "Error";
        $descFunc = isset($_POST['descFunc']) ? $_POST['descFunc'] : "Error";
        $refDepart = isset($_POST['refDepart']) ? $_POST['refDepart'] : "Error";
            $verify = $pdo->prepare("SELECT * FROM function WHERE name = '$newFunc'");
            $verify->execute();
            if($verify->rowCount() > 0)
            {
                echo '<script>alert("Essa função já existe no sistema , obrigado")</script>';
            }else
                {
                    $v = $pdo->prepare("SELECT * FROM departament WHERE id = '$refDepart'");
                    $v->execute();
                    if($v->rowCount() > 0)
                    {
                            $sql = $pdo->prepare("INSERT INTO function(name, description, idDepart) VALUES('$newFunc', '$descFunc', '$refDepart')");
                            $sql->execute();
                            if($sql->rowCount() > 0)
                            {
                                echo '<script>alert("Nova função cadastrado, actualize para conferir!")</script>';
                            }else
                                {
                                    echo '<script>alert("Não Registrado, tente novamente mais tarde!")</script>';
                                }
                    }else  
                        {
                            echo '<script>alert("Esse departamento não existe no sistema , obrigado")</script>';
                        }
                }
        
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="../assets/frame/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/style/index.css">
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=A, initial-scale=1.0">
    <title>Listando todos os user</title>
    <style>
       body
            {
                /*background: linear-gradient(90deg, #00d2ff 0%, #3a47d5 100%);*/        
                background-color: whitesmoke;
                font-family: Arial;
            }
        .lista
        {
            list-style: none;
            display: inline-block;
            padding: 100px;
            
        }
        .li1
        {
            display: inline-block;
            padding: 10px;
            color: black;
            width: 280px;
            height: 280px;
            background-color: white;
            text-align: center;
            border-radius: 3%;
            border: none;
            transition: transform 1s;
            transform: translateX(20) scale(0.5);
            outline: none;
            border-color: turquoise;
        }
        .li1:hover
        {
            transform-style: flat;
            background-color: gainsboro;        
        } 
        .d
        {
            display: inline-block;
        }
        button
        {
            border-color: blue;
        }
        
    </style>
</head>
<body>
<div class="container text-center">
        <div>
            <ul class="lista">
                <li class="d">
                   <a href="" data-bs-target="#addCash" data-bs-toggle="modal">
                        <button type="button" class="li1" data-toggle="modal"  data-target="#exampleModalCenter" >
                            <img src="../assets/img/dprtm.svg" alt="" style="width: 50%; height: 50%;">
                            <h4>+Departamento

                            </h4>
                        </button>
                   </a>
                </li>
                <li class="d">
                    <a href=""  data-bs-toggle="modal"  data-bs-target="#Eliminar">
                        <button class="li1" type="button" class="li1" data-toggle="modal" data-target="#exampleModal" >
                            <img src="../assets/img/f.svg" alt="" style="width: 50%; height: 50%;">
                            <h4>+Função

                            </h4>
                        </button>
                    </a>
                </li>
                
                <li class="d">
                    <a href="tables.php">
                        <button class="li1 border-sucess" type="button">
                            <img src="../assets/img/tab.svg" alt="" style="width: 50%; height: 50%;">
                            <h4>Todos Registros</h4>
                        </button>
                    </a>
                </li>

            </ul>
            <a href="../index.html">Sair</a>
            <footer>
            <div class="container text-center">
                <p>Sistema de Cadastro de Funcionários <br> Copirigth &copy;2021 Todos direitos reservados <br>
                Dev.By. Luís Caputo.</p>
            </div>
        </footer>
        </div>
        <!-- Button trigger modal -->


<!-- Modal Eliminar-->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="text-center pt-3 mt-6">Todas Funções Por Departamento</h3>
                  <div class="container">
                      <div class="row">
                          <div class="col-sm">
                          </div>
                          
                        <div class="col-sm">
              
                    </div>
                </div>
                <div class="container">
                <div class="row">
                <div class="col-12">
                <div class="container-fluid mt--6">
                    <div class="row justify-content-center">
                    <div class=" col ">
                        <div class="card">
                        <div class="card-header bg-transparent ">
                        
                        <div class="table-responsive col-md-12">
                            <?php
                            //$a->EveryProfiles();
                            $sql = $pdo->prepare("SELECT * from function");
                            $sql->execute();
                            echo '
                                <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                    <th scope="col" class="sort" data-sort="">ID</th>
                                    <th scope="col" class="sort" data-sort="">Função</th>
                                    <th scope="col" class="sort" data-sort="">Descrição</th>
                                    <th scope="col" class="sort" data-sort="">Ref.Departamento</th>
                                    <th scope="col">Data de Criação</th>
                                    <th scope="col">Acção</th>
                                    </tr>
                                </thead>
                                <tbody>
                                ';
                            while($f = $sql->fetch(PDO::FETCH_ASSOC))
                            { 
                                echo '
                                    <tr scope="row align-items-justify">
                                        <td>'. $f['id'].'</td>
                                        <td>'. $f['name'].'</td>
                                        <td>'. $f['description'].'</td>
                                        <td>'. $f['idDepart'].'</td>
                                        <td>'. $f['created_at'].'</td>
                                        <td>
                                            <form method="post" action="">
                                                <button type="submit" class="btn btn-primary sucess" name="del">Apagar</button>
                                            </form>
                                        </td>
                                    </tr>
                                ';
                                if(isset($_POST['del']))
                                {
                                    $id = $f['id'];
                                    global $id;
                                    $sq = $pdo->prepare("DELETE FROM function WHERE id = '$id'");
                                    $sq->execute();
                                    if($sq->rowCount() > 0)
                                    {
                                        echo 'Eliminado com Sucesso';
                                    }else
                                        echo 'BUGG';

                                }
                                //echo "ID". $profiles['id']."<br>";
                                //echo "Nome". $profiles['name']."<br>";
                            }
                            echo '
                            </tbody>
                            </table>'
                            ?>
                            </div>
                            </div>
                            <div class="container">
                                <h5>Novo Função</h5>
                                        <form action="" method="post">
                                            <input type="text" class="form-control" placeholder="Nome da função" name="newFunc" required><br>
                                            <input type="text" class="form-control" placeholder="Ref.Departamento" name="refDepart" required><br>
                                            <textarea class="form-control" id="" cols="10" rows="5" name="descFunc" placeholder="Descreva aqui o departamento" required></textarea> <br>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            <button type="submit" class="btn btn-primary sucess" name="addF">Adicionar</button>
                                        </form>
                                </div>
                        </div>
                        </div>
                    </div>
                </div>
                </div> 
            </div>
            </div>
        </div>
    </div>

        </div>
        <!-- Button trigger modal -->
        <div class="modal fade" id="Actualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                <button type="button" class="btn btn-primary">Eliminar</button>
            </div>
            </div>
        </div>
        </div>
    </div>

</div>
<!-- Modal Todas Departamentos -->
<div class="modal fade" id="addCash" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="text-center pt-3 mt-6">Todos Departamentos</h3>
                  <div class="container">
                      <div class="row">
                          <div class="col-sm">
                          </div>
                          
                        <div class="col-sm">
              
                    </div>
                </div>
                <div class="container">
                <div class="row">
                <div class="col-12">
                <div class="container-fluid mt--6">
                    <div class="row justify-content-center">
                    <div class=" col ">
                        <div class="card">
                        <div class="card-header bg-transparent ">
                        
                        <div class="table-responsive col-md-12">
                            <?php
                            //$a->EveryProfiles();
                            $sql = $pdo->prepare("SELECT * from departament");
                            $sql->execute();
                            echo '
                                <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                    <th scope="col" class="sort" data-sort="">ID</th>
                                    <th scope="col" class="sort" data-sort="">Departamento</th>
                                    <th scope="col" class="sort" data-sort="">Descrição</th>
                                    <th scope="col">Data de Criação</th>
                                    <th scope="col">Acção</th>
                                    </tr>
                                </thead>
                                <tbody>
                                ';
                            while($depart = $sql->fetch(PDO::FETCH_ASSOC))
                            { 
                                echo '
                                    <tr scope="row align-items-justify">
                                        <td>'. $depart['id'].'</td>
                                        <td>'. $depart['name'].'</td>
                                        <td>'. $depart['description'].'</td>
                                        <td>'. $depart['created_at'].'</td>                                                                                                                                                                     
                                        <td>
                                            <form method="post" action="">
                                                <button type="submit" class="btn btn-primary sucess" name="del">Apagar</button>
                                            </form>
                                        </td>
                                    </tr>
                                ';
                                if(isset($_POST['del']))
                                {
                                    $id = $depart['id'];
                                    global $id;
                                    $sq = $pdo->prepare("DELETE FROM departament WHERE id = '$id'");
                                    $sq->execute();
                                    if($sq->rowCount() > 0)
                                    {
                                        echo 'Eliminado com Sucesso';
                                    }else
                                        echo 'BUGG';

                                }
                                //echo "ID". $profiles['id']."<br>";
                                //echo "Nome". $profiles['name']."<br>";
                            }
                            echo '
                            </tbody>
                            </table>'
                            ?>
                            </div>
                            </div>
                            <div class="container">
                                <h5>Novo Departamento</h5>
                                        <form action="" method="post">
                                            <input type="text" class="form-control" placeholder="Nome do Novo Departamento" name="newDprtmnt" required><br>
                                            <textarea class="form-control" id="" cols="10" rows="5" name="descc" placeholder="Descreva aqui o departamento" required></textarea> <br>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            <button type="submit" class="btn btn-primary sucess" name="addDpt">Adicionar</button>
                                        </form>
                                </div>
                        </div>
                        </div>
                    </div>
                </div>
                </div> 
            </div>
            </div>
        </div>
    </div>

      
<script src="../assets/js/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../assets/frame/js/bootstrap.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</body>
</html>