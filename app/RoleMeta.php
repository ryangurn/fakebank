<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Permission\Models\Role;

/**
 * @method static firstOrCreate(array $array)
 */
class RoleMeta extends Model
{
    /**
     * @var string
     */
    protected $table = 'roles_meta';

    /**
     * @var string[]
     */
    protected $fillable = [
        'role_id',
        'description',
        'long'
    ];

    /**
     * @return HasOne
     */
    public function role(): HasOne
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
}
