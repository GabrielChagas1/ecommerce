<?php

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Product;
use \Hcode\Model\Provider;


// Routes para os produtos
$app->get("/admin/products", function(){
	User::verifyLogin();
	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	if ($search != '') {
		$pagination = Product::getPageSearch($search, $page);
	} else {
		$pagination = Product::getPage($page);
	}
	$pages = [];
	for ($x = 0; $x < $pagination['pages']; $x++)
	{
		array_push($pages, [
			'href'=>'/admin/products?'.http_build_query([
				'page'=>$x+1,
				'search'=>$search
			]),
			'text'=>$x+1
		]);
	}
	$products = Product::listAll();
	$page = new PageAdmin();
	$page->setTpl("products", [
		"products"=>$pagination['data'],
		"search"=>$search,
		"pages"=>$pages
	]);
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
	$providers = new Provider();
	$list = $providers->ListAll();
    $page = new PageAdmin();
    $page->setTpl("products-create", [
		"providers" => $list
	]); 
});

$app->post("/admin/products/create", function(){
	User::verifyLogin();
	$product = new Product();
    $product->setData($_POST);
	$product->save();
	//verifica se tem upload de uma foto
    if($_FILES["file"]["size"] > 0){
        $product->setPhoto($_FILES["file"]);
    }
	header("Location: /admin/products");
	exit;
});
$app->get("/admin/products/:idproducts", function($idproducts){
	User::verifyLogin();
	$providers = new Provider();
	$list = $providers->ListAll();
    $product = new Product();
    $product->get((int)$idproducts);
    $page = new PageAdmin();
    $page->setTpl("products-update", array(
		"product" => $product->getValues(), 
		"providers" => $list
	)); 
});

$app->post("/admin/products/:idproduct", function($idproduct){
	User::verifyLogin();
	$product = new Product();
    $product->get((int)$idproduct);
	$product->setData($_POST);
	$product->save();
    //verifica se tem upload de uma foto
    if($_FILES["file"]["size"] > 0){
        $product->setPhoto($_FILES["file"]);
    }

    header('Location: /admin/products');
    exit;
});

?>