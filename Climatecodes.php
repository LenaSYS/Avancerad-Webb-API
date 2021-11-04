<?php
header('Content-Type: application/json; charset=utf-8');

// Takes raw data from the request and make php object
$data = json_decode(file_get_contents('php://input'));
$ort="Grums";

$output=Array();

$pdo= new PDO('sqlite:weather.db');
$querystring='SELECT * FROM climatecodes';
$stmt = $pdo->prepare($querystring);
$stmt->execute();

$outputlst=Array();

// Format sql data as json
foreach($stmt as $key => $row){
  $output=Array();
  foreach($row as $akey => $attr){
    if($attr[0]=="{"){
          $attr=json_decode($attr);
          $output[$akey]=$attr;
    }else{
        if(!is_int($akey)) $output[$akey]=$attr;
    }
  }
  array_push($outputlst,$output);
}

$JSONoutput = json_encode($outputlst);
echo $JSONoutput;
?>