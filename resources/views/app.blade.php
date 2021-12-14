@extends('layouts.layout')
@section('title', 'Todo List')
@section('content')
    <h1 class="title">ToDo List</h1> 
    <form action="{{ url('todo') }}" method="POST" class="action-form">
        @csrf
        <div class="form-group d-flex gap-3 ">
            <input type="text" id="myInput" name="title" placeholder="Task..." class="form-control"> 
            <button type='submit' class="btn btn-success">Create</button>
        </div>
    </form>
    <table class="styled-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Task</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($data as $todo )
                <tr>
                    <td>{{ $todo->id }}</td>
                    <td style="text-decoration: {{ $todo->completed === 1 ? "line-through" : "none" }}">{{ $todo->title }}</td>
                    <td>
                        <form action="{{  url('todo/'.$todo->id)}}" method="POST">
                            @csrf
                            @method("PUT")
                            
                            @if ($todo->completed)
                                <button type="submit" class="btn btn-success"><i class="fa-solid fa-check"></i></button>
                            @elseif (!$todo->completed)
                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-x"></i></button>
                            @endif
                        </form>
                    <td>
                        <form action="{{ url("todo/".$todo->id) }}" method="POST">
                            @csrf 
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                        
                    </td>
                </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex gap-5">
        <a class="btn btn-success mb-2 mt-2" href="{{ url('/delete_completed') }}">Remove Completed Tasks <i class="fa-solid fa-trash text-danger"></i></a>
    </div>
@endsection
        
