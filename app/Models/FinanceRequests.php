<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceRequests extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "finance_requests";
    protected $primaryKey = 'id';

    public function finance(){
        return $this->hasMany(Applicants::class,'process_id','id');
    }

    public function status()
    {
        return $this->belongsTo(FinanceRequestStatus::class, 'status_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(FinanceRequestCategories::class, 'category_id', 'id');
    }
}
