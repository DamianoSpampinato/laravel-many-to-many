@extends('layouts.admin')
@section('content')
<a class="btn btn-primary" href="{{route('admin.projects.create')}}">create</a>
<div class="row">
<div class="col-1"><strong>id</strong></div>
    <div class="col-4"><strong>name</strong></div>
    <div class="col-3"><strong>created</strong></div>
    <div class="col"><strong>slug</strong></div>
</div>
    @foreach ($projects as $project)
    <div class="row border my-2">
        <div class="col-1">{{$project->id}}</div>
        <div class="col-4">{{$project->name}}</div>
        <div class="col-3">{{ $project->created_at }}</div>
        <div class="col">{{ $project->slug }}</div>
        <div class="col">
            <a href="{{route('admin.projects.show', ['project'=> $project->id])}}">view</a>
            <a href="{{route('admin.projects.edit', ['project'=> $project->id])}}">edit</a>
            <form action="{{route('admin.projects.destroy', ['project'=>$project->id])}}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>
        </div>
        
    </div>
    @endforeach 
    

@endsection