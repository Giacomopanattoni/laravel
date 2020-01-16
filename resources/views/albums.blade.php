@extends('templates.default')

@section('title','Albums')


@section('body')

    <ul class="mt-5">

    @foreach ($albums as $album)

    <li class="list-group-item d-flex justify-content-between">
        {{$album->album_name}} 
        <a href="/albums/{{$album->id}}/delete" class="btn btn-danger">Elimina album</a>
    </li>
        
    @endforeach

    </ul>
    
@endsection


@section('footer')

    @parent

    <script>

        jQuery(document).ready(function(){
            jQuery('ul').on('click','a', function(e){
                e.preventDefault();
                let url = jQuery(this).attr('href');
                let parent = jQuery(this).parents('li');
                $.ajax(url,{
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