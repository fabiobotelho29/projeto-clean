<?php
ob_start();

require(__DIR__ . "/../vendor/autoload.php");
ini_set('xdebug.overload_var_dump', 1);
$user = new \Source\Models\Users();
/* REGISTER */
$user->bootstrap(
    "Fabio Botelho",
    "fabio2@gmail.com",
    "12345678"
);
if (!$user->validate_register()){

    var_dump($user->message());
    die();
}

var_dump($user->save());
var_dump($user->message());
die();
/* UPDATE */
//$usuario = $user->findByCode('a0dc0feb6a');
//$usuario->email = 'brenda@gmail.com';
//var_dump($usuario);
//if( ! $usuario->validate_update() ) {
//    var_dump($usuario->message());
//    die();
//}
//var_dump($usuario->save());
//var_dump($usuario->message());
//die();

/** ADDRESSES */
//$user = (new \Source\Models\Users())->findById(2);
//$addresses = $user->userData();
//
//var_dump($addresses);

