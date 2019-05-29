<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemilih extends Model
{
    protected $table = "pemilih";

    protected $fillable = [
        "name", "nik", "gender", "age", "status_finger"
    ];

    public function vote()
    {
        return $this->hasOne('App\Vote');
    }
}
