@extends('templates.default')

@section('title','Edit album')


@section('body')

<form action="{{ route('album.save') }}" method="POST" enctype="multipart/form-data">

    {{ csrf_field() }}

    <div class="form-group">
        <label for="">Name</label>
        <input type="text" name="album_name" value="" class="form-control">
    </div>

    <div class="form-group">
        <label for="">Thumbnail</label>
        <input type="file" name="album_thumb"  class="form-control">
    </div>

    <div class="form-group">
        <label for="">Description</label>
        <textarea type="text" name="description" class="form-control"></textarea>
    </div>

    <button class="btn btn-primary">submit</button>

</form>
    
    
@endsection

