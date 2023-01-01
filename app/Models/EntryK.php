<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntryK extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'entry_k';
    use SoftDeletes;

    public function statusdetail()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
    public function slsdetail()
    {
        return $this->belongsTo(Sls::class, 'sls_id');
    }
    public function userdetail()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function statusdocdetail()
    {
        return $this->belongsTo(StatusDoc::class, 'status_doc_id');
    }
}
