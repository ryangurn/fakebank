@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Account: {{ $account->number }}</div>

                        <div class="float-right">
                            <a href="{{ route('account.index') }}" class="oi oi-arrow-left" data-toggle="tooltip" title="Back"></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2"><span class="badge badge-primary">Bank</span></div>
                            <div class="col-md-10">{{ $account->bank->name  }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><span class="badge badge-danger">Number</span></div>
                            <div class="col-md-10">{{ $account->number  }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><span class="badge badge-info">Type</span></div>
                            <div class="col-md-10">{{ $account->type }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><span class="badge badge-success">Balance</span></div>
                            <div class="col-md-10">{{ $account->balance  }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
