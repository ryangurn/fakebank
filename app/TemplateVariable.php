<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class TemplateVariable
 * @package App
 */
class TemplateVariable extends Model
{
    /**
     * its good to be explicit, also i think
     * i broke the naming convention
     * @var string
     */
    protected $table = 'templates_variables';

    /**
     * columns that are fillable via the ::create()
     * method using normal eloquent setters
     * @var string[]
     */
    protected $fillable = [
        'template_id',
        'variable',
        'value',
        'executable'
    ];

    /**
     * defining relationship between
     * variable and template
     * @return HasOne
     */
    public function template() {
        return $this->hasOne(Template::class, 'id', 'template_id');
    }
}
