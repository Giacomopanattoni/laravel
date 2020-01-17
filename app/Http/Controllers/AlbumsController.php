<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlbumsController extends Controller
{

    /* 
    * show all albums
    */

    public function index(Request $request)
    {  // metodo nel quale viene iniettata la request get della pagina albums  es: sito/album?id=1

        $sql = 'select * from albums WHERE 1=1 ';
        $where = [];

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
        return view('albums.albums', ['albums' => $albums]);
    }


    /* 
    * delete album by id
    */

    public function delete($id)
    {

        $sql = 'DELETE from albums WHERE id= :id';
        return DB::delete($sql, ['id' => $id]);
        //return redirect()->back();

    }


    /* 
    * show album by id
    */

    public function show($id)
    {

        $sql = 'SELECT * from albums WHERE id= :id';
        return DB::select($sql, ['id' => $id]);
        //return redirect()->back();

    }

    /* 
    * edit album by id
    */

    public function edit($id)
    {

        $sql = 'SELECT * from albums WHERE id=:id';

        $album = DB::select($sql, ['id' => $id]);

        return view('albums.edit', ['album' => $album[0]]);
        //return redirect()->back();

    }


    /* 
    * edit album by id
    */

    public function store($id , Request $request)
    {
        $data = request()->only(['album_name', 'description']);
        $data['id']=$id;
        $sql = 'UPDATE albums SET album_name=:album_name, description=:description';
        $sql.= ' WHERE id=:id';
        $res = DB::update($sql, $data);
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

    public function save(Request $request)
    {
        
        $data = request()->only('album_name','description');
        $data['user_id'] = 1;
        $sql = 'INSERT INTO albums ( album_name, description, user_id)';
        $sql .= ' VALUES(:album_name, :description, :user_id)';
        $res = DB::insert($sql, $data);
        $messaggio = $res ? 'Album creato' : 'Album non creato';
        session()->flash('message',$messaggio);  // setta una variabile di sessione solo per un ricarica della pagina
        return redirect()->route('albums');

    }
}
