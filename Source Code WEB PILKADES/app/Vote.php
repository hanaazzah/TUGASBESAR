<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{

    protected $table = "votes";

    protected $fillable = [
        "id_pemilih"
    ];

    public function pemilih()
    {
        return $this->hasOne('App\Pemilih');
    }
}
