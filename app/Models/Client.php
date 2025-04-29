<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
     use HasFactory, SoftDeletes;

    // 👇 This allows mass assignment for name and email
    protected $fillable = ['name', 'email'];

    public function deals()
    {
        return $this->hasMany(Deal::class);
    }
}
