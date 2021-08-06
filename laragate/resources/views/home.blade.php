@extends('layouts.app')

@section('title', "Home")
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @can('isAdmin')
                        <button class="btn btn-sm btn-success">Admin</button>
                    @elsecan('isManager')
                        <button class="btn btn-sm btn-success">Manager</button>
                    @else
                        <button class="btn btn-sm btn-success">User</button>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
