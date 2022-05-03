<?php

namespace App\Services\Shop\Order;

use App\Entities\User;

/**
 * @author Gilles MARIE-SAINTE <marie-_g@etna-alternance.net>
 */
interface OrderInterface
{
    public function getId(): ?int;

    public function setOwner(User $owner): self;

    /** @return OrderItemInterface[] */
    public function getItems(): array;

    public function getStatus(): string;

    public function setStatus(string $status): self;

    public function getCreatedAt(): \DateTimeImmutable;
}
