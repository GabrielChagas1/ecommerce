<?php

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Product;


// Routes para os produtos
$app->get("/admin/products", function(){
    User::verifyLogin();
    $products = Product::ListAll();
    $page = new PageAdmin();
    $page->setTpl("products", array("products" =>  $products)); 
});

$app->get("/admin/products/:idproduct/delete", function($idproduct){
    User::verifyLogin();
    $product = new Product();
    $product->get((int)$idproduct);
    $product->delete();
    header("Location: /admin/products");
    exit;
    });

$app->get("/admin/products/create", function(){
    User::verifyLogin();
    $page = new PageAdmin();
    $page->setTpl("products-create"); 
});

$app->post("/admin/products/create", function(){
	User::verifyLogin();
	$product = new Product();
    $product->setData($_POST);
	$product->save();
	header("Location: /admin/products");
	exit;
});
$app->get("/admin/products/:idproducts", function($idproducts){
    User::verifyLogin();
    $product = new Product();
    $product->get((int)$idproducts);
    $page = new PageAdmin();
    $page->setTpl("products-update", array("product" => $product->getValues())); 
});

$app->post("/admin/products/:idproduct", function($idproduct){
	User::verifyLogin();
	$product = new Product();
    $product->get((int)$idproduct);
    $product->setData($_POST);
    $product->save();

    //verifica se tem upload de uma foto
    if(isset($_POST["file"])){
        $product->setPhoto($_FILES["file"]);
    }

    header('Location: /admin/products');
    exit;
});

?>