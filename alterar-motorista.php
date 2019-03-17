<?php
if (isset($_GET['id'])) {
  include_once 'dao/motoristadao.class.php';
  include_once 'modelo/motorista.class.php';

  $motDAO = new MotoristaDAO();
  $query = "where idmotorista = " .$_GET['id'];
  $motoristas = $motDAO->filtrar($query);
  $motorista = $motoristas[0];
  //var_dump($motoristas);
} else {
  header("location:index.php");
}
 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Cadastro de Motorista</title>
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
        <h1 class="jumbotron bg-secondary" style="text-align: center; font-family: 'Alegreya Sans SC', sans-serif;">Alterar Motorista</h1>

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

        <form name="cadmotorista" method="post" action="">
          <div class="form-group">
            <input type="text" name="txtnome" placeholder="Nome"
             class="form-control" value="<?php echo $motorista->nome;?>">
          </div>

          <div class="form-group">
            <input type="number" name="numidade" placeholder="Idade"
             class="form-control" value="<?php echo $motorista->idade; ?>">
          </div>

          <div class="radio">
              <label class="radio-inline">
                <input type="radio" name="rdsexo" value="Masculino" <?php if($motorista->sexo == 'Masculino') echo "checked=".true; ?>>
                  Masculino</label>

              <label class="radio-inline">
                <input type="radio" name="rdsexo" value="Feminino" <?php if($motorista->sexo == 'Feminino') echo "checked=".true; ?>>
                  Feminino</label>
            </div>

          <div class="form-group">
            <input type="text" name="txtcpf" placeholder="CPF"
            class="form-control" value="<?php echo $motorista->cpf;?>">
          </div>

          <div class="form-group">
            <input type="text" name="txttelefone" placeholder="Telefone"
            class="form-control" value="<?php echo $motorista->telefone;?>">
          </div>

          <div class="form-group">
            <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
            <input type="reset" name="Limpar" value="Limpar" class="btn btn-danger">
          </div>
        </form>

        <?php
        if(isset($_POST['alterar'])){
          include_once "modelo/motorista.class.php";
          include_once "dao/motoristadao.class.php";
          include_once "util/helper.class.php";
          include_once "util/padronizacao.class.php";
          include_once "util/validacao.class.php";

          $qtdErros=0;

          if (!Validacao::validarNome($_POST['txtnome'])) {
            $qtdErros++;
            Helper::alert("Nome inválido.");
          }

          if (!Validacao::validarCpf($_POST['txtcpf'])) {
            $qtdErros++;
            Helper::alert("CPF inválido.");
          }

          if (!Validacao::validarIdade($_POST['numidade'])) {
            $qtdErros++;
            Helper::alert("Idade inválida.");
          }

          if ($_POST['numidade'] < 21){
            Helper::alert("Idade inferior.");
          }

          if (!Validacao::validarTelefone($_POST['txttelefone'])) {
            $qtdErros++;
            Helper::alert("Telefone inválido.");
          }

          if($qtdErros == 0){



            $mot = new Motorista();
            $mot->idMotorista = $_GET['id'];
            $mot->nome = Padronizacao::padronizacaoMainMin(Validacao::antiXSS($_POST['txtnome']));
            $mot->idade = $_POST['numidade'];
            $mot->sexo = $_POST['rdsexo'];
            $mot->cpf = $_POST['txtcpf'];
            $mot->telefone = $_POST['txttelefone'];
            $motDAO = new MotoristaDAO();
            $motDAO->alterarMotorista($mot);
            unset($_POST);
            //var_dump($mot);
            Helper::alert("Motorista alterado com sucesso!");

        header('location:consulta-motorista.php');
        }
      }//fecha 1 if
         ?>
      </div>
  </body>
</html>
