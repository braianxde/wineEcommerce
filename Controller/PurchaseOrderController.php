<?php

namespace Controller;

require_once "Entity/PurchaseOrder.php";
require_once "Entity/ItemOrder.php";

use Common\dbWine;
use Doctrine\ORM\EntityManagerInterface;
use ItemOrder;
use PurchaseOrder;

class PurchaseOrderController {
    private $db;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->db = new dbWine();
        $this->entityManager = $entityManager;
    }

    public function getPurchaseOrders() {
        try {
            $purchaseOrders = $this->entityManager->getRepository(PurchaseOrder::class)->findAll();
            $results = [];

            if (empty($purchaseOrders)) {
                throw new \Exception("No purchase orders found");
            }

            foreach ($purchaseOrders as $purchaseOrder) {
                $results[] = [
                    'id' => $purchaseOrder->getId(),
                    'datetime' => $purchaseOrder->getDatetime(),
                    'number_items' => $purchaseOrder->getNumberItems(),
                    'amount_value' => $purchaseOrder->getAmountValue(),
                    'amount_weight' => $purchaseOrder->getAmountWeight(),
                    'distance' => $purchaseOrder->getDistance(),
                ];
            }

            return [
                "success" => true,
                "data" => $results
            ];

        } catch (\Exception $exception) {
            return [
                "success" => false,
                "msg" => $exception->getMessage()
            ];
        }
    }

    public function calculateAndInsertPurchaseOrder($purchaseOrder) {
        foreach ($purchaseOrder["items"] as $item) {
            $amountWeight = $item["weight"];
            $amountValue = $item["value"];
        }

        $shipping = $this->calculateShipping($amountWeight, $purchaseOrder["distance"]);
        $numberItems = count($purchaseOrder["items"]);

        if ($amountValue <= 0 && $amountWeight <= 0 && $numberItems <= 0 && $shipping <= 0) {
            throw new \Exception("Something goes wrong");
        }

        $idPurchaseOrder = $this->insertPurchaseOrderAndGetIdInsert($amountWeight, $amountValue, $shipping, $numberItems, $purchaseOrder["distance"]);

        $this->insertItemsOrder($idPurchaseOrder, $purchaseOrder["items"]);

    }

    public function insertItemsOrder($idPurchaseOrder, $items) {
        foreach ($items as $item) {
            $itemOrder = new ItemOrder();
            $itemOrder->setWeight($item["weight"]);
            $itemOrder->setValue($item["value"]);
            $itemOrder->setIdProduct($item["id"]);
            $itemOrder->setIdPurchase($idPurchaseOrder);

            $this->entityManager->persist($itemOrder);
            $this->entityManager->flush();
        }
    }

    public function insertPurchaseOrderAndGetIdInsert($amountWeight, $amountValue, $shipping, $numberItems, $distance) {
        $datetimeNow = date("Y-m-d h:i:s");

        $purchaseOrder = new PurchaseOrder();
        $purchaseOrder->setAmountValue($amountValue);
        $purchaseOrder->setAmountWeight($amountWeight);
        $purchaseOrder->setDatetime($datetimeNow);
        $purchaseOrder->setDistance($distance);
        $purchaseOrder->setNumberItems($numberItems);

        $this->entityManager->persist($purchaseOrder);
        $this->entityManager->flush();

        return $purchaseOrder->getId();
    }

    public function calculateShipping($amountWeight, $distance) {
        $valueShipping = $amountWeight * 5;

        if ($distance <= 100) {
            return $valueShipping;
        }

        return ($valueShipping * $distance) / 100;
    }

    public function getPurchaseOrderById($id) {
        try {
            $purchaseOrder = $this->entityManager->find('PurchaseOrder', $id);

            if (empty($purchaseOrder)) {
                throw new \Exception("No purchase order found");
            }

            $result[] = [
                'id' => $purchaseOrder->getId(),
                'datetime' => $purchaseOrder->getDatetime(),
                'number_items' => $purchaseOrder->getNumberItems(),
                'amount_value' => $purchaseOrder->getAmountValue(),
                'amount_weight' => $purchaseOrder->getAmountWeight(),
                'distance' => $purchaseOrder->getDistance()
            ];

            return [
                "success" => true,
                "data" => $result
            ];

        } catch (\Exception $exception) {
            return [
                "success" => false,
                "msg" => $exception->getMessage()
            ];
        }
    }
}