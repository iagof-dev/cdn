<?php


$db_name = "arthur_miaudote";

$con = new PDO("mysql:host=localhost;dbname=" . $db_name, 'root', '');
$con->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

if(!isset($_FILES['upload'])){
    echo(json_encode(['status' => 'erro', 'mensagem' => 'Imagem não enviada na requisição.']));
    die();
}


$received_file = $_FILES['upload'];


$directory = __DIR__ . '/uploads/';

if(!is_dir($directory)){
    mkdir($directory);
}

$ext_file = pathinfo($received_file['name'], PATHINFO_EXTENSION);


//  FILE_8yasd89fyas879f.png
$uniq_name = uniqid('file_') . '.' . $ext_file;
$final_path = $directory . $uniq_name;

if(move_uploaded_file($received_file['tmp_name'], $final_path)){
    $smt = $con->prepare("INSERT INTO imagens VALUES (default, '". $uniq_name ."')");
    $smt->execute();
    echo(json_encode(['status'=>'sucesso', 'arquivo' => 'https://marciossupiais.shop/arthur_miaudote/uploads/' . $uniq_name]));
}
else{
    echo(json_encode(['status'=>'erro']));
}
