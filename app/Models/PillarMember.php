<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PillarMember extends Model
{
    use HasFactory;
    protected $table='pillar_members';
    protected $primarykey='id';
    

    public function district()
    {
        return $this->belongsTo(District::class,'district_id');
    }

    public function pillar()
    {
        return $this->belongsTo(Pillar::class,'pillar');
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class,'faculty');
    }

    public function kpiscores()
    {
        return $this->hasOne(KPI_Scores::class);
    }
}
