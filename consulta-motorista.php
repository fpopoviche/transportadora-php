<?php
session_start();
ob_start();
include_once "dao/motoristadao.class.php";
include_once "modelo/motorista.class.php";
include_once "util/helper.class.php";
$motDAO = new MotoristaDAO();
$motoristas = $motDAO->buscarMotorista();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Consulta de Motorista</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="icon" type="image/png" href="img/icon.png" />
  <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC" rel="stylesheet">
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
  <body>
      <div class="container">
        <h1 class="jumbotron bg-secondary" style="text-align: center; font-family: 'Alegreya Sans SC', sans-serif;">Consulta de Motorista</h1>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">Sistema</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cadastro-motorista.php">Cadastro de Motorista</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cadastro-caminhao.php">Cadastro de Caminhão</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="consulta-motorista.php">Consulta de Motorista</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="consulta-caminhao.php">Consulta de Caminhão</a>
              </li>
            </ul>
          </div>
        </nav>


        <h1> Consulta de Motorista </h1>
        <form name="filtromotorista" method="post" action="">

          <div class="row">
            <div class="form-group col-md-6">
              <input type="text" name="txtfiltro" placeholder="Digite a sua pesquisa" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <select name="selfiltro" class="form-control">
                <option value=""> Selecione </option>
                <option value="codigo"> Código </option>
                <option value="nome"> Nome </option>
                <option value="idade"> Idade </option>
                <option value="sexo"> Sexo </option>
                <option value="cpf"> CPF </option>
                <option value="telefone"> Telefone </option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <input type="submit" name="pesquisar" value="Pesquisar" class="form-control">
          </div>
        </form>

        <?php

        if(isset($_SESSION['msg'])){
          Helper::alert($_SESSION['msg']);
          Helper::h2($_SESSION['msg']);
          unset($_SESSION['msg']);
        }

        if(isset($_POST['pesquisar'])){
          //var_dump($_POST);
          $filtro = $_POST['selfiltro'];
          $pesquisa = $_POST['txtfiltro'];

          $qtdErros= 0;
          if($filtro == "" || $pesquisa == "") {
            $motoristas = $motDAO->buscarMotorista();
            $qtdErros++;
          }

          if($qtdErros == 0){
            $query = "";
            if($filtro == 'codigo'){
              $query = "where idmotorista like '%".$pesquisa ."%'";
            } else if ($filtro == 'nome'){
              $query = "where nome like  '%".$pesquisa."%'";
            } else if ($filtro == 'idade'){
              $query = "where idade like '%".$pesquisa."%'";
            } else if ($filtro == 'sexo'){
              $query = "where sexo like '%".$pesquisa."%'";
            } else if ($filtro == 'cpf'){
              $query = "where cpf like '%".$pesquisa."%'";
            } else if ($filtro == 'telefone'){
              $query = "where telefone like  '%".$pesquisa."%'";
            }
            //echo $query;
            $motoristas = $motDAO->filtrar($query);
            //var_dump($motoristas);
        }
      }

        if(count($motoristas) == 0){
          echo ("<h1>Sem motorista cadastrado.</h1>");
          die();
        }
          ?>
      <div class="table-responsive">
      <table class="table table-striped table-bordered
                    table-hover table-condensed">
        <thead>
          <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Idade</th>
            <th>Sexo</th>
            <th>CPF</th>
            <th>Telefone</th>
            <th>Excluir</th>
            <th>Alterar</th>
          </tr>
        </thead>

        <tfoot>
          <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Idade</th>
            <th>Sexo</th>
            <th>CPF</th>
            <th>Telefone</th>
            <th>Excluir</th>
            <th>Alterar</th>
          </tr>
        </tfoot>

        <tbody>
          <?php
          foreach($motoristas as $m){
            echo "<tr>";
              echo "<td>$m->idmotorista</td>";
              echo "<td>$m->nome</td>";
              echo "<td>$m->idade</td>";
              echo "<td>$m->sexo</td>";
              echo "<td>$m->cpf</td>";
              echo "<td>$m->telefone</td>";
              echo "<td><a href='consulta-motorista.php?id=$m->idmotorista' class='btn btn-danger'>Excluir</a></td>";
              echo "<td><a href='alterar-motorista.php?id=$m->idmotorista' class='btn btn-warning'>Alterar</a></td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
      </div>
    </div>
      <?php
      if(isset($_GET['id'])){
           $motDAO->deletarMotorista($_GET['id']);
           echo "Motorista excluido com sucesso!";
           header("location:consulta-motorista.php");
      }
      ob_end_flush();
       ?>
  </body>
</html>
