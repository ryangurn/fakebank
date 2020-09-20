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

    protected static $logFillable = true;
    protected static $logName = 'variable';

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

    public function getExecutableAttribute($value) {
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
    public function template() {
        return $this->hasOne(Template::class, 'id', 'template_id');
    }
}
