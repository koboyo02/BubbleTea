<?php

namespace App\Entities\Order;

use App\Entities\Product\Product;
use App\Entities\Product\ProductSupplement;
use App\Repositories\Order\OrderItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author Gilles MARIE-SAINTE <marie-_g@etna-alternance.net>
 *
 * @ORM\Entity(repositoryClass=OrderItemRepository::class)
 * @ORM\Table(name="orders_items")
 */
class OrderItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entities\Order\Order", inversedBy="items")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=false)
     */
    private Order $parent;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class)
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
     */
    private Product $product;

    /**
     * @ORM\ManyToMany(targetEntity=ProductSupplement::class, cascade={"persist", "remove"})
     * @ORM\JoinTable(name="orders_items_supplements",
     *      joinColumns={
     *          @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     *      },
     *      inverseJoinColumns={
     *          @ORM\JoinColumn(name="supplement_id", referencedColumnName="id")
     *      }
     * )
     */
    private Collection $supplements;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private int $quantity = 1;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private float $totalPrice;

    public function __construct()
    {
        $this->supplements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParent(): Order
    {
        return $this->parent;
    }

    public function setParent(Order $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getSupplements(): Collection
    {
        return $this->supplements;
    }

    public function addSupplement(ProductSupplement $supplement): self
    {
        if (!$this->supplements->contains($supplement)) {
            $this->supplements->add($supplement);
        }

        return $this;
    }

    public function removeSupplement(ProductSupplement $supplement): self
    {
        if ($this->supplements->contains($supplement)) {
            $this->supplements->removeElement($supplement);
        }

        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(float $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }
}
