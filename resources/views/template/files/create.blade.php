@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Upload File</div>

                        <div class="float-right">
                            <a href="{{ route('template.show', $template->id) }}" class="oi oi-arrow-left" data-toggle="tooltip" title="Back"></a>
                        </div>
                    </div>

                    <div class="card-body">

                        @include('template.files.partials._form')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
