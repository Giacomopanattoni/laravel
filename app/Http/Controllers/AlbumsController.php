<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumRequest;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AlbumsController extends Controller
{

    /* 
    * show all albums
    */

    public function index(Request $request)
    {  // metodo nel quale viene iniettata la request get della pagina albums  es: sito/album?id=1

        //$sql = 'select * from albums WHERE 1=1 ';
        
        /* $where = [];

        if ($request->has('id')) {
            $where['id'] =  $request->get('id');
            $sql .= ' AND id=:id';
        }

        if ($request->has('album_name')) {
            $where['album_name'] = $request->get('album_name');
            $sql .= ' AND album_name=:album_name';
        }
        $sql .= ' ORDER BY id desc';

        $albums = DB::select($sql, array_values($where));
        return view('albums.albums', ['albums' => $albums]); */

        $queryBuilder = Album::orderBy('id','DESC')->withCount('photos');  // metodo photos dichiarato in Album.php
        
        if($request->has('id')){
            $queryBuilder->where('id','=', $request->get('id'));
        }

        if($request->has('album_name')){
            $queryBuilder->where('album_name','like', '%'.$request->get('album_name').'%');
        }
        return view('albums.albums', [
            'albums' => $queryBuilder->get()
            ]);
    }


    /* 
    * delete album by id
    */

    public function delete(Album $album)  // variabile album uguale a quella che c'è mella rotta delete vedi \routes\web.php
    {

        //return Album::where('id',$id)->delete();

        
        /* $sql = 'DELETE from albums WHERE id= :id';
        return DB::delete($sql, ['id' => $id]); */
        //return redirect()->back();

        //return ''.Album::find($id)->delete();
        $thumbnail = $album->album_thumb;

        
        $res = $album->delete();

        if($res){

            if($thumbnail && Storage::disk('public')->has($thumbnail)){
                Storage::disk('public')->delete($thumbnail);
            }

        }

        return '' . $res;

    }


    /* 
    * show album by id
    */

    public function show($id)
    {
        return Album::where('id',$id)->get();
        /* $sql = 'SELECT * from albums WHERE id= :id';
        return DB::select($sql, ['id' => $id]); */
        //return redirect()->back();

    }

    /* 
    * edit album by id
    */

    public function edit($id)
    {

        /* $sql = 'SELECT * from albums WHERE id=:id';

        $album = DB::select($sql, ['id' => $id]); */
        //$album = Album::where('id',$id)->get();
        $album = Album::find($id);
        
        //return view('albums.edit', ['album' => $album[0]]);
        return view('albums.edit', ['album' => $album]);
        //return redirect()->back();

    }


    /* 
    * edit album by id
    */

    public function store($id , AlbumRequest $request)
    {
        /* $data = request()->only(['album_name', 'description']);
        $data['id']=$id;
        $sql = 'UPDATE albums SET album_name=:album_name, description=:description';
        $sql.= ' WHERE id=:id';
        $res = DB::update($sql, $data);
        $messaggio = $res ? 'Album Aggiornato' : 'Album non aggiornato';
        session()->flash('message',$messaggio);  // setta una variabile di sessione solo per un ricarica della pagina
        return redirect()->route('albums'); */

        /* $data = request()->only(['album_name', 'description']);
        $data['id']=$id;
        $res = Album::where('id',$id)->update([
            'album_name' => $data['album_name'],
            'description' => $data['description']
        ]); */

        //dd(request()->input('album_thumb'));
        
        $album = Album::find($id);
        $album->album_name = request()->input('album_name');
        $album->description = request()->input('description');
        if($request->hasFile('album_thumb')){
            $file = $request->file('album_thumb');
            //$fileName = $file->store(env('ALBUM_THUMB_DIR'));
            $fileName = $file->storeAs(env('ALBUM_THUMB_DIR'), $id.'.'.$file->extension() );
            $album->album_thumb = $fileName;
        }
        $res = $album->save();


        $messaggio = $res ? 'Album Aggiornato' : 'Album non aggiornato';
        session()->flash('message',$messaggio);  // setta una variabile di sessione solo per un ricarica della pagina
        return redirect()->route('albums');
    }



    /*  
    * create album
    */

    public function create()
    {
        return view('albums.create');

    }

    public function save(AlbumRequest $request)
    {
        
        /* $data = request()->only('album_name','description');
        $data['user_id'] = 1; */
        /* $sql = 'INSERT INTO albums ( album_name, description, user_id)';
        $sql .= ' VALUES(:album_name, :description, :user_id)';
        $res = DB::insert($sql, $data); */
        
        
        /* $res = Album::create([
            'album_name' => $data['album_name'],
            'description' => $data['description'],
            'user_id' => 1,
        ]); */

        $album = new Album();
        $album->album_name = request()->input('album_name');
        $album->description = request()->input('description');
        $album->album_thumb = '';
        /* if($request->hasFile('album_thumb')){
            $file = $request->file('album_thumb');
            $fileUrl = $file->storeAs(env('ALBUM_THUMB_DIR'),$album->id.$file->extension());
            $album->album_thumb = env('ALBUM_THUMB_DIR').$album->id;
        } */
        
        $album->user_id = 1;
        $res = $album->save();
        if($res  && $request->hasFile('album_thumb') && $request->file('album_thumb')->isValid()){
            
            $file = $request->file('album_thumb');
            $fileName = $file->storeAs(env('ALBUM_THUMB_DIR'), $album->id.'.'.$file->extension() );
            $album->album_thumb = $fileName;
            $res = $album->save();
        }


        $messaggio = $res ? 'Album creato' : 'Album non creato';
        session()->flash('message',$messaggio);  // setta una variabile di sessione solo per un ricarica della pagina
        return redirect()->route('albums');
    }


    /*
    |--------------------------------------------------------------------------
    | getImages
    |--------------------------------------------------------------------------
    |
    */

    public function getImages(Album $album){
        $images = Photo::where('album_id',$album->id)->paginate(10);
        return view('images.images',[
            'album' => $album,
            'images' => $images
        ]);

    }

}
