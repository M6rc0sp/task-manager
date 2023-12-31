<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    use HasFactory;

    protected $table = 'setores';
    protected $fillable = ['name'];

    public function usuarios()
    {
        return $this->hasMany(User::class);
    }
}
