<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ds extends Model
{
    use HasFactory;
    protected $fillable=[
       'dsname', 'ds_contact'
    ];
}
