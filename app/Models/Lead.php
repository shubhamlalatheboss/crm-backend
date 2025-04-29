<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = ['name', 'email', 'source', 'status', 'assigned_to'];

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
