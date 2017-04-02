<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use cebe\markdown\GithubMarkdown;
class Article extends Model
{
    //
    protected $fillable = [
        'title', 'content', 'user_id','child_category_id','category_id','intro','logo'
    ];

    public function pictures()
    {
        return $this->morphMany(Picture::class,'pictureable');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withPivot('user_id')->withTimestamps();
    }

    public function likeables(){
        return $this->hasMany(Likeable::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function childCategory(){
        return $this->belongsTo(ChildCategory::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function collected_users()
    {
        return $this->belongsToMany(User::class,'collects');
    }

    public function getTagListAttribute(){
        return $this->tags->pluck('id')->all();
    }

    public function getParseContentAttribute()
    {
        $parse = new GithubMarkdown();
        return $parse->parse( $this->content );
    }




}
