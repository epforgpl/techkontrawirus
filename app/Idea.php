<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    public $fillable = ['title', 'description', 'problem', 'recipients', 'solution'];
    public $timestamps = false;

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function getCreatedAtForDisplay() : string
    {
        $date_time = \DateTime::createFromFormat('Y-m-d H:i:s', $this->created_at);
        return $date_time->format('d.m.Y') . ' r. o ' . $date_time->format('H:i');
    }
}
