<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $fillable = ['idea_id', 'content'];
    public $timestamps = false;

    public function idea()
    {
        return $this->belongsTo('App\Idea');
    }

    public function getCreatedAtForDisplay() : string
    {
        $date_time = \DateTime::createFromFormat('Y-m-d H:i:s', $this->created_at);
        return $date_time->format('d.m.Y') . ' r. o ' . $date_time->format('H:i');
    }
}
