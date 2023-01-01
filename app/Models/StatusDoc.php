<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusDoc extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'status_doc';
    public $timestamps = false;
}
