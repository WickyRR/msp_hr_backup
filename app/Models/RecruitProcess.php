<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecruitProcess extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected $table = "recruit_processes";
    protected $primaryKey = 'recruit_process_id';

    public function recruit(){
        return $this->hasMany(Applicants::class,'process_id','recruit_process_id');
    }

    public function activeYear(){
        return $this->belongsTo(ActiveYear::class,'year_id','id');
    }

}
