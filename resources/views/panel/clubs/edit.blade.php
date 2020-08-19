@extends('layouts.app')
@inject('countries','App\Http\Utilities\Country')
@section('content')
    <h1>Create a club</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('clubs.update', ['club' => $club->id]) }}">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-6">
                <div class="form-row">
                    <label for="name">Name</label>
                    <input id="name" class="form-control" type="text" name="name" value="{{ old('name') ?? $club->name }}" required>
                </div>
                <div class="form-row">
                    <label for="city">City</label>
                    <input id="city" class="form-control" type="text" name="city" value="{{ old('city') ?? $club->city }}">
                </div>
                <div class="form-row">
                    <label for="country">Country</label>
                    <select id="country" class="custom-select" name="country_code">
                        <option value="" selected>Select...</option>
                        @foreach($countries::all() as $code => $country)
                            <option value="{{ $code }}" {{ old('country_code') == $code ? 'selected' :
                                ($club->country_code == $code ? 'selected' : '') }}>{{ $country }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-row">
                    <label for="phone">Phone</label>
                    <input id="phone" class="form-control" type="text" name="phone" value="{{ old('phone') ?? $club->phone }}">
                </div>
                <div class="form-row">
                    <label for="email">E-Mail</label>
                    <input id="email" class="form-control" type="text" name="email" value="{{ old('email') ?? $club->email }}">
                </div>
                <div class="form-row">
                    <label for="owner">Owner</label>
                    <input id="owner" class="form-control" type="text" value="{{ Auth::user()->name }}" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-row">
                    <button class="btn btn-primary btn-lg mt-3" type="submit">Update club</button>
                </div>
            </div>
        </div>
    </form>
@endsection
