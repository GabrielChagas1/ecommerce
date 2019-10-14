<?php

use \Hcode\PageAdmin;
use \Hcode\Page;

//route para o site
$app->get('/', function() {
    $page = new Page();
    $page->setTpl("index");
});

?>