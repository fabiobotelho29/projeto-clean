<?php
ob_start();

require(__DIR__ . "/../vendor/autoload.php");
ini_set('xdebug.overload_var_dump', 1);
$category = new \Source\Models\Categories();
/* REGISTER */
//$category->bootstrap(
//    "Camisetas"
//);
//if (!$category->validate_register()){
//
//    var_dump($category->message());
//    die();
//}
//
//var_dump($category->save());
//var_dump($category->message());
//die();

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

