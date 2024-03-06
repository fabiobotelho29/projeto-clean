<?php
ob_start();

require(__DIR__ . "/../vendor/autoload.php");
ini_set('xdebug.overload_var_dump', 1);
$banner = new \Source\Models\Banners();
/* REGISTER */
//$banner->bootstrap(
//    "assets/test.png",
//    "MEnsagem",
//    "Cuide-se",
//    "DEscrição do Banner",
//    "<a>Teste</a>"
//);
//if (!$banner->validate_register()){
//
//    var_dump($banner->message());
//    die();
//}
//
//var_dump($banner->save());
//var_dump($banner->message());
//die();
/* UPDATE */
$banner = $banner->findByCode('4aa3fc8f86');
$banner->title = "Meu título alterado";
var_dump($banner);
if( ! $banner->validate_update() ) {
    var_dump($banner->message());
    die();
}
var_dump($banner->save());
var_dump($banner->message());
die();

/** ADDRESSES */
//$user = (new \Source\Models\Users())->findById(2);
//$addresses = $user->userData();
//
//var_dump($addresses);

