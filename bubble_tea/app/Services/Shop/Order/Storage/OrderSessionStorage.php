<?php

namespace App\Services\Shop\Order\Storage;

use App\Entities\Order\Order;
use App\Repositories\Order\OrderRepository;
use Illuminate\Support\Facades\Session;

/**
 * @author Gilles MARIE-SAINTE <marie-_g@etna-alternance.net>
 */
final class OrderSessionStorage implements OrderStorageInterface
{
    public const ORDER_KEY_NAME = 'orderId';

    public function __construct(private OrderRepository $repository)
    {
    }

    public function getOrderId(): ?string
    {
        return Session::get(self::ORDER_KEY_NAME);
    }

    public function isDefined(): bool
    {
        return Session::has(self::ORDER_KEY_NAME);
    }

    public function getOrder(): ?Order
    {
        if ($this->isDefined() && null !== $orderId = $this->getOrderId()) {
            return $this->repository->findFullyById($orderId);
        }

        return null;
    }

    public function setOrderId(string $orderId): void
    {
        Session::put(self::ORDER_KEY_NAME, $orderId);
    }

    public function remove(): void
    {
        Session::forget(self::ORDER_KEY_NAME);
    }
}
