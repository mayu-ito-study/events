<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * このタグのイベント一覧を取得
     */
    public function tag_events()
    {
        return $this->belongsToMany(Event::class, 'event_tag', 'tag_id', 'event_id')->withTimestamps();
    }
    
    
}
