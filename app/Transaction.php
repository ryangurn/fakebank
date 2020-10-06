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
        'time'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'time' => 'timestamp'
    ];

    /**
     * @return HasOne
     */
    public function account(): HasOne
    {
        return $this->hasOne(Account::class, 'id', 'account_id');
    }
}
