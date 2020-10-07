@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Roles</div>

                        <div class="float-right">
                            <a href="{{ route('role.create') }}" class="oi oi-plus" data-toggle="tooltip" title="Create Role"></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row mx-auto">
                        @if(isset($roles) && !$roles->isEmpty())
                            @foreach($roles as $role)
                                <div class="card" style="width: 18rem; margin:2px;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $role->name }}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $role->guard_name }}</h6>
{{--                                        @if($role->permissions != null && !$role->permissions->isEmpty())<p class="card-text">Roles: {{ implode(", ", $role->permissions->pluck('name')->toArray()) }}</p>@endif--}}
                                        @if(\App\RoleMeta::where('role_id', '=', $role->id)->first() != null)<p class="card-text">{{ \App\RoleMeta::where('role_id', '=', $role->id)->first()->description }}</p>@endif
                                        <a href="{{ route('role.show', $role->id) }}" class="card-link badge-pill badge-primary" data-toggle="tooltip" title="Show Role: {{ $role->name }}">[Show]</a>
                                        <a href="{{ route('role.edit', $role->id) }}" class="card-link badge-pill badge-warning" data-toggle="tooltip" title="Edit Role: {{ $role->name }}">[Edit]</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')

@endsection
