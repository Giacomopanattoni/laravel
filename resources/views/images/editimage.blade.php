@extends('templates.default')

@section('title','Edit Image')

@section('body')

<form action="{{ route('photos.update',$photo->id)}}" method="POST" enctype="multipart/form-data">

    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PATCH">
    {{ method_field('PATCH')}}
    <div class="form-group">
        <label for="">Name</label>
        <input type="text" name="name" value="{{$photo->name}}" class="form-control">
    </div>

    @if($photo->img_path)
        {{-- <div class="form-group">
            <img src="{{$photo->img_path}}">
        </div> --}}
        {{$photo->img_path}}
    @endif
    <input type="hidden" name="album_id" value="{{$photo->album_id}}">
    <div class="form-group">
        <label for="">Thumbnail</label>
        <input type="file" name="img_path"  class="form-control">
    </div>

    <div class="form-group">
        <label for="">Description</label>
        <textarea type="text" name="description" class="form-control">{{$photo->description}}</textarea>
    </div>

    <button class="btn btn-primary">submit</button>

</form>
    
    
@endsection