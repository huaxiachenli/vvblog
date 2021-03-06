<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable= ['user_id','name','parent_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function childCategories(){
        return $this->hasMany(ChildCategory::class);
    }

    public function articles(){
        return $this->hasMany(Article::class);
    }



}
