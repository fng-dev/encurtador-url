<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{

    protected $table = 'short_url';

    protected $fillable = [
        'url',
        'short_url',
        'user_id'
    ];

    public function getShortUrlAttribute($value)
    {
        return env('APP_URL') . $value;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
