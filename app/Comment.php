<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use cebe\markdown\GithubMarkdown;

class Comment extends Model
{
    //
    protected $fillable=['user_id','article_id','parent_id','content','floor'];
    public function article(){
        return $this->belongsTo(Article::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function getContentAttribute($value)
    {
        $parse = new GithubMarkdown();
        return $parse->parse($value);
    }
}
