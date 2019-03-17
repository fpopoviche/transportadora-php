<?php
class Padronizacao{

  public static function padronizacaoMainMin($v){
    return ucwords(strtolower($v));
  }

  public static function padronizarPlaca($v){
    return strtoupper($v);
  }
}
