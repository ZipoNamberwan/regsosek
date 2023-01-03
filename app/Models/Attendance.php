<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'attendance';
    public $timestamps = false;

    public function userdetail()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function statusattdetail()
    {
        return $this->belongsTo(StatusAttendance::class, 'status_attendance_id');
    }
}
