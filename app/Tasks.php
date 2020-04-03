<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{

    /**
     * Get the card that owns the task.
     */
    public function card()
    {
        return $this->belongsTo('App\Cards');
    }
}
