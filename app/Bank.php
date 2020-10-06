<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Bank
 * @package App
 */
class Bank extends Model
{
    use LogsActivity;

    /**
     * @var bool
     */
    protected static $logFillable = true;
    /**
     * @var string
     */
    protected static $logName = 'bank';

    /**
     * be explicit, yes means yes.
     * @var string
     */
    protected $table = 'banks';

    /**
     * columns that are fillable via the ::create()
     * method using normal eloquent setters
     * @var array
     */
    protected $fillable = [
        'name',
        'caption',
        'trolls',
        'settings'
    ];

    /**
     * casting of trolls and settings back to array
     * from json store in the mariadb column.
     * @var array
     */
    protected $casts = [
        'trolls' => 'array',
        'settings' => 'array'
    ];

    /**
     * @return HasMany
     */
    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }

    /**
     * @return HasOne
     */
    public function template(): HasOne
    {
        return $this->hasOne(Template::class, 'bank_id', 'id');
    }
}
