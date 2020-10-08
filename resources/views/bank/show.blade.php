@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Bank: {{ $bank->name }}</div>

                        <div class="float-right">
                            <a href="{{ route('bank.index') }}" class="oi oi-arrow-left" data-toggle="tooltip" title="Back"></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <p>
                            <div class="row">
                                <div class="col-md-2"><span class="badge badge-primary">Caption</span></div>
                                <div class="col-md-10">{{ $bank->caption }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"><span class="badge badge-dark">Routing Numbers</span></div>
                                <div class="col-md-10"><pre>{{ $bank->numbers  }}</pre></div>
                            </div>
                            <br />
                            @if($bank->settings != null)
                            <div class="row">
                                <div class="col-md-2"><span class="badge badge-danger">Settings</span></div>
                                <div class="col-md-10"><pre>{{ json_encode($bank->settings)  }}</pre></div>
                            </div>
                            <br />
                            @endif
                            @if($bank->trolls != null)
                            <div class="row">
                                <div class="col-md-2"><span class="badge badge-warning">Troll Configurations</span></div>
                                <div class="col-md-10"><pre>{{ $bank->trolls  }}</pre></div>
                            </div>
                            <br />
                            @endif
                        </p>
                    </div>
                </div>

                @if(isset($transactions) && !$transactions->isEmpty())
                <div class="mb-4 mt-4"></div>

                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Transactions: {{ $bank->name }}</div>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Account</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->account->number  }}</td>
                                    <td>{{ $transaction->description  }}</td>
                                    <td>{{ $transaction->amount  }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
