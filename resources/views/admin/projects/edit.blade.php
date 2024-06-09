@extends('layouts.admin')
@section('content')
        <form action="{{route('admin.projects.update', ['project' => $project->id])}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach

            </ul>
            @endif
            <div class="my-2">
                <input class="w-25" type="text" placeholder="inserisci name" name="name" value="{{$project->name}}">
            </div>
            <div class="my-2">
                <input class="w-25" type="text" placeholder="inserisci client name" name="client_name "value="{{$project->client_name}}">
            </div>
            <div class="my-2">
                <input class="w-25" type="textarea" placeholder="inserisci summary" name="summary" value="{{$project->summary}}">
            </div>
            <div>
                <input type="file" name="img" id="img">
            </div>
            <select class="form-select" id="type_id" name="type_id">
                <option value="">Selectiona Type</option>
                    @foreach ($types as $type)
                        <option @selected($type->id == old('type_id', $project->type_id)) value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary" type="submit">salva</button>
            </div>
        </form>
    
@endsection