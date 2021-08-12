<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'overview',
        'release_date',
        'popularity',
        'vote_average',
        'created_at ',
        'updated_at'
    ];

    /**
     * categories function
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
