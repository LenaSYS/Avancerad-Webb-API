<?php
header('Content-Type: application/json; charset=utf-8');

// Takes raw data from the request and make php object
$data = json_decode(file_get_contents('php://input'));

if($data->vehicle=="Car"){
    $output=Array("Car A","Car B");
}else{
    $output=Array("Bicycle A","Boat A");
}

$JSONoutput = json_encode($output);
echo $JSONoutput;
?>