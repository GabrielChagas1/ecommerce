<?php 

require_once("vendor/autoload.php");

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {
    $data = date('d/m/Y');
	echo "data atual {$data}";

});

$app->run();

 ?>