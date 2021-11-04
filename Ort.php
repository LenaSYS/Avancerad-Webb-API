<?php
header('Content-Type: application/json; charset=utf-8');

// Takes raw data from the request and make php object
$data = json_decode(file_get_contents('php://input'));
$ort="Grums";

$output=Array();

$pdo= new PDO('sqlite:weather.db');
$querystring='SELECT * FROM info where name=:name';
$stmt = $pdo->prepare($querystring);
$stmt->bindParam(':name', $ort);
$stmt->execute();
             
foreach($stmt as $key => $row){
  foreach($row as $akey => $attr){
    if($attr[0]=="{"){
          $attr=json_decode($attr);
          $output[$akey]=$attr;
    }else{
        if(!is_int($akey)) $output[$akey]=$attr;
    }
  }
}

$JSONoutput = json_encode($output);
echo $JSONoutput;
?>