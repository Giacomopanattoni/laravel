@extends('templates.default')

@section('title','Albums')


@section('body')


    {{-- stampo la variabile di sessione settata in albumsController@store --}}
    @if( session()->has('message') )
        <div class="mt-5 alert alert-info">{{ session()->get('message') }}</div>
    @endif

    

    
    <input type="hidden" value="{{ csrf_token() }}" id="_token">
    <ul class="mt-5 pl-0">

    @foreach ($albums as $album)

    <li class="list-group-item d-flex justify-content-between">
        
        @if($album->album_thumb)
            <div class="form-group">
            <img src="{{$album->path}}">
            </div>
        @endif

        {{$album->id}} 
        {{$album->album_name}} 
        

        <div>
            @if ($album->photos_count)
                <a href="/albums/{{$album->id}}/images" class="btn btn-success">({{$album->photos_count}})View images</a>

            @endif
            <a href="/albums/{{$album->id}}" class="btn btn-danger">Elimina album</a>
            <a href="/albums/{{$album->id}}/edit" class="btn btn-success">Aggiorna album</a>
        <a href="{{ route('photos.create') }}/?album_id={{ $album->id }}" class="btn btn-success">+</a>
        </div>
    </li>
        
    @endforeach

    </ul>
    
@endsection


@section('footer')

    @parent

    <script>

        jQuery(document).ready(function(){
            jQuery('ul').on('click','a.btn-danger', function(e){
                e.preventDefault();
                let url = jQuery(this).attr('href');
                let parent = jQuery(this).parents('li');
                $.ajax(url,{


                    method : 'DELETE',

                    data : {
                        _token : jQuery('#_token').val()
                    },

                    complete : function(res){
                        if(res.responseText == true){
                            parent.remove();
                        }else{
                            alert('problemi a contattare il server');
                        }
                    }
                })
            });
        });

    </script>
    
@endsection