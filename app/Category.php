<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'created_at ',
        'updated_at'
    ];


    /**
     * movies function
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }
}
