@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Permissions</div>
                    </div>

                    <div class="card-body">
                        <div class="row mx-auto">
                        @if(isset($permissions) && !$permissions->isEmpty())
                            @foreach($permissions as $permission)
                                <div class="card" style="width: 18rem; margin:2px;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $permission->name }}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $permission->guard_name }}</h6>
                                        @if($permission->roles != null && !$permission->roles->isEmpty())<p class="card-text">Roles: {{ implode(", ", $permission->roles->pluck('name')->toArray()) }}</p>@endif
                                        <a href="{{ route('permission.show', $permission->id) }}" class="card-link badge-pill badge-primary" data-toggle="tooltip" title="Show Permission: {{ $permission->name }}">[Show]</a>
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
