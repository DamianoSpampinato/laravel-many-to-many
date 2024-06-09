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
<div><strong>Type</strong>: {{ $project->type ? $project->type->name : 'No category' }}</div>

@endsection