<?php
  Class Motorista{
    private $idMotorista;
    private $nome;
    private $idade;
    private $sexo;
    private $cpf;
    private $telefone;

    public function __construct(){}
    public function __destruct(){}

    public function __get($a){return $this->$a;}
    public function __set($a, $v){$this->$a = $v;}

    public function __toString(){
      return nl2br("Código: $this->idMotorista
                    Nome: $this->nome
                    Idade: $this->idade
                    Sexo: $this->sexo
                    CPF: $this->cpf
                    Telefone: $this->telefone");
    }
  }//fecha classe
