<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ActivityLog extends Model
{
    protected $fillable = ['description', 'subject_type', 'subject_id', 'user_id', 'created_at'];

    public function subject()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
