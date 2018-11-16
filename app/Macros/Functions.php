<?php

/*
 * Phone
 */
function pre($expression, bool $json = true, bool $stop = true)
{
	echo '<pre>';
	if($json)
		echo print_r($expression); 
	else
		var_dump($expression);
	if($stop)
		die();
}

function assets($file = null)
{
	return url('/') . "/resources/assets/{$file}";
}

function dateBdToApp($date){
  $old = new Datetime($date);
  return $old->format('d/m/Y');
}

function dateToApp($date){
  if( $date ){
    $old = new Datetime($date);
    return $old->format('Y-m-d');
  }else{
    return null;
  }
}

function dateTimeBdToApp($date){
  $old = new Datetime($date);
  return $old->format('d/m/Y H:i:s');
}

function currencyToBd($str){
  $s =  preg_replace('/[^0-9,]/','',$str);
  return preg_replace('/[,]/','.',$s);
}

function currencyToApp($curr){
  return 'R$ '.number_format($curr, 2, ',','.');
}

function currencyToAppOnlyNumbers($curr){
  return number_format($curr, 2, ',','.');
}

function makeStatusFront($status){
  switch ($status){
    case '0':
      return 'Indisponível';
      break;
    case '1':
      return 'Disponível';
      break;
    case '2': 
      return 'Reservada';
      break;
  }
}

function break_text($text, $limit) {
  if (strlen($text) > $limit) {
      $pos = strpos($text, ' ', $limit);
      return substr($text, 0, $pos) . '...';
  } else {
      return $text;
  }
}

function limpaNumeros($n){
  return preg_replace("/[^0-9]/", "",$n);
}