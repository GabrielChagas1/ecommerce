<?php   

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Category;
use \Hcode\Model\Provider;
use \Hcode\Model\Product;
use \Hcode\Model\Order;

//route para o admin
$app->get('/admin', function() {
   User::verifyLogin();
   $category = new Category();
   $providers = new Provider();
   $products = new Product();
   
   $orders = new Order();
	$page = new Hcode\PageAdmin();
	$page->setTpl("index", [
      "category" => $category->getTotals(),
      "providers" => $providers->getTotals(),
      "products" => $products->getTotals(),
      "orders" => $orders->getTotals(),
   ]);

});

//route para login
$app->get('/admin/login', function(){
   $page = new PageAdmin([
    "header" => false,
    "footer" => false
   ]);
   $page->setTpl("login");
});

$app->post('/admin/login', function(){
   User::login($_POST["login"], $_POST["password"]);
   header("Location: /admin");
   exit;
});

$app->get('/admin/logout', function() {
	User::logout();
	header("Location: /admin/login");
	exit;
});

?>