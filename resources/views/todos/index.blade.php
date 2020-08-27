@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Task List</div>
                <div class="card-body">
                            <!-- New Task Form -->
                                @if (count($errors) > 0)
                                    <!-- Form Error List -->
                                    <div class="alert alert-danger m-auto d-table col-md-12">
                                        <strong>Whoops! Something went wrong!</strong>

                                        <br><br>

                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <br>
                                <table class="col-md-10 m-auto d-table table table-bordered table-hover">
                                    <thead>

                                            <form  action="{{url('task/save')}}" method="POST" class="row col-md-12 col-sm-12 form-horizontal">
                                                {{ csrf_field() }}
                                            <th colspan="3">
                                                <div class="form-group">
                                                    <input placeholder="Enter A Task" type="text" name="name" id="task-name" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                <!-- Add Task Button -->
                                                <button type="submit" class="btn  btn-sm btn-primary">
                                                    <i class="fa fa-plus"></i> Add Task
                                                </button>
                                                </div>
                                            </th>
                                            </form>
                                        </tr>

                                        <tr>
                                            <th>
                                                Author
                                            </th>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                <!-- Add Task Button -->
                                                Action
                                            </th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach($tasks as $task)
                                            <tr>
                                                <td>{{$task->user}}</td>
                                                <td>
                                                    <!-- Task Name -->
                                                    <div class="">
                                                        @if($task->deleted_at == NULL)
                                                            {{$task->name}}
                                                        @else
                                                            <s>{{$task->name}}</s>
                                                        @endif
                                                    </div>
                                                </td>
                                                @can('isAdmin')
                                                <td>
                                                    <!-- Add Task Button -->
                                                    <div class="">
                                                        @php
                                                            if($task->deleted_at != NULL) {
                                                                $disable = 'disabled';
                                                                $readOnly = '';
                                                            }
                                                            else {
                                                                $disable = 'enable';
                                                                $readOnly = 'restore';
                                                            }

                                                        @endphp

                                                        <button {{$disable}}
                                                            data-toggle="modal" data-target="#taskModal{{$task->id}}" type="submit" class="btn btn-sm btn-success">
                                                            <i class="fa fa-plus"></i> Edit
                                                        </button>
                                                        <a class="btn btn-sm btn-danger" onclick="return myFunction();" href="{{url('task/delete/'.$task->id)}}">
                                                            <i class="fa fa-plus"></i> Delete
                                                        </a>
                                                        <a class="{{$readOnly}} btn btn-sm btn-secondary" href="{{url('task/restore/'.$task->id)}}">
                                                            <i class="fa fa-plus"></i> Restore
                                                        </a>

                                                    </div>
                                                </td>
                                                @else
                                                <td>User can not take any action</td>
                                                @endcan
                                            </tr>

                                            <!-- Modal -->
                                            <div class="modal fade" id="taskModal{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update Task</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form  action="{{url('task/update')}}" method="POST" class="row col-md-12 col-sm-12 form-horizontal">
                                                        {{ csrf_field() }}
                                                            <input type="hidden" type="text" name="id" value="{{$task->id}}" class="form-control">
                                                            <div class="form-group">
                                                                <input placeholder="Update Task" type="text" name="name" value="{{$task->name}}" id="task-name" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <!-- Add Task Button -->
                                                                <button type="submit" class="btn  btn-sm btn-primary">
                                                                    <i class="fa fa-plus"></i> Update
                                                                </button>
                                                            </div>

                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                </div>
            </div>
        </div>
</div>

@endsection
