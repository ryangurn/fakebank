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
                                    <th>Executable</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(isset($template->variables) && !$template->variables->isEmpty())
                                @foreach($template->variables as $variable)
                                <tr>
                                    <td>{{ $variable->variable  }}</td>
                                    <td>{{ $variable->value  }}</td>
                                    <td>
                                    @if($variable->executable == "True")
                                            <span class="badge badge-success"><i class="oi oi-check"></i> {{ $variable->executable  }}</span>
                                    @elseif($variable->executable == "False")
                                        <span class="badge badge-danger"><i class="oi oi-x"></i> {{ $variable->executable  }}</span>
                                    @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('variable.show', $variable->id) }}" class="badge-pill badge-primary" data-toggle="tooltip" title="Show Variable">[Show]</a>
                                        <a href="{{ route('variable.edit', $variable->id) }}" class="badge-pill badge-warning" data-toggle="tooltip" title="Edit Variable">[Edit]</a>
                                        <a href="#" class="badge-pill badge-danger" data-backdrop="true" data-toggle="modal" data-target="#activity_variable_{{ $variable->id }}" data-toggle="tooltip" title="Activity Log">[Logs]</a>
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
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('template.variables.partials._modal')
    @include('template.partials._modal')
@endsection
