@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Transaction: {{ $transaction->description }}</div>

                        <div class="float-right">
                            <a href="{{ route('transaction.index') }}" class="oi oi-arrow-left" data-toggle="tooltip" title="Back"></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2"><span class="badge badge-primary">Amount</span></div>
                            <div class="col-md-10">{{ $transaction->amount }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><span class="badge badge-danger">Bank</span></div>
                            <div class="col-md-10">{{ $transaction->account->bank->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><span class="badge badge-warning">Account</span></div>
                            <div class="col-md-10">******{{ substr($transaction->account->number, -4) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
