<?php
namespace Controller;
use Common\dbWine;

class ProductController {
    private $db;

    public function __construct() {
        $this->db = new dbWine();
    }

    public function getProducts(){
        try {
            $products = [];
            $sql = "SELECT * FROM product";
            $ret = $this->db->query($sql);

            while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
                $products[] = $row;
            }

            $this->db->close();

            return json_encode(
                [
                    "success" => true,
                    "products" => $products
                ]
            );

        } catch (\Exception $exception){

            $this->db->close();

            return json_encode(
                [
                    "success" => false,
                    "msg" => $exception->getMessage()
                ]
            );
        }
    }

    public function insertProduct($newProduct){
        try {
            $sql = "INSERT INTO product (
                    'description',
                    'name',
                    'value',
                    'img',
                    'weight',
                    'order'
                ) VALUES (
                    '{$newProduct["description"]}',
                    '{$newProduct["name"]}',
                    '{$newProduct["value"]}',
                    '{$newProduct["img"]}',
                    '{$newProduct["weight"]}',
                    '{$newProduct["order"]}'
                );";

            $this->db->exec($sql);
            $this->db->close();

            return json_encode(
                [
                    "success" => true
                ]
            );

        } catch (\Exception $exception){
            $this->db->close();

            return json_encode(
                [
                    "success" => false,
                    "msg" => $exception->getMessage()
                ]
            );
        }
    }

    public function getProductById($id){
        try {
            $sql = "SELECT * FROM product WHERE id = {$id}";
            $products = $this->db->query($sql)->fetchArray(SQLITE3_ASSOC);
            $this->db->close();


            if($products){
                return json_encode(
                    [
                        "success" => true,
                        "products" => $products
                    ]
                );
            }

            return json_encode(
                [
                    "success" => false,
                ]
            );

        } catch (\Exception $exception){
            $this->db->close();

            return json_encode(
                [
                    "success" => false,
                    "msg" => $exception->getMessage()
                ]
            );
        }
    }
}