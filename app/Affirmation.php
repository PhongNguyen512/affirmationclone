<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Affirmation extends Model
{
    protected $fillable = [
        'aff_content', 'id'
    ];

    public function CatList(){
        return $this->belongsToMany(Category::class, 'cat_aff', 'affirmations_id', 'categories_id');
        // return $this->belongsToMany(Category::class);
    }

}
