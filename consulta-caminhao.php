<?php
session_start();
include_once "dao/caminhaodao.class.php";
include_once "modelo/caminhao.class.php";
include_once "util/helper.class.php";
$camDAO = new CaminhaoDAO();
$caminhoes = $camDAO->buscarCaminhao();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Cadastro de Caminhão</title>
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
      <h1 class="jumbotron bg-secondary" style="text-align: center; font-family: 'Alegreya Sans SC', sans-serif;">Cadastro de Caminhão</h1>

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

        <h2 style="text-align: center">Consulta de Caminhão </h2>

        <form name="filtrocaminhao" method="post" action="">

          <div class="row">
            <div class="form-group col-md-6">
              <input type="text" name="txtfiltro" placeholder="Digite a sua pesquisa" class="form-control">
            </div>

            <div class="form-group col-md-6">
              <select name="selfiltro" class="form-control">
                <option value=""> Selecione </option>
                <option value="codigo"> Código </option>
                <option value="placa"> Placa </option>
                <option value="modelo"> Modelo </option>
                <option value="chassi"> Chassi </option>
                <option value="ano"> Ano </option>
                <option value="peso"> Peso </option>
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

          if($filtro == "" || $pesquisa == ""){
            $caminhoes = $camDAO->buscarCaminhao();
            $qtdErros++;
          }

          if($qtdErros == 0){
            $query = "";
            if($filtro == 'codigo'){
              $query = "where idcaminhao like '%".$pesquisa ."%'";
            } else if ($filtro == 'placa'){
              $query = "where placa like  '%".$pesquisa."%'";
            } else if ($filtro == 'modelo'){
              $query = "where modelo like '%".$pesquisa."%'";
            } else if ($filtro == 'chassi'){
              $query = "where chassi like '%".$pesquisa."%'";
            } else if ($filtro == 'ano'){
              $query = "where ano like '%".$pesquisa."%'";
            } else if ($filtro == 'peso'){
              $query = "where peso like  '%".$pesquisa."%'";
            }

            $caminhoes = $camDAO->filtrar($query);
          }//if qtd erros
        }

        if(count($caminhoes) == 0){
          Helper::h2("Não há caminhões cadastrados no banco");
          die();
        }
        ?>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
              <tr>
                <th>Código</th>
                <th>Placa</th>
                <th>Modelo</th>
                <th>Chassi</th>
                <th>Ano</th>
                <th>Peso</th>
                <th>Excluir</th>
                <th>Alterar</th>
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th>Código</th>
                <th>Placa</th>
                <th>Modelo</th>
                <th>Chassi</th>
                <th>Ano</th>
                <th>Peso</th>
                <th>Excluir</th>
                <th>Alterar</th>
              </tr>
            </tfoot>

          <tbody>
            <?php
            foreach($caminhoes as $c){
              echo "<tr>";
                echo "<td>$c->idcaminhao</td>";
                echo "<td>$c->placa</td>";
                echo "<td>$c->modelo</td>";
                echo "<td>$c->chassi</td>";
                echo "<td>$c->ano</td>";
                echo "<td>$c->peso</td>";
                echo "<td><a href='consulta-caminhao.php?id=$c->idcaminhao' class='btn btn-danger'>Excluir</a></td>";
                echo "<td><a href='alterar-caminhao.php?id=$c->idcaminhao' class='btn btn-warning'>Alterar</a></td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div><!-- table responsive -->
      </div>
      <?php

      if(isset($_GET['id'])){
        $camDAO->deletarCaminhao($_GET['id']);
        $_SESSION['msg'] = "Caminhão excluido com sucesso!";
        header("location:consulta-caminhao.php");
      }
      ?>
      </body>
    </html>
