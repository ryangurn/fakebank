@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">User: {{ $user->name }}</div>

                        <div class="float-right">
                            <a href="{{ route('user.index') }}" class="oi oi-arrow-left" data-toggle="tooltip" title="Back"></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <p>
                            <div class="row">
                                <div class="col-md-2"><span class="badge badge-secondary">Gravatar</span></div>
                                <div class="col-md-10"><img src="{{ Gravatar::get($user->email) }}" class="rounded-circle" height="50px"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"><span class="badge badge-warning">Verified</span></div>
                                <div class="col-md-10">
                                    @if($user->verified) <span class="badge badge-danger"><i class="oi oi-x"></i> Not Verified</span>
                                    @else <span class="badge badge-success"><i class="oi oi-check"></i> Verified</span> @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"><span class="badge badge-primary">Email</span></div>
                                <div class="col-md-10">{{ $user->email }}</div>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
