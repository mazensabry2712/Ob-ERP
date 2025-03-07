<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cust extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public function custs_attachments ()
    {
        return $this->belongsTo(custs_attachments::class);
    }
}
