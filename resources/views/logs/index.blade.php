@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Statistics</div>

                    <div class="card-body">
                        <p>Count of items by log</p>
                    @if(count($statistics) != 0)
                        @foreach($statistics as $key => $value)
                        <span class="badge badge-pill badge-primary">{{ $key }} - {{ $value }}</span>
                        @endforeach
                    @else
                    <p>
                        <span class="alert alert-warning">There are not statistics to show just yet.</span>
                    </p>
                    @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4 mt-4"></div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                {{ $logs->links()  }}

                @if(isset($logs) && !$logs->isEmpty())
                    @foreach($logs as $activity)
                        <div class="card @if($activity->description == "created") border-success @elseif($activity->description == "updated") border-warning @elseif($activity->description == "deleted") border-danger @else border-primary @endif" style="border-width: .25em; margin-bottom: .5em;">
                            <div class="card-header">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#activity_{{ $activity->id }}" aria-expanded="true" aria-controls="collapseOne">
                                    <span class="float-left">
                                        <b>{{ $activity->causer->name }}</b> {{ $activity->description }} {{ \Illuminate\Support\Str::singular($activity->log_name)  }}</b>
                                    </span>
                                    <span class="float-right">
                                        <span class="badge @if($activity->description == "created") badge-success @elseif($activity->description == "updated") badge-warning @elseif($activity->description == "deleted") badge-danger @else badge-primary @endif">{{ $activity->created_at->diffForHumans()  }}</span>
                                    </span>
                                    </button>
                                </h2>
                            </div>

                            <div id="activity_{{ $activity->id }}" class="collapse">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2"><span class="badge badge-primary">Log</span></div>
                                        <div class="col-md-10">{{ $activity->log_name }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><span class="badge badge-light">Causer</span></div>
                                        <div class="col-md-10">{{ $activity->causer->name }}</div>
                                    </div>
                                    @if(isset(json_decode($activity->changes())->attributes) && json_decode($activity->changes())->attributes != null)
                                        <div class="row">
                                            <div class="col-md-2"><span class="badge badge-danger">New Data</span></div>
                                            <div class="col-md-10">{{ json_encode(json_decode($activity->changes())->attributes) }}</div>
                                        </div>
                                    @endif
                                    @if(isset(json_decode($activity->changes())->old) && json_decode($activity->changes())->old != null)
                                        <div class="row">
                                            <div class="col-md-2"><span class="badge badge-warning">Prior Data</span></div>
                                            <div class="col-md-10">{{ json_encode(json_decode($activity->changes())->old) }}</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                {{ $logs->links()  }}
            </div>
        </div>

        <div class="mb-4 mt-4"></div>
    </div>
@endsection

{{--@section('modal')--}}

{{--@endsection--}}
