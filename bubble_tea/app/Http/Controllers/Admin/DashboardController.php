<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Order\Order;
use App\Helpers\SecurityHelper;
use App\Http\Controllers\Controller;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Gilles MARIE-SAINTE <marie-_g@etna-alternance.net>
 */
final class DashboardController extends Controller
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function index()
    {
        SecurityHelper::abortUnlessAdmin();

        return view('admin.dashboard.index', [
            'orders' => $this->em->getRepository(Order::class)->findAll(),
        ]);
    }
}
