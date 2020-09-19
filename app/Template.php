<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Template extends Model
{
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
}
