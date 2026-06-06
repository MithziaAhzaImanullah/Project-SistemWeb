<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'user_id',
        'xid',
        'name',
        'image',
        'city',
        'province',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}