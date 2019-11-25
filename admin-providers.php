<?php

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Provider;

// routes para categorias
$app->get("/admin/providers", function(){
    User::verifyLogin();
    // var_dump('aqui');
    // exit;
	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	if ($search != '') {
		$pagination = Provider::getPageSearch($search, $page);
	} else {
		$pagination = Provider::getPage($page);
	}
	$pages = [];
	for ($x = 0; $x < $pagination['pages']; $x++)
	{
		array_push($pages, [
			'href'=>'/admin/providers?'.http_build_query([
				'page'=>$x+1,
				'search'=>$search
			]),
			'text'=>$x+1
		]);
	}
	$page = new PageAdmin();
	$page->setTpl("providers", [
		"providers"=>$pagination['data'],
		"search"=>$search,
		"pages"=>$pages
	]);	
});
 
 $app->get("/admin/providers/create", function(){
    User::verifyLogin();
    $page = new PageAdmin();
    $page->setTpl("providers-create");
 });
 
 //cadastrando categorias
 $app->post("/admin/providers/create", function(){
    User::verifyLogin();
    
    $providers = new Provider();
    $providers->setData($_POST);
    $providers->save();
    header("Location: /admin/providers");
    exit;
 });
 
 //deletar categorias
 $app->get("/admin/providers/:idprovider/delete", function($idprovider){
    User::verifyLogin();
    $providers = new Provider();
    $providers->get((int)$idprovider);
    $providers->delete();
    header('Location: /admin/providers');
    exit;
 });
 
 $app->get("/admin/providers/:idprovider", function($idprovider){
    User::verifyLogin();
    $providers = new Provider();
    $providers->get((int) $idprovider);
    $page = new PageAdmin();
    $page->setTpl("providers-update", array("providers" =>  $providers->getValues()));
 });
 
 $app->post("/admin/providers/:idprovider", function($idprovider){
    User::verifyLogin();
    $providers = new Provider();
    $providers->get((int) $idprovider);
    $providers->setData($_POST);
    $providers->save();
    header('Location: /admin/providers');
    exit;
 });


?>