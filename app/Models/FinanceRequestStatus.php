<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceRequestStatus extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "finance_request_status";
    protected $primaryKey = 'id';

    public function financerequest()
    {
        return $this->hasMany(FinanceRequests::class, 'status_id', 'id');
    }
}
