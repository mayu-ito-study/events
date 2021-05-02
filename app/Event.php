<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['content'];
    protected $dates = ['date', 'created_at', 'updated_at',];

    /**
     * この投稿を所有するユーザ。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function favorite_users()
     {
         return $this->belongsToMany(User::class, 'favorites', 'event_id', 'user_id')->withTimestamps();
     }
     
    /**
     * このイベントが所有するタグ一覧を取得
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'event_tag', 'event_id', 'tag_id')->withTimestamps();
    }
    

}
