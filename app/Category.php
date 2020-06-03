<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // inizializzo le relazioni tra le tabelle
    public function user()
   {
       return $this->belongsTo('App\User');
   }

   public function pages()
   {
       return $this->hasMany('App\Page');
   }
}
