<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    //insert the line below
    protected $fillable = ['message'];

    //Add the below function
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
