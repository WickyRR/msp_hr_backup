<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crew_Members extends Model
{
    use HasFactory;
    protected $table = 'crew__members';
    protected $primary_key = 'id';



    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }
}
