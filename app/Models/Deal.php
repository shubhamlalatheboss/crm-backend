<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'value', 'status', 'client_id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
