<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlbumRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }




     /* 
     * regole per validare il form iniettate con il typehinting in album controller (AlbumRequest $request)
     * si puo fare anche con il metodo $this->validate() come in photos
     */
    public function rules()
    {
        return [
        'album_name' => 'required|unique:albums,album_name',
        'description' => 'required',
        'album_thumb' => 'required|image',
        /* 'user_id' => 'required' */
        ];
    }


    public function messages(){
         return [
            'album_name.required' => 'il nome dell\'album è obbligatorio'
        ];
    }
}
