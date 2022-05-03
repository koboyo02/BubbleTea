<?php

namespace App\Repositories\User;

use App\Entities\User\UserShippingAddress;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * @author Gilles MARIE-SAINTE <marie-_g@etna-alternance.net>
 */
class UserShippingAddressRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(UserShippingAddress::class));
    }

    public function countForUser(int $userId): int
    {
        return $this->createQueryBuilder('a')
            ->select('COUNT(a.id)')
            ->where('a.parent = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
}
