<?php

namespace Common;
require_once "Controller/ProductController.php";
require_once "bootstrap.php";
require_once "Controller/PurchaseOrderController.php";

use Controller;
use Klein\Klein;


$klein = new Klein();

$klein->respond('GET', '/products', function () use ($entityManager) {
    return json_encode((new Controller\ProductController($entityManager))->getProducts());
});

$klein->respond('GET', '/product/[i:id]', function ($request) use ($entityManager) {
    return json_encode((new Controller\ProductController($entityManager))->getProductById($request->id));
});

$klein->respond('POST', '/product', function ($request) use ($entityManager) {
    return json_encode((new Controller\ProductController($entityManager))->insertProduct(json_decode($request->body(), true)));
});

$klein->respond('GET', '/purchase-order/[i:id]', function ($request) use ($entityManager) {
    return json_encode((new Controller\PurchaseOrderController($entityManager))->getPurchaseOrderById($request->id));
});

$klein->respond('GET', '/purchase-order', function () use ($entityManager) {
    return json_encode((new Controller\PurchaseOrderController($entityManager))->getPurchaseOrders());
});

$klein->respond('POST', '/purchase-order', function ($request) use ($entityManager) {
    return json_encode((new Controller\PurchaseOrderController($entityManager))->calculateAndInsertPurchaseOrder(json_decode($request->body(), true)));
});

$klein->dispatch();