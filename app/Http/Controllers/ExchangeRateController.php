<?php

namespace App\Http\Controllers;

use App\ExchangeRate;
use App\Http\Requests\ShowExchangeRatesRequest;
use Illuminate\Support\Facades\Gate;

class ExchangeRateController extends Controller
{
    public function index(ShowExchangeRatesRequest $request) {
        if (Gate::denies('check-exchange-rates')) {
            return view('errors/not_authorized');
        }
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
