<?php

namespace App\Policies;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TodoPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * ユーザーがモデルを表示できるかどうかを決定する.
     */
    public function view(User $user, Todo $todo): bool
    {
        return $user->id === $todo->user_id;
    }

    /**
     * ユーザーがモデルを作成できるかどうかを判断する.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * ユーザーがモデルを更新できるかどうかを判断する.
     */
    public function update(User $user, Todo $todo): bool
    {
        return $user->id === $todo->user_id;
    }

    /**
     * ユーザーがモデルを削除できるかどうかを決定する.
     */
    public function delete(User $user, Todo $todo): bool
    {
        return $user->id === $todo->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Todo $todo): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Todo $todo): bool
    {
        //
    }
}
