@extends('layouts.app')

@section('content')
    <div class="container mt-3">
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

                        {{ __('You are logged in to admin!') }}
                        <div class="list-group">
                            <a class="list-group-item" href="{{ route('clubs.index') }}">
                                Manage Clubs
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
