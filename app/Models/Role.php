<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $primaryKey = 'id';

    public function permissions() {

        return $this->belongsToMany(Permission::class, 'permission_roles');

     }

     //?No such table
    //Commenting out
     /*public function users() {

        return $this->belongsToMany(User::class,'users_roles');

     }*/

    public function employments(){
        return $this->hasMany(Employment::class);
    }
}

