<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    /**
     * Get the comments for the blog post.
     */
    public function cards()
    {
        return $this->hasMany('App\Cards');
    }
}
