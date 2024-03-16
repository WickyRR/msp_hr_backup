<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
	protected $table = "member_positions";
	protected $primaryKey = 'id';
	public $timestamps = false;

}
