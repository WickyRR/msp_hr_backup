<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "skills";
    protected $primaryKey = 'skill_id';

    public function applicants(){
        return $this->belongsToMany(Applicants::class,'recruit_skills','skill_id','recruit_id');
    }
}
