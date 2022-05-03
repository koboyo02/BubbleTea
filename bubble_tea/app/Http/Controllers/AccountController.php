<?php

namespace App\Http\Controllers;

/**
 * @author Gilles MARIE-SAINTE <marie-_g@etna-alternance.net>
 */
final class AccountController extends Controller
{
    public function index()
    {
        return view('account.index', [
            'orders' => [],
        ]);
    }

    public function addresses()
    {
        return view('account.addresses');
    }
}
