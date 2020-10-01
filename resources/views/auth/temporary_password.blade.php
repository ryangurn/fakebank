@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Provide Your New Password') }}</div>

                <div class="card-body">
                    <p>Your current password is temporary, please provide your old password and then setup a new one for yourself.</p>
                    <form action="{{ route('auth.change') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="old_password">Old Password</label>
                            <input name="old_password" id="old_password" class="form-control" placeholder="Old Password" />
                        </div>

                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input name="new_password" id="new_password" class="form-control" placeholder="New Password" />
                        </div>

                        <div class="form-group">
                            <label for="new_password_confirmation">New Password Confirmation</label>
                            <input name="new_password_confirmation" id="new_password_confirmation" class="form-control" placeholder="New Password Confirmation" />
                        </div>

                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-success" value="Change Password" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
