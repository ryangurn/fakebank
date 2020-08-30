@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Accounts</div>

                        <div class="float-right">
                            <a href="{{ route('account.create')  }}" class="oi oi-plus" data-toggle="tooltip" title="Create Account"></a>
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
                                <tr>
                                    <td>{{ $accounts->bank->name  }}</td>
                                    <td>{{ $accounts->type  }}</td>
                                    <td>{{ $accounts->number  }}</td>
                                    <td>{{ $accounts->balance  }}</td>
                                    <td></td>
                                </tr>
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
