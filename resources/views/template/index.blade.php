@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Information</div>

                    <div class="card-body">
                        @if($bankCount == 0)
                        <div class="alert alert-warning">Before adding a template you must add a <a href="{{ route('bank.create')  }}">bank</a>.</div>
                        @else
                        <div class="alert alert-success">Variables are helpful to pass information to your resources.</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Variables</div>

                    <div class="card-body">
                        @if($templateCount == 0)
                        <div class="alert alert-warning">Before adding variables you must add a template.</div>
                        @else
                            <div class="alert alert-primary">You can add variables to a template by clicking <a href="#" class="badge badge-pill badge-primary">[Show]</a> in the table below.</div>
                        @endif
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
                                <th>{{ __('Stats') }}</th>
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
                                            <span class="badge badge-pill badge-success" data-toggle="tooltip" title="{{ $template->variables->count() }} {{ \Illuminate\Support\Str::plural('variable', $template->variables->count()) }}">{{ $template->variables->count()  }}</span>
                                            <span class="badge badge-pill badge-primary" data-toggle="tooltip" title="{{ $template->routes->count() }} {{ \Illuminate\Support\Str::plural('route', $template->routes->count()) }}">{{ $template->routes->count()  }}</span>
                                            <span class="badge badge-pill badge-secondary" data-toggle="tooltip" title="{{ $template->files->count() }} {{ \Illuminate\Support\Str::plural('file', $template->files->count()) }}">{{ $template->files->count()  }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('template.show', $template->id) }}" class="badge-pill badge-primary" data-toggle="tooltip" title="Show Template">[Show]</a>
                                            <a href="{{ route('template.edit', $template->id) }}" class="badge-pill badge-warning" data-toggle="tooltip" title="Edit Template">[Edit]</a>
                                            <a href="#" class="badge-pill badge-danger" data-backdrop="true" data-toggle="modal" data-target="#activity_template_{{ $template->id }}" data-toggle="tooltip" title="Activity Log">[Logs]</a>
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

@section('modal')
    @include('template.partials._log_modal')
@endsection
