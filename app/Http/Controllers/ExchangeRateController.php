<?php

namespace App\Http\Controllers;

use App\ExchangeRate;
use App\Http\Requests\ShowExchangeRatesRequest;
use Illuminate\Http\Request;

class ExchangeRateController extends Controller
{
    public function index(ShowExchangeRatesRequest $request) {
        $currencies = config('currencies.allowed');
        $exchangeRates = [];
        $amount = $request->get('amount');
        $fromCurrency = $request->get('from_currency');

        if ($request->method() === 'POST') {
            $exchangeRates = ExchangeRate::OfFromCurrency($fromCurrency)->allowed()->get();
        }
        return view('exchange_rates', compact('currencies', 'exchangeRates', 'amount', 'fromCurrency'));
    }
}
