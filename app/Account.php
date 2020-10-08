<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use NumberFormatter;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Account
 * @package App
 */
class Account extends Model
{
    use SoftDeletes, LogsActivity;

    /**
     * @var bool
     */
    protected static $logFillable = true;
    /**
     * @var string
     */
    protected static $logName = 'account';

    /**
     * @var string
     */
    protected $table = 'accounts';

    /**
     * @var string[]
     */
    protected $fillable = [
        'bank_id',
        'name',
        'official_name',
        'type',
        'paperless',
        'number',
        'routing_numbers',
        'interest',
        'balances',
        'settings'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'settings' => 'array',
        'routing_numbers' => 'array',
        'balances' => 'array'
    ];

    /**
     * @param $value
     * @return string
     */
    public function getBalanceAttribute($value): string
    {
        $out = new NumberFormatter('en-US', NumberFormatter::CURRENCY);
        return $out->formatCurrency($value, "USD");
    }

    /**
     * @param $value
     * @return string
     */
    public function getTypeAttribute($value): string
    {
        switch ($value){
            case 0:
                return 'Saving';
            case 1:
                return 'Checking';
            case 2:
                return 'Credit Card';
        }
    }

    /**
     * @return HasOne
     */
    public function bank(): HasOne
    {
        return $this->hasOne(Bank::class, 'id', 'bank_id');
    }

    /**
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
