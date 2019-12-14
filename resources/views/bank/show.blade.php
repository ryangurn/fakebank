@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Bank: {{ $bank->name }}</div>

                        <div class="float-right">
                            <a href="{{ route('bank.index') }}" class="oi oi-arrow-left" data-toggle="tooltip" title="Back"></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <p>
                            <div class="row">
                                <div class="col-md-2"><span class="badge badge-primary">Caption</span></div>
                                <div class="col-md-10">{{ $bank->caption }}</div>
                            </div>
                            @if($bank->settings != null)
                            <div class="row">
                                <div class="col-md-2"><span class="badge badge-danger">Settings</span></div>
                                <div class="col-md-10"><pre>{{ json_encode($bank->settings)  }}</pre></div>
                            </div>
                            <br />
                            @endif
                            @if($bank->trolls != null)
                            <div class="row">
                                <span class="col-md-2 badge badge-warning">Troll Configurations</span>
                                <pre class="col-md-10">{{ json_encode($bank->trolls)  }}</pre>
                            </div>
                            <br />
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
