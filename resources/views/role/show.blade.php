@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Role: {{ $role->name }}</div>

                        <div class="float-right">
                            <a href="{{ route('role.index') }}" class="oi oi-arrow-left" data-toggle="tooltip" title="Back"></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <p>
                            <div class="row">
                                <div class="col-md-2"><span class="badge badge-primary">Name</span></div>
                                <div class="col-md-10">{{ $role->name }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"><span class="badge badge-warning">Description</span></div>
                                <div class="col-md-10">{{ \App\RoleMeta::where('role_id', '=', $role->id)->first()->description }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"><span class="badge badge-danger">Long Description</span></div>
                                <div class="col-md-10">{{ \App\RoleMeta::where('role_id', '=', $role->id)->first()->long }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"><span class="badge badge-info">Permissions assigned</span></div>
                                <div class="col-md-10">
                                    <div class="row mx-auto">
                                        @if(isset($role->permissions) && !$role->permissions->isEmpty())
                                            @foreach($role->permissions as $permission)
                                        <div class="badge badge-pill badge-dark m-1">{{ $permission->name }}</div>
                                            @endforeach
                                        @else
                                        <div class="badge badge-pill badge-dark m-1">None just yet.</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
