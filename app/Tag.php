<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // inizializzo relazioni fra tabelle
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function pages()
    {
        return $this->belongsToMany('App\Page');
    }
}
