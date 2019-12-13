@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Banks</div>

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
                                <tr>
                                    <td>{{ $banks->name  }}</td>
                                    <td>{{ $banks->caption  }}</td>
                                    <td>{{ __('Not Configured') }}</td>
                                </tr>
                            @endif
                                <tr>
                                    <td colspan="3">{{ __('None Configured') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
