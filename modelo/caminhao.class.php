<?php
  Class Caminhao{
    private $idCaminhao;
    private $placa;
    private $modelo;
    private $chassi;
    private $ano;
    private $peso;

    public function __construct(){}
    public function __destruct(){}

    public function __get($a){return $this->$a;}
    public function __set($a,$v){$this->$a=$v;}

    public function __toString(){
      return nl2br("Código: $this->idCaminhao
                    Placa: $this->placa
                    Modelo: $this->modelo
                    Chassi: $this->chassi
                    Ano: $this->ano
                    Peso> $this->peso");
    }
  }//fecha classe
