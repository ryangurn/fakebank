@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Variable: {{ $variable->variable }}</div>

                        <div class="float-right">
                            <a href="{{ route('template.show', $variable->template->id) }}" class="oi oi-arrow-left" data-toggle="tooltip" title="Back"></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <p>
                            <div class="row">
                                <div class="col-md-2"><span class="badge badge-primary">Variable</span></div>
                                <div class="col-md-10">{{ $variable->variable }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"><span class="badge badge-secondary">Value</span></div>
                                <div class="col-md-10">{{ $variable->value }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"><span class="badge badge-dark">Executable</span></div>
                                <div class="col-md-10">
                                    @if($variable->executable == "True")
                                        <span class="badge badge-success"><i class="oi oi-check"></i> {{ $variable->executable  }}</span>
                                    @elseif($variable->executable == "False")
                                        <span class="badge badge-danger"><i class="oi oi-x"></i> {{ $variable->executable  }}</span>
                                    @endif
                                </div>
                            </div>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
