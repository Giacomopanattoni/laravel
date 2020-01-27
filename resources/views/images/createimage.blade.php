@extends('templates.default')

@section('title','Insert Image')

@section('body')

<form action="{{ route('photos.store')}}" method="POST" enctype="multipart/form-data">

    {{ csrf_field() }}

    <div class="form-group">
        <label for="">Name</label>
        <input type="text" name="name"  class="form-control">
    </div>

  
<input type="hidden" name="album_id" value="{{ $photo->album_id }}" >
    <div class="form-group">
        <label for="">Thumbnail</label>
        <input type="file" name="img_path"  class="form-control">
    </div>

    <div class="form-group">
        <label for="">Description</label>
        <textarea type="text" name="description" class="form-control"></textarea>
    </div>

    <button class="btn btn-primary">submit</button>

</form>
    
    
@endsection