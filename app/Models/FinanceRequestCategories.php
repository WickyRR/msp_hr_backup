<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceRequestCategories extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "finance_request_categories";
    protected $primaryKey = 'id';

    public function financerequest_status()
    {
        return $this->hasMany(FinanceRequests::class, 'category_id', 'id');
    }
}
