<?php
ob_start();

require(__DIR__ . "/../vendor/autoload.php");
ini_set('xdebug.overload_var_dump', 1);
$user = (new \Source\Models\Users())->findById(9);
$address_id = $user->userActiveAddresses($user->id)->id;
$order = new \Source\Models\Orders();
$dimona = [
    'order_id' => '321321321',
    'id' => '321-WER-987-FRT',
];

/* REGISTER */
//$order->bootstrap(
//    $user->id,
//    "{$user->name}",
//    "sedex",
//    "{$dimona['order_id']}",
//    "{$dimona['id']}",
//    "{$address_id}"
//);
//
//if (!$order->validate_register()){
//
//    var_dump($order->message());
//    die();
//}
//
//var_dump($order->save());
//var_dump($order->message());
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
$pedido = $order->findById(1);

$usuario = $pedido->user();
var_dump($pedido, $usuario);
die();

