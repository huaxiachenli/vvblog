<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    //
    protected $fillable = ['name','pictureable_id','pictureable_type','field','url','user_id'];

    public function pictureable()
    {
        return $this->morphTo();
    }

}
