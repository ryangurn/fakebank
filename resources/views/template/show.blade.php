@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Template for {{ $template->bank->name }}</div>

                        <div class="float-right">
                            <a href="{{ route('template.index') }}" class="oi oi-arrow-left" data-toggle="tooltip" title="Back"></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <p>
                            <div class="row">
                                <div class="col-md-2"><span class="badge badge-primary">Resource Path</span></div>
                                <div class="col-md-10">{{ $template->resource }}</div>
                            </div>
                            @if($template->settings != null)
                            <div class="row">
                                <div class="col-md-2"><span class="badge badge-danger">Settings</span></div>
                                <div class="col-md-10"><pre>{{ json_encode($template->settings)  }}</pre></div>
                            </div>
                            <br />
                            @endif
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <div class="mb-4 mt-4"></div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Variables for {{ $template->bank->name }}</div>

                        <div class="float-right">
                            <a href="{{ route('variable.create', $template->id) }}" class="oi oi-plus" data-toggle="tooltip" title="Create Variable"></a>
                        </div>
                    </div>


                    <div class="card-body">
                        <p>
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>Variable</th>
                                    <th>Value</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(isset($variables) && !$variables->isEmpty())
                                @foreach($variables as $variable)
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3">{{ __('None Configured') }}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
