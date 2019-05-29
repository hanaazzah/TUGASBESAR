<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kades extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no_urut', 'name', 'visi', 'misi', 'image', 'path'
    ];
}
