<?php
/**
 * Check if data entry is a valid CPF Brazilian people's document
 * @version     1.0.0
 * @author      Anderson Arruda < andmarruda@gmail.com >
 * @param       string $cpf
 * @return      bool
 */
function checkCpf(string $cpf) : bool
{
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    if(preg_match('/^(0{11}|1{11}|2{11}|3{11}|4{11}|5{11}|6{11}|7{11}|8{11}|9{11})$/',$cpf))
        return false;

    $init_dv1 = 10;
    $init_dv2 = 11;
    $sum_dv1 = array_reduce(str_split(substr($cpf, 0, 9)), function($carry, $item) use (&$init_dv1) {
        return $carry + ($item * $init_dv1--);
    }, 0);

    $sum_dv2 = array_reduce(str_split(substr($cpf, 0, 10)), function($carry, $item) use (&$init_dv2) {
        return $carry + ($item * $init_dv2--);
    }, 0);

    return ($sum_dv1 % 11 < 2 ? 0 : 11 - $sum_dv1 % 11) == substr($cpf, 9, 1) && ($sum_dv2 % 11 < 2 ? 0 : 11 - $sum_dv2 % 11) == substr($cpf, 10, 1);
}

/**
 * Check if data entry is a valid CNPJ Brazilian companies document
 * @version     1.0.0
 * @author      Anderson Arruda < andmarruda@gmail.com >
 * @param       string $cpf
 * @return      bool
 */
function checkCnpj(string $cnpj) : bool
{
    $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
    if(preg_match('/^(0{14}|1{14}|2{14}|3{14}|4{14}|5{14}|6{14}|7{14}|8{14}|9{14})$/',$cnpj))
        return false;

    $init_dv1 = 5;
    $init_dv2 = 6;

    $sum_dv1 = array_reduce(str_split(substr($cnpj, 0, 12)), function($carry, $item) use (&$init_dv1) {
        $init_dv1 = $init_dv1 == 1 ? 9 : $init_dv1;
        return $carry + ($item * $init_dv1--);
    }, 0);

    $sum_dv2 = array_reduce(str_split(substr($cnpj, 0, 13)), function($carry, $item) use (&$init_dv2) {
        $init_dv2 = $init_dv2 == 1 ? 9 : $init_dv2;
        return $carry + ($item * $init_dv2--);
    }, 0);

    return ($sum_dv1 % 11 < 2 ? 0 : 11 - $sum_dv1 % 11) == substr($cnpj, 12,1) && ($sum_dv2 % 11 < 2 ? 0 : 11 - $sum_dv2 % 11) == substr($cnpj, 13,1);
}

?>
