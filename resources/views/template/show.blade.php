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
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Variables for {{ $template->bank->name }}</div>

                        <div class="float-right">
                            <a href="{{ route('variable.create', $template->id) }}" class="oi oi-plus" data-toggle="tooltip" title="Create Variable"></a>
                        </div>
                    </div>


                    <div class="card-body">
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
                    </div>
                </div>

            </div>
        </div>

        <div class="mb-4 mt-4"></div>

        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Files for {{ $template->bank->name }}</div>

                        <div class="float-right">
                            <a href="{{ route('file.create', $template->id) }}" class="oi oi-cloud-upload" data-toggle="tooltip" title="Upload File"></a>
                        </div>
                    </div>


                    <div class="card-body">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>File</th>
                                    <th>Purpose</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(isset($template->files) && !$template->files->isEmpty())
                                @foreach($template->files as $file)
                                <tr>
                                    <td>{{ $file->storage  }}</td>
                                    <td>{{ $file->type  }}</td>
                                    <td>
                                        <a href="{{ route('file.show', $file->id) }}" class="badge-pill badge-primary" data-toggle="tooltip" title="Show File">[Show]</a>
                                        <a href="{{ route('file.edit', $file->id) }}" class="badge-pill badge-warning" data-toggle="tooltip" title="Edit File">[Edit]</a>
                                        <a href="#" class="badge-pill badge-danger" data-backdrop="true" data-toggle="modal" data-target="#activity_file_{{ $file->id }}" data-toggle="tooltip" title="Activity Log">[Logs]</a>
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
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Routes for {{ $template->bank->name }}</div>

                        <div class="float-right">
                            <a href="{{ route('route.create', $template->id) }}" class="oi oi-plus" data-toggle="tooltip" title="Add Route"></a>
                        </div>
                    </div>


                    <div class="card-body">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th>Route</th>
                                <th>File</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($template->routes) && !$template->routes->isEmpty())
                                @foreach($template->routes as $route)
                                    <tr>
                                        <td>{{ $route->route }}</td>
                                        <td>{{ $route->file->storage  }}</td>
                                        <td>
                                            <a href="{{ route('route.show', $route->id) }}" class="badge-pill badge-primary" data-toggle="tooltip" title="Show Route">[Show]</a>
                                            <a href="{{ route('route.edit', $route->id) }}" class="badge-pill badge-warning" data-toggle="tooltip" title="Edit Route">[Edit]</a>
                                            <a href="#" class="badge-pill badge-danger" data-backdrop="true" data-toggle="modal" data-target="#activity_route_{{ $route->id }}" data-toggle="tooltip" title="Activity Log">[Logs]</a>
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
    @include('template.routes.partials._log_modal')
    @include('template.variables.partials._log_modal')
    @include('template.files.partials._log_modal')
    @include('template.partials._log_modal')
@endsection
