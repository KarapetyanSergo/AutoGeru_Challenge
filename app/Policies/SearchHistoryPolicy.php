<?php

namespace App\Policies;

use App\Models\SearchHistory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SearchHistoryPolicy
{
    use HandlesAuthorization;

    public function createSearchHistory(User $user): bool
    {
        return $user->type === User::TYPES['buyer'];
    }

    public function viewSalesmanSearchHistory(User $user): bool
    {
        return $user->type === User::TYPES['salesman'];
    }

    public function viewBuyerSearchHistory(User $user): bool
    {
        return $user->type === User::TYPES['buyer'];
    }
}
