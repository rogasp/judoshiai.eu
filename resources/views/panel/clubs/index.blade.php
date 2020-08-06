@extends('layouts.app')
@inject('countries','App\Http\Utilities\Country')


<!-- $countries::all() -->
@section('content')
    <h1>List of clubs you are involved with</h1>
    <a class="btn btn-success mb-3" href="#">Create</a>
    @empty($clubs)
        <div class="alert alert-warning">
            The list of clubs is empty
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-light">
                <th>Id</th>
                <th>Name</th>
                <th>City</th>
                <th>Country</th>
                <th>Status</th>
                <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($clubs as $club)
                        <tr>
                            <td>{{ $club->id }}</td>
                            <td>{{ $club->name }}</td>
                            <td></td>
                            <td>{{ $countries::get($club->country_code) }}</td>
                            <td></td>
                            <td>
                                <a class="btn btn-link" href="#">Show</a>
                                <a class="btn btn-link" href="#">Edit</a>
                                <form class="d-inline" method="POST" action="#">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link">Delete</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endempty
@endsection
