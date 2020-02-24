<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from_currency', 'to_currency', 'rate_updated_at',
    ];

    /**
     * Only get from currency data excluding it from to currency
     * @param $query
     * @param $fromCurrency
     * @return mixed
     */
    public function scopeOfFromCurrency($query, $fromCurrency)
    {
        return $query->where('from_currency', strtoupper($fromCurrency))->where('to_currency', '!=', strtoupper($fromCurrency));
    }

    /**
     * Get only allowed currency data defined in config file
     * @param $query
     * @return mixed
     */
    public function scopeAllowed($query)
    {
        $allowedCurrencies = config('currencies.allowed');
        return $query->whereIn('to_currency', $allowedCurrencies);
    }
}
