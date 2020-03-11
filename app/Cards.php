<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cards extends Model
{
    /**
    * Get the post that owns the comment.
    */
   public function category()
   {
       return $this->belongsTo('App\Categories');
   }
}
