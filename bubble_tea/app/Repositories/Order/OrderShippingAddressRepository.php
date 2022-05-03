<?php

namespace App\Repositories\Order;

use App\Entities\Order\OrderShippingAddress;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * @author Gilles MARIE-SAINTE <marie-_g@etna-alternance.net>
 */
final class OrderShippingAddressRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(OrderShippingAddress::class));
    }
}
