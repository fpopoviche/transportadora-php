<?php
if(isset($_GET['id'])){
  include_once 'dao/caminhaodao.class.php';
  include_once 'modelo/caminhao.class.php';

  $camDAO = new CaminhaoDAO();
  $query = "where idcaminhao = " .$_GET['id'];
  $caminhoes = $camDAO->filtrar($query);
  $caminhao = $caminhoes[0];
} else {
  header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Alterar Caminhão</title>
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
      <h1 class="jumbotron bg-secondary" style="text-align: center; font-family: 'Alegreya Sans SC', sans-serif;">Alterar Caminhão</h1>

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

        <form name="alterarcaminhao" method="post" action="">

          <div class="form-group">
            <input type="text" name="txtplaca" placeholder="Placa" class="form-control" value="<?php echo $caminhao->placa?>">
          </div>

          <div class="form-group">
            <input type="text" name="txtmodelo" placeholder="Modelo" class="form-control" value="<?php echo $caminhao->modelo?>">
          </div>

          <div class="form-group">
            <input type="text" name="txtchassi" placeholder="Chassi" class="form-control" value="<?php echo $caminhao->chassi?>">
          </div>

          <div class="form-group">
            <input type="number" name="numano" placeholder="Ano" class="form-control" value="<?php echo $caminhao->ano?>">
          </div>

          <div class="form-group">
            <input type="text" name="txtpeso" placeholder="Peso máx carga" class="form-control" value="<?php echo $caminhao->peso?>">
          </div>

          <div class="form-group">
            <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
            <input type="reset" name="Limpar" value="Limpar" class="btn btn-danger">
          </div>
        </form>

        <?php
        if(isset($_POST['alterar'])){
          include_once "modelo/caminhao.class.php";
          include_once "dao/caminhaodao.class.php";
          include_once "util/helper.class.php";
          include_once "util/padronizacao.class.php";
          include_once "util/validacao.class.php";

          $qtdErros=0;

          if (!Validacao::validarPlaca($_POST['txtplaca'])) {
            $qtdErros++;
            Helper::alert("Placa inválida.");
          }

          if (!Validacao::validarDouble($_POST['txtpeso'])) {
            $qtdErros++;
            Helper::alert("Peso inválido.");
          }

            if($qtdErros == 0){

              $cam = new Caminhao();
              $cam->idCaminhao = $_GET['id'];
              $cam->placa = Padronizacao::padronizarPlaca(Validacao::antiXSS($_POST['txtplaca']));
              $cam->modelo = Padronizacao::padronizacaoMainMin(Validacao::antiXSS($_POST['txtmodelo']));
              $cam->chassi = $_POST['txtchassi'];
              $cam->ano = $_POST['numano'];
              $cam->peso = $_POST['txtpeso'];
              $camDAO = new CaminhaoDAO();
              $camDAO->alterarCaminhao($cam);
              unset($_POST);
              //var_dump($cam);
              Helper::alert("Caminhão alterado com sucesso!");
            }
        }
        ?>
      </div>
  </body>
</html>
