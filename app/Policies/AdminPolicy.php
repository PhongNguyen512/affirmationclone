<?php

namespace App\Policies;

use App\User;
use App\Category;
use App\GroupItem;
use App\Item;
use App\SubItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function deleteCategory(User $user)
    {
        return $user->role === 'super_admin';
    }

    public function deleteGroupItem(User $user)
    {
        return $user->role == "super_admin";
    }

    public function deleteItem(User $user)
    {
        return $user->role == 'super_admin';
    }

    public function deleteSubItem(User $user)
    {
        return $user->role == 'super_admin';
    }
}
