@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Permission: {{ $permission->name }}</div>

                        <div class="float-right">
                            <a href="{{ route('permission.index') }}" class="oi oi-arrow-left" data-toggle="tooltip" title="Back"></a>
                        </div>
                    </div>

                    <div class="card-body">
                        @if($permission->roles != null && !$permission->roles->isEmpty())
                        <div class="row">
                            <div class="col-md-2"><span class="badge badge-primary">Assigned to roles</span></div>
                            <div class="col-md-10">{{ implode(", ", $permission->roles->pluck('name')->toArray()) }}</div>
                        </div>
                        @endif
                        @if(\App\PermissionMeta::where('permission_id', '=', $permission->id)->first() != null)
                            <div class="row">
                                <div class="col-md-2"><span class="badge badge-primary">Description</span></div>
                                <div class="col-md-10">{{ \App\PermissionMeta::where('permission_id', '=', $permission->id)->first()->description }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
