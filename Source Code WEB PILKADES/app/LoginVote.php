<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginVote extends Model
{
    protected $table = "login_votes";

    protected $fillable =
    [
        "ip", "login_id"
    ];
}
