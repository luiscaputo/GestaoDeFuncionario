<?php
    require_once '../core/BD/conection.php';
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
</head>
<body>
<h3 class="text-center pt-3 mt-6">Todas os Registros Auxiliares da Empresa</h3><hr><br><br><br>
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
                    <h5>Actividades Exercidas Por Cada Funcionario em suas Funções</h5>
                        <div class="card">
                        <div class="card-header bg-transparent ">
                        <div class="table-responsive col-md-12">
                            <?php
                            //$a->EveryProfiles();
                            $sql = $pdo->prepare("SELECT * from activities");
                            $sql->execute();
                            echo '
                                <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                    <th scope="col" class="sort" data-sort="">ID</th>
                                    <th scope="col" class="sort" data-sort="">Função</th>
                                    <th scope="col" class="sort" data-sort="">Ref.Func</th>
                                    <th scope="col">Data de Criação</th>
                                    <th scope="col">Acção</th>
                                    </tr>
                                </thead>
                                <tbody>
                                ';
                            while($ac = $sql->fetch(PDO::FETCH_ASSOC))
                            { 
                                echo '
                                    <tr scope="row align-items-justify">
                                        <td>'. $ac['id'].'</td>
                                        <td>'. $ac['name'].'</td>
                                        <td>'. $ac['idFunc'].'</td>
                                        <td>'. $ac['created_at'].'</td>
                                        <td>
                                            <form method="post" action="">
                                                <button type="submit" class="btn btn-primary sucess" name="del">Apagar</button>
                                            </form>
                                        </td>
                                    </tr>
                                ';
                                if(isset($_POST['del']))
                                {
                                    $id = $ac['id'];
                                    global $id;
                                    $sq = $pdo->prepare("DELETE FROM activities WHERE id = '$id'");
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
                            ?><br>             
                            </div>
                            </div>
                        </div><br>
                            <h5>Registro de Contacto de todos</h5>
                            <hr>
                        <?php
                            //$a->EveryProfiles();
                            $sql = $pdo->prepare("SELECT * from contacts");
                            $sql->execute();
                            echo '
                                <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                    <th scope="col" class="sort" data-sort="">ID</th>
                                    <th scope="col" class="sort" data-sort="">Contacto</th>
                                    <th scope="col" class="sort" data-sort="">Ref.Funcionário</th>
                                    <th scope="col">Data de Criação</th>
                                    <th scope="col">Acção</th>
                                    </tr>
                                </thead>
                                <tbody>
                                ';
                            while($c = $sql->fetch(PDO::FETCH_ASSOC))
                            { 
                                echo '
                                    <tr scope="row align-items-justify">
                                        <td>'. $c['id'].'</td>
                                        <td>'. $c['contact'].'</td>
                                        <td>'. $c['idPerson'].'</td>
                                        <td>'. $c['created_at'].'</td>
                                        <td>
                                            <form method="post" action="">
                                                <button type="submit" class="btn btn-primary sucess" name="del">Apagar</button>
                                            </form>
                                        </td>
                                    </tr>
                                ';
                                if(isset($_POST['del']))
                                {
                                    $id = $c['id'];
                                    global $id;
                                    $sq = $pdo->prepare("DELETE FROM contacts WHERE id = '$id'");
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
                            ?><br>
                                <h5>Todos os Contractos</h5>
                                <hr>
                            <?php
                            //$a->EveryProfiles();
                            $sql = $pdo->prepare("SELECT * from contract");
                            $sql->execute();
                            echo '
                                <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                    <th scope="col" class="sort" data-sort="">ID</th>
                                    <th scope="col" class="sort" data-sort="">Ref.Funcionário</th>
                                    <th scope="col" class="sort" data-sort="">Ref.Departamento</th>
                                    <th scope="col" class="sort" data-sort="">Tipo de Contrato</th>
                                    <th scope="col" class="sort" data-sort="">Estado do Contrato</th>
                                    <th scope="col">Data de Assinatura</th>
                                    <th scope="col" class="sort" data-sort="">Observações</th>
                                    <th scope="col">Acção</th>
                                    </tr>
                                </thead>
                                <tbody>
                                ';
                            while($contract = $sql->fetch(PDO::FETCH_ASSOC))
                            { 
                                echo '
                                    <tr scope="row align-items-justify">
                                        <td>'. $contract['id'].'</td>
                                        <td>'. $contract['idPerson'].'</td>
                                        <td>'. $contract['idDepart'].'</td>
                                        <td>'. $contract['typeContratct'].'</td>
                                        <td>'. $contract['statusContract'].'</td>
                                        <td>'. $contract['created_at'].'</td>
                                        <td>'. $contract['obs'].'</td>
                                        <td>
                                            <form method="post" action="">
                                                <button type="submit" class="btn btn-primary sucess" name="del">Apagar</button>
                                            </form>
                                        </td>
                                    </tr>
                                ';
                                if(isset($_POST['del']))
                                {
                                    $id = $contract['id'];
                                    global $id;
                                    $sq = $pdo->prepare("DELETE FROM contract WHERE id = '$id'");
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
                            ?><br>             
                            </div>
                            </div>
                        </div>
                            <h5>Departamento e Seu Pessoal</h5>
                            <hr>
                        <?php
                            //$a->EveryProfiles();
                            $sql = $pdo->prepare("SELECT * from persondepart");
                            $sql->execute();
                            echo '
                                <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                    <th scope="col" class="sort" data-sort="">ID</th>
                                    <th scope="col" class="sort" data-sort="">Ref.Funcionário</th>
                                    <th scope="col" class="sort" data-sort="">Ref.Departamento</th>
                                    <th scope="col">Data de Entrada</th>
                                    <th scope="col">Acção</th>
                                    </tr>
                                </thead>
                                <tbody>
                                ';
                            while($pd = $sql->fetch(PDO::FETCH_ASSOC))
                            { 
                                echo '
                                    <tr scope="row align-items-justify">
                                        <td>'. $pd['id'].'</td>
                                        <td>'. $pd['idPerson'].'</td>
                                        <td>'. $pd['idDepart'].'</td>
                                        <td>'. $pd['created_at'].'</td>
                                        <td>
                                            <form method="post" action="">
                                                <button type="submit" class="btn btn-primary sucess" name="del">Apagar</button>
                                            </form>
                                        </td>
                                    </tr>
                                ';
                                if(isset($_POST['del']))
                                {
                                    $id = $pd['id'];
                                    global $id;
                                    $sq = $pdo->prepare("DELETE FROM persondepart WHERE id = '$id'");
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
                            ?><br>
                                <h5>Pessoal e Suas Funcões</h5>
                                <hr>
                            <?php
                            //$a->EveryProfiles();
                            $sql = $pdo->prepare("SELECT * from personfunction");
                            $sql->execute();
                            echo '
                                <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                    <th scope="col" class="sort" data-sort="">ID</th>
                                    <th scope="col" class="sort" data-sort="">Ref.Pessoa</th>
                                    <th scope="col" class="sort" data-sort="">Ref.Função</th>
                                    <th scope="col">Data de Criação</th>
                                    <th scope="col">Acção</th>
                                    </tr>
                                </thead>
                                <tbody>
                                ';
                            while($pf = $sql->fetch(PDO::FETCH_ASSOC))
                            { 
                                echo '
                                    <tr scope="row align-items-justify">
                                        <td>'. $pf['id'].'</td>
                                        <td>'. $pf['idPerson'].'</td>
                                        <td>'. $pf['idDepart'].'</td>
                                        <td>'. $pf['created_at'].'</td>
                                        <td>
                                            <form method="post" action="">
                                                <button type="submit" class="btn btn-primary sucess" name="del">Apagar</button>
                                            </form>
                                        </td>
                                    </tr>
                                ';
                                if(isset($_POST['del']))
                                {
                                    $id = $pf['id'];
                                    global $id;
                                    $sq = $pdo->prepare("DELETE FROM personfunction WHERE id = '$id'");
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
                            ?><br>             
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                </div> 
            </div>
           
            <footer>
            <div class="container text-center">
            <a href="../index.html">Sair</a><br><br>
                <p>Sistema de Cadastro de Funcionários <br> Copirigth &copy;2021 Todos direitos reservados <br>
                Dev.By. Luís Caputo.</p>
            </div>
        </footer>
</body>
</html>