@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Update User: {{ $user->name }}</div>

                        <div class="float-right">
                            <a href="{{ route('user.index') }}" class="oi oi-arrow-left" data-toggle="tooltip" title="Back"></a>
                        </div>
                    </div>

                    <div class="card-body">

                        @include('user.partials._form')

                    </div>
                </div>
            </div>
        </div>

        <div class="mt-2 mb-2"></div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Send Temporary Password to {{ $user->name }}</div>

                    <div class="card-body">
                        <form action="{{ route('user.reset', $user->id) }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT" />

                            <div class="form-group">
                                <input type="submit" class="form-control btn btn-success" value="Send temporary password" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-2 mb-2"></div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Delete User: {{ $user->name }}</div>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('user.destroy', $user->id)  }}" method="POST">
                            {{ csrf_field()  }}
                            <input type="hidden" name="_method" value="DELETE" />

                            <div class="form-group">
                                <input type="submit" class="form-control btn btn-danger" value="Delete User" />
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
