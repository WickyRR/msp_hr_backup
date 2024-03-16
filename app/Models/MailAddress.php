<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailAddress extends Model
{
    use HasFactory;
    protected $table = 'workspace_mail_addresses';
    protected $primaryKey = 'id';

    public function associated_pillar(){
        return $this->belongsTo(Pillar::class);
    }
}
