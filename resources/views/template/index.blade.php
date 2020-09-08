@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Information</div>

                    <div class="card-body">
                        <div class="alert alert-warning">Before adding a template you must add a <a href="{{ route('bank.create')  }}">bank</a>.</div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Variables</div>

                    <div class="card-body">
                        <div class="alert alert-warning">Before adding variables you must add a template.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4 mt-4"></div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Templates</div>

                        <div class="float-right">
                            <a href="{{ route('template.create') }}" class="oi oi-plus" data-toggle="tooltip" title="Create Template"></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th>{{ __('Bank ') }}</th>
                                <th>{{ __('Resource') }}</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!$templates->isEmpty())
                                @foreach($templates as $template)
                                    <tr>
                                        <td>{{ $template->bank->name  }}</td>
                                        <td>{{ $template->resource  }}</td>
                                        <td>
{{--                                            <a href="{{ route('bank.show', $bank->id) }}" class="badge-pill badge-primary" data-toggle="tooltip" title="Show Bank: {{ $bank->name }}">[Show]</a>--}}
{{--                                            <a href="{{ route('bank.edit', $bank->id) }}" class="badge-pill badge-warning" data-toggle="tooltip" title="Edit Bank: {{ $bank->name }}">[Edit]</a>--}}
                                        </td>
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
