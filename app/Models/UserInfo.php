<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    // Relationship with User
    public function user(){
        return $this->belongsTo(User::class);
    }
}
