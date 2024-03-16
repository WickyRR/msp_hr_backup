<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pillar extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "pillar";
    protected $primaryKey = 'pillar_id';
    public function applicants(){
        return $this->belongsToMany(Applicants::class,'recruit_pillar','pillar_id','recruit_id');
    }

    public function associated_emails(){
        return $this->hasMany(MailAddress::class);
    }

    public function pillarmembers()
    {
        return $this->hasMany(PillarMember::class);
    }
}
