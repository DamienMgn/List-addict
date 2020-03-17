<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cards extends Model
{
    /**
    * Get the category that owns the card.
    */
   public function category()
   {
       return $this->belongsTo('App\Categories');
   }

    /**
     * Get the tasks for the card.
     */
    public function tasks()
    {
        return $this->hasMany('App\Tasks');
    }
}
