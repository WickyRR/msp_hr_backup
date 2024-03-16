<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
  use HasFactory;

  protected $table = "employments";
  protected $primaryKey = 'id';
  public $timestamps = false;

  /*public function position()
  {
    return $this->belongsTo('App\Models\Position', 'member_position_id', 'id');
  }*/

  /*public function pillar()
  {
    return $this->belongsToMany('App\Models\Pillar', 'App\Models\PillarEmployment', 'employment_id', 'pillar_id');
  }*/

  public function role()
  {
    return $this->belongsTo(Role::class, 'role_id', 'id');
  }

  public function permissions()
  {
    return $this->belongsToMany(Permission::class, 'employments_permissions');
  }
}
