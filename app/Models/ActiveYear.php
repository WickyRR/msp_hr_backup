<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActiveYear extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected $table = "active_years";
    protected $primaryKey = 'id';



    public function recruitProcesses()
    {
        return $this->hasMany(RecruitProcess::class, 'year_id', 'id');
    }

}
