<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    
    public function getPathAttribute(){  // viene richiamato nella view come $album->path
        
        $url = $this->img_path;
        
        if(stristr($this->img_path,'http') == false){
            $url = '/storage/'.$url;
        }
        return $url;
    }

}
