@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Create Account</div>

                        <div class="float-right">
                            <a href="{{ route('account.index') }}" class="oi oi-arrow-left" data-toggle="tooltip" title="Back"></a>
                        </div>
                    </div>

                    <div class="card-body">

                        @include('account.partials._form')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
