<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Transaction extends Model
{
    use SoftDeletes, LogsActivity;

    protected static $logFillable = true;
    protected static $logName = 'transaction';

    protected $table = 'transactions';

    protected $fillable = [
        'account_id',
        'description',
        'amount',
        'time'
    ];

    protected $casts = [
        'time' => 'timestamp'
    ];

    public function account(){
        return $this->hasOne(Account::class, 'id', 'account_id');
    }
}
