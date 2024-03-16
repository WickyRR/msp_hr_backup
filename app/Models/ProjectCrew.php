<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectCrew extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "project_crew";
    protected $primaryKey = 'id';
}
