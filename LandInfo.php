<?php

$method = $_SERVER['REQUEST_METHOD'];
$array = [];
parse_str($_SERVER['QUERY_STRING'], $array);

$link = mysqli_connect('localhost', 'root', '123456', 'world', 3305);
mysqli_set_charset($link,'utf8');

if($method == 'GET' && array_key_exists('name', $array)){
    $sql = "select * from country WHERE Name = " . $array['name'];
    $result = mysqli_query($link,$sql);
    if (!$result) {
        http_response_code(404);
        die(mysqli_error());
    }
    echo json_encode($result->fetch_assoc());
}else{
    echo "The name doesn't exits!";
}
mysqli_close($link);
exit;