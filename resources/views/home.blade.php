@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Todo's</div>
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
                    @else
                        <div class="btn btn-info btn-lg">
                            You have User Access
                        </div>
                    @endcan
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Title</th>
                                    @can('isAdmin')
                                        <th>Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    @can('isAdmin')
                                        <td>
                                            <button class="btn btn-sm btn-success">Edit</button>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </td>
                                    @endcan
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
