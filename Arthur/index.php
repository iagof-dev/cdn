<?php


$received_file = $_FILES['upload'];


$directory = __DIR__ . '/uploads/';

if(!is_dir($directory)){
    mkdir($directory);
}

$ext_file = pathinfo($received_file['name'], PATHINFO_EXTENSION);

$uniq_name = uniqid('file_') . '.' . $ext_file;

$final_path = $directory . $uniq_name;

if(move_uploaded_file($received_file['tmp_name'], $final_path)){
    echo 'Arquivo enviado com sucesso';
}
else{
    echo 'Error tentando enviar arquivo';
}