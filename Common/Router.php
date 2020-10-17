<?php
namespace Common;
require_once "Controller/ProductController.php";
require_once "Controller/PedidoController.php";

use Controller;
use Klein\Klein;

$klein = new Klein();

$klein->respond('GET', '/products', function () {
    return (new Controller\ProductController())->getProducts();
});

$klein->respond('GET', '/product/[i:id]', function ($request) {
    return (new Controller\ProductController())->getProductById($request->id);
});

$klein->respond('POST', '/product', function ($request) {
    return (new Controller\ProductController())->insertProduct(json_decode($request->body(), true));
});

$klein->dispatch();