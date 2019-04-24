<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable= [
        'category_title', 
    ];

    public function AffList(){
        return $this->belongsToMany(Affirmation::class, 'cat_aff', 'categories_id', 'affirmations_id');
        // return $this->belongsToMany(Affirmation::class);
    }
}
