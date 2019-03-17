<?php
require_once "conexaobanco.class.php";
class MotoristaDAO{

    private $conexao = null;

    public function __construct(){
      $this->conexao = ConexaoBanco::getInstance();
    }

    public function __destruct(){}

    public function cadastrarMotorista($mot){//objeto motorista
      try {

        $stat = $this->conexao->prepare("insert into motorista(idmotorista,nome,idade,sexo,cpf,telefone)values(null,?,?,?,?,?)");

        $stat->bindValue(1,$mot->nome);
        $stat->bindValue(2,$mot->idade);
        $stat->bindValue(3,$mot->sexo);
        $stat->bindValue(4,$mot->cpf);
        $stat->bindValue(5,$mot->telefone);

        $stat->execute();

      } catch (PDOException $e) {
        echo "Erro ao cadastrar motorista!" .$e;
      }//fecha catch
    }//cadastrarMotorista

    public function buscarMotorista(){
      try {
        $stat = $this->conexao->query("select * from motorista");
        $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Motorista');
        return $array;
      } catch (PDOException $e) {
        echo "Erro ao buscar motorista! " .$e;
      }//fecha catch
    }//buscarMotorista

    public function deletarMotorista($id){
      try {
        $stat= $this->conexao->prepare("delete from motorista where idmotorista = ?");
        $stat->bindValue(1, $id);
        $stat->execute();
      } catch (PDOException $e) {
        echo "Erro ao excluir motorista " .$e;
      }//catch
    }//deletarMotorista

    public function filtrar($query){
      try {
        $stat= $this->conexao->query("select * from motorista " .$query);
        $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Motorista');
        return $array;
      } catch (PDOException $e) {
        echo "Erro ao filtrar motorista!" .$e;
      }//fecha catch
    }//fecha filtrar livro

    public function alterarMotorista($mot){
      try {
        $stat = $this->conexao->prepare("update motorista set nome=?, idade=?, sexo=?, cpf=?, telefone=? where idmotorista=?");

        $stat->bindValue(1, $mot->nome);
        $stat->bindValue(2, $mot->idade);
        $stat->bindValue(3, $mot->sexo);
        $stat->bindValue(4, $mot->cpf);
        $stat->bindValue(5, $mot->telefone);
        $stat->bindValue(6, $mot->idMotorista);
        $stat->execute();
      } catch (PDOException $e) {
        echo "Erro ao alterar motorista" .$e;
      }//catch
    }//alterarMotorista
}//fecha classe
