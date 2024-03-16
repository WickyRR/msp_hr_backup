<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KPI_Scores extends Model
{
    protected $table='k_p_i__scores';
    protected $primarykey='id';
    use HasFactory;


    public function pillarmember()
    {
        return $this->belongsTo(PillarMember::class,'id');
    }

}
