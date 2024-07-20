<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    public function users(): BelongsToMany
    {
        // 多対多のリレーション
        return $this
            ->belongsToMany(User::class, 'role_user', 'role_id', 'user_id')
            ->using(RoleUser::class)
            ->withTimestamps();
    }
}
