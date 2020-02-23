@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Update Transaction: {{ $transaction->description }}</div>

                        <div class="float-right">
                            <a href="{{ route('transaction.index') }}" class="oi oi-arrow-left" data-toggle="tooltip" title="Back"></a>
                        </div>
                    </div>

                    <div class="card-body">

                        @include('transactions.partials._form')

                    </div>
                </div>
            </div>
        </div>

        <div class="mt-2 mb-2"></div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Delete Transaction: {{ $transaction->description }}</div>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('transaction.destroy', $transaction->id)  }}" method="POST">
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
