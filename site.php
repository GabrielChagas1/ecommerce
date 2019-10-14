<?php

use \Hcode\PageAdmin;
use \Hcode\Page;
use \Hcode\Model\Product;

//route para o site
$app->get('/', function() {

    $products = Product::listAll();
    $page = new Page();
    $page->setTpl("index", ['products' => Product::checkList($products)]);
});

?>