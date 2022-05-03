<?php

namespace App\Entities\Auth;

use App\Repositories\Auth\PasswordResetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author Gilles MARIE-SAINTE <marie-_g@etna-alternance.net>
 *
 * @ORM\Entity(repositoryClass=PasswordResetRepository::class)
 * @ORM\Table(name="password_resets")
 */
class PasswordReset
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
    private string $email;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private string $token;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private \DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
