<?php
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /**
     * @ORM\Column(name="name", type="string")
     */
    protected $name;
    /**
     * @ORM\Column(name="img", type="string")
     */
    protected $img;
    /**
     * @ORM\Column(name="description", type="string")
     */
    protected $description;
    /**
     * @ORM\Column(name="value", type="float")
     */
    protected $value;
    /**
     * @ORM\Column(name="weight", type="float")
     */
    protected $weight;
    /**
     * @ORM\Column(name="ordination", type="integer")
     */
    protected $ordination;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name) {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getImg(): string {
        return $this->img;
    }

    /**
     * @param string $img
     */
    public function setImg(string $img) {
        $this->img = $img;
    }

    /**
     * @return string
     */
    public function getDescription(): string {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description) {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getValue(): float {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue(float $value) {
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function getWeight(): float {
        return $this->weight;
    }

    /**
     * @param float $weight
     */
    public function setWeight(float $weight) {
        $this->weight = $weight;
    }

    /**
     * @return mixed
     */
    public function getOrdination() {
        return $this->ordination;
    }

    /**
     * @param mixed $ordination
     */
    public function setOrdination($ordination) {
        $this->ordination = $ordination;
    }


}