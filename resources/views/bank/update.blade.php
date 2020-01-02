@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Update Bank: {{ $bank->name }}</div>

                        <div class="float-right">
                            <a href="{{ route('bank.index') }}" class="oi oi-arrow-left" data-toggle="tooltip" title="Back"></a>
                        </div>
                    </div>

                    <div class="card-body">

                        @include('bank.partials._form')

                    </div>
                </div>
            </div>
        </div>

        <div class="mt-2 mb-2"></div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Change Bank Status: {{ $bank->name }}</div>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('bank.status', $bank->id)  }}" method="POST">
                            {{ csrf_field()  }}

                            <div class="form-group">
                                <select name="operation" class="form-control">
                                    <option value="disable">Disable</option>
                                    <option value="enable">Enable</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="form-control btn btn-warning" value="Change Bank Status" />
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
                        <div class="float-left">Delete Bank: {{ $bank->name }}</div>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('bank.destroy', $bank->id)  }}" method="POST">
                            {{ csrf_field()  }}
                            <input type="hidden" name="_method" value="DELETE" />

                            <div class="form-group">
                                <input type="submit" class="form-control btn btn-danger" value="Delete Bank" />
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
