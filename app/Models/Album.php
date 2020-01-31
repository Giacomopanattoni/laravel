<?php


/* 
* Esempio di model della tabella album
*/

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Album extends Model{

/*     
protected $table = "Album";
protected $primaryKey = "id";
 */

    protected $fillable = ['album_name', 'description' , 'user_id'];


    public function getPathAttribute(){  // viene richiamato nella view come $album->path
        
        $url = $this->album_thumb;
        
        if(stristr($this->album_thumb,'http') == false){
            $url = '/storage/'.$url;
        }
        return $url;
    }

    public function photos(){
        return $this->hasMany(Photo::class, 'album_id','id'); //dichiaro che un album ha tante foto per utilizzare questo metodo in albumcontroller index
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}