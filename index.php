<?php 

session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use\Hcode\Model\User;

$app = new Slim();

$app->config('debug', true);

//route para o site
$app->get('/', function() {
   $page = new Page();
   $page->setTpl("index");
});

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

// routes de usuários
$app->get("/admin/users", function(){
   //verificar se a pessoa está logada
   User::verifyLogin();

   //listar todos os usuários
   $users = User::ListAll();

   //retorna com a página
   $page = new PageAdmin();
   
   //enviando os usuários
   $page->setTpl("users", array("users" =>  $users));

});

$app->get("/admin/users/:iduser/delete", function($iduser){
   User::verifyLogin();
   
});

$app->get("/admin/users/create", function(){
   User::verifyLogin();

   $page = new PageAdmin();
   $page->setTpl("users-create");
   
});

$app->get("/admin/users/:iduser", function($iduser){
   User::verifyLogin();

   $page = new PageAdmin();
   $page->setTpl("users-update");
   
});

$app->post("/admin/users/create", function(){
   User::verifyLogin();
   var_dump($_POST);

   $user = new User();

   $_POST["inadmin"] = (isset($_POST["inadmin"])) ? 1 : 0;

   $user->setData($_POST);
   
   $user->save();
   header("Location: /admin/users");
   exit;

});

$app->post("/admin/users/:iduser", function($iduser){
   User::verifyLogin();
   
});

//fim routes de usuários

$app->run();

?>