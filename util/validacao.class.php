<?php
class Validacao{
  public static function validarNome($v){
    $exp = "/^[a-zA-Z ]{2,100}$/";
    return preg_match($exp,$v);
  }

  public static function validarTelefone($v){
      $exp = "/^[0-9]{12}|[0-9]{5}-[0-9]{4}|\([0-9]{3}\) [0-9]{5}-[0-9]{4}$/";
      return preg_match ($exp, $v);
  }

  public static function validarCpf($v){
      $exp = "/^([0-9]){3}\.([0-9]){3}\.([0-9]){3}-([0-9]){2}$/";
      return preg_match ($exp, $v);
  }

  public static function validarIdade($v){
    $exp = "/^[0-9]{2}$/";
    return preg_match ($exp, $v);
  }

  public static function validarPlaca($v){
    $exp = "/^[A-z]{3}-[0-9]{4}$/";
    return preg_match ($exp, $v);
  }

  public static function validarDouble($v){
    $exp = "/^[0-9]{1,3}[.]1|[0-9]{1,3}$/";
    return preg_match($exp,$v);
  }


/*  public static function validarChassi($v){
    $exp = "/[^ -!@#$%¨&*()+*.,;?_]/";
  }
*/
  public static function antiXSS($v){
    return htmlspecialchars(trim($v));
  }
}
