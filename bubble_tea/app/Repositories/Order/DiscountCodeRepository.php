<?php

namespace App\Repositories\Order;

use App\Entities\Order\DiscountCode;
use App\Entities\Order\Order;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * @author Gilles MARIE-SAINTE <marie-_g@etna-alternance.net>
 */
final class DiscountCodeRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(DiscountCode::class));
    }

    public function findUsageCount(DiscountCode $discountCode): int
    {
        return $this->createQueryBuilder('dc')
            ->select('count(dc.id)')
            ->innerJoin(Order::class, 'o')
            ->where('o.discountCode = :discountCode')
            ->setParameter('discountCode', $discountCode->getId())
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
}
