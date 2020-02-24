@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Add IP</div>

                            <div class="card-body">
                                <form method="POST">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="name"
                                               class="col-md-4 col-form-label text-md-right">{{ __('IP') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text"
                                                   class="form-control @error('ip_address') is-invalid @enderror" name="ip_address"
                                                   value="{{ old('ip_address') }}" required autocomplete="ip_address" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Save') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
