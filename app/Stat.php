<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $fillable = ['user_id', 'incomplete'];

    protected $dates = [
        'created_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
