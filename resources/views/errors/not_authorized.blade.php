@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">You are not authorized to access this page!</div>
                <div class="card-body">Please check your IP (<b>{{ request()->ip() }}</b>) is in the authorization table.</div>
            </div>
        </div>
    </div>
</div>
@endsection
