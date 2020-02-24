<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorizationIp extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip_address'
    ];
}
