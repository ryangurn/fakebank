<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Transaction
 * @package App
 */
class Transaction extends Model
{
    use SoftDeletes, LogsActivity;

    /**
     * @var bool
     */
    protected static $logFillable = true;
    /**
     * @var string
     */
    protected static $logName = 'transaction';

    /**
     * @var string
     */
    protected $table = 'transactions';

    /**
     * @var string[]
     */
    protected $fillable = [
        'account_id',
        'description',
        'amount',
        'iso_currency_code',
        'authorization_date',
        'completion_date',
        'location',
        'name',
        'merchant_name',
        'payment_meta',
        'payment_channel',
        'pending',
        'time'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'authorization_date' => 'timestamp',
        'completion_date' => 'timestamp',
        'location' => 'array',
        'payment_meta' => 'array',
        'pending' => 'boolean'
    ];

    /**
     * @return HasOne
     */
    public function account(): HasOne
    {
        return $this->hasOne(Account::class, 'id', 'account_id');
    }
}
