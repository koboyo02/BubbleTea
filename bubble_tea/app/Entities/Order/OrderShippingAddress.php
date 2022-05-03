<?php

namespace App\Entities\Order;

use App\Repositories\Order\OrderShippingAddressRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author Gilles MARIE-SAINTE <marie-_g@etna-alternance.net>
 *
 * @ORM\Entity(repositoryClass=OrderShippingAddressRepository::class)
 * @ORM\Table(name="orders_shipping_addresses")
 */
class OrderShippingAddress
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class)
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=false)
     */
    private Order $parent;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private string $address;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private string $city;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private string $zipCode;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private string $country;

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

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }
}
