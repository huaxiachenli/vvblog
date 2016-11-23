<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function professions()
    {
        return $this->hasMany(Profession::class);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * 返回文章的多态关联，包括文章logo以及文章内容图片
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function pictures()
    {
        return $this->morphMany(Picture::class,'pictureable');
    }

    /**
     * 返回用户写过的所有的文章标签
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    /**
     * 返回用户的所有文章
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles(){
        return $this->hasMany(Article::class);
    }

    /**
     * 返回用户的所有一级分类信息
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories(){
        return $this->hasMany(Category::class);
    }

    /**
     * 返回用户所有的二级分类信息
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function child_categories(){
        return $this->hasMany(ChildCategory::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    /**
     * 返回当前用户赞过的所有文章
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function liked_articles()
    {
        return $this->belongsToMany(Article::class,'likeables');
    }

    /**
     * 查看用户是否赞过该文章，如果用户赞过该文章，则返回点赞的ID，如果没赞过该文章则返回0
     * @param $article_id
     * @return int
     */
    public function likeable($article_id){
        $likeable = Likeable::where(['user_id'=>$this->id,'article_id'=>$article_id])->first();
        if ($likeable){
            return $likeable;
        }else{
            return 0;
        }
    }

    /**
     * 查看用户是否收藏过该文章，如果收藏过，直接返回收藏表的ID,没有收藏就返回bool值false
     * @param $article_id
     * @return bool
     */
    public function collected($article_id){
        $collect = Collect::where(['user_id'=>$this->id,'article_id'=>$article_id])->first();
        if($collect){
            return $collect;
        }else{
            return false;
        }
    }

    /**
     * 返回当前用户收藏的文章
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function collected_articles()
    {
        return $this->belongsToMany(Article::class,'collects');
    }
}
