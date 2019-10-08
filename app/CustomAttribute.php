<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomAttribute extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * The attributes that should be visible in serialization.
     *
     * @var array
     */
    protected $visible = [
        'key',
        'value',
    ];
}
