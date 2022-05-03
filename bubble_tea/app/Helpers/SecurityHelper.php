<?php

namespace App\Helpers;

use App\Entities\User;
use Illuminate\Support\Facades\Auth;

final class SecurityHelper
{
    public static function abortUnlessAdmin(): void
    {
        $user = Auth::user();
        if ($user instanceof User && User::ROLE_ADMIN === $user->getRole()) {
            return;
        }

        abort(403);
    }
}
