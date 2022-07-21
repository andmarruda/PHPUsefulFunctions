<?php
/**
	* This project is some useful functions that i developed in my programmer's life
  	* en-US: Useful functions referenced from string
	* pt-BR: Funções úteis referentes a string
	*
	* Está atualizado para
	*    PHP 8.1
	*
	* @package 		sysborg
	* @name 		sysborg\strUtil
	* @version 		1.0.0
	* @copyright 		2021-2030
	* @author 		Anderson M Arruda < andmarruda@gmail.com >
**/

namespace sysborg;

class strUtil{
  /**
   * description-en-US  Used to inject values through string's template idea
   * description-pt-BR  Serve para injetar valores através de templates para string
   * access             public
   * version            1.0.0
   * author             Anderson Arruda < andmarruda@gmail.com >
   * param              string $string
   * param              array $variables
   * return             string
   */
  public static function injectVariables(string $string, array $variables) : string
  {
    preg_match_all('/(\{\{[0-9a-zA-Z\_\-]{1,}\}\})/', $string, $matches);
    if(count($matches[0]) > 0){
      $string = preg_replace('/(\{\{[0-9a-zA-Z\_\-]{1,}\}\})/', '%s', $string);
      $vals=[];
      foreach($matches[0] as $p){
          $k = str_replace(['{', '}'], '', $p);
          $k = trim($k);
          array_push($vals, ($variables[$k] ?? ''));
      }

      return sprintf($string, ...$vals);
    }

    return $string;
  }
  
  /**
   * description-en-US  Get the part before @ on email
   * description-pt-BR  Pega a parte antes do @ do email
   * access             publc
   * version            1.0.0
   * author             Anderson Arruda < andmarruda@gmail.com >
   * param              string $email
   * return             string
   */
  public static function extratLStrEmail(string $email) : string
  {
    preg_match('/^.*(?=@)/', $email, $emailMatch);
    return $emailMatch[0]; 
  }

  /**
   * description-en-US  Simulate bind into string putting all args as string | Good to debug bindable SQL with ?
   * description-pt-BR  Simula o bind dentro duma string colocando todos os argumentos como string | Bom para debugar SQL com binds através de ?
   * access             public
   * version            1.0.0
   * author             Anderson Arruda < andmarruda@gmail.com >
   * param              string $bindable
   * param              mixed ...$binds
   * return             string
   */
    public static function strBindNum(string $bindable, ...$binds) : string
    {
        $num = substr_count($bindable, '?');
        if($num===0)
            return $bindable;
            
        if($num != count($binds))
            throw new \Exception('Number of variables doesn\'t match number of parameters');
            
        $bindable = str_replace('?', '%s', $bindable);
        return sprintf($bindable, ...$binds);
    }
}
?>
