<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\Traits\LogsActivity;

class Template extends Model
{
    use LogsActivity;

    protected static $logFillable = true;
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
    public function bank() {
        return $this->hasOne(Bank::class, 'id', 'bank_id');
    }

    public function variables() {
        return $this->hasMany(TemplateVariable::class, 'template_id', 'id');
    }

    public function files() {
        return $this->hasMany(TemplateFile::class, 'template_id', 'id');
    }
}
