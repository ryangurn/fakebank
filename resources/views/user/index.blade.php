@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Users</div>

                        <div class="float-right">
                            <a href="{{ route('user.create') }}" class="oi oi-plus" data-toggle="tooltip" title="Create User"></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th>{{ __('User') }}</th>
                                <th>{{ __('Verified') }}</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!$users->isEmpty())
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <img width="50px" src="{{ Gravatar::get($user->email) }}" class="rounded-circle float-left">
                                            <div class="float-left" style="padding-left:10px;">
                                                <span class="badge bg-dark text-light">
                                                {{ $user->name }}
                                                </span>
                                                <br />
                                                <span class="badge bg-dark text-light">
                                                {{ $user->email }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                        @if($user->hasVerifiedEmail())
                                            <span class="badge badge-success"><i class="oi oi-check"></i>Verified</span>
                                        @else
                                            <span class="badge badge-danger"><i class="oi io-x"></i>Not Verified</span>
                                        @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('user.show', $user->id) }}" class="badge-pill badge-primary" data-toggle="tooltip" title="Show User">[Show]</a>
                                            <a href="{{ route('user.edit', $user->id) }}" class="badge-pill badge-warning" data-toggle="tooltip" title="Edit User">[Edit]</a>
{{--                                            <a href="#" class="badge-pill badge-danger" data-backdrop="true" data-toggle="modal" data-target="#activity_template_{{ $template->id }}" data-toggle="tooltip" title="Activity Log">[Logs]</a>--}}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3">{{ __('None Configured') }}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')

@endsection
