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

    public function villagedetail()
    {
        return $this->belongsTo(Village::class, 'village_id');
    }

    public function subdistrictdetail()
    {
        return $this->villagedetail->subdistrictdetail();
    }
    public function fullcode()
    {
        return "3513" . $this->subdistrictdetail->code . $this->villagedetail->code . $this->code;
    }

    public function fullname()
    {
        return $this->subdistrictdetail->name . ", " . $this->villagedetail->name . ", " . $this->name;
    }

    public function entriesK()
    {
        return $this->hasMany(EntryK::class, 'sls_id');
    }
}
