@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="fromInput">From</label>
                            <select name="from_currency" id="fromInput" class="custom-select"
                                    aria-describedby="fromHelp">
                                <option selected></option>
                                @foreach($currencies as $currency)
                                    <option value="{{ $currency }}">{{ $currency }}</option>
                                @endforeach
                            </select>
                            <small id="fromHelp" class="form-text text-muted">Select source currency first.</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="amountInput">Amount</label>
                            <input name="amount" type="number" class="form-control" id="amountInput"
                                   aria-describedby="amountHelp">
                            <small id="amountHelp" class="form-text text-muted">Float numbers are allowed.</small>
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">Convert</button>
            </form>
        </div>
        @if($exchangeRates)
            <div class="col-md-12 mt-4">
                <h5>Results for {{ $fromCurrency . $amount }}:</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            @foreach($exchangeRates as $exchangeRate)
                                <th scope="col">{{ $exchangeRate->to_currency }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($exchangeRates as $exchangeRate)
                                <td>{{ number_format($exchangeRate->rate * $amount, 2) }}</td>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
