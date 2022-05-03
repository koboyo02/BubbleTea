<?php

namespace App\Services\Shop\Order\Storage;

use App\Entities\Order\Order;

/**
 * @author Gilles MARIE-SAINTE <marie-_g@etna-alternance.net>
 */
interface OrderStorageInterface
{
    public function getOrderId(): ?string;

    public function isDefined(): bool;

    public function getOrder(): ?Order;

    public function setOrderId(string $orderId): void;

    public function remove(): void;
}
