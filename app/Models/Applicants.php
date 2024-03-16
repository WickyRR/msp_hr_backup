<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicants extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "recruit";
    protected $primaryKey = 'recruit_id';
    public $timestamps = false;

    public function pillars(){
        return $this->belongsToMany(Pillar::class,'recruit_pillar','recruit_id','pillar_id');
    }
    public function skills(){
        return $this->belongsToMany(Skill::class,'recruit_skills','recruit_id','skill_id');
    }
    public function faculty(){
        return $this->belongsTo(Faculty::class,'fac_id','fac_id');
    }
    public function recruit_processes(){
        return $this->belongsTo(RecruitProcess::class,'process_id','recruit_process_id');
    }
}
