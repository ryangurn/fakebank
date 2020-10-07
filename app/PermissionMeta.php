<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Models\Permission;

/**
 * @method static firstOrCreate(array $array)
 */
class PermissionMeta extends Model
{
    use LogsActivity;

    /**
     * @var bool
     */
    protected static $logFillable = true;
    /**
     * @var string
     */
    protected static $logName = 'permission metadata';

    /**
     * @var string
     */
    protected $table = 'permissions_meta';

    /**
     * @var string[]
     */
    protected $fillable = [
        'permission_id',
        'description',
        'long'
    ];

    /**
     * @return HasOne
     */
    public function permission(): HasOne
    {
        return $this->hasOne(Permission::class, 'id', 'permission_id');
    }
}
