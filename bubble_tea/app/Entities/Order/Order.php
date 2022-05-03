<?php

namespace App\Entities\Order;

use App\Entities\User;
use App\Repositories\Order\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author Gilles MARIE-SAINTE <marie-_g@etna-alternance.net>
 *
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="orders")
 * @ORM\HasLifecycleCallbacks
 */
class Order
{
    public const STATUS_IN_CART = 'in_cart';
    public const STATUS_CHECKOUT = 'checkout';
    public const STATUS_COMPLETED = 'completed';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    // relation many to one with the user
    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     */
    private User $owner;

    /**
     * @ORM\OneToOne(targetEntity="OrderShippingAddress", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="shipping_address_id", referencedColumnName="id", nullable=true)
     */
    private ?OrderShippingAddress $shippingAddress = null;

    /**
     * @ORM\ManyToOne(targetEntity=DiscountCode::class)
     * @ORM\JoinColumn(name="discount_code_id", referencedColumnName="id", nullable=true)
     */
    private ?DiscountCode $discountCode = null;

    /**
     * @ORM\OneToMany(targetEntity=OrderItem::class, mappedBy="parent", cascade={"persist", "remove"})
     */
    private Collection $items;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private string $status = self::STATUS_IN_CART;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private float $totalPriceWithoutDiscount = 0;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private float $totalPrice = 0;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=false)
     */
    private ?\DateTimeImmutable $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private ?\DateTimeImmutable $completedAt = null;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=false)
     */
    private \DateTimeImmutable $updatedAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->items = new ArrayCollection();
    }

    /**
     * @ORM\PreUpdate
     */
    public function __update(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): User
    {
        return $this->owner;
    }

    public function setOwner(User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getShippingAddress(): ?OrderShippingAddress
    {
        return $this->shippingAddress;
    }

    public function setShippingAddress(?OrderShippingAddress $shippingAddress): self
    {
        $this->shippingAddress = $shippingAddress;

        return $this;
    }

    public function getDiscountCode(): ?DiscountCode
    {
        return $this->discountCode;
    }

    public function setDiscountCode(DiscountCode $discountCode): self
    {
        $this->discountCode = $discountCode;

        return $this;
    }

    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(OrderItem $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
            $item->setParent($this);
        }

        return $this;
    }

    public function removeItem(OrderItem $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            // set the owning side to null (unless already changed)
            // if ($item->getParent() === $this) {
            //     $item->setParent(null);
            // }
        }

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTotalPriceWithoutDiscount(): float
    {
        return $this->totalPriceWithoutDiscount;
    }

    public function setTotalPriceWithoutDiscount(float $totalPriceWithoutDiscount): self
    {
        $this->totalPriceWithoutDiscount = $totalPriceWithoutDiscount;

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

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCompletedAt(): ?\DateTimeImmutable
    {
        return $this->completedAt;
    }

    public function setCompletedAt(\DateTimeImmutable $completedAt): self
    {
        $this->completedAt = $completedAt;

        return $this;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
