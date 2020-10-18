<?php
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="item_order")
 */
class ItemOrder {
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /**
     * @ORM\Column(name="id_product", type="integer")
     */
    protected $id_product;
    /**
     * @ORM\Column(name="id_purchase", type="integer")
     */
    protected $id_purchase;
    /**
     * @ORM\Column(name="value", type="float")
     */
    protected $value;
    /**
     * @ORM\Column(name="weight", type="float")
     */
    protected $weight;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getIdProduct() {
        return $this->id_product;
    }

    /**
     * @param mixed $id_product
     */
    public function setIdProduct($id_product) {
        $this->id_product = $id_product;
    }

    /**
     * @return mixed
     */
    public function getIdPurchase() {
        return $this->id_purchase;
    }

    /**
     * @param mixed $id_purchase
     */
    public function setIdPurchase($id_purchase) {
        $this->id_purchase = $id_purchase;
    }

    /**
     * @return mixed
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value) {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getWeight() {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     */
    public function setWeight($weight) {
        $this->weight = $weight;
    }


}