<?php namespace App;

use Barcode;


class i4Barcodes {

function ean13_checkdigit($digits){
    //first change digits to a string so that we can access individual numbers
    $digits =(string)$digits;
    // 1. Add the values of the digits in the even-numbered positions: 2, 4, 6, etc.
    $even_sum = $digits{1} + $digits{3} + $digits{5} + $digits{7} + $digits{9} + $digits{11};
    // 2. Multiply this result by 3.
    $even_sum_three = $even_sum * 3;
    // 3. Add the values of the digits in the odd-numbered positions: 1, 3, 5, etc.
    $odd_sum = $digits{0} + $digits{2} + $digits{4} + $digits{6} + $digits{8} + $digits{10};
    // 4. Sum the results of steps 2 and 3.
    $total_sum = $even_sum_three + $odd_sum;
    // 5. The check character is the smallest number which, when added to the result in step 4,  produces a multiple of 10.
    $next_ten = (ceil($total_sum/10))*10;
    $check_digit = $next_ten - $total_sum;
    return $digits . $check_digit;
}

function upc_checkdigit($upc_code){
    $odd_total  = 0;
    $even_total = 0;
 
    for($i=0; $i<11; $i++)
    {
        if((($i+1)%2) == 0) {
            /* Sum even digits */
            $even_total += $upc_code[$i];
        } else {
            /* Sum odd digits */
            $odd_total += $upc_code[$i];
        }
    }
 
    $sum = (3 * $odd_total) + $even_total;
 
    /* Get the remainder MOD 10*/
    $check_digit = $sum % 10;
 
    /* If the result is not zero, subtract the result from ten. */
    return ($check_digit > 0) ? 10 - $check_digit : $check_digit;
}

function itf_checkdigit($code){
  var i, 
  toPart1 = code.length % 2;
  var n1 = 0, sum = 0;
  for(i=0; i<code.length; i++){
    if (toPart1) {
      n1 = 10 * n1 + Barcode.intval(code.charAt(i));
    } else {
      sum += Barcode.intval(code.charAt(i));
    }
    toPart1 = ! toPart1;
  }
  var s1 = (2 * n1).toString();
  for(i=0; i<s1.length; i++){
    sum += Barcode.intval(s1.charAt(i));
  }
  return(code + ((10 - sum % 10) % 10).toString());
}

}
