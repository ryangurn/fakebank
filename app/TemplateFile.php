<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class TemplateFile
 * @package App
 */
class TemplateFile extends Model
{
    use LogsActivity;

    /**
     * @var bool
     */
    protected static $logFillable = true;
    /**
     * @var string
     */
    protected static $logName = 'file';

    /**
     * @var string
     */
    protected $table = 'templates_files';

    /**
     * @var string[]
     */
    protected $fillable = [
        'template_id',
        'storage',
        'type'
    ];

    /**
     * @param $value
     * @return string
     */
    public function getTypeAttribute($value): string
    {
        switch ($value){
            case 0:
                return "Layout";
            case 1:
                return "Partial";
            case 2:
                return "Modal";
            default:
                return;
        }
    }

    /**
     * @return HasOne
     */
    public function template(): HasOne
    {
        return $this->hasOne(Template::class, 'id', 'template_id');
    }

    /**
     * @return HasMany
     */
    public function routes(): HasMany
    {
        return $this->hasMany(TemplateRoute::class, 'file_id', 'id');
    }
}
