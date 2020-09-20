@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Update Variable: {{ $variable->variable  }}</div>

                        <div class="float-right">
                            <a href="{{ route('template.show', $variable->template->id) }}" class="oi oi-arrow-left" data-toggle="tooltip" title="Back"></a>
                        </div>
                    </div>

                    <div class="card-body">

                        @include('template.variables.partials._form')

                    </div>
                </div>
            </div>
        </div>

        <div class="mt-2 mb-2"></div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Delete Variable: {{ $variable->variable }}</div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('variable.destroy', $variable->id)  }}" method="POST">
                            {{ csrf_field()  }}
                            <input type="hidden" name="_method" value="DELETE" />

                            <div class="form-group">
                                <input type="submit" class="form-control btn btn-danger" value="Delete Variable" />
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
