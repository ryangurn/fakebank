@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">Accounts</div>

                    <div class="float-right">
                        <a href="{{ route('account.create') }}" class="oi oi-plus" data-toggle="tooltip" title="Create Transaction"></a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>{{ __('Bank') }}</th>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Number')  }}</th>
                                <th>{{ __('Balance') }}</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!$accounts->isEmpty())
                            @foreach($accounts as $account)
                            <tr>
                                <td>{{ $account->bank->name }}</td>
                                <td>{{ $account->type }}</td>
                                <td>{{ $account->number }}</td>
                                <td>${{ $account->balance }}</td>
                                <td>
                                    <a href="{{ route('account.show', $account->id)  }}" class="badge-pill badge-primary" data-toggle="tooltip" title="Show Transaction: {{ $account->description }}">Show</a>
                                    <a href="{{ route('account.edit', $account->id)  }}" class="badge-pill badge-warning" data-toggle="tooltip" title="Edit Transaction: {{ $account->description }}">Edit</a>
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
