<?php
require_once "conexaobanco.class.php";
class CaminhaoDAO{

  private $conexao = null;

  public function __construct(){
    $this->conexao = ConexaoBanco::getInstance();
  }

  public function __destruct(){}

  public function cadastrarCaminhao($cam){
    try {

      $stat = $this->conexao->prepare("insert into caminhao (idcaminhao, placa, modelo, chassi, ano, peso)values (null,?,?,?,?,?)");

      $stat->bindValue(1, $cam->placa);
      $stat->bindValue(2, $cam->modelo);
      $stat->bindValue(3, $cam->chassi);
      $stat->bindValue(4, $cam->ano);
      $stat->bindValue(5, $cam->peso);

      $stat->execute();
    } catch (PDOException $e) {
      echo "Erro ao cadastrar caminhão." .$e;
    }//catch
  }//cadastrar

  public function buscarCaminhao(){
    try {
      $stat = $this->conexao->query("select * from caminhao");
      $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Caminhao');
      return $array;
    } catch (PDOException $e) {
      echo "Erro ao buscar caminhão." .$e;
    }//catch
  }//buscar

  public function deletarCaminhao($id){
    try {
      $stat= $this->conexao->prepare("delete from caminhao where idcaminhao = ?");
      $stat->bindValue(1, $id);
      $stat->execute();
    } catch (PDOException $e) {
      echo "Erro ao deletar caminhão." .$e;
    }//catch
  }//deletar

  public function filtrar($query){
    try {
      $stat= $this->conexao->query("select * from caminhao " .$query);
      $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Caminhao');
      return $array;
    } catch (PDOException $e) {
      echo "Erro ao filtrar." .$e;
    }//catch
  }//filtrar

  public function alterarCaminhao($cam){
    try {
      $stat = $this->conexao->prepare("update caminhao set placa=?, modelo=?, chassi=?, ano=?, peso=? where idcaminhao=?");

      $stat->bindValue(1, $cam->placa);
      $stat->bindValue(2, $cam->modelo);
      $stat->bindValue(3, $cam->chassi);
      $stat->bindValue(4, $cam->ano);
      $stat->bindValue(5, $cam->peso);
      $stat->bindValue(6, $cam->idCaminhao);
      $stat->execute();
    } catch (PDOException $e) {
      echo "Erro ao alterar." .$e;
    }//catch
  }//alterar
}//fecha classe
?>
