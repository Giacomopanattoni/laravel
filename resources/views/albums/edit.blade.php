@extends('templates.default')

@section('title','Edit album')


@section('body')

<form action="/albums/{{$album->id}}" method="POST">

    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PATCH">

    <div class="form-group">
        <label for="">Name</label>
        <input type="text" name="album_name" value="{{$album->album_name}}" class="form-control">
    </div>

    <div class="form-group">
        <label for="">Description</label>
        <textarea type="text" name="description" class="form-control">{{$album->description}}</textarea>
    </div>

    <button class="btn btn-primary">submit</button>

</form>
    
    
@endsection

