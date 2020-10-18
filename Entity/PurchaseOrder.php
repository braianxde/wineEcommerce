<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="purchase_order")
 */
class PurchaseOrder {
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /**
     * @ORM\Column(name="datetime", type="string")
     */
    protected $datetime;
    /**
     * @ORM\Column(name="number_items", type="integer")
     */
    protected $number_items;
    /**
     * @ORM\Column(name="amount_value", type="float")
     */
    protected $amount_value;
    /**
     * @ORM\Column(name="amount_weight", type="float")
     */
    protected $amount_weight;
    /**
     * @ORM\Column(name="distance", type="float")
     */
    protected $distance;

    public function getId() {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDatetime() {
        return $this->datetime;
    }

    /**
     * @param mixed $datetime
     */
    public function setDatetime($datetime) {
        $this->datetime = $datetime;
    }

    /**
     * @return mixed
     */
    public function getNumberItems() {
        return $this->number_items;
    }

    /**
     * @param mixed $number_items
     */
    public function setNumberItems($number_items) {
        $this->number_items = $number_items;
    }

    /**
     * @return mixed
     */
    public function getAmountValue() {
        return $this->amount_value;
    }

    /**
     * @param mixed $amount_value
     */
    public function setAmountValue($amount_value) {
        $this->amount_value = $amount_value;
    }

    /**
     * @return mixed
     */
    public function getAmountWeight() {
        return $this->amount_weight;
    }

    /**
     * @param mixed $amount_weight
     */
    public function setAmountWeight($amount_weight) {
        $this->amount_weight = $amount_weight;
    }

    /**
     * @return mixed
     */
    public function getDistance() {
        return $this->distance;
    }

    /**
     * @param mixed $distance
     */
    public function setDistance($distance) {
        $this->distance = $distance;
    }
}