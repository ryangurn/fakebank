<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $table = 'transactions';

    protected $fillable = [
        'account_id',
        'description',
        'amount'
    ];

    public function account(){
        return $this->hasOne(Account::class, 'id', 'account_id');
    }
}
