<?php
ob_start();

require(__DIR__ . "/../vendor/autoload.php");
ini_set('xdebug.overload_var_dump', 1);
$user = (new \Source\Models\Users())->findById(9);
$address = new \Source\Models\UsersAddresses();

/* REGISTER */
$address->bootstrap(
    $user->id,
    "23587-460",
    "Rua das Empadas",
    "100",
    "Rio de Janeiro",
    "RJ",
    "Campo Grande",
    ""
);


if (!$address->validate_register()){

    var_dump($address->message());
    die();
}

var_dump($address->save());
var_dump($address->message());
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

