<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['note', 'noteable_type', 'noteable_id', 'user_id'];
    protected $appends = ['created_at_display', 'updated_at_display'];



    public function noteable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtDisplayAttribute()
    {
        return $this->created_at->format("d.m.Y H:i:s") ?? '';
    }
    public function getUpdatedAtDisplayAttribute()
    {
        return $this->updated_at->format("d.m.Y H:i:s") ?? '';
    }
}
