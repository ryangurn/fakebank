@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">File: {{ $file->storage }}</div>

                        <div class="float-right">
                            <a href="{{ route('template.show', $file->template->id) }}" class="oi oi-arrow-left" data-toggle="tooltip" title="Back"></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <p>
                            <div class="row">
                                <div class="col-md-2"><span class="badge badge-primary">Path</span></div>
                                <div class="col-md-10">{{ 'resources/views/public/'.$file->template->resource.'/'.strtolower($file->type).'s/'.$file->storage }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"><span class="badge badge-secondary">Purpose</span></div>
                                <div class="col-md-10">{{ $file->type }}</div>
                            </div>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
