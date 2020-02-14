<?php

namespace App\Policies;

use App\Quote;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuotePolicy
{
    use HandlesAuthorization;

    public function update(User $user, Quote $quote)
    {
        return $user->ownsQuote($quote);
    }

    public function delete(User $user, Quote $quote)
    {
        return $user->ownsQuote($quote);
    }
}
