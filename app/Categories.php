<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    /**
     * Get the cards for the category.
     */
    public function cards()
    {
        return $this->hasMany('App\Cards');
    }
}
