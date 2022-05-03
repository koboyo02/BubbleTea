<?php

namespace App\Entities;

use App\Repositories\UserRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;
use LaravelDoctrine\ORM\Auth\Authenticatable as AuthenticatableTrait;

/**
 * @author Gilles MARIE-SAINTE <marie-_g@etna-alternance.net>
 *
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="users")
 * @ORM\HasLifecycleCallbacks
 */
class User implements Authenticatable
{
    use AuthenticatableTrait;

    public const ROLE_USER = 'user';
    public const ROLE_ADMIN = 'admin';

    // use CanResetPassword;
    // use Timestamps;
    // use Notifiable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    protected ?int $id = null;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected string $firstName;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected string $lastName;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected string $email;

    /**
     * @ORM\Column(type="string", nullable=false, length=20)
     */
    protected string $role = self::ROLE_USER;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }

    /**
     * @ORM\PreUpdate
     */
    public function __update(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }
}
