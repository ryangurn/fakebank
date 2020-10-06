<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class TemplateRoute
 * @package App
 */
class TemplateRoute extends Model
{
    use LogsActivity;

    /**
     * @var bool
     */
    protected static $logFillable = true;
    /**
     * @var string
     */
    protected static $logName = 'route';

    /**
     * @var string
     */
    protected $table = 'templates_routes';

    /**
     * @var string[]
     */
    protected $fillable = [
        'template_id',
        'file_id',
        'route',
    ];

    /**
     * @return HasOne
     */
    public function template(): HasOne
    {
        return $this->hasOne(Template::class, 'id', 'template_id');
    }

    /**
     * @return HasOne
     */
    public function file(): HasOne
    {
        return $this->hasOne(TemplateFile::class, 'id', 'file_id');
    }
}
