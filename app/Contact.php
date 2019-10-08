<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_id',
        'unsubscribed_status',
        'first_name',
        'last_name',
        'phone',
        'email',
        'sticky_phone_number_id',
        'twitter_id',
        'fb_messenger_id',
        'time_zone',
    ];

    /**
     * Define a one-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customAttributes()
    {
        return $this->hasMany(CustomAttribute::class);
    }
}
