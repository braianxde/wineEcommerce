<?php

namespace Controller;
require_once 'bootstrap.php';
require_once "Entity/Product.php";

use Common\dbWine;
use Doctrine\ORM\EntityManagerInterface;
use Product;

class ProductController {
    private $db;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->db = new dbWine();
        $this->entityManager = $entityManager;
    }

    public function getProducts() {
        try {
            $products = $this->entityManager->getRepository(Product::class)->findAll();
            $results = [];

            if (empty($products)) {
                throw new \Exception("No products found");
            }

            foreach ($products as $product) {
                $results[] = [
                    'id' => $product->getId(),
                    'name' => $product->getName(),
                    'value' => $product->getValue(),
                    'description' => $product->getDescription(),
                    'weight' => $product->getWeight(),
                    'ordination' => $product->getOrdination(),
                ];
            }

            return [
                "success" => true,
                "data" => $results
            ];

        } catch (\Exception $exception){
            return [
                "success" => false,
                "msg" => $exception->getMessage()
            ];
        }
    }

    public function insertProduct($newProduct) {
        try {
            $product = new Product();
            $product->setName($newProduct["name"]);
            $product->setDescription($newProduct["description"]);
            $product->setImg($newProduct["img"]);
            $product->setOrdination($newProduct["ordination"]);
            $product->setValue($newProduct["value"]);
            $product->setWeight($newProduct["weight"]);

            $this->entityManager->persist($product);
            $this->entityManager->flush();

            return [
                "success" => true
            ];
        } catch (\Exception $exception){
            return [
                "success" => false,
                "msg" => $exception->getMessage()
            ];
        }
    }

    public function getProductById($id) {
        try {
            $product = $this->entityManager->find('Product', $id);

            if (empty($product)) {
                throw new \Exception("No product found");
            }

            $result[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'value' => $product->getValue(),
                'description' => $product->getDescription(),
                'weight' => $product->getWeight(),
                'ordination' => $product->getOrdination(),
            ];

            return $result;

        } catch (\Exception $exception){
            return [
                "success" => false,
                "msg" => $exception->getMessage()
            ];
        }
    }
}