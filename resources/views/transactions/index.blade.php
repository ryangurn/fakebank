@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Transactions</div>

                        <div class="float-right">
                            <a href="{{ route('transaction.create') }}" class="oi oi-plus" data-toggle="tooltip" title="Create Transaction"></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>{{ __('Account') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Amounts')  }}</th>
                                    <th>{{ __('Time') }}</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(!$transactions->isEmpty())
                                @foreach($transactions as $transaction)
                                <tr>
                                    <td><a href="{{ route('account.show', $transaction->account->id)  }}">{{ $transaction->account->number }}</a></td>
                                    <td>{{ $transaction->description }}</td>
                                    <td>${{ $transaction->amount }}</td>
                                    <td>{{ date('M d,Y', $transaction->time) }}</td>
                                    <td>
                                        <a href="{{ route('transaction.show', $transaction->id)  }}" class="badge-pill badge-primary" data-toggle="tooltip" title="Show Transaction: {{ $transaction->description }}">Show</a>
                                        <a href="{{ route('transaction.edit', $transaction->id)  }}" class="badge-pill badge-warning" data-toggle="tooltip" title="Edit Transaction: {{ $transaction->description }}">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">None configured</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
