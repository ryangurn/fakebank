@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Route: {{ $route->route }}</div>

                        <div class="float-right">
                            <a href="{{ route('template.show', $route->template->id) }}" class="oi oi-arrow-left" data-toggle="tooltip" title="Back"></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <p>
                            <div class="row">
                                <div class="col-md-2"><span class="badge badge-primary">File</span></div>
                                <div class="col-md-10">{{ $route->file->storage }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"><span class="badge badge-secondary">URL</span></div>
                                <div class="col-md-10">{{ route('root') }}/{{ $route->route  }}</div>
                            </div>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
