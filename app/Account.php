<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;

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
        return sprintf('%01.2f', $value);
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
