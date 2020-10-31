<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['description', 'is_done', 'user_id'];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
