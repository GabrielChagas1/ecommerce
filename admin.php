<?php   

use \Hcode\PageAdmin;
use \Hcode\Model\User;

//route para o admin
$app->get('/admin', function() {
	User::verifyLogin();
	$page = new Hcode\PageAdmin();
	$page->setTpl("index");

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