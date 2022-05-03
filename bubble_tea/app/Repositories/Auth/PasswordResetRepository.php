<?php

namespace App\Repositories\Auth;

use App\Entities\Auth\PasswordReset;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * @author Gilles MARIE-SAINTE <marie-_g@etna-alternance.net>
 */
class PasswordResetRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(PasswordReset::class));
    }
}
