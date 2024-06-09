@extends('layouts.admin')

@section('content')
<h1>{{$project['name']}}</h1>
<p><strong>Summary</strong>: {{$project['summary']}}</p>
@isset($project['img'])
<img src="{{asset('storage/' .$project['img'])}}" alt="">
    
@endisset
    

<div><strong>Slug</strong>: {{$project['slug']}}</div>
<div><strong>Client Name</strong>: {{$project['client_name']}}</div>
<div><strong>Id project</strong>: {{$project['id']}}</div>
<div><strong>Type</strong>: {{ $project->type ? $project->type->name : 'No Type' }}</div>
<div>
    <strong>Technologies</strong>:
    @if (count($project->technologies)> 0)
        @foreach ($project->technologies as $technology)
            {{$technology->name}}@if (!$loop->last),@endif
        @endforeach
    @else
    No Technologies
    @endif 
</div>
<a class="btn btn-primary" href="{{route('admin.projects.edit', ['project'=> $project->id])}}">edit</a>


@endsection