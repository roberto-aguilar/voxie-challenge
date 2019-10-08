<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactFile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'path',
        'field_mappings'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'field_mappings' => 'json',
    ];
}
