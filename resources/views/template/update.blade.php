@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Update Template for {{ $template->bank->name }}</div>

                        <div class="float-right">
                            <a href="{{ url()->previous() }}" class="oi oi-arrow-left" data-toggle="tooltip" title="Back"></a>
                        </div>
                    </div>

                    <div class="card-body">

                        @include('template.partials._form')

                    </div>
                </div>
            </div>
        </div>

        <div class="mt-2 mb-2"></div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Delete Template for {{ $template->bank->name }}</div>
                    </div>

                    <div class="card-body">

                        <div class="alert alert-danger">This action is action will destroy the template and all associated variables stored, <b>this action cannot be undone</b>. Your resource files will <b>not</b> be touched.</div>

                        <form action="{{ route('template.destroy', $template->id)  }}" method="POST">
                            {{ csrf_field()  }}
                            <input type="hidden" name="_method" value="DELETE" />

                            <div class="form-group">
                                <input type="submit" class="form-control btn btn-danger" value="Delete Template" />
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
