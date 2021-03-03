<?php
  require_once '../core/BD/conection.php';
  if(isset($_POST['cadastrar']))
  {
    //PEGANDO AS INPUT
    $name = isset($_POST['Nome']) ? addslashes($_POST['Nome']) : "ERROR";
    $nif = isset($_POST['nif']) ? addslashes($_POST['nif']) : "ERROR";
    $dtnasc = isset($_POST['dtnasc']) ? addslashes($_POST['dtnasc']) : "ERROR";
    $sexo = isset($_POST['sexo']) ? addslashes($_POST['sexo']) : "ERROR";
    $n1 = isset($_POST['n1']) ? addslashes($_POST['n1']) : "ERROR";
    $n2 = isset($_POST['n2']) ? addslashes($_POST['n2']) : "ERROR";
    $email = isset($_POST['email']) ? addslashes($_POST['email']) : "ERROR";
    $rua = isset($_POST['rua']) ? addslashes($_POST['rua']) : "ERROR";
    $numero = isset($_POST['numero']) ? addslashes($_POST['numero']) : "ERROR";
    $bairro = isset($_POST['bairro']) ? addslashes($_POST['bairro']) : "ERROR";
    $cidade = isset($_POST['cidade']) ? addslashes($_POST['cidade']) : "ERROR";
    $EstadoCivil = isset($_POST['EstadoCivil']) ? addslashes($_POST['EstadoCivil']) : "ERROR";
    $escolaridade = isset($_POST['escolaridade']) ? addslashes($_POST['escolaridade']) : "ERROR";
    $profissao = isset($_POST['profissao']) ? addslashes($_POST['profissao']) : "ERROR";
    $ccE = isset($_POST['ccE']) ? addslashes($_POST['ccE']) : "ERROR";
    $dprt = isset($_POST['dprt']) ? addslashes($_POST['dprt']) : "ERROR";
    $func = isset($_POST['func']) ?addslashes ($_POST['func']) : "ERROR";
    $actInit = isset($_POST['actInit']) ? addslashes($_POST['actInit']) : "ERROR";
    $contr = isset($_POST['contr']) ? addslashes($_POST['contr']) : "ERROR";
    $actvDes = isset($_POST['actvDes']) ? addslashes($_POST['actvDes']) : "ERROR";
    $actividades = isset($_POST['actividades']) ? addslashes($_POST['actividades']) : "ERROR";
    $ofilhos_qtd = isset($_POST['ofilhos_qtd']) ? addslashes($_POST['ofilhos_qtd']) : "ERROR";
    $obs = isset($_POST['obs']) ? addslashes($_POST['obs']) : "ERROR";
    $typeC = isset($_POST['typeC']) ? addslashes($_POST['typeC']) : "ERROR";
    $CV = isset($_FILES['CV']) ? addslashes($_FILES['CV']) : "ERROR";
    $BI = isset($_FILES['BI']) ? addslashes($_FILES['BI']) : "ERROR";

    $endereco = $rua.', '.$numero.', '.$bairro.', '.$cidade;
    //UPLOAD
    //$extensaoCV = strtolower(substr($_FILES['CV']['name'], -4));
    //$extensaoBI = strtolower(substr($_FILES['BI']['name'], -4)); //pega a extensao do arquivo
    //pega a extensao do arquivo
    //$novo_nomeCV = md5(time()) . $extensaoCV;
    //$novo_nomeBI = md5(time()) . $extensaoBI;  //define o nome do arquivo
    $diretorio = "docx/"; //define o diretorio para onde enviaremos o arquivo

    //move_uploaded_file($_FILES['CV']['tmp_name'], $diretorio.$novo_nome); //efetua o upload
    //move_uploaded_file($_FILES['BI']['tmp_name'], $diretorio.$novo_nome); //efetua o upload

    echo 'Peguei Todos os Dados';

    //SALVANDO NA BASE DE DADOS 
    //Dados da Pessoa 
    $ver = $pdo->prepare("SELECT * FROM person WHERE nif = '$nif'");
    $ver->execute();
    if($ver->rowCount()>0)
    {
      echo '<script>alert("Essa Pessoa Já faz parte da empresa!")</script>';
    }else 
      {
        $pessoa = $pdo->prepare("INSERT INTO person(name, nif, birthDate, sex, status, qtdSon, studentLevel, profition, address, howToMetedTheCompany) VALUES(:name, :nif, :dtnasc, :sexo, :EstadoCivil, :ofilhos_qtd, :escolaridade, :profissao, :endereco, :ccE)");
        
        $pessoa->bindParam(":name", $name); 
        $pessoa->bindParam(":nif", $nif); 
        $pessoa->bindParam(":dtnasc", $dtnasc); 
        $pessoa->bindParam(":sexo", $sexo);
        $pessoa->bindParam(":EstadoCivil", $EstadoCivil); 
        $pessoa->bindParam(":ofilhos_qtd", $ofilhos_qtd); 
        $pessoa->bindParam(":escolaridade", $escolaridade); 
        $pessoa->bindParam(":profissao", $profissao); 
        $pessoa->bindParam(":endereco", $endereco); 
        $pessoa->bindParam(":ccE", $ccE);
        $pessoa->execute();
        if($pessoa->rowCount() > 0)
        {
          $getId = $pdo->prepare("SELECT * FROM person WHERE nif = '$nif'");
          $linha = $getId->fetch();
          $idPessoa = $linha['idPerson'];
          $contacto = $pdo->prepare("INSERT INTO contacts(contact, id) VALUES('$n1', '$idPessoa')");
          $contacto = $pdo->prepare("INSERT INTO contacts(contact, id) VALUES('$n2', '$idPessoa')");
          $contacto = $pdo->prepare("INSERT INTO contacts(contact, id) VALUES('$email', '$idPessoa')");
          $contacto->Execute();
          if($contacto->rowCount() > 0)
          {
            $idDepart = $pdo->prepare("SELECT * FROM departament WHERE name = '$dprt'");
            $idDepart->execute();
            $l = $idDepart->fetch();
            $idD = $l['id'];
            //PegandoTambémAFuncao
            $idFunc = $pdo->prepare("SELECT * FROM function WHERE name = '$func'");
            $idFunc->execute();
            $ll = $idFunc->fetch();
            $idF = $ll['id']; 
            $CONTRACT = $pdo->prepare("INSERT INTO contract VALUES('$idPessoa', '$idD', '$typeC', '$contr', '$actInit, '$obs')");
            $CONTRACT->execute();
            if($CONTRACT->rowCount() > 0)
            {
              $personDe = $pdo->prepare("INSERT INTO persondepart VALUES('$idPessoa', '$idD')");
              $personDe->execute();
              if($personDe->rowCount() > 0)
              {
                $personFu = $pdo->prepare("INSERT INTO personfunction VALUES('$idPessoa', '$idF')");
                $personFu->execute();
                if($personFu->rowCount())
                {
                  $activities = $pdo->prepare("INSERT INTO activities VALUES('$actividades', '$idF')"); 
                  $activities->execute();
                  if($activities->rowCount() > 0)
                  {
                    echo "<script>alert('Funcionário Cadastrado Com sucesso!')</script>";
                  }else
                    {
                      echo "<script>alert('Funcionário Não Cadastrado, Tente Novamente!')</script>";
                    }
                }else
                  {
                    echo "<script>alert('Try Again!')</script>";
                  }
              }

            }
          }
        }
      }
  }
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="../assets/style/index.css">
    <script src="view/js/index.js"></script>
    <link href="../assets/frame/v3/bootstrap.css" rel="stylesheet" id="bootstrap-css">
    <script src="maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="code.jquery.com/jquery-1.11.1.min.js"></script>
    <meta charset="utf-8"> 
    <style>       
        button 
        {
            transition-duration: 0.4s;
        }

        button:hover 
        {
            background-color: #4CAF50; /* Green */
            color: white;
        }
        .f 
        {
            background-color: transparent;
        }
    </style>
    <link rel="stylesheet" href="../assets/style/index.css">
