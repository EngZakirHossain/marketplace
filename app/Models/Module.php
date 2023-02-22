<?php

namespace App\Models;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];
    //relation with permission
    public function permissions(){
        return $this->hasMany(Permission::class);
    }
}
