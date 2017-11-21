<?php

$method = $_SERVER['REQUEST_METHOD'];
$array = [];
parse_str($_SERVER['QUERY_STRING'], $array);
// skaber forbindelse til databasen (porten er i mit tilfælde lavet om til 3305 da jeg bruger port 3306 til en anden)
$link = mysqli_connect('localhost', 'root', '123456', 'world', 3305);
mysqli_set_charset($link,'utf8');
// If sætningen er til at løbe arrayet igennem og se om 'name' er der
if($method == 'GET' && array_key_exists('name', $array)){
    $sql = "select * from country WHERE Name = " . $array['name'];
    $result = mysqli_query($link,$sql);
    // er 'name' der udskriver den informationen fra databasen
    if (!$result) {
        http_response_code(404);
        die(mysqli_error());
    }
    echo json_encode($result->fetch_assoc());
}else{
    //ellers udskriver den at 'name' ikke eksisterer
    echo "The name doesn't exits!";
}
mysqli_close($link);
exit;