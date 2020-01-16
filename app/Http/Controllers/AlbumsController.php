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

    public function index(Request $request){  // metodo nel quale viene iniettata la request get della pagina albums  es: sito/album?id=1
        
        $sql = 'select * from albums WHERE 1=1 ';
        $where = [];

        if($request->has('id')){
            $where['id'] =  $request->get('id');
            $sql.= ' AND id=:id';
        }

        if($request->has('album_name')){
            $where['album_name'] = $request->get('album_name');
            $sql.= ' AND album_name=:album_name';
        }

        $albums = DB::select($sql,array_values($where));
        return view('albums',['albums' => $albums ]) ;
    }


    /* 
    * delete album by id
    */

    public function delete($id){

        $sql = 'DELETE from albums WHERE id= :id';
        return DB::delete($sql, ['id' => $id]);
        //return redirect()->back();

    }
}
