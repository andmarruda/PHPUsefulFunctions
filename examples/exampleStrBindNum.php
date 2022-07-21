<?php
  require_once(__DIR__. '/../strUtil.class.php');
  use \sysborg\strUtil;
  $string = 'SELECT * FROM teste WHERE teste=? AND teste2=? AND teste IN (?, ?, ?, ?)';

  $binded = strUtil::strBindNum($string, 'abc', 'cde', 1, 2, 3, 4);
  var_dump($binded); //SELECT * FROM teste WHERE teste=abc AND teste2=cde AND teste IN (1, 2, 3, 4)
?>
