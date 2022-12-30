<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sls extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'sls';
    public $timestamps = false;
}
