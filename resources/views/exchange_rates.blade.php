<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Exchange Rates Calculator</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Styles -->
    <style>
    </style>
</head>
<body>
<div class="container">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <h1>
        Exchange Rate Calculator
    </h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <div class="row">
        <div class="col-md-12">
            <form method="post">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="fromInput">From</label>
                            <select name="from_currency" id="fromInput" class="custom-select" aria-describedby="fromHelp">
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
                            <input name="amount" type="number" class="form-control" id="amountInput" aria-describedby="amountHelp">
                            <small id="amountHelp" class="form-text text-muted">Float numbers are allowed.</small>
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">Convert</button>
            </form>
        </div>
        @if(isset($exchangeRates))
        <div class="col-md-12 mt-4">
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
</div>
</body>
</html>
