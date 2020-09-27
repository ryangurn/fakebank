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
                                <div class="col-md-10"><pre>{{ $template->settings  }}</pre></div>
                            </div>
                            <br />
                            @endif
                        </p>
                    </div>

                    <div class="card-footer text-center">
                        <a href="{{ route('template.index') }}" class="badge badge-pill badge-primary">[List]</a>
                        <a href="{{ route('template.edit', $template->id) }}" class="badge badge-pill badge-warning">[Edit]</a>
                        <a href="#" data-backdrop="true" data-toggle="modal" data-target="#activity_template_{{ $template->id }}" data-toggle="tooltip" title="Activity Log" class="badge badge-pill badge-danger">[Logs]</a>
                    </div>
                </div>

            </div>
        </div>

        <div class="mb-4 mt-4"></div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                @include('template.variables.partials._card')
            </div>
        </div>

        <div class="mb-4 mt-4"></div>

        <div class="row justify-content-center">
            <div class="col-md-5">
                @include('template.files.partials._card')
            </div>
            <div class="col-md-5">
                @include('template.routes.partials._card')
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('template.routes.partials._log_modal')
    @include('template.variables.partials._log_modal')
    @include('template.files.partials._log_modal')
    @include('template.partials._log_modal')
@endsection
