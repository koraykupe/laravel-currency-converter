@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <div class="row">
                        <div class="col-2">
                            <h1>Authorized IPs</h1>
                        </div>
                        <div class="offset-md-8 col-2">
                            <a href="{{ route('add_ip') }}" class="btn btn-primary">Add IP</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">IP</th>
                            <th scope="col">Created At</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ips as $ip)
                        <tr>
                                <td>{{ $ip->id }}</td>
                                <td>{{ $ip->ip_address }}</td>
                                <td>{{ $ip->created_at }}</td>
                                <td><a href="{{ route('delete_ip', ['id' => $ip->id]) }}" class="btn btn-danger btn-sm">Delete</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
