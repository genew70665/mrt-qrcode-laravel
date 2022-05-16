@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @can('isAdmin')
                            <div class="btn btn-success btn-lg">
                                You have Admin Access
                            </div>
                        @elsecan('isManager')
                            <div class="btn btn-primary btn-lg">
                                You have Manager Access
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection