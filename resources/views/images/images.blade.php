@extends('templates.default')

@section('title',$album->album_name)
    

@section('body')



<table class="table">
    <tr>
        <th>ID</th>
        <th>CREATED TIME</th>
        <th>TITLE</th>
        <th>ALBUM</th>
        <th>THUMBNAIL</th>
    </tr>

    
@forelse ($images as $image)
    <tr>
        <td>{{$image->id}}</td>
        <td>{{$image->created_at}}</td>
        <td>{{$image->name}}</td>
        <td>{{$album->album_name}}</td>
        <td>{{$image->img_path}}</td>
        <td><a class="btn btn-danger" href="{{ route('photos.destroy', $image->id )}}">delete</a></td>
    </tr>
@empty
    <tr>
        <td>Nessuna immagine trovata</td>
    </tr>
@endforelse
</table>
    
@endsection

@section('footer')

    @parent

    <script>

        jQuery(document).ready(function(){
            jQuery('table').on('click','a.btn-danger', function(e){
                e.preventDefault();
                let url = jQuery(this).attr('href');
                let parent = jQuery(this).parents('tr');
                $.ajax(url,{


                    method : 'DELETE',

                    data : {
                        _token : '{{ csrf_token() }}'
                    },

                    complete : function(res){
                        console.log(res);
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
