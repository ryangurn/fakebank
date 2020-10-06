@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Permissions</div>

                        <div class="float-right">
                            <a href="{{ route('permission.create') }}" class="oi oi-plus" data-toggle="tooltip" title="Create Bank"></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row mx-auto">
                        @if(isset($permissions) && !$permissions->isEmpty())
                            @foreach($permissions as $permission)
                                <div class="card" style="width: 18rem; margin:2px;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $permission->name }}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $permission->guard_name }}</h6>
                                        @if($permission->roles != null && !$permission->roles->isEmpty())<p class="card-text">Roles: {{ implode(",", $permission->roles->pluck('name')->toArray()) }}</p>@endif
{{--                                        <a href="#" class="card-link">Card link</a>--}}
{{--                                        <a href="#" class="card-link">Another link</a>--}}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        </div>
{{--                        <table class="table table-condensed">--}}
{{--                            <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>{{ __('Name') }}</th>--}}
{{--                                    <th>{{ __('Caption') }}</th>--}}
{{--                                    <th>{{ __('Active')  }}</th>--}}
{{--                                    <th>Actions</th>--}}
{{--                                </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @if(isset($banks) && !$banks->isEmpty())--}}
{{--                                @foreach($banks as $bank)--}}
{{--                                <tr>--}}
{{--                                    <td>{{ $bank->name  }}</td>--}}
{{--                                    <td>{{ $bank->caption  }}</td>--}}
{{--                                    <td>{!!  $bank->settings['status'] == true ? '<span class="badge badge-pill badge-success">Enabled</span>' : '<span class="badge badge-pill badge-danger">Disabled</span>'   !!}</td>--}}
{{--                                    <td>--}}
{{--                                        <a href="{{ route('bank.show', $bank->id) }}" class="badge-pill badge-primary" data-toggle="tooltip" title="Show Bank: {{ $bank->name }}">[Show]</a>--}}
{{--                                        <a href="{{ route('bank.edit', $bank->id) }}" class="badge-pill badge-warning" data-toggle="tooltip" title="Edit Bank: {{ $bank->name }}">[Edit]</a>--}}
{{--                                        <a href="#" class="badge-pill badge-danger" data-backdrop="true" data-toggle="modal" data-target="#activity_bank_{{ $bank->id }}" data-toggle="tooltip" title="Activity Log">[Logs]</a>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                @endforeach--}}
{{--                            @else--}}
{{--                                <tr>--}}
{{--                                    <td colspan="3">{{ __('None Configured') }}</td>--}}
{{--                                </tr>--}}
{{--                            @endif--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')

@endsection
