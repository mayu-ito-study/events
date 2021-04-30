<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * このユーザが所有する投稿。（ Eventモデルとの関係を定義）
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }
    
    /**
     * このユーザに関係するモデルの件数をロードする。
     */
    public function loadRelationshipCounts()
    {
        $this->loadCount('events', 'favorites', 'followings', 'followers');
    }
    
    /**
     * このユーザがフォローしているユーザ。（ Userモデルとの関係を定義）
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }
    
     /**
     * このユーザをフォロー中のユーザ。（ Userモデルとの関係を定義）
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    /**
     * このユーザのお気に入りの一覧を取得
     * 
     * belongsToMany(関連づけるモデル名, 使用する中間テーブル名, 中間テーブルに保存されている自分のidのカラム名, 中間テーブルに保存されている関係先のidのカラム名);
     */
    public function favorites()
    {
        return $this->belongsToMany(Event::class, 'favorites', 'user_id', 'event_id')->withTimestamps();
    }
    
    /**
     * $userIdで指定されたユーザをフォローする。
     *
     * @param  int  $userId
     * @return bool
     */
    public function follow($userId)
    {
        // すでにフォローしているかの確認
        $exist = $this->is_following($userId);
        // 対象が自分自身かどうかの確認
        $its_me = $this->id == $userId;

        if ($exist || $its_me) {
            // すでにフォローしていれば何もしない
            return false;
        } else {
            // 未フォローであればフォローする
            $this->followings()->attach($userId);
            return true;
        }
    }

    /**
     * $userIdで指定されたユーザをアンフォローする。
     *
     * @param  int  $userId
     * @return bool
     */
    public function unfollow($userId)
    {
        // すでにフォローしているかの確認
        $exist = $this->is_following($userId);
        // 対象が自分自身かどうかの確認
        $its_me = $this->id == $userId;

        if ($exist && !$its_me) {
            // すでにフォローしていてかつ自分自身でなければフォローを外す
            $this->followings()->detach($userId);
            return true;
        } else {
            // 未フォローであれば何もしない
            return false;
        }
    }

    /**
     * 指定された $userIdのユーザをこのユーザがフォロー中であるか調べる。フォロー中ならtrueを返す。
     *
     * @param  int  $userId
     * @return bool
     */
    public function is_following($userId)
    {
        // フォロー中ユーザの中に $userIdのものが存在するか
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    
    
        /**
     * $userIdで指定された投稿をお気に入りする。
     *
     * @param  int  $userId
     * @return bool
     */

    public function favorite($eventId)
    {
        // すでにお気に入りしているかの確認
        $exist = $this->is_favorite($eventId);
        if ($exist === true) {
            // すでにフォローしていれば何もしない
            return false;
        } else {
            // 未お気に入りであればお気に入りする
            $this->favorites()->attach($eventId);
            return true;
        }
    }


    /**
     * $userIdで指定された投稿をお気に入り解除する。
     *
     * @param  int  $userId
     * @return bool
     */

    public function unfavorite($eventId)
    {
        // すでにお気に入りいるかの確認
        $exist = $this->is_favorite($eventId);
        if ($exist === true) {
            // すでにフォローしていてかつ自分自身でなければフォローを外す
            $this->favorites()->detach($eventId);
            return true;
        } else {
            // 未お気に入りであれば何もしない
            return false;
        }
    }

    
    
        /**
     * 指定された $eventIdの投稿をこのユーザがお気に入り中であるか調べる。お気に入り中ならtrueを返す。
     *
     * @param  int  $eventId
     * @return bool
     */
    public function is_favorite($eventId)
    {
        // フォロー中ユーザの中に $userIdのものが存在するか
        return $this->favorites()->where('event_id', $eventId)->exists();
    }
    
}
