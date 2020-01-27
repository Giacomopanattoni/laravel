<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     protected $rules = [
        'album_id' => 'required|digits:100|exists:album',
        'name' => 'required|unique:photos:name',
        'description' => 'required',
        'img_path' => 'required|image'
     ];

     protected $messages = [
         'album_id.required' => 'Il campo album è obbligatorio' ,
         'name.required' => 'Il campo nome è obbligatorio' ,
     ];

    public function index()
    {
        return Photo::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        if($req->has('album_id')){
            $photo = new Photo();
            $photo->album_id = $req->get('album_id');
            
            return view('images.createimage',array('photo' => $photo));
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Photo $photo)
    {
        $this->validate($request,$this->rules,$this->messages);
        
        $photo->name = $request->input('name');
        $photo->description = $request->input('description');
        $photo->album_id = $request->input('album_id');
        $photo->img_path = '';
        $photo->save();
        if($request->hasFile('img_path')){
            $file = $request->file('img_path');
            $fileName = $file->storeAs(env('IMG_DIR').$photo->album_id, $photo->id.'.'.$file->extension() );
            $photo->img_path = $fileName;
        }
        $res = $photo->save();
        if($res){
            return redirect(route('album.getImages',$photo->album_id));
        }
        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        return $photo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        return view('images.editimage',['photo' => $photo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //dd($request->only('name','description','img_path'));
       
        $this->validate($request,$this->rules,$this->messages);

        $photo->name = request()->input('name');
        $photo->description = request()->input('description');

        if($request->hasFile('img_path')){
            $file = $request->file('img_path');
            $fileName = $file->storeAs(env('IMG_DIR').$photo->album_id, $photo->id.'.'.$file->extension() );
            $photo->img_path = $fileName;
        }

        $res = $photo->save();
        $messaggio = $res ? 'Immagine Aggiornata' : 'Immagine non aggiornata';
        session()->flash('message',$messaggio);  // setta una variabile di sessione solo per un ricarica della pagina
        return redirect()->route('album.getImages',$photo->album_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        //dd($id);

        $thumbnail = $photo->img_path;
        $res = $photo->delete();
        if($res){

            if($thumbnail && Storage::disk('public')->has($thumbnail)){
                Storage::disk('public')->delete($thumbnail);
            }
            return 'true';

        }
        return 'false';
        
    }
}
