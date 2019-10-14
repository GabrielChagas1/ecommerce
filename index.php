<?php 

session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use\Hcode\Model\User;
use\Hcode\Model\Category;

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
   User::verifyLogin();
   $users = User::ListAll();
   $page = new PageAdmin();
   $page->setTpl("users", array("users" =>  $users));

});

$app->get("/admin/users/:iduser/delete", function($iduser){
   User::verifyLogin();
   $user = new User();
   $user->get((int)$iduser);
   $user->delete();
   header("Location: /admin/users");
   exit;
});

$app->get("/admin/users/create", function(){
   User::verifyLogin();
   $page = new PageAdmin();
   $page->setTpl("users-create");
   
});

$app->get("/admin/users/:iduser", function($iduser){
   User::verifyLogin();
   $user = new User();
   $user->get((int)$iduser);
   $page = new PageAdmin();
   $page->setTpl("users-update", array("user" => $user->getValues()
   ));
});

//cadastrando usuário
$app->post("/admin/users/create", function(){
   User::verifyLogin();
   $user = new User();
   $_POST["inadmin"] = (isset($_POST["inadmin"])) ? 1 : 0;
   $user->setData($_POST);
   $user->save();
   header("Location: /admin/users");
   exit;
});

//editando usuário
$app->post("/admin/users/:iduser", function($iduser){
   User::verifyLogin();
   $user = new User();
   $user->get((int)$iduser);
   $_POST["inadim"] = (isset($_POST["inadmin"])) ? 1 : 0;
   $user->setData($_POST);
   $user->update();
   header("Location: /admin/users");
   exit;
});
//fim routes de usuários

// routes para categorias
$app->get("/admin/categories", function(){
   User::verifyLogin();
   $categories = Category::ListAll();
   $page = new PageAdmin();
   $page->setTpl("categories", array("categories" =>  $categories));

});

$app->get("/admin/categories/create", function(){
   User::verifyLogin();
   $page = new PageAdmin();
   $page->setTpl("categories-create");
});

//cadastrando categorias
$app->post("/admin/categories/create", function(){
   User::verifyLogin();
   $categories = new Category();
   $categories->setData($_POST);
   $categories->save();
   header("Location: /admin/categories");
   exit;
});

//deletar categorias
$app->get("/admin/categories/:idcategory/delete", function($idcategory){
   User::verifyLogin();
   $category = new Category();
   $category->get((int)$idcategory);
   $category->delete();
   header('Location: /admin/categories');
   exit;
});

$app->get("/admin/categories/:idcategory", function($idcategory){
   User::verifyLogin();
   $category = new Category();
   $category->get((int) $idcategory);
   $page = new PageAdmin();
   $page->setTpl("categories-update", array("category" =>  $category->getValues()));
});

$app->post("/admin/categories/:idcategory", function($idcategory){
   User::verifyLogin();
   $category = new Category();
   $category->get((int) $idcategory);
   $category->setData($_POST);
   $category->save();
   header('Location: /admin/categories');
   exit;
});

$app->get('/categories/:idcategory', function($idcategory) {
   User::verifyLogin();
   $category = new Category();
   $category->get((int)$idcategory);



	$page = new Page();
	$page->setTpl("category", [
      'category' => $category->getValues(),
      'products' => [],
   ]);

});


$app->run();

?>