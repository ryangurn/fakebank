@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Banks</div>

                        <div class="float-right">
                            <a href="{{ route('bank.create') }}" class="oi oi-plus" data-toggle="tooltip" title="Create Bank"></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Caption') }}</th>
                                    <th>{{ __('Active')  }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(!$banks->isEmpty())
                                @foreach($banks as $bank)
                                <tr>
                                    <td>{{ $bank->name  }}</td>
                                    <td>{{ $bank->caption  }}</td>
                                    <td>{{ __('Not Configured') }}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3">{{ __('None Configured') }}</td>
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
