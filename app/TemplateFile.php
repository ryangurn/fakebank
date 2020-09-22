<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class TemplateFile extends Model
{
    use LogsActivity;

    protected static $logFillable = true;
    protected static $logName = 'file';

    protected $table = 'templates_files';

    protected $fillable = [
        'template_id',
        'storage',
        'type'
    ];

    public function template() {
        return $this->hasOne(Template::class, 'id', 'template_id');
    }
}
