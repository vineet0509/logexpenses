<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;

class PaymentPolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Payment $payment)
    {
        return $user->id === $payment->project->user_id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Payment $payment)
    {
        return $user->id === $payment->project->user_id;
    }

    public function delete(User $user, Payment $payment)
    {
        return $user->id === $payment->project->user_id;
    }
}
