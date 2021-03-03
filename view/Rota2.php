<?php   
    require_once '../core/BD/conection.php';
    if(isset($_POST['eliminarPessoa']))
    {
        $identify = isset($_POST['numerIdDelete']) ? $_POST['numerIdDelete'] : "ERRO";
        $pesq = $pdo->prepare("SELECT nif FROM person where nif = '$identify'");
        $pesq->execute();
        if($pesq->rowCount()>0)
        {
            $all = $pdo->prepare("SELECT * FROM person WHERE nif = '$identify'");
            $row = $all->fetch();
            $idPessoa = $row['id'];
            $u = $pdo->prepare("UPDATE contract SET statusContract = 'Encerrado' WHERE idPerson = '$idPessoa'");
            $u->execute();
            $rem = $pdo->prepare("DELETE FROM person WHERE nif = '$identify'");
            $rem->execute();
            if($rem->rowCount() > 0)
            {
                echo "<script>alert('Funcionário fora da Empresa!')</script>";
            }
        }else
        {
            echo "<script>alert('Funcionário Inexistente!')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
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
                        <button type="button" class="li1" data-toggle="modal"  data-target="#addCash" >
                            <img src="../assets/img/2.2.svg" alt="" style="width: 50%; height: 50%;">
                            <h4>Funcionários</h4>
                        </button>
                   </a>
                </li>
                <li class="d">
                    <a href=""  data-bs-toggle="modal"  data-bs-target="#Eliminar">
                        <button class="li1" type="button" class="li1" data-toggle="modal" data-target="#exampleModal" >
                            <img src="../assets/img/1.1.svg" alt="" style="width: 50%; height: 50%;">
                            <h4>Eliminar Funcionário</h4>
                        </button>
                    </a>
                </li>
                
                <li class="d">
                    <a href=""  data-toggle="modal" data-target="#exampleModalCenter">
                        <button class="li1 border-sucess" type="button" class="li1"  data-toggle="modal" data-target="#exampleModalCenter">
                            <img src="../assets/img/3.3.svg" alt="" style="width: 50%; height: 50%;">
                            <h4>Actualizar Dados</h4>
                        </button>
                    </a>
                </li>

            </ul>
            <footer>
            <div class="container text-center">
                <p>Sistema de Cadastro de Funcionários <br> Copirigth &copy;2021 Todos direitos reservados <br>
                Dev.By. Luís Caputo.</p>
            </div>
        </footer>
        </div>
        <!-- Button trigger modal -->
    

<!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>

<!-- Modal Eliminar-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            
            <div class="modal-body">
                <form action="" class="" method="post">
                        <input type="text" class="form-control" name="numerIdDelete" placeholder="Identificação da Pessoa a Elimina [Ex.006989589LA042]">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Sair</button>
    
                        <button type="submit" class="btn btn-primary" name="eliminarPessoa">Eliminar</button>

                    </div>
                </form>
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

    
    <div class="modal fade" id="addCash" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="text-center pt-3 mt-6">Todos Funcionários Cadastrados </h3>
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
                            $sql = $pdo->prepare("SELECT * from person");
                            $sql->execute();
                            echo '
                                <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                    <th scope="col" class="sort" data-sort="">ID</th>
                                    <th scope="col" class="sort" data-sort="">Nome</th>
                                    <th scope="col" class="sort" data-sort=""x>Nif</th>
                                    <th scope="col" class="sort" data-sort="">Data de Nascimento</th>
                                    <th scope="col" class="sort" data-sort="">Sexo</th>
                                    <th scope="col" class="sort" data-sort="">Estado Civil</th>
                                    <th scope="col" class="sort" data-sort="">Filhos</th>
                                    <th scope="col" class="sort" data-sort="">Nível Academico</th>
                                    <th scope="col" class="sort" data-sort="">Profissão</th>
                                    <th scope="col" class="sort" data-sort="">Endereço</th>
                                    <th scope="col" class="sort" data-sort="">Apercebeu-se da vaga, como?</th>
                                    <th scope="col">Data de Inicio de Actividades</th>
                                    </tr>
                                </thead>
                                <tbody>
                                ';
                            while($person = $sql->fetch(PDO::FETCH_ASSOC))
                            { 
                                echo '
                                    <tr scope="row align-items-justify">
                                        <td>'. $person['idPerson'].'</td>
                                        <td>'. $person['name'].'</td>
                                        <td>'. $person['nif'].'</td>
                                        <td>'. $person['birthDate'].'</td>
                                        <td>'. $person['sex'].'</td>
                                        <td>'. $person['status'].'</td>
                                        <td>'. $person['qtdSon'].'</td>
                                        <td>'. $person['studentLevel'].'</td>
                                        <td>'. $person['profition'].'</td>
                                        <td>'. $person['address'].'</td>
                                        <td>'. $person['howToMetedTheCompany'].'</td>
                                        <td>'. $person['createdAt'].'</td>
                                    </tr>
                                ';
                                //echo "ID". $profiles['id']."<br>";
                                //echo "Nome". $profiles['name']."<br>";
                            }
                            echo '
                            </tbody>
                            </table>'
                            ?>
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

</div>
      
<script src="../assets/js/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../assets/frame/js/bootstrap.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</body>
</html>