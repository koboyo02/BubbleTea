<?php

namespace App\Repositories\Order;

use App\Entities\Order\Order;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * @author Gilles MARIE-SAINTE <marie-_g@etna-alternance.net>
 */
final class OrderRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(Order::class));
    }

    public function findFullyById(int $orderId): ?Order
    {
        return $this->createQueryBuilder('o')
            ->select('o, oi, p, ps, sa, dc')
            ->leftJoin('o.items', 'oi')
            ->leftJoin('oi.product', 'p')
            ->leftJoin('oi.supplements', 'ps')
            ->leftJoin('o.shippingAddress', 'sa')
            ->leftJoin('o.discountCode', 'dc')
            ->where('o.id = :orderId')
            ->setParameter('orderId', $orderId)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
