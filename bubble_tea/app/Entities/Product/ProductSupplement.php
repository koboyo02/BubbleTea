<?php

namespace App\Entities\Product;

use App\Repositories\Product\ProductSupplementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author Gilles MARIE-SAINTE <marie-_g@etna-alternance.net>
 *
 * @ORM\Entity(repositoryClass=ProductSupplementRepository::class)
 * @ORM\Table(name="products_supplements")
 */
class ProductSupplement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private string $name;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private float $price;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private int $remainingCount = -1;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getRemainingCount(): int
    {
        return $this->remainingCount;
    }

    public function setRemainingCount(int $remainingCount): self
    {
        $this->remainingCount = $remainingCount;

        return $this;
    }
}
