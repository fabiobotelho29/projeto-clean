<?php
ob_start();

require(__DIR__ . "/../vendor/autoload.php");
ini_set('xdebug.overload_var_dump', 1);
$user = (new \Source\Models\Users())->findById(2);
$data = new \Source\Models\UsersData();

/* REGISTER */
//$data->bootstrap(
//    $user->id,
//    "CPF",
//    "08792447716"
//);
//
//if (!$data->validate_register()){
//
//    var_dump($data->message());
//    die();
//}
//
//var_dump($data->save());
//var_dump($data->message());
//die();


/* UPDATE */
//$endereco = $address->findById(3);
//
//$endereco->status = 1;
//$endereco->city = 'Congonhas';
//
//if( ! $endereco->validate_update() ) {
//    var_dump($endereco->message());
//    die();
//}
//var_dump($endereco->save());
//var_dump($endereco->message());
//die();

/* USER */
$dados = $data->findById(1);

$usuario = $dados->user();
var_dump($usuario);
die();

