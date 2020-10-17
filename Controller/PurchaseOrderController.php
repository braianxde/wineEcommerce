<?php

namespace Controller;
use Common\dbWine;

class PurchaseOrderController {
    private $db;

    public function __construct() {
        $this->db = new dbWine();
    }

    public function getPurchaseOrders() {
        try {
            $sql = "SELECT * FROM purchase_order";
            $purchase_orders = $this->db->query($sql)->fetchArray(SQLITE3_ASSOC);
            $this->db->close();

            return json_encode(
                [
                    "status" => true,
                    "purchase_order" => $purchase_orders
                ]
            );

        } catch (\Exception $exception) {

            return json_encode(
                [
                    "status" => false,
                    "msg" => $exception->getMessage()
                ]
            );
        }
    }

    public function calculateAndInsertPurchaseOrder($purchaseOrder) {
        try {

            foreach($purchaseOrder["items"] as $item){
                $amountWeight = $item["weight"];
                $amountValue = $item["value"];
            }

            $shipping = $this->calculateShipping($amountWeight, $purchaseOrder["distance"]);
            $numberItems = count($purchaseOrder["items"]);

            if($amountValue <= 0 && $amountWeight <= 0 && $numberItems <= 0 && $shipping <= 0){
                throw new \Exception("Something goes wrong");
            }

            $idPurchaseOrder = $this->insertPurchaseOrderAndGetIdInsert($amountWeight, $amountValue, $shipping, $numberItems, $purchaseOrder["distance"]);

            $this->insertItemsOrder($idPurchaseOrder, $purchaseOrder["items"]);

            return json_encode(
                [
                    "status" => true
                ]
            );

        } catch (\Exception $exception) {

            return json_encode(
                [
                    "status" => false,
                    "msg" => $exception->getMessage()
                ]
            );
        }
    }

    public function insertItemsOrder($idPurchaseOrder, $items){
        foreach($items as $item){
            $sql = "INSERT INTO item_order (
                    'id_product',
                    'id_purchase',
                    'value',
                    'weight'
                ) VALUES (
                    '{$item["id"]}',
                    '{$idPurchaseOrder}',
                    '{$item["value"]}',
                    '{$item["weight"]}'
                );";

            $this->db->exec($sql);
        }

        $this->db->close();
    }

    public function insertPurchaseOrderAndGetIdInsert($amountWeight, $amountValue, $shipping, $numberItems, $distance){
        $datetimeNow = date("Y-m-d h:i:s");

        $sql = "INSERT INTO purchase_order (
                    'datetime',
                    'number_items',
                    'amount_value',
                    'amount_weight',
                    'shipping_cost',
                    'distance'
                ) VALUES (
                    '{$datetimeNow}',
                    '{$numberItems}',
                    '{$amountValue}',
                    '{$amountWeight}',
                    '{$shipping}',
                    '{$distance}'
                );";

        $this->db->exec($sql);
        $idPurchaseOrder = $this->db->lastInsertRowID();

        return $idPurchaseOrder;
    }

    public function calculateShipping($amountWeight, $distance){
        $valueShipping = $amountWeight * 5;

        if($distance <= 100){
            return $valueShipping;
        }

        return ($valueShipping * $distance) / 100;
    }

    public function getPurchaseOrderById($id) {
        try {
            $sql = "SELECT * FROM purchase_order WHERE id = {$id}";

            $products = $this->db->query($sql)->fetchArray(SQLITE3_ASSOC);
            $this->db->close();

            return json_encode(
                [
                    "status" => true,
                    "purchase_order" => $products
                ]
            );
        } catch (\Exception $exception) {

            return json_encode(
                [
                    "status" => false,
                    "msg" => $exception->getMessage()
                ]
            );
        }
    }
}