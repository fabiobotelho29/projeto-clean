<?php
ob_start();

require(__DIR__ . "/../vendor/autoload.php");
ini_set('xdebug.overload_var_dump', 1);
$product = new \Source\Models\Products();
/* REGISTER */
$product->bootstrap(
    1,
    "Camiseta",
    "Camiseta Gola Polo",
        "8.5",
    "DSA36",
    "DSA362134564",
);
if (!$product->validate_register()){

    var_dump($product->message());
    die();
}

var_dump($product->save());
var_dump($product->message());
die();

/* UPDATE */
//$category = $category->findByCode('a669f05266');
//$category->name = "Camisetas Novas";
//var_dump($category);
//if( ! $category->validate_update() ) {
//    var_dump($category->message());
//    die();
//}
//var_dump($category->save());
//var_dump($category->message());
//die();

/** ADDRESSES */
//$user = (new \Source\Models\Users())->findById(2);
//$addresses = $user->userData();
//
//var_dump($addresses);