</head>
<body style="background-color: whitesmoke;">
    <div class="container">
      <h2>Logo</h2>
        <div class="row">
          <div class="col">
            <form class="form-horizontal" class="f" method="post">
                <div class="panel">
                    <div class="panel-body">
                <div class="form-group">
                <!--
                <div class="form-group">   
                <div class="col-md-4 control-label">
                    <img id="logo" src="http://blogdoporao.com.br/wp-content/uploads/2016/12/Faculdade-pitagoras.png"/>
                </div>
                <div class="col-md-4 control-label">
                    <h1>Cadastro de Cliente</h1>
                    
                </div>
                </div>
                    -->
                <div class="col-md-11 control-label">
                        <p class="help-block"><h11>*</h11> Campo Obrigatório </p>
                </div>
                </div>
                
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-2 control-label" for="Nome">Nome <h11>*</h11></label>  
                  <div class="col-md-8">
                  <input id="Nome" name="Nome" placeholder="" class="form-control input-md" required="" type="text">
                  </div>
                </div>
                
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-2 control-label" for="Nome">NIF <h11>*</h11></label>  
                  <div class="col-md-2">
                    <input id="cpf" name="nif" placeholder="Apenas números" class="form-control input-md" required="" type="text" maxlength="14">
                  </div>
                  
                  <label class="col-md-1 control-label" for="Nome">Nascimento<h11>*</h11></label>  
                  <div class="col-md-2">
                  <input id="dtnasc" name="dtnasc" placeholder="AAAA/MM/DD" class="form-control input-md" required="" type="date" maxlength="10" onBlur="showhide()">
                </div>
                
                <!-- Multiple Radios (inline) -->
                
                  <label class="col-md-1 control-label" for="radios">Sexo <h11>*</h11></label>
                  <div class="col-md-4"> 
                    <label required="" class="radio-inline" for="radios-0" >
                      <input name="sexo" id="sexo" value="feminino" type="radio" required>
                      Feminino
                    </label> 
                    <label class="radio-inline" for="radios-1">
                      <input name="sexo" id="sexo" value="masculino" type="radio">
                      Masculino
                    </label>
                  </div>
                </div>
                
                <!-- Prepended text-->
                <div class="form-group">
                  <label class="col-md-2 control-label" for="prependedtext">Telefone <h11>*</h11></label>
                  <div class="col-md-2">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                      <input id="prependedtext" name="n1" class="form-control" placeholder="XXX XXX XXX" required="" type="text" maxlength="9" pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$"
                      OnKeyPress="formatar('### ### ###', this)">
                    </div>
                  </div>
                  
                    <label class="col-md-1 control-label" for="prependedtext">Telefone</label>
                     <div class="col-md-2">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                      <input id="prependedtext" name="n2" class="form-control" placeholder="XXX XXX XXX" type="text" maxlength="9"  pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$"
                      OnKeyPress="formatar('### ### ####', this)">
                    </div>
                  </div>
                 </div> 
                
                <!-- Prepended text-->
                <div class="form-group">
                  <label class="col-md-2 control-label" for="prependedtext">Email <h11>*</h11></label>
                  <div class="col-md-5">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                      <input id="prependedtext" name="email" class="form-control" placeholder="email@email.com" required="" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" >
                    </div>
                  </div>
                </div>
                
                
                <!-- Prepended text-->
                <div class="form-group">
                  <label class="col-md-2 control-label" for="prependedtext">Endereço</label>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">Rua</span>
                      <input id="rua" name="rua" class="form-control" placeholder="" required=""  type="text">
                    </div>
                    
                  </div>
                    <div class="col-md-2">
                    <div class="input-group">
                      <span class="input-group-addon">Nº da Casa <h11>*</h11></span>
                      <input id="numero" name="numero" class="form-control" placeholder="" required=""  type="text">
                    </div>
                    
                  </div>
                  
                  <div class="col-md-3">
                    <div class="input-group">
                      <span class="input-group-addon">Bairro</span>
                      <input id="bairro" name="bairro" class="form-control" placeholder="" required="" type="text">
                    </div>
                    
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-md-2 control-label" for="prependedtext"></label>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">Cidade</span>
                      <input id="cidade" name="cidade" class="form-control" placeholder="" required=""  type="text">
                    </div> 
                  </div>
                   <div class="col-md-2">
                    <div class="input-group">
                    </div>
                  </div>
                </div>
                
                <!-- Select Basic -->
                <div class="form-group">
                  <label class="col-md-2 control-label" for="Estado Civil">Estado Civil <h11>*</h11></label>
                  <div class="col-md-2">
                    <select required id="Estado Civil" name="EstadoCivil" class="form-control">
                        <option value=""></option>
                      <option value="Solteiro(a)">Solteiro(a)</option>
                      <option value="Casado(a)">Casado(a)</option>
                      <option value="Divorciado(a)">Divorciado(a)</option>
                      <option value="Viuvo(a)">Viuvo(a)</option>
                    </select>
                  </div>
                  
                  <!-- Prepended checkbox -->
                
                  <label class="col-md-1 control-label" for="Filhos">Filhos<h11>*</h11></label>
                  <div class="col-md-3">
                    <div class="input-group">
                      <span class="input-group-addon">     
                        <label class="radio-inline" for="radios-0">
                      <input type="radio" name="filhos" id="filhos" value="nao" onclick="desabilita('filhos_qtd')" required>
                      Não
                    </label> 
                    <label class="radio-inline" for="radios-1">
                      <input type="radio" name="filhos" id="filhos" value="sim" onclick="habilita('filhos_qtd')">
                      Sim
                    </label>
                      </span>
                      <input id="filhos_qtd" name="filhos_qtd" class="form-control" type="text" placeholder="Quantos?" pattern="[0-9]+$" >
                      
                    </div>
                    
                  </div>
                </div>
                  
                <!-- Select Basic -->
                <div class="form-group">
                    
                  <label class="col-md-2 control-label" for="selectbasic">Escolaridade <h11>*</h11></label>
                  
                  <div class="col-md-3">
                    <select required id="escolaridade" name="escolaridade" class="form-control">
                    <option value=""></option>
                      <option value="Analfabeto">Analfabeto</option>
                      <option value="Fundamental Incompleto">Fundamental Incompleto</option>
                      <option value="Fundamental Completo">Fundamental Completo</option>
                      <option value="Médio Incompleto">Médio Incompleto</option>
                      <option value="Médio Completo">Médio Completo</option>
                      <option value="Superior Incompleto">Superior Incompleto</option>
                      <option value="Superior Completo">Superior Completo</option>
                    </select>
                  </div>
                
                
                <!-- Text input-->
                
                  <label class="col-md-1 control-label" for="profissao">Profissão<h11>*</h11></label>  
                  <div class="col-md-4">
                  <input id="profissao" name="profissao" type="text" placeholder="" class="form-control input-md" required="">
                    
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="col-md-">
                  </div>
                 </div>
                 
                 <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-2 control-label" for="textinput">Como conheceu a empresa?</label>  
                  <div class="col-md-4">
                  <input id="textinput" name="ccE" placeholder="" class="form-control input-md" type="text">
                    
                  </div>

                  </div>          
                </div>
          <div class="col">
            <div id="newpost">
                <div class="form-group">
                 <div class="col-md-2 control-label">
                     <h3>A nível da Empresa</h3>
                 </div>
                 </div>
                 
             <div class="form-group">
               <label class="col-md-2 control-label" for="Nome">Departamento <h11>*</h11></label>  
               <div class="col-md-8">
               <?php
                            //$a->EveryProfiles();
                            $sql = $pdo->prepare("SELECT * FROM departament");
                            $row = $sql->fetch();
                            $ID = $row['id'];
                            $sql->execute();
                            echo '
                                  <select name="dprt" class="form-control input-md" required="" type="text">
                                ';
                            while($depart = $sql->fetch(PDO::FETCH_ASSOC))
                            { 
                                echo '
                                        <option value='.$depart['name'].'>'.$depart['name'].'</option>
                                ';
                                //echo "ID". $profiles['id']."<br>";
                                //echo "Nome". $profiles['name']."<br>";
                            }
                            echo '
                            </select>'
                        ?>
               <!--<input id="dprt" name="dprt" placeholder="" class="form-control input-md" required="" type="text">-->
               </div>
             </div>
             
             <!-- Text input-->
             <div class="form-group">
               <label class="col-md-2 control-label" for="vinculo">Função<h11>*</h11></label>  
               <div class="col-md-2">
                        <?php
                            //$a->EveryProfiles();
                            //$sql = $pdo->prepare("SELECT * FROM function where idDepart = '$ID'");
                            $sql = $pdo->prepare("SELECT * FROM function");
                            $sql->execute();
                            echo '
                                  <select name="func" class="form-control input-md" required="" type="text">
                                ';
                            while($func = $sql->fetch(PDO::FETCH_ASSOC))
                            { 
                                echo '
                                        <option value='.$func['name'].'>'.$func['name'].'</option>
                                ';
                                //echo "ID". $profiles['id']."<br>";
                                //echo "Nome". $profiles['name']."<br>";
                            }
                            echo '
                            </select>'
                        ?>
                  <!--<input id="func" name="func" placeholder="" class="form-control input-md" required="" type="text">--> 
               </div>
             
               
               <label class="col-md-1 control-label" for="Nome">Inicio de Exercício<h11>*</h11></label>  
               <div class="col-md-2">
               <input id="actInit" name="actInit" placeholder="DD/MM/AAAA" class="form-control input-md" required="" type="date" maxlength="10">
             </div>
             
             <!-- Multiple Radios (inline) -->
             
               <label class="col-md-1 control-label" for="radios">Tem contrato? <h11>*</h11></label>
               <div class="col-md-4"> 
                 <label required="" class="radio-inline" for="radios-0" >
                   <input name="contr" id="contr" value="Sim" type="radio" required>
                   Sim
                 </label> 
                 <label class="radio-inline" for="radios-1">
                   <input name="contr" id="contr" value="Não" type="radio">
                   Não
                 </label>
               </div>
             </div>
             
             <div class="form-group">
               <label class="col-md-2 control-label" for="Estado Civil">Actividades <h11>*</h11></label>
               <div class="col-md-3">
                <input id="dprt" name="actividades" placeholder="" class="form-control input-md" required="" type="text">
               </div>
             
             <label class="col-md-2 control-label" for="Filhos">Exerce suas actividades?<h11>*</h11></label>
               <div class="col-md-3">
                 <div class="input-group">
                   <span class="input-group-addon">     
                     <label class="radio-inline" for="radios-0">
                   <input type="radio" name="actvDes" id="ofilhos" value="nao" onclick="habilita('ofilhos_qtd')" required>
                   Não
                 </label> 
                 <label class="radio-inline" for="radios-1">
                   <input type="radio" name="actvDes" id="ofilhos" value="sim" onclick="desabilita('ofilhos_qtd')">
                   Sim
                 </label>
                   </span>
                   <input id="ofilhos_qtd" name="ofilhos_qtd" class="form-control" type="text" placeholder="Porquê?" pattern="[0-9]+$" >
                   
                 </div>
                 
               </div>
             </div>
             <div class="form-group">  
               <label class="col-md-2 control-label" for="selectbasic">Tipo de Contrato <h11>*</h11></label>  
               <div class="col-md-3">
                 <select required id="escolaridade" name="typeC" class="form-control">
                 <option value=""></option>
                   <option value="Efectivo">Efectivo</option>
                   <option value="Ano Seguinte">Ano Seguinte</option>
                   <option value="Por ano">Por ano</option>
                   <option value="Semestral">Semestral</option>
                   <option value="Trimestral">Trimestral</option>
                   <option value="Ocasional">Ocasional</option>
                   <option value="Prestação de Serviço">Prestação de Serviço</option>
                   <option value="Outro">Outro</option>
                 </select>
               </div>
             
             <!-- Text input-->
             
               <div class="col-md-4">    
               </div>
             </div>
             <div class="form-group">
                 
            </div>
               </div>
              </div> 
             <div class="form-group">
               <label class="col-md-2 control-label" for="prependedtext">Observações <h11>*</h11></label>
               <div class="col-md-5">
                 <div class="input-group">
                    <textarea name="obs" class="form-control" id="obs" cols="110" rows="5"></textarea><br><br>
                    <div class="containe form-group"><br><br>
                      <h5>Anexe aqui seus documentos</h5>
                        <input type="file" class="form-control" placeholder="Aqui coloque o CV" name="CV"> <br>
                        <input type="file" class="form-control" placeholder="Aqui coloque o CV" name="BI">
                   <!--pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$-->
                 </div>
               </div>
             </div>
            </div>
          </div> 
          
             <!-- Button (Double) -->
            <div class="form-group text-center pb-3">
                <label class="col-md-2 control-label" for="Cadastrar"></label>
                <div class="col-md-8">
                    <button id="Cadastrar" name="cadastrar" class="btn btn-success" type="Submit">Cadastrar</button>
                    <button id="Cancelar" name="Cancelar" class="btn btn-danger" type="Reset">Cancelar</button>
                    <a href="index.html">
                        <button id="Cancelar" name="Cancelar" class="btn btn-danger" type="Reset">Sair</button>
                    </a>
                </div>
            </div>
            </div>
    </form>          
</div>
</div><br>
<footer>
  <div class="container text-center">
      <p>Sistema de Cadastro de Funcionários <br> Copirigth &copy;2021 Todos direitos reservados
      Dev.By. Luís Caputo.</p>
  </div>
</footer>
</div>
<script src="../view/js/index.js"></script>
<script src="../assets/js/axios.min.js"></script>

</body>
</html>