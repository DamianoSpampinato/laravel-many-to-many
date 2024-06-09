@extends('layouts.admin')

@section('content')
@if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach

            </ul>
            @endif
    <form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="my-2">
            <input class="w-25" type="text" placeholder="inserisci name" name="name">
        </div>
        <div class="my-2">
            <input class="w-25" type="text" placeholder="inserisci client name" name="client_name">
        </div>
        <div class="my-2">
            <input class="w-25" type="textarea" placeholder="inserisci summary" name="summary">
        </div>
        <div>
            <input type="file" name="img" id="img">
        </div>
        <div>
            <select class="form-select" id="type_id" name="type_id">
            <option value="">Selectiona Type</option>
                @foreach ($types as $type)
                    <option @selected($type->id == old('type_id')) value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary" type="submit">salva</button>
    </form>
@endsection