<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chamados extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'text', 'created_by', 'done_by', 'status', 'priority'];

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function doneByUser()
    {
        return $this->belongsTo(User::class, 'done_by');
    }
}
