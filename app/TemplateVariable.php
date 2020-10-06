<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class TemplateVariable
 * @package App
 */
class TemplateVariable extends Model
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
     * @param $value
     * @return string
     */
    public function getExecutableAttribute($value): string
    {
        switch ($value){
            case 1:
                return "True";
            default:
                return "False";
        }
    }

    /**
     * defining relationship between
     * variable and template
     * @return HasOne
     */
    public function template(): HasOne
    {
        return $this->hasOne(Template::class, 'id', 'template_id');
    }
}
