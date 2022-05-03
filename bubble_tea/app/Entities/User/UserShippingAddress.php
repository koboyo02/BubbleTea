<?php

namespace App\Entities\User;

use App\Entities\User;
use App\Repositories\User\UserShippingAddressRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author Gilles MARIE-SAINTE <marie-_g@etna-alternance.net>
 *
 * @ORM\Entity(repositoryClass=UserShippingAddressRepository::class)
 * @ORM\Table(name="users_shipping_addresses")
 */
class UserShippingAddress
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=false)
     */
    private User $parent;

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

    public function getParent(): User
    {
        return $this->parent;
    }

    public function setParent(User $parent): self
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
