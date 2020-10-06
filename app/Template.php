<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Template
 * @package App
 */
class Template extends Model
{
    use LogsActivity;

    /**
     * @var bool
     */
    protected static $logFillable = true;
    /**
     * @var string
     */
    protected static $logName = 'template';

    /**
     * be explicit, yes means yes.
     * @var string
     */
    protected $table = 'templates';

    /**
     * columns that are fillable via the ::create()
     * method using normal eloquent setters
     * @var string[]
     */
    protected $fillable = [
        'bank_id',
        'settings',
        'resource'
    ];

    /**
     * casting of settings back to an array
     * from json store in the mariadb column.
     * @var string[]
     */
    protected $casts = [
        'settings' => 'array'
    ];

    /**
     * @return HasOne
     */
    public function bank(): HasOne
    {
        return $this->hasOne(Bank::class, 'id', 'bank_id');
    }

    /**
     * @return HasMany
     */
    public function variables(): HasMany
    {
        return $this->hasMany(TemplateVariable::class, 'template_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function files(): HasMany
    {
        return $this->hasMany(TemplateFile::class, 'template_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function routes(): HasMany
    {
        return $this->hasMany(TemplateRoute::class, 'template_id', 'id');
    }
}
