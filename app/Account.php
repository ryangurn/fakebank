<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use NumberFormatter;
use Spatie\Activitylog\Traits\LogsActivity;

class Account extends Model
{
    use SoftDeletes, LogsActivity;

    protected static $logFillable = true;
    protected static $logName = 'account';

    protected $table = 'accounts';

    protected $fillable = [
        'bank_id',
        'type',
        'number',
        'balance',
        'settings',
    ];

    protected $casts = [
        'settings' => 'array'
    ];

    public function getBalanceAttribute($value){
        $out = new NumberFormatter('en-US', NumberFormatter::CURRENCY);
        return $out->formatCurrency($value, "USD");
    }

    public function getTypeAttribute($value){
        switch ($value){
            case 0:
                return 'Saving';
            case 1:
                return 'Checking';
            case 2:
                return 'Credit Card';
        }
    }

    public function bank(){
        return $this->hasOne(Bank::class, 'id', 'bank_id');
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
