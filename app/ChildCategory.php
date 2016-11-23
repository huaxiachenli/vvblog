<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{

    protected $fillable=['user_id','name','category_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function articles(){
        return $this->hasMany(Article::class);
    }
}
