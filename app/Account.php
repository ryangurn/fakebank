<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
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
        return money_format('%i', $value);
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
}
