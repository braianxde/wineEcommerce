<?php
namespace Common;
require_once "Controller/ProductController.php";
require_once "Controller/PurchaseOrderController.php";

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

$klein->respond('GET', '/purchase-order/[i:id]', function ($request) {
    return (new Controller\PurchaseOrderController())->getPurchaseOrderById($request->id);
});

$klein->respond('GET', '/purchase-order', function () {
    return (new Controller\PurchaseOrderController())->getPurchaseOrders();
});

$klein->respond('POST', '/purchase-order', function ($request) {
    return (new Controller\PurchaseOrderController())->calculateAndInsertPurchaseOrder(json_decode($request->body(), true));
});

$klein->dispatch();