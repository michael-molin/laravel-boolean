<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    // gestisco i campi da riempire
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'summary',
        'body',
        'visible'

    ];

    // inizializzo relazioni tabelle
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function photos()
    {
        return $this->belongsToMany('App\Photo');
    }
}
