<?php

namespace Controller;
use Common\dbWine;

class PedidoController {
    private $db;

    public function __construct() {
        $this->db = new dbWine();
    }

    public function getProducts() {
        try {
            $sql = "SELECT * FROM product";
            $products = $this->db->query($sql)->fetchArray(SQLITE3_ASSOC);
            $this->db->close();

            return json_encode(
                [
                    "status" => true,
                    "products" => $products
                ]
            );

        } catch (Exception $exception) {

            return json_encode(
                [
                    "status" => false,
                    "msg" => $exception->getMessage()
                ]
            );
        }
    }

    public function insertProduct($description, $name, $value, $img, $weight, $order) {
        try {
            $sql = "INSERT INTO product (
                    description,
                    name,
                    value,
                    img,
                    weight,
                    order
                ) VALUES (
                    '{$description}',
                    '{$name}',
                     {$value},
                    '{$img}',
                     {$weight},
                     {$order}
                )";

            $this->db->exec($sql);
            $this->db->close();

            return json_encode(
                [
                    "status" => true
                ]
            );

        } catch (Exception $exception) {

            return json_encode(
                [
                    "status" => false,
                    "msg" => $exception->getMessage()
                ]
            );
        }
    }

    public function getProductById($id) {
        $sql = "SELECT * FROM product WHERE id = {$id}";

        $products = $this->db->query($sql)->fetchArray(SQLITE3_ASSOC);
        $this->db->close();

        return json_encode($products);
    }
}