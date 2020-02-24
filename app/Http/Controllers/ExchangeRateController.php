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
        $amount = null;

        if ($request->method() === 'POST') {
            $amount = $request->get('amount');
            $exchangeRates = ExchangeRate::OfFromCurrency($request->get('from_currency'))->get();
        }
        return view('exchange_rates', compact('currencies', 'exchangeRates', 'amount'));
    }
}
