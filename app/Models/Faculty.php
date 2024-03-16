<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model
{

    use HasFactory;
    use SoftDeletes;
    protected $table = "faculty";
    protected $primaryKey = 'fac_id';

    // public function department(){
    // 	return $this->hasMany('App\Models\Department','fac_id','fac_id');
    // }
    public function recruit()
    {
        return $this->hasMany('App\Models\Applicant', 'fac_id', 'fac_id');
    }

    public function pillarmembers()
    {
        return $this->hasMany(PillarMember::class);
    }
}
